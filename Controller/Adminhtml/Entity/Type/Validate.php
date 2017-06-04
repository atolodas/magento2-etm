<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;

use Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;

class Validate extends Type
{

    public function execute()
    {
        var_dump($this->getRequest()->getParams());
        exit;
    }
}
