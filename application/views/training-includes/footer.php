<?php 
$param=array('parent_id'=>0,'footer'=>'Y');
$footer=$this->Common_model->getData('cms_pages',$param);
//print_r($footer);
    ?>

<footer class="footer-section" data-baseurl="<?php echo base_url(); ?>">
        <div class="container">
            <div class="footer-bg">
                <ul>
                    <?php if(!empty($footer)){
                        foreach($footer as $footerVal){
                        ?>
                    <li><a href="<?php echo base_url(); echo $footerVal->slug;?>"><?php echo $footerVal->page_title;?></a></li>
                    <?php } }?>
                  <li><a href="<?php echo base_url();?>feed-back">Feedback</a></li>
                </ul>
                <p>Society for Applied Microwave  Electronics Engineering and Research, Kolkata. © Copyright <?php echo date('Y');?> . All rights reserved. </p>
                <!-- <p><a href="#">Privacy policy & Terms & Conditions.</a></p> -->
            </div>
        </div>
    </footer>
<script src="<?php echo base_url(); echo JS_URL;?>responsive-nav.js"></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js'></script>
<script src="<?php echo base_url(); echo JS_URL;?>fontcolor.js"></script>
<script src="<?php echo base_url(); echo JS_URL;?>fontsize.js"></script>
<script src="<?php echo base_url(); echo JS_URL;?>jQuery.print.js"></script>
<script src="<?php echo base_url(); echo JS_URL;?>jquery.validate.js"></script>
<script src="<?php echo base_url(); echo JS_URL;?>additional-methods.min.js"></script>
<script src="<?php echo base_url(); echo JS_URL;?>training-custom.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script type='text/javascript'>
//<![CDATA[
$(function() {
   
    $(".print-btn").on('click', function() {
      //alert("aaaaaaaaaaaaaa");
        //Print ele4 with custom options
        $("#ele4").print({
            //Use Global styles
            globalStyles : true,
            //Add link with attrbute media=print
            mediaPrint : true,
            //Custom stylesheet
            stylesheet : "<?php echo base_url(); echo CSS_URL;?>print.css",
            //Print in a hidden iframe
            iframe : true,
            //Don't print this
            noPrintSelector : ".avoid-this",
			timeout: 750,
            doctype: '<!doctype html>'
            //Add this at top
           
        });
    });
   var navigation = responsiveNav("#nav", {
            customToggle: "#nav-toggle"
          });
});
//]]>
        </script>
</div>
</body>
</html>
