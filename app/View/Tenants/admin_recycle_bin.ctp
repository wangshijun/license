<div class="tenants index">
	<h2><?php echo __('Tenants');?></h2>

	<?php echo $this->BootstrapForm->create('Tenant', array('url' => array_merge(array('action' => 'search', 'recycle_bin' => 1), $this->params['pass']), 'class' => 'search form-search form-inline'));?>
		<?php echo $this->BootstrapForm->input('q', array('class' => 'short', 'placeholder' => __('type to search'), 'class' => 'input-large search-query', 'label' => false, 'div' => false)); ?>
		<?php echo $this->BootstrapForm->button('<i class="icon-search"></i> ' . __('Search'), array('class' => 'btn', 'div' => false));?>
		<?php echo $this->Html->link('<i class="icon-plus"></i> ' . __('Add'), array('action' => 'add'), array('class' => 'btn', 'escape' => false));?>
		<?php echo $this->Html->link('<i class="icon-home"></i> ' . __('Index'), array('action' => 'index'), array('class' => 'btn', 'escape' => false));?>
	<?php echo $this->BootstrapForm->end();?>

	<?php if (!empty($_tenants)): ?>

	<table cellpadding="0" cellspacing="0" class="tenants  table table-bordered table-striped">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id');?></th>
				<th><?php echo $this->Paginator->sort('name');?></th>
				<th><?php echo $this->Paginator->sort('domain');?></th>
				<th><?php echo $this->Paginator->sort('memo');?></th>
				<th><?php echo $this->Paginator->sort('active');?></th>
				<th><?php echo $this->Paginator->sort('gmt_deleted');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		</thead>
		<tbody>
		<?php $i = 0; foreach ($_tenants as $tenant): ?>
			<tr>
				<td><?php echo h($tenant['Tenant']['id']); ?>&nbsp;</td>
				<td><?php echo h($tenant['Tenant']['name']); ?>&nbsp;</td>
				<td><?php echo h($tenant['Tenant']['domain']); ?>&nbsp;</td>
				<td><?php echo h($tenant['Tenant']['gmt_deleted']); ?>&nbsp;</td>
				<td class="toggle" title="<?php echo __('Click to toggle'); ?>">
					<?php if ($tenant['Tenant']['active']): ?>
						<span class="badge badge-success">
							<?php echo $this->Html->link(__('Yes'), array('action' => 'toggle', $tenant['Tenant']['id'], 'active'));?>
						</span>
					<?php else: ?>
						<span class="badge badge-error">
							<?php echo $this->Html->link(__('No'), array('action' => 'toggle', $tenant['Tenant']['id'], 'active'));?>
						</span>
					<?php endif; ?>
				</td>
				<td><?php echo h($tenant['Tenant']['gmt_modified']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link('<i class="icon-repeat"></i> ' . __('Recycle'), array('action' => 'recycle', $tenant['Tenant']['id']), array('escape' => false, 'class' => 'btn btn-mini')); ?>
					<?php echo $this->Html->link('<i class="icon-remove"></i> ' . __('Drop'), array('action' => 'drop', $tenant['Tenant']['id']), array('escape' => false, 'class' => 'btn btn-mini')); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

	<?php echo $this->element('paginator'); ?>

	<?php else: ?>

	<div class="alert alert-info">
		<a class="close" data-dismiss="alert">×</a>
		<strong><?php echo __('Oops');?></strong> <?php echo __('No data found');?>
	</div>

	<?php endif; ?>

</div>

<?php echo $this->start('sidebar'); ?>
<?php echo 	$this->element('menu'); ?>
<?php echo $this->end(); ?>
