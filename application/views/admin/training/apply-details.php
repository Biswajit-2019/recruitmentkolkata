<script type="text/javascript">
$(document).ready(function(){
    var radio = $('input[name="status"]:checked').val();
    if(radio==1 || radio==0){
         $('.interviewDateTr').hide();
    }
    $("input:radio").click(function(){
        var value = $(this).val();
        if(value==1){
            $('.interviewDateTr').hide();
        }else{
            $('.interviewDateTr').show();
        }
    })
})
</script>
<div class="application-details">
    <div class="application-form-details">
        <!-- <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#home">APPLICATION FORM</a></li>
          <li><a data-toggle="tab" href="#menu1">FORMAT OF CERTIFICATE</a></li>
          <li><a data-toggle="tab" href="#menu2">SUMMARY</a></li>
        </ul> -->

        <div class="tab-content">
          <div id="home" class="tab-pane fade in active">
            <div class="application-form">
                <table  class="formRight ckedit" id="tableForm">
                    <tr>
                        <th colspan="2" class="add-menu"> Apply Form</th>
                    </tr>
                    <tr>
                        <td width="61"><b>Name of Candidate:</b></td>
                        <td width="240"><p><?=$apply_data->candidateName?></p></td>
                    </tr>
                     <tr>
                        <td width="61"><b>Name of College/ University:</b></td>
                        <td width="240"><p><?=$apply_data->institutionName?></p></td>
                    </tr>
                     <tr>
                        <td width="61"><b>Qualification:</b></td>
                        <td width="240"><p><?=$apply_data->qualification?></p></td>
                    </tr>
                     <tr>
                        <td width="61"><b>Contact:</b></td>
                        <td width="240"><p><?=$apply_data->contact?></p></td>
                    </tr>
                     <tr>
                        <td width="61"><b>Email:</b></td>
                         <td width="240"><p><?=$apply_data->email?></p></td>
                    </tr>
                    
                     <tr>
                        <td width="61"><b>Applying For:</b></td>
                        <?php
                        $applying_id = $apply_data->applying;
                        $applying_name = $this->Common_model->get_single('apply_mst', array('id'=>$applying_id))->name;
                         ?>
                        <td width="240"><p><?=$applying_name?></p></td>
                    </tr>
                     <tr>
                        <td width="61"><b>Permanent Address:</b></td>
                         <td width="240"><p><?=$apply_data->permanentAddress?></p></td>
                    </tr>
                     <tr>
                        <td width="61"><b>Messages:</b></td>
                       <td width="240"><p><?=$apply_data->messages?></p></td>
                    </tr>
<tr>
                            <td width="61"><b>Resume:</b></td>
                              <td width="240">
                               <?php if (is_file(FCPATH.'/'.$apply_data->uploadResume)) { ?>
                                <a target="_blank" href="<?=base_url().$apply_data->uploadResume?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> View</a>
                              <?php } ?>
                                
                            </td>
                        </tr>
                    <?php if($applying_id==4 || $applying_id==5){ ?>
                         
                        <tr>
                            <td width="61"><b>Marksheet:</b></td>
                              <td width="240">
                               <?php if (is_file(FCPATH.'/'.$apply_data->markSheet)) { ?>
                                <a target="_blank" href="<?=base_url().$apply_data->markSheet?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> View</a>
                              <?php } ?>
                                
                            </td>
                        </tr>
                        <tr>
                            <td width="61"><b>Certificate:</b></td>
                              <td width="240">
                               <?php if (is_file(FCPATH.'/'.$apply_data->certificate)) { ?>
                                <a target="_blank" href="<?=base_url().$apply_data->certificate?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> View</a>
                              <?php } ?>
                                
                            </td>
                        </tr>

                    <?php } ?>
                   
                    <tr>
                        <td width="61"><b>NOC from Parent Institute:</b></td>
                      <td width="240">
                       <?php if (is_file(FCPATH.'/'.$apply_data->document1)) { ?>
                        <a target="_blank" href="<?=base_url().$apply_data->document1?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> View</a>
                      <?php } ?>
                        
                    </td>
                    </tr>
                    <tr>
                        <td width="61"><b>Mark sheet till last Semester:</b></td>
                      <td width="240">
                       <?php if (is_file(FCPATH.'/'.$apply_data->document2)) { ?>
                        <a target="_blank" href="<?=base_url().$apply_data->document2?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> View</a>
                      <?php } ?>
                        
                    </td>
                    </tr>
                   
                </table>               
            </div>
          </div>
        </div>
    </div>
     <?php echo form_open_multipart('admin/training/details',array('id'=>'training-details-form'));?>
    <div class="application-form-right">
        <div class="user-image">
            <h3>Image:</h3>
            <div class="user-thumb"><img src="<?=base_url()?>/public/site/images/logo.png"  alt=""></div>
        </div>
        <div class="interviewsec">
            <?php 
                $status = $application->application_status;
                ?>
                <tr>
                    <td colspan="2">
                        <label for="interview"><input id="interview" <?=($status==3)?'checked':''?>  type="radio" name="status" value="3">Selected for Training</label> 
                       <!--  <label for="writtenTest"><input id="writtenTest" <?=($status==2)?'checked':''?> type="radio" name="status" value="2">Selected for Written Test</label> -->  
                        <label for="notSelected"><input id="notSelected" <?=($status==1)?'checked':''?> type="radio" name="status" value="1">Not Selected</label>
                    </td>
                </tr>
                <?php
                if($status==2){
                    $date = date("d-m-Y", strtotime($application->written_date));

                }elseif($status==3){
                     $date = date("d-m-Y", strtotime($application->interview_date));
                     
                }else{
                     $date = '';
                }
                ?>
                <div class="interviewDateTr">
                    <label width="61"><b>Date:</b></label>
                    <div width="240"><input type="text" class="datepicker" name="interviewDate" value="<?=$date?>"></div>
                </div>
                 <div>
                    <label align="right">&nbsp;</label>
                    <input type="hidden" name="id" value="<?=$application->id;?>" />
                    <div><input type="submit" name="add_result" value="Submit" class="add_menu"></div>
                </div>
        </div>
    </div>
</form>
    
    
    
    
</div>










