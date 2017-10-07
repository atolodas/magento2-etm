<?php

namespace Ainnomix\EtmAdminhtml\Controller\Adminhtml\Entity\Type;

use Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;
use Magento\Framework\Controller\ResultFactory;

class Edit extends Type
{

    /**
     * Execute controller action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        try {
            $entityType = $this->initCurrentEntityType();

            $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
            $resultPage->setActiveMenu('Ainnomix_EntityTypeManager::etm_entity_type_list');

            if ($entityType->getEntityTypeId()) {
                $resultPage->getConfig()->getTitle()->prepend($entityType->getEntityTypeName());
            } else {
                $resultPage->getConfig()->getTitle()->prepend(__('New Entity Type'));
            }
        } catch (\Exception $e) {
            $this->getMessageManager()->addErrorMessage($e->getMessage());

            $resultPage = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultPage->setPath('*/*/');
        }

        return $resultPage;
    }
}
