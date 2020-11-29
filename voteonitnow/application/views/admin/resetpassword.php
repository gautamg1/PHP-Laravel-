<?php include BASE_DIR."/application/views/admin/layout/profile-header.php"?>
    <div class="login-header">
                <h2 style="color: black">Reset Password</h2>
                <p>Dear Admin, Reset Your Password!</p>
            </div>
            <?php
            $this->flash('changePassword','alert alert-success');
            ?>
            <form method="post" action="<?php echo BASE_URL.'/admin/login/resetpassword'?>" class="login-form">
                <div class="form-group">

                    <input type="password" name="new_password" class="form-control input-dark" placeholder="Enter New Password">
                    <p class="error"><?php echo isset($data['passwordError'])?$data['passwordError']:'' ?></p>
                </div>
                <div class="form-group">

                    <input type="password" name="confirm_password" class="form-control input-dark" placeholder="Enter Confirm Password">
                    <p class="error"><?php echo isset($data['confpasswordError'])?$data['confpasswordError']:$data['wrongpasswordError'] ?></p>
                </div>
                <input type="hidden" name="email" value="<?php echo $_GET['email'];?>">
                <div class="form-group">
                    <button type="submit" name="reset" class="btn btn-dark  btn-block text-left">
                        <i class="fa-lock"></i>
                        Reset
                    </button>
                </div>
            </form>
<?php include BASE_DIR."/application/views/admin/layout/profile-footer.php"?>