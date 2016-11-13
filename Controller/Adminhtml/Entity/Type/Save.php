<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;

use Magento\Backend\App\Action;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;
use Ainnomix\EntityTypeManager\Api\EntityTypeManagerInterface;
use Ainnomix\EntityTypeManager\Api\EntityTypeRepositoryInterface;

class Save extends Type
{

    /**
     * @var EntityTypeManagerInterface
     */
    protected $entityTypeManager;

    /**
     * @var EntityTypeRepositoryInterface
     */
    protected $entityTypeRepository;

    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        ForwardFactory $resultForwardFactory,
        Registry $registry,
        EntityTypeManagerInterface $entityTypeManager,
        EntityTypeRepositoryInterface $entityTypeRepository
    ) {
        parent::__construct(
            $context,
            $resultPageFactory,
            $resultForwardFactory,
            $registry
        );

        $this->entityTypeManager = $entityTypeManager;
        $this->entityTypeRepository = $entityTypeRepository;
    }

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
            $resultRedirect->setPath('entity_type_manager/entity_type/new');
        } elseif ($redirectBack) {
            $resultRedirect->setPath('entity_type_manager/entity_type/edit', ['id' => $entityType->getEntityTypeId()]);
        } else {
            $resultRedirect->setPath('entity_type_manager/entity_type/index');
        }

        return $resultRedirect;
    }
}
