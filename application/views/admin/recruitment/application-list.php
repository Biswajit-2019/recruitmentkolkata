<table  class="formRight" id="tableForm" >
	<tr>
		<th colspan="2" class="add-menu"> Application Inbox</th>
	</tr>
</table>
<div class="schedule-details">
	<div class="msg"><?php if($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?></div>
	<table id="tableForm" class="formRight1">
		<tr class="raw">
			<td>Sl.</td>
			<td>Name</td>	
			<td>Advt. No.</td>
			<td>Application No.</td>
			<td>Date</td>
			<td>Status</td>
			<td>Action</td>
			<td>Action</td>
		</tr>
		<?php if(!empty($cms)){
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$i= $page+1;
			foreach($cms as $value){
				$single_personal_data = $this->Common_model->get_single('personal_mst', array('application_no'=>$value->application_no));
		 ?> 
			<tr>
			<td><b><?=$i;?></b></td>
			<td><b><?=($single_personal_data->user_name)?$single_personal_data->user_name:''?></b></td>
			<td><b><?=$value->advertise_id?></b></td>
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
			<td><b><?=date("d-m-Y g:i a", strtotime($value->updated_at));?></b></td>
			<td><b><?=$status?></b></td>
			<td><a href="<?=base_url();?>/admin/application/details/?id=<?=$value->id?>" class="applicationDetails">View</a></td>
			<td><a onclick="return confirm('Are you sure want to delete?');" href="<?=base_url();?>/admin/application/delete/?id=<?=$value->id?>" class="applicationDetails">Delete</a></td>
		</tr>
		<?php $i++; } }else{ ?>
			<tr>
				<td colspan="8">No. Data Found.</td>
			</tr>
		<?php } ?>
		
	</table>
</div>
<div style="height:40px"></div>
<?php if(!empty($cms)){?>
<div class="pagination-nav">
	<?php 
		$page1 = ($this->uri->segment(3)) ? $this->uri->segment(3)+1 : 1;
	?>
		<p><?=$page1?> - <?=$i-1?> of <?=$totalCount?> properties</p>
	<?php echo $links;?>
</div>
<?php } ?>
