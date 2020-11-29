<?php $this->includeFile('admin/layout/header'); ?>


<div class="row">
    <div class="col-sm-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Add New Category</h3>

                <span class="pull-right float-right ml-auto ">
                <a href="<?php echo BASE_URL; ?>/admin/category" class="btn btn-black btn-sm" title="Add New">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    Back
                </a>
            </span>

            </div>
            <div class="panel-body">

                <form role="form" action="<?php echo BASE_URL; ?>/admin/category/store" class="form-horizontal" role="form" method="post">

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="field-1">Title</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="field-1" placeholder="Enter title" name="categoryTitle">

                            <div class="text-red">
                                <?php if(!empty($data['titleErr'])): echo $data['titleErr']; endif; ?>
                            </div>
                        </div>

                    </div>

                    <div class="form-group-separator"></div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>

                        <div class="col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="categoryStatus" value="1">
                                    ( Activate this category so select this box otherwise Inactive )
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group-separator"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>

                        <div class="col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="submit" value="Add" class="btn btn-black">

                                </label>
                            </div>
                        </div>
                    </div>



                </form>

            </div>
        </div>

    </div>
</div>

<?php $this->includeFile('admin/layout/footer'); ?>
