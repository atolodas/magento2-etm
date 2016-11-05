<?php

namespace Ainnomix\EntityTypeManager\Block\Adminhtml\EntityType\Edit\Button;

use Magento\Framework\Registry;
use Magento\Framework\View\Element\UiComponent\Context;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Generic implements ButtonProviderInterface
{

    protected $context;

    protected $registry;

    public function __construct(
        Context $context,
        Registry $registry
    ) {
        $this->context = $context;
        $this->registry = $registry;
    }

    public function getButtonData()
    {
        return [];
    }
}
