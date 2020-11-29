<?php
class UserController extends framework{

    public function __construct()
    {
        $this->user = $this->model('User');
        $this->poll = $this->model('Poll');
    }

    public function login()
    {
        if (isset($_POST['login']))
        {
            $user = [
                'email' => $this->input('email'),
                'password' => $this->input('password') ];

            $errors = ['emailErr' => "", 'passwordErr' => ""];

            if (empty($user['email'])) {
                $errors['emailErr'] = "Email address is required.";
            } elseif (empty($user['password'])) {
                $errors['passwordErr'] = "Password is required.";
            } else {
                $result = $this->user->checkLogin($user);
                if ($result['status'] === 'emailNotFound') {
                    $errors['emailErr'] = "Sorry, Invalid email.";
                    $this->view('front/login', ['errors' => $errors]);
                } elseif ($result['status'] === 'passwordNotFound') {
                    $errors['passwordErr'] = "Sorry, Invalid password.";
                    $this->view('front/login', ['errors' => $errors]);
                } elseif ($result['status'] === 'ok') {
                    $_SESSION['userId'] = $result['userId'];
                    $_SESSION['userName'] = $result['userName'];
                    $_SESSION['image'] = $result['image'];
                    $this->redirect('home');
                }
            }

            if (!empty($errors['emailErr']) || !empty($errors['passwordErr']))
            {
                $data = ['errors' => $errors, 'user' => $user];
                $this->view('front/login', $data);
            }
        } else {
            $this->view('front/login');
        }
    }

    public function signup()
    {
        if (isset($_POST['signup']))
        {
            $errors = ['firstNameErr' => "", 'lastNameErr' => "", 'emailErr' => "", 'passwordErr' => "", 'imageErr' => ""];

            $image = $_FILES['image'];
            $imageName = $image['name'];
            $imageSize = $image['size'];
            $imageTemp = $image['tmp_name'];
            $imageExt = explode('.', $imageName);
            $imageExt = strtolower(end($imageExt));
            $allowed = ['jpg', 'jpeg', 'png'];
            $destination = 'assets/images/users/' . $imageName;

            $user = [
                'firstName' => $this->input('firstName'),
                'lastName' => $this->input('lastName'),
                'email' => $this->input('email'),
                'newPassword' => $this->input('newPassword'),
                'confirmPassword' => $this->input('confirmPassword'),
                'imageName' => $imageName ];

            if (empty($user['firstName'])) {
                $errors['firstNameErr'] = "First name is required";
            } elseif (empty($user['lastName'])) {
                $errors['lastNameErr'] = "Last name is required";
            } elseif (empty($user['email'])) {
                $errors['emailErr'] = "Email address is required.";
            } elseif (!$this->user->checkEmail($user['email'])) {
                $errors['emailErr'] = "Sorry this email is already exist.";
            } elseif (empty($user['newPassword'])) {
                $errors['passwordErr'] = "Please enter new password.";
            } elseif (empty($user['confirmPassword'])) {
                $errors['passwordErr'] = "Please enter confirm password.";
            } elseif ($user['newPassword'] !== $user['confirmPassword']) {
                $errors['passwordErr'] = "Confirm password is not match.";
            } elseif (empty($image['name'])) {
                $errors['imageErr'] = "Please select your image.";
            } elseif (!in_array($imageExt, $allowed)) {
                $errors['imageErr'] = "Upload image only jpg, png nad jpeg formate.";
            } else {
                move_uploaded_file($imageTemp, $destination);
                if ($this->user->add($user))
                {
                    $this->setFlash("signup", "Your account has been created  successfully, Login here..");
                    $this->redirect('user/login');
                }
            }

            if (!empty($errors['firstNameErr']) || !empty($errors['lastNameErr']) || !empty($errors['emailErr']) || !empty($errors['passwordErr']) || !empty($errors['imageErr']))
            {
                $data = ['errors' => $errors, 'user' => $user];
                $this->view('front/signup', $data);
            }
        } else {
            $this->view('front/signup');
        }
    }

    public function vote()
    {
        if (isset($_SESSION['userId']))
        {
            $vote = [
                'pollId' => $this->input('id'),
                'pollVote' => $this->input('pollVote'),
                'comment' => $this->input('comment') ];

            if ($this->poll->storeVote($vote)) {
                $this->redirect('home');
            } else {
                $_SESSION['msg'] = "Your vote is already submited.";
                $this->redirect('home');
            }
        } else {
            $this->redirect('user/login');
        }
    }

    public function forgot()
    {
        if (isset($_POST['reset']))
        {
            $token = "dlkjofewmnvcdoijfdfm21821215sfsbx";
            $token = str_shuffle($token);
            $token = substr($token, 0, 20);
            $data = ['email' => $this->input('email'), 'token' => $token];
            $errors = ['emailErr' => ""];

            if (empty($data['email'])) {
                $errors['emailErr'] = "Email address is required.";
            } elseif ($this->user->checkEmail($data['email'])) {
                $errors['emailErr'] = "Please enter your register email address.";
            } else {
                if ($this->user->updateToken($data)) {
                    $this->helper('mailer', $data);
                }
            }
            if (!empty($errors['emailErr'])) {
                $this->view('front/forgot-password', ['errors' => $errors]);
            }
        } else {
            $this->view('front/forgot-password');
        }
    }

    public function reset_password()
    {
        $token =  $_GET['token'];
        $email =  $_GET['email'];
        if (isset($_POST['reset']))
        {
            $user = [
                'newPassword'=>$this->input('newPassword'),
                'confirmPassword'=>$this->input('confirmPassword'),
                'email'=>$this->input('email') ];
            $errors = ['passwordErr'=>""];

            if (empty($user['newPassword'])){
                $errors['passwordErr']="Please enter new password.";
            }elseif (empty($user['confirmPassword'])){
                $errors['passwordErr']="Please enter confirm password.";
            }elseif ($user['newPassword'] !== $user['confirmPassword']){
                $errors['passwordErr']="Your password is not match, please try again.";
            }else{
                if ($this->user->resetPassword($user)){
                    $this->setFlash("changePassword", "Your password has been changed, Login with new password.");
                    $this->redirect('user/login');
                }
            }

            if (!empty($errors['passwordErr'])){
                $this->view('front/reset-password',['errors'=>$errors,'user'=>$user]);
            }
        }else{
            if (!empty($token)){
                if ($this->user->checkToken($token)){
                    $this->view('front/reset-password');
                }else{
                    $this->redirect('user/login');
                }
            }else{
                $this->redirect('user/login');
            }
        }
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('user/login');
    }


}