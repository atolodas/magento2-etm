<?php

namespace Ainnomix\EtmCore\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $installer->getConnection()->addColumn(
            $installer->getTable('eav_entity_type'),
            'entity_type_name',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length' => 50,
                'nullable' => true,
                'after' => 'entity_type_code',
                'comment' => 'Entity Type Name'
            ]
        );

        $installer->getConnection()->addColumn(
            $installer->getTable('eav_entity_type'),
            'is_custom',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                'unsigned' => true,
                'nullable' => true,
                'comment' => 'Is Entity Type Custom'
            ]
        );

        $installer->getConnection()->addIndex(
            $installer->getTable('eav_entity_type'),
            $installer->getIdxName(
                $installer->getTable('eav_entity_type'),
                ['is_custom'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_INDEX
            ),
            ['is_custom'],
            \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_INDEX
        );

        $installer->endSetup();
    }
}
