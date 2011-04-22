<?php 
/* SVN FILE: $Id$ */
/* Planamatch schema generated on: 2010-06-13 15:06:12 : 1276440792*/
class PlanamatchSchema extends CakeSchema {
	var $name = 'Planamatch';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $invitation_codes = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'code' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 40),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'slug' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 150),
		'amount' => array('type' => 'integer', 'null' => false, 'default' => '1'),
		'expire_date' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
}
?>