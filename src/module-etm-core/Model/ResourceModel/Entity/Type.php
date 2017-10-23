<?php

namespace Ainnomix\EtmCore\Model\ResourceModel\Entity;

class Type extends \Magento\Eav\Model\ResourceModel\Entity\Type
{

    public function getValidationRulesBeforeSave()
    {
        $entityTypeIdentity = new \Zend_Validate_Callback([$this, 'isEntityTypeUnique']);
        $entityTypeIdentity->setMessage(
            __('The entity type with the same code already exists.'),
            \Zend_Validate_Callback::INVALID_VALUE
        );

        return $entityTypeIdentity;
    }

    public function isEntityTypeUnique(\Magento\Eav\Model\Entity\Type $entityType)
    {
        if ($entityType->getEntityTypeId()) {
            return true;
        }

        return !$this->entityTypeExists($entityType);
    }

    public function entityTypeExists(\Magento\Eav\Model\Entity\Type $entityType)
    {
        $connection = $this->getConnection();
        $select = $connection->select();

        $binds = [
            'entity_type_code' => $entityType->getEntityTypeCode(),
            'entity_type_id'   => (int) $entityType->getEntityId()
        ];

        $select->from(
            $this->getMainTable()
        )->where(
            '(entity_type_code = :entity_type_code)'
        )->where(
            'entity_type_id != :entity_type_id'
        );

        return $connection->fetchRow($select, $binds);
    }

    protected function _getLoadSelect($field, $value, $object)
    {
        $select = parent::_getLoadSelect($field, $value, $object);

        $select->joinInner(
            ['etm' => $this->getTable('etm_eav_entity_type')],
            $this->getMainTable() . '.entity_type_id = etm.entity_type_id',
            ['entity_type_name']
        );

        return $select;
    }

    protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $data = $this->_prepareDataForTable($object, $this->getTable('etm_eav_entity_type'));
        $this->getConnection()->insertOnDuplicate(
            $this->getTable('etm_eav_entity_type'),
            $data,
            []
        );

        return parent::_afterSave($object);
    }
}
