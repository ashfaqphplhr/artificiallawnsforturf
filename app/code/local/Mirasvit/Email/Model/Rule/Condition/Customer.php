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


class Mirasvit_Email_Model_Rule_Condition_Customer extends Mirasvit_Email_Model_Rule_Condition_Abstract
{
    public function loadAttributeOptions()
    {
        $attributes = array(
            'group_id'        => Mage::helper('email')->__('Customer: Group'),
            'lifetime_sales'  => Mage::helper('email')->__('Customer: Lifetime Sales'),
            'is_subscriber'   => Mage::helper('email')->__('Customer: Is subscriber of newsletter'),
            'reviews_count'   => Mage::helper('email')->__('Customer: Number of reviews'),
        );

        asort($attributes);
        $this->setAttributeOption($attributes);

        return $this;
    }

    public function getInputType()
    {
        $type = 'string';

        switch ($this->getAttribute()) {
            case 'group_id':
                $type = 'multiselect';
            break;

            case 'is_subscriber':
                $type = 'select';
            break;
        }

        return $type;
    }

    public function getValueElementType()
    {
        $type = 'text';

        switch ($this->getAttribute()) {
            case 'group_id':
                $type = 'multiselect';
            break;

            case 'is_subscriber':
                $type = 'select';
            break;
        }

        return $type;
    }

    protected function _prepareValueOptions()
    {
        $selectOptions = array();

        if ($this->getAttribute() === 'group_id') {
            $selectOptions = Mage::helper('customer')->getGroups()->toOptionArray();

            array_unshift($selectOptions, array('value' => 0, 'label' => Mage::helper('email')->__('Not registered')));
        }

        if ($this->getAttribute() === 'is_subscriber') {
            $selectOptions = array(
                array('value' => 0, 'label' => Mage::helper('email')->__('No')),
                array('value' => 1, 'label' => Mage::helper('email')->__('Yes')),
            );
        }
        
        $this->setData('value_select_options', $selectOptions);

        $hashedOptions = array();
        foreach ($selectOptions as $o) {
            $hashedOptions[$o['value']] = $o['label'];
        }
        $this->setData('value_option', $hashedOptions);

        return $this;
    }

    public function validate(Varien_Object $object)
    {
        $attrCode = $this->getAttribute();

        if ($object->getData('customer_id')) {
            $customer = Mage::getModel('customer/customer')->load($object->getData('customer_id'));
            $subscriber = Mage::getModel('newsletter/subscriber')->loadByEmail($customer->getEmail());

            $reviews = Mage::getModel('review/review')->getCollection()
                ->addFieldToFilter('customer_id', $customer->getId());
            $reviewsCount = $reviews->count();


            $customerTotals = Mage::getResourceModel('sales/sale_collection')
                ->setCustomerFilter($customer)
                ->setOrderStateFilter(Mage_Sales_Model_Order::STATE_CANCELED, true)
                ->load()
                ->getTotals();
            $lifetimeSales = floatval($customerTotals['lifetime']);

            $object->setData('group_id', $customer->getGroupId())
                ->setData('is_subscriber', $subscriber->getId() ? 1 : 0)
                ->setData('reviews_count', $reviewsCount)
                ->setData('lifetime_sales', $lifetimeSales);
        } else {
            $object->setData('group_id', 1)
                ->setData('is_subscriber', 0)
                ->setData('reviews_count', 0)
                ->setData('lifetime_sales', 0);
        }

        $value = $object->getData($attrCode);

        return $this->validateAttribute($value);
    }
}
