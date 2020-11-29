<?php
$errors = $data['errors'];
$user = $data['user'];
$this->includeFile('front/layout/header');
?>
<div class="container">
    <div class="row">
        <div class="col-md-5 offset-2">
            <?php
            $this->flash('signup','alert alert-success');
            $this->flash('changePassword','alert alert-success');
            ?>
            <form action="<?php echo BASE_URL; ?>/user/login" method="POST">
                <div class="form-group">
                    <label>Email address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email address" value="<?php if(!empty($user['email'])): echo $user['email'];  endif; ?>">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    <div class="error">
                        <?php if(!empty($errors['emailErr'])): echo $errors['emailErr'];  endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password" value="<?php if(!empty($user['password'])): echo $user['password'];  endif; ?>">
                    <div class="error">
                        <?php if(!empty($errors['passwordErr'])): echo $errors['passwordErr'];  endif; ?>
                    </div>
                </div>
                <div class="form-group form-check">
                    <a href="<?php echo BASE_URL; ?>/user/forgot">Forgot password</a>
                </div>
                <button type="submit" name="login" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>
<?php $this->includeFile('front/layout/footer'); ?>