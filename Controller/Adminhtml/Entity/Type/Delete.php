<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;

use Magento\Framework\Exception\NotFoundException;
use Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;

class Delete extends Type
{

    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        try {
            $entityType = $this->initEntityType();
        } catch (NotFoundException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());

            return $resultRedirect->setPath('*/*/index');
        }

        try {
            $this->entityTypeRepository->delete($entityType);

            $this->messageManager->addSuccessMessage(__('Entity type "%1" was successfully removed', $entityType->getEntityTypeName()));
            $resultRedirect->setPath('*/*/index');
        } catch (\Exception $e) {
            $resultRedirect->setPath('*/*/edit', ['id' => $entityType->getEntityTypeId()]);
        }

        return $resultRedirect;
    }
}
