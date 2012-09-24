<?php $post = ${$inflector['singular']}; ?>
<div class="<?php echo $inflector['underscore'];?> view">
	<h2><?php  echo __($inflector['camelize']);?></h2>
	<dl>
		<dt><?php echo __('Deleted'); ?></dt>
		<dd><?php echo h($post[$inflector['camelize']]['deleted']); ?>&nbsp;</dd>
		<dt><?php echo __('Author'); ?></dt>
		<dd><?php echo $this->Html->link($post['Author']['name'], array('controller' => 'users', 'action' => 'view', $post['Author']['id'])); ?>&nbsp;</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd><?php echo $this->Html->link($post['Category']['name'], array('controller' => 'categories', 'action' => 'view', $post['Category']['id'])); ?>&nbsp;</dd>
		<dt><?php echo __('Published'); ?></dt>
		<dd><?php echo h($post[$inflector['camelize']]['published']); ?>&nbsp;</dd>
		<dt><?php echo __('Click Count'); ?></dt>
		<dd><?php echo h($post[$inflector['camelize']]['click_count']); ?>&nbsp;</dd>
		<dt><?php echo __('Comment Count'); ?></dt>
		<dd><?php echo h($post[$inflector['camelize']]['comment_count']); ?>&nbsp;</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd><?php echo h($post[$inflector['camelize']]['title']); ?>&nbsp;</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd><?php echo h($post[$inflector['camelize']]['content']); ?>&nbsp;</dd>
		<dt><?php echo __('Images'); ?></dt>
		<dd><?php echo h($post[$inflector['camelize']]['images']); ?>&nbsp;</dd>
		<dt><?php echo __('Publish Date'); ?></dt>
		<dd><?php echo h($post[$inflector['camelize']]['publish_date']); ?>&nbsp;</dd>
		<dt><?php echo __('Cover'); ?></dt>
		<dd><?php echo h($post[$inflector['camelize']]['cover']); ?>&nbsp;</dd>
		<dt><?php echo __('Gmt Published'); ?></dt>
		<dd><?php echo h($post[$inflector['camelize']]['gmt_published']); ?>&nbsp;</dd>
		<dt><?php echo __('Gmt Created'); ?></dt>
		<dd><?php echo h($post[$inflector['camelize']]['gmt_created']); ?>&nbsp;</dd>
		<dt><?php echo __('Gmt Deleted'); ?></dt>
		<dd><?php echo h($post[$inflector['camelize']]['gmt_deleted']); ?>&nbsp;</dd>
		<dt><?php echo __('Gmt Modified'); ?></dt>
		<dd><?php echo h($post[$inflector['camelize']]['gmt_modified']); ?>&nbsp;</dd>
	</dl>

	<div class="actions">
		<?php echo $this->Html->link(__('Edit'), array('controller' => 'tenants', 'action' => 'edit', $tenant['Tenant']['id']), array('class' => 'btn btn-large btn-primary')) ?>
		<?php echo $this->Html->link(__('Delete'), array('controller' => 'tenants', 'action' => 'delete', $tenant['Tenant']['id']), array('class' => 'btn btn-large btn-danger delete')) ?>
	</div>
</div>

<?php echo $this->start('sidebar'); ?>
<?php echo $this->element('menu'); ?>
<?php echo $this->end(); ?>
