<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity;

use Magento\Backend\App\Action as BackendAction;
use Ainnomix\EntityTypeManager\App\Backend\Action\Context;

abstract class Action extends BackendAction
{

    /**
     * @var Type\Builder
     */
    protected $entityTypeBuilder;


    public function __construct(BackendAction\Context $context, Context $managerContext)
    {
        parent::__construct($context);

        $this->entityTypeBuilder = $managerContext->getEntityTypeBuilder();
    }
}
