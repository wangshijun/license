<div class="groups view">
	<?php echo $this->Form->create('Group');?>
	<fieldset>
		<legend><?php echo __('Edit Group Permission'); ?></legend>
		<?php foreach ($packages as $package): ?>
			<h3 id="<?php echo $package['id'];?>" class="<?php echo $package['id'];?>">
				<?php echo __(trim($package['title'])); ?>
			</h3>
			<?php if (!empty($package['children'])): ?>
				<ul class="package">
					<?php foreach ($package['children'] as $subpackage): ?>
					<li id="<?php echo $subpackage['id'];?>" class="<?php echo $subpackage['id'];?>" >
						<h4><?php echo __(trim($subpackage['title'])); ?></h4>
						<?php if (!empty($subpackage['children'])): ?>
							<ul class="subpackage">
								<?php foreach ($subpackage['children'] as $action): ?>
								<li id="<?php echo $action['id'];?>" class="action <?php echo $action['id'];?>" >
									<span class="icon <?php echo $action['allow'] ? 'accept' : 'block';?>" title="<?php echo $action['allow'] ? __('Allow') : __('Deny');?>">&nbsp;</span>
									<span class="aco" aco="<?php echo $action['aco'];?>"><?php echo __(trim($action['title'])) . '(' . $action['alias'] . ')'; ?>&nbsp;</span>
									<a href="javascript:void(0)" class="btn btn-mini <?php echo $action['allow'] ? 'btn-danger' : 'btn-success';?>">
										<i class="icon-<?php echo $action['allow'] ? 'remove' : 'ok';?>"></i>&nbsp;
										<?php echo $action['allow'] ? __('Deny') : __('Allow');?>
									</a>
								</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		<?php endforeach; ?>
		<?php //debug($packages);?>
	</fieldset>
	<?php echo $this->Form->end();?>
</div>


<!-- 使用Ajax逐条修改权限配置, 因为批量修改太耗资源 -->
<?php $this->Html->scriptStart(array('inline' => false)); ?>
jQuery(function () {
	$('a.button').click(function () {
		var that = $(this),
			icon = that.prevAll('span.icon'),
			aco = that.prev('span.aco').attr('aco'),
			action = that.text();
		$.ajax({
			url: "<?php echo Router::url(array('controller' => 'groups', 'action' => 'permission', 'admin' => true));?>",
			type: "POST",
			dataType: "json",
			data: {aco: aco, action: action},
			success: function(response) {
				//console.log(response);
				app.notify(response.code);
				if (response.status) {
					if (action == '<?php echo __("Allow"); ?>') {
						icon.removeClass('block').addClass('accept').attr('title', '<?php echo __("Allow"); ?>');
						that.addClass('currentbtn').text('<?php echo __("Deny"); ?>');
					} else if (action == '<?php echo __("Deny"); ?>') {
						icon.removeClass('accept').addClass('block').attr('title', '<?php echo __("Deny"); ?>');
						that.removeClass('currentbtn').text('<?php echo __("Allow"); ?>');
					}
				}
			}
		});
	});
});
<?php $this->Html->scriptEnd(); ?>

<?php echo $this->start('sidebar'); ?>
<?php echo $this->element('menu'); ?>
<?php echo $this->end(); ?>
