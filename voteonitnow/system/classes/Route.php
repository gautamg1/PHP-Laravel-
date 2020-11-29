<?php

class Route
{
    //Default controller, method, params
    public $controller = "HomeController";
    public $method = "index";
    public $params = [];

    public function __construct()
    {
        $url = $this->url();
        //for controller call
        if (!empty($url)) {

            if ($url[0] == "admin") {
                if (file_exists(BASE_DIR."/application/controllers/admin/" . $url[1] . "Controller.php")) {
                    $this->controller = $url[1] . 'Controller';
                    unset($url[1]);
                } else {
                    $this->controller = "LoginController";
                    $this->method = "index";
                }
            } else {
                if (file_exists(BASE_DIR."/application/controllers/front/" . $url[0] . "Controller.php")) {
                    $this->controller = $url[0] . 'Controller';
                } else {
                    include "../application/views/admin/404.php";return false;
                    // echo "<b>Sorry, " . $url[0] . ".php is not found";
                }
            }
        }
        if ($url[0] == "admin") {
            require_once BASE_DIR."/application/controllers/admin/" . $this->controller . ".php";
        } else {
            require_once BASE_DIR."/application/controllers/front/" . $this->controller . ".php";
        }
        $this->controller = new $this->controller;
        //for method call..
        if (isset($url[0]) && $url[0] == "admin") {
            if (isset($url[2]) && !empty($url[2])) {
                if (method_exists($this->controller, $url[2])) {
                    $this->method = $url[2];
                    unset($url[2]);
                    unset($url[0]);
                } else {include "../application/views/admin/404.php";return false;
                    // echo "Sorry, \"" . $url[2] . "\" method is not found";
                }
            }
        } else {
            if (isset($url[1]) && !empty($url[1])) {
                if (method_exists($this->controller, $url[1])) {
                    $this->method = $url[1];
                    unset($url[1]);
                } else {include "../application/views/admin/404.php";return false;
                    // echo "Sorry, \"" . $url[1] . "\" method is not found";
                }
            }
        }
        if (isset($url)) {

            $this->params = $url;
        } else {
            $this->params = [];
        }
        call_user_func_array([$this->controller, $this->method], $this->params);
    }


    public function url()
    {
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
            $url = rtrim($url);
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode("/", $url);

            return $url;
            # code...
        }
    }
}
