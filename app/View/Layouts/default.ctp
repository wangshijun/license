<!DOCTYPE html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php echo $title_for_layout; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
		echo $this->Html->meta('icon');

		//echo $this->Html->css('jquery.ui-1.8.16/jquery.ui.1.8.16.bootstrap.css');
		echo $this->Html->css('bootstrap-2.1.1/bootstrap.cerulean.min.css');
		//echo $this->Html->css('bootstrap-2.1.1/bootstrap-responsive.css');
		echo $this->Html->css('app.default.css');

		if (Configure::read('debug') > 0) {
			echo $this->Html->css('cake.debug.css');
		}

		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>

	<!--[if IE]>
		<?php echo $this->Html->css('jquery.ui.bootstrap/jquery.ui.1.8.16.ie.css'); ?>
	<![endif]-->

</head>
<body class="container">

	<div id="header">
		<?php echo $this->Html->image("header.jpg"); ?>
	</div>

	<div id="navbar" class="navbar">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<?php //echo $this->Html->link(Configure::read('App.name'), array('controller' => 'pages', 'action' => 'display', 'home', 'admin' => false), array('target' => '_blank', 'title' => __('View Website'), 'class' => 'brand')); ?>
				<div class="nav-collapse">
					<ul class="nav">
						<li><?php echo $this->Html->link('首页', array('controller' => 'pages', 'action' => 'display', 'home'), array('class' => 'current'));?></li>
						<?php foreach ($categories as $category): ?>
						<li class="dropdown">
							<?php if (empty($category['children'])): ?>
								<?php echo $this->Html->link(h($category['Category']['name']) , array('controller' => 'articles', 'action' => 'index', 'category_id' => $category['Category']['id']));?>
							<?php else: ?>
								<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><?php echo h($category['Category']['name']); ?><b class="caret"></b></a>
								<ul class="dropdown-menu">
									<?php foreach ($category['children'] as $subcategory): ?>
									<li><?php echo $this->Html->link(h($subcategory['Category']['name']) , array('controller' => 'articles', 'action' => 'index', 'category_id' => $subcategory['Category']['id']));?></li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
						</li>
						<?php endforeach; ?>
					</ul>
					<!--
					<ul class="nav pull-right">
						<li><?php echo $this->Html->link(__('Admin'), array('controller' => 'users', 'action' => 'login', 'admin' => true));?></li>
						<li class="divider-vertical"></li>
						<li class="dropdown">
							<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">其他<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><?php echo $this->Html->link(__('About'), array('controller' => 'pages', 'action' => 'display', 'about'));?></li>
								<li><?php echo $this->Html->link(__('Contact'), array('controller' => 'pages', 'action' => 'display', 'contact'));?></li>
								<li><a href="mailto:wangshijun2010@gmail.com"><?php echo __('Support');?></a></li>
							</ul>
						</li>
					</ul>
					-->
				</div>
			</div>
		</div>
	</div>

	<!-- Main Start -->
	<?php $sidebar = $this->fetch('sidebar'); ?>

	<?php if (empty($sidebar)): ?>

		<div id="main" class="row">
			<div class="span12">
				<div id="content">
					<?php echo $this->Session->flash(); ?>
					<?php echo $this->Session->flash('auth', array('element' => 'auth')); ?>
					<?php echo $this->fetch('content'); ?>
				</div>
			</div>
		</div>

	<?php else: ?>

		<div id="main" class="row">
			<div class="span3">
				<?php echo $sidebar;?>
			</div>
			<div class="span9">
				<div id="content">
					<?php echo $this->Session->flash(); ?>
					<?php echo $this->Session->flash('auth', array('element' => 'auth')); ?>
					<?php echo $this->fetch('content'); ?>
				</div>
			</div>
		</div>

	<?php endif; ?>
	<!-- Main End -->

	<!-- Footer Start -->
	<div id="footer">
		<p class="pull-right">
			<?php echo Configure::read('App.name'); ?> 版权所有 &copy; 2012 &nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link(__('Admin'), array('controller' => 'users', 'action' => 'login', 'admin' => true));?>
		</p>
	</div>
	<!-- Footer End -->

	<?php //echo $this->element('sql_dump'); ?>


	<?php	// Scripts comes last to make page load faster

		echo $this->Html->script('jquery/jquery-1.7.2.min.js');
		echo $this->Html->script('bootstrap-2.1.1/bootstrap.js');
		echo $this->Html->script('app.core.js');
		echo $this->Html->script('app.default.js');
		echo $this->fetch('script');
	?>

	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</body>
</html>
