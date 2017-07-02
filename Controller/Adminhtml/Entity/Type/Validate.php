<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;

use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterfaceFactory;
use Ainnomix\EntityTypeManager\Api\EntityTypeRepositoryInterface;
use Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NoSuchEntityException;

class Validate extends Type
{

    protected $entityTypeFactory;

    public function __construct(
        Action\Context $context,
        EntityTypeRepositoryInterface $entityTypeRepository,
        EntityTypeInterfaceFactory $entityTypeFactory
    ) {
        parent::__construct($context, $entityTypeRepository);

        $this->entityTypeFactory = $entityTypeFactory;
    }

    public function execute()
    {
        $response = new \Magento\Framework\DataObject();
        $response->setError(false);

        try {
            $entityType = $this->getEntityType();
            $entityType->addData($this->getRequest()->getParams());
            $entityType->validateBeforeSave();
        } catch (\Magento\Framework\Validator\Exception $exception) {
            $response->setError(true);
            $response->setMessages($exception->getMessages());
        } catch (\Exception $exception) {
            $response->setError(true);
            $response->setMessages([$exception->getMessage()]);
        }

        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $resultJson->setData($response);
    }

    /**
     * @return \Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterface|bool
     */
    protected function getEntityType()
    {
        try {
            if (!($entityType = $this->initCurrentEntityType())) {
                $entityType = $this->entityTypeFactory->create();
            }
        } catch (NoSuchEntityException $e) {
            $entityType = $this->entityTypeFactory->create();
        }

        return $entityType;
    }
}
