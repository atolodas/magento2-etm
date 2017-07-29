<?php

namespace Ainnomix\EntityTypeManager\Api;

use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterface;

interface EntityTypeManagerInterface
{

    /**
     * @param $entityTypeCode
     * @return EntityTypeInterface
     */
    public function get($entityTypeCode);

    public function save(EntityTypeInterface $entityType);

    public function delete(EntityTypeInterface $entityType);
}
