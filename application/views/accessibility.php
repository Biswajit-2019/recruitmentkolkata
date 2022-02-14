 <section class="min-section">
    	<div class="container">
        	<div class="section-bg">
            	
        	<?php $this->load->view('includes/left');

            //print_r($main);
            ?>

                <div class="right-section variable_font">
                	<h1 class="variable_font"><?php echo $metaTitle;?><span class="print"><a href="javascript:void(0);"  title="Print" class="print-btn">Print</a></span></h1>
                    <div class="content-text">
                       <h2>Change Text Size</h2>
                      <ul>
                        <li><a href="#" id="small">A-</a></li>
                          <li>  <a href="#" id="medium" class="selected">A</a></li>
                          <li><a href="#" id="large">A+</a></li>      
                    </ul>
                     <h2>Change Contrast</h2>
                        <ul>
                        <li>
<a href="javascript:void(0);" class="button-toggle-highcontrast">High Contrast</a> </li>
<li><a href="javascript:void(0);" class="button-toggle-remove">Normal Contrast</a>
                        </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>