<div class="auths index">
	<h2><?php echo __('Manage Misc Posts');?></h2>

	<?php foreach ($miscs as $key=>$value): ?>
		<?php echo $this->Html->link($value['title'], array('action' => 'edit', $key), array('class' => 'btn')); ?>
	<?php endforeach; ?>

</div>

<?php $this->start('sidebar'); ?>
<?php echo $this->element('menu'); ?>
<?php $this->end('sidebar'); ?>
