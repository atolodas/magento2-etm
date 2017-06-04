<?php

namespace Ainnomix\EntityTypeManager\Ui\Component\Entity\Type\Form\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Delete extends Base implements ButtonProviderInterface
{

    public function getButtonData()
    {
        $data = [];
        if ($this->getEntityTypeId()) {
            $data = [
                'label' => __('Delete Entity Type'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                        'Are you sure you want to do this?'
                    ) . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    public function getDeleteUrl()
    {
        return $this->urlBuilder->getUrl('*/*/delete', ['entity_type_id' => $this->getEntityTypeId()]);
    }
}