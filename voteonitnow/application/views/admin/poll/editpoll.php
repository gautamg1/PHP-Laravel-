<?php require_once(BASE_DIR . "/application/views/admin/layout/header.php"); ?>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit User</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" class="form-horizontal" action="<?php echo BASE_URL."/admin/polls/updatepoll/".$data['id']?>" enctype="multipart/form-data">

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="title">Title</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" value="<?php echo isset($data['title'])?$data['title']: $_POST['title'];?>" class="form-control" placeholder="Enter First Name">
                                <p class="error"><?php if($data['titleError']): echo $data['titleError']; endif;?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="image">Image</label>
                            <div class="col-sm-10">
                                <input type="file" name="image" value="" class="form-control">
                                <p class="error"><?php if($data['imageError']): echo $data['imageError']; endif;?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="description">Description</label>
                            <div class="col-sm-10">
                                <input type="text" name="description" value="<?php echo isset($data['description']) ? $data['description'] : $_POST['description'];?>" class="form-control" placeholder="Enter Email">
                                <p class="error"><?php if($data['descriptionError']): echo $data['descriptionError']; endif;?></p>
                            </div>
                        </div>


                        <div class="form-group" align="center">
                            <input type="submit" name="update" value="Update" class="btn btn-secondary btn-sm btn-icon icon-left">
                            <a href="<?php echo BASE_URL."/admin/polls/showpolls"?>" class="btn btn-secondary btn-sm btn-icon icon-left">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php require_once(BASE_DIR . "/application/views/admin/layout/footer.php"); ?>