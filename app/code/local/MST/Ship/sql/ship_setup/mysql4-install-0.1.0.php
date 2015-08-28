<?php

$installer = $this;

$installer->startSetup();

$installer->run("
	CREATE TABLE IF NOT EXISTS  {$this->getTable('mst_shipping')}(
		id int(11) unsigned NOT NULL AUTO_INCREMENT,
		from_price varchar(500) NOT NULL,
		to_price varchar(500) NOT NULL,
		cost varchar(500) NOT NULL,
		PRIMARY KEY (id)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->endSetup(); 