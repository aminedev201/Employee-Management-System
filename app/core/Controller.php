<?php
class Controller{

    public static $currentAdmin = null;

    public function __construct(){
        
        if(isset($_SESSION['admin_email'])){

            $email = $_SESSION['admin_email'];
        
            $admin = new Admin();
        
            self::$currentAdmin = $admin->first($email,'email');

        }
    }
    public function view($view_name,$data=[]){

        $fileName = '../app/views/'.$view_name .'.view.php';

        $_404View = '../app/views/_404.view.php';

        $masster_page = '../app/views/layout/layout.view.php';

        if(file_exists($fileName)){

            extract($data);

            $curAdmin = self::$currentAdmin;

            require_once $fileName;
            

        }else{
            
            require_once $_404View;
        } 

        $viewsNotInhiriteMassterPAge=['login','payments/invoice'];

        if(!in_array($view_name,$viewsNotInhiriteMassterPAge,true)){

            require_once $masster_page;

        }
            
    }

}