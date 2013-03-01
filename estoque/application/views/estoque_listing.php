<?php echo $data_table; ?>
<br />
<div id="pager" class="pager">
	<form>
		<img src="<?php echo base_url(); ?>assets/css/images/first.png" class="first"/>
		<img src="<?php echo base_url(); ?>assets/css/images/prev.png" class="prev"/>
		<input type="text" class="pagedisplay"/>
		<img src="<?php echo base_url(); ?>assets/css/images/next.png" class="next"/>
		<img src="<?php echo base_url(); ?>assets/css/images/last.png" class="last"/>
		<select class="pagesize">
			<option selected="selected"  value="10">10</option>
		</select>
	</form>
</div>
