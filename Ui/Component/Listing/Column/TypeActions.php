<?php

namespace Ainnomix\EntityTypeManager\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class TypeActions extends Column
{

    protected $urlBuilder;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components,
        array $data
    ) {
        $this->urlBuilder = $urlBuilder;

        parent::__construct(
            $context,
            $uiComponentFactory,
            $components,
            $data
        );
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')] = [
                    'edit' => [
                        'href' => $this->urlBuilder->getUrl(
                            'entity_type_manager/entity_type/edit',
                            ['id' => $item['entity_type_id']]
                        ),
                        'label' => __('Edit'),
                        'hidden' => false,
                    ],
                    'delete' => [
                        'href' => $this->urlBuilder->getUrl(
                            'entity_type_manager/entity_type/delete',
                            ['id' => $item['entity_type_id']]
                        ),
                        'label' => __('Delete'),
                        'hidden' => false,
                    ]
                ];
            }
        }

        return $dataSource;
    }
}
