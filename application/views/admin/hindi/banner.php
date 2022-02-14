<table  class="formRight" id="tableForm" >
<tr><th colspan="2" class="add-menu"> <a href="<?php echo base_url();?>admin/hindi/banner/add-banner">Add Banner</a></th></tr>
</table>
<div class="schedule-details">
<p><?php if($this->session->flashdata('success')) { echo $this->session->flashdata('success');} ?></p>
<table id="tableForm" class="formRight1">
<tr  class="raw"><td>Banner Name</td>
<td>Banner Text</td>
<td>Banner Images</td>
<td>Action</td>
<td>Action</td>
</tr>
<?php foreach($banner as $bannerVal){?>
<tr><td><b><?php echo $bannerVal->title;?></b></td>
<td><b><?php echo $bannerVal->text;?></b></td>
<td><img src="<?php echo $bannerVal->images;?>" width="100"></td>
<td><a href="<?php echo base_url(); ?>admin/hindi/banner/delete?id=<?php echo $bannerVal->id;?>"  onclick="return confirm('Are you sure  want to Delete  ?')">Delete</a></td>
<td><a href="<?php echo base_url(); ?>admin/hindi/banner/edit?id=<?php echo $bannerVal->id;?>">Edit</a></td>
</tr>
<?php } ?>
</table>
</div>
<div style="height:40px"></div>
<div class="pagination-nav">
<?php echo pagination($num,$limit,$page);?>
</div>