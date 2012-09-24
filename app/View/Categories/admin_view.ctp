<!-- TODO: Convert this to a universal usable template -->
<div class="chapters view">
	<h2><?php  echo __('Chapter');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd><?php echo h($chapter['Chapter']['id']); ?>&nbsp;</dd>
		<dt><?php echo __('Tenant'); ?></dt>
		<dd><?php echo $this->Html->link($chapter['Tenant']['name'], array('controller' => 'tenants', 'action' => 'view', $chapter['Tenant']['id'])); ?>&nbsp;</dd>
		<dt><?php echo __('Deleted'); ?></dt>
		<dd><?php echo h($chapter['Chapter']['deleted']); ?>&nbsp;</dd>
		<dt><?php echo __('Parent Chapter'); ?></dt>
		<dd><?php echo $this->Html->link($chapter['ParentChapter']['name'], array('controller' => 'chapters', 'action' => 'view', $chapter['ParentChapter']['id'])); ?>&nbsp;</dd>
		<dt><?php echo __('Lft'); ?></dt>
		<dd><?php echo h($chapter['Chapter']['lft']); ?>&nbsp;</dd>
		<dt><?php echo __('Rght'); ?></dt>
		<dd><?php echo h($chapter['Chapter']['rght']); ?>&nbsp;</dd>
		<dt><?php echo __('Model'); ?></dt>
		<dd><?php echo h($chapter['Chapter']['model']); ?>&nbsp;</dd>
		<dt><?php echo __('Foreign Key'); ?></dt>
		<dd><?php echo h($chapter['Chapter']['foreign_key']); ?>&nbsp;</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd><?php echo h($chapter['Chapter']['name']); ?>&nbsp;</dd>
		<dt><?php echo __('Alias'); ?></dt>
		<dd><?php echo h($chapter['Chapter']['alias']); ?>&nbsp;</dd>
		<dt><?php echo __('Gmt Created'); ?></dt>
		<dd><?php echo h($chapter['Chapter']['gmt_created']); ?>&nbsp;</dd>
		<dt><?php echo __('Gmt Deleted'); ?></dt>
		<dd><?php echo h($chapter['Chapter']['gmt_deleted']); ?>&nbsp;</dd>
		<dt><?php echo __('Gmt Modified'); ?></dt>
		<dd><?php echo h($chapter['Chapter']['gmt_modified']); ?>&nbsp;</dd>
	</dl>
</div>

<?php echo $this->start('sidebar'); ?>
<?php echo $this->element('menu'); ?>
<?php echo $this->end(); ?>
