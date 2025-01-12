<?php
class _404Controller extends Controller{

    public function index(){

        // $this->view('_404');

        if(!isset($_SESSION['admin_email'])){

            Glb::redirect(ROOT.'admin/login');

        }else{

            Glb::redirect(ROOT.'home');

        }
        

    }

}