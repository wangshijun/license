<ul class="categories">
<?php //debug($categories); return;?>
<?php foreach ($categories as $category): $_category = $category['Category']; ?>
	<li class="category">
		<?php echo $this->Html->link(h($_category['name']), array('controller' => $inflector['underscore'], 'action' => 'index', 'category_id' => $_category['id']));?>
		<?php if (!empty($category['children'])): ?>
			<?php echo $this->element('categories.default', array('inflector' => $inflector, 'categories' => $category['children']));?>
		<?php endif; ?>
	</li>
<?php endforeach; ?>
</ul>
