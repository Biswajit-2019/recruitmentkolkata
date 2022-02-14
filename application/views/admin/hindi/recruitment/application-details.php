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
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#home">APPLICATION FORM</a></li>
          <li><a data-toggle="tab" href="#menu1">FORMAT OF CERTIFICATE</a></li>
          <li><a data-toggle="tab" href="#menu2">SUMMARY</a></li>
        </ul>

        <div class="tab-content">
          <div id="home" class="tab-pane fade in active">
            <div class="application-form">
                <table  class="formRight ckedit" id="tableForm">
                    <tr>
                        <th colspan="2" class="add-menu"> Application Form</th>
                    </tr>
                    <tr>
                        <td width="61"><b>Advt. No.:</b></td>
                        <td width="240"><p><?=$application->advertise_id?></p></td>
                    </tr>
                     <tr>
                        <td width="61"><b>Post Applied For:</b></td>
                        <td width="240"><p><?=$personal_data->post_for?></p></td>
                    </tr>
                     <tr>
                        <td width="61"><b>Discipline:</b></td>
                        <td width="240"><p><?=$personal_data->discipline?></p></td>
                    </tr>
                     <tr>
                        <td width="61"><b>Post Code:</b></td>
                        <td width="240"><p><?=$personal_data->post_code?></p></td>
                    </tr>
                     <tr>
                        <td width="61"><b>Name in full(CAPITAL):</b></td>
                         <td width="240"><p><?=$personal_data->user_name?></p></td>
                    </tr>
                    
                     <tr>
                        <td width="61"><b>Father’s name:</b></td>
                        <td width="240"><p><?=$personal_data->father_name?></p></td>
                    </tr>
                     <tr>
                        <td width="61"><b>Mother’s name:</b></td>
                         <td width="240"><p><?=$personal_data->mother_name?></p></td>
                    </tr>
                     <tr>
                        <td width="61"><b>Date of Birth:</b></td>
                       <td width="240"><p><?=date("d-m-Y", strtotime($personal_data->date_of_birth))?></p></td>
                    </tr>
                    <tr>
                        <td width="61"><b>Date of Birth Proff:</b></td>
                      <td width="240">
                       <?php if (is_file(FCPATH.'/'.$personal_data->birth_date_proof)) { ?>
                        <a target="_blank" href="<?=base_url().$personal_data->birth_date_proof?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> View</a>
                      <?php } ?>
                        
                    </td>
                    </tr>
                    <tr>
                        <td width="61"><b>Age as on closing date mentioned in Advt.:</b></td>
                        <td width="240"><p><?=$personal_data->closing_date?></p></td>
                    </tr>
                    <tr>
                        <td width="61"><b>Sex:</b></td>
                         <td width="240"><p><?=$personal_data->gender?></p></td>
                    </tr>
                    <tr>
                        <td width="61"><b>Marital Status:</b></td>
                        <td width="240"><p><?=$personal_data->marital_status?></p></td>
                    </tr>

                     <tr>
                        <td width="61"><b>Nationality:</b></td>
                        <td width="240"><p><?=$personal_data->nationality?></p></td>
                    </tr>
                     <tr>
                        <td width="61"><b>Reservation Category:</b></td>
                        <td width="240"><p><?=$personal_data->caste?></p></td>
                    </tr>
                    <tr>
                        <td width="61"><b>Reservation Category Proff:</b></td>
                      <td width="240">
                        <?php if (is_file(FCPATH.'/'.$personal_data->caste_attach_file)) { ?>
                        <a target="_blank" href="<?=base_url().$personal_data->caste_attach_file?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> View</a>
                      <?php } ?>
                    </td>
                    </tr>

                     <tr>
                        <td width="61"><b>Central/State Govt./Armed Forces/ PSU’s/Others:</b></td>
                         <td width="240"><p><?=$personal_data->central_state_govt?></p></td>
                    </tr>
                     <tr>
                        <td width="61"><b>Address for correspondence (with Pin Code):</b></td>
                        <td width="240"><p><?=$personal_data->address?></p></td>
                    </tr>
                     <tr>
                        <td width="61"><b>Permanent Address (with Pin Code):</b></td>
                        <td width="240"><p><?=$personal_data->permanent_address?></p></td>
                    </tr>
                     <tr>
                        <td width="61"><b>Nearest Railway Station:</b></td>
                         <td width="240"><p><?=$personal_data->nearest_railway_station?></p></td>
                    </tr>
                </table>
                <h3>Educational Qualifications ( Write “ NA ” if any field is not applicable )</h3>
                <table class="educational-qualifications">
                    <thead>
                        <tr>
                            <th>Exam Passed</th>
                            <th>University/Institution / Board</th>
                            <th>Year of Enrolment</th>
                            <th>Year of Completion</th>
                            <th>Subject in which Degree is awarded</th>
                            <th>Specialisation as reqd. in advt(if any)</th>
                            <th>**Percentage of Marks</th>
                            <th>Division</th>
                            <th>Rank/posotion in Univ.</th>
                            <th>Upload Final Marksheet</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($education)){ 
                            foreach($education as $value){
                            ?> 
                            <tr>
                            <td><?=$value->examPassed?></td>
                            <td><?=$value->examBoard?></td>
                            <td><?=$value->yearOfEnrolment?></td>
                            <td><?=$value->yearOfCompletion?></td>
                            <td><?=$value->subjectDegreeAwarded?></td>
                            <td><?=$value->specialisationAdvt?></td>
                            <td><?=$value->percentageOfMarks?></td>
                            <td><?=$value->division?></td>
                            <td><?=$value->rankPosotionInUniv?></td>
                            <td>
                                 <?php if (is_file(FCPATH.'/'.$value->certificate)) { ?>
                                <a target="_blank" href="<?=base_url().$value->certificate?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> View</a>
                              <?php } ?>

                            </td>
                        </tr>
                        <?php } } ?>

                    </tbody>
                </table>
                <h3>Professional Training</h3>
                <table class="professional-training">
                    <thead>
                        <tr>
                            <th>Organisation</th>
                            <th>Period-From</th>
                            <th>Period-To</th>
                            <th>Details of Training</th>
                            <th>Upload Certificate</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($professional)){ 
                            foreach($professional as $value){
                            ?>
                        <tr>
                            <td><?=$value->organisation?></td>
                            <td><?=$value->periodFrom?></td>
                            <td><?=$value->periodTo?></td>
                            <td><?=$value->detailsOfTraining?></td>
                            <td>
                                <?php if (is_file(FCPATH.'/'.$value->certificate)) { ?>
                                <a target="_blank" href="<?=base_url().$value->certificate?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> View</a>
                              <?php } ?>

                            </td>
                        </tr>
                    <?php } }else{ ?>
                        <tr><td colspan="5">No Data Found.</td></tr>
                     <?php } ?>
                    </tbody>
                </table>
                <h3>Employment Record (Attach separate sheet in following format, if necessary):</h3>
                <table class="employment-record">
                <thead>
                    <tr>
                        <th>Name & address of employer/Orgn/Institution</th>
                        <th>Period of Service-From</th>
                        <th>Period of Service-To</th>
                        <th>Designation of the post held</th>
                        <th>Scale of pay of each post</th>
                        <th>Brief Description of Work</th>
                        <th>Reason for leaving</th>
                        <th>Upload</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($employment)){ 
                        foreach($employment as $value){
                        ?>
                    <tr>
                        <td><?=$value->name?></td>
                        <td><?=$value->periodOfServiceFrom?></td>
                        <td><?=$value->periodOfServiceTo?></td>
                        <td><?=$value->designation?></td>
                        <td><?=$value->scaleOfPayOfEachPost?></td>
                        <td><?=$value->brief?></td>
                        <td><?=$value->reasonForLeaving?></td>
                        <td>
                            <?php if (is_file(FCPATH.'/'.$value->certificate)) { ?>
                                <a target="_blank" href="<?=base_url().$value->certificate?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> View</a>
                              <?php } ?>
                        </td>
                    </tr>
                     <?php } }else{ ?>
                        <tr><td colspan="8">No Data Found.</td></tr>
                     <?php } ?>
                </tbody>
                </table>

                <table  class="formRight ckedit">

                 <tr>
                    <td width="61"><b>Present Basic pay:</b></td>
                    <td width="240"><p><?=$others->presentBasicPay?></p></td>
                </tr>
                <tr>
                    <td width="61"><b>Total Emoluments:</b></td>
                    <td width="240"><p><?=$others->totalEmoluments?></p></td>
                </tr>
                <tr>
                    <td width="61"><b>Total Emoluments:</b></td>
                    <td width="240"><p><?=$others->totalEmoluments?></p></td>
                </tr>
                <tr>
                    <td width="61"><b>Whether the present post is held on regular or ad-hoc basis:</b></td>
                    <td width="240"><p><?=$others->presentPostHeld?></p></td>
                </tr>

                <tr>
                    <td width="61"><b>Attach NOC(if any):</b></td>
                    <td width="240"><p>
                         <?php if (is_file(FCPATH.'/'.$others->attachNocFile)) { ?>
                                <a target="_blank" href="<?=base_url().$others->attachNocFile?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> View</a>
                              <?php } ?>
                       
                    </p></td>
                </tr>
                <tr>
                    <td width="61"><b>Are you under any contractual obligations to serve Central/State Govt/Any other Public Sector Undertaking or Autonomous body and if so, give details :</b></td>
                    <td width="240"><p><?=$others->publicSectorUndertaking?></p></td>
                </tr>
                </table>
                <h3>Have you been interviewed for any recruitment/selection by SAMEER during the past one year? If yes, give particulars:</h3>
                <table class="interviewed-recruitment">
                    <thead>
                        <tr>
                            <th>Sr. No</th>
                            <th>Particulars(eg. Date of Advt, Advt. No.)</th>
                            <th>Name of Posts & Discipline</th>
                            <th>Date of Interview</th>
                            <th>Result</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?=$others->srNo?></td>
                        <td><?=$others->particulars?></td>
                        <td><?=$others->nameOfPosts?></td>
                        <td><?=$others->dateOfInterview?></td>
                        <td><?=$others->result?></td>
                    </tr>
                </tbody>
                </table>
                <h3>Details of relatives already employed in SAMEER:</h3>
                <table class="employed-details">
                <thead>
                    <tr>
                        <th>Name of the Relative</th>
                        <th>Relationship</th>
                        <th>Lab/Estt in which employed</th>
                        <th>Post Held</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?=$others->nameOfTheRelative?></td>
                        <td><?=$others->relationship?></td>
                        <td><?=$others->labEmployed?></td>
                        <td><?=$others->postHeld?></td>
                    </tr>
                </tbody>
                </table>
                <h3>Give two referees’ name & address and attach certificate from them:(Not related to the candidates) (Gazetted Officers/Professors of reputed academic Institutions/Public Sector Executives etc)</h3>
                <table class="referees-name">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Upload Doc</th>

                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?=$others->refereesName?></td>
                        <td><?=$others->refereesAddress?></td>
                        <td>
                            <?php if (is_file(FCPATH.'/'.$others->refereesEmployProof)) { ?>
                                <a target="_blank" href="<?=base_url().$others->refereesEmployProof?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> View</a>
                              <?php } ?>
                            </td>
                    </tr>
                    <tr>
                        <td><?=$others->refereesName1?></td>
                        <td><?=$others->refereesAddress1?></td>
                         <td>
                            <?php if (is_file(FCPATH.'/'.$others->refereesEmployProof1)) { ?>
                                <a target="_blank" href="<?=base_url().$others->refereesEmployProof1?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> View</a>
                              <?php } ?>
                            </td>
                    </tr>
                </tbody>
                </table>
                <table  class="formRight ckedit">
                <tr>
                    <td width="61"><b>Any other information you may wish to add, including extra curricular activities :</b></td>
                    <td width="240"><p><?=$others->otherInformation?></p></td>
                </tr>
                <tr>
                    <td width="61"><b>Signature :</b></td>
                    <td width="240"><p> 
                         <?php if (is_file(FCPATH.'/'.$others->signature)) { ?>
                                <a target="_blank" href="<?=base_url().$others->signature?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> View</a>
                              <?php } ?>

                        </p></td>
                </tr>
                
                </table>
                </form>
            </div>
          </div>
          <div id="menu1" class="tab-pane fade">
            <h3>Formate Of Certificate</h3>
                <?php if (is_file(FCPATH.'/'.$application->formatOfCertificate)) { ?>
                    <a target="_blank" href="<?=base_url().$application->formatOfCertificate?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> View</a>
                  <?php } ?>    
          </div>
          <div id="menu2" class="tab-pane fade">
            <div class="summary">
                <table  class="formRight ckedit" id="tableForm">
                    <tr>
                        <th colspan="2" class="add-menu"> Summary of Application</th>
                    </tr>
                    <tr>
                        <td width="61"><b>Advt. No.:</b></td>
                        <td width="240"><p><?=$summary_mst->advertiseNo?></p></td>
                    </tr>
                    <tr>
                        <td width="61"><b>Post Applied For:</b></td>
                        <td width="240"><p><?=$summary_mst->post?></p></td>
                    </tr>
                     <tr>
                        <td width="61"><b>Discipline:</b></td>
                        <td width="240"><p><?=$summary_mst->discipline?></p></td>
                    </tr>
                     
                     <tr>
                        <td width="61"><b>Post Code:</b></td>
                        <td width="240"><p><?=$summary_mst->postCode?></p></td>
                    </tr>
                     <tr>
                        <td width="61"><b>Name:</b></td>
                         <td width="240"><p><?=$summary_mst->name?></p></td>
                    </tr>
                    <tr>
                        <td width="61"><b>DOB:</b></td>
                         <td width="240"><p><?=date("d-m-Y", strtotime($summary_mst->dateOfBirth))?></p></td>
                    </tr>
                     <tr>
                        <td width="61"><b>Nationality:</b></td>
                        <td width="240"><p><?=$summary_mst->nationality?></p></td>
                    </tr>
                     <tr>
                        <td width="61"><b>Reservation Category:</b></td>
                         <td width="240"><p><?=$summary_mst->category?></p></td>
                    </tr>
                     <tr>
                        <td width="61"><b>Age as on Closing Date:</b></td>
                       <td width="240"><p><?=$summary_mst->closingDate?></p></td>
                    </tr>
                    <tr>
                        <td width="61"><b>Central/State Govt./Armed Forces/ PSU’s/Others:</b></td>
                      <td width="240"><p><?=$summary_mst->centralStateGovt?></p></td>
                    </tr>
                </table>
                <h3>Essential Qualification for Applied Post</h3>
                <table class="educational-qualifications">
                    <thead>
                        <tr>
                            <th>Exam Passed</th>
                            <th>University / Board</th>
                            <th>Subject</th>
                            <th>Year of Enrollment</th>
                            <th>Year of Completion</th>
                            <th>Marks ( % )</th>
                            <th>Div/Gde</th>
                            <th>Upload Certificate</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($summary_eq_mst)){ 
                            
                            ?> 
                            <tr>
                            <td><?=$summary_eq_mst->examUniversityRank?></td>
                            <td><?=$summary_eq_mst->university?></td>
                            <td><?=$summary_eq_mst->subject?></td>
                            <td><?=$summary_eq_mst->month?></td>
                            <td><?=$summary_eq_mst->year?></td>
                            <td><?=$summary_eq_mst->average?></td>
                            <td><?=$summary_eq_mst->grade?></td>
                            <td><a target="_blank" href="<?=base_url().$summary_eq_mst->certificate?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> View</a></td>
                        </tr>
                        <?php } ?>

                    </tbody>
                </table>
                 <h3>Highest Qualification (HQ)</h3>
                <table class="educational-qualifications">
                    <thead>
                        <tr>
                           <th>Exam Passed</th>
                            <th>University / Board</th>
                            <th>Subject</th>
                            <th>Year of Enrollment</th>
                            <th>Year of Completion</th>
                            <th>Marks ( % )</th>
                            <th>Div/Gde</th>
                            <th>Upload Certificate</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($summary_hq_mst)){ 
                            ?> 
                            <tr>
                            <td><?=$summary_hq_mst->examUniversityRank?></td>
                            <td><?=$summary_hq_mst->university?></td>
                            <td><?=$summary_hq_mst->subject?></td>
                            <td><?=$summary_hq_mst->month?></td>
                            <td><?=$summary_hq_mst->year?></td>
                            <td><?=$summary_hq_mst->average?></td>
                            <td><?=$summary_hq_mst->grade?></td>
                            <td><a target="_blank" href="<?=base_url().$summary_hq_mst->certificate?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> View</a></td>
                        </tr>
                        <?php }  ?>

                    </tbody>
                </table>
                <table  class="formRight ckedit">

                 <tr>
                    <td width="61"><b>Years of Experience:</b></td>
                     <td width="240"><p><?=$summary_mst->yearsOfExperience?></p></td>
                </tr>
                <tr>
                    <td width="61"><b>Areas of experience:</b></td>
                    <td width="240"><p><?=$summary_mst->areasOfExperience?></p></td>
                </tr>
                <tr>
                    <td width="61"><b>Postal Address(Form Communication):</b></td>
                    <td width="240"><p><?=$summary_mst->postalAddressCommunication?></p></td>
                </tr>
                <tr>
                    <td width="61"><b>City:</b></td>
                    <td width="240"><p><?=$summary_mst->city?></p></td>
                </tr>

                <tr>
                    <td width="61"><b>Pin:</b></td>
                    <td width="240"><p><?=$summary_mst->pin?></p></td>
                </tr>
                <tr>
                    <td width="61"><b>Tele. No(with STD code):</b></td>
                    <td width="240"><p><?=$summary_mst->teleNo?></p></td>
                </tr>
                 <tr>
                    <td width="61"><b>Mobile:</b></td>
                    <td width="240"><p><?=$summary_mst->mobile?></p></td>
                </tr>
                <tr>
                    <td width="61"><b>FAX:</b></td>
                    <td width="240"><p><?=$summary_mst->fax?></p></td>
                </tr>
                <tr>
                    <td width="61"><b>Email:</b></td>
                    <td width="240"><p><?=$summary_mst->email?></p></td>
                </tr>
                </table>




                    </div>
          </div>
        </div>
    </div>
     <?php echo form_open_multipart('admin/application/details',array('id'=>'application-details-form'));?>
    <div class="application-form-right">
        <div class="user-image">
            <h3>User Image:</h3>
            <div class="user-thumb"><img src="<?=base_url().$personal_data->user_image?>"  alt=""></div>
        </div>
        <div class="interviewsec">
            <?php 
                $status = $application->application_status;
                ?>
                <tr>
                    <td colspan="2">
                        <label for="interview"><input id="interview" <?=($status==3)?'checked':''?>  type="radio" name="status" value="3">Selected for Interview</label> 
                        <label for="writtenTest"><input id="writtenTest" <?=($status==2)?'checked':''?> type="radio" name="status" value="2">Selected for Written Test</label>  
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










