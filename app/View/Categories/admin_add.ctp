<div class="<?php echo $inflector['underscore'];?> form">
	<?php echo $this->BootstrapForm->create($inflector['camelize']);?>
	<fieldset>
		<legend><?php echo __('Add ' . $inflector['shumanize']); ?></legend>

		<?php if (is_root_tenant()): ?>
			<?php echo $this->BootstrapForm->input('tenant_id', array('validate' => 'min:1')); ?>
		<?php endif; ?>

		<?php if ($simpleCategory): ?>
			<?php echo $this->BootstrapForm->hidden('parent_id', array('value' => 0)); ?>
		<?php else: ?>
			<?php echo $this->BootstrapForm->input('parent_id', array('escape' => false, 'validate' => 'required:true', 'empty' => __('-Select Category-'))); ?>
		<?php endif; ?>
		<?php echo $this->BootstrapForm->input('name', array('validate' => 'required:true')); ?>
		<?php echo $this->BootstrapForm->input('alias'); ?>
	</fieldset>
	<?php echo $this->BootstrapForm->end(__('Submit'));?>
</div>

<?php echo $this->start('sidebar'); ?>
<?php echo 	$this->element('menu'); ?>
<?php echo $this->end(); ?>
