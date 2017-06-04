<?php

namespace Ainnomix\EntityTypeManager\Ui\Component\Entity\Type\Form\Button;

use Ainnomix\EntityTypeManager\Model\RegistryConstants;

class Base
{

    protected $urlBuilder;

    protected $coreRegistry;

    public function __construct(
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->coreRegistry = $coreRegistry;
    }

    public function getEntityTypeId()
    {
        return $this->coreRegistry->registry(RegistryConstants::CURRENT_ENTITY_TYPE_ID);
    }
}
