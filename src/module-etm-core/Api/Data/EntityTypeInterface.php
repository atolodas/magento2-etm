<?php

namespace Ainnomix\EntityTypeManager\Api\Data;

interface EntityTypeInterface
{

    /**
     * Get entity type id
     *
     * @return int
     */
    public function getEntityTypeId();

    /**
     * @return string
     */
    public function getEntityTypeName();

    /**
     * @return int
     */
    public function getIsCustom();
}
