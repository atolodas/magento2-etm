<?php

namespace Ainnomix\EntityTypeManager\Setup;

use Ainnomix\EntityTypeManager\Model\Entity;
use Ainnomix\EntityTypeManager\Model\ResourceModel\Entity\Attribute\Collection;
use Ainnomix\EntityTypeManager\Model\ResourceModel\Entity\Type;
use Magento\Eav\Model\Entity\Attribute;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Entity\Setup\Context;
use Magento\Eav\Model\ResourceModel\Entity\Attribute\Group\CollectionFactory;

class EntityTypeSetup extends EavSetup
{

    /**
     * @var Type
     */
    protected $entityTypeResource;

    public function __construct(
        ModuleDataSetupInterface $setup,
        Context $context,
        CacheInterface $cache,
        CollectionFactory $attrGroupCollectionFactory,
        Type $entityTypeResource
    ) {
        parent::__construct($setup, $context, $cache, $attrGroupCollectionFactory);

        $this->entityTypeResource = $entityTypeResource;
    }

    protected function getValue($array, $key, $default = null)
    {
        if (isset($array[$key]) && is_bool($array[$key])) {
            $array[$key] = (int)$array[$key];
        }
        return isset($array[$key]) ? $array[$key] : $default;
    }

    public function installEntityType($code, array $entity)
    {
        $data = [
            'entity_model' => $this->getValue($entity, 'entity_model', Entity::class),
            'attribute_model' => $this->getValue($entity, 'attribute_model', Attribute::class),
            'entity_table' => $this->getValue($entity, 'entity_table', 'etm_entity'),
            'entity_attribute_collection' => $this->getValue($entity, 'entity_attribute_collection', Collection::class),
            'attributes' => $this->getDefaultAttributes()
        ];

        $entity = array_merge_recursive($data, $entity);

        $this->installEntities([$code => $entity]);
    }

    public function addEntityType($code, array $params)
    {
        parent::addEntityType($code, $params);

        $params['entity_type_id'] = $this->getEntityTypeId($code);
        $this->entityTypeResource->updateAdditionalEntityType($params);

        return $this;
    }

    public function getDefaultAttributes()
    {
        return [
            'created_at' => [
                'type'       => 'static',
                'input'      => 'date',
                'sort_order' => 100,
                'visible'    => false,
            ],
            'updated_at' => [
                'type'       => 'static',
                'input'      => 'date',
                'sort_order' => 101,
                'visible'    => false,
            ],
        ];
    }
}
