<?php

namespace Ainnomix\EntityTypeManager\Block\Adminhtml\Entity\Type\Edit\Button;

use Magento\Backend\Block\Widget\Context;
use Ainnomix\EntityTypeManager\Api\LocatorInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Generic implements ButtonProviderInterface
{

    /**
     * @var Context
     */
    protected $context;

    /**
     * @var LocatorInterface
     */
    protected $locator;

    public function __construct(Context $context, LocatorInterface $locator)
    {
        $this->context = $context;
        $this->locator = $locator;
    }

    /**
     * @return int|null
     */
    public function getEntityTypeId()
    {
        if ($this->locator->getEntityType()) {
            return $this->locator->getEntityType()->getEntityTypeId();
        }

        return null;
    }

    public function getUrl($route = '', array $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }

    public function getButtonData()
    {
        return [];
    }
}
