<?php if (!isset($truncate)) { $truncate = 8; } ?>
<?php if (!isset($latest)) { $latest = false; } ?>

<?php if (!empty($posts)) : ?>
	<?php foreach ($posts as $post): ?>
	<li>
		<span class="date hide">&nbsp;&nbsp;<?php echo substr($post['Article']['publish_date'], 2, 8);?></span>
		<?php echo $this->Html->link(
			(mb_strlen($post['Article']['title']) > $truncate) ? mb_substr($post['Article']['title'], 0, $truncate) . '...' : $post['Article']['title'],
			array('controller' => 'articles', 'action' => 'view', $post['Article']['id']),
			array('title' => $post['Article']['title'], 'target' => '_blank', 'class' => ($latest && ($post['Article']['publish_date'] > date('Y-m-d H:i:s', strtotime('-3 days')))) ? 'new' : ''));?>
	</li>
	<?php endforeach; ?>
<?php else: ?>
	<li><?php echo __('No data found');?></li>
<?php endif; ?>
