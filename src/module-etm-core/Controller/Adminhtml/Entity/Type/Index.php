<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;

use Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;
use Magento\Framework\Controller\ResultFactory;

class Index extends Type
{

    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Ainnomix_EntityTypeManager::etm_entity_type_list');
        $resultPage->getConfig()->getTitle()->prepend(__('Entity Types'));

        return $resultPage;
    }
}
