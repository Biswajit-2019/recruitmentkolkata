<script type="text/javascript">
  $(document).ready(function(){
  $("#addWebsite").validate({
      rules: {
          
        title:{
          required: true  
        },
	link:{
          required: true  
        }
            
        
      },
      
    });
  
});
</script>
<?php echo form_open_multipart('admin/all-website/add-website',array('id' => 'addWebsite'));?>
<table  class="formRight ckedit" id="tableForm">

<tr><th colspan="2" class="add-menu"> Add Website</th>
</tr>
<tr><td colspan="2" style="color:#049500; text-align:center; font-size:15px;"><?php //if($success==1){ echo "City Added Successfully"; }?></td><tr>
<tr><td colspan="2" style="color:#049500; text-align:center; font-size:15px;"><?php //if($_GET['status']==1){ echo "City Updated Successfully"; }?></td><tr>

<tr>
<td width="61" align="right"><label>Website Title :</label></td>
<td width="240">
<input type="text" name="title" />
</td>
</tr>

<tr>
<td width="61" align="right"><label>Website Icon :</label></td>
<td width="240">
<input type="file" name="fileup" />
</td>
</tr>

<tr>
<td width="61" align="right"><label>Website Class :</label></td>
<td width="240">
<input type="text" name="webclass" />
</td>
</tr>

<tr>
<td width="61" align="right"><label>Website Link :</label></td>
<td width="240">
<input type="text" name="link" value="">           
</td>
</tr>


<tr style="color:#F00">

<td align="right">&nbsp;</td>

<td><?php //if($error==1){ echo $msg;}?></td></tr>



<tr>

<td align="right">&nbsp;</td>

<td><input type="submit" name="add_banner" value="Add Website" class="add_menu"></td>

</tr>



</table>

</form>





