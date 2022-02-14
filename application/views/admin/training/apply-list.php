<table  class="formRight" id="tableForm" >
	<tr>
		<th colspan="2" class="add-menu">Training Apply Inbox</th>
	</tr>
</table>
<div class="schedule-details">
	<div class="msg"><?php if($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?></div>
	<table id="tableForm" class="formRight1">
		<tr class="raw">
			<td>Sl.</td>
			<td>Name</td>	
			<td>Application No.</td>
			<td>Status</td>
			<td>Action</td>
			<td>Action</td>
		</tr>
		<?php if(!empty($cms)){
			$i= 1;
			foreach($cms as $value){
				$single_personal_data = $this->Common_model->get_single('training_apply_mst', array('application_no'=>$value->application_no));
		 ?> 
			<tr>
			<td><b><?=$i;?></b></td>
			<td><b><?=$single_personal_data->candidateName?></b></td>
			<td><b><?=$value->application_no?></b></td>
			<?php
			if($value->application_status==0){
			 	$status = 'Under Process';
			}elseif($value->application_status==1){
				 $status = 'Not Selected';
			}elseif($value->application_status==2){
				 $status = 'Written test';
			}else{
				 $status = 'Interview';
			}
			?>
			<td><b><?=$status?></b></td>
			<td><a href="<?=base_url();?>/admin/training/details/?id=<?=$value->id?>" class="applicationDetails">View</a></td>
			<td><a onclick="return confirm('Are you sure want to delete?');" href="<?=base_url();?>/admin/training/delete/?id=<?=$value->id?>" class="applicationDetails">Delete</a></td>
		</tr>
		<?php $i++; } }else{ ?>
			<tr>
				<td colspan="5">No. Data Found.</td>
			</tr>
		<?php } ?>
		
	</table>
</div>
<div style="height:40px"></div>
<div class="pagination-nav">
	<?php //echo pagination($num,$limit,$page);?>
</div>
