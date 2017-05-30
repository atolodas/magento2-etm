<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;

use Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;

class NewAction extends Type
{

    public function execute()
    {
        $resultPage = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Ainnomix_EntityTypeManager::Ainnomix_EntityTypeManager::etm_entity_type_new');
        $resultPage->getConfig()->getTitle()->prepend(__('Create Entity Type'));

        return $resultPage;
    }
}
