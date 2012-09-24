<div class="widgets form">
	<?php echo $this->BootstrapForm->create('Widget');?>
	<fieldset>
		<legend><?php echo __('Edit Widget'); ?></legend>

		<?php if (is_root_tenant()): ?>
			<?php echo $this->BootstrapForm->input('tenant_id', array('validate' => 'min:1')); ?>
		<?php endif; ?>

		<?php echo $this->BootstrapForm->input('id'); ?>
		<?php echo $this->BootstrapForm->input('category_id', array('validate' => 'required:true,min:1', 'type' => 'select', 'empty' => __('-Select Category-'), 'escape' => false)); ?>
		<?php //echo $this->BootstrapForm->input('system'); ?>
		<?php echo $this->BootstrapForm->input('name', array('validate' => 'required:true')); ?>
		<?php echo $this->BootstrapForm->input('visible'); ?>
		<?php echo $this->BootstrapForm->input('row', array('validate' => 'required:true, number:true, min:1', 'min' => 1)); ?>
		<?php echo $this->BootstrapForm->input('column', array('validate' => 'required:true, number:true', 'max' => Widget::MAX_COLUMN, 'min' => Widget::MIN_COLUMN)); ?>
		<?php echo $this->BootstrapForm->input('size', array('validate' => 'required:true, number:true')); ?>
	</fieldset>
	<?php echo $this->BootstrapForm->end(__('Submit'));?>
</div>

<?php echo $this->start('sidebar'); ?>
<?php echo 	$this->element('menu'); ?>
<?php echo $this->end(); ?>
