<?php

namespace Ainnomix\EtmAdminhtml\Controller\Adminhtml\Entity\Type;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action
{

    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Ainnomix_EtmAdminhtml::etm_entity_type_list');
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Entity Types'));

        return $resultPage;
    }
}
