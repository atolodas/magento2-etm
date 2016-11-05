<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;

use Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;

class NewAction extends Type
{

    public function execute()
    {
        $resultForward = $this->resultForwardFactory->create();
        $resultForward->forward('edit');

        return $resultForward;
    }
}
