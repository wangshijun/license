<div class="tenants form">
	<?php echo $this->BootstrapForm->create('Tenant');?>
	<fieldset>
		<legend><?php echo __('Edit Tenant'); ?></legend>
		<?php echo $this->BootstrapForm->input('id'); ?>
		<?php echo $this->BootstrapForm->input('active'); ?>
		<?php echo $this->BootstrapForm->input('name', array('validate' => 'required:true')); ?>
		<?php echo $this->BootstrapForm->input('domain', array('validate' => 'required:true')); ?>
		<?php echo $this->BootstrapForm->input('memo'); ?>
	</fieldset>
	<?php echo $this->BootstrapForm->end(__('Submit'));?>
</div>

<?php echo $this->start('sidebar'); ?>
<?php echo 	$this->element('menu'); ?>
<?php echo $this->end(); ?>
