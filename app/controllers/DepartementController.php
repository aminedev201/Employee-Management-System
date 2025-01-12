<?php
class DepartementController extends Controller{
    
    public function index(){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');

        $departement = new Departement();

        $data['departements']= $departement->list();
        
        $this->view('departements/list',$data);
    }
    public function add(){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');
          
        $this->view('departements/add');
         
    }
    public function store(){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['saveType']) && $_POST['saveType'] == 'add'){

            $departement = new Departement();

            if($departement->validate($_POST)){

                    $name        = ucwords(strtolower(Validator::skip($_POST['name'])));
                    $description = empty(Validator::skip($_POST['description'])) ? NULL : ucfirst(strtolower(Validator::skip($_POST['description'])));
                    
                    $data = [

                    'name'         => $name,
                    'description'  => $description

                    ];

                    $id = $departement->insert($data);

                    if($id){


                        $_SESSION['message'] ="Departement ID $id Added Successfully.";
                        $_SESSION['status']  = 201;

                    }else{

                        $_SESSION['message'] ="Failed To Add Departement.";
                        $_SESSION['status']  = 400;

                    }

                    Glb::redirect(ROOT.'departement');

                    
            }else{

                $_SESSION['errors'] =$departement->setErrors();
                $_SESSION['oldData']=$_POST;

                Glb::redirect(ROOT.'departement/add');

            }

        }else
            Glb::redirect(ROOT."departement");

    }
    public function edit($id=null){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');
 
         $id = Validator::skip($id);
         $id = !empty($id) && filter_var($id,FILTER_VALIDATE_INT) ? $id : false;
         $departement = new Departement();
 
         if(!$id || !$departement->is_exists($id)){
 
             $_SESSION['message'] = "This departement id $id does not found!";
             $_SESSION['status']  = 400;
             Glb::redirect(ROOT.'departement');
 
 
         }
         
         $data['departement'] =  $departement->first($id);

         $this->view('departements/edit',$data);
         
    }
    public function update(){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['saveType']) && $_POST['saveType'] == 'edit'){

            $departement = new Departement();
            $id    = Validator::skip($_POST['id']);
            $id    = !empty($id) && filter_var($id,FILTER_VALIDATE_INT) ? $id : false;
            
            if(!$id || !$departement->is_exists($id)){
    
                $_SESSION['message'] = "This departement id $id does not found!";
                $_SESSION['status']  = 400;
                Glb::redirect(ROOT.'departement');
 
    
            }

            if($departement->validate($_POST)){
    

                $name        = ucwords(strtolower(Validator::skip($_POST['name'])));
                $description = empty(Validator::skip($_POST['description'])) ? NULL : ucfirst(strtolower(Validator::skip($_POST['description'])));
                $data = [
    
                    'name'         => $name,
                    'description'  => $description
    
                ];
    
                $is_updated = $departement->update($data,$id);

                if($is_updated){

                    $_SESSION['message'] ="Departement ID $id Updated Successfully.";
                    $_SESSION['status']  = 200;

                }

                Glb::redirect(ROOT."departement/show/$id");
    
                    
            }else{
    
                $_SESSION['errors'] =$departement->setErrors();
                $_SESSION['oldData']=$_POST;
    
                Glb::redirect(ROOT."departement/edit/$id");
    
            }
    

        }else
            Glb::redirect(ROOT."departement");

    }
    public function destroy($id=null){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');

        $id = Validator::skip($id);
        $id = !empty($id) && filter_var($id,FILTER_VALIDATE_INT) ? $id : false;
        $departement = new Departement();

        if(!$id || !$departement->is_exists($id)){

            $_SESSION['message'] = "This departement id $id does not found!";
            $_SESSION['status']  = 400;


        }


        if($departement->destroy($id)){

            $_SESSION['message'] = "Departement id $id deleted successfully";
            $_SESSION['status']  = 200;
    
        }else{

            $_SESSION['message'] = "Failed to delete departement id $id";
            $_SESSION['status']  = 400;
        }

        Glb::redirect(ROOT.'departement');

    }
    public function show($id=null){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');
  
        $id = Validator::skip($id);
        $id = !empty($id) && filter_var($id,FILTER_VALIDATE_INT) ? $id : false;
        $departement = new Departement();
 
        if(!$id || !$departement->is_exists($id)){
 
            $_SESSION['message'] = "This departement id $id does not found!";
            $_SESSION['status']  = 400;
 
            Glb::redirect(ROOT.'admin');
 
 
        }
 
        $data['departement'] = $departement->first($id);
 
        $this->view('departements/show',$data);
 
     }
        
    

}