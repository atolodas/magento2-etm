<?php

namespace Ainnomix\EtmAdminhtml\Controller\Adminhtml\Entity\Type;

use Ainnomix\EntityTypeManager\Api\EntityTypeManagementInterface;
use Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;
use Ainnomix\EntityTypeManager\Model\Entity\Validator;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NoSuchEntityException;

class Validate extends Type
{

    protected $validator;

    public function __construct(
        Action\Context $context,
        EntityTypeManagementInterface $entityTypeManagement,
        Validator $validator
    ) {
        parent::__construct($context, $entityTypeManagement);

        $this->validator = $validator;
    }

    public function execute()
    {
        $response = new \Magento\Framework\DataObject();
        $response->setError(false);

        try {
            $entityType = $this->initCurrentEntityType();
            $entityType->addData($this->getRequest()->getParams());
            $this->validator->validate($entityType);
        } catch (\Magento\Framework\Validator\Exception $exception) {
            $response->setError(true);
            $messages = [];
            foreach ($exception->getMessages('error') as $message) {
                $messages[] = $message->getText();
            }
            $response->setMessages($messages);
        } catch (\Exception $exception) {
            $response->setError(true);
            $response->setMessages([$exception->getMessage()]);
        }

        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $resultJson->setData($response);

        return $resultJson;
    }
}
