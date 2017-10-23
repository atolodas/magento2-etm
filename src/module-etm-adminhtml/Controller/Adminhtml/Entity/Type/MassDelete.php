<?php

namespace Ainnomix\EtmAdminhtml\Controller\Adminhtml\Entity\Type;

use Magento\Backend\App\Action;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\Controller\ResultFactory;
use Ainnomix\EtmCore\Api\EntityTypeManagementInterface;
use Ainnomix\EtmAdminhtml\Controller\Adminhtml\Entity\Type;
use Ainnomix\EtmCore\Model\ResourceModel\Entity\Type\CollectionFactory;

class MassDelete extends Type
{

    /**
     * Collection filter
     *
     * @var Filter
     */
    protected $filter;

    /**
     * Collection factory
     *
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * MassDelete constructor
     *
     * @param Action\Context                $context              Action context
     * @param EntityTypeManagementInterface $entityTypeManagement Entity type management service
     * @param Filter                        $filter               Collection filter
     * @param CollectionFactory             $collectionFactory    Collection factory
     */
    public function __construct(
        Action\Context $context,
        EntityTypeManagementInterface $entityTypeManagement,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {
        parent::__construct($context, $entityTypeManagement);

        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Execute mass delete action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collection->getSize();

        foreach ($collection as $entityType) {
            $this->entityTypeManagement->delete($entityType);
        }

        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $collectionSize));

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
