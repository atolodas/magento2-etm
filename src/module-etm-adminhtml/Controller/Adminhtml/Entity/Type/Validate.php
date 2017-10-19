<?php

namespace Ainnomix\EtmAdminhtml\Controller\Adminhtml\Entity\Type;

use Magento\Backend\App\Action;
use Magento\Framework\DataObjectFactory;
use Magento\Framework\Controller\ResultFactory;
use Ainnomix\EtmCore\Model\Entity\Validator;
use Ainnomix\EtmCore\Api\EntityTypeManagementInterface;
use Ainnomix\EtmAdminhtml\Controller\Adminhtml\Entity\Type;

class Validate extends Type
{

    protected $validator;

    protected $objectFactory;

    public function __construct(
        Action\Context $context,
        EntityTypeManagementInterface $entityTypeManagement,
        Validator $validator,
        DataObjectFactory $objectFactory
    ) {
        parent::__construct($context, $entityTypeManagement);

        $this->validator = $validator;
        $this->objectFactory = $objectFactory;
    }

    public function execute()
    {
        $response = $this->objectFactory->create();
        $response->setError(false);

        try {
            $entityType = $this->initCurrentEntityType();
            $entityType->addData($this->getRequest()->getParam('entity_type'));
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
