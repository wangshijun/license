<div class="<?php echo $inflector['underscore'];?> index">
	<h2><?php echo __($inflector['humanize']);?></h2>

	<?php echo $this->BootstrapForm->create($inflector['camelize'], array('action' => 'search', 'class' => 'search form-search form-inline'));?>
		<?php echo $this->BootstrapForm->input('title', array('class' => 'short', 'placeholder' => __('type to search'), 'class' => 'input-medium search-query', 'label' => false, 'div' => false)); ?>
		<?php if (is_root_tenant()): ?>
			<?php echo $this->BootstrapForm->input('tenant_id', array('validate' => 'min:1', 'label' => false, 'div' => false, 'class' => 'input-medium')); ?>
		<?php endif; ?>
		<?php echo $this->BootstrapForm->input('category_id', array('type' => 'select', 'empty' => __('-Select Category-'), 'selected' => isset($category_id) ? $category_id : 0, 'div' => false, 'escape' => false, 'label' => false, 'class' => 'input-medium')); ?>
		<?php echo $this->BootstrapForm->button('<i class="icon-search"></i> ' . __('Search'), array('class' => 'btn', 'div' => false));?>
		<?php echo $this->Html->link('<i class="icon-plus"></i> ' . __('Add'), array('action' => 'add'), array('class' => 'btn', 'escape' => false));?>
		<?php echo $this->Html->link('<i class="icon-trash"></i> ' . __('Recycle Bin'), array('action' => 'recycle_bin'), array('class' => 'btn', 'escape' => false));?>
	<?php echo $this->BootstrapForm->end();?>

	<?php if (!empty(${$inflector['plural']})): ?>

	<table cellpadding="0" cellspacing="0" class="<?php echo $inflector['underscore'];?> table table-bordered table-striped">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id');?></th>
				<th><?php echo $this->Paginator->sort('author_id');?></th>
				<th><?php echo $this->Paginator->sort('category_id');?></th>
				<th><?php echo $this->Paginator->sort('title');?></th>
				<th><?php echo $this->Paginator->sort('click_count');?></th>
				<th><?php echo $this->Paginator->sort('comment_count');?></th>
				<th><?php echo $this->Paginator->sort('published');?></th>
				<th><?php echo $this->Paginator->sort('publish_date');?></th>
				<th><?php echo $this->Paginator->sort('gmt_modified');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		</thead>
		<tbody>
		<?php $i = 0; foreach (${$inflector['plural']} as $post): ?>
			<tr>
				<td><?php echo h($post[$inflector['camelize']]['id']); ?>&nbsp;</td>
				<td><?php echo h($post['Author']['name']); ?>&nbsp;</td>
				<td><?php echo h($post['Category']['name']); ?>&nbsp;</td>
				<td><?php echo $this->Html->link($this->Text->truncate(h($post[$inflector['camelize']]['title']), 24), array('action' => 'view', 'preview' => true, 'admin' => false, $post[$inflector['camelize']]['id']), array('target' => '_blank', 'title' => __('View') . ': ' . h($post[$inflector['camelize']]['title']))); ?>&nbsp;</td>
				<td><?php echo h($post[$inflector['camelize']]['click_count']); ?>&nbsp;</td>
				<td><?php echo h($post[$inflector['camelize']]['comment_count']); ?>&nbsp;</td>
				<td class="toggle" title="<?php echo __('Click to toggle'); ?>">
					<?php if ($post[$inflector['camelize']]['published']): ?>
						<span class="badge badge-success">
							<?php echo $this->Html->link(__('Yes'), array('action' => 'toggle', $post[$inflector['camelize']]['id'], 'published'));?>
						</span>
					<?php else: ?>
						<span class="badge badge-error">
							<?php echo $this->Html->link(__('No'), array('action' => 'toggle', $post[$inflector['camelize']]['id'], 'published'));?>
						</span>
					<?php endif; ?>
				</td>
				<td><?php echo h($this->Text->truncate($post[$inflector['camelize']]['publish_date'], 10)); ?>&nbsp;</td>
				<td><?php echo h($post[$inflector['camelize']]['gmt_modified']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link('<i class="icon-edit"></i> ' . __('Edit'), array('action' => 'edit', $post[$inflector['camelize']]['id']), array('escape' => false, 'class' => 'btn btn-mini')); ?>
					<?php echo $this->BootstrapForm->postLink('<i class="icon-trash"></i> ' . __('Delete'), array('action' => 'delete', $post[$inflector['camelize']]['id']), array('escape' => false, 'class' => 'btn btn-mini'), __('Are you sure you want to delete # %s?', $post[$inflector['camelize']]['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

	<?php echo $this->element('paginator'); ?>

	<?php else: ?>

	<div class="alert alert-info">
		<a class="close" data-dismiss="alert">ÄÂ</a>
		<strong><?php echo __('Oops');?></strong> <?php echo __('No data found');?>
	</div>

	<?php endif; ?>

</div>

<?php echo $this->start('sidebar'); ?>
<?php echo $this->element('menu'); ?>
<?php echo $this->end(); ?>
