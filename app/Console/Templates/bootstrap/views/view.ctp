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
<?php $underscore = Inflector::underscore($pluralVar); ?>
<?php $ignored = array('id', 'tenant_id', 'deleted', 'gmt_deleted'); ?>

<div class="<?php echo $pluralVar;?> view">
	<h2><?php echo "<?php  echo __('{$singularHumanName}');?>";?></h2>
	<dl>
<?php
foreach ($fields as $field) {
	$isKey = false;
	if (!empty($associations['belongsTo'])) {
		foreach ($associations['belongsTo'] as $alias => $details) {
			if ($field === $details['foreignKey'] && $field !== 'tenant_id') {
				$isKey = true;
				echo "\t\t<dt><?php echo __('" . Inflector::humanize(Inflector::underscore($alias)) . "'); ?></dt>\n";
				echo "\t\t<dd><?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>&nbsp;</dd>\n";
				break;
			}
		}
	}
	if ($isKey !== true && in_array($field, $ignored) === false) {
		echo "\t\t<dt><?php echo __('" . Inflector::humanize($field) . "'); ?></dt>\n";
		echo "\t\t<dd><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</dd>\n";
	}
}
?>
	</dl>

	<div class="actions">
<?php echo "\t\t<?php echo \$this->Html->link(__('Edit'), array('controller' => '{$underscore}', 'action' => 'edit', \${$singularVar}['{$modelClass}']['id']), array('class' => 'btn btn-large btn-primary')); ?>\n"; ?>
<?php echo "\t\t<?php echo \$this->Html->link(__('Delete'), array('controller' => '{$underscore}', 'action' => 'delete', \${$singularVar}['{$modelClass}']['id']), array('class' => 'btn btn-large btn-danger delete')); ?>\n"; ?>
	</div>
<?php
if (!empty($associations['hasOne'])) :
	foreach ($associations['hasOne'] as $alias => $details): ?>
	<div class="related">
		<h3><?php echo "<?php echo __('Related " . Inflector::humanize($details['controller']) . "');?>";?></h3>
	<?php echo "<?php if (!empty(\${$singularVar}['{$alias}'])):?>\n";?>
		<dl>
	<?php
			foreach ($details['fields'] as $field) {
				echo "\t\t<dt><?php echo __('" . Inflector::humanize($field) . "');?></dt>\n";
				echo "\t\t<dd><?php echo \${$singularVar}['{$alias}']['{$field}'];?>&nbsp;</dd>\n";
			}
	?>
		</dl>
	<?php echo "<?php endif; ?>\n";?>
		<div class="actions">
			<ul>
				<li><?php echo "<?php echo \$this->Html->link(__('Edit " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'edit', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?></li>\n";?>
			</ul>
		</div>
	</div>
	<?php
	endforeach;
endif;
if (empty($associations['hasMany'])) {
	$associations['hasMany'] = array();
}
if (empty($associations['hasAndBelongsToMany'])) {
	$associations['hasAndBelongsToMany'] = array();
}
$relations = array_merge($associations['hasMany'], $associations['hasAndBelongsToMany']);
$i = 0;
foreach ($relations as $alias => $details):
	$otherSingularVar = Inflector::variable($alias);
	$otherPluralHumanName = Inflector::humanize($details['controller']);
	?>

<div class="related">
	<h3><?php echo "<?php echo __('Related " . $otherPluralHumanName . "');?>";?></h3>

	<?php echo "<?php if (!empty(\${$singularVar}['{$alias}'])):?>\n";?>

	<table cellpadding = "0" cellspacing = "0"  class="<?php echo strtolower($otherPluralHumanName);?> datatable">
		<thead>
			<tr>
<?php
			foreach ($details['fields'] as $field) {
				echo "\t\t\t\t<th><?php echo __('" . Inflector::humanize($field) . "'); ?></th>\n";
			}
?>
				<th class="actions"><?php echo "<?php echo __('Actions');?>";?></th>
			</tr>
		</thead>
		<tbody>
<?php
echo "\t\t<?php \$i = 0; foreach (\${$singularVar}['{$alias}'] as \${$otherSingularVar}): ?>\n";
		echo "\t\t\t<tr>\n";
			foreach ($details['fields'] as $field) {
				echo "\t\t\t\t<td><?php echo \${$otherSingularVar}['{$field}'];?></td>\n";
			}

			echo "\t\t\t\t<td class=\"actions\">\n";
			echo "\t\t\t\t\t<?php echo \$this->Html->link(__('View'), array('controller' => '{$details['controller']}', 'action' => 'view', \${$otherSingularVar}['{$details['primaryKey']}'])); ?>\n";
			echo "\t\t\t\t\t<?php echo \$this->Html->link(__('Edit'), array('controller' => '{$details['controller']}', 'action' => 'edit', \${$otherSingularVar}['{$details['primaryKey']}'])); ?>\n";
			echo "\t\t\t\t\t<?php echo \$this->Form->postLink(__('Delete'), array('controller' => '{$details['controller']}', 'action' => 'delete', \${$otherSingularVar}['{$details['primaryKey']}']), null, __('Are you sure you want to delete # %s?', \${$otherSingularVar}['{$details['primaryKey']}'])); ?>\n";
			echo "\t\t\t\t</td>\n";
		echo "\t\t\t</tr>\n";

echo "\t\t<?php endforeach; ?>\n";
?>
		</tbody>
	</table>

<?php echo "\t<?php endif; ?>\n\n";?>
	<div class="actions">
		<ul>
			<li><?php echo "<?php echo \$this->Html->link(__('New " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'add'));?>";?> </li>
		</ul>
	</div>

</div>
<?php endforeach;?>

</div>

<?php echo "<?php echo \$this->start('sidebar'); ?>\n"; ?>
<?php echo "<?php echo \$this->element('menu'); ?>\n"; ?>
<?php echo "<?php echo \$this->end(); ?>\n"; ?>
