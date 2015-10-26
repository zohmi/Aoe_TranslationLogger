<?php

/**
 * Class Aoe_TranslationLogger_Model_Translate
 *
 * @category Model
 * @package  Aoe_TranslationLogger
 * @author   AOE Magento Team <team-magento@aoe.com>
 * @license  none none
 * @link     www.aoe.com
 */
class Aoe_TranslationLogger_Model_Translate extends Mage_Core_Model_Translate
{
    /**
     * @var Aoe_TranslationLogger_Helper_Data
     */
    protected $_defaultHelper;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->_defaultHelper = Mage::app()->getHelper('aoe_translationlogger');
    }

    /**
     * Overwritten translate method
     *
     * @param   array $args Arguments
     * @return  string
     */
    public function translate($args)
    {
        if ($this->_defaultHelper->isLoggingEnabled() && !$this->_defaultHelper->isAdmin()) {
            $text = array_shift($args);

            if (is_string($text) && ''==$text
                || is_null($text)
                || is_bool($text) && false===$text
                || is_object($text) && ''==$text->getText()) {
                return '';
            }

            if ($text instanceof Mage_Core_Model_Translate_Expr) {
                $code = $text->getCode(self::SCOPE_SEPARATOR);
                $module = $text->getModule();
                $text = $text->getText();
                $translated = $this->_getTranslatedString($text, $code);
            } else {
                if (!empty($_REQUEST['theme'])) {
                    $module = 'frontend/default/' . $_REQUEST['theme'];
                } else {
                    $module = 'frontend/default/default';
                }

                $code = $module . self::SCOPE_SEPARATOR . $text;
                $translated = $this->_getTranslatedString($text, $code);
            }

            $translation = Mage::getModel('aoe_translationlogger/translation_logging');
            $translation
                ->setModule($module)
                ->setText($text)
                ->setTranslated($translated)
                ->setChecksum(md5($module . $text))
                ->setStoreView(Mage::app()->getStore()->getStoreId())
                ->setUrl(Mage::app()->getStore()->getCurrentUrl(false))
                ->save();
        }

        return parent::translate($args);
    }
}
