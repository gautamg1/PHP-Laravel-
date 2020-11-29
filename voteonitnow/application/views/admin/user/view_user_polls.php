<?php require_once(BASE_DIR . "/application/views/admin/layout/header.php");
$totalPolls = $data['userTotalPolls'];
$pagination = $data['pagination'];?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <?php if(isset($data['no_polls_found'])){
                         echo $data['no_polls_found'];?>
                         <a href="<?php echo BASE_URL.'/admin/users/getallusers'?>" class="btn btn-secondary btn-sm btn-icon icon-left">Back</a>
                         <?php return false;}?>
                <div class="panel-heading">
                <h3 class="panel-title"><?php echo "Total Polls : ".$totalPolls['COUNT(user_id)'];?></h3>
                <a href="<?php echo BASE_URL.'/admin/users/getallusers'?>" class="btn btn-secondary btn-sm btn-icon icon-left">Back</a>
            </div>
                <div class="panel-body">
                    <div class="table-responsive" data-pattern="priority-columns" data-focus-btn-icon="fa-asterisk" data-sticky-table-header="true" data-add-display-all-btn="true" data-add-focus-btn="true">

                        <table cellspacing="0" class="table table-small-font table-bordered table-striped">
                            <thead>
                            <tr>
                                <th data-priority="1">Category Id</th>
                                <th data-priority="2">Title</th>
                                <th data-priority="3">Image</th>
                                <th data-priority="4">Description</th>
                                <th data-priority="4">Vote Count</th>
                                <th data-priority="5">Abuse Count</th>
                                <th data-priority="5">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $data = $data['getuserpolls'];
                            foreach ($data as $getUser) {
                                if ($getUser['image'] != "") {
                                    $userImage = BASE_URL . "/public/assets/images/polls/" . $getUser['profile_image'];
                                } else {
                                    $userImage = BASE_URL . '/assets/images/user-4.png';
                                }
                                ?>
                                <tr>
                                    <td><?php echo $getUser['category_id'] ?></td>
                                    <td><?php echo $getUser['title'] ?></td>
                                    <td><img src="<?php echo $userImage ?>" height="50px" width="50px" style="border-radius:50%"></td>
                                    <td><?php echo $getUser['description'] ?></td>
                                    <td><?php echo $getUser['vote_count'] ?></td>
                                    <td><?php echo $getUser['abuse_count'] ?></td>
                                    <td><a href="<?php echo BASE_URL . "/admin/polls/deletepoll/" . $getUser['id']; ?>" class="btn btn-danger btn-sm btn-icon icon-left" onclick="return confirm('Are you Sure To Delete Poll?')">Delete</a>
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
                                        echo BASE_URL . '/admin/users/viewuserpolls/1/page/' . $pagination['previous_page'];
                                    } ?>">Previous</a>
                                </li>
                                <?php
                                for ($counter = 1; $counter <= $pagination['total_pages']; $counter++) {
                                    ?>
                                    <li class="paginate_button <?php if ($pagination['page_no'] == $counter) {
                                        echo 'active';
                                    } ?>">
                                        <a href="<?php echo BASE_URL . '/admin/users/viewuserpolls/1/page/' . $counter ?>"><?php echo $counter ?></a>
                                    </li>
                                <?php }
                                ?>

                                <li class="paginate_button next <?php if ($pagination['page_no'] >= $pagination['total_pages']) {
                                    echo "disabled";
                                } ?>">
                                    <a href="<?php if ($pagination['page_no'] < $pagination['total_pages']) {
                                        echo BASE_URL . '/admin/users/viewuserpolls/1/page/' . $pagination['next_page'];
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


<?php require_once(BASE_DIR . "/application/views/admin/layout/footer.php"); ?>