<?php $bages = array(
	'error' => 'badge-error',
	'success' => 'badge-success',
	'warning' => 'badge-warning',
	'info' => 'badge-info',
	'debug' => 'badge-debug',
); ?>

<div class="logs index">
	<h2><?php echo __('Logs');?></h2>

	<?php echo $this->BootstrapForm->create('Log', array('url' => array_merge(array('action' => 'search'), $this->params['pass']), 'class' => 'search form-search'));?>
		<?php echo $this->BootstrapForm->input('content', array('class' => 'short', 'placeholder' => __('type to search'), 'class' => 'input-medium search-query', 'label' => false, 'div' => false)); ?>
		<?php if (is_root_tenant()): ?>
			<?php echo $this->BootstrapForm->input('tenant_id', array('validate' => 'min:1', 'label' => false, 'div' => false, 'class' => 'input-medium')); ?>
		<?php endif; ?>
		<?php echo $this->BootstrapForm->button('<i class="icon-search"></i> ' . __('Search'), array('class' => 'btn', 'div' => false));?>
	<?php echo $this->BootstrapForm->end();?>

	<?php if (!empty($logs)): ?>

	<table cellpadding="0" cellspacing="0" class="logs  table table-bordered table-striped">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id');?></th>
				<th><?php echo $this->Paginator->sort('type');?></th>
				<th><?php echo $this->Paginator->sort('module');?></th>
				<th><?php echo $this->Paginator->sort('username');?></th>
				<th><?php echo $this->Paginator->sort('content');?></th>
				<th><?php echo $this->Paginator->sort('gmt_created');?></th>
			</tr>
		</thead>
		<tbody>
		<?php $i = 0; foreach ($logs as $log): ?>
			<tr>
				<td><?php echo h($log['Log']['id']); ?>&nbsp;</td>
				<td><span class="badge badge-<?php echo h($log['Log']['type']); ?>"><?php echo h($log['Log']['type']); ?></span></td>
				<td><?php echo h($log['Log']['module']); ?>&nbsp;</td>
				<td><?php echo h($log['Log']['username']); ?>&nbsp;</td>
				<td><?php echo h($log['Log']['content']); ?>&nbsp;</td>
				<td><?php echo h($log['Log']['gmt_created']); ?>&nbsp;</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

	<?php echo $this->element('paginator'); ?>

	<?php else: ?>

	<div class="alert alert-info">
		<a class="close" data-dismiss="alert">×</a>
		<strong><?php echo __('Oops');?></strong> <?php echo __('No data found');?>
	</div>

	<?php endif; ?>

</div>

<?php echo $this->start('sidebar'); ?>
<?php echo 	$this->element('menu'); ?>
<?php echo $this->end(); ?>
