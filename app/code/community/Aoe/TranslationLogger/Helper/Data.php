<?php

/**
 * Class Aoe_TranslationLogger_Helper_Data
 *
 * @category Helper
 * @package  Aoe_TranslationLogger
 * @author   AOE Magento Team <team-magento@aoe.com>
 * @license  none none
 * @link     www.aoe.com
 */
class Aoe_TranslationLogger_Helper_Data  extends Mage_Core_Helper_Abstract
{
    const XML_PATH_LOGGING_ENABLED = 'aoe_translationlogger/general/logger_enabled';

    /**
     * @var null|bool
     */
    protected $_loggingEnabled = null;

    /**
     * @return null|bool
     */
    public function isLoggingEnabled()
    {
        if (is_null($this->_loggingEnabled)) {
            $settingValue = Mage::getStoreConfig(self::XML_PATH_LOGGING_ENABLED);
            $this->_loggingEnabled = ((is_null($settingValue)) ? 0 : $settingValue);
        }

        return $this->_loggingEnabled;
    }

    /**
     * Checks if current request is in admin area
     *
     * @return bool
     */
    public function isAdmin()
    {
        if (Mage::app()->getStore()->isAdmin() || (Mage::getDesign()->getArea() == 'adminhtml')) {
            return true;
        }

        return false;
    }
}
