<?php

Class InvitationContact extends InvitationAppModel {
	
	var $hasOne = array(
		'UacUser' => array(
			'className' => 'Uac.UacUser', 
			'foreignKey' => false,
			'conditions' => array('UacUser.email = InvitationContact.email', 'UacUser.active' => '1'),
			'type' => 'inner'
		)
	);
	
	/**
	 * 
	 * Stores Contacts imported in table
	 * @param int $user_id
	 * @param string $provider_id
	 * @param array $contacts
	 * @return bool
	 */
	function store($user_id, $provider_id, $contacts) {
		
		if (empty($contacts)) return null;
		
		# REMOVE OLD IMPORT 
		
		$conditions = array(
			'InvitationContact.provider_id' => $provider_id,
			'InvitationContact.user_id' => $user_id
		);
		
		$this->deleteAll($conditions);
		
		# PREPARE THE NEW
		
		$data = array();
		
		foreach($contacts as $email => $name) {
			
			$data[$this->name][] = array(
				'user_id' => $user_id,
				'provider_id' => $provider_id,
				'name' => $name,
				'email' => $email
			);
			
		}
		
		return $this->saveAll($data[$this->name]);
		
	}
	
}

?>