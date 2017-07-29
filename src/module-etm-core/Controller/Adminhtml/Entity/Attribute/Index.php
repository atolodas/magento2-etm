<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Attribute;

use Magento\Framework\Controller\ResultFactory;
use Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Attribute;

class Index extends Attribute
{

    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        
        try {
            $entityTypeInstance = $this->entityTypeBuilder->build($this->getRequest(), '');
        } catch (\Exception $e) {
            $resultRedirect = $this->resultRedirectFactory->create();

            return $resultRedirect->setPath('admin/index/index');
        }

        $title = __('Manage %1 Attributes', $entityTypeInstance->getEntityTypeName());
        /**
         * Set active menu
         */
        $resultPage->setActiveMenu($this->getEntityTypeMenuId());
        $resultPage->getConfig()->getTitle()->prepend($title);

        /**
         * Add breadcrumb item
         */
        $resultPage->addBreadcrumb(__('Entity Type Manager'), __('Entity Type Manager'));
        $resultPage->addBreadcrumb($title, $title);

        return $resultPage;
    }
}
