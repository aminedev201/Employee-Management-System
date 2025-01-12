<?php
class ConfigurationsController extends Controller{
    
    
    public function index(){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');
        $configuration = new Configuration();
        $data['configurations']= $configuration->list();
        $this->view('configurations/list',$data);

    }

    public function edit($id=null){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');
 
         $id = Validator::skip($id);
         $id = !empty($id) && filter_var($id,FILTER_VALIDATE_INT) ? $id : false;
         $configuration = new Configuration();
 
         if(!$id || !$configuration->is_exists($id)){
 
             $_SESSION['message'] = "This configuration id $id does not found!";
             $_SESSION['status']  = 400;
             Glb::redirect(ROOT.'configurations');

         }
         
         $data['configuration'] =  $configuration->first($id);

         $this->view('configurations/edit',$data);
         
    }

    public function update(){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['saveType']) && $_POST['saveType'] == 'edit'){

           
            $configuration= new Configuration();
            $id    = Validator::skip($_POST['id']);
            $id    = !empty($id) && filter_var($id,FILTER_VALIDATE_INT) ? $id : false;
            
            if(!$id || !$configuration->is_exists($id)){
    
                $_SESSION['message'] = "This configuration id $id does not found!";
                $_SESSION['status']  = 400;
                Glb::redirect(ROOT.'configurations');
 
    
            }

            if($configuration->validate($_POST)){
    
                $data['value'] =  Validator::skip($_POST['value']);

                $is_updated = $configuration->update($data,$id);

                if($is_updated){

                    $_SESSION['message'] ="Configuration ID $id Updated Successfully.";
                    $_SESSION['status']  = 200;

                }

                        
            }else{
    
                $_SESSION['errors'] =$configuration->setErrors();
                $_SESSION['oldData']=$_POST;
    
                Glb::redirect(ROOT."configurations/edit/$id");
    
            }
    

        }

            Glb::redirect(ROOT."configurations");

    }

}