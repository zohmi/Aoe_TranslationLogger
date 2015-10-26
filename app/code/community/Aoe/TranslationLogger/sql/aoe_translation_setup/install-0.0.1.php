<?php
Mage::log(sprintf('Running Update Script: %s.', __FILE__));

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$this->getConnection()->dropTable($this->getTable('aoe_translationlogger/translation_logging'));
$table = $this->getConnection()
    ->newTable($this->getTable('aoe_translationlogger/translation_logging'))
    ->addColumn(
        'entity_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        [
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
            'primary'  => true,
        ],
        'Translation entry Id'
    )
    ->addColumn(
        'module',
        Varien_Db_Ddl_Table::TYPE_VARCHAR,
        255,
        [
            'nullable' => false,
        ],
        'Module, where this translation is from'
    )
    ->addColumn(
        'text',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        Varien_Db_Ddl_Table::MAX_TEXT_SIZE,
        [
            'nullable' => false,
        ],
        'Text key to translate'
    )
    ->addColumn(
        'translated',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        Varien_Db_Ddl_Table::MAX_TEXT_SIZE,
        [
            'nullable' => true,
        ],
        'Translation'
    )
    ->addColumn(
        'checksum',
        Varien_Db_Ddl_Table::TYPE_VARCHAR,
        255,
        [
            'nullable' => false,
        ],
        'Checksum over module and text'
    )
    ->addColumn(
        'store_view',
        Varien_Db_Ddl_Table::TYPE_SMALLINT,
        null,
        [
            'nullable' => false,
        ],
        'Store view Id'
    )
    ->addColumn(
        'url',
        Varien_Db_Ddl_Table::TYPE_VARCHAR,
        255,
        [
            'nullable' => false,
        ],
        'Shop Url'
    )
    ->addIndex(
        $installer->getIdxName(
            $this->getTable('aoe_translationlogger/translation_logging'),
            ['checksum'],
            Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
        ),
        'checksum',
        [
            'type' => Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
        ]
    )
    ->setComment('Table to collect translations for easier editing');

$this->getConnection()->createTable($table);

$this->endSetup();
