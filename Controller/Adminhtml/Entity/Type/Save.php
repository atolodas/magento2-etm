<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;

use Magento\Backend\App\Action;
use Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;

class Save extends Type
{

    public function execute()
    {
        $entityTypeId = (int) $this->getRequest()->getParam('id', 0);
        $data = $this->getRequest()->getParam('entity_type', []);
        $redirectBack = $this->getRequest()->getParam('back', false);

        $entityType = $this->entityTypeManager->get($entityTypeId);

        try {
            $entityType->addData($data);
            $this->entityTypeRepository->save($entityType);

            $this->messageManager
                ->addSuccessMessage(__('Entity type "%1" was successfully saved', $entityType->getEntityTypeName()));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        $resultRedirect = $this->resultRedirectFactory->create();

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
