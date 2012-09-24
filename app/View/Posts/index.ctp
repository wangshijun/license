<?php echo $this->start('sidebar'); ?>
<div id="left" class="widget">
	<div class="title">
		<h3>分类导航</h3>
	</div>
	<div class="content">
		<?php echo $this->element('categories.default', compact('categories', 'inflector'));?>
	</div>
</div>
<?php echo $this->end(); ?>

<div id="right" class="widget">

	<div class="title">
		<h3><?php echo $title;?></h3>
	</div>

	<div class="content">
		<?php $posts = ${$inflector['plural']}; ?>
		<?php if (!empty($posts)): ?>

			<ul class="news">
				<?php $i = 0; foreach ($posts as $post): ?>
				<li>
					<span class="date"><?php echo substr($post[$inflector['camelize']]['publish_date'], 0, 10); ?></span>
					<?php echo $this->Html->link(h($post[$inflector['camelize']]['title']), array('controller' => $inflector['underscore'], 'action' => 'view', $post[$inflector['camelize']]['id'])); ?>
				</li>
				<?php endforeach; ?>
			</ul>

		<?php echo $this->element('paginator'); ?>

		<?php else: ?>

			<div class="alert alert-info">
				<a class="close" data-dismiss="alert">×</a>
				<strong><?php echo __('Oops');?>!</strong>&nbsp;&nbsp;<?php echo __('No data found!');?>
			</div>

		<?php endif; ?>
	</div>

</div>
