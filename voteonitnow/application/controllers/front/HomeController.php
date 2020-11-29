<?php
class HomeController extends Framework{

    public function __construct()
    {
        $this->poll = $this->model('Poll');
        $this->category = $this->model('Category');
    }

    public function index()
    {
        $search = [
            'title'=>$this->input('title'),
            'category'=>$this->input('category')];

        if(!empty($search['title']) || !empty($search['category']))
        {
            $page = $this->input('page');
            $getPoll = $this->poll->searchPoll($search,$page);
            $countPoll = $this->poll->searchCount($search);
            $getCategory = $this->category->getCategory();
            $this->view('front/index',['getPoll'=>$getPoll,'getCategory'=>$getCategory,'countPoll'=>$countPoll,'search'=>$search]);
        }else{
            $page = $this->input('page');
            $getPoll = $this->poll->getPoll($page);
            $countPoll = $this->poll->countPoll();
            $getCategory = $this->category->getCategory();
            $this->view('front/index',['getPoll'=>$getPoll,'countPoll'=>$countPoll,'getCategory'=>$getCategory,'countComment'=>$countComment]);
        }
    }
}