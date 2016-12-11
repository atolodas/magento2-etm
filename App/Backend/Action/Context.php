<?php

namespace Ainnomix\EntityTypeManager\App\Backend\Action;

use Ainnomix\EntityTypeManager\Api\EntityAttributeManagerInterface;
use Ainnomix\EntityTypeManager\Api\EntityTypeManagerInterface;
use Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Type\Builder as TypeBuilder;
use Ainnomix\EntityTypeManager\Controller\Adminhtml\Entity\Attribute\Builder as AttributeBuilder;
use Ainnomix\EntityTypeManager\Helper\Backend\Data;

class Context
{

    /**
     * @var TypeBuilder
     */
    protected $entityTypeBuilder;

    /**
     * @var AttributeBuilder
     */
    protected $entityAttributeBuilder;

    /**
     * @var EntityTypeManagerInterface
     */
    protected $entityTypeManager;

    /**
     * @var EntityAttributeManagerInterface
     */
    protected $entityAttributeManager;

    /**
     * @var Data
     */
    protected $backendHelper;

    public function __construct(
        TypeBuilder\Proxy $entityTypeBuilder,
        AttributeBuilder\Proxy $entityAttributeBuilder,
        EntityTypeManagerInterface\Proxy $entityTypeManager,
        EntityAttributeManagerInterface\Proxy $entityAttributeManager,
        Data\Proxy $backendHelper
    ) {
        $this->entityTypeBuilder = $entityTypeBuilder;
        $this->entityAttributeBuilder = $entityAttributeBuilder;
        $this->entityTypeManager = $entityTypeManager;
        $this->entityAttributeManager = $entityAttributeManager;
        $this->backendHelper = $backendHelper;
    }

    /**
     * @return TypeBuilder
     */
    public function getEntityTypeBuilder()
    {
        return $this->entityTypeBuilder;
    }

    /**
     * @return AttributeBuilder
     */
    public function getEntityAttributeBuilder()
    {
        return $this->entityTypeBuilder;
    }

    /**
     * @return EntityTypeManagerInterface
     */
    public function getEntityTypeManager()
    {
        return $this->entityTypeManager;
    }

    /**
     * @return EntityAttributeManagerInterface
     */
    public function getEntityAttributeManager()
    {
        return $this->entityAttributeManager;
    }

    /**
     * @return Data
     */
    public function getBackendHelper()
    {
        return $this->backendHelper;
    }
}
