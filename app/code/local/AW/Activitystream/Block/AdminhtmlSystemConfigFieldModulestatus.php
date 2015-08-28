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
class AW_Activitystream_Block_AdminhtmlSystemConfigFieldModulestatus extends Mage_Adminhtml_Block_System_Config_Form_Field {
    
    /**
     * 
     */
    protected function _prepareLayout() {
        $__result = parent::_prepareLayout();
        $this->getLayout()->getBlock('head')->addCss('activitystream/status.css');
        return $__result;
    }
    
    
    /**
     * 
     */
    public function render(Varien_Data_Form_Element_Abstract $element) {
        $__html = '';
        
        try {
            $__coreResource = Mage::getSingleton('core/resource');
            $__db = $__coreResource->getConnection('admin_read');
            
            $__html .= '<p>This is a quick diagnosis section designed to help administrators to determine reasons for most common problems fast and easily.</p><br />';
            
            $__html .= '<ul class="ModuleStatus">';
            $__gotProblems = false;
            
            $__html .= '<strong class="Section">Database</strong>';
            foreach ($this->__getRequiredTablesInfo() as $__tableInfo) {
                $__gotTableProblems = false;
                try {
                    $__realTableName = $__coreResource->getTableName($__tableInfo['name']);
                }
                catch (Exception $__E) {
                    $__realTableName = null;
                }
                if ( $__realTableName ) {
                    $__R = $__db->query("SHOW TABLES LIKE '" . $__realTableName . "'")->fetchAll();
                    if ( isset($__R[0]) ) {
                        $__R = $__db->query("DESCRIBE `" . $__realTableName . "`")->fetchAll();
                        
                        $__tableColumns = & $__tableInfo['columnsInfo'];
                        if ( ! is_array($__tableColumns) ) $__tableColumns = array();
                        
                        foreach ( $__tableColumns as & $__requiredColumnInfo ) {
                            $__foundMatchingColumn = false;
                            foreach ( $__R as $__actualColumnInfo ) {
                                if ( $__actualColumnInfo['Field'] == $__requiredColumnInfo['name'] ) {
                                    $__foundMatchingColumn = true;
                                    
                                    if ( $__actualColumnInfo['Type'] != $__requiredColumnInfo['type'] ) {
                                        $__gotProblems = $__gotTableProblems = true;
                                        $__html .= '<li class="Problem"><strong title="Column type is wrong!">' . $__requiredColumnInfo['name'] . '</strong> column type is wrong (must be <strong>' . $__requiredColumnInfo['type'] . '</strong>)</li>';
                                    }
                                }
                            }
                            
                            if ( ! $__foundMatchingColumn ) {
                                $__gotProblems = $__gotTableProblems = true;
                                $__html .= '<li class="Problem"><strong title="Column is missing!">' . $__requiredColumnInfo['name'] . '</strong> column is missing</li>';
                            }
                        }
                    }
                    else {
                        $__gotProblems = $__gotTableProblems = true;
                        $__html .= '<li class="Problem"><strong title="Table is missing!">' . $__realTableName . '</strong> table doesn\'t exist</li>';
                    }
                }
                else {
                    $__gotProblems = $__gotTableProblems = true;
                    $__html .= '<li class="Problem"><strong title="Failed to fetch table name from configuration by the alias">' . $__tableInfo['name'] . '</strong> - there is no table name in the configuration for this alias</li>';
                }
                
                if ( ! $__gotTableProblems ) {
                    $__R = $__db->query("SELECT COUNT(*) as `count` FROM `" . $__coreResource->getTableName($__tableInfo['name']) . "`")->fetchAll();
                    $__count = ( isset($__R[0]) and isset($__R[0]['count']) ) ? intval($__R[0]['count']) : 0;
                    $__html .= '<li class="Good"><strong title="Table structure matches">activitystream_activity</strong> table (<strong title="Number of rows in the table">' . $__count . ' record' . ( $__count == 1 ? '' : 's' ) . '</strong>)</li>';
                }
            }
            
            $__html .= '</ul>';
            
            if ( ! $__gotProblems ) {
                $__html .= '<br /><p>No problems detected.</p>';
            }
            else {
                $__html .= '<br /><p>Module seems to have problems!</p>';
            }
        }
        catch (Exception $__E) {
            Mage::logException($__E);
        }
        
        return $__html;
    }
    
    
    /**
     *
     */
    protected function __getRequiredTablesInfo() {
        return
            array(
                array(
                    'name' => 'activitystream/activity',
                    'columnsInfo' => array(
                        array(
                            'name' => 'id',
                            'type' => 'int(11)'
                        ),
                        array(
                            'name' => 'type',
                            'type' => 'smallint(6)'
                        ),
                        array(
                            'name' => 'store_id',
                            'type' => 'smallint(6)'
                        ),
                        array(
                            'name' => 'parameter_a',
                            'type' => 'int(11)'
                        ),
                        array(
                            'name' => 'parameter_b',
                            'type' => 'int(11)'
                        ),
                        array(
                            'name' => 'creation_time',
                            'type' => 'timestamp'
                        )
                    )
                )
            )
        ;
    }
}