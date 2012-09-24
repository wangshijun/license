<?php //$this->Html->css('jquery.ui.1.8.16.custom', null, array('inline' => false), false); ?>
<?php $this->Html->css('jquery.uploader.1.3.css', null, array('inline' => false), false); ?>
<?php
$model = 'User';
$alias = 'Avatar';

$avatar = isset($this->data[$alias]) ? $this->data[$alias] : null;
$versions = array('large', 'small', 'tiny');

?>

<div class="row users form">
	<div class="span6 avatars">
		<?php if (isset($avatar)): ?>
			<h3><?php echo __('Existing Avatar'); ?></h3>
			<div class="exists">
				<?php foreach ($versions as $version): ?>
				<?php
					$filepath = "{$version}/{$avatar['dirname']}/{$avatar['basename']}";
					echo $this->Media->embed($this->Media->file($filepath), array('restrict' => array('image')));
				?>
				<?php endforeach; ?>
			</div>
		<?php else: ?>
			<p class="alert alert-info"><?php echo __('No Avatar Yet'); ?></p>
		<?php endif; ?>
	</div>

	<div class="span6 upload">
		<h3><?php echo __('New Avatar'); ?></h3>
		<?php echo $this->BootstrapForm->create('User', array('type' => 'file'));?>
			<?php echo $this->BootstrapForm->input('id'); ?>
			<?php echo $this->BootstrapForm->hidden($alias . '.model', array('value' => $this->BootstrapForm->model())); ?>
			<?php echo $this->BootstrapForm->hidden($alias . '.group', array('value' => strtolower($alias))); ?>
			<?php
				echo $this->BootstrapForm->input($alias . '.file', array(
					'label' => __('File'),
					'type'  => 'file',
					'label' => false,
					'div' => false,
					'multiple' => 'multiple',
					'class' => 'uploader',
					'error' => array(
						'error'      => __('An error occured while transferring the file.'),
						'resource'   => __('The file is invalid.'),
						'access'     => __('The file cannot be processed.'),
						'location'   => __('The file cannot be transferred from or to location.'),
						'permission' => __('Executable files cannot be uploaded.'),
						'size'       => __('The file is too large.'),
						'pixels'     => __('The file is too large.'),
						'extension'  => __('The file has the wrong extension.'),
						'mimeType'   => __('The file has the wrong MIME type.'),
				)));
			?>
			<?php echo $this->BootstrapForm->button(__('Upload'), array('type' => 'submit', 'id' => 'px-submit')); ?>
			<?php echo $this->BootstrapForm->button(__('Clear'), array('type' => 'reset', 'id' => 'px-clear')); ?>
		<?php echo $this->BootstrapForm->end();?>
	</div>

	<?php $this->Html->script('jquery/jquery-ui-1.8.16.custom.min.js', array('inline' => false)); ?>
	<?php $this->Html->script('jquery/jquery.ui.1.8.16.progressbar.min.js', array('inline' => false)); ?>
	<?php $this->Html->script('jquery/jquery.uploader.1.3.js', array('inline' => false)); ?>

	<?php $this->Html->scriptStart(array('inline' => false)); ?>
	jQuery(function(){
		$('.uploader').uploader();
	});
	<?php $this->Html->scriptEnd(); ?>

	<?php //debug($this->data);?>
	<?php //debug($this->Session->read(Configure::read('SessionKey')));?>

</div>

<?php echo $this->start('sidebar'); ?>
<?php echo 	$this->element('menu'); ?>
<?php echo $this->end(); ?>
