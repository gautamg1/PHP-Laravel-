<?php require_once(BASE_DIR . "/application/views/admin/layout/header.php");
$totalUsers = $data['totalusers'];
$pagination = $data['pagination'];
$data = $data['getusers'];?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                <h3 class="panel-title"><?php echo "Total Users : ".$totalUsers['COUNT(first_name)'];?></h3>
            </div>
                <div class="panel-body">
                    <div class="table-responsive" data-pattern="priority-columns" data-focus-btn-icon="fa-asterisk" data-sticky-table-header="true" data-add-display-all-btn="true" data-add-focus-btn="true">
                        <table cellspacing="0" class="table table-small-font table-bordered table-striped">
                            <thead>
                            <tr>
                                <th data-priority="1">First Name</th>
                                <th data-priority="2">Last Name</th>
                                <th data-priority="3">Email Address</th>
                                <th data-priority="4">Profile Image</th>
                                <th data-priority="4">Mark as Reviewer</th>
                                <th data-priority="5">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            foreach ($data as $getUser) {
                                if ($getUser['profile_image'] != "") {
                                    $userImage = BASE_URL . "/public/assets/images/users/" . $getUser['profile_image'];
                                } else {
                                    $userImage = BASE_URL . '/assets/images/user-4.png';
                                }
                                ?>
                                <tr>
                                    <td><?php echo $getUser['first_name'] ?></td>
                                    <td><?php echo $getUser['last_name'] ?></td>
                                    <td><?php echo $getUser['email_address'] ?></td>
                                    <?php ?>
                                    <td><img src="<?php echo $userImage ?>" height="50px" width="50px" style="border-radius:50%"></td>

                                    <td><input type="hidden" value="0" id="checkid">
                                        <input type="checkbox" value="" <?php if($getUser['is_reviewer']==1){echo 'checked';}?> id="review_status" name="changeEvent" class="markAsReviewer iswitch iswitch-success" data-id="<?php echo $getUser['id'] ?>"></td>
                                    <td><a href="<?php echo BASE_URL . "/admin/users/edituser/" . $getUser['id']; ?>" class="btn btn-secondary btn-sm btn-icon icon-left">Edit</a>
                                        <a href="<?php echo BASE_URL . "/admin/users/deleteuser/" . $getUser['id']; ?>" class="btn btn-danger btn-sm btn-icon icon-left" onclick="return confirm('Are you Sure To Delete User?')">Delete</a>
                                        <a href="<?php echo BASE_URL . "/admin/users/viewuserpolls/" . $getUser['id']; ?>" class="btn btn-blue btn-sm btn-icon icon-left">View Polls</a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!--------pagination start--------->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                        <div class="dataTables_paginate paging_simple_numbers" id="example-1_paginate">
                            <ul class="pagination">
                                <li class="paginate_button previous <?php if ($pagination['page_no'] <= 1) {
                                    echo "disabled";
                                } ?>">
                                    <a href="<?php if ($pagination['page_no'] > 1) {
                                        echo BASE_URL . '/admin/users/getallusers/page/' . $pagination['previous_page'];
                                    } ?>">Previous</a>
                                </li>
                                <?php
                                for ($counter = 1; $counter <= $pagination['total_pages']; $counter++) {
                                    ?>
                                    <li class="paginate_button <?php if ($pagination['page_no'] == $counter) {
                                        echo 'active';
                                    } ?>">
                                        <a href="<?php echo BASE_URL . '/admin/users/getallusers/page/' . $counter ?>"><?php echo $counter ?></a>
                                    </li>
                                <?php }
                                ?>

                                <li class="paginate_button next <?php if ($pagination['page_no'] >= $pagination['total_pages']) {
                                    echo "disabled";
                                } ?>">
                                    <a href="<?php if ($pagination['page_no'] < $pagination['total_pages']) {
                                        echo BASE_URL . '/admin/users/getallusers/page/' . $pagination['next_page'];
                                    } ?>">Next</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!---------pagination End--------->
                </div>
            </div>
        </div>
    </div>

    <script>
        var url = "<?php echo BASE_URL . "/admin/users/markAsReviewer"?>";
        $(document).ready(function () {
            $(document).on('click', '.markAsReviewer', function () {
                // on change,it will take the value either 0 or 1
                $('#review_status').on('change', function(){
                    this.value = this.checked ? 1 : 0;
                }).change();
                // store value o or 1 on onchange to variable
                var user_id = $(this).data('id');
                var review_status = $("#review_status").val();

                $.ajax({
                    type: "POST",
                    url: url,
                    data: {'user_id' : user_id,'review_status':review_status},
                    success: function () {
                        return true;
                    },
                    dataType: "json"
                });
            });
        });
        </script>

<?php require_once(BASE_DIR . "/application/views/admin/layout/footer.php"); ?>