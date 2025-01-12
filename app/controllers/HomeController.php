<?php
class HomeController extends Controller{
    
    public function index(){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');

        $admin        = new Admin();
        $employee     = new Employee();
        $departement  = new Departement();
        $payment      = new Payment();
        $pad_str= 5;

        $data["admins_count"]        = str_pad($admin->count(),$pad_str,"0",STR_PAD_LEFT);
        $data["employees_count"]     = str_pad($employee->count(),$pad_str,"0",STR_PAD_LEFT);
        $data["departements_count"]  = str_pad($departement->count(),$pad_str,"0",STR_PAD_LEFT);
        $data["payments_count"]  = str_pad($payment->count(),$pad_str,"0",STR_PAD_LEFT);

        $this->view('home',$data);

    }

}