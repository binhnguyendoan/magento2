<?php

namespace Mindarc\Survey\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.1.0', '<')) {
            $connection = $setup->getConnection();

            if ($setup->tableExists('mindarc_survey')) {
                $connection->addColumn(
                    $setup->getTable('mindarc_survey'),
                    'name',
                    [
                        'type' => Table::TYPE_TEXT,
                        'nullable' => false,
                        'length' => 255,
                        'comment' => 'Name'
                    ]
                );

                $connection->addColumn(
                    $setup->getTable('mindarc_survey'),
                    'email',
                    [
                        'type' => Table::TYPE_TEXT,
                        'nullable' => false,
                        'length' => 255,
                        'comment' => 'Email'
                    ]
                );

                $connection->addColumn(
                    $setup->getTable('mindarc_survey'),
                    'phone_number',
                    [
                        'type' => Table::TYPE_TEXT,
                        'nullable' => false,
                        'length' => 50,
                        'comment' => 'Phone Number'
                    ]
                );

                $connection->addColumn(
                    $setup->getTable('mindarc_survey'),
                    'subject',
                    [
                        'type' => Table::TYPE_TEXT,
                        'nullable' => false,
                        'length' => 255,
                        'comment' => 'Subject'
                    ]
                );

                $connection->addColumn(
                    $setup->getTable('mindarc_survey'),
                    'message',
                    [
                        'type' => Table::TYPE_TEXT,
                        'nullable' => true,
                        'length' => '4k',
                        'comment' => 'Message'
                    ]
                );
            }
        }

        $setup->endSetup();
    }
}