<?php

class User extends Database
{
//  Admin Side Methods
    public  function updatereviewer($user_id,$review_status)
    {
        if($this->query("UPDATE users SET is_reviewer = $review_status WHERE id =".$user_id))
        {
            return true;
        }else{
            return false;
        }
    }
    public function getTotalRows()
    {
        if ($this->query("SELECT * FROM users")) {
            return $this->rowCount();
        }
    }
    public function totalUsers(){
        if($result=$this->query("SELECT COUNT(first_name) FROM users"))
        {
           return $this->fetch($result);
        }
    }
    public function getAllUsers($offset, $total_records_per_page)
    {
        if ($this->query("SELECT * FROM users LIMIT $offset,$total_records_per_page")) {
            return $this->fetchAll();
        } else {
            return false;
        }
    }

    public function getUser($id)
    {
        if ($result = $this->query("SELECT * FROM users WHERE id = $id")) {
            return $this->fetch($result);
        } else {
            return false;
        }
    }

    public function updateUser($id, $getValue)
    {

// Fetch Old Image
        if ($fetchImage = $this->getUser($id)) {
            $path = BASE_DIR . "/public/assets/images/users/";
            $fileName = $getValue['profile_image'];
            unlink($path . $fetchImage['profile_image']);
            move_uploaded_file($_FILES['profile_image']['tmp_name'], $path . $fileName);
        }

        $fieldName = array_keys($getValue);
        $fieldValues = array_values($getValue);

        for ($counter = 0; $counter <= count($getValue); $counter++) {
            $this->query("UPDATE users SET $fieldName[$counter] = '$fieldValues[$counter]' WHERE id = $id");
        }
    }

    public function deleteUser($id)
    {
// Fetch Old Image
        if ($fetchImage = $this->getUser($id)) {
            unlink(BASE_DIR . "/public/assets/images/users/" . $fetchImage['profile_image']);
        }

        if ($delete = $this->query("DELETE FROM users WHERE id = $id")) {
            return true;
        } else {
            return false;
        }
    }


//  Front Side Methods
    public function checkEmail($email)
    {

        if ($this->query("SELECT email_address FROM `users` WHERE email_address = '$email'")) {

            if ($this->rowCount() > 0) {

                return false;

            } else {

                return true;

            }
        }

    }

    public function add($user)
    {

        $firstName = $user['firstName'];
        $lastName = $user['lastName'];
        $email = $user['email'];
        $password = password_hash($user['newPassword'], PASSWORD_DEFAULT);
        $imageName = $user['imageName'];

        if ($this->query("INSERT INTO `users`(first_name, `last_name`, `email_address`, `password`, `profile_image`) VALUES ('$firstName','$lastName','$email','$password','$imageName')")) {

            return true;
        } else {
            return false;
        }

    }

    public function checkLogin($user)
    {

        $email = $user['email'];
        $password = $user['password'];

        if ($result = $this->query("SELECT * FROM `users` WHERE email_address = '$email'")) {

            if ($this->rowCount() > 0) {
                $getUser = $this->fetch($result);
                $dbPassword = $getUser['password'];
                $userId = $getUser['id'];
                $userName = $getUser['first_name'] . " " . $getUser['last_name'];
                $image = $getUser['profile_image'];

                if (password_verify($password, $dbPassword)) {
                    return ['status' => 'ok', 'userId' => $userId, 'userName' => $userName, 'image' => $image];

                } else {
                    return ['status' => 'passwordNotFound'];
                }


            } else {
                return ['status' => 'emailNotFound'];
            }


        }
    }

    public function updateToken($data)
    {
        $email = $data['email'];
        $token = $data['token'];

        if ($this->query("UPDATE `users` SET `access_token`='$token' WHERE email_address='$email'")) {

            return true;
        } else {
            return false;
        }

    }

    public function checkToken($token)
    {

        $this->query("SELECT * FROM `users` WHERE access_token='$token'");
        if ($this->rowCount() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function resetPassword($user)
    {
        $token = NULL;
        $password = password_hash($user['newPassword'], PASSWORD_DEFAULT);
        $email = $user['email'];
        if ($this->query("UPDATE `users` SET `access_token`='$token',`password`='$password' WHERE email_address='$email'")) {
            return true;
        } else {
            return false;
        }
    }

}


