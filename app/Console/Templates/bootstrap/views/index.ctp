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
<div class="<?php echo $pluralVar;?> index">
	<h2><?php echo "<?php echo __('{$pluralHumanName}');?>";?></h2>

<?php echo "\t<?php echo \$this->BootstrapForm->create('" . $modelClass . "', array('url' => array_merge(array('action' => 'search'), \$this->params['pass']), 'class' => 'search form-search form-inline'));?>\n"; ?>
<?php echo "\t\t<?php echo \$this->BootstrapForm->input('q', array('class' => 'short', 'placeholder' => __('type to search'), 'class' => 'input-medium search-query', 'label' => false, 'div' => false)); ?>\n"; ?>
<?php echo "\t\t<?php if (is_root_tenant()): ?>\n"; ?>
<?php echo "\t\t\t<?php echo \$this->BootstrapForm->input('tenant_id', array('validate' => 'min:1', 'label' => false, 'div' => false, 'class' => 'input-medium')); ?>\n"; ?>
<?php echo "\t\t<?php endif; ?>\n"; ?>
<?php echo "\t\t<?php echo \$this->BootstrapForm->button('<i class=\"icon-search\"></i> ' . __('Search'), array('class' => 'btn', 'div' => false));?>\n"; ?>
<?php echo "\t\t<?php echo \$this->Html->link('<i class=\"icon-plus\"></i> ' . __('Add'), array('action' => 'add'), array('class' => 'btn', 'escape' => false));?>\n"; ?>
<?php echo "\t\t<?php echo \$this->Html->link('<i class=\"icon-trash\"></i> ' . __('Recycle Bin'), array('action' => 'recycle_bin'), array('class' => 'btn', 'escape' => false));?>\n"; ?>
<?php echo "\t<?php echo \$this->BootstrapForm->end();?>\n"; ?>

<?php echo "\t<?php if (!empty(\$" . $pluralVar . ")): ?>\n";?>

	<table cellpadding="0" cellspacing="0" class="<?php echo $pluralVar;?> table table-bordered table-striped">
		<thead>
			<tr>
<?php foreach ($fields as $field): if (in_array($field, array('deleted', 'tenant_id', 'gmt_created', 'gmt_deleted')) === false): ?>
<?php echo "\t\t\t\t<th><?php echo \$this->Paginator->sort('{$field}');?></th>\n";?>
<?php endif; endforeach;?>
<?php echo "\t\t\t\t<th class=\"actions\"><?php echo __('Actions');?></th>\n";?>
			</tr>
		</thead>
		<tbody>
		<?php
		echo "<?php \$i = 0; foreach (\${$pluralVar} as \${$singularVar}): ?>\n";
		echo "\t\t\t<tr>\n";
			foreach ($fields as $field) {
				if (in_array($field, array('deleted', 'tenant_id', 'gmt_created', 'gmt_deleted')) !== false) {
					continue;
				}
				$isKey = false;
				if (!empty($associations['belongsTo'])) {
					foreach ($associations['belongsTo'] as $alias => $details) {
						if ($field === $details['foreignKey']) {
							$isKey = true;
							echo "\t\t\t\t<td>\n";
							echo "\t\t\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n";
							echo "\t\t\t\t</td>\n";
							break;
						}
					}
				}
				if ($isKey !== true) {
					echo "\t\t\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</td>\n";
				}
			}

			echo "\t\t\t\t<td class=\"actions\">\n";
			echo "\t\t\t\t\t<?php echo \$this->Html->link('<i class=\"icon-eye-open\"></i> ' . __('View'), array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape' => false, 'class' => 'btn btn-mini')); ?>\n";
			echo "\t\t\t\t\t<?php echo \$this->Html->link('<i class=\"icon-edit\"></i> ' . __('Edit'), array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape' => false, 'class' => 'btn btn-mini')); ?>\n";
			echo "\t\t\t\t\t<?php echo \$this->BootstrapForm->postLink('<i class=\"icon-trash\"></i> ' . __('Delete'), array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape' => false, 'class' => 'btn btn-mini'), __('Are you sure you want to delete # %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
			echo "\t\t\t\t</td>\n";
		echo "\t\t\t</tr>\n";

		echo "\t\t<?php endforeach; ?>\n";
		?>
		</tbody>
	</table>

<?php echo "\t\t<?php echo \$this->element('paginator'); ?>\n";?>

<?php echo "\t<?php else: ?>\n";?>

	<div class="alert alert-info">
		<a class="close" data-dismiss="alert">Ă</a>
		<strong><?php echo "<?php echo __('Oops');?>";?></strong> <?php echo "<?php echo __('No data found');?>", "\n";?>
	</div>

<?php echo "\t<?php endif; ?>\n";?>

</div>

<?php echo "<?php echo \$this->start('sidebar'); ?>\n"; ?>
<?php echo "<?php echo \$this->element('menu'); ?>\n"; ?>
<?php echo "<?php echo \$this->end(); ?>\n"; ?>
