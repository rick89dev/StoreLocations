<?php

/**
 * @package   Bounteous\StoreLocations
 * @author    Ricardo Garcia <tsuricardo.garcia@gmail.com>
 * @copyright © 2022 Bounteous
 */

declare(strict_types=1);

namespace Bounteous\StoreLocations\Controller\Adminhtml\Rules;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Bounteous\StoreLocations\Api\RulesRepositoryInterface;
use Bounteous\StoreLocations\Model\Rules;

class Edit extends Action
{
    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var Rules
     */
    protected $rules;

    /**
     * @var RulesRepositoryInterface
     */
    protected $rulesRepository;

    /**
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     * @param Registry $registry
     * @param Rules $rules
     * @param RulesRepositoryInterface $rulesRepository
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        Rules $rules,
        RulesRepositoryInterface $rulesRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->rules = $rules;
        $this->rulesRepository = $rulesRepository;
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed(): bool
    {
        return true;
    }

    /**
     * Init actions
     *
     * @return Page
     */
    protected function _initAction(): Page
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Bounteous_StoreLocations::rules')
            ->addBreadcrumb(__('Stores'), __('Stores'))
            ->addBreadcrumb(__('Manage Store'), __('Manage Store'));
        return $resultPage;
    }

    /**
     * Edit Item
     *
     * @return Page
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id_store');

        if ($id) {
            $this->rules = $this->rulesRepository->get($id);
            if (!$this->rules->getId()) {
                $this->messageManager->addErrorMessage(__('This item no longer exists.'));

                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }

        $data = $this->_session->getFormData(true);
        if (!empty($data)) {
            $this->rules->setData($data);
        }

        $this->_coreRegistry->register('rules', $this->rules);

        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(__('Bounteous'), __('Bounteous'));
        $resultPage->addBreadcrumb(
            $id ? __('Edit Store') : __('New Store'),
            $id ? __('Edit Store') : __('New Store')
        );
        $resultPage->getConfig()->getTitle()->prepend($id ? __('Edit Store') : __('New Store'));

        return $resultPage;
    }
}
