<?php

namespace Ainnomix\EntityTypeManager\Api;

use Ainnomix\EntityTypeManager\Model\Entity\Type;

interface LocatorInterface
{

    /**
     * @return Type
     */
    public function getEntityType();
}
