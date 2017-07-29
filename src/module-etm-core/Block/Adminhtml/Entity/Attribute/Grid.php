<?php

namespace Ainnomix\EntityTypeManager\Block\Adminhtml\Entity\Attribute;

use Ainnomix\EntityTypeManager\Api\LocatorInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Helper\Data;
use Magento\Eav\Block\Adminhtml\Attribute\Grid\AbstractGrid;

class Grid extends AbstractGrid
{

    protected $_module = 'entity_type_manager';

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var LocatorInterface
     */
    protected $locator;

    public function __construct(
        Context $context,
        Data $backendHelper,
        LocatorInterface $locator,
        array $data = []
    ) {
        parent::__construct($context, $backendHelper, $data);
        $this->locator = $locator;
    }

    protected function _prepareCollection()
    {
        $entityType = $this->locator->getEntityType();

        $collection = $entityType->getAttributeCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }
}
