<div class="users form">
	<?php echo $this->BootstrapForm->create('User');?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
		<?php if (is_root_tenant()): ?>
			<?php echo $this->BootstrapForm->input('tenant_id', array('validate' => 'min:1')); ?>
		<?php endif; ?>
		<?php echo $this->BootstrapForm->input('group_id', array('escape' => false, 'validate' => 'required:true')); ?>
		<?php echo $this->BootstrapForm->input('name', array('validate' => 'required:true')); ?>
		<?php echo $this->BootstrapForm->input('password', array('validate' => 'required:true')); ?>
		<?php echo $this->BootstrapForm->input('mobile', array('validate' => 'required:true,number:true')); ?>
		<?php echo $this->BootstrapForm->input('email', array('validate' => 'required:true,email:true')); ?>
	</fieldset>
	<?php echo $this->BootstrapForm->end(__('Submit'));?>
</div>

<?php echo $this->start('sidebar'); ?>
<?php echo 	$this->element('menu'); ?>
<?php echo $this->end(); ?>
