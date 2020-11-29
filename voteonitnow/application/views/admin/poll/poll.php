<?php require_once(BASE_DIR . "/application/views/admin/layout/header.php");
$pagination = $data['pagination'];
$data  = $data['getPolls'];
$totalPolls = $data['getallpolls'];?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><h3 class="panel-title"><?php echo "Total Polls : ".$pagination['total_records'] ?></h3>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 btn-group">
                        <button type="button" class="btn btn-blue">Filter</button>
                        <button type="button" class="btn btn-blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa-info"></i>
                        </button>
                        
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="#">Category</a>
                            </li>
                            <li>
                                <a href="#">Date</a>
                            </li>
                            <li>
                                <a href="<?php echo BASE_URL.'/admin/polls/votecount'?>">Vote Count</a>
                            </li>
                            <li>
                                <a href="#">Abuse Count</a>
                            </li>
                        </ul>
                    </div>
            </div>

                <div class="panel-body">
                    <div class="table-responsive" data-pattern="priority-columns" data-focus-btn-icon="fa-asterisk" data-sticky-table-header="true" data-add-display-all-btn="true" data-add-focus-btn="true">
                        <table cellspacing="0" class="table table-small-font table-bordered table-striped">
                            <thead>
                            <tr>
                                <th data-priority="1">Title</th>
                                <th data-priority="2">Image</th>
                                <th data-priority="3">Description</th>
                                <th data-priority="5">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($data as $getPolls) {
                                if($getPolls['image'] != ""){
                                    $userImage = BASE_URL."/public/assets/images/polls/".$getPolls['image'];
                                }else{
                                    $userImage = BASE_URL.'/assets/images/user-4.png';
                                }
                                ?>
                                <tr>
                                    <td><?php echo $getPolls['title']?></td>
                                    <td><img src="<?php echo $userImage?>" height="50px" width="50px" style="border-radius:50%"></td>
                                    <td><?php echo $getPolls['description']?></td>
                                    <?php ?>
                                    <td><a href="<?php echo BASE_URL."/admin/polls/editpoll/".$getPolls['id'];?>" class="btn btn-secondary btn-sm btn-icon icon-left">Edit</a>
                                        <a href="<?php echo BASE_URL."/admin/polls/deletepoll/".$getPolls['id'];?>" class="btn btn-danger btn-sm btn-icon icon-left" onclick="return confirm('Are you Sure To Delete Poll?')">Delete</a>
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                    <!--------pagination start--------->

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                        <div class="dataTables_paginate paging_simple_numbers" id="example-1_paginate">
                            <ul class="pagination">
                                <li class="paginate_button previous <?php if($pagination['page_no']<=1){echo "disabled";}?>">
                                    <a href="<?php if($pagination['page_no']>1){echo BASE_URL.'/admin/polls/showpolls/page/'.$pagination['previous_page'];}?>">Previous</a>
                                </li>
                                <?php
                                for($counter=1;$counter<=$pagination['total_pages'];$counter++){?>
                                    <li class="paginate_button <?php if($pagination['page_no']==$counter){echo 'active';}?>">
                                        <a href="<?php echo BASE_URL.'/admin/polls/showpolls/page/'.$counter?>"><?php echo $counter?></a>
                                    </li>
                                <?php }
                                ?>

                                <li class="paginate_button next <?php if($pagination['page_no']>=$pagination['total_pages']){echo "disabled";}?>">
                                    <a href="<?php if($pagination['page_no']<$pagination['total_pages']){echo BASE_URL.'/admin/polls/showpolls/page/'.$pagination['next_page'];}?>">Next</a>
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