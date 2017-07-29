<?php

namespace Ainnomix\EntityTypeManager\Ui\DataProvider\Entity\Type\Form;

use Ainnomix\EntityTypeManager\Api\LocatorInterface;
use Magento\Eav\Model\ResourceModel\Entity\Type\CollectionFactory;
use Magento\Ui\Component\Form\Fieldset;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Framework\UrlInterface;

class DataProvider extends AbstractDataProvider
{

    /**
     * @var LocatorInterface
     */
    protected $locator;
    /**
     * @var UrlInterface
     */
    private $urlBuilder;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        LocatorInterface $locator,
        UrlInterface $urlBuilder,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);

        $this->collection = $collectionFactory->create();
        $this->locator = $locator;
        $this->urlBuilder = $urlBuilder;
    }

    public function getMeta()
    {
        $meta = parent::getMeta();
        $meta['main']['arguments']['data']['config']['componentType'] = Fieldset::NAME;
        $meta['main']['arguments']['data']['config']['label'] = __('Main Information');
        $meta['main']['arguments']['data']['config']['collapsible'] = false;
        $meta['main']['arguments']['data']['config']['dataScope'] = 'data.entity_type';
        $meta['main']['arguments']['data']['config']['sortOrder'] = 10;
        $meta['main']['children'] = [
            'container_name' => [
                'arguments' => [
                    'data' => [
                        'config' => [
                            'formElement' => 'container',
                            'componentType' => 'container',
                            'label' => __('Entity Type Name'),
                            'required' => 1,
                            'sortOrder' => 10
                        ]
                    ]
                ],
                'children' => [
                    'entity_type_name' => [
                        'arguments' => [
                            'data' => [
                                'config' => [
                                    'dataType' => 'text',
                                    'formElement' => 'input',
                                    'visible' => 1,
                                    'required' => 1,
                                    'label' => __('Entity Type Name'),
                                    'code' => 'entity_type_name',
                                    'componentType' => 'field',
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'container_type' => [
                'arguments' => [
                    'data' => [
                        'config' => [
                            'formElement' => 'container',
                            'componentType' => 'container',
                            'label' => __('Entity Type Code'),
                            'required' => 1,
                            'sortOrder' => 20
                        ]
                    ]
                ],
                'children' => [
                    'entity_type_code' => [
                        'arguments' => [
                            'data' => [
                                'config' => [
                                    'dataType' => 'text',
                                    'formElement' => 'input',
                                    'visible' => 1,
                                    'required' => 1,
                                    'label' => __('Entity Type Code'),
                                    'code' => 'entity_type_name',
                                    'componentType' => 'field',
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'container_use_attribute_set' => [
                'arguments' => [
                    'data' => [
                        'config' => [
                            'formElement' => 'container',
                            'componentType' => 'container',
                            'label' => __('Use Attribute Sets'),
                            'required' => 1,
                            'sortOrder' => 30
                        ]
                    ]
                ],
                'children' => [
                    'use_attribute_set' => [
                        'arguments' => [
                            'data' => [
                                'config' => [
                                    'dataType' => 'boolean',
                                    'label' => __('Use Attribute Sets'),
                                    'formElement' => 'checkbox',
                                    'componentType' => 'field',
                                    'prefer' => 'toggle',
                                    'dataScope' => 'use_attribute_set',
                                    'code' => 'entity_type_name',
                                    'visible' => 1,
                                    'required' => 1,
                                    'default' => 0,
                                    'valueMap' => [
                                        'true' => '1',
                                        'false' => '0',
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'container_is_store_depended' => [
                'arguments' => [
                    'data' => [
                        'config' => [
                            'formElement' => 'container',
                            'componentType' => 'container',
                            'label' => __('Is Store Depended'),
                            'required' => 1,
                            'sortOrder' => 30
                        ]
                    ]
                ],
                'children' => [
                    'is_store_depended' => [
                        'arguments' => [
                            'data' => [
                                'config' => [
                                    'dataType' => 'boolean',
                                    'label' => __('Is Store Depended'),
                                    'formElement' => 'checkbox',
                                    'componentType' => 'field',
                                    'prefer' => 'toggle',
                                    'dataScope' => 'is_store_depended',
                                    'code' => 'is_store_depended',
                                    'visible' => 1,
                                    'required' => 1,
                                    'default' => 0,
                                    'valueMap' => [
                                        'true' => '1',
                                        'false' => '0',
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        return $meta;
    }
    
    public function getData()
    {
        $entityType = $this->locator->getEntityType();
        $this->data = [
            'config' => [
                'submit_url' => $this->urlBuilder->getUrl(
                    'entity_type_manager/entity_type/save',
                    $entityType->getEntityTypeId() ? ['id' => $entityType->getEntityTypeId()] : []
                )
            ]
        ];

        if ($entityType->getEntityTypeId()) {
            $this->data[$entityType->getEntityTypeId()] = [
                'entity_type' => $entityType->getData()
            ];
        }

        return $this->data;
    }
}
