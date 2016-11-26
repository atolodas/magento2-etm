<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity;

abstract class Attribute extends Base
{

    protected $aclSuffix = 'attributes';

    protected $requestIdFieldName = 'entity_type';

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed($this->getEntityTypeMenuId());
    }
}
