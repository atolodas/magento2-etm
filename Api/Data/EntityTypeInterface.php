<?php

namespace Ainnomix\EntityTypeManager\Api\Data;

interface EntityTypeInterface
{

    public function getEntityTypeId();

    public function getEntityTypeName();

    public function getEntityTypeCode();
    
    public function getAttributeCollection($setId = null);
    
    
}