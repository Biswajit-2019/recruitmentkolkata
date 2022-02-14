<table  class="formRight" id="tableForm" >
	<tr>
		<th colspan="2" class="add-menu"> Training Inbox</th>
	</tr>
</table>
<div class="addadvertisement" style="float: right;"><a class="btn btn-primary" href="<?php echo base_url('admin/training/add');?>">Add Training Advertisement</a></div>
<div class="schedule-details">
	<div class="msg"><?php if($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?></div>
	<table id="tableForm" class="formRight1">
		<tr  class="raw">
			<td>Sl.</td>
			<td>Create Date</td>	
			<td>Action</td>
		</tr>
		<?php
		if(!empty($cms)){
		$i = 1;
		foreach($cms as $cmsVal){?>
		<tr>
			<td><b><?=$i;?></b></td>
			<td><b><?php echo date("d-m-Y", strtotime($cmsVal->create_date));?></b></td>
			<td><a href="<?=base_url('admin/training/edit/');?>?id=<?=$cmsVal->id;?>">Edit</a></td>
		</tr>
		<?php $i++; } }else{?>
			<tr>
				<td colspan="3" style="text-align:center;">No Data Available.</td>
			</tr>
		<?php } ?>
	</table>
</div>
<div style="height:40px"></div>
<div class="pagination-nav">
	<?php echo pagination($num,$limit,$page);?>
</div>