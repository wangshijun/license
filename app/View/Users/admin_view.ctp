<!-- TODO: Add user profile info in the view page -->
<div class="users view">
	<h2><?php  echo __('View User');?></h2>
	<dl>
		<dt><?php echo __('Group'); ?></dt>
		<dd><?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>&nbsp;</dd>
		<dt><?php echo __('Deleted'); ?></dt>
		<dd><?php echo h($user['User']['deleted'] ? __('Yes') : __('No')); ?>&nbsp;</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd><?php echo h($user['User']['active'] ? __('Yes') : __('No')); ?>&nbsp;</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd><?php echo h($user['User']['name']); ?>&nbsp;</dd>
		<dt><?php echo __('Mobile'); ?></dt>
		<dd><?php echo h($user['User']['mobile']); ?>&nbsp;</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd><?php echo h($user['User']['email']); ?>&nbsp;</dd>
		<dt><?php echo __('Ip Last Login'); ?></dt>
		<dd><?php echo h($user['User']['ip_last_login']); ?>&nbsp;</dd>
		<dt><?php echo __('Ip Registered'); ?></dt>
		<dd><?php echo h($user['User']['ip_registered']); ?>&nbsp;</dd>
		<dt><?php echo __('Gmt Last Login'); ?></dt>
		<dd><?php echo h($user['User']['gmt_last_login']); ?>&nbsp;</dd>
		<dt><?php echo __('Gmt Registered'); ?></dt>
		<dd><?php echo h($user['User']['gmt_registered']); ?>&nbsp;</dd>
		<dt><?php echo __('Gmt Created'); ?></dt>
		<dd><?php echo h($user['User']['gmt_created']); ?>&nbsp;</dd>
		<dt><?php echo __('Gmt Deleted'); ?></dt>
		<dd><?php echo h($user['User']['gmt_deleted']); ?>&nbsp;</dd>
		<dt><?php echo __('Gmt Modified'); ?></dt>
		<dd><?php echo h($user['User']['gmt_modified']); ?>&nbsp;</dd>
	</dl>

	<div class="actions">
		<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['User']['id']), array('class' => 'btn btn-large btn-primary')) ?>
		<?php echo $this->Html->link(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['User']['id']), array('class' => 'btn btn-large btn-danger delete')) ?>
	</div>
</div>

<?php echo $this->start('sidebar'); ?>
<?php echo $this->element('menu'); ?>
<?php echo $this->end(); ?>
