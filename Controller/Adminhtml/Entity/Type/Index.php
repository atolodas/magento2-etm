<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;

use Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;

class Index extends Type
{

    public function execute()
    {
        $resultPage = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Ainnomix_EntityTypeManager::etm_entity_type_list');
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Entity Types'));

        return $resultPage;
    }
}
