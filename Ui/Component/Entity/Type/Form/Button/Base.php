<?php

namespace Ainnomix\EntityTypeManager\Ui\Component\Entity\Type\Form\Button;

use Ainnomix\EntityTypeManager\Model\RegistryConstants;

class Base
{

    protected $urlBuilder;

    public function __construct(
        \Magento\Framework\UrlInterface $urlBuilder
    ) {
        $this->urlBuilder = $urlBuilder;
    }
}
