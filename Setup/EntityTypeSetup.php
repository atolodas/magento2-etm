<?php

namespace Ainnomix\EntityTypeManager\Setup;

use Ainnomix\EntityTypeManager\Model\ResourceModel\Entity\Type;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Entity\Setup\Context;
use Magento\Eav\Model\ResourceModel\Entity\Attribute\Group\CollectionFactory;

class EntityTypeSetup extends EavSetup
{

    protected $entityModelName = 'Ainnomix\EntityTypeManager\Model\Entity';

    protected $attributeModelName = 'Magento\Eav\Model\Entity\Attribute';

    protected $attributeCollectionName = 'Ainnomix\EntityTypeManager\Model\ResourceModel\Entity\Attribute\Collection';

    /**
     * @var ModuleDataSetupInterface
     */
    protected $setup;

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

        $this->setup = $setup;
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
            'entity_model' => $this->getValue($entity, 'entity_model', $this->entityModelName),
            'attribute_model' => $this->getValue($entity, 'attribute_model', $this->attributeModelName),
            'entity_table' => $this->getValue($entity, 'entity_table', 'etm_entity'),
            'entity_attribute_collection' => $this->getValue($entity, 'entity_attribute_collection', $this->attributeCollectionName),
            'attributes' => $this->getDefaultAttributes()
        ];

        $entity = array_merge_recursive($data, $entity);

        $this->installEntities([$code => $entity]);
    }

    public function addEntityType($code, array $params)
    {
        parent::addEntityType($code, $params);

        $this->updateAdditionalEntityType($code, $params);

        return $this;
    }

    public function updateEntityType($code, $field, $value = null)
    {
        parent::updateEntityType($code, $field, $value);

        $field = is_array($field) ? $field : [$field => $value];
        $this->updateAdditionalEntityType($code, $field);

        return $this;
    }

    public function updateAdditionalEntityType($code, array $params)
    {
        $params['entity_type_id'] = $this->getEntityTypeId($code);
        $data = $this->entityTypeResource->prepareAdditionalEntityTypeData($params);

        $this->setup->getConnection()->insertOnDuplicate(
            $this->entityTypeResource->getAdditionalEntityTypeTable(),
            $data,
            array_keys($data)
        );
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
