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
class AW_Activitystream_Helper_DataValidation extends Mage_Core_Helper_Abstract {
    
    /**
     * 
     */
    const NUMBER_OF_BACKTRACE_FRAMES_TO_ROLLBACK = 1;
    
    const CASTING_TYPE_INTEGER                   = 1;
    const CASTING_TYPE_PERCENTS                  = 2;
    const CASTING_TYPE_PIXELS                    = 3;
    const CASTING_TYPE_HTMLCOLOR                 = 4;
    
    
    /**
     * 
     */
    public function isavalidObject($object) {
        return is_object($object);
    }
    
    
    /**
     * 
     */
    public function mustbeavalidObject($object) {
        if ( ! $this->isavalidObject($object) ) {
            $__trace = debug_backtrace(0, self::NUMBER_OF_BACKTRACE_FRAMES_TO_ROLLBACK);
            if ( is_array($__trace) and isset($__trace[0]) and isset($__trace[0]['file']) and isset($__trace[0]['line']) ) {
                Mage::log('Error: AW_Activitystream_Helper_Data::mustbeavalidVarienObject() found a value that does not appear to be a valid object in ' . $__trace[0]['file'] . ' on line ' . $__trace[0]['line']);
            }
            else {
                Mage::log('Error: AW_Activitystream_Helper_Data::mustbeavalidVarienObject() found a value that does not appear to be a valid object');
            }
            throw new Exception('AW_Activitystream_Helper_Data::mustbeavalidVarienObject() found a value that does not appear to be a valid object');
            //TODO: Mage::throwException(Mage::helper('core')->__('Resource is not set.'));
        }
        
        return true;
    }
    
    
    /**
     * 
     */
    public function mustbeavalidVarienObject($object) {
        if ( ! ($this->isavalidObject($object) and is_a($object, 'Varien_Object')) ) {
            $__trace = debug_backtrace(0, self::NUMBER_OF_BACKTRACE_FRAMES_TO_ROLLBACK);
            if ( is_array($__trace) and isset($__trace[0]) and isset($__trace[0]['file']) and isset($__trace[0]['line']) ) {
                Mage::log('Error: AW_Activitystream_Helper_Data::mustbeavalidVarienObject() found a value that does not appear to be a valid Varien_Object in ' . $__trace[0]['file'] . ' on line ' . $__trace[0]['line']);
            }
            else {
                Mage::log('Error: AW_Activitystream_Helper_Data::mustbeavalidVarienObject() found a value that does not appear to be a valid Varien_Object');
            }
            throw new Exception('AW_Activitystream_Helper_Data::mustbeavalidVarienObject() found a value that does not appear to be a valid Varien_Object');
        }
        
        return true;
    }
    
    
    /**
     * 
     */
    public function castToValid($type, $value, $default = null, $constraints = null) {
        $__apt = null;
        
        switch ( $type ) {
            case self::CASTING_TYPE_INTEGER:
                $__apt = intval($value);
                if ( (string)$__apt == (string)$value ) {
                    if ( is_array($constraints) and (count($constraints) > 1) ) {
                        $constraints = array_values($constraints);
                        list ($__lower, $__greater) = $constraints;
                        unset($constraints);
                        
                        if ($__lower > $__greater) {
                            $__R = $__greater;
                            $__greater = $__lower;
                            $__lower = $__R;
                            unset($__R);
                        }
                        
                        if ( $__apt < $__lower ) $__apt = $__lower;
                        if ( $__apt > $__greater ) $__apt = $__greater;
                    }
                }
                elseif ( !is_null($default) ) {
                    $__apt = $default;
                }
                else {
                    $__apt = null;
                }
            break;
            case self::CASTING_TYPE_PERCENTS:
                if ( preg_match("|^(\d+)\s*%$|is", $value, $__matches) ) {
                    $__orig = $__apt = $__matches[1];
                    if ( is_array($constraints) and (count($constraints) > 1) ) {
                        $constraints = array_values($constraints);
                        list ($__lower, $__greater) = $constraints;
                        unset($constraints);
                        
                        if ($__lower > $__greater) {
                            $__R = $__greater;
                            $__greater = $__lower;
                            $__lower = $__R;
                            unset($__R);
                        }
                        
                        if ( $__apt < $__lower ) $__apt = $__lower;
                        if ( $__apt > $__greater ) $__apt = $__greater;
                    }
                    
                    $__apt = ( $__apt == $__orig ) ? $value : $__apt . '%';
                }
                elseif ( !is_null($default) ) {
                    $__apt = $default;
                }
                else {
                    $__apt = null;
                }
            break;
            case self::CASTING_TYPE_PIXELS:
                if ( preg_match("|^(\d+)\s*px$|is", $value, $__matches) ) {
                    $__orig = $__apt = $__matches[1];
                    if ( is_array($constraints) and (count($constraints) > 1) ) {
                        $constraints = array_values($constraints);
                        list ($__lower, $__greater) = $constraints;
                        unset($constraints);
                        
                        if ($__lower > $__greater) {
                            $__R = $__greater;
                            $__greater = $__lower;
                            $__lower = $__R;
                            unset($__R);
                        }
                        
                        if ( $__apt < $__lower ) $__apt = $__lower;
                        if ( $__apt > $__greater ) $__apt = $__greater;
                    }
                    
                    $__apt = ( $__apt == $__orig ) ? $value : $__apt . 'px';
                }
                elseif ( !is_null($default) ) {
                    $__apt = $default;
                }
                else {
                    $__apt = null;
                }
            break;
            case self::CASTING_TYPE_HTMLCOLOR:
                if (
                       (preg_match("|^[0-9a-f]{3}$|s", $value))
                    or (preg_match("|^[0-9a-f]{6}$|s", $value))
                    or (preg_match("|^#[0-9a-f]{3}$|s", $value))
                    or (preg_match("|^#[0-9a-f]{6}$|s", $value))
                    or (preg_match("|^[0-9A-F]{3}$|s", $value))
                    or (preg_match("|^[0-9A-F]{6}$|s", $value))
                    or (preg_match("|^#[0-9A-F]{3}$|s", $value))
                    or (preg_match("|^#[0-9A-F]{6}$|s", $value))
                    or (in_array($value, $this->__getHtmlColorValidTextValuesList()))
                ) {
                    $__apt = $value;
                }
                elseif ( !is_null($default) ) {
                    $__apt = $default;
                }
                else {
                    $__apt = null;
                }
            break;
        }
        
        return $__apt;
    }
    
    
    /**
     * 
     */
    protected function __getHtmlColorValidTextValuesList() {
        return array(
            'aliceblue','antiquewhite','aqua','aquamarine','azure','beige','bisque','black',
            'blanchedalmond','blue','blueviolet','brown','burlywood','cadetblue','chartreuse',
            'chocolate','coral','cornflowerblue','cornsilk','crimson','cyan','darkblue','darkcyan',
            'darkgoldenrod','darkgray','darkgreen','darkkhaki','darkmagenta','darkolivegreen',
            'darkorange','darkorchid','darkred','darksalmon','darkseagreen','darkslateblue',
            'darkslategray','darkturquoise','darkviolet','deeppink','deepskyblue','dimgray',
            'dimgrey','dodgerblue','firebrick','floralwhite','forestgreen','fuchsia','gainsboro',
            'ghostwhite','gold','goldenrod','gray','green','greenyellow','honeydew','hotpink',
            'indianred','indigo','ivory','khaki','lavender','lavenderblush','lawngreen',
            'lemonchiffon','lightblue','lightcoral','lightcyan','lightgoldenrodyellow','lightgray',
            'lightgreen','lightpink','lightsalmon','lightseagreen','lightskyblue','lightslategray',
            'lightsteelblue','lightyellow','lime','limegreen','linen','magenta','maroon',
            'mediumaquamarine','mediumblue','mediumorchid','mediumpurple','mediumseagreen',
            'mediumslateblue','mediumspringgreen','mediumturquoise','mediumvioletred',
            'midnightblue','mintcream','mistyrose','moccasin','navajowhite','navy','oldlace',
            'olive','olivedrab','orange','orangered','orchid','palegoldenrod','palegreen',
            'paleturquoise','palevioletred','papayawhip','peachpuff','peru','pink','plum',
            'powderblue','purple','red','rosybrown','royalblue','saddlebrown','salmon','sandybrown',
            'seagreen','seashell','sienna','silver','skyblue','slateblue','slategray','snow',
            'springgreen','steelblue','tan','teal','thistle','tomato','turquoise','violet','wheat',
            'white','whitesmoke','yellow','yellowgreen'
        );
    }
}