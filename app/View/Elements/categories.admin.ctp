<ul class="categories <?php echo $inflector['underscore'];?>">
<?php //debug($categories);// exit();?>
<?php foreach ($categories as $category): $_category = $category[$inflector['camelize']]; ?>
	<li class="category">
		<span class="span3"><?php echo $_category['name']; ?></span>
		<a href="javascript:void(0)" class="btn btn-mini add" id="<?php echo $_category['id'];?>" title="<?php echo __('Add Child'); ?>"><i class="icon-plus"></i></a>
		<?php echo $this->Html->link('<i class="icon-edit"></i>', array('action' => 'edit', $_category['id']), array('escape' => false, 'class' => 'btn btn-mini', 'title' => __('Edit'))); ?>
		<?php echo $this->Html->link('<i class="icon-remove"></i>', array('action' => 'delete', $_category['id']), array('escape' => false, 'class' => 'btn btn-mini', 'title' => __('Remove'))); ?>
		<?php if (!empty($category['children'])): ?>
			<?php echo $this->element('categories.admin', array('inflector' => $inflector, 'categories' => $category['children']));?>
		<?php endif; ?>
	</li>
<?php endforeach; ?>
</ul>
