<?php

namespace Ainnomix\EtmAdminhtml\Controller\Adminhtml\Entity\Type;

use Magento\Framework\Controller\ResultFactory;
use Ainnomix\EtmAdminhtml\Controller\Adminhtml\Entity\Type;

class NewAction extends Type
{

    public function execute()
    {
        $resultForward = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);
        $resultForward->forward('edit');

        return $resultForward;
    }
}
