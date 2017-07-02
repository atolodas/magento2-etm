<?php

namespace Ainnomix\EntityTypeManager\Model\ResourceModel\Entity;

class Type extends \Magento\Eav\Model\ResourceModel\Entity\Type
{

    public function getValidationRulesBeforeSave()
    {
        $entityTypeIdentity = new \Zend_Validate_Callback([$this, 'isEntityTypeUnique']);
        $entityTypeIdentity->setMessage(
            __('A entity type with the same code already exists.'),
            \Zend_Validate_Callback::INVALID_VALUE
        );

        return $entityTypeIdentity;
    }

    public function isEntityTypeUnique(\Magento\Eav\Model\Entity\Type $entityType)
    {
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
}
