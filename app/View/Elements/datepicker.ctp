<!-- 基于jQueryUI的静态日志Element -->

<?php

$month = isset($month) ? $month : date('m');
$year = isset($year) ? $year : date('Y');
$style = isset($style) ? $style : '';
$disabled = isset($disabled) ? $disabled : array();
$month_link = isset($month_link) ? $month_link : false;
$day_link = isset($day_link) ? $day_link : false;

$first_of_month = mktime(0, 0, 0, $month, 1, $year);
$num_days = cal_days_in_month(0, $month, $year);
$offset = date('w', $first_of_month);
$rows = 1;

?>
<div class="ui-datepicker-inline ui-datepicker ui-widget ui-widget-content ui-corner-all" style="<?php echo $style;?>">
	<div class="ui-datepicker-header ui-widget-header ui-helper-clearfix">
		<div class="ui-datepicker-title">
			<span class="ui-datepicker-year"><?php echo $year;?>年</span>
			<span class="ui-datepicker-month"><?php echo $month;?>月</span>
		</div>
	</div>
	<table class="ui-datepicker-calendar">
		<thead>
			<tr>
				<th class="ui-datepicker-week-end"><span title="Sunday">日</span></th>
				<th><span title="Monday">一</span></th>
				<th><span title="Tuesday">二</span></th>
				<th><span title="Wednesday">三</span></th>
				<th><span title="Thursday">四</span></th>
				<th><span title="Friday">五</span></th>
				<th class="ui-datepicker-week-end"><span title="Saturday">六</span></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<?php for( $i = 1; $i < $offset + 1; ++$i ): ?>
					<td class="ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled <?php echo in_array($i % 7, array(0,6)) ? "ui-datepicker-week-end" : "";?>">&nbsp;</td>
				<?php endfor; ?>

				<?php for( $day = 1; $day <= $num_days; ++$day ): ?>
					<?php if( ($day + $offset - 1) % 7 == 0 && $day != 1 ): ?>
						</tr><tr>
						<?php ++$rows; ?>
					<?php endif; ?>
					<?php if (in_array(sprintf('%s-%s-%s', $year, $month, $day), $disabled)): ?>
						<td title="已被锁定" class="ui-state-disabled <?php echo in_array($i % 7, array(0,6)) ? "ui-datepicker-week-end" : "";?>"><span class="ui-state-default"><?php echo $day;?></span></td>
					<?php else: ?>
						<td title="可以预订" class="<?php echo in_array($i % 7, array(0,6)) ? "ui-datepicker-week-end" : "";?>"><a class="ui-state-default" href="javascript:void(0)"><?php echo $day;?></a></td>
					<?php endif; ?>
				<?php endfor; ?>

				<?php for( $day; ($day + $offset) <= $rows * 7; ++$day ): ?>
					<td class="ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled <?php echo in_array($i % 7, array(0,6)) ? "ui-datepicker-week-end" : "";?>"">&nbsp;</td>
				<?php endfor; ?>
			<tr>
		</tbody>
	</table>
</div>