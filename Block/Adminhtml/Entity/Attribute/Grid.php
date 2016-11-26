<?php

namespace Ainnomix\EntityTypeManager\Block\Adminhtml\Entity\Attribute;

use Magento\Backend\Block\Template\Context;
use Magento\Backend\Helper\Data;
use Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory;
use Magento\Eav\Block\Adminhtml\Attribute\Grid\AbstractGrid;

class Grid extends AbstractGrid
{

    protected $_module = 'entity_type_manager';

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    public function __construct(
        Context $context,
        Data $backendHelper,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $backendHelper, $data);
        $this->collectionFactory = $collectionFactory;
    }

    protected function _prepareCollection()
    {
        $collection = $this->collectionFactory->create()->addVisibleFilter();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }
}
