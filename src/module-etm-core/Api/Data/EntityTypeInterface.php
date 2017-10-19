<?php

namespace Ainnomix\EtmCore\Api\Data;

interface EntityTypeInterface
{

    /**
     * Get entity type id
     *
     * @return int
     */
    public function getEntityTypeId();

    /**
     * Get entity type name
     *
     * @return string|null
     */
    public function getEntityTypeName();

    /**
     * Set entity type name
     *
     * @param string $value Entity type name
     *
     * @return EntityTypeInterface
     */
    public function setEntityTypeName($value);

    public function getEntityTypeCode();

    public function setEntityTypeCode($value);

    public function getEntityModel();

    public function setEntityModel($entityModel);

    public function getAttributeModel();

    public function setAttributeModel($attributeModel);

    public function getTable();

    public function setTable($table);

    public function getTablePrefix();

    public function setTablePrefix($tablePrefix);

    public function getIdField();

    public function setIdField($idField);

    public function getIncrementModel();

    public function setIncrementModel($incrementModel);

    public function getIncrementPerStore();

    public function setIncrementPerStore($flag);

    public function getIncrementPadLength();

    public function setIncrementPadLength($length);

    public function getIncrementPadChar();

    public function setIncrementPadChar($char);

    public function getAdditionalAttributeTable();

    public function setAdditionalAttributeTable($attributeTable);

    public function getEntityAttributeCollection();

    public function setEntityAttributeCollection($attributeCollection);

    /**
     * Check if entity type is custom.
     * Set custom entity type flag
     *
     * @param bool|null $isCustom Is custom flag
     *
     * @return bool
     */
    public function isCustom($isCustom = null);
}
