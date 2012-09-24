<div class="users form">
	<?php echo $this->BootstrapForm->create('User');?>
	<fieldset>
		<legend><?php echo __('Edit User Profile'); ?></legend>
		<?php echo $this->BootstrapForm->input('User.id'); ?>
		<?php echo $this->BootstrapForm->input('User.mobile'); ?>
		<?php echo $this->BootstrapForm->input('User.email'); ?>
		<?php echo $this->BootstrapForm->input('UserProfile.id'); ?>
		<?php echo $this->BootstrapForm->input('UserProfile.gender', array('type' => 'select', 'selected' => $this->BootstrapForm->request->data['UserProfile']['gender'])); ?>
		<?php echo $this->BootstrapForm->input('UserProfile.address'); ?>
		<?php echo $this->BootstrapForm->input('UserProfile.job'); ?>
		<?php echo $this->BootstrapForm->input('UserProfile.memo', array('type' => 'textarea')); ?>
	</fieldset>
	<?php echo $this->BootstrapForm->end(__('Submit'));?>
</div>

<?php echo $this->start('sidebar'); ?>
<?php echo 	$this->element('menu'); ?>
<?php echo $this->end(); ?>
