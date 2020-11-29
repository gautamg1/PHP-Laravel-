<?php require_once(BASE_DIR . "/application/views/admin/layout/header.php"); ?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Edit User</h3>
            </div>
            <div class="panel-body">
                <form role="form" method="post" class="form-horizontal" action="<?php echo BASE_URL."/admin/users/updateuser/".$data['id']?>" enctype="multipart/form-data">

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
                            <p class="error"><?php if($data['last_nameError']): echo $data['last_nameError']; endif;?></p>
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
                            <p class="error"><?php if($data['profile_imageError']): echo $data['profile_imageError']; endif;?></p>
                        </div>
                    </div>

                    <div class="form-group" align="center">
                        <input type="submit" name="update" value="Update" class="btn btn-secondary btn-sm btn-icon icon-left">
                        <a href="<?php echo BASE_URL."/admin/users/getallusers"?>" class="btn btn-secondary btn-sm btn-icon icon-left">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once(BASE_DIR . "/application/views/admin/layout/footer.php"); ?>