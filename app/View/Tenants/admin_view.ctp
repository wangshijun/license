<div class="tenants view">
	<h2><?php  echo __('Tenant');?></h2>
	<dl>
		<dt><?php echo __('Deleted'); ?></dt>
		<dd><?php echo h($tenant['Tenant']['deleted'] ? __('Yes') : __('No')); ?>&nbsp;</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd><?php echo h($tenant['Tenant']['active'] ? __('Yes') : __('No')); ?>&nbsp;</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd><?php echo h($tenant['Tenant']['name']); ?>&nbsp;</dd>
		<dt><?php echo __('Domain'); ?></dt>
		<dd><?php echo h($tenant['Tenant']['domain']); ?>&nbsp;</dd>
		<dt><?php echo __('Memo'); ?></dt>
		<dd><?php echo h($tenant['Tenant']['memo']); ?>&nbsp;</dd>
		<dt><?php echo __('Gmt Created'); ?></dt>
		<dd><?php echo h($tenant['Tenant']['gmt_created']); ?>&nbsp;</dd>
		<dt><?php echo __('Gmt Deleted'); ?></dt>
		<dd><?php echo h($tenant['Tenant']['gmt_deleted']); ?>&nbsp;</dd>
		<dt><?php echo __('Gmt Modified'); ?></dt>
		<dd><?php echo h($tenant['Tenant']['gmt_modified']); ?>&nbsp;</dd>
	</dl>

	<div class="actions">
		<?php echo $this->Html->link(__('Edit'), array('controller' => 'tenants', 'action' => 'edit', $tenant['Tenant']['id']), array('class' => 'btn btn-large btn-primary')) ?>
		<?php echo $this->Html->link(__('Delete'), array('controller' => 'tenants', 'action' => 'delete', $tenant['Tenant']['id']), array('class' => 'btn btn-large btn-danger delete')) ?>
	</div>
</div>

<?php echo $this->start('sidebar'); ?>
<?php echo $this->element('menu'); ?>
<?php echo $this->end(); ?>

