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
use Bounteous\StoreLocations\Model\RulesRepository;

class Delete extends Action
{
    /**
     * @var RulesRepository
     */
    protected RulesRepository $_rulesRepository;

    public function __construct(
        RulesRepository $rulesRepository,
        Action\Context $context
    ) {
        $this->_rulesRepository = $rulesRepository;
        parent::__construct($context);
    }

    /**
     * Delete action
     *
     * @return Redirect
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id_store');
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $rules = $this->_rulesRepository->get($id);
                $this->_rulesRepository->delete($rules);
                $this->messageManager->addSuccessMessage(__('The store has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id_store' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a store to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}
