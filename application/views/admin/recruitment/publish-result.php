<script type="text/javascript">
    $(document).ready(function(){
        $("#publish_result_form").validate({
          rules: {
             file:{
                required: true,
                extension: "pdf"
            }
          },
          messages: {
            file:{
                required:"This field is required.",
                extension: "Please upload file in these format only (pdf)."
            }
          }
        });
    })
</script>
<?php echo form_open_multipart('admin/advertisement/uploade',array('id'=>'publish_result_form'));?>
<table  class="formRight ckedit" id="tableForm">
    <tr>
        <th colspan="2" class="add-menu"> Publish Result</th>
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
            <input readonly="" type="text" name="advtNo" value="<?=$advertisement->advt_no; ?>">
        </td>
    </tr>
    <tr>
        <td width="61" align="right">
            <label>Vacancy:</label>
        </td>
        <td width="240">
            <input readonly="" type="text" name="vacancy" value="<?=$advertisement->vacancy; ?>">
        </td>
    </tr>
    <tr>
    <td width="61" align="right">
        <label>Result Status:</label>
    </td>
    <td width="240">
       <select id="result_status" name="result_status" class="form-control">
            <option <?= ($advertisement->result_status == 1) ? 'selected' : ''; ?> value="1">Show</option>
            <option <?= ($advertisement->result_status == 0) ? 'selected' : ''; ?> value="0">Hide</option>
        </select>
    </td>
</tr>
    <tr>
        <td width="61" align="right">
            <label>Result:</label>
        </td>
        <td width="240">
            <input type="file" name="file" >
            <label class="error" for="file"> <?= $this->session->flashdata('file'); ?></label>
             <span class="text-placeholder">Please upload only (pdf).</span>
        </td>
    </tr>
    <?php if (is_file(FCPATH.'/'.$advertisement->result)) { ?>
    <tr>
        <td></td>
        <td><a href="<?=base_url().$advertisement->result;?>" target="_blank">File</a></td>
    </tr>
    <?php } ?>
    <tr>
        <td align="right">&nbsp;</td>
        <input type="hidden" name="id" value="<?=$advertisement->id;?>" />
        <td><input type="submit" name="add_result" value="Submit" class="add_menu"></td>
    </tr>
</table>
</form>








