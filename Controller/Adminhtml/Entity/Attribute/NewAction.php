<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Attribute;

use Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Attribute;

class NewAction extends Attribute
{

    public function execute()
    {
        $resultForward = $this->resultForwardFactory->create();
        $resultForward->forward('edit');

        return $resultForward;
    }
}
