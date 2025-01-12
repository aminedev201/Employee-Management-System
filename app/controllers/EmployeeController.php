<?php
class EmployeeController extends Controller{
    
    public function index(){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');

        $employee = new Employee();
        $data['employees']= $employee->inner_join_between_2_tables(['id','cin','firstName','lastName' ,'jobType','created_date_time' ,'departementId'],['name as departementName'],'departements','departementId','id','E','D');
        $this->view('employees/list',$data);
        
    }
    public function add(){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');
 
         $data['countries']     = Glb::countries();
         $data['jobTypes']      = Glb::jobTypes();
         $data['maritalStatus'] = Glb::maritalStatus();

         $departement = new Departement();

         $data['departements'] = $departement->list();
         
         $this->view('employees/add',$data);
         
    }
    public function show($id=null){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');
  
        $id = Validator::skip($id);
        $id = !empty($id) && filter_var($id,FILTER_VALIDATE_INT) ? $id : false;
        $employee = new Employee();
 
        if(!$id || !$employee->is_exists($id)){
 
            $_SESSION['message'] = "This employee id $id does not found!";
            $_SESSION['status']  = 400;
 
            Glb::redirect(ROOT.'employee');
 
 
        }
 
        $employee =  $employee->first($id,);
        $departement = new Departement();
        $data['departementName'] = $departement->where('id = :id',['id' => $employee->departementId],['name'],Departement::FETCH_COLUMN);
        $data['employee'] = $employee ;
 
        $this->view('employees/show',$data);
 
    }
    public function store(){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['saveType']) && $_POST['saveType'] == 'add'){

          $employee = new Employee();

           if($employee->validate($_POST,$_FILES)){

                $firstName      = Validator::skip($_POST['firstName']);
                $lastName       = Validator::skip($_POST['lastName']);
                $gender         = Validator::skip($_POST['gender']);
                $country        = Validator::skip($_POST['country']);
                $email          = Validator::skip($_POST['email']);
                $phone          = Validator::skip($_POST['phone']);
                $address        = Validator::skip($_POST['address']);
                $maritalStatus  = Validator::skip($_POST['maritalStatus']);
                $salary         = Validator::skip($_POST['salary']);
                $dateOfJoining  = Validator::skip($_POST['dateOfJoining']);
                $jobType        = Validator::skip($_POST['jobType']);
                $workingHours   = Validator::skip($_POST['workingHours']);
                $departementId  = Validator::skip($_POST['departementId']);
                $cin            = Validator::skip($_POST['cin']);
                $dateOfBirth    = Validator::skip($_POST['dateOfBirth']);
                $avatar    = NULL;

                // Upload Admin Profile avatar
                if(isset($_FILES['avatar']['name']) && !empty(Validator::skip($_FILES['avatar']['name']))){

                    $avatarName    = Validator::skip($_FILES['avatar']['name']);
                    $tmp_name     = Validator::skip($_FILES['avatar']['tmp_name']); 
                    $newAvatarName = 'employee-profile-avatar-'.GLB::generateGUIDv4(); 
                    $avatar = GLB::renameFile($avatarName,$newAvatarName);
                    $to           = UPL_EMPLOYEE_PROFILE_IMGS.$avatar;

                    if(!move_uploaded_file($tmp_name,$to)){
                        
                        echo '<br>Error: Uploading Profile avatar failed<br>';
                    }

                }

                $data = [

                    'cin'            => strtoupper($cin),
                    'firstName'      => ucwords(strtolower($firstName)),
                    'lastName'       => ucwords(strtolower($lastName)),
                    'country'        => ucwords(strtolower($country)),  
                    'address'        => ucfirst(strtolower($address)),
                    'gender'         => $gender,
                    'phone'          => $phone,
                    'dateOfBirth'    => $dateOfBirth,
                    'email'          => $email,
                    'maritalStatus'  =>$maritalStatus,
                    'salary'         =>$salary,
                    'dateOfJoining'  =>$dateOfJoining,
                    'jobType'        =>$jobType,
                    'jobType'        =>$jobType,
                    'workingHours'   =>$workingHours,
                    'departementId'  =>$departementId,
                    'avatar'         => $avatar

                ];

                $id =$employee->insert($data);

                if($id){

                    $_SESSION['message'] ="Employee ID $id Added Successfully.";
                    $_SESSION['status']  = 201;

                }else{

                    $_SESSION['message'] ="Failed To Add employee.";
                    $_SESSION['status']  = 400;

                }

                Glb::redirect(ROOT.'employee');

                 
           }else{

               $_SESSION['errors'] =$employee->setErrors();
               $_SESSION['oldData']=$_POST;

               Glb::redirect(ROOT.'employee/add');

           }

        }else
            Glb::redirect(ROOT.'employee');

    }
    public function edit($id=null){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');
 
         $id = Validator::skip($id);
         $id = !empty($id) && filter_var($id,FILTER_VALIDATE_INT) ? $id : false;
         $employee = new Employee();
 
         if(!$id || !$employee->is_exists($id)){
 
             $_SESSION['message'] = "This employee id $id does not found!";
             $_SESSION['status']  = 400;
             Glb::redirect(ROOT.'employee');
 
 
         }
         $departement = new Departement();
         
         $data['countries']     = Glb::countries();
         $data['jobTypes']      = Glb::jobTypes();
         $data['maritalStatus'] = Glb::maritalStatus();
         $data['departements'] = $departement->list();
         
         $data['employee'] =  $employee->first($id);
         $this->view('employees/edit',$data);
         
    }
    public function update(){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['saveType']) && $_POST['saveType'] == 'edit'){

           $id    = Validator::skip($_POST['id']);
           $id    = !empty($id) && filter_var($id,FILTER_VALIDATE_INT) ? $id : false;
            $employee = new Employee();
   
           if(!$id || ! $employee->is_exists($id)){
   
               $_SESSION['message'] = "This employee id $id does not found!";
               $_SESSION['status']  = 400;
               Glb::redirect(ROOT.'employee');

   
           }

           if( $employee->validate($_POST,$_FILES)){

            
                $firstName      = Validator::skip($_POST['firstName']);
                $lastName       = Validator::skip($_POST['lastName']);
                $gender         = Validator::skip($_POST['gender']);
                $country        = Validator::skip($_POST['country']);
                $email          = Validator::skip($_POST['email']);
                $phone          = Validator::skip($_POST['phone']);
                $address        = Validator::skip($_POST['address']);
                $maritalStatus  = Validator::skip($_POST['maritalStatus']);
                $salary         = Validator::skip($_POST['salary']);
                $dateOfJoining  = Validator::skip($_POST['dateOfJoining']);
                $jobType        = Validator::skip($_POST['jobType']);
                $workingHours   = Validator::skip($_POST['workingHours']);
                $departementId  = Validator::skip($_POST['departementId']);
                $cin            = Validator::skip($_POST['cin']);
                $dateOfBirth    = Validator::skip($_POST['dateOfBirth']);
                $oldAvatar      =  $employee->where('id = :id',['id'=>$id],['avatar'],employee::FETCH_COLUMN);
                $avatar         = $oldAvatar;

                if(isset($_FILES['avatar']['name']) && !empty(Validator::skip($_FILES['avatar']['name']))){

                    $avatarName    = Validator::skip($_FILES['avatar']['name']);
                    $tmp_name      = Validator::skip($_FILES['avatar']['tmp_name']); 
                    $newAvatarName = 'employee-profile-avatar-'.GLB::generateGUIDv4(); 
                    $avatar        = GLB::renameFile($avatarName,$newAvatarName);
                    $to            = UPL_EMPLOYEE_PROFILE_IMGS.$avatar;

                    if(!move_uploaded_file($tmp_name,$to)){
                        
                        echo '<br>Error: Uploading Profile avatar failed<br>';
                    }

                    if(!empty($oldAvatar)){

                        $avatar_path = "../app/uploads/employees/avatars/$oldAvatar";
                    
                        if(!unlink($avatar_path)){
            
                            echo "<br>failed to delete avatar from $avatar_path <br>";
                        }
                   }

                }



                $data = [

                    'cin'            => strtoupper($cin),
                    'firstName'      => ucwords(strtolower($firstName)),
                    'lastName'       => ucwords(strtolower($lastName)),
                    'country'        => ucwords(strtolower($country)),  
                    'address'        => ucfirst(strtolower($address)),
                    'gender'         => $gender,
                    'phone'          => $phone,
                    'dateOfBirth'    => $dateOfBirth,
                    'email'          => $email,
                    'maritalStatus'  =>$maritalStatus,
                    'salary'         =>$salary,
                    'dateOfJoining'  =>$dateOfJoining,
                    'jobType'        =>$jobType,
                    'jobType'        =>$jobType,
                    'workingHours'   =>$workingHours,
                    'departementId'  =>$departementId,
                    'avatar'         => $avatar

                ];

                $is_updated =  $employee->update($data,$id);

                if($is_updated){

                    $_SESSION['message'] ="Employee ID $id Updated Successfully.";
                    $_SESSION['status']  = 200;

                }

                Glb::redirect(ROOT."employee/show/$id");
                 
           }else{

               $_SESSION['errors'] = $employee->setErrors();
               $_SESSION['oldData']=$_POST;

               Glb::redirect(ROOT."employee/edit/$id");

           }

        }else
            Glb::redirect(ROOT.'employee');

    }
    public function removeAvatar(){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');
 
         if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['saveType']) && $_POST['saveType'] == 'remove_avatar'){
 
                $id = Validator::skip($_POST['id']);
                $avatar = Validator::skip($_POST['avatar']);
                $id = !empty($id) && filter_var($id,FILTER_VALIDATE_INT) ? $id : false;
                $employee = new Employee();

                if(!$id || !$employee->is_exists($id)){

                    $_SESSION['message'] = "This employee id $id does not found!";
                    $_SESSION['status']  = 400;
                    Glb::redirect(ROOT.'admin');


                }

                $is_removed = $employee->update(['avatar'=>null],$id);
                
                if($is_removed){

                    $avatar_path = "../app/uploads/employees/avatars/$avatar";
                
                    if(!unlink($avatar_path)){
        
                        echo "<br>failed to delete avatar from $avatar_path <br>";
                    }

                    $_SESSION['message'] ="Employee Avatar Removed Successfully.";
                    $_SESSION['status']  = 200;

                }else{

                    $_SESSION['message'] ="Failed To Remove employee Avatar.";
                    $_SESSION['status']  = 400;

                }

                Glb::redirect(ROOT."employee/show/$id");
 
 
         }else
 
             Glb::redirect(ROOT.'employee');

    }
    public function destroy($id=null){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');
 
         $id = Validator::skip($id);
         $id = !empty($id) && filter_var($id,FILTER_VALIDATE_INT) ? $id : false;
         $employee = new Employee();
 
         if(!$id || !$employee->is_exists($id)){
 
             $_SESSION['message'] = "This employee id $id does not found!";
             $_SESSION['status']  = 400;
 
 
         }
 
 
         $avatar = $employee->where('id = :id',['id'=>$id],['avatar'],employee::FETCH_COLUMN);
 
         if($employee->destroy($id)){
 
             if(!empty($avatar)){
 
                 $avatar_path = "../app/uploads/employees/avatars/$avatar";
                 
                 if(!unlink($avatar_path)){
     
                     echo "<br>failed to delete avatar from $avatar_path <br>";
                 }
     
             }
 
             $_SESSION['message'] = "Employee id $id deleted successfully";
             $_SESSION['status']  = 200;
 
         }else{
 
             $_SESSION['message'] = "Failed to delete employee id $id";
             $_SESSION['status']  = 400;
         }
 
         Glb::redirect(ROOT.'employee');
 
 
 
    }

    public function downloadAvatar($id=null,$avatar=null){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');

        $avatar = Validator::skip($avatar);
        $id = !empty($id) && filter_var($id,FILTER_VALIDATE_INT) ? $id : false;
        $employee = new Employee();

        if(!$id || !$employee->is_exists($id) || !$employee->is_exists($avatar,'avatar')){

            Glb::redirect(ROOT.'employee');

        }

        $avatar_path = "../app/uploads/employees/avatars/$avatar";

        if(!Glb::DowloadFile($avatar_path)){

            $_SESSION['message'] ="Failed To download employee Avatar.";
            $_SESSION['status']  = 400;
            Glb::redirect(ROOT.'employee');

        }

        Glb::redirect(ROOT."employee/show/$id");

    }


}