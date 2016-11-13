<?php

namespace Ainnomix\EntityTypeManager\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $table = $setup->getConnection()->newTable(
            $setup->getTable('etm_eav_entity_type')
        )->addColumn(
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

        $setup->endSetup();
    }
}
