<table  class="formRight ckedit" id="tableForm">
<tr><th colspan="2" class="add-menu"> Add Banner</th>
</tr>
<tr><td colspan="2" style="color:#049500; text-align:center; font-size:15px;"><?php //if($success==1){ echo "City Added Successfully"; }?></td><tr>
<tr><td colspan="2" style="color:#049500; text-align:center; font-size:15px;"><?php //if($_GET['status']==1){ echo "City Updated Successfully"; }?></td><tr>
<?php echo form_open_multipart('admin/banner/edit');?>
<tr>
<td width="61" align="right"><label>Banner Title :</label></td>
<td width="240">
<input type="hidden" name="id" value="<?php echo $banner[0]->id;?>" />
<input type="text" name="title" value="<?php echo $banner[0]->title;?>" />
</td>
</tr>
<tr>
<td width="61" align="right"><label>Banner Description :</label></td>
<td width="240">
<textarea name="content" id="editor1" rows="50" cols="80">
            <?php echo $banner[0]->text;?>
            </textarea>
<script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
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
<td></td>
<input type="hidden" name="images" value="<?php echo $banner[0]->images;?>">
<td><img src="<?php echo $banner[0]->images;?>" width="100px"></td>
</tr>
<tr style="color:#F00">

<td align="right">&nbsp;</td>

<td><?php //if($error==1){ echo $msg;}?></td></tr>



<tr>

<td align="right">&nbsp;</td>

<td><input type="submit" name="add_banner" value="Update Banner" class="add_menu"></td>

</tr>

</form>

</table>







