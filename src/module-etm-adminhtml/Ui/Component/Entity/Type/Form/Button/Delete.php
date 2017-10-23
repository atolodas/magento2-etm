<?php

namespace Ainnomix\EtmAdminhtml\Ui\Component\Entity\Type\Form\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Delete extends Base implements ButtonProviderInterface
{

    protected $request;

    public function __construct(
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\App\RequestInterface $request
    ) {
        parent::__construct($urlBuilder);

        $this->request = $request;
    }

    /**
     * Retrieve delete button configuration
     *
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getEntityTypeId()) {
            $data = [
                'label' => __('Delete'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                        'Are you sure you want to do this?'
                    ) . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    protected function getDeleteUrl()
    {
        return $this->urlBuilder->getUrl('*/*/delete', ['entity_type_id' => $this->getEntityTypeId()]);
    }

    protected function getEntityTypeId()
    {
        return (int) $this->request->getParam('entity_type_id');
    }
}
