<?php

namespace Ainnomix\EtmCore\Model\ResourceModel\Entity\Type;

class Collection extends \Magento\Eav\Model\ResourceModel\Entity\Type\Collection
{

    protected function _construct()
    {
        $this->_init(
            \Ainnomix\EtmCore\Model\Entity\Type::class,
            \Ainnomix\EtmCore\Model\ResourceModel\Entity\Type::class
        );

        $this->addFilterToMap('entity_type_id', 'main_table.entity_type_id');
    }

    protected function _beforeLoad()
    {
        $this->join(
            ['etm' => $this->getTable('etm_eav_entity_type')],
            'main_table.entity_type_id = etm.entity_type_id',
            ['entity_type_name']
        );

        return parent::_beforeLoad();
    }
}
