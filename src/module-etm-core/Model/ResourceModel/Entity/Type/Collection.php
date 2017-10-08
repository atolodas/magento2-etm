<?php

namespace Ainnomix\EtmCore\Model\ResourceModel\Entity\Type;

class Collection extends \Magento\Eav\Model\ResourceModel\Entity\Type\Collection
{

    protected function _construct()
    {
        $this->_init(\Ainnomix\EtmCore\Model\Entity\Type::class, \Ainnomix\EtmCore\Model\ResourceModel\Entity\Type::class);
    }

    protected function _beforeLoad()
    {
        $this->addFieldToFilter('is_custom', 1);

        return parent::_beforeLoad();
    }
}
