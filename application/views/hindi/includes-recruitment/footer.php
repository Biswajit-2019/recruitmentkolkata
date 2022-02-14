<?php 
$param=array('parent_id'=>0,'footer'=>'Y');
$footer=$this->Common_model->getData('hindi_cms_pages',$param);

    ?>
<footer class="footer-section">
    	<div class="container">
            <div class="footer-bg">
                <ul>
                   <?php if(!empty($footer)){
                        foreach($footer as $footerVal){
                        ?>
					 <li><a href="<?php echo main_base_url;?>/hindi/<?php echo $footerVal->slug;?>"><?php echo $footerVal->page_title;?></a></li>
                    <?php } }?>

					 <li><a href="<?php echo main_base_url;?>/hindi/feed-back">प्रतिक्रिया</a></li>
				   
                </ul>
                <p>प्रा योगिक सूक्ष्म तरंग इलेक्ट्रॉनिक इंजीनियरी तथा अनुसंधान संस्था, कोलकाता. <?php echo date('Y');?> . सर्वाधीकार सुरक्षित. </p>
               
            </div>
        </div>
    </footer>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js'></script>
<script src="<?php echo base_url(); echo JS_URL;?>fontcolor.js"></script>
<script src="<?php echo base_url(); echo JS_URL;?>fontsize.js"></script>
<script src="<?php echo base_url(); echo JS_URL;?>jQuery.print.js"></script>
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
   
});
//]]>
        </script>
    
</div>
</body>
</html>