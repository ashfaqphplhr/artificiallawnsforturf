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


class Mirasvit_Email_Helper_Variables_Url
{
    public function getRestoreCartUrl($parent, $args)
    {
        return $this->_getUrl($parent, 'eml/index/restoreCart');
    }

    public function getViewInBrowserUrl($parent, $args)
    {
        return $this->_getUrl($parent, 'eml/index/view');
    }

    public function getUnsubscribeUrl($parent, $args)
    {
        return $this->_getUrl($parent, 'eml/index/unsubscribe');
    }

    public function getUnsubscribeAllUrl($parent, $args)
    {
        return $this->_getUrl($parent, 'eml/index/unsubscribeAll');
    }

    public function getResumeUrl($parent, $args)
    {
        $query = array();
        if (isset($args[0])) {
            $query['to'] = base64_encode($args[0]);
        }

        return $this->_getUrl($parent, 'eml/index/resume', $query);
    }

    public function getFacebookUrl($parent, $args)
    {
        return Mage::getStoreConfig('trigger_email/info/facebook_url');
    }

    public function getTwitterUrl($parent, $args)
    {
        return Mage::getStoreConfig('trigger_email/info/twitter_url');
    }

    protected function _getUrl($parent, $path, $query = array())
    {
        if ($parent->getQueue() && $parent->getStore()) {
            $arQuery = array_merge(array('code' => $parent->getQueue()->getUniqKeyMd5()), $query);
            return $parent->getStore()->getUrl($path, $arQuery);
        } else {
            return Mage::helper('email')->__('Not available in preview mode');
        }
    }
}