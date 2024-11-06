<?php

namespace Mindarc\Survey\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{

    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('mindarc_survey')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('mindarc_survey')
            )
                ->addColumn(
                    'form_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'Form ID'
                )
                ->addColumn(
                    'data',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '4k',
                    [],
                    'Form Data'
                )
                ->addColumn(
                    'created',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                    'Created At'
                )
                ->addColumn(
                    'request_status',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [],
                    'Request Status'
                )
                ->setComment('Post Table');
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }
}
