<table class="table table-bordered building_block" style="width:auto;">
	<tbody>
	<?php for ($i=1; $i<=($max_floor_count-$block['floor_count']); $i++): // no exists rooms ?>
		<tr>
		<?php for ($j=1; $j<=$block['room_count']; $j++):?>
			<td class="none">&nbsp;</td>
		<?php endfor; ?>
		</tr>
	<?php endfor; ?>
	<?php for ($i=$block['floor_count']; $i>=1; $i--): // existing rooms ?>
		<tr>
		<?php foreach ($block['rooms'][$i] as $room_id => $room_number):?>
			<td class="<?php echo $room_types[$room_id]; ?>" title="<?php echo __('View Building Resident'); ?>"><?php echo $this->Html->link($room_number, array('controller' => 'building_residents', 'action' => 'index', 'building_room_id' => $room_id)); ?></td>
		<?php endforeach; ?>
		</tr>
	<?php endfor; ?>
	</tbody>
	<tfoot>
		<tr>
			<td class="name" colspan="<?php echo $block['room_count']; ?>"><?php echo $block['name']; ?></td>
		</tr>
	</tfoot>
</table>
