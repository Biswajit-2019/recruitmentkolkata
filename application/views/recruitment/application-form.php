<style type="text/css">
.disabled{background-color: #dddddd !important;}
</style>
 <section class="application-container new-application-form-container">
    	<div class="container">
        	<div class="application-section">
                <div class="applicationTabs">
                    <ul>
                        <li class="active"><a href="javascript:void(0);">APPLICATION FORM</a></li>
                        <li><a href="<?=base_url('user/format-of-certificate')?>">FORMAT OF CERTIFICATE</a></li>
                        <li><a href="<?=base_url('summary')?>">SUMMARY</a></li>
                    </ul>
                </div>
                <div class="application-form">
                    <h2>Application Form</h2>
                    <form method="post" id="applicationForm" enctype="multipart/form-data">
                        <div class="application-form-top-sec">
                            <div class="application-form-top-sec-inner">
                                <div class="application-form-top-sec-inner-left">
                                    <div class="form-group">
                                        <label ><span class="star">*</span>Advt. No.</label>
                                        <input type="text" class="form-control" name="advertiseNo" id="advertiseNo" value="<?=($personal_data)? $personal_data->advertise_no:''; ?>"  autocomplete="off">
                                        <p id="advertiseNoCheck" class="error help-inline" style="font-size: 12px;color: rgb(255, 0, 0);"></p>
                                    </div>

                                    <div class="form-group">
                                        <label ><span class="star">*</span>Post Applied For</label>
                                        <input type="text" class="form-control" name="postFor" id="postFor" value="<?=($personal_data)? $personal_data->post_for:''; ?>"  autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label ><span class="star">*</span>Discipline</label>
                                        <input type="text" class="form-control" name="discipline" id="discipline" value="<?=($personal_data)? $personal_data->discipline:''; ?>"  autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label ><span class="star">*</span>Post Code</label>
                                        <input type="text" class="form-control" name="postCode" id="postCode" value="<?=($personal_data)? $personal_data->post_code:''; ?>"  autocomplete="off" >
                                    </div>
                                </div>
                                 
                                <div class="application-form-top-sec-inner-right">
                                   <div class="wrapper">
                                        <div class="box">
                                            <div class="js--image-preview"></div>
                                            <div class="upload-options">
                                                <label><span class="star">*</span>
                                                    <input type="file" class="image-upload <?=($personal_data)?'editUserImage':'addUserImage'?>" name="userImage" id="userImage" accept="image/*" / value="<?=($personal_data)?$personal_data->user_image:''?>">
                                                </label>

                                            </div>
                                           <span class="text-placeholder">jpeg,jpg,png - 100KB max</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label ><span class="star">*</span>Name in full(CAPITAL) :</label>
                            <input type="text" class="form-control" name="name" id="name" value="<?=($personal_data)? $personal_data->user_name:''; ?>"  autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label >Father’s name:</label>
                            <input type="text" class="form-control" name="fatherName" id="fatherName" value="<?=($personal_data)? $personal_data->father_name:''; ?>"  autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label >Mother’s name:</label>
                            <input type="text" class="form-control" name="motherName" id="motherName" value="<?=($personal_data)? $personal_data->mother_name:''; ?>"  autocomplete="off">
                        </div>
                      <div class="form-group">
                            <label ><span class="star">*</span>Date of Birth</label>
                            <div class="row-wrap">
                                <div class="col-md-3">
                                   <input type="text" class="form-control datepicker" name="dateOfBirth" id="dateOfBirth" value="<?=($personal_data)? date("d-m-Y", strtotime($personal_data->date_of_birth)):''; ?>"  autocomplete="off" >
                                </div>
                                <div class="col-md-4">
                                   <div class="inner-row-wrap">
                                       <label class="inner-label"><span class="star">*</span>Upload</label>
                                       <input type="file" class="form-control <?=($personal_data)?'editBirthDateProof':'addBirthDateProof'?>" name="birthDateProof" id="birthDateProof" value=""  accept="application/pdf" value="<?=($personal_data)?$personal_data->birth_date_proof:''?>" >
                                    </div>
                                    <span class="text-placeholder">pdf - 1MB max</span>
                                </div>
                                <div class="col-md-3">
                                    <p>Either Birth Certificate / Matriculation Admit</p>
                                </div>
                            </div>                            
                        </div> 
                         
                        <div class="form-group">
                            <label ><span class="star">*</span>Age as on closing date mentioned in Advt.</label>
                            <input type="text" class="form-control" name="closingDate" id="closingDate" value="<?=($personal_data)?$personal_data->closing_date:''?>"  autocomplete="off">
                        </div> 
                        <?php 
                        $gender = ($personal_data)?$personal_data->gender:'';
                        ?>
                        <div class="form-group">
                            <label ><span class="star">*</span>Sex</label>
                            <div class="row-wrap radio">
                                <label for="sexMale"><input type="radio" <?=($gender=='male')?'checked':''?> class="form-control" id="sexMale" name="sex" value="male">Male</label>
                               <label for="sexFemale"><input type="radio" <?=($gender=='female')?'checked':''?> class="form-control" id="sexFemale" name="sex" value="female">Female</label>

                               <label for="sexTransgender"><input type="radio" <?=($gender=='transgender')?'checked':''?> class="form-control" id="sexTransgender" name="sex" value="T
                                transgender">Transgender</label>    
                                <label for="sexOther" id="sex"><input type="radio" <?=($gender=='other')?'checked':''?> class="form-control" id="sexOther" name="sex" value="other">Other</label>
                            </div>                       
                        </div>
                       <div class="form-group">
                            <label ><span class="star">*</span>Marital Status</label>
                            <input type="text" class="form-control" name="maritalStatus" id="maritalStatus" value="<?=($personal_data)? $personal_data->marital_status:''; ?>"  autocomplete="off">
                        </div>

                       <div class="form-group">
                            <label ><span class="star">*</span>Nationality</label>
                            <input type="text" class="form-control" name="nationality" id="nationality" value="<?=($personal_data)? $personal_data->nationality:''; ?>"  autocomplete="off">
                        </div>  
                        <?php 
                        $caste = ($personal_data)?$personal_data->caste:'';
                        ?>
                        <div class="form-group">                            
                            <label >Reservation Category</label>
                            <div class="row-wrap">
                              <div class="col-md-4 radio">
                                <label for="categorySC"><input type="radio" <?=($caste=='sc')?'checked':''?> class="form-control" id="categorySC"  name="category" value="sc" >SC</label>
                                <label for="categoryST"><input type="radio" <?=($caste=='st')?'checked':''?> class="form-control" id="categoryST" name="category" value="st">ST</label>
                                <label for="categoryObc"><input type="radio" <?=($caste=='obc')?'checked':''?> class="form-control" id="categoryObc" name="category" value="obc">OBC</label>

                                <label for="categoryGeneral" id="category"><input type="radio" <?=($caste=='general')?'checked':''?> class="form-control" id="categoryGeneral" name="category" value="general">General</label>
                              </div>
                              <div class="col-md-6" id="casteAttachFileHide">
                                   <div class="inner-row-wrap">
                                         <label >Upload</label>
                                         <input type="file" class="form-control <?=($personal_data)?'editCasteAttachFile':'addCasteAttachFile'?>" name="casteAttachFile" id="casteAttachFile"  accept="application/pdf" value="<?=($personal_data)?$personal_data->caste_attach_file:''?>">
                                   </div>
                                   <span class="text-placeholder">pdf - 1MB max</span>
                              </div>
                            </div>
                        </div>
                          <div class="form-group">
                            <label >Central/State Govt./Armed Forces/ PSU’s/Others</label>
                            <input type="text" class="form-control" name="centralStateGovt" id="centralStateGovt" placeholder="" value="<?=($personal_data)? $personal_data->central_state_govt:''; ?>">
                        </div>                       
                        <div class="form-group">
                            <label ><span class="star">*</span>Address for correspondence (with Pin Code)</label>
                            <textarea class="form-control" name="address" id="address" autocomplete="off" placeholder=""><?=($personal_data)? $personal_data->address:''; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label ><span class="star">*</span>Permanent Address (with Pin Code) :</label>
                            <textarea class="form-control" name="permanentAddress" id="permanentAddress"  autocomplete="off" placeholder=""><?=($personal_data)? $personal_data->permanent_address:''; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label >Nearest Railway Station</label>
                            <textarea class="form-control" name="nearestRailwayStation" id="nearestRailwayStation" autocomplete="off" placeholder=""><?=($personal_data)? $personal_data->nearest_railway_station:''; ?></textarea>
                        </div>  
                        
                      <div class="form-group table-type-row">
                             <h4><span class="star">*</span>Educational Qualifications ( Write “ NA ” if any field is not applicable ) :</h4>
                            <div class="table-type-wrap">
                                 <div class="row th-row">
                                     <div class="td-col">Exam Passed</div>
                                     <div class="td-col">University/Institution / Board</div>
                                     <div class="td-col">Year of Enrolment</div>
                                     <div class="td-col">Year of Completion</div>
                                     <div class="td-col">Subject in which Degree is awarded</div>
                                     <div class="td-col">Specialisation as reqd. in advt(if any)</div>
                                     <div class="td-col">**Percentage of Marks</div>
                                     <div class="td-col">Division</div>
                                     <div class="td-col">Rank/posotion in Univ.</div>
                                     <div class="td-col">Upload Final Marksheet</div>
                                 </div>
                                  
                                 <div class="qualificationList">
                                    <?php $value1 =''; if(!empty($education)){
                                        
                                        foreach($education as $value){
                                            $value1 = $value->key;
                                     ?>
                                       <div class="row td-row ">
                                         <div class="td-col"><input type="text" class="form-control" name="education[<?=$value->key?>][examPassed]" value="<?=$value->examPassed?>"  placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" name="education[<?=$value->key?>][examBoard]" value="<?=$value->examBoard?>"  placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" name="education[<?=$value->key?>][yearOfEnrolment]" value="<?=$value->yearOfEnrolment?>" placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" name="education[<?=$value->key?>][yearOfCompletion]" value="<?=$value->yearOfCompletion?>"  placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" name="education[<?=$value->key?>][subjectDegreeAwarded]" value="<?=$value->subjectDegreeAwarded?>"  placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" name="education[<?=$value->key?>][specialisationAdvt]" value="<?=$value->specialisationAdvt?>"  placeholder=""></div> 
                                         <div class="td-col"><input type="text" class="form-control"  name="education[<?=$value->key?>][percentageOfMarks]" value="<?=$value->percentageOfMarks?>"  placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" name="education[<?=$value->key?>][division]" value="<?=$value->division?>" placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control"name="education[<?=$value->key?>][rankPosotionInUniv]" value="<?=$value->rankPosotionInUniv?>"  placeholder=""></div>
                                         <div class="td-col"><input type="file" class="form-control editEducationCertificate" name="educationCertificate[<?=$value->key?>]" value="<?=$value->certificate?>"  accept="application/pdf" > <span class="text-placeholder">pdf - 1MB max</span></div>
                                     </div>
                                    <?php } }else{ ?>
                                       <div class="row td-row ">
                                         <div class="td-col"><input type="text" class="form-control" name="education[0][examPassed]" value=""  placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" name="education[0][examBoard]" value=""  placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" name="education[0][yearOfEnrolment]" value="" placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" name="education[0][yearOfCompletion]" value=""  placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" name="education[0][subjectDegreeAwarded]" value=""  placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" name="education[0][specialisationAdvt]" value=""  placeholder=""></div> 
                                         <div class="td-col"><input type="text" class="form-control"  name="education[0][percentageOfMarks]" value=""  placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" name="education[0][division]" value="" placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control"name="education[0][rankPosotionInUniv]" value=""  placeholder=""></div>
                                         <div class="td-col"><input type="file" class="form-control addEducationCertificate" accept="application/pdf" name="educationCertificate[0]" value=""> <span class="text-placeholder">pdf - 1MB max</span></div>
                                     </div>
                                    <?php } ?>
                                      
                                 </div>
                                 <button type="button" id="addQualification" data-id="<?=count($education)?>" class="btn add-row-btn addQualification" value="<?=($value1)?$value1:0;?>">Add Qualifications</button>
                            </div>
                       </div> 
                         <div class="form-group table-type-row professional-training-table">
                            <h4>Professional Training:</h4>
                            <div class="table-type-wrap">
                                 <div class="row th-row">
                                     <div class="td-col">Organisation</div>
                                     <div class="td-col">Period-From</div>
                                     <div class="td-col">Period-To</div>
                                     <div class="td-col">Details of Training</div>                                     
                                     <div class="td-col">Upload Certificate</div>
                                 </div>
                                 <div class="professionalTrainingList">
                                    <?php $value1 =''; if(!empty($professional)){
                                        foreach($professional as $value){
                                            $value1 = $value->key;
                                        ?>
                                     <div class="row td-row">
                                         <div class="td-col"><input type="text" class="form-control" name="professionalTraining[<?=$value->key?>][organisation]" value="<?=$value->organisation?>" placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" name="professionalTraining[<?=$value->key?>][periodFrom]"  value="<?=$value->periodFrom?>" placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" name="professionalTraining[<?=$value->key?>][periodTo]"  value="<?=$value->periodTo?>" placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" name="professionalTraining[<?=$value->key?>][detailsOfTraining]"  value="<?=$value->detailsOfTraining?>" placeholder=""></div>                                    
                                         <div class="td-col"><input type="file" class="form-control editProfessionalTrainingCertificate" name="professionalTrainingCertificate[<?=$value->key?>]" value="<?=$value->certificate?>" accept="application/pdf"><span class="text-placeholder">pdf - 1MB max</span></div>
                                     </div>
                                 <?php } }else{ ?>
                                    <div class="row td-row">
                                         <div class="td-col"><input type="text" class="form-control" name="professionalTraining[0][organisation]" value="" placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" name="professionalTraining[0][periodFrom]"  value="" placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" name="professionalTraining[0][periodTo]"  value="" placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" name="professionalTraining[0][detailsOfTraining]"  value="" placeholder=""></div>                                    
                                         <div class="td-col"><input type="file" class="form-control addProfessionalTrainingCertificate" name="professionalTrainingCertificate[0]"  accept="application/pdf" ><span class="text-placeholder">pdf - 1MB max</span></div>
                                     </div>
                                  <?php } ?>
                                 </div>
                                 <button type="button" id="addProfessionalTraining" data-id="<?=count($professional)?>" class="btn add-row-btn addProfessionalTraining" value="<?=($value1)?$value1:0;?>">Add Training</button>
                            </div>
                        </div>  
                       <div class="form-group table-type-row employment-table">
                             <h4>Employment Record (Attach separate sheet in following format, if necessary):</h4>
                             <div class="table-type-wrap">
                                 <div class="row th-row">
                                     <div class="td-col">Name & address of employer/Orgn/Institution</div>
                                     <div class="td-col">Period of Service-From</div>
                                     <div class="td-col">Period of Service-To</div>
                                     <div class="td-col">Designation of the post held</div>                                     
                                     <div class="td-col">Scale of pay of each post</div>
                                     <div class="td-col">Brief Description of Work</div>
                                     <div class="td-col">Reason for leaving</div>
                                     <div class="td-col">Upload</div>
                                 </div>
                                 <div class="employmentRecordList">
                                    <?php $value1 =''; if(!empty($employment)){
                                        foreach($employment as $value){
                                            $value1 = $value->key;
                                        ?>
                                    <div class="row td-row">
                                         <div class="td-col"><input type="text" class="form-control" name="employmentRecord[<?=$value->key?>][name]" value="<?=$value->name?>" placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" name="employmentRecord[<?=$value->key?>][periodOfServiceFrom]" value="<?=$value->periodOfServiceFrom?>" placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" name="employmentRecord[<?=$value->key?>][periodOfServiceTo]"  value="<?=$value->periodOfServiceTo?>" placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" name="employmentRecord[<?=$value->key?>][designation]" value="<?=$value->designation?>" placeholder=""></div>  
                                         <div class="td-col"><input type="text" class="form-control" name="employmentRecord[<?=$value->key?>][scaleOfPayOfEachPost]"  value="<?=$value->scaleOfPayOfEachPost?>" placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" name="employmentRecord[<?=$value->key?>][brief]"  value="<?=$value->brief?>" placeholder=""></div>  
                                         <div class="td-col"><input type="text" class="form-control" name="employmentRecord[<?=$value->key?>][reasonForLeaving]"  value="<?=$value->reasonForLeaving?>" placeholder=""></div>                                  
                                         <div class="td-col"><input type="file" class="form-control editEmploymentRecordCertificate" name="employmentRecordCertificate[<?=$value->key?>]" value="<?=$value->certificate?>" accept="application/pdf"><span class="text-placeholder">pdf - 1MB max</span></div>
                                     </div>
                                 <?php } }else{ ?>
                                    <div class="row td-row">
                                         <div class="td-col"><input type="text" class="form-control" name="employmentRecord[0][name]" value="" placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" name="employmentRecord[0][periodOfServiceFrom]" value="" placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" name="employmentRecord[0][periodOfServiceTo]"  value="" placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" name="employmentRecord[0][designation]" value="" placeholder=""></div>  
                                         <div class="td-col"><input type="text" class="form-control" name="employmentRecord[0][scaleOfPayOfEachPost]"  value="" placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" name="employmentRecord[0][brief]"  value="" placeholder=""></div>  
                                         <div class="td-col"><input type="text" class="form-control" name="employmentRecord[0][reasonForLeaving]"  value="" placeholder=""></div>                                  
                                         <div class="td-col"><input type="file" class="form-control addEmploymentRecordCertificate" name="employmentRecordCertificate[0]"  accept="application/pdf" ><span class="text-placeholder">pdf - 1MB max</span></div>
                                     </div>
                                 <?php } ?>
                                     
                                 </div>                                                    
                                 <button type="button" id="addEmploymentRecord" data-id="<?=count($employment)?>" class="btn add-row-btn addEmploymentRecord" value="<?=($value1)?$value1:0;?>">Add Employment Details</button>
                                 
                        </div>

                        </div> 
                        

                        
                        <div class="form-group">
                            <label>Present Basic pay:</label>
                            <input type="text" class="form-control" name="presentBasicPay" id="presentBasicPay" value="<?=($others)? $others->presentBasicPay:''; ?>"  autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>Total Emoluments :</label>
                            <input type="text" class="form-control" name="totalEmoluments" id="totalEmoluments" value="<?=($others)? $others->totalEmoluments:''; ?>"  autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>Whether the present post is held on regular or ad-hoc basis:</label>
                            <input type="text" class="form-control" name="presentPostHeld" id="presentPostHeld" value="<?=($others)? $others->presentPostHeld:''; ?>"  autocomplete="off">
                        </div>


                         <div class="form-group">
                            <label >Are you under any contractual obligations to serve Central/State Govt/Any other Public Sector Undertaking or Autonomous body and if so, give details :</label>
                            <div class="row-wrap">
                                <div class="col-md-5">
                                   <input type="text" class="form-control" name="publicSectorUndertaking" id="publicSectorUndertaking" value="<?=($others)? $others->publicSectorUndertaking:''; ?>"  autocomplete="off">
                                </div>
                                <div class="col-md-5">
                                   <div class="inner-row-wrap">
                                       <label class="inner-label">Attach NOC(if any)</label>
                                       <input type="file" class="form-control <?=($others)?'editAttachNocFile':'addAttachNocFile'?>" name="attachNocFile" value="<?=($others)?$others->attachNocFile:''?>" id="attachNocFile" accept="application/pdf">
                                    </div>
                                    <span class="text-placeholder">pdf - 1MB max</span>
                                 </div>
                            </div>                            
                        </div> 




                        <div class="form-group table-type-row sameer-intr-table">
                             <h4>Have you been interviewed for any recruitment/selection by SAMEER during the past one year? If yes, give particulars:</h4>

                             <div class="table-type-wrap">
                                 <div class="row th-row">
                                     <div class="td-col">Sr. No</div>
                                     <div class="td-col">Particulars(eg. Date of Advt, Advt. No.)</div>                                   
                                     <div class="td-col">Name of Posts & Discipline</div>                                     
                                     <div class="td-col">Date of Interview</div>
                                     <div class="td-col">Result</div>                                    
                                 </div>
                                 <div class="employmentRecordList">
                                    <div class="row td-row">
                                         <div class="td-col"><input type="text" class="form-control" id="srNo" name="srNo"  value="<?=($others)? $others->srNo:''; ?>" placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" id="particulars" name="particulars"  value="<?=($others)? $others->particulars:''; ?>" placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" id="nameOfPosts" name="nameOfPosts" value="<?=($others)? $others->nameOfPosts:''; ?>" placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" id="dateOfInterview" name="dateOfInterview"  value="<?=($others)? $others->dateOfInterview:''; ?>" placeholder=""></div>  
                                         <div class="td-col"><input type="text" class="form-control" id="result" name="result"  value="<?=($others)? $others->result:''; ?>" placeholder=""></div>                                       
                                     </div>
                                     
                                 </div>                                                    
                            
                        </div>

                        </div>



                        <div class="form-group table-type-row relative-details-table">
                             <h4>Details of relatives already employed in SAMEER:</h4>

                             <div class="table-type-wrap">
                                 <div class="row th-row">
                                     <div class="td-col">Name of the Relative</div>
                                     <div class="td-col">Relationship</div>                                   
                                     <div class="td-col">Lab/Estt in which employed</div>                                     
                                     <div class="td-col">Post Held</div>                                                                     
                                 </div>
                                 <div class="employmentRecordList">
                                    <div class="row td-row">
                                         <div class="td-col"><input type="text" class="form-control" id="nameOfTheRelative" name="nameOfTheRelative"  value="<?=($others)? $others->nameOfTheRelative:''; ?>" placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" id="relationship" name="relationship" value="<?=($others)? $others->relationship:''; ?>" placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" id="labEmployed" name="labEmployed" value="<?=($others)? $others->labEmployed:''; ?>" placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" id="postHeld" name="postHeld"  value="<?=($others)? $others->postHeld:''; ?>" placeholder=""></div> 
                                     </div>
                                 </div> 
                             </div>
                        </div>



                        <div class="form-group table-type-row attested-details-table">
                             <h4>Give two referees’ name & address and attach certificate from them:(Not related to the candidates) (Gazetted Officers/Professors of reputed academic Institutions/Public Sector Executives etc)</h4>

                             <div class="table-type-wrap">
                                 <div class="row th-row">
                                     <div class="td-col">Name</div>
                                     <div class="td-col">Address</div>                                   
                                     <div class="td-col">Upload Doc</div>                         
                                 </div>
                                 <div class="alreadyEmployList">
                                    <div class="row td-row">
                                         <div class="td-col"><input type="text" class="form-control" id="refereesName" name="refereesName"  value="<?=($others)? $others->refereesName:''; ?>" placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" id="refereesAddress" name="refereesAddress"  value="<?=($others)? $others->refereesAddress:''; ?>" placeholder=""></div>
                                         <div class="td-col"><input type="file" class="form-control <?=($others)?'editRefereesEmployProof':'addRefereesEmployProof'?>" id="refereesEmployProof" value="<?=($others)?$others->refereesEmployProof:''?>" name="refereesEmployProof" accept="application/pdf"><span class="text-placeholder">pdf - 1MB max</span></div>
                                     </div>
                                     <div class="row td-row">
                                         <div class="td-col"><input type="text" class="form-control" id="refereesName1" name="refereesName1"  value="<?=($others)? $others->refereesName1:''; ?>" placeholder=""></div>
                                         <div class="td-col"><input type="text" class="form-control" id="refereesAddress1" name="refereesAddress1"  value="<?=($others)? $others->refereesAddress1:''; ?>" placeholder=""></div>
                                         <div class="td-col"><input type="file" class="form-control <?=($others)?'editRefereesEmployProof1':'addRefereesEmployProof1'?>" id="refereesEmployProof1" value="" name="refereesEmployProof1" accept="application/pdf"><span class="text-placeholder">pdf - 1MB max</span></div>
                                     </div>

                                 </div> 
                             </div>
                          </div>
                              
                          <div class="form-group">
                            <label>Any other information you may wish to add, including extra curricular activities</label>
                            <textarea class="form-control" name="otherInformation" id="otherInformation" autocomplete="off" placeholder=""><?=($others)? $others->otherInformation:''; ?></textarea>
                           </div>
                           <div class="form-group declaration">
                                    <h4>Declaration</h4>
                                    <p>I declare that the foregoing information is correct and complete to the best of my
                                    knowledge and belief and nothing has been concealed/distorted. If at any time, I am found to
                                    have concealed/distorted any material information, my appointment shall be liable to summary
                                    termination without notice. If offered appointment, I will join on specified date and subsequently,
                                    take up duty in the discharge of SAMEER assignments anywhere in India as and when required.</p>
                           </div>
                           <?php 
                                $gender = ($others)?$others->conditionAccept:'';
                            ?>
                           <div class="form-group accept-terms">                          
                            <div class="row-wrap">
                                <div class="col-md-12">
                                     <label for="conditionAccept"><span class="star">*</span><input type="checkbox" <?=($gender=='Y')?'checked':''?>   class="form-control" id="conditionAccept" name="conditionAccept" value="Y"><span>I agree and accept all terms and condition</span></label>
                                </div>                                
                            </div>                            
                        </div> 


                        <div class="form-group upload-signature">
                            <label><span class="star">*</span>Upload Signature</label>
                            <div class="row-wrap">                                
                                <div class="col-md-5">
                                   <div class="inner-row-wrap">                                  
                                       <input type="file" class="form-control <?=($others)?'editSignature':'addSignature'?>" name="signature" id="signature" value="<?=($others)?$others->signature:''?>"  aria-required="true" accept="image/jpeg,image/jpg,image/png">
                                    </div>
                                    <span class="text-placeholder">jpeg,jpg,png - 100KB max</span>
                                 </div>
                            </div>                            
                        </div> 
                        <div class="form-group">                            
                            <div class="btn-col"><button type="submit" id="submit" class="btn">Next</button></div>
                        </div>
                    </form>
                </div>
                <div class="backsec"><a href="<?=base_url('dashboard');?>">Back</a></div>
            </div>
        </div>
    </section>






    <!----upload Pic--->
    <script>
        function initImageUpload(box) {
  let uploadField = box.querySelector('.image-upload');

  uploadField.addEventListener('change', getFile);

  function getFile(e){
    let file = e.currentTarget.files[0];
    checkType(file);
  }
  
  function previewImage(file){
    let thumb = box.querySelector('.js--image-preview'),
        reader = new FileReader();

    reader.onload = function() {
      thumb.style.backgroundImage = 'url(' + reader.result + ')';
    }
    reader.readAsDataURL(file);
    thumb.className += ' js--no-default';
  }

  function checkType(file){
    let imageType = /image.*/;
    if (!file.type.match(imageType)) {
      throw 'Datei ist kein Bild';
    } else if (!file){
      throw 'Kein Bild gewählt';
    } else {
      previewImage(file);
    }
  }
  
}

// initialize box-scope
var boxes = document.querySelectorAll('.box');

for (let i = 0; i < boxes.length; i++) {
  let box = boxes[i];
  initDropEffect(box);
  initImageUpload(box);
}



/// drop-effect
function initDropEffect(box){
  let area, drop, areaWidth, areaHeight, maxDistance, dropWidth, dropHeight, x, y;
  
  // get clickable area for drop effect
  area = box.querySelector('.js--image-preview');
  area.addEventListener('click', fireRipple);
  
  function fireRipple(e){
    area = e.currentTarget
    // create drop
    if(!drop){
      drop = document.createElement('span');
      drop.className = 'drop';
      this.appendChild(drop);
    }
    // reset animate class
    drop.className = 'drop';
    
    // calculate dimensions of area (longest side)
    areaWidth = getComputedStyle(this, null).getPropertyValue("width");
    areaHeight = getComputedStyle(this, null).getPropertyValue("height");
    maxDistance = Math.max(parseInt(areaWidth, 10), parseInt(areaHeight, 10));

    // set drop dimensions to fill area
    drop.style.width = maxDistance + 'px';
    drop.style.height = maxDistance + 'px';
    
    // calculate dimensions of drop
    dropWidth = getComputedStyle(this, null).getPropertyValue("width");
    dropHeight = getComputedStyle(this, null).getPropertyValue("height");
    
    // calculate relative coordinates of click
    // logic: click coordinates relative to page - parent's position relative to page - half of self height/width to make it controllable from the center
    x = e.pageX - this.offsetLeft - (parseInt(dropWidth, 10)/2);
    y = e.pageY - this.offsetTop - (parseInt(dropHeight, 10)/2) - 30;
    
    // position drop and animate
    drop.style.top = y + 'px';
    drop.style.left = x + 'px';
    drop.className += ' animate';
    e.stopPropagation();
    
  }
}

    </script>