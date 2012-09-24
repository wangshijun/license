<div class="modal">
	<?php echo $this->BootstrapForm->create('User');?>
	<div class="modal-header">
		<h3><?php echo __('Welcome Using'), Configure::read('App.name'); ?></h3>
	</div>
	<div class="modal-body">
		<?php echo $this->BootstrapForm->input('name', array('validate' => 'required:true', 'class' => 'span9')); ?>
		<?php echo $this->BootstrapForm->input('password', array('type' => 'password', 'validate' => 'required:true', 'label' => __('Password'), 'class' => 'span9')); ?>
	</div>
	<div class="modal-footer">
		<?php echo $this->BootstrapForm->button(__('Login'), array('div' => false, 'class' => 'btn btn-large btn-primary', 'type' => 'submit')); ?>
	</div>
	<?php echo $this->BootstrapForm->end();?>
</div>