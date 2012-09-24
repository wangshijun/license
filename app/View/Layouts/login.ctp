<!DOCTYPE html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php echo __('User Login'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('jquery.ui-1.8.16/jquery.ui.1.8.16.bootstrap.css');
		echo $this->Html->css('bootstrap-2.1.1/bootstrap.css');
		echo $this->Html->css('bootstrap-2.1.1/bootstrap-responsive.css');
		echo $this->Html->css('app.login.css');

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

	<div id="container" class="container-fluid">

		<div class="row-fluid">
			<div class="span4">&nbsp;</div>
			<div class="span4">
				<div id="content">
					<?php echo $this->Session->flash(); ?>
					<?php echo $this->Session->flash('auth', array('element' => 'auth')); ?>
					<?php echo $this->fetch('content'); ?>
				</div>
			</div>
			<div class="span4">&nbsp;</div>
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
