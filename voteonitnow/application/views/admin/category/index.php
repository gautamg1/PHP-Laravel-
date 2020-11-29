<?php $this->includeFile('admin/layout/header'); ?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Category List</h3>
                <span class="pull-right float-right ml-auto ">
                <a href="<?php echo BASE_URL; ?>/admin/category/create" class="btn btn-black btn-sm" title="Add New">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Add New
                </a>
            </span>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Staus</th>
                    <th>Action</th>

                </tr>
                </thead>

                <tbody>
                <?php foreach ($data['getCategory'] as $category): ?>
                <tr>
                    <td><?php echo $category['title']; ?></td>
                    <td><?php

                        if ($category['status']==1)
                        {
                            echo '<span class="badge badge-success">Activate</span>';
                        }else{
                            echo '<span class="badge badge-danger">Inactive</span>';
                        }

                        ?></td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm btn-icon icon-left">
                            Edit
                        </a>

                        <a href="#" class="btn btn-danger btn-sm btn-icon icon-left">
                            Delete
                        </a>

                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

</div>


<?php $this->includeFile('admin/layout/footer'); ?>
