<?php

namespace Ainnomix\EtmCore\Model\Entity;

use Ainnomix\EtmCore\Api\Data\EntityTypeInterface;

class Type extends \Magento\Eav\Model\Entity\Type implements EntityTypeInterface
{

    protected function _construct()
    {
        $this->_init(\Ainnomix\EtmCore\Model\ResourceModel\Entity\Type::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityTypeName()
    {
        return $this->getData('entity_type_name');
    }

    /**
     * {@inheritdoc}
     */
    public function setEntityTypeName($name)
    {
        return $this->setData('entity_type_name', $name);
    }

    /**
     * {@inheritdoc}
     */
    public function setEntityTypeCode($code)
    {
        return $this->setData('entity_type_code', $code);
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityModel()
    {
        return $this->getData('entity_model');
    }

    /**
     * {@inheritdoc}
     */
    public function setEntityModel($model)
    {
        return $this->setData('entity_model', $model);
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributeModel()
    {
        return $this->getData('attribute_model');
    }

    /**
     * {@inheritdoc}
     */
    public function setAttributeModel($attributeModel)
    {
        return $this->setData('attribute_model', $attributeModel);
    }

    /**
     * {@inheritdoc}
     */
    public function setEntityTable($table)
    {
        return $this->setData('entity_table', $table);
    }

    /**
     * {@inheritdoc}
     */
    public function getTablePrefix()
    {
        return $this->getData('value_table_prefix');
    }

    /**
     * {@inheritdoc}
     */
    public function setTablePrefix($tablePrefix)
    {
        return $this->setData('value_table_prefix', $tablePrefix);
    }

    /**
     * {@inheritdoc}
     */
    public function getIdField()
    {
        return $this->getData('entity_id_field');
    }

    /**
     * {@inheritdoc}
     */
    public function setIdField($idField)
    {
        return $this->setData('entity_id_field', $idField);
    }

    /**
     * {@inheritdoc}
     */
    public function getIncrementModel()
    {
        return $this->getData('increment_model');
    }

    /**
     * {@inheritdoc}
     */
    public function setIncrementModel($incrementModel)
    {
        return $this->setData('increment_model', $incrementModel);
    }

    /**
     * {@inheritdoc}
     */
    public function getIncrementPerStore()
    {
        return $this->getData('increment_per_store');
    }

    /**
     * {@inheritdoc}
     */
    public function setIncrementPerStore($flag)
    {
        return $this->setData('increment_per_store', $flag);
    }

    /**
     * {@inheritdoc}
     */
    public function getIncrementPadLength()
    {
        return $this->getData('increment_pad_length');
    }

    /**
     * {@inheritdoc}
     */
    public function setIncrementPadLength($length)
    {
        return $this->setData('increment_pad_length', $length);
    }

    /**
     * {@inheritdoc}
     */
    public function getIncrementPadChar()
    {
        return $this->getData('increment_pad_char');
    }

    /**
     * {@inheritdoc}
     */
    public function setIncrementPadChar($char)
    {
        return $this->setData('increment_pad_char', $char);
    }

    /**
     * {@inheritdoc}
     */
    public function getAdditionalAttributeTable()
    {
        return $this->getData('additional_attribute_table');
    }

    /**
     * {@inheritdoc}
     */
    public function setAdditionalAttributeTable($attributeTable)
    {
        return $this->setData('additional_attribute_table', $attributeTable);
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityAttributeCollection()
    {
        return $this->getData('entity_attribute_collection');
    }

    /**
     * {@inheritdoc}
     */
    public function setEntityAttributeCollection($attributeCollection)
    {
        return $this->setData('entity_attribute_collection', $attributeCollection);
    }

    /**
     * {@inheritdoc}
     */
    public function isCustom($isCustom = null)
    {
        if ($isCustom !== null) {
            $this->setData('is_custom', $isCustom);
        }

        return (bool) $this->getData('is_custom');
    }

    public function beforeSave()
    {
        if (!$this->getEntityModel()) {
            $this->setEntityModel(\Magento\Catalog\Model\ResourceModel\Product::class);
        }
        if (!$this->getAttributeModel()) {
            $this->setAttributeModel(\Magento\Catalog\Model\ResourceModel\Eav\Attribute::class);
        }
        if (!$this->getEntityTable()) {
            $this->setEntityTable($this->getEntityTableName());
        }

        return parent::beforeSave();
    }

    protected function getEntityTableName()
    {
        return sprintf('etm_%s_entity', $this->getEntityTypeCode());
    }

    protected function _getValidationRulesBeforeSave()
    {
        $validator = new \Magento\Framework\Validator\DataObject();

        $stringLengthValidator = new \Zend_Validate_StringLength(['max' => 255]);

        $entityTypeCodeValidator = new \Magento\Framework\Validator\DataObject();
        $entityTypeCodeValidator->addRule($stringLengthValidator);

        $entityTypeCodeRule = new \Zend_Validate_Regex('/^[a-z]+[a-z0-9_]*$/');
        $entityTypeCodeRule->setMessage(
            __(
                'The entity type code may contain only letters (a-z), numbers (0-9) or underscore (_),'
                . ' and the first character must be a letter.'
            ),
            \Zend_Validate_Regex::NOT_MATCH
        );
        $entityTypeCodeValidator->addRule($entityTypeCodeRule);

        $entityTypeNameValidator = new \Magento\Framework\Validator\DataObject();
        $entityTypeNameValidator->addRule($stringLengthValidator);
        $entityTypeNameValidator->addRule(new \Zend_Validate_NotEmpty());

        $validator->addRule($entityTypeCodeValidator, 'entity_type_code');
        $validator->addRule($entityTypeNameValidator, 'entity_type_name');

        return $validator;
    }
}
