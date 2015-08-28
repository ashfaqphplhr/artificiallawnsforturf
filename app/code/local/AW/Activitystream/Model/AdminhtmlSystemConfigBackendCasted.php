<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This software is designed to work with Magento community edition and
 * its use on an edition other than specified is prohibited. aheadWorks does not
 * provide extension support in case of incorrect edition use.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Activitystream
 * @version    1.0.2
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


/**
 *
 */
class AW_Activitystream_Model_AdminhtmlSystemConfigBackendCasted extends Mage_Core_Model_Config_Data {

    /**
     *
     */
    const CASTING_TYPE_CODE_INTEGER   = 'integer';
    const CASTING_TYPE_CODE_PERCENTS  = 'percents';
    const CASTING_TYPE_CODE_PIXELS    = 'pixels';
    const CASTING_TYPE_CODE_HTMLCOLOR = 'htmlcolor';


    /**
     *
     */
    protected function _beforeSave() {
        $__castingString = (string)$this->getFieldConfig()->casting;
        $__castingScheme = $this->__parseCastingScheme($__castingString);
        if ( isset($__castingScheme['default']) ) {
            $__defaultValue = $__castingScheme['default'];
            unset($__castingScheme['default']);
        }
        $__settingLabel = (string)$this->getFieldConfig()->label;

        if ( !is_null($__castingScheme) ) {
            $__successfullyCasted = false;

            foreach ( $__castingScheme as $__typeCode => $__typeConstraints ) {
                $__value = Mage::helper('activitystream/dataValidation')->castToValid(
                    $this->__getCastingTypeByCode($__typeCode),
                    $this->getValue(),
                    null,
                    $__typeConstraints
                );

                if ( !is_null($__value) and ($__value == $this->getValue()) ) {
                    $__successfullyCasted = true;
                    break;
                }
            }

            if ( !$__successfullyCasted ) {
                Mage::getSingleton('adminhtml/session')->addNotice(
                    '"' . htmlspecialchars($this->getValue()) . '" is not a proper value'
                    . ' for the &laquo;' . htmlspecialchars($__settingLabel) . '&raquo; option. Please, input ' . $this->__castingSchemeToText($__castingString)
                );
                if ( $this->getOldValue() ) {
                    $this->setValue($this->getOldValue());
                } else {
                    $this->setValue($__defaultValue);
                }
            }
        }
    }


    /**
     * @param string $scheme
     */
    protected function __parseCastingScheme($castingString) {
        $__castingScheme = null;

        try {
            $__castingScheme = Zend_Json::decode('{' . $castingString . '}');
        }
        catch (Exception $__E) {
            Mage::logException($__E);
        }

        return $__castingScheme;
    }


    /**
     *
     */
    private function __getCastingTypeByCode($typeCode) {
        $__castingType = null;

        switch ($typeCode) {
            case self::CASTING_TYPE_CODE_INTEGER:
                $__castingType = AW_Activitystream_Helper_DataValidation::CASTING_TYPE_INTEGER;
            break;
            case self::CASTING_TYPE_CODE_PERCENTS:
                $__castingType = AW_Activitystream_Helper_DataValidation::CASTING_TYPE_PERCENTS;
            break;
            case self::CASTING_TYPE_CODE_PIXELS:
                $__castingType = AW_Activitystream_Helper_DataValidation::CASTING_TYPE_PIXELS;
            break;
            case self::CASTING_TYPE_CODE_HTMLCOLOR:
                $__castingType = AW_Activitystream_Helper_DataValidation::CASTING_TYPE_HTMLCOLOR;
            break;
        }

        return $__castingType;
    }


    /**
     *
     */
    protected function __castingSchemeToText($castingString) {
        return 'one of the allowed values';
    }
}