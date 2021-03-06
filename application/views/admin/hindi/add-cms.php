<script type="text/javascript">
  $(document).ready(function(){
  $("#advert_frm").validate({
      rules: {
          pageurl: {
          required: true,
          remote : "<?php echo base_url();?>admin/ajax_controller/check_advert_title_hindi"
        },
        title:{
          required: true  
        }
            
        
      },
      messages: {
        
        pageurl: {
          required: "Please enter page url",
          remote :"Page url already exists"
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
$parent=$this->Admin_model->getAll('hindi_cms_pages',$param,$order_by_fld='',$order_by='',$limit='',$offset='');?>
<?php echo form_open_multipart('admin/hindi/cms-page/add-cms',array('id'=>'advert_frm'));?>
<table  class="formRight ckedit" id="tableForm">

<tr><th colspan="2" class="add-menu"> Add CMS Page</th>
</tr>
<tr><td colspan="2" style="color:#049500; text-align:center; font-size:15px;"><?php //if($success==1){ echo "City Added Successfully"; }?></td><tr>
<tr><td colspan="2" style="color:#049500; text-align:center; font-size:15px;"><?php //if($_GET['status']==1){ echo "City Updated Successfully"; }?></td><tr>

<tr>
<td width="61" align="right"><label>Page Title :</label></td>
<td width="240">
<input type="text" name="title" />
</td>
</tr>

<tr>
<td width="61" align="right"><label>Page Url :</label></td>
<td width="240">
<input type="text" name="pageurl" />
</td>
</tr>

<tr>
<td width="61" align="right"><label>Meta Title :</label></td>
<td width="240">
<input type="text" name="metatitle" />
</td>
</tr>

<tr>
<td width="61" align="right"><label>Meta Keywords :</label></td>
<td width="240">
<input type="text" name="metakey" />
</td>
</tr>

<tr>
<td width="61" align="right"><label>Meta Description :</label></td>
<td width="240">
<textarea name="metadesc"></textarea>

</td>
</tr>

<tr>
<td width="61" align="right"><label>Page Content :</label></td>
<td width="240">
<textarea name="content" id="editor1" rows="50" cols="80">
</textarea>
<script>
              // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
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
<input type="file" name="fileup" value="">
</td>
</tr>
<tr>
<td width="61" align="right"><label>Parent Page :</label></td>
<td width="240">
<select name="parent">
<option value="" selected="selected" >Select</option>
<?php foreach($parent as $parentValue){?>
<option value="<?php echo $parentValue->id;?>"><?php echo $parentValue->page_title;?></option>
<?php 
$subPages=$this->Admin_model->getData('hindi_cms_pages',array('parent_id'=>$parentValue->id));
if($subPages!='')
{ foreach($subPages as $subValue){?>
<option value="<?php echo $subValue->id;?>">&nbsp;&nbsp;&nbsp;---<?php echo $subValue->page_title;?></option>
<?php  
$subsubPages=$this->Admin_model->getData('hindi_cms_pages',array('parent_id'=>$subValue->id));
if($subsubPages!='')
{ foreach($subsubPages as $subsubValue){?>

<option value="<?php echo $subsubValue->id;?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;---<?php echo $subsubValue->page_title;?></option>
 <?php } } } } }?>
</select>
</td>
</tr>

<tr>
<td width="61" align="right"><label>Page Menu Order :</label></td>
<td width="240">
<span class="radio-menu"><input type="radio" name="menu" value="header">Header</span>
<span class="radio-menu"><input type="radio" name="menu" value="footer">Footer</span>
<span class="radio-menu"><input type="radio" name="menu" value="other">Other</span>
</td>
</tr>

<tr style="color:#F00">
<td align="right">&nbsp;</td>
<td></td></tr>
<tr>
<td align="right">&nbsp;</td>
<td><input type="submit" name="add_page" value="Add Page" class="add_menu"></td>
</tr>

</table>
</form>
