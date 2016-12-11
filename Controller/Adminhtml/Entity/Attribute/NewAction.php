<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Attribute;

use Magento\Backend\App\Action as BackendAction;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Ainnomix\EntityTypeManager\App\Backend\Action\Context;
use Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Attribute;

class NewAction extends Attribute
{

    protected $resultForwardFactory;

    public function __construct(
        BackendAction\Context $context,
        Context $managerContext,
        ForwardFactory $resultForwardFactory
    ) {
        parent::__construct($context, $managerContext);

        $this->resultForwardFactory = $resultForwardFactory;
    }

    public function execute()
    {
        $resultForward = $this->resultForwardFactory->create();
        $resultForward->forward('edit');

        return $resultForward;
    }
}
