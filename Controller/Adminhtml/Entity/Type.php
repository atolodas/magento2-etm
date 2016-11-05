<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity;

use Magento\Backend\App\Action;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\Model\View\Result\ForwardFactory;

/**
 * Entity types base action class
 */
abstract class Type extends Action
{

    const ADMIN_RESOURCE = 'Ainnomix_EntityTypeManager::manage_entity_types';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * Class constructor
     *
     * @param Action\Context $context
     * @param PageFactory    $resultPageFactory
     * @param ForwardFactory $resultForwardFactory
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        ForwardFactory $resultForwardFactory,
        Registry $registry
    ) {
        parent::__construct($context);

        $this->resultPageFactory = $resultPageFactory;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->registry = $registry;
    }
}
