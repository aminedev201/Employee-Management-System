<?php
class App {

    private static $url        = [];

    private static $controller = 'Admin';
    
    private static $method     = 'index';

    private static function splitUrl(string $url):array{

        return explode('/',trim($url,'/'));

    }

    private static function loadMethod($controllerObj){

        self::$method = 'index';

        $method_name = isset(self::$url[1]) && !empty(Validator::skip(self::$url[1])) ? strtolower(Validator::skip(self::$url[1])) : 'index' ;

        if(method_exists($controllerObj,$method_name)){

            unset(self::$url[1]);

            self::$method = $method_name ;

        }

    }

    public static function loadController($url){

        self::$url = self::splitUrl($url);

        $controller_name =  isset(self::$url[0]) && !empty(Validator::skip(self::$url[0])) ? ucfirst(strtolower(Validator::skip(self::$url[0]))) : 'Login';

        $fileName = '../app/controllers/'.$controller_name .'Controller.php';

        $_404Controller = '../app/controllers/_404Controller.php';

        if(file_exists($fileName)){

            unset(self::$url[0]);

            self::$controller = $controller_name;

            require_once $fileName;

        }else{

            self::$controller = '_404';

            require_once $_404Controller;

        }

        $controllerClass = self::$controller.'Controller';

        $controllerObj   = new $controllerClass();

        self::loadMethod($controllerObj);

        call_user_func_array([$controllerObj,self::$method],self::$url);

    }

}