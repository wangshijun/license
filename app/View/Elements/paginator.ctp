<div class="pagination">
	<ul>
		<?php echo $this->BootstrapPaginator->prev(__('«'));?>
		<?php echo $this->BootstrapPaginator->numbers();?>
		<?php echo $this->BootstrapPaginator->next(__('»'));?>
		<li><a href='#'><?php echo $this->BootstrapPaginator->counter(__('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')); ?></a></li>
	</ul>
</div>
