<?php

namespace Ainnomix\EntityTypeManager\Api;

use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterface;

interface EntityTypeManagementInterface
{

    /**
     * @param $entityTypeId
     *
     * @return EntityTypeInterface
     */
    public function get($entityTypeId);
}
