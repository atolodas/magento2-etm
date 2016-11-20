<?php

namespace Ainnomix\EntityTypeManager\Plugin\Menu;

use Magento\Backend\Model\Menu;
use Magento\Backend\Model\Menu\Builder as MenuBuilder;
use Ainnomix\EntityTypeManager\Model\ResourceModel\Entity\Type\CollectionFactory;
use Magento\Backend\Model\Menu\Builder\CommandFactory;
use Magento\Backend\Model\Menu\Item\Factory;

class Builder
{

    const BASE_MENU_ITEM = 'Ainnomix_EntityTypeManager::entity_type_manager';

    protected $menuItemIdFormat = 'Ainnomix_EntityTypeManager::entity_%s_%s';
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var Factory
     */
    protected $menuItemFactory;

    /**
     * @var CommandFactory
     */
    protected $commandFactory;

    public function __construct(CollectionFactory $collectionFactory, Factory $menuItemFactory, CommandFactory $commandFactory)
    {
        $this->collectionFactory = $collectionFactory;
        $this->menuItemFactory = $menuItemFactory;
        $this->commandFactory = $commandFactory;
    }

    public function afterGetResult(MenuBuilder $subject, Menu $menu)
    {
        $collection = $this->collectionFactory->create();

        foreach ($collection as $entityType) {
            $baseItemId = sprintf($this->menuItemIdFormat, $entityType->getEntityTypeCode(), 'base');
            $data = [
                'id'        => $baseItemId,
                'title'     => $entityType->getEntityTypeName(),
                'translate' => 'title',
                'module'    => 'Ainnomix_EntityTypeManager',
                'sortOrder' => ($entityType->getEntityTypeId() * 10),
                'resource'  => $baseItemId,
                'parent'    => static::BASE_MENU_ITEM
            ];

            $item = $this->menuItemFactory->create($data);
            $menu->add($item, static::BASE_MENU_ITEM, $data['sortOrder']);

            $listItemId = sprintf($this->menuItemIdFormat, $entityType->getEntityTypeCode(), 'list');
            $data = [
                'id'        => $listItemId,
                'title'     => 'Manage Entities',
                'translate' => 'title',
                'module'    => 'Ainnomix_EntityTypeManager',
                'sortOrder' => 10,
                'action'    => sprintf('entity_type_manager/entity/index/entity_type/%s', $entityType->getEntityTypeId()),
                'resource'  => $listItemId,
                'parent'    => $baseItemId
            ];

            $listItem = $this->menuItemFactory->create($data);
            $item->getChildren()->add($listItem, null, 10);

            $attributesItemId = sprintf($this->menuItemIdFormat, $entityType->getEntityTypeCode(), 'attributes');
            $data = [
                'id'        => $attributesItemId,
                'title'     => 'Manage Attributes',
                'translate' => 'title',
                'module'    => 'Ainnomix_EntityTypeManager',
                'sortOrder' => 10,
                'action'    => sprintf('entity_type_manager/entity_attributes/index/entity_type/%s', $entityType->getEntityTypeId()),
                'resource'  => $attributesItemId,
                'parent'    => $baseItemId
            ];

            $listItem = $this->menuItemFactory->create($data);
            $item->getChildren()->add($listItem, null, 20);
        }

        return $menu;
    }
}
