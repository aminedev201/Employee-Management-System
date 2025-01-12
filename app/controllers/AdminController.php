<?php
class AdminController extends Controller{
    private function updateLastLogin(){ 

        $admin = new Admin();

        self::$currentAdmin = $admin->first($_SESSION['admin_email'],'email');

        $id = self::$currentAdmin->id;

        $currentDateTime = date('Y-m-d H:i:s');

        return $admin->update(['lastLogin'=>$currentDateTime],$id);

    }
    private function updateLastLogout(){ 

        $admin = new Admin();

        $currentDateTime = date('Y-m-d H:i:s');

        return $admin->update(['lastLogout'=>$currentDateTime],self::$currentAdmin->id);

    }
    public function authenticateAdmin(){

        if(isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'home');

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['saveType']) && $_POST    ['saveType'] == 'login'){

            $email          = Validator::skip($_POST['email']);
            $password       = Validator::skip($_POST['password']);
            
            $admin = new Admin();

            if($admin->validate($_POST)){
                
                $hash = $admin->where('email =:email',['email'=>$email],['password'],Admin::FETCH_COLUMN);

                if(password_verify($password,$hash)){

                    $_SESSION['admin_email'] =  $email;

                    $this->updateLastLogin();
                    
                    Glb::redirect(ROOT.'home');

                }else{

                    $_SESSION['message'] ="Email or password is incorrect!";
                    $_SESSION['status']  = 400;

                    $_SESSION['errors'] =$admin->setErrors();
                    $_SESSION['oldData']=$_POST;

                } 
            }else{
                
               $_SESSION['errors'] =$admin->setErrors();
               $_SESSION['oldData']=$_POST;

            }

        }

        Glb::redirect(ROOT.'admin/login');


    }
    public function login(){

        if(isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'home');

        $this->view('login');
        
    }
    public function logout(){
        
        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');

        session_unset();
        session_destroy();

        $this->updateLastLogout();
        
        Glb::redirect(ROOT.'admin/login');

        
    }
    public function index(){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');

        $admin = new Admin();

        $data['admins']= $admin->list();
        $data['currentAdminID']= $admin->first($_SESSION['admin_email'],'email',['id'])->id;
        $this->view('admins/list',$data);
        
    }
    public function show($id=null){

       if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');
 
       $id = Validator::skip($id);
       $id = !empty($id) && filter_var($id,FILTER_VALIDATE_INT) ? $id : false;
       $admin = new Admin();

       if(!$id || !$admin->is_exists($id)){

           $_SESSION['message'] = "This admin id $id does not found!";
           $_SESSION['status']  = 400;

           Glb::redirect(ROOT.'admin');


       }

       $data['admin'] =  $admin->first($id);

       $this->view('admins/show',$data);

    }
    public function add(){

       if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');

        $data['countries'] = Glb::countries();
        
        $this->view('admins/add',$data);
        
    }
    public function store(){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['saveType']) && $_POST['saveType'] == 'add'){

           $admin = new Admin();

           if($admin->validate($_POST,$_FILES)){

                $firstName      = Validator::skip($_POST['firstName']);
                $lastName       = Validator::skip($_POST['lastName']);
                $gender         = Validator::skip($_POST['gender']);
                $country        = Validator::skip($_POST['country']);
                $email          = Validator::skip($_POST['email']);
                $password       = Validator::skip($_POST['password']);
                $password_hashed= password_hash($password,PASSWORD_DEFAULT);
                $phone          = Validator::skip($_POST['phone']);
                $cin            = Validator::skip($_POST['cin']);
                $dateOfBirth    = Validator::skip($_POST['dateOfBirth']);
                $avatar    = NULL;

                // Upload Admin Profile avatar
                if(isset($_FILES['avatar']['name']) && !empty(Validator::skip($_FILES['avatar']['name']))){

                    $avatarName    = Validator::skip($_FILES['avatar']['name']);
                    $tmp_name     = Validator::skip($_FILES['avatar']['tmp_name']); 
                    $newAvatarName = 'admin-profile-avatar-'.GLB::generateGUIDv4(); 
                    $avatar = GLB::renameFile($avatarName,$newAvatarName);
                    $to           = UPL_ADMIN_PROFILE_IMGS.$avatar;

                    if(!move_uploaded_file($tmp_name,$to)){
                        
                        echo '<br>Error: Uploading Profile avatar failed<br>';
                    }

                }

                $data = [

                    'cin'        => strtoupper($cin),
                    'firstName'  => ucwords(strtolower($firstName)),
                    'lastName'   => ucwords(strtolower($lastName)),
                    'gender'     => ucfirst(strtolower($gender)),
                    'phone'      => $phone,
                    'country'    => ucwords(strtolower($country)),  
                    'dateOfBirth'=> $dateOfBirth,
                    'email'      => $email,
                    'password'   => $password_hashed,
                    'avatar'      => $avatar

                ];

                $id = $admin->insert($data);

                if($id){


                    $_SESSION['message'] ="Admin ID $id Added Successfully.";
                    $_SESSION['status']  = 201;

                }else{

                    $_SESSION['message'] ="Failed To Add Admin.";
                    $_SESSION['status']  = 400;

                }

                Glb::redirect(ROOT.'admin');

                 
           }else{

               $_SESSION['errors'] =$admin->setErrors();
               $_SESSION['oldData']=$_POST;

               Glb::redirect(ROOT.'admin/add');

           }

        }else
            Glb::redirect(ROOT.'admin');

    }
    public function edit($id=null){

       if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');

        $id = Validator::skip($id);
        $id = !empty($id) && filter_var($id,FILTER_VALIDATE_INT) ? $id : false;
        $admin = new Admin();

        if(!$id || !$admin->is_exists($id)){

            $_SESSION['message'] = "This admin id $id does not found!";
            $_SESSION['status']  = 400;
            Glb::redirect(ROOT.'admin');


        }
        
        $data['countries'] = Glb::countries();
        $data['admin'] =  $admin->first($id);
        $this->view('admins/edit',$data);
        
    }
    public function update(){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['saveType']) && $_POST['saveType'] == 'edit'){

           $id    = Validator::skip($_POST['id']);
           $id    = !empty($id) && filter_var($id,FILTER_VALIDATE_INT) ? $id : false;
           $admin = new Admin();
   
           if(!$id || !$admin->is_exists($id)){
   
               $_SESSION['message'] = "This admin id $id does not found!";
               $_SESSION['status']  = 400;
               Glb::redirect(ROOT.'admin');

   
           }

           if($admin->validate($_POST,$_FILES)){

                $firstName      = Validator::skip($_POST['firstName']);
                $lastName       = Validator::skip($_POST['lastName']);
                $gender         = Validator::skip($_POST['gender']);
                $country        = Validator::skip($_POST['country']);
                $email          = Validator::skip($_POST['email']);
                $phone          = Validator::skip($_POST['phone']);
                $cin            = Validator::skip($_POST['cin']);
                $dateOfBirth    = Validator::skip($_POST['dateOfBirth']);
                $oldAvatar      = $admin->where('id = :id',['id'=>$id],['avatar'],Admin::FETCH_COLUMN);
                $avatar         = $oldAvatar;

                // Upload Admin Profile avatar
                if(isset($_FILES['avatar']['name']) && !empty(Validator::skip($_FILES['avatar']['name']))){

                    $avatarName    = Validator::skip($_FILES['avatar']['name']);
                    $tmp_name      = Validator::skip($_FILES['avatar']['tmp_name']); 
                    $newAvatarName = 'admin-profile-avatar-'.GLB::generateGUIDv4(); 
                    $avatar        = GLB::renameFile($avatarName,$newAvatarName);
                    $to            = UPL_ADMIN_PROFILE_IMGS.$avatar;

                    if(!move_uploaded_file($tmp_name,$to)){
                        
                        echo '<br>Error: Uploading Profile avatar failed<br>';
                    }

                    if(!empty($oldAvatar)){

                        $avatar_path = "../app/uploads/admins/avatars/$oldAvatar";
                    
                        if(!unlink($avatar_path)){
            
                            echo "<br>failed to delete avatar from $avatar_path <br>";
                        }
                   }

                }



                $data = [

                    'cin'        => strtoupper($cin),
                    'firstName'  => ucwords(strtolower($firstName)),
                    'lastName'   => ucwords(strtolower($lastName)),
                    'gender'     => ucfirst(strtolower($gender)),
                    'phone'      => $phone,
                    'country'    => ucwords(strtolower($country)),  
                    'dateOfBirth'=> $dateOfBirth,
                    'email'      => $email,
                    'avatar'     => $avatar

                ];

                $is_updated = $admin->update($data,$id);

                if($is_updated){

                    if(self::$currentAdmin->id == $id){

                        $_SESSION['admin_email'] =  $email;

                    }

                    $_SESSION['message'] ="Admin ID $id Updated Successfully.";
                    $_SESSION['status']  = 200;

                }

                Glb::redirect(ROOT."admin/show/$id");
                 
           }else{

               $_SESSION['errors'] =$admin->setErrors();
               $_SESSION['oldData']=$_POST;

               Glb::redirect(ROOT."admin/edit/$id");

           }

        }else
            Glb::redirect(ROOT.'admin');

    }
    public function changePassword(){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['saveType']) && $_POST['saveType'] == 'changePassword'){

           $id    = Validator::skip($_POST['id']);
           $id    = !empty($id) && filter_var($id,FILTER_VALIDATE_INT) ? $id : false;
           $admin = new Admin();
   
           if(!$id || !$admin->is_exists($id)){
   
               $_SESSION['message'] = "This admin id $id does not found!";
               $_SESSION['status']  = 400;
               Glb::redirect(ROOT.'admin');

   
           }

           if($admin->validate($_POST)){

                $newPassword       = Validator::skip($_POST['newPassword']);

                $data['password']  = password_hash($newPassword,PASSWORD_DEFAULT);

                $is_password_changed = $admin->update($data,$id);

                if($is_password_changed){

                    $_SESSION['message'] ="Password Changed Successfully.";
                    $_SESSION['status']  = 200;

                }else{

                    $_SESSION['message'] ="Failed To Change Password.";
                    $_SESSION['status']  = 400;

                }
                 
           }else{

               $_SESSION['errors'] =$admin->setErrors();
               $_SESSION['oldData']=$_POST;

               
            }
            
            Glb::redirect(ROOT."admin/edit/$id#change-password");

        }else
            Glb::redirect(ROOT.'admin');




    }
    public function destroy($id=null){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');

        $id = Validator::skip($id);
        $id = !empty($id) && filter_var($id,FILTER_VALIDATE_INT) ? $id : false;
        $admin = new Admin();

        if(!$id || !$admin->is_exists($id)){

            $_SESSION['message'] = "This admin id $id does not found!";
            $_SESSION['status']  = 400;


        }


        $avatar = $admin->where('id = :id',['id'=>$id],['avatar'],Admin::FETCH_COLUMN);

        if($admin->destroy($id)){

            if(!empty($avatar)){

                $avatar_path = "../app/uploads/admins/avatars/$avatar";
                
                if(!unlink($avatar_path)){
    
                    echo "<br>failed to delete avatar from $avatar_path <br>";
                }
    
            }

            if($id == self::$currentAdmin->id){

                $this->logout();

            }

            $_SESSION['message'] = "Admin id $id deleted successfully";
            $_SESSION['status']  = 200;

        }else{

            $_SESSION['message'] = "Failed to delete admin id $id";
            $_SESSION['status']  = 400;
        }

        Glb::redirect(ROOT.'admin');



    }
    public function removeAvatar(){

       if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['saveType']) && $_POST['saveType'] == 'remove_avatar'){

                $id = Validator::skip($_POST['id']);
                $avatar = Validator::skip($_POST['avatar']);
                $id = !empty($id) && filter_var($id,FILTER_VALIDATE_INT) ? $id : false;
                $admin = new Admin();

                if(!$id || !$admin->is_exists($id)){

                    $_SESSION['message'] = "This admin id $id does not found!";
                    $_SESSION['status']  = 400;
                    Glb::redirect(ROOT.'admin');


                }

                $is_removed = $admin->update(['avatar'=>null],$id);
                
                if($is_removed){

                    $avatar_path = "../app/uploads/admins/avatars/$avatar";
                
                    if(!unlink($avatar_path)){
        
                        echo "<br>failed to delete avatar from $avatar_path <br>";
                    }

                    $_SESSION['message'] ="Admin Avatar Removed Successfully.";
                    $_SESSION['status']  = 200;

                }else{

                    $_SESSION['message'] ="Failed To Remove Admin Avatar.";
                    $_SESSION['status']  = 400;

                }

                Glb::redirect(ROOT."admin/show/$id");


        }else

            Glb::redirect(ROOT.'admin');


        



    }

    public function deleteMyAccount(){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['saveType']) && $_POST['saveType'] == 'deleteMyAccount'){

            $id = Validator::skip($_POST['id']);
            $password = Validator::skip($_POST['password']);
            $hash     = Validator::skip($_POST['oldPassword']);

            if(!empty($password) && password_verify($password,$hash)){

                $this->destroy($id);
                 
           }else{

             if(empty($password)){

                $_SESSION['message'] = "Failed to delete your account because your password is required!";
                
            }else if (!password_verify($password,$hash)){
                
                $_SESSION['message'] = "Failed to delete your account because your password is incorrect!";

            }

            $_SESSION['status']=400;

            Glb::redirect(ROOT."admin/show/$id");

           }

        }else

            Glb::redirect(ROOT.'admin');

    }

    public function downloadAvatar($id=null,$avatar=null){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');

        $avatar = Validator::skip($avatar);
        $id = !empty($id) && filter_var($id,FILTER_VALIDATE_INT) ? $id : false;
        $admin = new Admin();

        if(!$id || !$admin->is_exists($id) || !$admin->is_exists($avatar,'avatar')){

            Glb::redirect(ROOT.'employee');

        }

        $avatar_path = "../app/uploads/admins/avatars/$avatar";

        if(!Glb::DowloadFile($avatar_path)){

            $_SESSION['message'] ="Failed To download admin Avatar.";
            $_SESSION['status']  = 400;
            Glb::redirect(ROOT.'admin');

        }

        Glb::redirect(ROOT."admin/show/$id");

    }


}