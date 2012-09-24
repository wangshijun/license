<div class="groups form">
	<?php echo $this->BootstrapForm->create('Group');?>
	<fieldset>
		<legend><?php echo __('Edit Group'); ?></legend>
		<?php echo $this->BootstrapForm->input('id'); ?>
		<?php if (is_root_tenant()): ?>
			<?php echo $this->BootstrapForm->input('tenant_id', array('validate' => 'min:1')); ?>
		<?php endif; ?>
		<?php echo $this->BootstrapForm->input('parent_id', array('escape' => false, 'validate' => 'required:true')); ?>
		<?php echo $this->BootstrapForm->input('name', array('validate' => 'required:true')); ?>
	</fieldset>
	<?php echo $this->BootstrapForm->end(__('Submit'));?>
</div>

<?php echo $this->start('sidebar'); ?>
<?php echo 	$this->element('menu'); ?>
<?php echo $this->end(); ?>
