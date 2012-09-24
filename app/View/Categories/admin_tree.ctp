<!-- TODO: tidy up the messy tree view -->
<div class="<?php echo $inflector['underscore'];?> index">
	<h2><?php echo __($inflector['humanize']);?></h2>

	<?php echo $this->BootstrapForm->create($inflector['camelize'], array('url' => array_merge(array('action' => 'search'), $this->params['pass']), 'class' => 'search form-search form-inline'));?>
		<?php echo $this->BootstrapForm->input('name', array('class' => 'short', 'placeholder' => __('type to search'), 'class' => 'input-medium search-query', 'label' => false, 'div' => false)); ?>
		<?php if (is_root_tenant()): ?>
			<?php echo $this->BootstrapForm->input('tenant_id', array('validate' => 'min:1', 'label' => false, 'div' => false, 'class' => 'input-medium')); ?>
		<?php endif; ?>
		<?php echo $this->BootstrapForm->button('<i class="icon-search"></i> ' . __('Search'), array('class' => 'btn', 'div' => false));?>
		<?php echo $this->Html->link('<i class="icon-plus"></i> ' . __('Add'), array('action' => 'add'), array('class' => 'btn', 'escape' => false));?>
		<?php echo $this->Html->link('<i class="icon-th-list"></i> ' . __('List View'), array('action' => 'index'), array('class' => 'btn', 'escape' => false));?>
	<?php echo $this->BootstrapForm->end();?>

	<?php if (!empty(${$inflector['plural']})): ?>

	<!-- 类目树 -->
	<?php echo $this->element('categories.admin', array('inflector' => $inflector, 'categories' => ${$inflector['plural']}));?>

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

				<?php echo $this->BootstrapForm->input('parent_id', array('escape' => false, 'empty' => __('-Select Category-'))); ?>
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