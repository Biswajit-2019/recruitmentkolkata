<section class="application-container new-application-form-container">
    <div class="container">
        <div class="application-section">
            <!-- <div class="applicationTabs">
                <ul>
                        <li class="active"><a href="javascript:void(0);">APPLICATION FORM</a></li>
                        <li><a href="<?=base_url('user/format-of-certificate')?>">FORMAT OF CERTIFICATE</a></li>
                        <li><a href="<?=base_url('summary')?>">SUMMARY</a></li>
                    </ul>
            </div> -->
            <div class="application-form">
                <h2>Application Form</h2>
                <form method="post" id="trainingApplicationForm" enctype="multipart/form-data">
                    <div class="application-form-top-sec">
                        <div class="application-form-top-sec-inner">
                            <div class="application-form-top-sec-inner-left" style="width: 100%;">

                                <div class="form-group">
                                     <label ><span class="star">*</span>Name of Candidate:</label>
                                     <input type="text" class="form-control" name="candidateName" id="candidateName" value=""  autocomplete="off">
                                </div>
                                <div class="form-group">
                                     <label ><span class="star">*</span>Name of College/ University:</label>
                                     <input type="text" class="form-control" name="institutionName" id="institutionName" value=""  autocomplete="off">
                                </div>
                                <div class="form-group">
                                     <label ><span class="star">*</span>Qualification:</label>                                 
                                        <input type="text" class="form-control" name="qualification" id="qualification" value=""  autocomplete="off">
                                     </select>
                                </div>
                                <div class="form-group">
                                     <label ><span class="star">*</span>Mobile:</label>
                                     <input type="text" class="form-control" name="contact" id="contact" value=""  autocomplete="off">
                                </div>
                                <div class="form-group">
                                     <label ><span class="star">*</span>Email:</label>
                                     <input type="email" class="form-control" name="email" id="email" value=""  autocomplete="off">
                                </div>
                                <div class="form-group">
                                     <label ><span class="star">*</span>Applying For:</label>
                                     <select class="form-control" name="applying" id="applying">
                                        <option value="">Select Applying For</option>
                                        <?php foreach($apply_list as $value){ ?>
                                            <option value="<?=$value->id?>"><?=$value->name?></option>
                                        <?php } ?>
                                     </select>
                                </div>
                                <div class="form-group">
                                     <label ><span class="star">*</span>Permanent Address:</label>
                                      <textarea class="form-control" name="permanentAddress" id="permanentAddress" autocomplete="off" placeholder=""></textarea>
                                </div>
                                <div class="form-group">
                                     <label ><span class="star">*</span>Messages:</label>
                                     <textarea class="form-control" name="messages" id="messages" autocomplete="off" placeholder=""></textarea>
                                </div>
                                



                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                             <label ><span class="star">*</span>Resume:<br><span class="text-placeholder">pdf - 1MB max</span></label>
                            <input type="file" class="form-control" name="uploadResume" id="uploadResume" value="">
                        </div>
                    <div id="golTrainee">

                        
                        <div class="form-group">
                             <label ><span class="star">*</span>Marksheet:<br><span class="text-placeholder">pdf - 1MB max</span></label>
                            <input type="file" class="form-control" name="markSheet" id="markSheet" value="">
                        </div>
                        <div class="form-group">
                             <label ><span class="star">*</span>Certificate:<br><span class="text-placeholder">pdf - 1MB max</span></label>
                            <input type="file" class="form-control" name="certificate" id="certificate" value="">
                        </div>

                        
                    </div>
                    <div id="nonGolTrainee">
                        <div class="form-group">
                             <label ><span class="star">*</span>NOC from Parent Institute:<br><span class="text-placeholder">pdf - 1MB max</span></label>
                            <input type="file" class="form-control" name="document1" id="document1" value="">
                        </div>
                        <div class="form-group">
                             <label ><span class="star">*</span>Mark sheet till last Semester :<br><span class="text-placeholder">pdf - 1MB max</span></label>
                            <input type="file" class="form-control" name="document2" id="document2" value="">
                        </div>
                    </div>
                    
                    
                    
                    

                    
                     <div class="form-group">                            
                        <div class="btn-col"><button type="submit" id="submit" class="btn">Submit</button></div>
                    </div>
                </form>
            </div>
            <div class="backsec"><a href="<?=base_url('training/dashboard');?>">Back</a></div>
        </div>
    </div>
</section>