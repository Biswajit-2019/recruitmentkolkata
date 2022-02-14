 <section class="welcome-section">
    	<div class="container">
        	<h1>Welcome<br>
            To<br>
            SAMEER Kolkata  Centre</h1>
            <?php
            if($applicationStatus>0){
                $url = base_url('dashboard/status/');
            }else{
                $url = base_url('user/application-form/');
            }
            ?>
            <div class="application applicationForm"><a href="<?=base_url('training/application-form/');?>" class="application-btn">Application Form</a></div>
            <div class="application application status"><a href="<?=base_url('training/application-status/');?>" class="application-btn">Application Status</a></div>
        </div>
    </section>