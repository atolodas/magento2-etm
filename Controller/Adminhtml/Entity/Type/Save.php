<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;

use Magento\Backend\App\Action;
use Magento\Framework\Exception\NotFoundException;
use Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;

class Save extends Type
{

    public function execute()
    {
        $data = $this->getRequest()->getParam('entity_type', []);
        $redirectBack = $this->getRequest()->getParam('back', false);

        $resultRedirect = $this->resultRedirectFactory->create();

        try {
            $entityType = $this->entityTypeBuilder->build($this->getRequest());
        } catch (NotFoundException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());

            return $resultRedirect->setPath('*/*/index');
        }

        try {
            $entityType->addData($data);
            $this->entityTypeManager->save($entityType);

            $this->messageManager
                ->addSuccessMessage(__('Entity type "%1" was successfully saved', $entityType->getEntityTypeName()));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());

            if ($entityType->getEntityTypeId()) {
                $resultRedirect->setPath('*/*/edit', ['id' => $entityType->getEntityTypeId()]);
            } else {
                $resultRedirect->setPath('*/*/new');
            }
        }

        if ($redirectBack == 'new') {
            $resultRedirect->setPath('*/*/new');
        } elseif ($redirectBack) {
            $resultRedirect->setPath('*/*/edit', ['id' => $entityType->getEntityTypeId()]);
        } else {
            $resultRedirect->setPath('*/*/index');
        }

        return $resultRedirect;
    }
}
