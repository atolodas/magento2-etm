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

    protected function _afterSave(AbstractModel $object)
    {
        $data = $this->_prepareDataForTable($object, $this->getAdditionalEntityTypeTable());

        $this->getConnection()
            ->insertOnDuplicate($this->getAdditionalEntityTypeTable(), $data, ['entity_type_name']);

        return parent::_afterSave($object);
    }

    protected function _afterLoad(AbstractModel $object)
    {
        $connection = $this->getConnection();
        $select = $this->getAdditionalDataLoadSelect($this->getIdFieldName(), $object->getData($this->getIdFieldName()));
        $data = $connection->fetchRow($select);

        if ($data) {
            $object->addData($data);
        }

        return parent::_afterLoad($object);
    }

    protected function getAdditionalDataLoadSelect($field, $value)
    {
        $field = $this->getConnection()
            ->quoteIdentifier(sprintf('%s.%s', $this->getAdditionalEntityTypeTable(), $field));
        $select = $this->getConnection()
            ->select()->from($this->getAdditionalEntityTypeTable())->where($field . '=?', $value);
        return $select;
    }
}
