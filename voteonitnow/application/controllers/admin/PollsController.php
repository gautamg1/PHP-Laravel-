<?php


class PollsController extends Framework
{
    public $model;
    public function __construct()
    {
        $this->model = $this->model("Poll");
    }
    public function showPolls($page = '', $no = '')
    {
        if (isset($page) && $page != '') {
            $page_no = $no;
        } else {
            $page_no = 1;
        }
        $total_records_per_page = 5;
        $offset = ($page_no - 1) * $total_records_per_page;
        $previous_page = $page_no - 1;
        $next_page = $page_no + 1;
        $adjacents = 2;

        $total_records = $this->model->getTotalRows();
        $total_pages = ceil($total_records / $total_records_per_page);
        $second_last = $total_pages - 1;
        $getPolls = $this->model->getAllPolls($offset, $total_records_per_page);
        $pagination =
            [
                'page_no' => $page_no,
                'next_page' => $next_page,
                'previous_page' => $previous_page,
                'total_records' => $total_records,
                'total_records_per_page' => $total_records_per_page,
                'offset' => $offset,
                'adjacents' => $adjacents,
                'total_pages' => $total_pages,
                'second_last' => $second_last
            ];
        $this->view("admin/poll/poll",['pagination'=>$pagination,'getPolls'=>$getPolls]);
    }
    public function editPoll($id)
    {
        $getPoll = $this->model->getPollDetails($id);
        $this->view('admin/poll/editpoll', $getPoll);
    }
    public function updatePoll($id)
    {
        $file = $_FILES['image']['name'];
        $errors = [];
        $getValue =
            [
                'title' => $this->input('title'),
                'image' => $file,
                'description' => $this->input('description')
            ];

        if (empty($getValue['title'])) {
            $errors['titleError'] = "Title Required";
        } elseif (empty($getValue['image'])) {
            $errors['imageError'] = "Image Required";
        } elseif (empty($getValue['description'])) {
            $errors['descriptionError'] = "Description Required";
        }
        else {

            $this->model->updatePoll($id, $getValue);
            $this->redirect("admin/polls/showpolls");
        }
        //if getting validation errors
        if (!empty($errors)) {
            $this->view('admin/poll/editpoll', $errors);
        } //  if getting form value


    }
    public function deletePoll($id)
    {
        $this->model->deletePoll($id);
        $this->redirect("admin/polls/showpolls");
    }
    public function voteCount(){
        if($voteCount = $this->model->voteCount())
        {
           $this->view("admin/poll/poll",['vote_count'=>$voteCount]);
        }
        else{
            $this->view("admin/poll/poll",['no_votecount_found'=>'Sorry... No Vote Count Found']);
        }
    }
    
}