<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;

use Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;
use Magento\Framework\Controller\ResultFactory;

class Edit extends Type
{
    public function execute()
    {
        $entityTypeId = $this->initCurrentEntityType();

        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Entity Types'));

        return $resultPage;
    }
}
