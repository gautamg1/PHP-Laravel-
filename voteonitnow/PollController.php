<?php
class PollController extends Framework{

    public function __construct()
    {
        $this->category = $this->model('Category');
        $this->poll = $this->model('Poll');
    }

    public function index()
    {
        if(!isset($_SESSION['userId']))
        {
            $this->redirect('user/login');
        }else{
            $getCategory = $this->category->getCategory();
            $this->view('front/add-poll',['getCategory'=>$getCategory]);
        }
    }

    public function store()
    {
        if (isset($_POST['poll']))
        {
            $image = $_FILES['image'];
            $imageName = $image['name'];
            $imageSize = $image['size'];
            $imageTemp = $image['tmp_name'];
            $imageExt = explode('.', $imageName);
            $imageExt = strtolower(end($imageExt));
            $allowed = ['jpg', 'jpeg', 'png'];
            $destination = 'assets/images/polls/'.$imageName;

            $poll = [
                'category'=>$this->input('category'),
                'title'=>$this->input('title'),
                'image'=>$imageName,
                'description'=>$this->input('description') ];

            $errors = ['categoryErr'=>"",'titleErr'=>"",'imageErr'=>"",'descriptionErr'=>""];

            if (empty($poll['category'])){
                $errors['categoryErr']="Please select category.";
            }elseif (empty($poll['title'])){
                $errors['titleErr']="Title is required";
            }elseif (empty($poll['image'])){
                $errors['imageErr']="Please select image file.";
            }elseif (!in_array($imageExt, $allowed)){
                $errors['imageErr']="Upload image only jpg, png nad jpeg formate.";
            }elseif (empty($poll['description'])){
                $errors['descriptionErr']="Description is required.";
            }else{
                move_uploaded_file($imageTemp, $destination);
                if ($this->poll->store($poll)){
                    $this->redirect('home');
                }
            }

            if (!empty($errors['categoryErr']) || !empty($errors['titleErr']) || !empty($errors['imageErr']) || !empty($errors['descriptionErr']))
            {
                $getCategory = $this->category->getCategory();
                $this->view('front/add-poll',['errors'=>$errors,'poll'=>$poll,'getCategory'=>$getCategory]);
            }
        }
    }

    public function detail()
    {
        if (isset($_SESSION['userId']))
        {
            $id = $this->input('id');
            $getDetail = $this->poll->getDetail($id);
            $getPollVote = $this->poll->getPollVote($id);
            $this->view('front/poll-detail',['pollDetail'=>$getDetail, 'voteDetail'=>$getPollVote]);
        }else{
            $this->redirect('user/login');
        }
    }
}