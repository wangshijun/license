<div class="groups index">
	<h2><?php echo __('Groups');?></h2>

	<?php echo $this->BootstrapForm->create('Group', array('url' => array_merge(array('action' => 'search'), $this->params['pass']), 'class' => 'search form-search form-inline'));?>
		<?php echo $this->BootstrapForm->input('q', array('class' => 'short', 'placeholder' => __('type to search'), 'class' => 'input-medium search-query', 'label' => false, 'div' => false)); ?>
		<?php if (is_root_tenant()): ?>
			<?php echo $this->BootstrapForm->input('tenant_id', array('validate' => 'min:1', 'label' => false, 'div' => false, 'class' => 'input-medium')); ?>
		<?php endif; ?>
		<?php echo $this->BootstrapForm->button('<i class="icon-search"></i> ' . __('Search'), array('class' => 'btn', 'div' => false));?>
		<?php echo $this->Html->link('<i class="icon-plus"></i> ' . __('Add'), array('action' => 'add'), array('class' => 'btn', 'escape' => false));?>
		<?php echo $this->Html->link('<i class="icon-trash"></i> ' . __('Recycle Bin'), array('action' => 'recycle_bin'), array('class' => 'btn', 'escape' => false));?>
		<?php echo $this->Html->link('<i class="icon-leaf"></i> ' . __('Tree View'), array('action' => 'tree'), array('class' => 'btn', 'escape' => false));?>
	<?php echo $this->BootstrapForm->end();?>

	<?php if (!empty($groups)): ?>

	<table cellpadding="0" cellspacing="0" class="groups  table table-bordered table-striped">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id');?></th>
				<th><?php echo $this->Paginator->sort('parent_id');?></th>
				<th><?php echo $this->Paginator->sort('name');?></th>
				<th><?php echo $this->Paginator->sort('gmt_modified');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		</thead>
		<tbody>
		<?php $i = 0; foreach ($groups as $group): ?>
			<tr>
				<td><?php echo h($group['Group']['id']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($group['ParentGroup']['name'], array('controller' => 'groups', 'action' => 'view', $group['ParentGroup']['id'])); ?>
				</td>
				<td><?php echo h($group['Group']['name']); ?>&nbsp;</td>
				<td><?php echo h($group['Group']['gmt_modified']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link('<i class="icon-lock"></i> ' . __('Permission'), array('action' => 'permission', $group['Group']['id']), array('escape' => false, 'class' => 'btn btn-mini')); ?>
					<?php //echo $this->Html->link('<i class="icon-eye-open"></i> ' . __('View'), array('action' => 'view', $group['Group']['id']), array('escape' => false, 'class' => 'btn btn-mini')); ?>
					<?php echo $this->Html->link('<i class="icon-edit"></i> ' . __('Edit'), array('action' => 'edit', $group['Group']['id']), array('escape' => false, 'class' => 'btn btn-mini')); ?>
					<?php echo $this->BootstrapForm->postLink('<i class="icon-trash"></i> ' . __('Delete'), array('action' => 'delete', $group['Group']['id']), array('escape' => false, 'class' => 'btn btn-mini'), __('Are you sure you want to delete # %s?', $group['Group']['id'])); ?>
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
