<?php

namespace Ainnomix\EntityTypeManager\Model\ResourceModel\Entity;

use Magento\Eav\Model\ResourceModel\Entity\Type as EavEntityType;
use Magento\Framework\Model\AbstractModel;

class Type extends EavEntityType
{
    public function getAdditionalEntityTypeTable()
    {
        return $this->getTable('etm_eav_entity_type');
    }

    public function getAdditionalEntityTypeFields()
    {
        $fields = $this->getConnection()->describeTable($this->getAdditionalEntityTypeTable());
        $fields = array_keys($fields);

        unset($fields[array_search($this->getIdFieldName(), $fields)]);

        return $fields;
    }

    protected function _getLoadSelect($field, $value, $object)
    {
        $field = $this->getConnection()->quoteIdentifier(sprintf('%s.%s', $this->getMainTable(), $field));
        $select = $this->getConnection()->select()->from($this->getMainTable())->where($field . '=?', $value);

        $select->joinInner(
            ['etm' => $this->getAdditionalEntityTypeTable()],
            sprintf('%s.entity_type_id = etm.entity_type_id', $this->getMainTable()),
            $this->getAdditionalEntityTypeFields()
        );

        return $select;
    }

    public function prepareAdditionalEntityTypeData($data)
    {
        return $this->_prepareDataForTable(new \Magento\Framework\DataObject($data), $this->getAdditionalEntityTypeTable());
    }
}
