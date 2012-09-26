<div class="productLicenses form">
	<?php echo $this->BootstrapForm->create('ProductLicense');?>
	<fieldset>
		<legend><?php echo __('Admin Add Product License'); ?></legend>

		<?php if (is_root_tenant()): ?>
			<?php echo $this->BootstrapForm->input('tenant_id', array('validate' => 'min:1')); ?>
		<?php endif; ?>

		<?php echo $this->BootstrapForm->input('product_id'); ?>
		<?php echo $this->BootstrapForm->input('product_price_id'); ?>
		<?php echo $this->BootstrapForm->input('customer_name'); ?>
		<?php echo $this->BootstrapForm->input('customer_identifier'); ?>
		<?php echo $this->BootstrapForm->input('license_key'); ?>
		<?php echo $this->BootstrapForm->input('license_date'); ?>
		<?php echo $this->BootstrapForm->input('license_blocked'); ?>
	</fieldset>
	<?php echo $this->BootstrapForm->end(__('Submit'));?>
</div>

<?php echo $this->start('sidebar'); ?>
<?php echo 	$this->element('menu'); ?>
<?php echo $this->end(); ?>
