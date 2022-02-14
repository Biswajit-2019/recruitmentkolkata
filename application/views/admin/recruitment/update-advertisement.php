<script type="text/javascript">
    $(document).ready(function(){
        $("#update_advertisement_form").validate({
          rules: {
              advtNo: {
              required: true
            },
            date:{
              required: true  
            },
             vacancyDescription:{
              required: true  
            },
             vacancyDetails:{
                extension: "pdf"
            }
            
          },
          messages: {
            
            advtNo: {
              required: "This field is required."
            },
            date:{
              required:"This field is required."    
            },
            vacancyDescription:{
              required:"This field is required."
            },
            vacancyDetails:{
                extension: "Please upload file in these format only (pdf)."
            }
          }
        });
    })
</script>
<?php echo form_open_multipart('admin/advertisement/edit',array('id'=>'update_advertisement_form'));?>
<table  class="formRight ckedit" id="tableForm">
<tr>
    <th colspan="2" class="add-menu"> Edit Advertisement</th>
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
        <input type="text" name="advtNo" value="<?=$advertisement[0]->advt_no; ?>" >
    </td>
</tr>
<tr>
    <td width="61" align="right">
        <label>Date:</label>
    </td>
    <td width="240">
        <input type="text" class="datepicker" name="date" value="<?=date("d-m-Y", strtotime($advertisement[0]->date)); ?>">
    </td>
</tr>
<!-- <tr>
    <td width="61" align="right">
        <label>Vacancy:</label>
    </td>
    <td width="240">
        <input type="text" name="vacancy" value="<?=$advertisement[0]->vacancy; ?>">
    </td>
</tr> -->
<tr>
    <td width="61" align="right">
        <label>Brief Description for Vacancy:</label>
    </td>
    <td width="240">
        <textarea name="vacancyDescription" id="editor1222" rows="50" cols="80"><?= $advertisement[0]->vacancy_description; ?></textarea>
        <script>CKEDITOR.replace( 'editor1222',{filebrowserUploadMethod : 'form',
                filebrowserUploadUrl: '<?php echo base_url();?>public/ckeditor/ckupload.php?type=image',});</script>
    </td>

<!-- 
    <td width="240">
        <textarea name="vacancyDescription"><?=$advertisement[0]->vacancy_description; ?></textarea>
    </td> -->
</tr>
<tr>
    <td width="61" align="right">
        <label>Vacancy Details:</label>
    </td>
    <td width="240">
        <input type="file" name="vacancyDetails" >
    </td>
</tr>
 <?php if (is_file(FCPATH.'/'.$advertisement[0]->vacancy_details)) { ?>
<tr>
    <td></td>
    <td><a href="<?=base_url().$advertisement[0]->vacancy_details;?>" target="_blank">File</a></td>
</tr>
<?php } ?>
<tr>
    <td width="61" align="right">
        <label>Guideline Status:</label>
    </td>
    <td width="240">
       <select id="guideline_status" name="guideline_status" class="form-control">
            <option <?= ($advertisement[0]->guideline_status == 1) ? 'selected' : ''; ?> value="1">Show</option>
            <option <?= ($advertisement[0]->guideline_status == 0) ? 'selected' : ''; ?> value="0">Hide</option>
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
<?php if (is_file(FCPATH.'/'.$advertisement[0]->guideline)) { ?>
<tr>
    <td></td>
    <td><a href="<?=base_url().$advertisement[0]->guideline;?>" target="_blank">File</a></td>
</tr>
<?php } ?>
<tr>
    <td width="61" align="right">
        <label>Important:</label>
    </td>
    <td width="240">
        <textarea name="important" id="editor1" rows="50" cols="80"><?= $advertisement[0]->important_content; ?></textarea>
        <script>
            CKEDITOR.replace( 'editor1',{
                filebrowserUploadMethod : 'form',
                filebrowserUploadUrl: '<?php echo base_url();?>public/ckeditor/ckupload.php?type=image',
            });
        </script>
    </td>
</tr>
<tr>
    <td width="61" align="right">
        <label>Status:</label>
    </td>
    <td width="240">
       <select id="job_status" name="job_status" class="form-control">
            <option <?= ($advertisement[0]->job_status == 'Y') ? 'selected' : ''; ?> value="Y">New</option>
            <option <?= ($advertisement[0]->job_status == 'N') ? 'selected' : ''; ?> value="N">Old</option>
        </select>
    </td>
</tr>
<tr>
    <td align="right">&nbsp;</td>
    <td>
        <input type="hidden" name="id" value="<?=$advertisement[0]->id;?>" />
        <input type="submit" name="update_Advertisement" value="Update Advertisement" class="add_menu">
    </td>
</tr>
</table>
</form>








