<?php
error_reporting(0);
class Framework
{

    public function view($viewName, $data = [])
    {

        if (file_exists("../application/views/" . $viewName . ".php")) {

            require_once "../application/views/" . $viewName . ".php";
        } else {

            echo "Sorry, " . $viewName . ".php is not found";
        }

    }

    public function model($modelName)
    {

        if (file_exists("../application/models/" . $modelName . ".php")) {

            require_once "../application/models/" . $modelName . ".php";
            return new $modelName;
        } else {

            echo "Sorry, " . $modelName . ".php is not found";
        }
    }


    public function helper($helperName,$data=[])
    {

        if (file_exists("../system/helpers/" . $helperName . ".php")) {

            require_once "../system/helpers/" . $helperName . ".php";
        } else {

            echo "sorry helper file not found";
        }
    }

    public function input($inputName)
    {

        if ($_SERVER['REQUEST_METHOD'] == "POST" || $_SERVER['REQUEST_METHOD'] == "post") {

            return trim(strip_tags($_POST[$inputName]));

        } elseif ($_SERVER['REQUEST_METHOD'] == "GET" || $_SERVER['REQUEST_METHOD'] == "get") {

            return trim(strip_tags($_GET[$inputName]));
        }
    }

    public function redirect($path)
    {

        header("location:" . BASE_URL . "/" . $path);
    }

    public function includeFile($fileName){

        if (file_exists("../application/views/" . $fileName . ".php")) {

            require_once "../application/views/" . $fileName . ".php";
        } else {

            echo "Sorry, " . $fileName . ".php is not found";
        }

    }

    public function setFlash($sessionName,$msg){

        if (!empty($sessionName) && !empty($msg)){

            $_SESSION[$sessionName]=$msg;
        }
    }

    public function flash($sessionName,$className){

        if (!empty($sessionName) && !empty($className)){

            $msg = $_SESSION[$sessionName];

            if (isset($_SESSION[$sessionName])){
                echo  "<div class='".$className."'>".$msg."</div>";
            }
            unset($_SESSION[$sessionName]);
        }
    }

    public function setSession($sessionName,$sessionValue)
    {
        if(!empty($sessionName) && !empty($sessionValue))
        {
            $_SESSION[$sessionName] = $sessionValue;
        }
    }

    public function getSession($sessionName)
    {
        if(!empty($sessionName))
        {
            return $_SESSION[$sessionName];
        }
    }

    public function unsetSession($sessionName)
    {

    }

    public function destroy()
    {
        session_destroy();
    }

}



