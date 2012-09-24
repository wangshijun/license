<!DOCTYPE html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php echo $title_for_layout; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php	// Style sheets at the head
		echo $this->Html->meta('icon');
		echo $this->Html->css('jquery.mobile-1.1.0/jquery.mobile-1.1.0.css');
		echo $this->Html->css('app.mobile.css');

		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>
</head>
<body>

<?php echo $this->fetch('content'); ?>

<?php // scripts at the end
	echo $this->Html->script('jquery/jquery-1.7.2.min.js');
	echo $this->Html->script('jquery.mobile-1.1.0/jquery.mobile-1.1.0.min.js');
	echo $this->Html->script('app.mobile.js');
	echo $this->fetch('script');
?>

</body>
</html>