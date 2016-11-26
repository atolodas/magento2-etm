<?php

namespace Ainnomix\EntityTypeManager\Helper;

use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterface;
use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{

    const ITEM_ID_FORMAT = 'Ainnomix_EntityTypeManager::entity_%s_%s';

    public function getEntityTypeMenuId(EntityTypeInterface $entityType, $suffix)
    {
        return sprintf(static::ITEM_ID_FORMAT, $entityType->getEntityTypeCode(), $suffix);
    }
}
