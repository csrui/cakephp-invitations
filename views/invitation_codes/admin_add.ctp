<div class="invitation_codes form">

	<h2><?php __('Generate Invitation Codes')?></h2>


	<?php echo $this->Form->create('InvitationCode'); ?>
	
		<fieldset>
			<legend><?php __('Description') ?></legend>
			<?php 
			echo $this->Form->input('name');
			echo $this->Form->input('amount');
			?>
		</fieldset>
	
		<fieldset>
			<legend><?php __('Optional') ?></legend>
		
			<?php 
			
			echo $this->Form->input('code');
			#echo $this->Form->input('expire_date');
			
			?>
		
		</fieldset>
	
	<?php echo $this->Form->end('Generate'); ?>



</div>