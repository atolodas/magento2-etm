<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Attribute;

use Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Attribute;
use Magento\Framework\Controller\ResultFactory;

class Index extends Attribute
{

    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $entityType = $this->getEntityType();

        $title = __('Manage %1 Attributes', $entityType->getEntityTypeName());
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
