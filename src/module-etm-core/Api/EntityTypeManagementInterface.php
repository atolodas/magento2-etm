<?php

namespace Ainnomix\EtmCore\Api;

use Ainnomix\EtmCore\Api\Data\EntityTypeInterface;

interface EntityTypeManagementInterface
{

    /**
     * @param $entityTypeId
     *
     * @return EntityTypeInterface
     */
    public function get($entityTypeId);

    /**
     * @param EntityTypeInterface $entityType
     *
     * @return EntityTypeInterface
     */
    public function save(EntityTypeInterface $entityType);

    /**
     * Delete entity type instance
     *
     * @param EntityTypeInterface $entityType Entity type instance
     *
     * @return void
     *
     * @throws \LogicException
     */
    public function delete(EntityTypeInterface $entityType);
}
