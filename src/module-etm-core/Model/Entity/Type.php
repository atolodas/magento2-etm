<?php

namespace Ainnomix\EtmCore\Model\Entity;

use Ainnomix\EtmCore\Api\Data\EntityTypeInterface;

class Type extends \Magento\Eav\Model\Entity\Type implements EntityTypeInterface
{

    protected function _construct()
    {
        $this->_init(\Ainnomix\EtmCore\Model\ResourceModel\Entity\Type::class);
    }

    public function getEntityTypeName()
    {
        return $this->getData('entity_type_name');
    }

    public function getIsCustom()
    {
        return $this->getData('is_custom');
    }

    protected function _getValidationRulesBeforeSave()
    {
        $validator = new \Magento\Framework\Validator\DataObject();

        $entityTypeCodeRule = new \Zend_Validate_Regex('/^[a-z]+[a-z0-9_]*$/');
        $entityTypeCodeRule->setMessage(
            __(
                'The entity type code may contain only letters (a-z), numbers (0-9) or underscore (_),'
                . ' and the first character must be a letter.'
            ),
            \Zend_Validate_Regex::NOT_MATCH
        );
        $validator->addRule($entityTypeCodeRule, 'entity_type_code');

        return $validator;
    }
}
