<div class="widgets index">
	<h2><?php echo __('Widgets');?></h2>

	<?php echo $this->BootstrapForm->create('Widget', array('url' => array_merge(array('action' => 'search'), $this->params['pass']), 'class' => 'search form-search form-inline'));?>
		<?php echo $this->BootstrapForm->input('name', array('class' => 'short', 'placeholder' => __('type to search'), 'class' => 'input-medium search-query', 'label' => false, 'div' => false)); ?>
		<?php if (is_root_tenant()): ?>
			<?php echo $this->BootstrapForm->input('tenant_id', array('validate' => 'min:1', 'label' => false, 'div' => false, 'class' => 'input-medium')); ?>
		<?php endif; ?>
		<?php echo $this->BootstrapForm->button('<i class="icon-search"></i> ' . __('Search'), array('class' => 'btn', 'div' => false));?>
		<?php echo $this->Html->link('<i class="icon-plus"></i> ' . __('Add'), array('action' => 'add'), array('class' => 'btn', 'escape' => false));?>
		<?php echo $this->Html->link('<i class="icon-home"></i> ' . __('Index'), array('action' => 'index'), array('class' => 'btn', 'escape' => false));?>
	<?php echo $this->BootstrapForm->end();?>

	<?php if (!empty($widgets)): ?>

	<table cellpadding="0" cellspacing="0" class="widgets table table-bordered table-striped">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id');?></th>
				<th><?php echo $this->Paginator->sort('category_id');?></th>
				<th><?php echo $this->Paginator->sort('name');?></th>
				<th><?php echo $this->Paginator->sort('visible');?></th>
				<th><?php echo $this->Paginator->sort('row');?></th>
				<th><?php echo $this->Paginator->sort('column');?></th>
				<th><?php echo $this->Paginator->sort('size');?></th>
				<th><?php echo $this->Paginator->sort('gmt_deleted');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		</thead>
		<tbody>
		<?php $i = 0; foreach ($widgets as $widget): ?>
			<tr>
				<td><?php echo h($widget['Widget']['id']); ?>&nbsp;</td>
				<td><?php echo h($widget['Widget']['category_id']); ?>&nbsp;</td>
				<td><?php echo h($widget['Widget']['name']); ?>&nbsp;</td>
				<td class="toggle" title="<?php echo __('Click to toggle'); ?>">
					<?php if ($widget['Widget']['visible']): ?>
						<span class="badge badge-success">
							<?php echo $this->Html->link(__('Yes'), array('action' => 'toggle', $widget['Widget']['id'], 'visible'));?>
						</span>
					<?php else: ?>
						<span class="badge badge-error">
							<?php echo $this->Html->link(__('No'), array('action' => 'toggle', $widget['Widget']['id'], 'visible'));?>
						</span>
					<?php endif; ?>
				</td>
				<td><?php echo h($widget['Widget']['row']); ?>&nbsp;</td>
				<td><?php echo h($widget['Widget']['column']); ?>&nbsp;</td>
				<td><?php echo h($widget['Widget']['size']); ?>&nbsp;</td>
				<td><?php echo h($widget['Widget']['gmt_deleted']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link('<i class="icon-repeat"></i> ' . __('Recycle'), array('action' => 'recycle', $widget['Widget']['id']), array('escape' => false, 'class' => 'btn btn-mini')); ?>
					<?php echo $this->Html->link('<i class="icon-remove"></i> ' . __('Drop'), array('action' => 'drop', $widget['Widget']['id']), array('escape' => false, 'class' => 'btn btn-mini')); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

		<?php echo $this->element('paginator'); ?>

	<?php else: ?>

	<div class="alert alert-info">
		<a class="close" data-dismiss="alert">x</a>
		<strong><?php echo __('Oops');?></strong> <?php echo __('No data found');?>
	</div>

	<?php endif; ?>

</div>

<?php echo $this->start('sidebar'); ?>
<?php echo $this->element('menu'); ?>
<?php echo $this->end(); ?>
