<?php

namespace Ainnomix\EntityTypeManager\Plugin\Menu\Acl;

use Ainnomix\EntityTypeManager\Model\Entity\Type;
use Ainnomix\EntityTypeManager\Model\ResourceModel\Entity\Type\CollectionFactory;
use Ainnomix\EntityTypeManager\Plugin\Menu\Builder;
use Magento\Framework\Acl;
use Magento\Framework\Acl\Loader\ResourceLoader;
use Magento\Framework\Acl\AclResource\Provider as AclResourceProvider;

class Provider
{

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    public function afterGetAclResources(AclResourceProvider $subject, $resources)
    {
        foreach ($resources as &$resource) {
            if ($resource['id'] == 'Magento_Backend::admin') {
                foreach ($resource['children'] as &$resourceItem) {
                    if ($resourceItem['id'] == Builder::BASE_MENU_ITEM) {
                        $collection = $this->collectionFactory->create();
                        /** @var Type $entityType */
                        foreach ($collection as $entityType) {
                            $baseResourceId = sprintf(Builder::ITEM_ID_FORMAT, $entityType->getEntityTypeCode(), 'base');
                            $listResourceId = sprintf(Builder::ITEM_ID_FORMAT, $entityType->getEntityTypeCode(), 'list');
                            $attributeResourceId = sprintf(Builder::ITEM_ID_FORMAT, $entityType->getEntityTypeCode(), 'attributes');

                            $data = [
                                'id'        => $baseResourceId,
                                'title'     => $entityType->getEntityTypeName(),
                                'sortOrder' => ($entityType->getEntityTypeId() * 10),
                                'children'  => [
                                    [
                                        'id'        => $listResourceId,
                                        'title'     => 'Manage Entities',
                                        'sortOrder' => 10,
                                        'children'  => []
                                    ],
                                    [
                                        'id'        => $attributeResourceId,
                                        'title'     => 'Manage Attributes',
                                        'sortOrder' => 20,
                                        'children'  => []
                                    ]
                                ]
                            ];

                            $resourceItem['children'][] = $data;
                        }

                        break 1;
                    }
                }
            }
        }

        return $resources;
    }
}
