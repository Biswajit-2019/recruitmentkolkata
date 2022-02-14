 <section class="min-section">
    	<div class="container">
        	<div class="section-bg">
            	
        	<?php $this->load->view('includes/left');?>

                <div class="right-section">
                	<h1>Feedback <span class="print"><a href="javascript:void(0);"  title="Print" class="print-btn">Print</a></span></h1>
                    <div class="content-text">
                    <?php if($this->session->flashdata('newsSucc')){?>
                    <div class="success"><?php echo $this->session->flashdata('newsSucc'); ?></div>
                    <?php }?>
                        <p>Any query, of generic nature, related to content, design, service or technological issues w.r.t DIT portal can be sent to us through this customized Feedback interface.</p>

                        <p>All fields are mandatory, except where marked 'optional'</p>
                        
                       <?php echo form_open('');?>
                            <fieldset>
                                <legend>Feedback Form</legend>
                                <div class="feedback name">
                                    <label>Name: </label>
                                    <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                                    <input type="text"  value="<?php echo set_value('name'); ?>" name="name" placeholder="">
                                </div>
                                <div class="feedback femail">
                                    <label>Email: </label>
                                     <?php echo form_error('txtemail', '<div class="error">', '</div>'); ?>
                                    <input type="email" value="<?php echo set_value('txtemail'); ?>" name="txtemail" placeholder="">
                                </div>
                                <div class="feedback ffeed">
                                    <label>Feedback: </label>
                                     <?php echo form_error('feed', '<div class="error">', '</div>'); ?>
                                    <textarea name="feed"><?php echo set_value('feed'); ?></textarea>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>Security Question</legend>
                                <p>This question is for testing whether you are a human visitor and to prevent automated spam submissions.</p>
                                <div class="feedback fmatch">
                                    <label>Math question: </label>
                                    <?php echo form_error('answer', '<div class="error">', '</div>'); ?>
                                    <?php 
                                    $rand=array('number1'=>rand(0,10),'number2'=>rand(10,20));
                                    $this->session->set_userdata($rand);?>
                                    <span class="field-prefix"><?php echo $this->session->userdata('number1');?> + <?php echo $this->session->userdata('number2');?> = </span>
                                    <input type="text" value="<?php echo set_value('answer'); ?>" name="answer" placeholder="" class="question">
                                </div>
                                <p>Solve this simple math problem and enter the result. E.g. for 1+3, enter 4.</p>
                            </fieldset>
                            
                            <input type="submit" value="Submit" name="feedback" class="submit-btn">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php if(form_error('name')){ ?>
<script type="text/javascript">
$(document).ready(function(){
$('html, body').animate({ scrollTop: $(".name").offset().top }, 1000);

    
});
</script>
<?php } elseif(form_error('txtemail')){?>
<script type="text/javascript">
$(document).ready(function(){
$('html, body').animate({ scrollTop: $(".femail").offset().top }, 1000);

    
});
</script>
<?php } elseif(form_error('feed')){?>
<script type="text/javascript">
$(document).ready(function(){
$('html, body').animate({ scrollTop: $(".ffeed").offset().top }, 1000);

    
});
</script>
<?php } elseif(form_error('answer')){?>
<script type="text/javascript">
$(document).ready(function(){
$('html, body').animate({ scrollTop: $(".fmatch").offset().top }, 1000);

    
});
</script>
<?php }?>
<?php if($this->session->flashdata('newsSucc')){?>
<script type="text/javascript">
$(document).ready(function(){
    
     $('html, body').animate({ scrollTop: $('.success').offset().top}, 2000);
   
});
</script>
<?php }?>