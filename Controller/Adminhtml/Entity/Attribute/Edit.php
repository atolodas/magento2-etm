<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Attribute;

use Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Attribute;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class Edit extends Attribute
{

    public function execute()
    {
        try {
            $this->getAttribute();
        } catch (\Exception $e) {
            return $this->resultRedirectFactory->create()->setPath('*/*/index');
        }

        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getLayout()
            ->getBlock('attribute_edit_js')
            ->setIsPopup(false);

        return $resultPage;
    }
}
