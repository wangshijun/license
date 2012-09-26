<div class="productPrices form">
	<?php echo $this->BootstrapForm->create('ProductPrice');?>
	<fieldset>
		<legend><?php echo __('Admin Edit Product Price'); ?></legend>

		<?php if (is_root_tenant()): ?>
			<?php echo $this->BootstrapForm->input('tenant_id', array('validate' => 'min:1')); ?>
		<?php endif; ?>

		<?php echo $this->BootstrapForm->input('id'); ?>
		<?php echo $this->BootstrapForm->input('product_id'); ?>
		<?php echo $this->BootstrapForm->input('price'); ?>
		<?php echo $this->BootstrapForm->input('description'); ?>
	</fieldset>
	<?php echo $this->BootstrapForm->end(__('Submit'));?>
</div>

<?php echo $this->start('sidebar'); ?>
<?php echo 	$this->element('menu'); ?>
<?php echo $this->end(); ?>
