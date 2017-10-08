<?php

namespace Ainnomix\EtmAdminhtml\Ui\Component\Entity\Type\Form\Button;

class Base
{

    protected $urlBuilder;

    public function __construct(
        \Magento\Framework\UrlInterface $urlBuilder
    ) {
        $this->urlBuilder = $urlBuilder;
    }
}
