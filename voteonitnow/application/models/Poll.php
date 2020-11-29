<?php

class Poll extends Database
{

    //  Admin Side Methods
    public function getTotalRows()
    {
        if ($this->query("SELECT * FROM polls")) {
            return $this->rowCount();
        }
        else
        {
            return false;
        }
    }
    public function getPollsRows($id)
    {
        if ($this->query("SELECT * FROM polls WHERE user_id = $id")) {
            return $this->rowCount();
        }
    }

    public function getUserWisePolls($id,$offset, $total_records_per_page)
    {
        if ($this->query("SELECT * FROM polls WHERE user_id = $id LIMIT $offset,$total_records_per_page")) {
            return $this->fetchAll();
        } else {
            return false;
        }
    }

    public function getAllPolls($offset, $total_records_per_page)
    {
        if ($this->query("SELECT * FROM polls LIMIT $offset,$total_records_per_page")) {
            return $this->fetchAll();
        } else {
            return false;
        }
    }
    public function userTotalPolls($id){
        if($result=$this->query("SELECT COUNT(user_id) FROM polls WHERE user_id=$id"))
        {
           return $this->fetch($result);
        }
    }

    public function getPollDetails($id)
    {
        if ($result = $this->query("SELECT * FROM polls WHERE id = $id")) {
            return $this->fetch($result);
        } else {
            return false;
        }
    }

    public function updatePoll($id, $getValue)
    {

        // Fetch Old Image
        if ($fetchImage = $this->getPollDetails($id)) {
            $path = BASE_DIR . "/public/assets/images/polls/";
            $fileName = $getValue['image'];
            unlink($path . $fetchImage['image']);
            move_uploaded_file($_FILES['image']['tmp_name'], $path . $fileName);
        }

        $fieldName = array_keys($getValue);
        $fieldValues = array_values($getValue);

        for ($counter = 0; $counter <= count($getValue); $counter++) {
            $this->query("UPDATE polls SET $fieldName[$counter] = '$fieldValues[$counter]' WHERE id = $id");
        }
    }

    public function deletePoll($id)
    {
        // Fetch Old Image
        if ($fetchImage = $this->getPollDetails($id)) {
            unlink(BASE_DIR . "/public/assets/images/polls/" . $fetchImage['image']);
        }

        if ($delete = $this->query("DELETE FROM polls WHERE id = $id")) {
            return true;
        } else {
            return false;
        }
    }
    public function voteCount(){
        if($this->query("SELECT vote_count FROM polls")){
            return $this->fetchAll();
        }
        else{
            return false;
        }
    }
    // Front Side Methods
    public function store($poll)
    {
        $userId = $_SESSION['userId'];
        $category = $poll['category'];
        $title = $poll['title'];
        $image = $poll['image'];
        $description = $poll['description'];

        if ($this->query("INSERT INTO `polls`(`user_id`, `category_id`, `title`, `image`, `description`) VALUES ('$userId','$category','$title','$image','$description')")) {
            return true;
        } else {
            return false;
        }

    }

    public function getPoll($page = 0)
    {

        if ($page == "" || $page == 1) {
            $start = 0;
        } else {
            $start = ($page * 5) - 5;
        }
        $limit = 5;

        if ($this->query("SELECT polls.*, users.profile_image, categories.title AS categoryTitle FROM polls 
INNER JOIN users ON users.id=polls.user_id
INNER JOIN categories ON categories.id=polls.category_id
ORDER BY polls.id DESC LIMIT $start,$limit")
        ) {

            return $this->fetchAll();

        }

    }


    public function countPoll()
    {
        if ($this->query("SELECT * FROM `polls`")) {

            $rowCount = $this->rowCount();
            $totalPage = ceil($rowCount / 5);
            return $totalPage;
        }
    }

    public function searchPoll($search, $page = 0)
    {

        $title = $search['title'];
        $category = $search['category'];

        if ($page == "" || $page == 1) {
            $start = 0;
        } else {
            $start = ($page * 5) - 5;
        }
        $limit = 5;


        if (!empty($title) && !empty($category)) {


            $where = "WHERE polls.category_id=" . $category . " AND polls.title LIKE '%" . $title . "%'";

        } elseif (!empty($title)) {

            $where = "WHERE polls.title LIKE '%" . $title . "%'";

        } elseif (!empty($category)) {

            $where = "WHERE polls.category_id=" . $category;
        } else {
            $where = "";
        }

        if ($this->query("SELECT polls.*, users.profile_image, categories.title AS categoryTitle FROM polls 
INNER JOIN users ON users.id=polls.user_id
INNER JOIN categories ON categories.id=polls.category_id
 $where LIMIT $start,$limit")
        ) {

            return $this->fetchAll();

        }


    }


    public function searchCount($search)
    {

        $title = $search['title'];
        $category = $search['category'];
        if (!empty($title) && !empty($category)) {


            $where = "WHERE polls.category_id=" . $category . " AND polls.title LIKE '%" . $title . "%'";

        } elseif (!empty($title)) {

            $where = "WHERE polls.title LIKE '%" . $title . "%'";

        } elseif (!empty($category)) {

            $where = "WHERE polls.category_id=" . $category;
        } else {
            $where = "";
        }

        if ($this->query("SELECT polls.*, users.profile_image, categories.title AS categoryTitle FROM polls 
                          INNER JOIN users ON users.id=polls.user_id
                          INNER JOIN categories ON categories.id=polls.category_id $where")
        ) {

            $rowCount = $this->rowCount();
            $totalPage = ceil($rowCount / 5);
            return $totalPage;

        }

    }

    public function getDetail($id)
    {


        if ($result = $this->query("SELECT polls.*, users.profile_image, categories.title AS categoryTitle FROM polls 
INNER JOIN users ON users.id=polls.user_id
INNER JOIN categories ON categories.id=polls.category_id
 WHERE  polls.id=$id")
        ) {

            return $this->fetch($result);

        }
    }

    public function getPollVote($id)
    {

        if ($this->query("SELECT users.first_name, users.last_name, users.profile_image AS usersImage, poll_votes.comments, poll_votes.created_at FROM poll_votes INNER JOIN users ON users.id = poll_votes.user_id WHERE poll_votes.poll_id='$id' && poll_votes.comments!='NULL'")) {

            return $this->fetchAll();
        }

    }

    public function storeVote($vote)
    {
        $pollId = $vote['pollId'];
        $userId = $_SESSION['userId'];
        $pollVote = $vote['pollVote'];
        $comment = $vote['comment'];


        $this->query("SELECT * FROM `poll_votes` WHERE poll_id='$pollId' AND user_id='$userId'");
        if ($this->rowCount() > 0) {
            return false;
        } else {
            if ($this->query("INSERT INTO `poll_votes`(`poll_id`, `user_id`, `vote`, `comments`) VALUES ('$pollId','$userId','$pollVote','$comment')")) {

                $this->query("SELECT * FROM `poll_votes` WHERE poll_id='$pollId' AND vote='1'");
                $vote_count = $this->rowCount();
                $this->query("SELECT * FROM `poll_votes` WHERE poll_id='$pollId' AND vote='0'");
                $abuse_count = $this->rowCount();

                if ($this->query("UPDATE `polls` SET `vote_count`='$vote_count',`abuse_count`='$abuse_count' WHERE id='$pollId'")){
                    return true;
                }
            }
        }
    }

}