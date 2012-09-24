<div class="configs view">
	<h2><?php  echo __('Config');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd><?php echo h($config['Config']['id']); ?>&nbsp;</dd>
		<dt><?php echo __('Tenant'); ?></dt>
		<dd><?php echo $this->Html->link($config['Tenant']['name'], array('controller' => 'tenants', 'action' => 'view', $config['Tenant']['id'])); ?>&nbsp;</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd><?php echo h($config['Config']['category']); ?>&nbsp;</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd><?php echo h($config['Config']['name']); ?>&nbsp;</dd>
		<dt><?php echo __('Value'); ?></dt>
		<dd><?php echo h($config['Config']['value']); ?>&nbsp;</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd><?php echo h($config['Config']['description']); ?>&nbsp;</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd><?php echo h($config['Config']['type']); ?>&nbsp;</dd>
		<dt><?php echo __('Options'); ?></dt>
		<dd><?php echo h($config['Config']['options']); ?>&nbsp;</dd>
		<dt><?php echo __('Gmt Created'); ?></dt>
		<dd><?php echo h($config['Config']['gmt_created']); ?>&nbsp;</dd>
		<dt><?php echo __('Gmt Deleted'); ?></dt>
		<dd><?php echo h($config['Config']['gmt_deleted']); ?>&nbsp;</dd>
		<dt><?php echo __('Gmt Modified'); ?></dt>
		<dd><?php echo h($config['Config']['gmt_modified']); ?>&nbsp;</dd>
	</dl>
</div>

<?php echo $this->element('menu'); ?>
