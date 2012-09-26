<div class="hero-unit">
	<h1><?php echo Configure::read('App.name'); ?></h1>
	<p><?php echo date('Y-m-d'); ?></p>
	<p>
		<a class="btn btn-primary btn-large"><?php echo __('Coming Soon'); ?></a>
	</p>
</div>

<!-- 背景图加上4个按钮 -->
<?php foreach ($widgets as $i => $row): ?>
<div class="row clearfix">
	<?php foreach ($row as $j => $widget): ?>
	<div id="widget_<?php echo $j; ?>" class="<?php echo $widget['Widget']['class']; ?>">
		<div class="widget">
			<div class="title">
				<h3><?php echo $widget['Widget']['name']; ?></h3>
			</div>
			<div class="content">
				<ul class="news">
					<?php echo $this->element('widget.post', array('posts' => $widget['Widget']['articles']));?>
				</ul>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>
<?php endforeach; ?>
