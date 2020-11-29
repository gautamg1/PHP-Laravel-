<?php require_once (BASE_DIR . "/application/views/admin/layout/header.php");

?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Edit Profile</h3>
            </div>
            <div class="panel-body">
                <form role="form" method="post" class="form-horizontal" action="<?php echo BASE_URL."/admin/profile/editprofile/".$data['id']?>" enctype="multipart/form-data">

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="first_name">First Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="first_name" value="<?php echo isset($data['first_name'])?$data['first_name']: $_POST['first_name'];?>" class="form-control" placeholder="Enter First Name">
                            <p class="error"><?php if($data['first_nameError']): echo $data['first_nameError']; endif;?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="last_name">Last Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="last_name" value="<?php echo isset($data['last_name']) ? $data['last_name'] : $_POST['last_name'];?>" class="form-control" placeholder="Enter Last Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="email_address">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email_address" value="<?php echo isset($data['email_address']) ? $data['email_address'] : $_POST['email_address'];?>" class="form-control" placeholder="Enter Email">
                            <p class="error"><?php if($data['email_addressError']): echo $data['email_addressError']; endif;?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="profile_image">Profile Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="profile_image" value="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="change_password">Change Password?</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="changeEvent" value="0">
                            <input type="checkbox" name="changeEvent"  class="iswitch iswitch-success" value="1" onchange="<?php if(isset($_POST['changeEvent'])===1){echo "showDiv();";}?>" id="changeEvent">
                        </div>
                    </div>
                    <div id="showChangePassword" style="display: none;">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="password">New Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" id="myInput" value="" class="form-control" placeholder="Enter New Password">
                                <p class="error"><?php echo isset($data['passwordError'])? $data['passwordError']:'';?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="confirm_password">Confirm Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="confirm_password" id="myInput1" value="" class="form-control" placeholder="Enter Confirm Password">
                                <p class="error"><?php echo isset($data['confirm_passwordError'])? $data['confirm_passwordError']: '';echo isset($data['pass_confirm_passError'])? $data['pass_confirm_passError']: '';?></p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" align="center">
                        <input type="submit" value="Update" class="btn btn-secondary btn-sm btn-icon icon-left validate">
                        <a href="<?php echo BASE_URL."/admin/users/getallusers"?>" class="btn btn-secondary btn-sm btn-icon icon-left">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
       $("#changeEvent").click(function(){
          $("#showChangePassword").toggle();
       });
    });
</script>

<?php require_once (BASE_DIR . "/application/views/admin/layout/footer.php"); ?>
