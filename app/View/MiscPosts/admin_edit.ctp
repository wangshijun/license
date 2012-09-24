<div class="<?php echo $inflector['underscore'];?> form">
	<?php echo $this->BootstrapForm->create($inflector['camelize'], array('class' => 'form-vertical'));?>
	<fieldset>
		<legend><?php echo $post['MiscPost']['title']; ?></legend>

		<?php echo $this->BootstrapForm->input('id'); ?>
		<?php echo $this->BootstrapForm->input('content', array('label' => false)); ?>

	</fieldset>

	<div class="form-actions">
		<input type="submit" id="save" class="btn btn-primary btn-large" value="<?php echo __('Save');?>">
	</div>

	<?php echo $this->BootstrapForm->end();?>
</div>

<?php echo $this->start('sidebar'); ?>
<?php echo $this->element('menu'); ?>
<?php echo $this->end(); ?>

<?php $this->addScript($this->CKEditor->create(array('element' => $inflector['camelize'] . 'Content', 'ckfinder' => true, 'toolbar' => 'advanced'))); ?>