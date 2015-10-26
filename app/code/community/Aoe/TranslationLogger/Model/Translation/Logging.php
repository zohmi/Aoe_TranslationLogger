<?php

/**
 * Class Aoe_TranslationLogger_Model_Translation_Logging
 *
 * @category Model
 * @package  Aoe_TranslationLogger
 * @author   AOE Magento Team <team-magento@aoe.com>
 * @license  none none
 * @link     www.aoe.com
 */
class Aoe_TranslationLogger_Model_Translation_Logging  extends Mage_Core_Model_Abstract
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('aoe_translationlogger/translation_logging');
    }
}
