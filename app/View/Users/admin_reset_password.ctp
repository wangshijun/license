<div class="users form">
	<h2><?php echo __('Rest Password'); ?></h2>
	<p class="note"><?php printf(__('Password for %s is set to %s'), $user['User']['name'], $password);?></p>
</div>

<?php echo $this->start('sidebar'); ?>
<?php echo $this->element('menu'); ?>
<?php echo $this->end(); ?>
