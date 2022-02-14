<table  class="formRight" id="tableForm" >
<tr><th colspan="2" class="add-menu"> <a href="<?php echo base_url();?>admin/all-website/add-website">Add Website</a></th></tr>
</table>
<div class="schedule-details">
<div class="msg"><?php if($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?></div>
<table id="tableForm" class="formRight1">
<tr  class="raw"><td>Website Title</td>
<td>Website Link</td>
<td>Action</td>
<td>Action</td>
</tr>
<?php foreach($cms as $cmsVal){?>
<tr><td><b><?php echo $cmsVal->web_title;?></b></td>
<td><b><?php echo $cmsVal->link;?></b></td>
<td><a href="<?php echo base_url();?>admin/all-website/delete?id=<?php echo $cmsVal->id;?>" onclick="return confirm('Are you sure?')">Delete</a></td>
<td><a href="<?php echo base_url();?>admin/all-website/update-website?id=<?php echo $cmsVal->id;?>">Edit</a></td>
</tr>
<?php } ?>
</table>
</div>
<div style="height:40px"></div>
<div class="pagination-nav">
<?php echo pagination($num,$limit,$page);?>
</div>