<div class="products view">
	<h2><?php  echo __('Product');?></h2>
	<dl>
		<dt><?php echo __('Name'); ?></dt>
		<dd><?php echo h($product['Product']['name']); ?>&nbsp;</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd><?php echo h($product['Product']['description']); ?>&nbsp;</dd>
		<dt><?php echo __('Gmt Created'); ?></dt>
		<dd><?php echo h($product['Product']['gmt_created']); ?>&nbsp;</dd>
		<dt><?php echo __('Gmt Modified'); ?></dt>
		<dd><?php echo h($product['Product']['gmt_modified']); ?>&nbsp;</dd>
	</dl>

	<div class="actions">
		<?php echo $this->Html->link(__('Edit'), array('controller' => 'products', 'action' => 'edit', $product['Product']['id']), array('class' => 'btn btn-large btn-primary')); ?>
		<?php echo $this->Html->link(__('Delete'), array('controller' => 'products', 'action' => 'delete', $product['Product']['id']), array('class' => 'btn btn-large btn-danger delete')); ?>
	</div>

	<div class="related">
		<h3><?php echo __('Related Product Licenses');?></h3>

		<?php if (!empty($product['ProductLicense'])):?>

		<table cellpadding="0" cellspacing="0"  class="product licenses table table-bordered table-striped">
			<thead>
				<tr>
					<th><?php echo __('Id'); ?></th>
					<th><?php echo __('Tenant Id'); ?></th>
					<th><?php echo __('Deleted'); ?></th>
					<th><?php echo __('Product Id'); ?></th>
					<th><?php echo __('Product Price Id'); ?></th>
					<th><?php echo __('Customer Name'); ?></th>
					<th><?php echo __('Customer Identifier'); ?></th>
					<th><?php echo __('License Key'); ?></th>
					<th><?php echo __('License Date'); ?></th>
					<th><?php echo __('License Blocked'); ?></th>
					<th><?php echo __('Gmt Created'); ?></th>
					<th><?php echo __('Gmt Deleted'); ?></th>
					<th><?php echo __('Gmt Modified'); ?></th>
					<th class="actions"><?php echo __('Actions');?></th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; foreach ($product['ProductLicense'] as $productLicense): ?>
				<tr>
					<td><?php echo $productLicense['id'];?></td>
					<td><?php echo $productLicense['tenant_id'];?></td>
					<td><?php echo $productLicense['deleted'];?></td>
					<td><?php echo $productLicense['product_id'];?></td>
					<td><?php echo $productLicense['product_price_id'];?></td>
					<td><?php echo $productLicense['customer_name'];?></td>
					<td><?php echo $productLicense['customer_identifier'];?></td>
					<td><?php echo $productLicense['license_key'];?></td>
					<td><?php echo $productLicense['license_date'];?></td>
					<td><?php echo $productLicense['license_blocked'];?></td>
					<td><?php echo $productLicense['gmt_created'];?></td>
					<td><?php echo $productLicense['gmt_deleted'];?></td>
					<td><?php echo $productLicense['gmt_modified'];?></td>
					<td class="actions">
						<?php echo $this->Html->link(__('View'), array('controller' => 'product_licenses', 'action' => 'view', $productLicense['id'])); ?>
						<?php echo $this->Html->link(__('Edit'), array('controller' => 'product_licenses', 'action' => 'edit', $productLicense['id'])); ?>
						<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'product_licenses', 'action' => 'delete', $productLicense['id']), null, __('Are you sure you want to delete # %s?', $productLicense['id'])); ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<?php endif; ?>

		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('New Product License'), array('controller' => 'product_licenses', 'action' => 'add'));?> </li>
			</ul>
		</div>

	</div>
	
	<div class="related">
		<h3><?php echo __('Related Product Prices');?></h3>

		<?php if (!empty($product['ProductPrice'])):?>

		<table cellpadding="0" cellspacing="0"  class="product prices table table-bordered table-striped">
			<thead>
				<tr>
					<th><?php echo __('Id'); ?></th>
					<th><?php echo __('Tenant Id'); ?></th>
					<th><?php echo __('Deleted'); ?></th>
					<th><?php echo __('Product Id'); ?></th>
					<th><?php echo __('Price'); ?></th>
					<th><?php echo __('Description'); ?></th>
					<th><?php echo __('Gmt Created'); ?></th>
					<th><?php echo __('Gmt Deleted'); ?></th>
					<th><?php echo __('Gmt Modified'); ?></th>
					<th class="actions"><?php echo __('Actions');?></th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; foreach ($product['ProductPrice'] as $productPrice): ?>
				<tr>
					<td><?php echo $productPrice['id'];?></td>
					<td><?php echo $productPrice['tenant_id'];?></td>
					<td><?php echo $productPrice['deleted'];?></td>
					<td><?php echo $productPrice['product_id'];?></td>
					<td><?php echo $productPrice['price'];?></td>
					<td><?php echo $productPrice['description'];?></td>
					<td><?php echo $productPrice['gmt_created'];?></td>
					<td><?php echo $productPrice['gmt_deleted'];?></td>
					<td><?php echo $productPrice['gmt_modified'];?></td>
					<td class="actions">
						<?php echo $this->Html->link(__('View'), array('controller' => 'product_prices', 'action' => 'view', $productPrice['id'])); ?>
						<?php echo $this->Html->link(__('Edit'), array('controller' => 'product_prices', 'action' => 'edit', $productPrice['id'])); ?>
						<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'product_prices', 'action' => 'delete', $productPrice['id']), null, __('Are you sure you want to delete # %s?', $productPrice['id'])); ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<?php endif; ?>

		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('New Product Price'), array('controller' => 'product_prices', 'action' => 'add'));?> </li>
			</ul>
		</div>

	</div>
	
</div>

<?php echo $this->start('sidebar'); ?>
<?php echo $this->element('menu'); ?>
<?php echo $this->end(); ?>
