<div class="productLicenses view">
	<h2><?php  echo __('Product License');?></h2>
	<dl>
		<dt><?php echo __('Product'); ?></dt>
		<dd><?php echo $this->Html->link($productLicense['Product']['name'], array('controller' => 'products', 'action' => 'view', $productLicense['Product']['id'])); ?>&nbsp;</dd>
		<dt><?php echo __('Product Price'); ?></dt>
		<dd><?php echo $this->Html->link($productLicense['ProductPrice']['id'], array('controller' => 'product_prices', 'action' => 'view', $productLicense['ProductPrice']['id'])); ?>&nbsp;</dd>
		<dt><?php echo __('Customer Name'); ?></dt>
		<dd><?php echo h($productLicense['ProductLicense']['customer_name']); ?>&nbsp;</dd>
		<dt><?php echo __('Customer Identifier'); ?></dt>
		<dd><?php echo h($productLicense['ProductLicense']['customer_identifier']); ?>&nbsp;</dd>
		<dt><?php echo __('License Key'); ?></dt>
		<dd><?php echo h($productLicense['ProductLicense']['license_key']); ?>&nbsp;</dd>
		<dt><?php echo __('License Date'); ?></dt>
		<dd><?php echo h($productLicense['ProductLicense']['license_date']); ?>&nbsp;</dd>
		<dt><?php echo __('License Blocked'); ?></dt>
		<dd><?php echo h($productLicense['ProductLicense']['license_blocked']); ?>&nbsp;</dd>
		<dt><?php echo __('Gmt Created'); ?></dt>
		<dd><?php echo h($productLicense['ProductLicense']['gmt_created']); ?>&nbsp;</dd>
		<dt><?php echo __('Gmt Modified'); ?></dt>
		<dd><?php echo h($productLicense['ProductLicense']['gmt_modified']); ?>&nbsp;</dd>
	</dl>

	<div class="actions">
		<?php echo $this->Html->link(__('Edit'), array('controller' => 'product_licenses', 'action' => 'edit', $productLicense['ProductLicense']['id']), array('class' => 'btn btn-large btn-primary')); ?>
		<?php echo $this->Html->link(__('Delete'), array('controller' => 'product_licenses', 'action' => 'delete', $productLicense['ProductLicense']['id']), array('class' => 'btn btn-large btn-danger delete')); ?>
	</div>

</div>

<?php echo $this->start('sidebar'); ?>
<?php echo $this->element('menu'); ?>
<?php echo $this->end(); ?>
