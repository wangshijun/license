<div class="users index">
	<h2><?php echo __('Dashboard');?></h2>

	<div class="alert alert-info">
		<a class="close" data-dismiss="alert">x</a>
		<strong><?php echo __('Welcome');?></strong> <?php echo __('Use menu on the left of the page');?>
	</div>

	<div class="buttons">
		<?php echo $this->Html->link(__('Add Building'), array('controller' => 'buildings', 'action' => 'add', 'admin' => true), array('class' => 'btn btn-large')); ?>
		<?php echo $this->Html->link(__('Add Building Block'), array('controller' => 'building_blocks', 'action' => 'add', 'admin' => true), array('class' => 'btn btn-large')); ?>
		<?php echo $this->Html->link(__('Add Building Resident'), array('controller' => 'building_residents', 'action' => 'add', 'admin' => true), array('class' => 'btn btn-large')); ?>
		<?php echo $this->Html->link(__('Add Article'), array('controller' => 'articles', 'action' => 'add', 'admin' => true), array('class' => 'btn btn-large')); ?>
	</div>

</div>

<?php echo $this->start('sidebar'); ?>
<?php echo $this->element('menu'); ?>
<?php echo $this->end(); ?>
