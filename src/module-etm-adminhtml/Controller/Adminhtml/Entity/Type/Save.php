<?php

namespace Ainnomix\EtmAdminhtml\Controller\Adminhtml\Entity\Type;

use Ainnomix\EtmAdminhtml\Controller\Adminhtml\Entity\Type;

class Save extends Type
{

    public function execute()
    {
        $redirectBack = $this->getRequest()->getParam('back', false);
        $resultRedirect = $this->resultRedirectFactory->create();

        $entityType = $this->initCurrentEntityType();
        $entityType->addData($this->getRequest()->getParam('entity_type'));

        try {
            $this->entityTypeManagement->save($entityType);

            $this->getMessageManager()->addSuccessMessage(__('Entity type "%1" was successfully saved', $entityType->getEntityTypeName()));
        } catch (\Exception $exception) {
            $this->getMessageManager()->addErrorMessage($exception->getMessage());
            $redirectBack = $entityType->getEntityTypeId() ? true : 'new';
        }

        if ($redirectBack == 'new') {
            $resultRedirect->setPath('etm/*/new');
        } elseif ($redirectBack) {
            $resultRedirect->setPath(
                'etm/*/edit',
                ['entity_type_id' => $entityType->getEntityTypeId()]
            );
        } else {
            $resultRedirect->setPath('etm/*/');
        }

        return $resultRedirect;
    }
}
