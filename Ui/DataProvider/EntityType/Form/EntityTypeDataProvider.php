<?php

namespace Ainnomix\EntityTypeManager\Ui\DataProvider\EntityType\Form;

use Ainnomix\EntityTypeManager\Api\LocatorInterface;
use Magento\Eav\Model\ResourceModel\Entity\Type\CollectionFactory;
use Magento\Ui\Component\Form\Fieldset;
use Magento\Ui\DataProvider\AbstractDataProvider;

class EntityTypeDataProvider extends AbstractDataProvider
{

    /**
     * @var LocatorInterface
     */
    protected $locator;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        LocatorInterface $locator,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);

        $this->collection = $collectionFactory->create();
        $this->locator = $locator;
    }

    public function getMeta()
    {
        $meta = parent::getMeta();
        $meta['main']['arguments']['data']['config']['componentType'] = Fieldset::NAME;
        $meta['main']['arguments']['data']['config']['label'] = __('Main Information');
        $meta['main']['arguments']['data']['config']['collapsible'] = true;
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
                                    'source' => 'main',
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
                                    'source' => 'main',
                                    'componentType' => 'field',
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
        return [
            $entityType->getId() => [
                'entity_type' => $entityType->getData()
            ]
        ];
    }
}
