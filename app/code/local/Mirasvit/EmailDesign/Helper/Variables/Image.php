<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at http://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   Follow Up Email
 * @version   1.0.2
 * @revision  269
 * @copyright Copyright (C) 2014 Mirasvit (http://mirasvit.com/)
 */


class Mirasvit_EmailDesign_Helper_Variables_Image
{
    public function getImageUrl($parent, $args)
    {
        return $this->_getImageUrl('image', $args);   
    }

    public function getThumbnailUrl($parent, $args)
    {
        return $this->_getImageUrl('image', $args);   
    }

    public function getSmallImageUrl($parent, $args)
    {
        return $this->_getImageUrl('image', $args);   
    }

    protected function _getImageUrl($type, $args)
    {
        if (isset($args[0]) && is_object($args[0]) && $args[0] instanceof Mage_Catalog_Model_Product) {
            $product = $args[0];
            $product = Mage::getModel('catalog/product')->load($product->getId());

            $url = Mage::helper('catalog/image')
                ->init($product, $type);

            if (isset($args[1]) && intval($args[1]) > 0) {
                $url = $url->resize(intval($args[1]));
            }
            
            return $url->__toString();
        }
    }
}
?>