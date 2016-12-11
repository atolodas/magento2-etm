<?php

namespace Ainnomix\EntityTypeManager\Model\Locator;

use Ainnomix\EntityTypeManager\Api\LocatorInterface;
use Magento\Framework\Registry;

class RegistryLocator implements LocatorInterface
{

    /**
     * @var Registry
     */
    protected $registry;

    public function __construct(Registry $registry)
    {
        $this->registry = $registry;
    }

    public function getEntityType()
    {
        return $this->registry->registry('entity_type');
    }
}
