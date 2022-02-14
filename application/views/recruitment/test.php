 <section class="min-section">
    	<div class="container">
        	<div class="login-section">
                <div class="login-box">
                    <h2>Sign in</h2>
                    <div id="message"></div>
                    <form class="user-login" id="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label >Name:</label>
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off">
                          </div>
                          <div class="form-group">
                            <label >File:</label>
                            <input type="file" class="form-control" id="file" name="file" autocomplete="off">
                          </div>
                          <div class="form-group">
                            <label >Image:</label>
                            <input type="file" class="form-control" id="image" name="image" autocomplete="off">
                          </div>
                          <div class="form-group">                            
                            <div class="btn-col"><button type="submit" name="submit" class="btn">Submit</button></div>
                        </div>
                       
                       
                        
                    </form>
                    <div class="box-footer">
                        if not signup /registered , please <a href="<?=base_url('login');?>">click here</a>
                    </div>
                </div>
            </div>
        </div>
    </section>