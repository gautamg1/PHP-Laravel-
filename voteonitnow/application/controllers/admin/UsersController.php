<?php


class UsersController extends Framework
{
    public $model;
    public function __construct()
    {
        if(empty($this->getSession('adminid')))
        {
            $this->redirect("admin");
        }
        $this->model = $this->model('User');
        
    }
    public function markAsReviewer()
    {

        $user_id = $_POST['user_id'];
        $review_status = $_POST['review_status'];
        $this->model->updatereviewer($user_id,$review_status);
        $this->redirect("admin/polls/showpolls");
    }
    public function getallusers($page = '', $no = '')
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
        $getUsers = $this->model->getAllUsers($offset, $total_records_per_page);
        $totalUsers = $this->model->totalUsers();
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

        $this->view('admin/user/users', ['pagination'=>$pagination,'getusers'=>$getUsers,'totalusers'=>$totalUsers]);
    }

    public function edituser($id)
    {

        $getUser = $this->model->getUser($id);
        $this->view('admin/user/edituser', $getUser);
    }

    public function updateuser($id)
    {
        $file = $_FILES['profile_image']['name'];
        $errors = [];
        $getValue =
            [
                'first_name' => $this->input('first_name'),
                'last_name' => $this->input('last_name'),
                'email_address' => $this->input('email_address'),
                'profile_image' => $file
            ];

        if (empty($getValue['first_name'])) {
            $errors['first_nameError'] = "First Name Required";
        } elseif (empty($getValue['last_name'])) {
            $errors['last_nameError'] = "Last Name Required";
        } elseif (empty($getValue['email_address'])) {
            $errors['email_addressError'] = "Email Required";
        } elseif (empty($getValue['profile_image'])) {
            $errors['profile_imageError'] = "Profile Image Required";
        }
        //if getting validation errors
        if (!empty($errors)) {
            $this->view('admin/user/edituser', $errors);
        } //  if getting form value
        else {

            $this->model->updateUser($id, $getValue);
            $this->redirect("admin/users/getallusers");
        }

    }
 
    public function deleteuser($id)
    {
        $this->model->deleteUser($id);
        $this->redirect("admin/users/getallusers");
    }
    public function viewUserPollsss($id,$page = '', $no = '')
    {
        if (isset($page) && $page != '') {
            $page_no = $no;
        } else {
            $page_no = 1;
        }
        $poll = $this->model('Poll');
        $total_records_per_page = 5;
        $offset = ($page_no - 1) * $total_records_per_page;
        $previous_page = $page_no - 1;
        $next_page = $page_no + 1;
        $adjacents = 2;

        $total_records = $poll->getPollsRows($id);
        $total_pages = ceil($total_records / $total_records_per_page);
        $second_last = $total_pages - 1;
        $getuserpolls = $poll->getUserWisePolls($id,$offset, $total_records_per_page);
        $userTotalPolls = $poll->userTotalPolls();
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

        $this->view('admin/user/view_user_polls', ['pagination'=>$pagination,'getuserpolls'=>$getuserpolls,'userTotalPolls'=>$userTotalPolls]);
    }
    public function viewUserPolls($id,$page = '', $no = '')
    {
        $poll = $this->model('Poll');
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
        $total_records = $poll->getPollsRows($id);
        $total_pages = ceil($total_records / $total_records_per_page);
        $second_last = $total_pages - 1;
        $userTotalPolls = $poll->userTotalPolls($id);
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

        if($getuserpolls = $poll->getUserWisePolls($id,$offset, $total_records_per_page))
        {
            $this->view('admin/user/view_user_polls', ['pagination'=>$pagination,'getuserpolls'=>$getuserpolls,'userTotalPolls'=>$userTotalPolls]);   
        }
        else
        {
            $this->view("admin/user/view_user_polls",['no_polls_found'=>'Sorry... No Polls Found For this User.']);
        }
        
    }

    public function logout()
    {
        $this->destroy();
        $this->redirect("admin");
    }

}