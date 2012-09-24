<div class="users form">
	<?php echo $this->Form->create('Log');?>
	<fieldset>
		<legend><?php echo __('Export Log'); ?></legend>
		<?php echo $this->Form->input('module', array('validate' => 'required:true')); ?>
		<?php echo $this->Form->input('start', array('class' => 'datepicker', 'validate' => 'required:true', 'placeholder' => __('since what time that those logs may interest you'))); ?>
		<?php echo $this->Form->input('end', array('class' => 'datepicker', 'validate' => 'required:true', 'placeholder' => __('after what time that those logs may interest you'))); ?>
		<?php echo $this->Form->input('limit', array('value' => 100, 'validate' => 'required:true,number:true,max:500', 'placeholder' => __('how many logs do you wang to export, 500 at most'))); ?>
	</fieldset>
	<?php echo $this->Form->end(__('Export Log'));?>
</div>

<!-- jQuery TimePicker 插件 -->
<?php $this->addScript($this->Html->script('jquery/jquery.ui.1.8.16.datepicker.min')); ?>
<?php $this->addScript($this->Html->script('jquery/jquery.ui.1.8.16.slider.min')); ?>
<?php $this->addScript($this->Html->script('jquery/jquery.ui.timepicker.0.9.7')); ?>
<?php $this->Html->scriptStart(array('inline' => false)); ?>
jQuery(function () {
	$('#LogStart').datetimepicker({
		stepHour: 2,
		stepMinute: 10,
		onSelect: function (selectedDateTime){
			var start = $(this).datetimepicker('getDate');
			$('#LogEnd').datetimepicker('option', 'minDate', new Date(start.getTime()) );
		}
	});

	$('#LogEnd').datetimepicker({
		stepHour: 2,
		stepMinute: 10,
		onSelect: function (selectedDateTime){
			var end = $(this).datetimepicker('getDate');
			$('#LogStart').datetimepicker('option', 'maxDate', new Date(end.getTime()) );
		}
	});
});
<?php $this->Html->scriptEnd(); ?>

<?php echo $this->element('menu'); ?>