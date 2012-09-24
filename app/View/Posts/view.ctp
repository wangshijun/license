<?php echo $this->start('sidebar'); ?>
<div id="left" class="widget">
	<div class="title">
		<h3><?php echo __('Category Navigation');?></h3>
	</div>
	<div class="content">
		<?php echo $this->element('categories.default', compact('categories', 'inflector'));?>
	</div>
</div>
<?php echo $this->end(); ?>

<div id="right" class="widget">
	<div id="post" class="content">
		<?php $post = ${$inflector['singular']}; ?>
		<?php if (!empty($post)): ?>

			<h3 id="title"><?php echo h($post[$inflector['camelize']]['title']);?></h3>

			<p id="meta">
				<span id="author"><strong><?php echo __('Author');?></strong>:&nbsp;<?php echo h($post['Author']['name']);?></span>
				<span id="click_count"><strong><?php echo __('Click Count');?></strong>:&nbsp;<?php echo h($post[$inflector['camelize']]['click_count']);?></span>
				<span id="publish_date"><strong><?php echo __('Publish Date');?></strong>:&nbsp;<?php echo substr(h($post[$inflector['camelize']]['publish_date']), 0, 10);?></span>
			</p>

			<div id="detail">
				<?php echo $post[$inflector['camelize']]['content'];?>
			</div>

			<div id="post-comments">
				<?php $this->CommentWidget->options(array('allowAnonymousComment' => true));?>
				<?php echo $this->CommentWidget->display();?>
			</div>

		<?php else: ?>

			<div class="alert alert-error">
				<a class="close" data-dismiss="alert">×</a>
				<strong><?php echo __('Oops');?>!</strong>&nbsp;&nbsp;<?php echo __('No data found!');?>
			</div>

		<?php endif; ?>
	</div>
</div>
