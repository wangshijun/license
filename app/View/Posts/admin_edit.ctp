<div class="<?php echo $inflector['underscore'];?> form">
	<?php echo $this->BootstrapForm->create($inflector['camelize'], array('class' => 'form-vertical'));?>
	<fieldset>
		<legend><?php echo __('Edit ' . $inflector['camelize']); ?></legend>

		<?php echo $this->BootstrapForm->input('id'); ?>
		<?php echo $this->BootstrapForm->input('author_id', array('type' => 'hidden', 'value' => $author_id)); ?>

		<?php echo $this->BootstrapForm->hidden('images', array('type' => 'hidden', 'value' => null)); ?>
		<?php echo $this->BootstrapForm->hidden('cover', array('type' => 'hidden', 'value' => null)); ?>

		<table>
			<tr>
				<?php if (is_root_tenant()): ?>
				<td><?php echo $this->BootstrapForm->input('tenant_id', array('validate' => 'min:1')); ?></td>
				<?php endif; ?>
				<td><?php echo $this->BootstrapForm->input('category_id', array('validate' => 'required:true', 'label' => __('Post Category'), 'escape' => false, 'empty' => __('-Select Category-'))); ?></td>
				<td><?php echo $this->BootstrapForm->input('publish_date', array('type' => 'text', 'value' => date('Y-m-d'), 'class' => 'datepicker', 'label' => __('Publish Date'))); ?></td>
			</tr>
		</table>

		<?php echo $this->BootstrapForm->input('title', array('validate' => 'required:true', 'class' => 'span10 large required', 'label' => __('Post Title'))); ?>
		<?php echo $this->BootstrapForm->input('content', array('validate' => 'required:true', 'label' => false)); ?>

		<?php if ($hasCover): ?>
			<p class="alert alert-info">如果新闻中包含图片, 系统默认选择第1张图片作为封面, 并且该新闻会出现在滚动新闻中. <strong>如果不是第1张, 请在下面填写封面图片在文中出现的序号, 如果不想让该新闻显示在滚动新闻中, 请填写0</strong></p>
			<?php echo $this->BootstrapForm->input('cover_number', array('label' => __('Cover Number'), 'value' => 1)); ?>
		<?php endif; ?>

	</fieldset>

	<div class="form-actions">
		<input type="submit" id="save" class="btn btn-primary btn-large" value="<?php echo __('Save ' . $inflector['camelize']);?>">
	</div>

	<?php echo $this->BootstrapForm->end();?>
</div>

<?php echo $this->start('sidebar'); ?>
<?php echo $this->element('menu'); ?>
<?php echo $this->end(); ?>

<?php $this->addScript($this->CKEditor->create(array('element' => $inflector['camelize'] . 'Content', 'ckfinder' => true, 'toolbar' => 'advanced'))); ?>

<?php $this->Html->scriptStart(array('inline' => false)); ?>
jQuery(function () {
	var form = $('#<?php echo $inflector['camelize'];?>AdminEditForm');
	$('#publish').click(function () {
		if (form.valid()) {
			$('#<?php echo $inflector['camelize'];?>Published').attr('value', 1);
			form.submit();
		}
	});

	<?php if ($hasCover): ?>
	// 提交前设置图片集合和封面图片
	form.submit(function () {
		if (form.valid()) {
			var cover = parseInt($('#<?php echo $inflector['camelize'];?>CoverNumber').val());
			var content = CKEDITOR.instances.<?php echo $inflector['camelize'];?>Content.getData();
			wrapper = $('<div class="wrap">' + content + '</div>');

			if (wrapper.find("img").length > 0) {
				var srcs  = $.makeArray(wrapper.find("img").map(function(){
					return $(this).attr("src");
				}));

				if (cover) {

					$("#<?php echo $inflector['camelize'];?>Cover").val(srcs[cover-1]);
					$("#<?php echo $inflector['camelize'];?>Images").val(srcs.join('|'));

				}
			}
			return true;
		}
		return false;
	});
	<?php endif; ?>

});
<?php $this->Html->scriptEnd(); ?>
