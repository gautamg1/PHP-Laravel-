<?php
$pollDetail = $data['pollDetail'];
$voteDetail = $data['voteDetail'];
$this->includeFile("front/layout/header");
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <img src="<?php echo BASE_URL; ?>/assets/images/users/<?php echo $pollDetail['profile_image']; ?>"class="img-squre" height="50">&nbsp;Add by&nbsp;<?php echo $pollDetail['first_name']." ".$pollDetail['last_name']." ".$pollDetail['created_at']; ?>
        </div>
    </div>
    <span class="fa fa-thumbs-up">&nbsp;<?php echo $pollDetail['vote_count']; ?></span>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <span class="fa fa-thumbs-down">&nbsp;<?php echo $pollDetail['abuse_count']; ?></span>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <span class="fa fa-comment">&nbsp;<?php echo $pollDetail['comment_count']; ?></span><br><br>
    <h4><?php echo $pollDetail['categoryTitle']; ?></h4>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h3><?php echo $pollDetail['title']; ?></h3><br>
            <img src="<?php echo BASE_URL; ?>/assets/images/polls/<?php echo $pollDetail['image']; ?>"class="img-squre" height="500"><br><br>
            <p><?php echo $pollDetail['description'];?></php></p>
        </div>
    </div>
    <h4> Reviews & Comments</h4><br>
    <?php foreach ($voteDetail AS $vote): ?>
        <div class="row">
            <div class="col-md-12">
                <img src="<?php echo BASE_URL; ?>/assets/images/users/<?php echo $vote['usersImage']; ?>"class="img-squre" height="50"><?php echo $vote['first_name']." ".$vote['last_name']." ".$vote['created_at']; ?>
                <p><?php echo $vote['comments']; ?></p><hr>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php $this->includeFile("front/layout/footer"); ?>