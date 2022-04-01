<?php

/**
 * @package   Bounteous\StoreLocations
 * @author    Ricardo Garcia <tsuricardo.garcia@gmail.com>
 * @copyright © 2022 Bounteous
 */

declare(strict_types=1);

namespace Bounteous\StoreLocations\Controller\Adminhtml\Rules;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Bounteous\StoreLocations\Model\Rules;
use Bounteous\StoreLocations\Model\RulesFactory;
use Bounteous\StoreLocations\Model\RulesRepository;
use Magento\Framework\Stdlib\DateTime;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;


class Save extends Action
{
    /**
     * @var Rules
     */
    protected $rules;

    /**
     * @var RulesRepository
     */
    protected $_rulesRepo;

    /**
     * @var RulesFactory
     */
    protected $rulesFactory;

    /**
     * @var TimezoneInterface
     */
    protected $timezone;

    /**
     * @var DateTime
     */
    protected $dateTime;


    /**
     * @param Action\Context $context
     * @param RulesFactory $rulesFactory
     * @param RulesRepository $rulesRepository
     * @param DateTime $dateTime
     */
    public function __construct(
        Action\Context $context,
        \Bounteous\StoreLocations\Model\RulesFactory $rulesFactory,
        RulesRepository $rulesRepository,
        DateTime $dateTime
    ) {
        parent::__construct($context);
        $this->_rulesRepo = $rulesRepository;
        $this->rulesFactory = $rulesFactory;
        $this->dateTime = $dateTime;
    }

    /**
     * Save action
     *
     * @return ResultInterface
     * @throws NoSuchEntityException|CouldNotSaveException
     */
    public function execute(): ResultInterface
    {
        $data = $this->getRequest()->getParams();

        /** @var Redirect $resultRedirect */
        if (!$data) {
            return $resultRedirect->setPath('*/*/');
        }
        $rule = $this->rulesFactory->create();
        $resultRedirect = $this->resultRedirectFactory->create();

        $id = $this->getRequest()->getParam('id_store');
        if ($id) {
            $rule = $this->_rulesRepo->get($id);
        }
        $nowDate = $this->dateTime->formatDate(true);

        if (isset($data['created_at'])) {
            $data= array_merge($data, array('updated_at' => $nowDate));
        }

        $data = $data;
        $rule->setData($data);

        $this->_rulesRepo->save($rule);

        if ($this->getRequest()->getParam('back')) {
            return $resultRedirect->setPath('*/*/edit', ['id_store' => $rule->getId(), '_current' => true]);
        }

        return $resultRedirect->setPath('*/*/');
    }

}
