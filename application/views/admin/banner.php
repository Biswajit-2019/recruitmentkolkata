<table  class="formRight" id="tableForm" >
<tr><th colspan="2" class="add-menu"> <a href="<?php echo base_url();?>admin/banner/add-banner">Add Banner</a></th></tr>
</table>
<div class="schedule-details">
<div class="msg"><?php if($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?></div>
<table id="tableForm" class="formRight1">
<tr  class="raw"><td>Banner Name</td>
<td>Banner Text</td>
<td>Banner Images</td>
<td>Action</td>
<td>Action</td>
</tr>
<?php foreach($cms as $cmsVal){?>
<tr><td><b><?php echo $cmsVal->title;?></b></td>
<td><b><?php echo $cmsVal->text;?></b></td>
<td><img src="<?php echo $cmsVal->images;?>" width="100"></td>
<td><a href="<?php echo base_url('admin/banner/delete/');?>?id=<?php echo $cmsVal->id;?>" onclick="return confirm('Are you sure  want to Delete  ?')">Delete</a></td>
<td><a href="<?php echo base_url('admin/banner/edit/');?>?id=<?php echo $cmsVal->id;?>">Edit</a></td>
</tr>
<?php } ?>
</table>
</div>
<div style="height:40px"></div>
<div class="pagination-nav">
<?php echo pagination($num,$limit,$page);?>
</div>