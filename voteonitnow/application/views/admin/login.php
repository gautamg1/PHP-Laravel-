<?php include BASE_DIR."/application/views/admin/layout/profile-header.php"?>
<div class="login-header">
                <h2 style="color: black">Admin Login</h2>
                <p>Dear Admin, log in to access the admin area!</p>
            </div>
            <?php
            $this->flash('changePassword','alert alert-success');
            ?>
            <form method="post" role="form" action="<?php echo BASE_URL.'/admin/Login/login'?>" id="login" class="login-form">
                <div class="form-group">
                    <label class="control-label" for="email">Email</label>
                    <input type="email" class="form-control input-dark" name="email" autocomplete="off">
                    <p class="error"><?php if(isset($data['emailError'])){echo $data['emailError'];}?></p>
                </div>
                <div class="form-group">
                    <label class="control-label" for="passwd">Password</label>
                    <input type="password" class="form-control input-dark" name="password" autocomplete="off"/>
                    <p class="error"><?php if(isset($data['passwordError'])){echo $data['passwordError'];}?></p>
                </div>
                <div class="form-group">
                    <button type="submit" name="login" class="btn btn-dark  btn-block text-left">
                        <i class="fa-lock"></i>
                        Log In
                    </button>
                </div>
                 <div>
                     <a href="<?php echo BASE_URL.'/admin/login/forgotpassword'?>">Forgot your password?</a>
                 </div>
            </form>
<?php include BASE_DIR."/application/views/admin/layout/profile-footer.php"?>