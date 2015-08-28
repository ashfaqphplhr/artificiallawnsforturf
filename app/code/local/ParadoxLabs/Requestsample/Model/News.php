<?php
	class ParadoxLabs_Requestsample_Model_Requestsample extends Mage_Core_Model_Abstract
	{
		public function _construct()
		{
			parent::_construct();
			$this->_init('requestsample/requestsample');
		}
	}