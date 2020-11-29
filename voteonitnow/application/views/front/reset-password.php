<?php
$errors = $data['errors'];
$user = $data['user'];
$this->includeFile('front/layout/header');
?>
<div class="container">
    <div class="row">
        <div class="col-md-5 offset-2">
            <div class="error">
                <?php if (!empty($errors['passwordErr'])): echo $errors['passwordErr']; endif; ?>
            </div>
            <form method="post" action="<?php echo BASE_URL; ?>/user/reset_password">
                <div class="form-group">
                    <label>New password</label>
                    <input type="password" name="newPassword" class="form-control" placeholder="Enter new password" value="<?php if (!empty($user['newPassword'])): echo $user['newPassword']; endif; ?>">
                </div>
                <div class="form-group">
                    <label>Confirm password</label>
                    <input type="password" name="confirmPassword" class="form-control" placeholder="Enter confirm password" value="<?php if (!empty($user['confirmPassword'])): echo $user['confirmPassword']; endif; ?>">
                </div>
                <input type="hidden" name="email" value="<?php echo $_GET['email'];?>">
                <input type="submit" class="btn btn-primary" value="Reset Password" name="reset">
            </form>
        </div>
    </div>
</div>
<?php $this->includeFile('front/layout/footer'); ?>
