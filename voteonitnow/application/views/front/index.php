<?php
$getPoll = $data['getPoll'];
$getCategory = $data['getCategory'];

$search = $data['search'];
$this->includeFile("front/layout/header");
?>
<div class="container" style="border: 1px  black;">
    <div class="row">
        <div class="col-md-10">
            <form action="<?php echo BASE_URL; ?>/home/index" method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" name="title" placeholder="Search here.."
                               value="<?php if (!empty($search['title'])): echo $search['title']; endif; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <select class="form-control" name="category">
                            <option value="">Search category</option>
                            <?php foreach ($getCategory as $category): ?>
                                <option value="<?php echo $category['id']; ?>"
                                    <?php if (!empty($search['category']) && $search['category'] == $category['id'])
                                    { echo "selected";} ?>>
                                    <?php echo $category['title']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <input type="submit" value="Search" name="search" class="btn btn-success">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<section class="most-visited-area most-visited-area2 most-visited-area5">
    <div class="container">
        <?php if (isset($_SESSION['msg'])) {
            echo "<div class='alert alert-warning'>".$_SESSION['msg']."</div>";
            unset($_SESSION['msg']);
        }
        ?>
        <div class="row">
            <div class="col-md-12">
                <?php foreach ($getPoll as $poll): ?>
                    <div class="most-visited-wrap2">
                        <div class="most-visited-item">
                            <div class="listing-list-img">
                                <a href="<?php echo BASE_URL; ?>/poll/detail?id=<?php echo $poll['id']; ?>">
                                    <div class="listing-img-box">
                                        <img src="<?php echo BASE_URL; ?>/assets/images/polls/<?php echo $poll['image']; ?>" class="list-img" alt="">
                                    </div>
                                </a>
                            </div>
                            <div class="listing-content">
                                <div class="listing-row-content">
                                    <a href="<?php echo BASE_URL; ?>/poll/detail?id=<?php echo $poll['id']; ?>">
                                        <h5 class="listing-meta">
                                            <span class="fa fa-cutlery"></span>
                                            <?php echo $poll['categoryTitle']; ?>
                                        </h5>
                                        <h4 class="listing-title">
                                            <?php echo $poll['title']; ?>
                                            <i class="fa fa-check-circle" data-toggle="tooltip"data-placement="top" title="Claimed"></i>
                                        </h4>
                                    </a>
                                    <a href="#" class="author-img-box">
                                        <img src="<?php echo BASE_URL; ?>/assets/images/users/<?php echo $poll['profile_image']; ?>" class="author-img" alt="author-img">
                                    </a>
                                    <p><?php echo substr($poll['description'], 0, 200) . "  ......"; ?>
                                        <a href="<?php echo BASE_URL; ?>/poll/detail?id=<?php echo $poll['id']; ?>" style="color:blue;">
                                            Read more
                                        </a>
                                    </p><br>

                                    <form action="<?php echo BASE_URL; ?>/user/vote" method="post" id="comment">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="radio" name="pollVote" value="1" required>&nbsp;Yes
                                                &nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="pollVote" value="0" required>&nbsp;No
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="comment" required></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="hidden" name="id" value="<?php echo $poll['id']; ?>">
                                                    <input type="submit" value="Comment"  class="btn btn-info">
                                                </div>
                                            </div>
                                        </div>
                                    </form>


                                </div>
                                <div class="row">
                                    <form action="<?php echo BASE_URL; ?>/user/comment" method="POST">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <textarea class="form-control" name="comment" placeholder="Write a comment hrer..." required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="hidden" name="id" value="<?php echo $poll['id']; ?>">
                                                <input type="submit" name="add" value="Comment"  class="btn btn-info">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="rating-row">
                                    Total&nbsp;&nbsp;<span>Yes <?php echo $poll['vote_count']; ?></span>
                                    &nbsp;&nbsp;&nbsp;
                                    <span>No <?php echo $poll['abuse_count']; ?></span>
                                    &nbsp;&nbsp;&nbsp;

                                    <span>Comment <?php echo $poll['comment_count']; ?></span>
                                </div>

                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div><!-- end row -->
        <?php
        $totalPage = $data['countPoll'];
        $Previous = $_GET['page'] - 1;
        $next = $_GET['page'] + 1;
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="button-shared text-center">
                    <a href="<?php echo BASE_URL; ?>/home/index?page=
                                <?php if ($_GET['page'] > 1) {echo $Previous;} ?>">
                        previous
                    </a>
                    <?php for ($i = 1; $i <= $totalPage; $i++): ?>
                        <a href="<?php echo BASE_URL; ?>/home/index?title= <?php if(!empty($search['title'])) : echo $search['title']; endif; ?>&category=<?php if(!empty($search['category'])): echo $search['category']; endif; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    <?php endfor; ?>
                    <a href="<?php echo BASE_URL; ?>/home/index?page=
                                    <?php if ($_GET['page'] < $totalPage) { echo $next;} ?>">
                        Next
                    </a>
                </div><!-- end button-shared -->
            </div><!-- end col-md-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
<?php $this->includeFile("front/layout/footer"); ?>
<script>
    $(document).ready(function(){

        $('input[type="radio"]').click(function(){
            var userVote = $(this).val();
            var pollId = $(this).data('id');

            $.ajax({
                url:"http://localhost/voteonitnow/user/vote",
                method: "POST",
                data:{userVote:userVote,pollId:pollId},
                success: function(data){
                    $('#result').html(data);
                }


            });
        });

        $("#comment").click(function(){
            $("#show").toggle();
        });
    });
</script>




