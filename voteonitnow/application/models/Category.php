<?php

class Category extends database
{

    public function getCategory()
    {

        if ($this->query("SELECT * FROM categories")) {

            return $this->fetchAll();
        }
    }

    public function storeCategory($categoryDeatil)
    {
        $title = $categoryDeatil['categoryTitle'];
        $status = $categoryDeatil['categoryStatus'];

        if ($this->query("INSERT INTO `categories`(`title`,`status`) VALUES ('$title','$status')")) {

            return true;
        } else {
            return false;
        }

    }
}