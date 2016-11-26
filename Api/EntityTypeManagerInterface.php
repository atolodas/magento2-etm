<?php

namespace Ainnomix\EntityTypeManager\Api;

use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterface;

interface EntityTypeManagerInterface
{

    public function get($entityTypeCode);

    public function create(EntityTypeInterface $entityType);

    public function update(EntityTypeInterface $entityType);

    public function delete(EntityTypeInterface $entityType);
}
