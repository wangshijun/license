<div class="users index">
	<h2><?php echo __('Users');?></h2>

	<?php echo $this->BootstrapForm->create('User', array('url' => array_merge(array('action' => 'search', 'recycle_bin' => 1), $this->params['pass']), 'class' => 'search form-search form-inline'));?>
		<?php echo $this->BootstrapForm->input('name', array('class' => 'short', 'placeholder' => __('type to search'), 'class' => 'input-medium search-query', 'label' => false, 'div' => false)); ?>
		<?php if (is_root_tenant()): ?>
			<?php echo $this->BootstrapForm->input('tenant_id', array('validate' => 'min:1', 'label' => false, 'div' => false, 'class' => 'input-medium')); ?>
		<?php endif; ?>
		<?php echo $this->BootstrapForm->button('<i class="icon-search"></i> ' . __('Search'), array('type' => 'submit', 'class' => 'btn', 'div' => false));?>
		<?php echo $this->Html->link('<i class="icon-plus"></i> ' . __('Add'), array('action' => 'add'), array('class' => 'btn', 'escape' => false));?>
		<?php echo $this->Html->link('<i class="icon-home"></i> ' . __('Index'), array('action' => 'index'), array('class' => 'btn', 'escape' => false));?>
	<?php echo $this->BootstrapForm->end();?>

	<?php if (!empty($users)): ?>

	<table cellpadding="0" cellspacing="0" class="users  table table-bordered table-striped">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id');?></th>
				<th><?php echo $this->Paginator->sort('name');?></th>
				<th><?php echo $this->Paginator->sort('group_id');?></th>
				<th><?php echo $this->Paginator->sort('mobile');?></th>
				<th><?php echo $this->Paginator->sort('email');?></th>
				<th><?php echo $this->Paginator->sort('active');?></th>
				<th><?php echo $this->Paginator->sort('ip_last_login');?></th>
				<th><?php echo $this->Paginator->sort('gmt_last_login');?></th>
				<th><?php echo $this->Paginator->sort('gmt_deleted');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		</thead>
		<tbody>
		<?php $i = 0; foreach ($users as $user): ?>
			<tr>
				<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
				<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
				<td><?php echo h($user['Group']['name']); ?></td>
				<td><?php echo h($user['User']['mobile']); ?>&nbsp;</td>
				<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
				<td class="toggle" title="<?php echo __('Click to toggle'); ?>">
					<?php if ($user['User']['active']): ?>
						<span class="badge badge-success">
							<?php echo $this->Html->link(__('Yes'), array('action' => 'toggle', $user['User']['id'], 'active'));?>
						</span>
					<?php else: ?>
						<span class="badge badge-error">
							<?php echo $this->Html->link(__('No'), array('action' => 'toggle', $user['User']['id'], 'active'));?>
						</span>
					<?php endif; ?>
				</td>
				<td><?php echo h($user['User']['ip_last_login']); ?>&nbsp;</td>
				<td><?php echo h($user['User']['gmt_last_login']); ?>&nbsp;</td>
				<td><?php echo h($user['User']['gmt_deleted']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link('<i class="icon-repeat"></i> ' . __('Recycle'), array('action' => 'recycle', $user['User']['id']), array('escape' => false, 'class' => 'btn btn-mini')); ?>
					<?php echo $this->Html->link('<i class="icon-remove"></i> ' . __('Drop'), array('action' => 'drop', $user['User']['id']), array('escape' => false, 'class' => 'btn btn-mini')); ?>
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
<?php echo $this->element('menu'); ?>
<?php echo $this->end(); ?>
