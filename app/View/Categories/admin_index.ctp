<!-- TODO: Implement category add in modal window -->
<div class="<?php echo $inflector['underscore'];?> index">
	<h2><?php echo __($inflector['humanize']);?></h2>

	<?php echo $this->BootstrapForm->create($inflector['camelize'], array('url' => array_merge(array('action' => 'search', 'recycle_bin' => 1), $this->params['pass']), 'class' => 'search form-search form-inline'));?>
		<?php echo $this->BootstrapForm->input('name', array('class' => 'short', 'placeholder' => __('type to search'), 'class' => 'input-medium search-query', 'label' => false, 'div' => false)); ?>
		<?php if (is_root_tenant()): ?>
			<?php echo $this->BootstrapForm->input('tenant_id', array('validate' => 'min:1', 'label' => false, 'div' => false, 'class' => 'input-medium')); ?>
		<?php endif; ?>
		<?php echo $this->BootstrapForm->button('<i class="icon-search"></i> ' . __('Search'), array('class' => 'btn', 'div' => false));?>
		<?php echo $this->Html->link('<i class="icon-plus"></i> ' . __('Add'), array('action' => 'add'), array('class' => 'btn', 'escape' => false));?>
		<?php echo $this->Html->link('<i class="icon-trash"></i> ' . __('Recycle Bin'), array('action' => 'recycle_bin'), array('class' => 'btn', 'escape' => false));?>
		<?php if (!$simpleCategory): ?>
			<?php echo $this->Html->link('<i class="icon-leaf"></i> ' . __('Tree View'), array('action' => 'tree'), array('class' => 'btn', 'escape' => false));?>
		<?php endif; ?>
	<?php echo $this->BootstrapForm->end();?>

	<?php if (!empty(${$inflector['plural']})): ?>

	<table cellpadding="0" cellspacing="0" class="<?php echo $inflector['underscore'];?>  table table-bordered table-striped">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id');?></th>
				<th><?php echo $this->Paginator->sort('name');?></th>
				<?php if (!$simpleCategory): ?>
				<th><?php echo $this->Paginator->sort('parent_id');?></th>
				<?php endif; ?>
				<th><?php echo $this->Paginator->sort('alias');?></th>
				<th><?php echo $this->Paginator->sort('gmt_modified');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		</thead>
		<tbody>
		<?php $i = 0; foreach (${$inflector['plural']} as $category): ?>
			<tr>
				<td><?php echo h($category[$inflector['camelize']]['id']); ?>&nbsp;</td>
				<td><?php echo h($category[$inflector['camelize']]['name']); ?>&nbsp;</td>
				<?php if (!$simpleCategory): ?>
				<td><?php echo h($category['ParentCategory']['name']); ?>&nbsp;</td>
				<?php endif; ?>
				<td><?php echo h($category[$inflector['camelize']]['alias']); ?>&nbsp;</td>
				<td><?php echo h($category[$inflector['camelize']]['gmt_modified']); ?>&nbsp;</td>
				<td class="actions">
					<?php if (!$simpleCategory): ?>
						<a href="javascript:void(0)" class="btn btn-mini add" id="<?php echo $category[$inflector['camelize']]['id'];?>"><i class="icon-plus"></i>&nbsp;<?php echo __('Add Child'); ?></a>
					<?php endif; ?>
					<?php if (!$simpleCategory): ?>
						<?php echo $this->Html->link('<i class="icon-th-large"></i> ' . __('Set Widget'), array('controller' => 'widgets', 'action' => 'add', 'category_id' => $category[$inflector['camelize']]['id']), array('escape' => false, 'class' => 'btn btn-mini')); ?>
					<?php endif; ?>
					<?php echo $this->Html->link('<i class="icon-edit"></i> ' . __('Edit'), array('action' => 'edit', $category[$inflector['camelize']]['id']), array('escape' => false, 'class' => 'btn btn-mini')); ?>
					<?php echo $this->BootstrapForm->postLink('<i class="icon-trash"></i> ' . __('Delete'), array('action' => 'delete', $category[$inflector['camelize']]['id']), array('escape' => false, 'class' => 'btn btn-mini'), __('Are you sure you want to delete # %s?', $category[$inflector['camelize']]['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

	<?php echo $this->element('paginator'); ?>

	<!-- 添加孩子 -->
	<div class="categories <?php echo $inflector['underscore'];?> form hide modal fade" id="add-dialog">
		<?php echo $this->BootstrapForm->create($inflector['camelize'], array('action' => 'add'));?>
		<div class="modal-header">
			<button class="close" data-dismiss="modal">×</button>
			<h3><?php echo __('Add ' . $inflector['camelize']); ?></h3>
		</div>
		<div class="modal-body">
			<fieldset>
				<?php if (is_root_tenant()): ?>
					<?php echo $this->BootstrapForm->input('tenant_id', array('validate' => 'min:1')); ?>
				<?php endif; ?>

				<?php if ($simpleCategory): ?>
					<?php echo $this->BootstrapForm->hidden('parent_id', array('value' => 0)); ?>
				<?php else: ?>
					<?php echo $this->BootstrapForm->input('parent_id', array('escape' => false, 'validate' => 'required:true')); ?>
				<?php endif; ?>

				<?php echo $this->BootstrapForm->input('name'); ?>
				<?php echo $this->BootstrapForm->input('alias'); ?>
			</fieldset>
		</div>
		<div class="modal-footer">
			<a href="javascript:void(0)" class="btn cancel"><?php echo __('Close');?></a>
			<?php echo $this->BootstrapForm->submit(__('Submit'), array('div' => false, 'class' => 'btn btn-primary'));?>
		</div>
	</div>

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

<?php $this->Html->scriptStart(array('inline' => false)); ?>
$(function(){
	var url = '<?php echo Router::url(array('controller' => $inflector['underscore'], 'action' => 'view'));?>' + '/';
	var add_form = $('#add-dialog form'), add_dialog = $('#add-dialog');

	$('a.add').click(function () {
		var category_id = $(this).attr('id');
		$.getJSON(url + category_id + '.json', create_add_dialog);
	});

	function create_add_dialog(data) {
		console.log(data);
		add_form.find('#<?php echo $inflector['camelize'];?>ParentId').val(data.<?php echo $inflector['camelize'];?>.id);
		add_form.find('#<?php echo $inflector['camelize'];?>TenantId').val(data.<?php echo $inflector['camelize'];?>.tenant_id);
		add_dialog.modal('show').find('a.cancel').click(function(){
			add_dialog.modal('hide');
		});
	}

});
<?php $this->Html->scriptEnd(); ?>