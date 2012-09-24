<div class="configs form">
	<?php echo $this->BootstrapForm->create('Config');?>
	<fieldset>
		<legend><?php echo __('Edit Config'); ?></legend>

		<?php if (is_root_tenant()): ?>
			<?php echo $this->BootstrapForm->input('tenant_id', array('validate' => 'min:1')); ?>
		<?php endif; ?>

		<?php echo $this->BootstrapForm->input('id'); ?>
		<?php echo $this->BootstrapForm->input('category', array('validate' => 'required:true')); ?>
		<?php echo $this->BootstrapForm->input('name', array('validate' => 'required:true')); ?>
		<?php echo $this->BootstrapForm->input('value', array('validate' => 'required:true')); ?>
		<?php echo $this->BootstrapForm->input('description'); ?>
		<?php echo $this->BootstrapForm->input('type'); ?>
		<?php echo $this->BootstrapForm->input('options'); ?>
	</fieldset>
	<?php echo $this->BootstrapForm->end(__('Submit'));?>
</div>

<?php echo $this->start('sidebar'); ?>
<?php echo 	$this->element('menu'); ?>
<?php echo $this->end(); ?>
