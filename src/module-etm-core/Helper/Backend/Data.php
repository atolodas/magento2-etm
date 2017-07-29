<?php

namespace Ainnomix\EntityTypeManager\Helper\Backend;

use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterface;
use Magento\Backend\Helper\Data as BackendHelper;

class Data extends BackendHelper
{

    const ITEM_ID_FORMAT = 'Ainnomix_EntityTypeManager::entity_%s_%s';

    public function getEntityTypeAclId(EntityTypeInterface $entityType, $suffix)
    {
        return sprintf(static::ITEM_ID_FORMAT, $entityType->getEntityTypeCode(), $suffix);
    }

    public function getEntityTypeMenuId(EntityTypeInterface $entityType, $suffix)
    {
        return $this->getEntityTypeAclId($entityType, $suffix);
    }
}
