<style type="text/css">
.disabled{background-color: #dddddd !important;}
</style>
<section class="application-container new-application-form-container summary-form-container">
        <div class="container">
            <div class="application-section">
                <div class="applicationTabs">
                    <ul>
                       <li><a href="<?=base_url('user/application-form')?>">APPLICATION FORM</a></li>
                        <li><a href="<?=base_url('user/format-of-certificate')?>">FORMAT OF CERTIFICATE</a></li>
                        <li class="active"><a href="javascript:void(0);">SUMMARY</a></li>
                    </ul>
                </div>
                <div class="application-form">
                    <h2>Summary of Application</h2>
                    <form method="post" id="summaryForm" enctype="multipart/form-data">
                        
                            <div class="application-form-top-sec">
                                    <div class="application-form-top-sec-inner">
                                        <div class="application-form-top-sec-inner-left">
                                            <div class="form-group">
                                                <label ><span class="star">*</span>Advt. No.</label>
                                                <input type="text" class="form-control" name="advertiseNo" id="advertiseNo" value="<?=($personal_data)? $personal_data->advertise_no:''; ?>"  autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                               <label ><span class="star">*</span>Post Applied For</label>
                                                <input type="text" class="form-control" name="post" id="post" value="<?=($personal_data)? $personal_data->advertise_no:''; ?>"  autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label ><span class="star">*</span>Discipline</label>
                                                <input type="text" class="form-control" name="discipline" id="discipline" value="<?=($personal_data)? $personal_data->advertise_no:''; ?>"  autocomplete="off">
                                            </div>
                                            
                                            
                                             <div class="form-group">
                                                 <label ><span class="star">*</span>Post Code</label>
                                                <input type="text" class="form-control" name="postCode" id="postCode" value="<?=($personal_data)? $personal_data->advertise_no:''; ?>"  autocomplete="off">
                                            </div>
                                        </div>                                        
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label ><span class="star">*</span>Name(CAPITAL):</label>
                                    <input type="text" class="form-control" name="name" id="name" value="<?=($personal_data)? $personal_data->user_name:''; ?>"  autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label ><span class="star">*</span>DOB:</label>
                                    <input type="text" class="form-control datepicker" name="dateOfBirth" id="dateOfBirth" value="<?=($personal_data)? $personal_data->user_name:''; ?>"  autocomplete="off" max="<?=date('Y-m-d')?>">
                                </div>
                                <div class="form-group">
                                    <label ><span class="star">*</span>Nationality:</label>
                                    <input type="text" class="form-control" name="nationality" id="nationality" value="<?=($personal_data)? $personal_data->user_name:''; ?>"  autocomplete="off">
                                </div>
                                 <?php 
                                    $caste = ($personal_data)?$personal_data->caste:'';
                                ?>
                                <div class="form-group">                            
                                    <label >Reservation Category:</label>
                                    <div class="row-wrap">
                                      <div class="col-md-4 radio">
                                        <label for="categorySC"><input type="radio" <?=($caste=='sc')?'checked':''?> class="form-control" id="categorySC"  name="category" value="sc" >SC</label>
                                        <label for="categoryST"><input type="radio" <?=($caste=='st')?'checked':''?> class="form-control" id="categoryST" name="category" value="st">ST</label>

                                        <label for="categoryObc"><input type="radio" <?=($caste=='obc')?'checked':''?> class="form-control" id="categoryObc" name="category" value="obc">OBC</label>

                                        <label for="categoryGeneral" id="category"><input type="radio" <?=($caste=='general')?'checked':''?> class="form-control" id="categoryGeneral" name="category" value="general">General</label>


                                      </div>
                                    </div>
                                </div>                                
                                <div class="form-group">
                                    <label ><span class="star">*</span>Age as on Closing Date:</label>
                                    <input type="text" class="form-control" name="closingDate" id="closingDate" value="<?=($personal_data)? $personal_data->user_name:''; ?>"  autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label >Central/State Govt./Armed Forces/ PSU’s/Others:</label>
                                    <input type="text" class="form-control" name="centralStateGovt" id="centralStateGovt" value="<?=($personal_data)? $personal_data->user_name:''; ?>"  autocomplete="off">
                                </div>

                             <div class="form-group table-type-row summary-eq-table">
                             <h4><span class="star">*</span>Essential Qualification for Applied Post</h4>
                            <div class="table-type-wrap">
                                 <div class="row th-row">
                                     <div class="td-col">Exam Passed</div>
                                     <div class="td-col">University / Board</div>
                                     <div class="td-col">Subject</div>
                                     <div class="td-col">Year of Enrollment</div>
                                     <div class="td-col">Year of Completion</div>
                                     <div class="td-col">Marks ( % )</div>
                                     <div class="td-col">Div/Gde</div>                                    
                                     <div class="td-col">Upload Certificate</div>
                                 </div>
                                  
                                 <div class="qualificationList">                                   
                                       <div class="row td-row ">
                                        <div class="td-col"><input type="text" class="form-control" name="examUniversityRank" id="examUniversityRank" value=""  placeholder=""></div>
                                        <div class="td-col"><input type="text" class="form-control" name="university" id="university" value=""  placeholder=""></div>
                                        <div class="td-col"><input type="text" class="form-control" name="subject" id="subject" value=""  placeholder=""></div>
                                        <div class="td-col"><input type="text" class="form-control" name="month" id="month" value=""  placeholder=""></div>
                                        <div class="td-col"><input type="text" class="form-control" name="year" id="year" value=""  placeholder=""></div>
                                        <div class="td-col"><input type="text" class="form-control" name="average" id="average" value=""  placeholder=""></div>
                                        <div class="td-col"><input type="text" class="form-control" name="grade" id="grade" value=""  placeholder=""></div>
                                        <div class="td-col"><input type="file" class="form-control" accept="application/pdf" id="certificate" name="certificate" value=""> <span class="text-placeholder">pdf - 1MB max</span></div>
                                     </div>
                                      
                                 </div>                               
                                    </div>
                                </div> 


                                 <div class="form-group table-type-row summary-eq-table">
                             <h4><span class="star">*</span>Highest Qualification</h4>
                            <div class="table-type-wrap">
                                 <div class="row th-row">
                                     <div class="td-col">Exam Passed</div>
                                     <div class="td-col">University / Board</div>
                                     <div class="td-col">Subject</div>
                                     <div class="td-col">Year of Enrollment</div>
                                     <div class="td-col">Year of Completion</div>
                                     <div class="td-col">Marks ( % )</div>
                                     <div class="td-col">Div/Gde</div>                                    
                                     <div class="td-col">Upload Certificate</div>
                                 </div>
                                  
                                 <div class="qualificationList">                                   
                                       <div class="row td-row ">
                                        <div class="td-col"><input type="text" class="form-control" name="hq_examUniversityRank" id="hq_examUniversityRank" value=""  placeholder="" ></div>
                                        <div class="td-col"><input type="text" class="form-control" name="hq_university" id="hq_university" value=""  placeholder="" ></div>
                                        <div class="td-col"><input type="text" class="form-control" name="hq_subject" id="hq_subject" value=""  placeholder="" ></div>
                                        <div class="td-col"><input type="text" class="form-control" name="hq_month" id="hq_month" value=""  placeholder="" ></div>
                                        <div class="td-col"><input type="text" class="form-control" name="hq_year" id="hq_year" value=""  placeholder="" ></div>
                                        <div class="td-col"><input type="text" class="form-control" name="hq_average" id="hq_average" value=""  placeholder="" ></div>
                                        <div class="td-col"><input type="text" class="form-control" name="hq_grade" id="hq_grade" value=""  placeholder="" ></div>
                                        <div class="td-col"><input type="file" class="form-control" accept="application/pdf" id="hq_certificate" name="hq_certificate" value="" > <span class="text-placeholder">pdf - 1MB max</span></div>
                                     </div>
                                      
                                 </div>                               
                                    </div>
                                </div> 



                                <div class="form-group">
                                    <label>Years of Experience</label>
                                    <input type="text" class="form-control" name="yearsOfExperience" id="yearsOfExperience" value="<?=($personal_data)? $personal_data->user_name:''; ?>"  autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Areas of experience</label>
                                    <input type="text" class="form-control" name="areasOfExperience" id="areasOfExperience" value="<?=($personal_data)? $personal_data->user_name:''; ?>"  autocomplete="off">
                                </div>
                                <div class="form-group">
                                     <label><span class="star">*</span>Postal Address(For
                                      Communication)</label>
                                    <input type="text" class="form-control" name="postalAddressCommunication" id="postalAddressCommunication" value="<?=($personal_data)? $personal_data->user_name:''; ?>"  autocomplete="off">
                                </div>
                                <div class="form-group">
                                     <label>City</label>
                                    <input type="text" class="form-control" name="city" id="city" value="<?=($personal_data)? $personal_data->user_name:''; ?>"  autocomplete="off">
                                </div>
                                <div class="form-group">
                                     <label><span class="star">*</span>Pin</label>
                                    <input type="text" class="form-control" name="pin" id="pin" value="<?=($personal_data)? $personal_data->user_name:''; ?>"  autocomplete="off">
                                </div>
                                <div class="form-group">
                                     <label>Tele. No(with STD code)</label>
                                    <input type="text" class="form-control" name="teleNo" id="teleNo" value="<?=($personal_data)? $personal_data->user_name:''; ?>"  autocomplete="off">
                                </div>                                
                                 <div class="form-group">
                                    <label><span class="star">*</span>Mobile</label>
                                    <input type="text" class="form-control" name="mobile" id="mobile" value="<?=($personal_data)? $personal_data->user_name:''; ?>"  autocomplete="off">
                                </div>
                                <div class="form-group">
                                   <label>FAX</label>
                                    <input type="text" class="form-control" name="fax" id="fax" value="<?=($personal_data)? $personal_data->user_name:''; ?>"  autocomplete="off">
                                </div>
                                <div class="form-group">
                                   <label><span class="star">*</span>Email</label>
                                    <input type="text" class="form-control" name="email" id="email" value="<?=($personal_data)? $personal_data->user_name:''; ?>"  autocomplete="off">
                                </div>     
                
                        <div class="form-group">                           
                            <div class="btn-col"><button type="submit" <?=($completeStatus)?'':'disabled'?> class="btn <?=($completeStatus)?'':'disabled'?>" id="summaryBtn">Submit</button></div>
                        </div>
                    </form>
                </div>
                <div class="backsec"><a href="<?=base_url('user/format-of-certificate/');?>">Back</a></div>
            </div>
        </div>
    </section>