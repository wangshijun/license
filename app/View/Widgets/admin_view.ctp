
<div class="widgets view">
	<h2><?php  echo __('Widget');?></h2>
	<dl>
		<dt><?php echo __('Category Id'); ?></dt>
		<dd><?php echo h($widget['Widget']['category_id']); ?>&nbsp;</dd>
		<dt><?php echo __('System'); ?></dt>
		<dd><?php echo h($widget['Widget']['system']); ?>&nbsp;</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd><?php echo h($widget['Widget']['name']); ?>&nbsp;</dd>
		<dt><?php echo __('Visible'); ?></dt>
		<dd><?php echo h($widget['Widget']['visible']); ?>&nbsp;</dd>
		<dt><?php echo __('Row'); ?></dt>
		<dd><?php echo h($widget['Widget']['row']); ?>&nbsp;</dd>
		<dt><?php echo __('Column'); ?></dt>
		<dd><?php echo h($widget['Widget']['column']); ?>&nbsp;</dd>
		<dt><?php echo __('Size'); ?></dt>
		<dd><?php echo h($widget['Widget']['size']); ?>&nbsp;</dd>
		<dt><?php echo __('Gmt Created'); ?></dt>
		<dd><?php echo h($widget['Widget']['gmt_created']); ?>&nbsp;</dd>
		<dt><?php echo __('Gmt Modified'); ?></dt>
		<dd><?php echo h($widget['Widget']['gmt_modified']); ?>&nbsp;</dd>
	</dl>

	<div class="actions">
		<?php echo $this->Html->link(__('Edit'), array('controller' => 'widgets', 'action' => 'edit', $widget['Widget']['id']), array('class' => 'btn btn-large btn-primary')); ?>
		<?php echo $this->Html->link(__('Delete'), array('controller' => 'widgets', 'action' => 'delete', $widget['Widget']['id']), array('class' => 'btn btn-large btn-danger delete')); ?>
	</div>

</div>

<?php echo $this->start('sidebar'); ?>
<?php echo $this->element('menu'); ?>
<?php echo $this->end(); ?>
