
<!-- <table  class="formRight" id="tableForm" >
<tr><th colspan="2" class="add-menu"> <a href="<?php echo base_url();?>admin/cms-page/add-cms">Add Page</a></th></tr>
</table> -->
<div class="schedule-details">
<div class="msg"><?php echo $this->session->flashdata('msg'); ?></div>
<table id="tableForm" class="formRight1">
<tr  class="raw"><td>Tagline</td>
<td>Action</td>

</tr>
<?php 
if($single){

?>
<tr><td><b><?php echo $single[0]->tagline_text;?></b></td>
<td><a href="<?php echo base_url();?>admin/tagline/edit/<?php echo $single[0]->id;?>" >Edit</a></td>
</tr>

<?php }  ?>
</table>
</div>
