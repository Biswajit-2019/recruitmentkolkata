<table  class="formRight ckedit" id="tableForm">
<tr><th colspan="2" class="add-menu"> Update Website</th>
</tr>
<tr><td colspan="2" style="color:#049500; text-align:center; font-size:15px;"><?php //if($success==1){ echo "City Added Successfully"; }?></td><tr>
<tr><td colspan="2" style="color:#049500; text-align:center; font-size:15px;"><?php //if($_GET['status']==1){ echo "City Updated Successfully"; }?></td><tr>
<?php echo form_open_multipart('admin/all-website/update-website');?>
<tr>
<td width="61" align="right"><label>Website Title :</label></td>
<td width="240">
<input type="hidden" name="id" value="<?php echo $data[0]->id;?>">
<input type="text" name="title" value="<?php echo $data[0]->web_title;?>" />
</td>
</tr>

<tr>
<td width="61" align="right"><label>Website Icon :</label></td>
<td width="240">
<input type="file" name="fileup" />
</td>

</tr>
<tr>
<td></td>
<td width="240"><img src="<?php echo $data[0]->icon;?>"></td>
</tr>

<tr>
<td width="61" align="right"><label>Website Class :</label></td>
<td width="240">
<input type="text" name="webclass" value="<?php echo $data[0]->class;?>" />
</td>
</tr>

<tr>
<td width="61" align="right"><label>Website Link :</label></td>
<td width="240">
<input type="text" name="link" value="<?php echo $data[0]->link;?>">           
</td>
</tr>
<tr>
<td align="right">&nbsp;</td>
<td><input type="submit" name="update_website" value="Update Website" class="add_menu"></td>
</tr>

</form>

</table>







