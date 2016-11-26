<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;

use Magento\Backend\App\Action;
use Magento\Framework\Registry;
use Magento\Ui\Component\MassAction\Filter;
use Ainnomix\EntityTypeManager\Helper\Data;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Ainnomix\EntityTypeManager\Api\EntityTypeManagerInterface;
use Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;
use Ainnomix\EntityTypeManager\Model\ResourceModel\Entity\Type\CollectionFactory;

class MassDelete extends Type
{

    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var EntityTypeManagerInterface
     */
    protected $entityTypeManager;

    public function __construct(
        Action\Context $context,
        ForwardFactory $resultForwardFactory,
        Registry $registry,
        EntityTypeManagerInterface $entityTypeManager,
        Data $entityTypeHelper,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {
        parent::__construct($context, $resultForwardFactory, $registry, $entityTypeManager, $entityTypeHelper);

        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
    }

    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collection->getSize();

        foreach ($collection as $entityType) {
            $this->entityTypeManager->delete($entityType);
        }

        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $collectionSize));

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/');
    }
}
