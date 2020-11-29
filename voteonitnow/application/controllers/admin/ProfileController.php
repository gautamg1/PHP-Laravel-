<?php

class ProfileController  extends Framework
{
    public $model;

    public function __construct()
    {
        $this->model = $this->model("Admin");
    }

    public function  adminProfile()
    {
        if($adminId = $this->getSession("adminid"))
        {
            $adminDetails = $this->model->getAdminDetails($adminId);
            $this->view("admin/profile",$adminDetails);
        }

    }
    public function editProfile($id)
    {
        $image = $_FILES['profile_image']['name'];
        $changeEvent  = $this->input("changeEvent");
        $confirm_password = $this->input("confirm_password");
        $errors = [];
        $getAdmin =
          [
              "first_name"        => $this->input("first_name"),
              "last_name"         => $this->input("last_name"),
              "email_address"     => $this->input("email_address"),
              "profile_image"     => $image
          ];

        if(empty($getAdmin['first_name'])) {
            $errors['first_nameError'] = "Please Enter First Name";
        }
        else if(empty($getAdmin['email_address'])){
            $errors['email_addressError'] = "Please Enter Email";
        }
        else if($changeEvent==1)
        {
            $getAdmin["password"] = $this->input("password");
            if(empty($getAdmin['password'])){
                $errors['passwordError'] = "Please Enter New Password";
            }
            elseif(empty($confirm_password)){
                $errors['confirm_passwordError'] = "Please Enter Confirm Password";
            }
            elseif($getAdmin['password'] != $confirm_password){
                $errors['pass_confirm_passError'] = "Password and Confirm Password Did not Match!";
            }
            else
            {
                $this->model->updateProfile($id,$getAdmin);
                $this->redirect("admin/users/getallusers");
            }
        }
        else if($changeEvent==0){

            $this->model->updateProfile($id,$getAdmin);
            $this->redirect("admin/users/getallusers");
        }
        if(!empty($errors))
        {
            $this->view("admin/profile",$errors);
        }
    }
}