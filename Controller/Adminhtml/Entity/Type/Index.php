<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;

use Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;

/**
 * Entity types list action class
 */
class Index extends Type
{

    /**
     * Execute action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();

        /**
         * Set active menu
         */
        $resultPage->setActiveMenu('Ainnomix_EntityTypeManager::manage_entity_types');
        $resultPage->getConfig()->getTitle()->prepend(__('Entity Types'));

        /**
         * Add breadcrumb item
         */
        $resultPage->addBreadcrumb(__('Entity Type Manager'), __('Entity Type Manager'));
        $resultPage->addBreadcrumb(__('Entity Types'), __('Entity Types'));

        return $resultPage;
    }
}
