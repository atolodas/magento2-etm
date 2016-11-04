<?php

namespace Ainnomix\EntityManager\Controller\Adminhtml\Type;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Ainnomix_EntityManager::manage_entities';

    protected $resultPageFactory;

    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;

        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();

        /**
         * Set active menu
         */
        $resultPage->setActiveMenu('Ainnomix_EntityManager::manage_entities');
        $resultPage->getConfig()->getTitle()->prepend(__('Custom Entities'));

        /**
         * Add breadcrumb item
         */
        $resultPage->addBreadcrumb(__('Entity Manager'), __('Entity Manager'));
        $resultPage->addBreadcrumb(__('Custom Entities'), __('Custom Entities'));

        return $resultPage;
    }
}
