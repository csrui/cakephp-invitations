<?php

class InvitationCodesController extends InvitationAppController {

	var $scaffold = 'admin';
	
	function admin_add() {
		
		if (!empty($this->data)) {
			
			$this->InvitationCode->create($this->data);
			if ($this->InvitationCode->save($this->data)) {
				
				$this->Session->setFlash(__('New Invitation codes generated', true));
				$this->redirect(array('action' => 'index'));
				
			}
			
		}
		
	}
	
}

?>