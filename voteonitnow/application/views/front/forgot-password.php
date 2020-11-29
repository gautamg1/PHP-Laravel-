<?php
$errors = $data['errors'];
$this->includeFile('front/layout/header');
?>
<div class="container">
    <div class="row">
        <div class="col-md-5 offset-2">
            <?php
            if (isset($_SESSION['sendMail'])){
                echo $_SESSION['sendMail'];
                unset($_SESSION['sendMail']);
            }
            ?>
            <form method="post" action="<?php echo BASE_URL; ?>/user/forgot">
                <div class="form-group">
                    <label>Email address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email address">
                    <div class="error">
                        <?php if (!empty($errors['emailErr'])): echo $errors['emailErr']; endif; ?>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" value="Send Link" name="reset">
            </form>
        </div>
    </div>
</div>
<?php $this->includeFile('front/layout/footer'); ?>


