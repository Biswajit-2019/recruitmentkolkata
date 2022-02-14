<script type="text/javascript">
  $(document).ready(function(){
  $("#advert_frm").validate({
      rules: {
          pageurl: {
          required: true,
          
        },
        title:{
          required: true  
        }
            
        
      },
      messages: {
        
        pageurl: {
          required: "Please enter page url",
          
        },
        title:{
          required:"Please select currency type",     
        }
      }
    });
  
});
</script>
<?php 
$param=array('parent_id'=>0);
$parent=$this->Admin_model->getAll('cms_pages',$param,$order_by_fld='',$order_by='',$limit='',$offset='');
?>
<?php echo form_open_multipart('admin/cms-page/editcms');?>
<table  class="formRight ckedit" id="tableForm">

<tr><th colspan="2" class="add-menu"> Edit CMS Page</th>

</tr>
<tr><td colspan="2" style="color:#049500; text-align:center; font-size:15px;"><?php //if($success==1){ echo "City Added Successfully"; }?></td><tr>
<tr><td colspan="2" style="color:#049500; text-align:center; font-size:15px;"><?php //if($_GET['status']==1){ echo "City Updated Successfully"; }?></td><tr>



<tr>
<input type="hidden" name="id" value="<?php echo $cms_row[0]->id; ?>">
<td width="61" align="right"><label>Page Title :</label></td>
<td width="240">
<input type="text" name="title"  value="<?php echo  $cms_row[0]->page_title ; ?>"/>
</td>
</tr>

<tr>
<td width="61" align="right"><label>Page Url :</label></td>
<td width="240">
<input type="text" name="pageurl" value="<?php echo  $cms_row[0]->slug; ?>" />
</td>
</tr>

<tr>
<td width="61" align="right"><label>Meta Title :</label></td>
<td width="240">
<input type="text" name="metatitle" value="<?php echo  $cms_row[0]->meta_title; ?>" />
</td>
</tr>

<tr>
<td width="61" align="right"><label>Meta Keywords :</label></td>
<td width="240">
<input type="text" name="metakey" value="<?php echo  $cms_row[0]->meta_keywords; ?>" />
</td>
</tr>

<tr>
<td width="61" align="right"><label>Meta Description :</label></td>
<td width="240">
<textarea name="metadesc">
	<?php echo  $cms_row[0]->meta_description; ?>

</textarea>

</td>
</tr>


<tr>
<td width="61" align="right"><label>Page Content :</label></td>
<td width="240">
<textarea name="content" id="editor1" rows="50" cols="80">
  <?php echo  $cms_row[0]->content  ; ?>              
            </textarea>
<script>
                 CKEDITOR.replace( 'editor1',{

                  filebrowserUploadMethod : 'form',
     
                  filebrowserUploadUrl: '<?php echo base_url();?>public/ckeditor/ckupload.php?type=image',
                } );
            </script>
</td>
</tr>



<tr>



<td width="61" align="right"><label>Image :</label></td>
<td width="240">
<input type="file" name="fileup" value="<?php echo  $cms_row[0]->image;?>">
</td>
</tr>

<tr>



<td width="61" align="right"><label>Parent Page :</label></td>
<td width="240">
<select name="parent">
<option value="" selected="selected" >Select</option>
<?php foreach($parent as $parentValue){?>
<option value="<?php echo $parentValue->id;?>" <?php if($parentValue->id==$cms_row[0]->parent_id) { echo "selected";};?>><?php echo $parentValue->page_title;?></option>
<?php 
$subPages=$this->Admin_model->getData('cms_pages',array('parent_id'=>$parentValue->id));
if($subPages!='')
{ foreach($subPages as $subValue){?>
<option value="<?php echo $subValue->id;?>" <?php if($subValue->id==$cms_row[0]->parent_id) { echo "selected";};?>>&nbsp;&nbsp;&nbsp;---<?php echo $subValue->page_title;?></option>
<?php  
$subsubPages=$this->Admin_model->getData('cms_pages',array('parent_id'=>$subValue->id));
if($subsubPages!='')
{ foreach($subsubPages as $subsubValue){?>

<option value="<?php echo $subsubValue->id;?>" <?php if($subsubValue->id==$cms_row[0]->parent_id) { echo "selected";};?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;---<?php echo $subsubValue->page_title;?></option>
 <?php } } } } }?>
</select>
</td>

</tr>


<tr>
<td width="61" align="right"><label>Page Menu Order :</label></td>
<td width="240">
<span class="radio-menu"><input type="radio" name="menu" <?php if($cms_row[0]->header=='Y'){ echo "checked";}?> value="header">Header</span>
<span class="radio-menu"><input type="radio" name="menu" <?php if($cms_row[0]->footer=='Y'){ echo "checked";}?> value="footer">Footer</span>
<span class="radio-menu"><input type="radio" name="menu" <?php if($cms_row[0]->other=='Y'){ echo "checked";}?> value="other">Other</span>
</td>
</tr>

<tr style="color:#F00">

<td align="right">&nbsp;</td>

<td><?php //if($error==1){ echo $msg;}?></td></tr>



<tr>

<td align="right">&nbsp;</td>

<td><input type="submit" name="edit_page" value="Edit Page" class="add_menu"></td>

</tr>



</table>
</form>






