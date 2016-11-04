<?php

namespace Ainnomix\EntityManager\Controller\Adminhtml\Type;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action
{

    const ADMIN_RESOURCE = 'Ainnomix_EntityManager::manage_entities';

    /**
     * @var PageFactory
     */
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
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Ainnomix_EntityManager::manage_entities');
//        $resultPage->getConfig()->getTitle()->prepend(__('Products'));
//        $resultPage->getConfig()->getTitle()->prepend($product->getName());

        return $resultPage;
    }
}
