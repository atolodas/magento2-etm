<?php

namespace Ainnomix\EntityManager\Controller\Adminhtml\Type;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\ForwardFactory;

class NewAction extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Ainnomix_EntityManager::manage_entities';
    
    /**
     * @var ForwardFactory
     */
    protected $resultForwardFactory;

    public function __construct(
        Action\Context $context,
        ForwardFactory $resultForwardFactory
    ) {
        $this->resultForwardFactory = $resultForwardFactory;

        parent::__construct($context);
    }

    public function execute()
    {
        $resultForward = $this->resultForwardFactory->create();
        $resultForward->forward('edit');

        return $resultForward;
    }
}