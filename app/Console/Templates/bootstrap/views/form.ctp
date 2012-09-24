<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<div class="<?php echo $pluralVar;?> form">
	<?php echo "<?php echo \$this->BootstrapForm->create('{$modelClass}');?>\n";?>
	<fieldset>
		<legend><?php printf("<?php echo __('%s %s'); ?>", Inflector::humanize($action), $singularHumanName); ?></legend>

<?php echo "\t\t<?php if (is_root_tenant()): ?>\n"; ?>
<?php echo "\t\t\t<?php echo \$this->BootstrapForm->input('tenant_id', array('validate' => 'min:1')); ?>\n";?>
<?php echo "\t\t<?php endif; ?>\n";?>

<?php
		foreach ($fields as $field) {
			if (strpos($action, 'add') !== false && $field == $primaryKey) {
				continue;
			} elseif (in_array($field, array('deleted', 'tenant_id')) === false && strpos($field, 'gmt_') === false) {
				echo "\t\t<?php echo \$this->BootstrapForm->input('{$field}'); ?>\n";
			}
		}
		if (!empty($associations['hasAndBelongsToMany'])) {
			foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
				echo "\t\t<?php echo \$this->BootstrapForm->input('{$assocName}'); ?>\n";
			}
		}
?>
	</fieldset>
<?php
	echo "\t<?php echo \$this->BootstrapForm->end(__('Submit'));?>\n";
?>
</div>

<?php echo "<?php echo \$this->start('sidebar'); ?>\n"; ?>
<?php echo "<?php echo \t\$this->element('menu'); ?>\n"; ?>
<?php echo "<?php echo \$this->end(); ?>\n"; ?>
