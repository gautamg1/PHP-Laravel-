<?php

class Admin extends Database
{
    public function updateProfile($id,$getAdmin){
        // Fetch Old Image
        $path = BASE_DIR."/public/assets/images/admin/";
        if($getAdmin['profile_image']!=""){
            if($fetchImage = $this->getAdminDetails($id)) {
                $fileName = $getAdmin['profile_image'];
                unlink($path.$fetchImage['profile_image']);
                move_uploaded_file($_FILES['profile_image']['tmp_name'],$path.$fileName);
            }
        }
        else{
            if($fetchImage = $this->getAdminDetails($id)){
                unlink($path.$fetchImage['profile_image']);
            }
        }
//        print_r($getAdmin);die;
        $fieldName   = array_keys($getAdmin);
        $fieldValues = array_values($getAdmin);
        $fieldValues[4] = md5($fieldValues[4]);
        for($counter=0;$counter<=count($getAdmin);$counter++)
        {
            $this->query("UPDATE admins SET $fieldName[$counter] = '$fieldValues[$counter]' WHERE id = $id");
        }

    }
    public function getAdminDetails($adminId){
        if($result =  $this->query("SELECT * FROM admins WHERE id = $adminId")) {
           if($result = $this->fetch($result)) {
               return $result;
           }
        }
    }
    public function checkLogin($checkAdmin){
        $email     = $checkAdmin['email'];
        $password  = md5($checkAdmin['password']);

        if($result = $this->query("SELECT * FROM admins WHERE email_address='$email'")) {
            if($this->rowCount()>0) {
                $getAdmin   = $this->fetch($result);
                $dbPassword = $getAdmin['password'];
                $adminname   = $getAdmin['first_name']." ".$getAdmin['last_name'];
                $adminimage      = $getAdmin['profile_image'];
                $adminId     = $getAdmin['id'];

                if($password===$dbPassword) {

                    return ['status'=>'ok','adminname'=>$adminname,'adminid'=>$adminId,'adminimage'=>$adminimage];
                }
                else {
                    return ['status'=>'passwordNotFound'];
                }
            }
            else{
                return ['status'=>'emailNotFound'];
            }
        }
    }

    public function checkEmail($email)
    {
        if ($this->query("SELECT email_address FROM `admins` WHERE email_address = '$email'")) {
            if ($this->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }
    public function updateToken($adminDetails)
    {
        $email = $adminDetails['email'];
        $token = $adminDetails['token'];
        if ($this->query("UPDATE `admins` SET `access_token`='$token' WHERE email_address='$email'")) {
            return true;
        } else {
            return false;
        }
    }
    public function checkToken($token)
    {

        $this->query("SELECT * FROM `admins` WHERE access_token='$token'");
        if ($this->rowCount() > 0) {
            return true;
        } else {
            return false;
        }

    }
    public function resetPassword($admin)
    {
        $token = NULL;
        $password = md5($admin['new_password']);
        $email = $admin['email'];
        if ($this->query("UPDATE `admins` SET `access_token`='$token',`password`='$password' WHERE email_address='$email'")) {
            return true;
        } else {
            return false;
        }
    }
}