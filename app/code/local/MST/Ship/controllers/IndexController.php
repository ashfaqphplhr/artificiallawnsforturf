<?php
class MST_Ship_IndexController extends Mage_Core_Controller_Front_Action
{
	
	public function editHomedeliveryAction() {
		$ruleId = $_POST['rule_id'];
		if ($ruleId != "") {
			$rule = Mage::getModel('ship/homedelivery')->load($ruleId);
			echo json_encode($rule->getData());
		}
	}
	
	public function deleteHomedeliveryAction() {
		$ruleId = $_POST['rule_id'];
		if ($ruleId != "") {
			$rule = Mage::getModel('ship/homedelivery')->load($ruleId);
			$rule->delete();
		}
	}
	
	public function testAction() {
		//echo "Hi <pre>";
		//$price = Mage::helper('ship')->getShippingPrice(201);
		//print_r($price);
	}
}