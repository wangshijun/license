<div class="groups view">
	<h2><?php  echo __('Group');?></h2>
	<dl>
		<dt><?php echo __('Parent Group'); ?></dt>
		<dd><?php echo h($group['ParentGroup']['name']); ?>&nbsp;</dd>
		<dt><?php echo __('Deleted'); ?></dt>
		<dd><?php echo h($group['Group']['deleted'] ? __('Yes') : __('No')); ?>&nbsp;</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd><?php echo h($group['Group']['name']); ?>&nbsp;</dd>
		<dt><?php echo __('Gmt Deleted'); ?></dt>
		<dd><?php echo h($group['Group']['gmt_deleted']); ?>&nbsp;</dd>
		<dt><?php echo __('Gmt Created'); ?></dt>
		<dd><?php echo h($group['Group']['gmt_created']); ?>&nbsp;</dd>
		<dt><?php echo __('Gmt Modified'); ?></dt>
		<dd><?php echo h($group['Group']['gmt_modified']); ?>&nbsp;</dd>
	</dl>

	<div class="actions">
		<?php echo $this->Html->link(__('Edit'), array('controller' => 'groups', 'action' => 'edit', $group['Group']['id']), array('class' => 'btn btn-large btn-primary')) ?>
		<?php echo $this->Html->link(__('Delete'), array('controller' => 'groups', 'action' => 'delete', $group['Group']['id']), array('class' => 'btn btn-large btn-danger delete')) ?>
	</div>
</div>

<?php echo $this->start('sidebar'); ?>
<?php echo $this->element('menu'); ?>
<?php echo $this->end(); ?>
