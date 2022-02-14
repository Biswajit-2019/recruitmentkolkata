<?php echo $this->session->flashdata('msg'); ?>
<table  class="formRight" id="tableForm" >
<tr><th colspan="2" class="add-menu"> <a href="<?php echo base_url();?>admin/hindi/cms-page/add-cms">Add Page</a></th></tr>
</table>
<div class="schedule-details">
<table id="tableForm" class="formRight1">
<tr  class="raw"><td>Page Name</td>
<td>Action</td>
<td>Action</td>
</tr>
<?php foreach($cms as $cmsVal){?>
<tr><td><b><?php echo $cmsVal->page_title;?></b></td>
<td><a href="<?php echo base_url(); ?>admin/hindi/cms-page/delete?id=<?php echo $cmsVal->id;?>" onclick="return confirm('Are you sure  want to Delete  ?')">Delete </a></td>
<td><a href="<?php echo base_url();?>admin/hindi/cms-page/edit?id=<?php echo $cmsVal->id;?>" >Edit</a></td>
</tr>
<?php } ?>
</table>
</div>
<div style="height:40px"></div>
<div class="pagination-nav">
<?php echo pagination($num,$limit,$page);?>
</div>