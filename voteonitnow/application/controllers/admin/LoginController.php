<?php

class LoginController extends Framework
{
    public $admin;

    public function __construct()
    {
        $this->admin = $this->model("Admin");
    }

    public function index()
    {
        $this->view("admin/login");
    }

    public function login()
    {
        $error = [];
        $checkAdmin =
            [
                'email' => $this->input('email'),
                'password' => $this->input('password')
            ];

        if (empty($checkAdmin['email'])) {
            $errors['emailError'] = "Please Enter Email";
        } else if (empty($checkAdmin['password'])) {
            $errors['passwordError'] = "Please Enter Password";
        } else {
            $checkAdmin = $this->admin->checkLogin($checkAdmin);
            if ($checkAdmin['status'] === 'emailNotFound') {
                $errors['emailError'] = "Invalid Email";
                $this->view("admin/login", $errors);
            } elseif ($checkAdmin['status'] === 'passwordNotFound') {
                $errors['passwordError'] = "Wrong Password";
                $this->view("admin/login", $errors);
            } elseif ($checkAdmin['status'] === 'ok') {
                $this->setSession('adminid', $checkAdmin['adminid']);
                $this->setSession('adminname', $checkAdmin['adminname']);
                $this->setSession('adminimage', $checkAdmin['adminimage']);
                $this->redirect("admin/users/getallusers");
            }
        }
        if (!empty($errors)) {
            $this->view("admin/login", $errors);
        }

    }
    public function forgotpassword()
    {
        if (isset($_POST['reset']))
        {
            $token = "dlkjofewmnvcdoijfdfm21821215sfsbx";
            $token = str_shuffle($token);
            $token = substr($token, 0, 20);
            $data = ['email' => $this->input('email'), 'token' => $token];
            $errors = [];

            if (empty($data['email'])) {
                $errors['emailError'] = "Email Address is Required.";
            } elseif ($this->admin->checkEmail($data['email']))
            {
                $this->admin->updateToken($data);
                $this->helper('adminmailer', $data);
            } else {
                $errors['emailError'] = "This Email is not Registered Email.";
            }
            if (!empty($errors)) {
                $this->view('admin/forgotpassword',$errors);
            }
        } else {
            $this->view('admin/forgotpassword');
        }
    }
    public function resetPassword()
    {
        $token =  $_GET['token'];
        $email =  $_GET['email'];
        if (isset($_POST['reset']))
        {
            $admin = [
                'new_password'     => $this->input('new_password'),
                'confirm_password' => $this->input('confirm_password'),
                'email'            => $this->input('email')];
            $errors = [];

            if (empty($admin['new_password'])){
                $errors['passwordError']="Please Enter New Password.";
            }elseif (empty($admin['confirm_password'])){
                $errors['confpasswordError']="Please Enter Confirm Password.";
            }elseif ($admin['new_password'] !== $admin['confirm_password']){
                $errors['wrongpasswordError']="Password and Confirm Password did not Match.";
            }else{
                if ($this->admin->resetPassword($admin)){
                    $this->setFlash("changePassword", "Your Password has been Changed, You Can Login with New Password.");
                    $this->redirect('admin/login');
                }
            }

            if (!empty($errors)){
                $this->view('admin/resetpassword',$errors);
            }
        }else{
            if (!empty($token)){
                if ($this->admin->checkToken($token)){
                    $this->view('admin/resetpassword');
                }else{
                    $this->redirect('admin/login');
                }
            }else{
                $this->redirect('admin/login');
            }
        }
    }

}