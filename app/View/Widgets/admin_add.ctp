<div class="widgets form">
	<?php echo $this->BootstrapForm->create('Widget');?>
	<fieldset>
		<legend><?php echo __('Add Widget'); ?></legend>

		<?php echo $this->BootstrapForm->input('system', array('type' => 'hidden', 'value' => 0)); ?>
		<?php echo $this->BootstrapForm->input('visible', array('type' => 'hidden', 'value' => 1)); ?>

		<?php if (is_root_tenant()): ?>
			<?php echo $this->BootstrapForm->input('tenant_id', array('validate' => 'min:1')); ?>
		<?php endif; ?>

		<?php if (isset($category)): ?>
			<?php echo $this->BootstrapForm->input('category_id', array('type' => 'hidden', 'value' => $category['Category']['id'])); ?>
			<?php echo $this->BootstrapForm->input('name', array('validate' => 'required:true', 'value' => $category['Category']['name'])); ?>
		<?php else: ?>
			<?php echo $this->BootstrapForm->input('category_id', array('validate' => 'required:true,min:1', 'type' => 'select', 'empty' => __('-Select Category-'), 'escape' => false)); ?>
			<?php echo $this->BootstrapForm->input('name', array('validate' => 'required:true', 'value' => '')); ?>
		<?php endif; ?>

		<?php echo $this->BootstrapForm->input('row', array('validate' => 'required:true, number:true, min:1', 'min' => 1)); ?>
		<?php echo $this->BootstrapForm->input('column', array('validate' => 'required:true, number:true', 'value' => Widget::MIN_COLUMN, 'max' => Widget::MAX_COLUMN, 'min' => Widget::MIN_COLUMN)); ?>
		<?php echo $this->BootstrapForm->input('size', array('validate' => 'required:true, number:true', 'value' => Widget::MIN_SIZE)); ?>
	</fieldset>
	<?php echo $this->BootstrapForm->end(__('Submit'));?>
</div>

<?php echo $this->start('sidebar'); ?>
<?php echo 	$this->element('menu'); ?>
<?php echo $this->end(); ?>
