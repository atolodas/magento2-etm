<?php

namespace Ainnomix\EntityTypeManager\Model\Entity\Attribute;

use Ainnomix\EntityTypeManager\Api\EntityAttributeRepositoryInterface;
use Magento\Eav\Model\AttributeRepository as EavAttributeRepository;

class AttributeRepository extends EavAttributeRepository implements EntityAttributeRepositoryInterface
{

}
