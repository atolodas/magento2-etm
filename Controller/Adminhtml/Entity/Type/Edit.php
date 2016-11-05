<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;

use Magento\Backend\App\Action;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Ainnomix\EntityTypeManager\Api\EntityTypeManagerInterface;
use Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;

class Edit extends Type
{
    /**
     * @var EntityTypeManagerInterface
     */
    protected $entityTypeManager;

    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        ForwardFactory $resultForwardFactory,
        Registry $registry,
        EntityTypeManagerInterface $entityTypeManager
    ) {
        parent::__construct($context, $resultPageFactory, $resultForwardFactory, $registry);

        $this->entityTypeManager = $entityTypeManager;
    }

    /**
     * @return \Ainnomix\EntityTypeManager\Model\Entity\Type
     */
    protected function initEntityType()
    {
        $entityTypeId = (int) $this->getRequest()->getParam('id');
        $entityType = $this->entityTypeManager->get($entityTypeId);

        $this->registry->register('current_entity_type', $entityType);

        return $entityType;
    }

    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $entityType = $this->initEntityType();

        $title = $entityType->getId() ? $entityType->getEntityTypeCode() : __('New Entity Type');

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
