<?php

class MST_Ship_Helper_Data extends Mage_Core_Helper_Abstract
{
	const ALLOW_FREE_SHIPPING = 200;
	//Get shipping price base total order
	public function getShippingPrice ($totalOrder)
	{
		$total = (float) $totalOrder;
		if ( $total > self::ALLOW_FREE_SHIPPING) {
			return 0;
		} else {
			$rules = $this->getShippingRule();
			foreach ($rules as $rule) {
				if ( ($total >= (float)$rule['from']) && ($total <= (float)$rule['to']) ) {
					return (float) $rule['cost'];
				}
			}
		}
	}
	
	public function getShippingRule () 
	{
		$rules = Mage::getModel('ship/homedelivery')->getCollection()->setOrder('to_price', 'DESC');
		$ruleArr = array();
		foreach ($rules as $rule) {
			$ruleArr[] = array (
				'from' => str_replace('$', '', $rule->getFromPrice()),
				'to' => str_replace('$', '', $rule->getToPrice()),
				'cost' => str_replace('$', '', $rule->getCost()),
			);
		}
		
		return $ruleArr;
	}
}