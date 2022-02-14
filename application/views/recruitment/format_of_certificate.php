<style type="text/css">
.disabled{background-color: #dddddd !important;}
</style>
<section class="application-container new-application-form-container certificate-form-container">
    	<div class="container">
        	<div class="application-section">
                <div class="applicationTabs">
                    <ul>
                        <li><a href="<?=base_url('user/application-form')?>">APPLICATION FORM</a></li>
                        <li class="active"><a href="javascript:void(0);">FORMAT OF CERTIFICATE</a></li>
                        <li><a href="<?=base_url('summary')?>">SUMMARY</a></li>
                    </ul>
                </div>
                <div class="application-form">
                    <h2>Format of Certificate from the present Employer</h2>
                    <form method="post" id="certificateForm"  enctype="multipart/form-data">
                       
                    <h3>(To be filled in by the Competent Authority in the case of candidates who are presently working in Government/Semi-Government/PSUs/ Autonomous Bodies)</h3>

                    <h3>Certified that:-<br>The information given above by the officer is correct.<br>No vigilance/disciplinary proceedings are pending or contemplated against the above mentioned officer</h3>
                    <div class="userSignature certificaterow">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                            <label>Date:</label>
                            <input type="text" class="form-control" name="" id="" value="" autocomplete="off">
                        </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label>Signature:</label>
                                <input type="text" class="form-control" name="" id="" value="" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Designation:</label>
                                <input type="text" class="form-control" name="" id="" value="" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Name of the Department/ Ministry</label>
                                <input type="text" class="form-control" name="" id="" value="" autocomplete="off">
                            </div>
                            </div>
                        </div>
                                                

                    </div>
                    

                    <div class="CertificatePrint">
                        <span class=" print"><a href="javascript:void(0);"  title="Print" class="print-btn">Print</a></span>
                    </div>

                    <div class="avoid-this">
                        <div class="form-group table-type-row">
                            <h4>Duly signed certificate from the present employer as per the format given needs to uploaded</h4>
                        </div>
                        <div class="form-group">                            
                            <label>Upload Document</label>
                            <div class="row-wrap">                              
                              <div class="col-md-12">
                                   <div class="inner-row-wrap">                                        
                                         <input type="file" class="form-control" name="formatOfCertificate" id="formatOfCertificate" accept="application/pdf" >
                                   </div>
                              </div>
                            </div>
                        </div>
                    </div>

                         <div class="form-group avoid-this ">    
                            <input type="hidden" name="textid" value="<?=($this->session->userdata('applicationNo'))?>">                      
                            <div class="btn-col"><button type="submit" <?=($this->session->userdata('applicationNo'))?'':'disabled'?>  class="btn <?=($this->session->userdata('applicationNo'))?'':'disabled'?>" id="certificateBtn">Next</button></div>

                            <div class="btn-col"><a href="<?=base_url('summary');?>"><button type="button" class="btn skip" id="certificateBtn">Skip</button></a></div> 


                        </div>
                    </form>
                </div>
                <div class="backsec avoid-this"><a href="<?=base_url('summary')?>">Back</a></div>
            </div>
        </div>
    </section>