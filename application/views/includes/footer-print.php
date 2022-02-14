<?php 
$param=array('parent_id'=>0,'footer'=>'Y');
$footer=$this->Common_model->getData('cms_pages',$param);
//print_r($footer);
    ?>

<footer class="footer-section">
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

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js'></script>
<script src="<?php echo base_url(); echo JS_URL;?>fontcolor.js"></script>
<script src="<?php echo base_url(); echo JS_URL;?>fontsize.js"></script>
 <script type="text/javascript">
function doit(){
if (!window.print){
alert("You need NS4.x to use this print button!")
return
}
window.print();
return false;
}
function printrecipe(el)
  {
   
   var restorepage = document.body.innerHTML;
  var printcontent = document.getElementById(el).innerHTML;
 
  document.body.innerHTML = printcontent;
  window.print();
  document.body.innerHTML = restorepage;
  }
 </script>
</div>
</body>
</html>
