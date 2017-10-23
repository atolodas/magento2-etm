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

        $table = $installer->getConnection()
            ->newTable($installer->getTable('etm_eav_entity_type'))
            ->addColumn(
                'entity_type_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                5,
                ['identity' => false, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Entity Type ID'
            )
            ->addColumn(
                'entity_type_name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Entity Type Name'
            )
            ->addForeignKey(
                $installer->getFkName(
                    $installer->getTable('etm_eav_entity_type'),
                    'entity_type_id',
                    $installer->getTable('eav_entity_type'),
                    'entity_type_id'
                ),
                'entity_type_id',
                $installer->getTable('eav_entity_type'),
                'entity_type_id'
            )
            ->setComment('Additional table for EAV entity type');

        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
