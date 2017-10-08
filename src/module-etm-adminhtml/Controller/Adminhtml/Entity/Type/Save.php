<?php

namespace Ainnomix\EtmAdminhtml\Controller\Adminhtml\Entity\Type;

use Ainnomix\EtmAdminhtml\Controller\Adminhtml\Entity\Type;

class Save extends Type
{

    public function execute()
    {
        var_dump($this->getRequest()->getParams());
        exit;
    }
}
