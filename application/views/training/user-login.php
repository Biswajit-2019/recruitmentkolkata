 <section class="min-section">
    	<div class="container">
        	<div class="login-section">
                <div class="login-box">
                    <h2>Sign in</h2>
                    <div id="message"></div>
                    <form class="user-login" id="training-user-login" method="post">
                        <div class="form-group">
                            <label >Email ID:</label>
                            <input type="email" class="form-control" id="email" name="email" required="required" autocomplete="off">
                          </div>
                        <!-- <div class="form-group">
                            <label >Password:</label>
                            <input type="password" class="form-control"  required="required" autocomplete="off">
                          </div> -->
                        <div class="form-group" id="form-group"></div>
                        <div class="form-group">
                            <label >&nbsp;</label>
                            <input type="hidden" name="advtNo" id="advtNo" value="<?=$this->input->get('advtNo')?>">
                            <button type="submit" class="send-btn" id='btnAddProfile' value="">Send OTP</button>
                             <div class="resendotp" style="display:none;">
                                <a href="javascript:void(0);" id="trainingResendOtp">Resend OTP</a>
                            </div>
                        </div>
                    </form>
                    <div class="box-footer">
                        if not signup /registered , please <a href="<?=base_url();?>/training/login">click here</a>
                    </div>
                </div>
            </div>
        </div>
    </section>