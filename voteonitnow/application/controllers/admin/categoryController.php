<?php

class CategoryController extends framework
{
    protected $category;
    public function __construct()
    {
        $this->category = $this->model('Category');
    }

    public function index()
    {
        $getCategory = $this->category->getCategory();
        $data = ['getCategory' => $getCategory];
        $this->view('admin/category/index', $data);
    }

    public function create()
    {
        $this->view('admin/category/create');
    }

    public function store()
    {
        $categoryDeatil = [
            'categoryTitle' => $this->input('categoryTitle'),
            'categoryStatus' => $this->input('categoryStatus'),
            'titleErr' => ""
        ];
        if (!empty($categoryDeatil['categoryTitle'])) {
            if (!$categoryDeatil['categoryStatus'] == 1) {
                $categoryDeatil['categoryStatus'] = 0;
            }
            if ($this->category->storeCategory($categoryDeatil)) {
                $this->redirect('admin/category');
            }
        } else {
            if (empty($categoryDeatil['categoryTitle'])) {
                $categoryDeatil['titleErr'] = "Title name is required.";
            }
            $data = ['titleErr' => $categoryDeatil['titleErr']];
            $this->view('admin/category/create', $data);
        }
    }
}




