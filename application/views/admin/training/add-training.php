<script type="text/javascript">
    $(document).ready(function(){
        $("#add_training_form").validate({
          rules: {
             important:{
              required: true  
            } 
            
          },
          messages: {
            important:{
                required:"This field is required."
            }
          }
        });
    })
</script>
<?php echo form_open_multipart('admin/training/add',array('id'=>'add_training_form'));?>
<table  class="formRight ckedit" id="tableForm">
<tr>
    <th colspan="2" class="add-menu"> Add Training</th>
</tr>
<tr>
    <td colspan="2" style="color:#f00; text-align:center; font-size:15px;"><?= $this->session->flashdata('errors'); ?></td>
<tr>
<tr>
    <td colspan="2" style="color:#049500; text-align:center; font-size:15px;"><?php //if($_GET['status']==1){ echo "City Updated Successfully"; }?>
    </td>
<tr>
<tr>
    <td width="61" align="right">
        <label>Important:</label>
    </td>
    <td width="240">
        <textarea name="important" id="editor1" rows="50" cols="80"><?= set_value('important'); ?></textarea>
        <script>CKEDITOR.replace( 'editor1' );</script>
    </td>
</tr>
<tr>
    <td align="right">&nbsp;</td>
    <td>
        <input type="submit" name="add_training" value="Add Training" class="add_menu">
    </td>
</tr>
</table>
</form>








