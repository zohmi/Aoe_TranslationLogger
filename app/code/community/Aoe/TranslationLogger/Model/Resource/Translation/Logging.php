<?php

/**
 * Class Aoe_TranslationLogger_Model_Resource_Translation_Logging
 *
 * @category Model
 * @package  Aoe_TranslationLogger
 * @author   AOE Magento Team <team-magento@aoe.com>
 * @license  none none
 * @link     www.aoe.com
 */
class Aoe_TranslationLogger_Model_Resource_Translation_Logging extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('aoe_translationlogger/translation_logging', 'entity_id');
    }

    /**
     * Overwritten save method, updates data on duplicate key
     *
     * @param Mage_Core_Model_Abstract $object Data object
     * @return Aoe_TranslationLogger_Model_Resource_Translation_Logging
     */
    public function save(Mage_Core_Model_Abstract $object)
    {
        if ($object->isDeleted()) {
            return $this->delete($object);
        }

        $this->_serializeFields($object);
        $this->_beforeSave($object);

        $this->_getWriteAdapter()->insertIgnore(
            $this->getMainTable(),
            $this->_prepareDataForSave($object)
        );

        $this->unserializeFields($object);
        $this->_afterSave($object);

        return $this;
    }
}
