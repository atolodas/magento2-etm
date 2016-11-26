<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NotFoundException;
use Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;

class Edit extends Type
{

    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        try {
            $entityType = $this->getEntityType();
        } catch (NotFoundException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            $resultRedirect = $this->resultRedirectFactory->create();

            return $resultRedirect->setPath('*/*/index');
        }

        $title = $entityType->getId() ? $entityType->getEntityTypeName() : __('New Entity Type');

        /**
         * Set active menu
         */
        $resultPage->setActiveMenu('Ainnomix_EntityTypeManager::manage_entity_types');
        $resultPage->getConfig()->getTitle()->prepend($title);

        /**
         * Add breadcrumb item
         */
        $resultPage->addBreadcrumb(__('Entity Type Manager'), __('Entity Type Manager'));
        $resultPage->addBreadcrumb($title, $title);

        return $resultPage;
    }
}
