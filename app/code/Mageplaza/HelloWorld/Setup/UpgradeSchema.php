<?php

namespace Mageplaza\HelloWorld\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.1.0', '<')) {
            if (!$installer->tableExists('mageplaza_helloworld_post')) {
                $table = $installer->getConnection()->newTable(
                    $installer->getTable('mageplaza_helloworld_post')
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
                        '64k',
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

                // $installer->getConnection()->addIndex(
                //     $installer->getTable('mageplaza_helloworld_post'),
                //     $setup->getIdxName(
                //         $installer->getTable('mageplaza_helloworld_post'),
                //         ['name', 'url_key', 'post_content', 'tags', 'featured_image'],
                //         \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                //     ),
                //     ['name', 'url_key', 'post_content', 'tags', 'featured_image'],
                //     \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                // );
            }
        }

        $installer->endSetup();
    }
}