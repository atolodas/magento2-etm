<?php

namespace Ainnomix\EtmCore\Model\Entity;

class Validator
{

    public function validate(Type $entityType)
    {
        return $entityType->validateBeforeSave();
    }
}
