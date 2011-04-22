<?php

Class InvitationContactsController extends InvitationAppController {
	
		

	/**
	 * 
	 * Return a list with all the previously stored contacts
	 * @param string $provider_id
	 * @return mixed
	 */
	function get_list($provider_id) {
		
		$conditions = array(
			'InvitationContact.provider_id' => $provider_id,
			'InvitationContact.user_id' => $this->Account->id()
		);
		
		$this->InvitationContact->Contain();
		return $this->InvitationContact->find('all', compact('conditions'));
		
	}
	
	/**
	 * 
	 * Return a list with all the users registered with the stored emails
	 * @return mixed
	 */
	function get_user_list() {
		
		$conditions = array(
			'InvitationContact.user_id' => $this->Account->id()
		);
		
		$contacts = $this->InvitationContact->find('all', compact('conditions'));		
		
		return $contacts;
		
	}
	
	/**
	 * 
	 * Performs an import for the selected provider
	 * @param string $selected_provider
	 * @param string $login
	 * @param string $password
	 * @return bol
	 */
	function import($selected_provider, $login, $password) {

		App::import('vendor', 'OpenInviter', array('file' => 'inviter/openinviter.php'));
		$inviter = new OpenInviter();
		
		
		$inviter->startPlugin($selected_provider);
		$internal = $inviter->getInternalError();
			
		if ($internal) {
			
			$this->log($internal);
			
		} elseif (!$inviter->login($login, $password)) {
			
			$this->log($inviter->getInternalError());
			
		} elseif (false===$contacts=$inviter->getMyContacts()) {
		
			$this->log('Unable to get contacts !');
			
		}

		if ($inviter->showContacts() && !empty($contacts)) {

			return $this->InvitationContact->store($this->Account->id(), $selected_provider, $contacts);
					
		}
		
		return false;
		
	}
	
	/**
	 * 
	 * Return a list of all the available providers
	 * @return array
	 */
	function get_providers() {
		
		App::import('vendor', 'OpenInviter', array('file' => 'inviter/openinviter.php'));
		$inviter = new OpenInviter();
		
		$networks = array();
		
		foreach ($inviter->getPlugins() as $type => $providers)	{
			
			foreach ($providers as $provider => $details) {
				
				$networks[$provider] = $details['name'];
				
			}
			
		}
		
		return $networks;
				
	}	
		
}

?>