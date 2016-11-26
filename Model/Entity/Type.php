<?php

namespace Ainnomix\EntityTypeManager\Model\Entity;

use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterface;
use Magento\Backend\Block\Menu;
use Magento\Eav\Model\Entity\Type as EavEntityType;
use Magento\Framework\App\Cache\Type\Config;

class Type extends EavEntityType implements EntityTypeInterface
{

    protected $_cacheTag = [
        Config::CACHE_TAG,
        Menu::CACHE_TAGS
    ];

    protected function _construct()
    {
        $this->_init('Ainnomix\EntityTypeManager\Model\ResourceModel\Entity\Type');
    }

    public function getEntityTypeName()
    {
        return isset($this->_data['entity_type_name']) ? $this->_data['entity_type_name'] : null;
    }
}
