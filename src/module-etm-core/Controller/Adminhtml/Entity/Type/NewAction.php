<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Ainnomix\EntityTypeManager\App\Backend\Action\Context;
use Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;

class NewAction extends Type
{

    protected $resultForwardFactory;

    public function __construct(
        Action\Context $context,
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
