<!DOCTYPE html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php echo $title_for_layout; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('jquery.ui-1.8.16/jquery.ui.1.8.16.bootstrap.css');
		echo $this->Html->css('bootstrap-2.1.1/bootstrap.css');
		echo $this->Html->css('bootstrap-2.1.1/bootstrap-responsive.css');
		echo $this->Html->css('app.admin.css');

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
<body>

	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<?php echo $this->Html->link(Configure::read('App.name'), array('controller' => 'pages', 'action' => 'display', 'home', 'admin' => false, 'plugin' => false), array('target' => '_blank', 'title' => __('View Website'), 'class' => 'brand')); ?>
				<div class="nav-collapse">
					<ul class="nav">
						<?php if (!empty($USER)): ?>
							<li class="active"><?php echo $this->Html->link(__('Dashboard'), array('controller' => 'users', 'action' => 'dashboard', 'admin' => true, 'plugin' => false)); ?></li>
						<?php endif; ?>
						<li class="<?php echo empty($USER) ? 'active' : '';?>"><?php echo $this->Html->link(__('About'), array('controller' => 'pages', 'action' => 'display', 'about', 'admin' => false, 'plugin' => false)); ?></li>
						<li><?php echo $this->Html->link(__('Contact'), array('controller' => 'pages', 'action' => 'display', 'contact', 'admin' => false, 'plugin' => false)); ?></li>
					</ul>
					<ul class="nav pull-right">
						<?php if (!empty($USER)): ?>
						<li><a href="javascript:void(0)"><?php echo __('Welcome %s', $USER['name']); ?></a></li>
						<li class="divider-vertical"></li>
						<li class="dropdown">
							<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">其他<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><?php echo $this->Html->link(__('User Profile'), array('controller' => 'users', 'action' => 'profile', 'admin' => true));?></li>
								<li><?php echo $this->Html->link(__('Change Password'), array('controller' => 'users', 'action' => 'password', 'admin' => true));?></li>
								<li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout', 'admin' => true)); ?></li>
							</ul>
						</li>
						<?php endif; ?>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>

	<div id="container" class="container-fluid">

		<div class="row-fluid">
			<div class="span2">
				<?php echo $this->fetch('sidebar');?>
			</div>
			<div class="span10">
				<div id="content">
					<?php echo $this->Session->flash(); ?>
					<?php echo $this->Session->flash('auth', array('element' => 'auth')); ?>
					<?php echo $this->fetch('content'); ?>
				</div>
			</div>
		</div>

		<div id="footer">
			<p class="pull-right">
				<?php echo $this->Html->link($this->Html->image('cake.power.gif', array('border' => '0')), 'http://www.cakephp.org/', array('target' => '_blank', 'escape' => false)); ?>
			</p>
			<p><?php echo Configure::read('App.company'); ?> 版权所有 &copy; 2012</p>
		</div>

	</div>

	<?php //echo $this->element('sql_dump'); ?>


	<?php	// Scripts comes last to make page load faster

		echo $this->Html->script('jquery/jquery-1.7.2.min.js');
		echo $this->Html->script("jquery/jquery.validate-1.8.1.js");
		echo $this->Html->script("jquery/jquery.metadata.js");
		echo $this->Html->script('bootstrap-2.1.1/bootstrap.js');
		echo $this->Html->script('app.core.js');
		echo $this->Html->script('app.admin.js');
		echo $this->fetch('script');
	?>

	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</body>
</html>
