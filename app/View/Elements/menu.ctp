<div id="menu" class="well" style="padding: 8px 0;">
	<ul class="menu nav nav-list">
	<?php foreach ($menu as $package): ?>
		<li id="<?php echo $package['id'];?>" class="package nav-header <?php echo $package['id'];?>">
			<?php echo __(trim($package['title'])); ?>
		</li>
		<?php if (!empty($package['children'])): ?>
			<?php foreach ($package['children'] as $subpackage): ?>
				<?php if (!empty($subpackage['children'])): ?>
					<?php foreach ($subpackage['children'] as $action): ?>
					<li id="<?php echo $action['id'];?>" class="subitem <?php echo $action['id'];?>" >
						<?php echo $this->Html->link('<i class="icon-' . $subpackage['id'] . '"></i>' . __(trim($action['title'])), $action['url'], array('escape' =>false)); ?>
					</li>
					<?php endforeach; ?>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endif; ?>
	<?php endforeach; ?>
	</ul>
</div>

<?php //debug($menu); ?>
<?php //debug($menus); ?>
<?php //debug($this->here); ?>
