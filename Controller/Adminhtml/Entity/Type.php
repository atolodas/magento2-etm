<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity;

use Ainnomix\EntityTypeManager\Helper\Data;
use Magento\Backend\App\Action;
use Magento\Framework\Registry;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Ainnomix\EntityTypeManager\Api\EntityTypeManagerInterface;

/**
 * Entity types base action class
 */
abstract class Type extends Base
{

    const ADMIN_RESOURCE = 'Ainnomix_EntityTypeManager::manage_entity_types';

    /**
     * @var ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * Class constructor
     *
     * @param Action\Context $context
     * @param ForwardFactory $resultForwardFactory
     * @param Registry $registry
     * @param EntityTypeManagerInterface $entityTypeManager
     * @param Data $entityTypeHelper
     */
    public function __construct(
        Action\Context $context,
        ForwardFactory $resultForwardFactory,
        Registry $registry,
        EntityTypeManagerInterface $entityTypeManager,
        Data $entityTypeHelper
    ) {
        parent::__construct($context, $registry, $entityTypeManager, $entityTypeHelper);

        $this->resultForwardFactory = $resultForwardFactory;
    }

}
