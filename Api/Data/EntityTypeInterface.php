<?php

namespace Ainnomix\EntityTypeManager\Api\Data;

interface EntityTypeInterface
{

    /**
     * @return string
     */
    public function getEntityTypeName();

    /**
     * @return int
     */
    public function getIsCustom();
}
