<?php

namespace Ainnomix\EntityTypeManager\Block\Adminhtml\Entity;

use Magento\Backend\Block\Widget\Grid\Container;

class Attribute extends Container
{

    protected function _construct()
    {
        $this->_controller = 'adminhtml_entity_attribute';
        $this->_blockGroup = 'Ainnomix_EntityTypeManager';
        $this->_headerText = __('Manage Attributes');
        $this->_addButtonLabel = __('Add New Attribute');

        parent::_construct();
    }
}
