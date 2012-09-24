<div class="<?php echo $inflector['underscore'];?> index">
	<h2><?php echo __($inflector['humanize']);?></h2>

	<?php echo $this->BootstrapForm->create($inflector['camelize'], array('url' => array_merge(array('action' => 'search', 'recycle_bin' => 1), $this->params['pass']), 'class' => 'search form-search form-inline'));?>
		<?php echo $this->BootstrapForm->input('name', array('class' => 'short', 'placeholder' => __('type to search'), 'class' => 'input-medium search-query', 'label' => false, 'div' => false)); ?>
		<?php if (is_root_tenant()): ?>
			<?php echo $this->BootstrapForm->input('tenant_id', array('validate' => 'min:1', 'label' => false, 'div' => false, 'class' => 'input-medium')); ?>
		<?php endif; ?>
		<?php echo $this->BootstrapForm->button('<i class="icon-search"></i> ' . __('Search'), array('class' => 'btn', 'div' => false));?>
		<?php echo $this->Html->link('<i class="icon-plus"></i> ' . __('Add'), array('action' => 'add'), array('class' => 'btn', 'escape' => false));?>
		<?php echo $this->Html->link('<i class="icon-home"></i> ' . __('Index'), array('action' => 'index'), array('class' => 'btn', 'escape' => false));?>
	<?php echo $this->BootstrapForm->end();?>

	<?php if (!empty(${$inflector['plural']})): ?>

	<table cellpadding="0" cellspacing="0" class="<?php echo $inflector['underscore'];?>  table table-bordered table-striped">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id');?></th>
				<?php if (!$simpleCategory): ?>
				<th><?php echo $this->Paginator->sort('parent_id');?></th>
				<?php endif; ?>
				<th><?php echo $this->Paginator->sort('name');?></th>
				<th><?php echo $this->Paginator->sort('alias');?></th>
				<th><?php echo $this->Paginator->sort('gmt_deleted');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		</thead>
		<tbody>
		<?php $i = 0; foreach (${$inflector['plural']} as $category): ?>
			<tr>
				<td><?php echo h($category[$inflector['camelize']]['id']); ?>&nbsp;</td>
				<?php if (!$simpleCategory): ?>
				<td><?php echo h($category['ParentCategory']['name']); ?>&nbsp;</td>
				<?php endif; ?>
				<td><?php echo h($category[$inflector['camelize']]['name']); ?>&nbsp;</td>
				<td><?php echo h($category[$inflector['camelize']]['alias']); ?>&nbsp;</td>
				<td><?php echo h($category[$inflector['camelize']]['gmt_deleted']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link('<i class="icon-repeat"></i> ' . __('Recycle'), array('action' => 'recycle', $category[$inflector['camelize']]['id']), array('escape' => false, 'class' => 'btn btn-mini')); ?>
					<?php echo $this->Html->link('<i class="icon-remove"></i> ' . __('Drop'), array('action' => 'drop', $category[$inflector['camelize']]['id']), array('escape' => false, 'class' => 'btn btn-mini')); ?>
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
