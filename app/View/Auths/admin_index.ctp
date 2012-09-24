<div class="auths index">
	<h2><?php echo __('Auths');?></h2>

	<?php echo $this->Html->link('<i class="icon-refresh"></i> ' . __('Build ACOs'), array('action' => 'acos'), array('escape' => false, 'class' => 'btn')); ?>
	<?php echo $this->Html->link('<i class="icon-refresh"></i> ' . __('Build AROs'), array('action' => 'aros'), array('escape' => false, 'class' => 'btn')); ?>
	<?php echo $this->Html->link('<i class="icon-refresh"></i> ' . __('Build Permissions'), array('action' => 'permissions'), array('escape' => false, 'class' => 'btn')); ?>

	<div>
	<?php if (!empty($logs)): ?>
		<?php foreach ($logs as $log): ?>
			<p><?php echo $log;?></p>
		<?php endforeach; ?>
	<?php else: ?>
		<p><?php echo __('Nothing to do');?></p>
	<?php endif; ?>
	</div>

</div>

<?php $this->start('sidebar'); ?>
<?php echo $this->element('menu'); ?>
<?php $this->end('sidebar'); ?>
