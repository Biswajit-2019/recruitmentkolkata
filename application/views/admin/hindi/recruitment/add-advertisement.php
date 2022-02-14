<script type="text/javascript">
    $(document).ready(function(){
        $("#advertisement_form").validate({
          rules: {
              advtNo: {
              required: true,
              remote : "<?php echo base_url();?>admin/ajax_controller/check_hindi_advt_no"
            },
            date:{
              required: true  
            },
             vacancyDescription:{
              required: true  
            },
             vacancyDetails:{
              required: true,
              extension: "pdf"  
            }
            
            
          },
          messages: {
            
            advtNo: {
              required: "This field is required.",
              remote :"Advt. No. already exists"
            },
            date:{
              required:"This field is required."    
            },
            vacancyDescription:{
              required:"This field is required."
            },
            vacancyDetails:{
              required:"This field is required.",
              extension: "Please upload file in these format only (pdf)."
            }
           
          }
        });
    })
</script>
<?php echo form_open_multipart('admin/hindi/advertisement/add',array('id'=>'advertisement_form'));?>
<table  class="formRight ckedit" id="tableForm">
<tr>
    <th colspan="2" class="add-menu"> Add Advertisement</th>
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
        <label>Advt. No. :</label>
    </td>
    <td width="240">
        <input type="text"  name="advtNo" value="<?= set_value('advtNo'); ?>">
    </td>
</tr>
<tr>
    <td width="61" align="right">
        <label>Date:</label>
    </td>
    <td width="240">
        <input type="text" class="datepicker" name="date" value="<?= set_value('date'); ?>">
    </td>
</tr>

<tr>
    <td width="61" align="right">
        <label>Brief Description for Vacancy:</label>
    </td>
    <td width="240">
        <textarea name="vacancyDescription" id="editor1555" rows="50" cols="80"><?= set_value('vacancyDescription'); ?></textarea>
        <script>CKEDITOR.replace( 'editor1555',{
                filebrowserUploadMethod : 'form',
                filebrowserUploadUrl: '<?php echo base_url();?>public/ckeditor/ckupload.php?type=image',
            });</script>
    </td>
</tr>
<tr>
    <td width="61" align="right">
        <label>Vacancy Details:</label>
    </td>
    <td width="240">
        <input type="file" name="vacancyDetails" >
    </td>
</tr>
<tr>
    <td width="61" align="right">
        <label>Guideline Status:</label>
    </td>
    <td width="240">
       <select id="guideline_status" name="guideline_status" class="form-control">
            <option value="1">Show</option>
            <option value="0">Hide</option>
        </select>
    </td>
</tr>
<tr>
    <td width="61" align="right">
        <label>Guidelines for Online Examination:</label>
    </td>
    <td width="240">
        <input type="file" name="guidelines">
    </td>
</tr>
<tr>
    <td width="61" align="right">
        <label>Important:</label>
    </td>
    <td width="240">
        <textarea name="important" id="editor1" rows="50" cols="80"><?= set_value('important'); ?></textarea>
        <script>CKEDITOR.replace( 'editor1',{
                filebrowserUploadMethod : 'form',
                filebrowserUploadUrl: '<?php echo base_url();?>public/ckeditor/ckupload.php?type=image',
            });</script>
    </td>
</tr>
<tr>
    <td align="right">&nbsp;</td>
    <td>
        <input type="submit" name="add_Advertisement" value="Add Advertisement" class="add_menu">
    </td>
</tr>
</table>
</form>








