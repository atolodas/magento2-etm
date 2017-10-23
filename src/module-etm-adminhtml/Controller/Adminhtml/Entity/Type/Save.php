<?php

namespace Ainnomix\EtmAdminhtml\Controller\Adminhtml\Entity\Type;

use Magento\Backend\App\Action;
use Ainnomix\EtmCore\Api\EntityTypeManagementInterface;
use Ainnomix\EtmAdminhtml\Controller\Adminhtml\Entity\Type as TypeAction;

class Save extends TypeAction
{

    protected $dataProcessor;

    public function __construct(
        Action\Context $context,
        EntityTypeManagementInterface $entityTypeManagement,
        PostDataProcessor $dataProcessor
    ) {
        parent::__construct($context, $entityTypeManagement);

        $this->dataProcessor = $dataProcessor;
    }

    public function execute()
    {
        $redirectBack = $this->getRequest()->getParam('back', false);
        $resultRedirect = $this->resultRedirectFactory->create();

        $entityType = $this->initCurrentEntityType();
        $entityType->addData(
            $this->dataProcessor->filter($this->getRequest()->getPostValue())
        );

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
