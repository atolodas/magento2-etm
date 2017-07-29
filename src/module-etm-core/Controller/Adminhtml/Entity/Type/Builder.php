<?php

namespace Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type;

use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterface;
use Ainnomix\EntityTypeManager\Api\EntityTypeManagerInterface;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Registry;

class Builder
{

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @var EntityTypeManagerInterface
     */
    protected $entityTypeManager;

    /**
     * @var EntityTypeInterface
     */
    protected $entityTypeInstance;

    public function __construct(Registry $registry, EntityTypeManagerInterface $entityTypeManager)
    {
        $this->registry = $registry;
        $this->entityTypeManager = $entityTypeManager;
    }

    public function build(RequestInterface $request, $fieldName = 'entity_type_id')
    {
        if ($this->entityTypeInstance) {
            return $this->entityTypeInstance;
        }

        $entityTypeId = $request->getParam($fieldName, null);
        $entityTypeInstance = $this->entityTypeManager->get((int) $entityTypeId);

        if ($entityTypeId && !$entityTypeInstance->getEntityTypeId()) {
            throw new NotFoundException(__('Requested entity type "%1" does not exist', $entityTypeId));
        }

        $this->registry->register('entity_type', $entityTypeInstance);

        return $this->entityTypeInstance = $entityTypeInstance;
    }
}
