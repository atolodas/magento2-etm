<?php

namespace Ainnomix\EntityTypeManager\Model\Entity;

class Validator
{

    public function validate(Type $entityType)
    {
        return $entityType->validateBeforeSave();
    }
}
