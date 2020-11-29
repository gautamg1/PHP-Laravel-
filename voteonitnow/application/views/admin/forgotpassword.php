<?php include BASE_DIR."/application/views/admin/layout/profile-header.php"?>
<div class="login-header">
                <h2 style="color: black">Forgot Password</h2>
                <p>Dear Admin, Enter Your Registered Email!</p>
            </div>
            <?php
            if (isset($_SESSION['sendMail'])){echo $_SESSION['sendMail'];
                unset($_SESSION['sendMail']);}
            ?>
            <form method="post" action="<?php echo BASE_URL.'/admin/login/forgotpassword'?>" class="login-form">
                <div class="form-group">
                    <input type="email" name="email" class="form-control input-dark" placeholder="Enter Your Registered Email">
                    <p class="error"><?php echo isset($data['emailError'])?$data['emailError']:'' ?></p>
                </div>
                <div class="form-group">
                    <button type="submit" name="reset" class="btn btn-dark  btn-block text-left">
                        <i class="fa-lock"></i>
                        Send Link
                    </button>
                </div>
            </form>
<?php include BASE_DIR."/application/views/admin/layout/profile-footer.php"?>