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


class Mirasvit_Email_Model_Trigger_Chain extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('email/trigger_chain');
    }

    public function getDays()
    {
        return intval($this->getDelay() / 60 / 60 / 24);
    }

    public function getHours()
    {
        return intval($this->getDelay() / 60 / 60) - $this->getDays() * 24;
    }

    public function getMinutes()
    {
        return intval($this->getDelay() / 60) - $this->getDays() * 24 * 60 - $this->getHours() * 60;
    }

    public function getTemplate()
    {
        $template = null;
        $info = explode(':', $this->getTemplateId());

        switch ($info[0]) {
            case 'emaildesign':
                $template = Mage::getModel('emaildesign/template')->load($info[1]);
                break;

            case 'email':
                $template = Mage::getModel('core/email_template')->load($info[1]);
                break;

            case 'newsletter':
                $template = Mage::getModel('newsletter/template')->load($info[1]);
                break;
        }

        return $template;
    }
}