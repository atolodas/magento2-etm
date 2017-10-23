<?php

namespace Ainnomix\EtmAdminhtml\Controller\Adminhtml\Entity\Type;

use Ainnomix\EtmAdminhtml\Controller\Adminhtml\Entity\Type;

class Delete extends Type
{

    /**
     * Execute delete action
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        try {
            $entityType = $this->initCurrentEntityType();
            $this->entityTypeManagement->delete($entityType);
        } catch (\Exception $exception) {
            $this->getMessageManager()->addErrorMessage($exception->getMessage());
        }

        return $this->resultRedirectFactory->create()->setPath('*/*');
    }
}
