<?php

Class InvitationCode extends InvitationAppModel {

	var $actsAs = array('Sluggable' => array('label' => 'name'));
	
	var $validate = array(
		'name' => array(
        	'empty' => array('rule' => 'notEmpty', 'allowEmpty' => false),
        	'unique' => array('rule' => 'isUnique', 'message' => 'Name already in use')
        ),
		'slug' => array(
        	'rule' => 'alphaNumeric',
        	'required' => false,
			'unique' => array('rule' => 'isUnique', 'message' => 'Slug is already taken')
        ),
        'expire_date' => array(
			'date' => array('rule' => 'date', 'message' => 'This is not a valid date format'),
        	'required' => false,
        	'allowEmpty' => true       	
        )
	);
	
	
	function beforeSave($options = array()) {
		
		parent::beforeSave($options);
		
		if (empty($options['fieldList'])) {
		
			if (empty($this->data['InvitationCode']['code'])) {
			
				$this->data['InvitationCode']['code'] = $this->generate();
				
			}
			
		}
		
		return true;
		
	}
	
	/**
	 * Generate a new code for saving in a new record
	 */
	private function generate() {
		
		return Security::hash($this->data['InvitationCode']['name'].$this->data['InvitationCode']['created'], 'md5', true);
		
	}
	
}

?>