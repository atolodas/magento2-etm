<?php

namespace Ainnomix\EntityTypeManager\Block\Adminhtml\Entity;

use Ainnomix\EntityTypeManager\Api\LocatorInterface;
use Magento\Backend\Block\Widget\Grid\Container;

class Attribute extends Container
{

    protected $locator;

    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        LocatorInterface $locator,
        array $data = []
    ) {
        $this->locator = $locator;
        parent::__construct($context, $data);
    }


    protected function _construct()
    {
        $this->_controller = 'adminhtml_entity_attribute';
        $this->_blockGroup = 'Ainnomix_EntityTypeManager';
        $this->_headerText = __('Manage Attributes');
        $this->_addButtonLabel = __('Add New Attribute');

        parent::_construct();
    }

    public function getCreateUrl()
    {
        $entityType = $this->locator->getEntityType();
        return $this->getUrl('*/*/new', ['entity_type_id' => $entityType->getEntityTypeId()]);
    }
}
