<?php

namespace Ainnomix\EntityTypeManager\Api;

use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterface;

interface EntityTypeManagerInterface
{

    public function get($entityTypeCode);

    public function save(EntityTypeInterface $entityType);

    public function delete(EntityTypeInterface $entityType);
}
