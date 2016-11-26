<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Attribute;

use Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Attribute;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class Edit extends Attribute
{

    protected $entityFactory;

    protected $coreRegistry;

    public function __construct(Action\Context $context, \Magento\Eav\Model\EntityFactory $entityFactory, \Magento\Framework\Registry $coreRegistry)
    {
        $this->entityFactory = $entityFactory;
        $this->coreRegistry = $coreRegistry;

        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('attribute_id');
        $typeId = $this->entityFactory->create()->setType(\Magento\Catalog\Model\Product::ENTITY)->getTypeId();
        /** @var $model \Magento\Catalog\Model\ResourceModel\Eav\Attribute */
        $model = $this->_objectManager->create(
            'Magento\Catalog\Model\ResourceModel\Eav\Attribute'
        )->setEntityTypeId(
            $typeId
        );

        try {
            $model->load($id);
        } catch (\Exception $e) {
            return $this->resultRedirectFactory->create()->setPath('*/*/index');
        }

        $this->coreRegistry->register('entity_attribute', $model);

        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getLayout()
            ->getBlock('attribute_edit_js')
            ->setIsPopup(false);

        return $resultPage;
    }
}
