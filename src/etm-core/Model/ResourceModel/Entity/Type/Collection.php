<?php

namespace Ainnomix\EntityTypeManager\Model\ResourceModel\Entity\Type;

use Magento\Eav\Model\ResourceModel\Entity\Type\Collection as EavEntityTypeCollection;

class Collection extends EavEntityTypeCollection
{

    protected function _construct()
    {
        $this->_init('Ainnomix\EntityTypeManager\Model\Entity\Type', 'Ainnomix\EntityTypeManager\Model\ResourceModel\Entity\Type');

        $this->_setIdFieldName($this->getResource()->getIdFieldName());
    }

    protected function _beforeLoad()
    {
        $this->join(
            ['etm' => $this->getResource()->getAdditionalEntityTypeTable()],
            'main_table.entity_type_id = etm.entity_type_id',
            $this->getResource()->getAdditionalEntityTypeFields()
        );

        return parent::_beforeLoad();
    }
}
