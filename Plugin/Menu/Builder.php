<?php

namespace Ainnomix\EntityTypeManager\Plugin\Menu;

use Ainnomix\EntityTypeManager\Api\Data\EntityTypeInterface;
use Magento\Backend\Model\Menu;
use Magento\Backend\Model\Menu\Builder as MenuBuilder;
use Ainnomix\EntityTypeManager\Model\ResourceModel\Entity\Type\CollectionFactory;
use Magento\Backend\Model\Menu\Builder\CommandFactory;
use Magento\Backend\Model\Menu\Item\Factory;
use Ainnomix\EntityTypeManager\Helper\Backend\Data;

class Builder
{

    const BASE_MENU_ITEM = 'Ainnomix_EntityTypeManager::entity_type_manager';
    
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

    /**
     * @var Data
     */
    protected $helper;

    public function __construct(
        CollectionFactory $collectionFactory,
        Factory $menuItemFactory,
        CommandFactory $commandFactory,
        Data $helper
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->menuItemFactory = $menuItemFactory;
        $this->commandFactory = $commandFactory;
        $this->helper = $helper;
    }

    public function afterGetResult(MenuBuilder $subject, Menu $menu)
    {
        $collection = $this->collectionFactory->create();

        /** @var EntityTypeInterface $entityType */
        foreach ($collection as $entityType) {
            $baseItemId = $this->helper->getEntityTypeMenuId($entityType, 'base');
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

            $listItemId = $this->helper->getEntityTypeMenuId($entityType, 'list');
            $data = [
                'id'        => $listItemId,
                'title'     => 'Manage Entities',
                'translate' => 'title',
                'module'    => 'Ainnomix_EntityTypeManager',
                'sortOrder' => 10,
                'action'    => sprintf('entity_type_manager/entity/index/entity_type_id/%s', $entityType->getEntityTypeId()),
                'resource'  => $listItemId,
                'parent'    => $baseItemId
            ];

            $listItem = $this->menuItemFactory->create($data);
            $item->getChildren()->add($listItem, null, 10);

            $attributesItemId = $this->helper->getEntityTypeMenuId($entityType, 'attributes');
            $data = [
                'id'        => $attributesItemId,
                'title'     => 'Manage Attributes',
                'translate' => 'title',
                'module'    => 'Ainnomix_EntityTypeManager',
                'sortOrder' => 20,
                'action'    => sprintf('entity_type_manager/entity_attribute/index/entity_type_id/%s', $entityType->getEntityTypeId()),
                'resource'  => $attributesItemId,
                'parent'    => $baseItemId
            ];

            $listItem = $this->menuItemFactory->create($data);
            $item->getChildren()->add($listItem, null, 20);
        }

        return $menu;
    }
}
