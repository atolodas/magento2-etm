<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Attribute;

use Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Attribute;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NoSuchEntityException;

class Edit extends Attribute
{

    public function execute()
    {
        try {
            $entityTypeInstance = $this->entityTypeBuilder->build($this->getRequest());

            try {
                $this->entityAttributeBuilder->build($this->getRequest(), $entityTypeInstance);
            } catch (NoSuchEntityException $e) {
                return $this->resultRedirectFactory->create()->setPath(
                    '*/*/index',
                    ['entity_type_id' => $entityTypeInstance->getEntityTypeId()]
                );
            }
        } catch (NoSuchEntityException $e) {
            return $this->resultRedirectFactory->create()->setPath('admin/index/index');
        }

        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getLayout()
            ->getBlock('attribute_edit_js')
            ->setIsPopup(false);

        return $resultPage;
    }
}
