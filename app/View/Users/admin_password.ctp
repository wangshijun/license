<div class="users form">
	<?php echo $this->BootstrapForm->create('User');?>
	<fieldset>
		<legend><?php echo __('Change Password'); ?></legend>
		<?php echo $this->BootstrapForm->input('old', array('type' => 'password', 'value' => '', 'placeholder' => __('Please enter your old password'), 'validate' => 'required:true,minlength:6', 'label' => __('Old Password'))); ?>
		<?php echo $this->BootstrapForm->input('new', array('type' => 'password', 'value' => '', 'placeholder' => __('Please enter the new password'), 'validate' => 'required:true,minlength:6', 'label' => __('New Password'))); ?>
		<?php echo $this->BootstrapForm->input('confirm', array('type' => 'password', 'value' => '', 'placeholder' => __('Please confirm the new password'), 'validate' => 'required:true,minlength:6', 'label' => __('Confirm Password'))); ?>
	</fieldset>
	<?php echo $this->BootstrapForm->end(__('Change Password'));?>
</div>

<?php echo $this->start('sidebar'); ?>
<?php echo $this->element('menu'); ?>
<?php echo $this->end(); ?>
