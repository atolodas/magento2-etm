<?php

namespace Ainnomix\EntityTypeManager\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $entityTypeTable = $setup->getTable('etm_eav_entity_type');
        $setup->getConnection()->dropTable($entityTypeTable);

        $table = $setup->getConnection()->newTable($entityTypeTable);
        $table->addColumn(
            'entity_type_id',
            Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, 'unsigned' => true, 'primary' => true],
            'Entity Type ID'
        )->addColumn(
            'entity_type_name',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Entity Type Name'
        )->addColumn(
            'use_attribute_set',
            Table::TYPE_SMALLINT,
            1,
            ['nullable' => false, 'unsigned'=> true, 'default' => 0],
            'Can Use Attribute Set'
        )->addColumn(
            'is_store_depended',
            Table::TYPE_SMALLINT,
            1,
            ['nullable' => false, 'unsigned'=> true, 'default' => 0],
            'Is Value Store Depended'
        )->addForeignKey(
            $setup->getFkName(
                $setup->getTable('etm_eav_entity_type'),
                'entity_type_id',
                $setup->getTable('eav_entity_type'),
                'entity_type_id'
            ),
            'entity_type_id',
            $setup->getTable('eav_entity_type'),
            'entity_type_id',
            Table::ACTION_CASCADE
        )->setComment('Additional Entity Type Table');

        $setup->getConnection()->createTable($table);

        $entityTableName = $setup->getTable('etm_entity');
        $setup->getConnection()->dropTable($entityTableName);

        $table = $setup->getConnection()->newTable($entityTableName);
        $table->addColumn(
            'entity_id',
            Table::TYPE_INTEGER,
            null,
            ['nullable' => false, 'unsigned' => true, 'primary' => true],
            'Entity ID'
        )->addColumn(
            'entity_type_id',
            Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, 'unsigned' => true],
            'Entity Type ID'
        )->addColumn(
            'attribute_set_id',
            Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, 'unsigned' => true, 'default' => 0],
            'Entity Attribute Set ID'
        )->addColumn(
            'created_at',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
            'Created At'
        )->addColumn(
            'updated_at',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE],
            'Updated At'
        )->addIndex(
            $setup->getIdxName($entityTableName, ['attribute_set_id']),
            ['attribute_set_id']
        )->addIndex(
            $setup->getIdxName($entityTableName, ['entity_type_id']),
            ['entity_type_id']
        )->addForeignKey(
            $setup->getFkName($entityTableName, 'attribute_set_id', $setup->getTable('eav_attribute_set'), 'attribute_set_id'),
            'attribute_set_id',
            $setup->getTable('eav_attribute_set'),
            'attribute_set_id',
            Table::ACTION_CASCADE
        )->addForeignKey(
            $setup->getFkName($entityTableName, 'entity_type_id', $entityTypeTable, 'entity_type_id'),
            'entity_type_id',
            $entityTypeTable,
            'entity_type_id',
            Table::ACTION_CASCADE
        )->setComment('ETM Entity Table');

        $setup->getConnection()->createTable($table);

        $typeTables = [
            'varchar'  => ['type' => Table::TYPE_TEXT, 'length' => 255],
            'int'      => ['type' => Table::TYPE_INTEGER, 'length' => null],
            'decimal'  => ['type' => Table::TYPE_DECIMAL, 'length' => '12,4'],
            'datetime' => ['type' => Table::TYPE_DATETIME, 'length' => null],
            'text'     => ['type' => Table::TYPE_TEXT, 'length' => '64k']
        ];

        foreach ($typeTables as $type => $config) {
            $tableName = $setup->getTable($entityTableName . '_' . $type);
            $setup->getConnection()->dropTable($tableName);

            $table = $setup->getConnection()->newTable($tableName);
            $table->addColumn(
                'value_id',
                Table::TYPE_INTEGER,
                null,
                ['nullable' => false, 'unsigned' => true, 'primary' => true],
                'Value ID'
            )->addColumn(
                'attribute_id',
                Table::TYPE_SMALLINT,
                null,
                ['nullable' => false, 'unsigned' => true, 'default' => 0],
                'Attribute ID'
            )->addColumn(
                'store_id',
                Table::TYPE_SMALLINT,
                null,
                ['nullable' => false, 'unsigned' => true, 'default' => 0],
                'Store ID'
            )->addColumn(
                'entity_id',
                Table::TYPE_INTEGER,
                null,
                ['nullable' => false, 'unsigned' => true, 'default' => 0],
                'Entity ID'
            )->addColumn(
                'value',
                $config['type'],
                $config['length'],
                [],
                'Value'
            )->addIndex(
                $setup->getIdxName($tableName, ['entity_id', 'attribute_id', 'store_id'], AdapterInterface::INDEX_TYPE_UNIQUE),
                ['entity_id', 'attribute_id', 'store_id'],
                ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
            )->addIndex(
                $setup->getIdxName($tableName, ['attribute_id']),
                ['attribute_id']
            )->addIndex(
                $setup->getIdxName($tableName, ['store_id']),
                ['store_id']
            )->addForeignKey(
                $setup->getFkName($tableName, 'attribute_id', $setup->getTable('eav_attribute'), 'attribute_id'),
                'attribute_id',
                $setup->getTable('eav_attribute'),
                'attribute_id',
                Table::ACTION_CASCADE
            )->addForeignKey(
                $setup->getFkName($tableName, 'entity_id', $entityTableName, 'entity_id'),
                'entity_id',
                $entityTableName,
                'entity_id',
                Table::ACTION_CASCADE
            )->addForeignKey(
                $setup->getFkName($tableName, 'store_id', $setup->getTable('store'), 'store_id'),
                'store_id',
                $setup->getTable('store'),
                'store_id',
                Table::ACTION_CASCADE
            )->setComment(sprintf('ETM Entity %s Attribute Backend Table', $type));

            $setup->getConnection()->createTable($table);
        }

        $setup->endSetup();
    }
}
