<?php
$errors = $data['errors'];
$user = $data['user'];
$this->includeFile('front/layout/header');
?>
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-2">
            <form method="post" action="<?php echo BASE_URL; ?>/user/signup" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="firstName" placeholder="Enter first name" value="<?php if(!empty($user['firstName'])): echo $user['firstName'];  endif; ?>">
                        <div class="error">
                            <?php if(!empty($errors['firstNameErr'])): echo $errors['firstNameErr'];  endif; ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Last Name</label>
                        <input type="text" class="form-control" name="lastName" placeholder="Enter last name" value="<?php if(!empty($user['lastName'])): echo $user['lastName'];  endif; ?>">
                        <div class="error">
                            <?php if(!empty($errors['lastNameErr'])): echo $errors['lastNameErr'];  endif; ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Email address</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter email address" value="<?php if(!empty($user['email'])): echo $user['email'];  endif; ?>">
                    <div class="error">
                        <?php if(!empty($errors['emailErr'])): echo $errors['emailErr'];  endif; ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>New password</label>
                        <input type="password" class="form-control" name="newPassword" placeholder="Enter first name" value="<?php if(!empty($user['newPassword'])): echo $user['newPassword'];  endif; ?>">
                        <div class="error">
                            <?php if(!empty($errors['passwordErr'])): echo $errors['passwordErr'];  endif; ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Confirm password</label>
                        <input type="password" class="form-control" name="confirmPassword" placeholder="Enter last name" value="<?php if(!empty($user['confirmPassword'])): echo $user['confirmPassword'];  endif; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Profile image</label>
                    <input type="file" class="form-control" name="image" placeholder="Enter email address">
                    <div class="error">
                        <?php if(!empty($errors['imageErr'])): echo $errors['imageErr'];  endif; ?>
                    </div>
                </div>
                <button type="submit" name="signup" class="btn btn-primary">Sign Up</button>
            </form>
        </div>
    </div>
</div>
<?php $this->includeFile('front/layout/footer'); ?>