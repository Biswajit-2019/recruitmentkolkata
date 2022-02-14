<table  class="formRight" id="tableForm" >
	<tr>
		<th colspan="2" class="add-menu"> Advertisement Inbox</th>
	</tr>
</table>
<div class="" style="float: right;"><a class="btn btn-primary" href="<?php echo base_url();?>admin/hindi/advertisement/add">Add Advertisement</a></div>
<div class="schedule-details">
	<div class="msg"><?php if($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?></div>
	<table id="tableForm" class="formRight1">
		<tr  class="raw">
			<td>Sl.</td>	
			<td>Advt. No.</td>
			<td>Date</td>
			<td>Action</td>
			<td>Action</td>
			<td>Action</td>
		</tr>
		<?php
		if(!empty($cms)){
		$i = 1;
		foreach($cms as $cmsVal){?>
		<tr>
			<td><b><?=$i;?></b></td>
			<td><b><?php echo $cmsVal->advt_no;?></b></td>
			<td><b><?php echo date("d-m-Y", strtotime($cmsVal->date));?></b></td>
			<td><a href="<?=base_url('admin/hindi/advertisement/result/');?>?id=<?=$cmsVal->id;?>">Result</a></td>
			<td><a href="<?=base_url('admin/hindi/advertisement/edit/');?>?id=<?=$cmsVal->id;?>">Edit</a></td>
			<td><a onclick="return confirm('Are you sure want to delete?');" href="<?=base_url();?>/admin/hindi/advertisement/delete/?id=<?=$cmsVal->id?>" class="applicationDetails">Delete</a></td>
		</tr>
		<?php $i++; } }else{?>
			<tr>
				<td colspan="5" style="text-align:center;">No Data Available.</td>
			</tr>
		<?php } ?>
	</table>
</div>
<div style="height:40px"></div>
<div class="pagination-nav">
	<?php echo pagination($num,$limit,$page);?>
</div>