<?php
class Admin extends Model { 

    protected $table = 'admins';
    protected $allowedColumns = [
        'id',
        'cin',
        'firstName',
        'lastName',
        'gender',
        'phone',
        'country',
        'dateOfBirth',
        'email',
        'password',
        'avatar',
        'lastLogin',
        'lastLogout',
        'created_date_time',
        'updated_date_time',
    ];
 
    public function __construct(){}

    public function validate($data,$files=[]){

        $password_max_char  = 30;
        $password_min_char  = 8;

        $saveType = Validator::skip($data['saveType']);

        if($saveType == 'add' || $saveType == 'edit' || $saveType == 'login'){

            $firstName_max_char = 30;
            $lastName_max_char  = 30;
            $gender_max_char    = 10;
            $country_max_char   = 100;
            $email_max_char     = 255;
            $dateOfBirth_max    = 200;
            $dateOfBirth_min    = 18;
            $email_max_char     = 255;
            $avatar_max_size     = 1;
            $allowed_extensions  = ['jpg','png','jpeg'];
        }

        if($saveType == 'add' || $saveType == 'edit'){

            $firstName      = Validator::skip($data['firstName']);
            $lastName       = Validator::skip($data['lastName']);
            $gender         = Validator::skip($data['gender']);
            $country        = Validator::skip($data['country']);
            $email          = Validator::skip($data['email']);
            $phone          = Validator::skip($data['phone']);
            $cin            = Validator::skip($data['cin']);
            $dateOfBirth    = Validator::skip($data['dateOfBirth']);
            $avatarName      = Validator::skip($files['avatar']['name']);

        }

        if($saveType == 'edit'){

            $oldEmail     = Validator::skip($data['oldEmail']);
            $oldCIN       = Validator::skip($data['oldCIN']);

        }

        if($saveType == 'changePassword'){

            $newPassword   = Validator::skip($data['newPassword']);
            $oldPassword   = Validator::skip($data['oldPassword']);
        }

        if($saveType == 'add' || $saveType == 'changePassword'){

            $password         = Validator::skip($data['password']);
            $confirmPassword  = Validator::skip($data['confirmPassword']);
        }

        if($saveType == 'add' || $saveType == 'edit'){


            if(!empty($avatarName)){

                $avatarSize      = Validator::skip($files['avatar']['size']);

                $avatarExtension = end(explode('.',$avatarName));

                $sizeWithMB = ((int)$avatarSize) / 1024 / 1024;

                if(!in_array($avatarExtension,$allowed_extensions,true)){

                    $this->errors['avatar_error'] = "avatar extension must be one of the allowed extensions: ".implode(', ',$allowed_extensions);

                }else{

                    if($sizeWithMB > $avatar_max_size){

                        $this->errors['avatar_error'] = "avatar size exceeds $avatar_max_size MB!";
                   }
                }

             

            }

            if(empty($dateOfBirth)){

                $this->errors['dateOfBirth_error'] = 'Date of birth is required!';

            }else{

                $nowObj = new DateTime();

                $dateOfBirthObj = new DateTime($dateOfBirth);

                $diff = $dateOfBirthObj->diff($nowObj);

                $years = $diff->y;

                if($years < $dateOfBirth_min || $years > $dateOfBirth_max ){

                    $this->errors['dateOfBirth_error'] = "Date of Birth must be between $dateOfBirth_min and $dateOfBirth_max years!";

                }

            }

            if(empty($phone)){

                $this->errors['phone_error'] = 'Phone is required!';

            }else{

                if(!Validator::validatePhone($phone)){

                    $this->errors['phone_error'] = "Phone is not valid!";

                }


            }

            if(empty($cin)){

                $this->errors['cin_error'] = 'CIN is required!';

            }else if(!Validator::validateCIN($cin)){

                $this->errors['cin_error'] = "CIN is not valid!";

            }else{

                if($saveType == 'add' && $this->is_exists($cin,'cin')){

                    $this->errors['cin_error'] = "CIN already exists!";

                }

                if($saveType == 'edit' && $cin != $oldCIN &&  $this->is_exists($cin,'cin')){

                    $this->errors['cin_error'] = "CIN already exists!";

                }
               


            }
            
            if(empty($firstName)){

                $this->errors['firstName_error'] = 'First name is required!';

            }else{

                if(strlen($firstName) > $firstName_max_char )

                $this->errors['firstName_error'] = "First name can not exceed $firstName_max_char characters!";

            }

            if(empty($lastName)){

                $this->errors['lastName_error'] = 'Last name is required!';

            }else{

                if(strlen($lastName) > $lastName_max_char )

                $this->errors['lastName_error'] = "Last name can not exceed $lastName_max_char characters!";

            }

            if(empty($gender)){

                $this->errors['gender_error'] = 'Gender is required!';

            }else{

                if(strlen($gender) > $gender_max_char )

                $this->errors['gender_error'] = "Gender can not exceed $gender_max_char characters!";

            }

            if(empty($country)){

                $this->errors['country_error'] = 'Country is required!';

            }else{

                if(strlen($country) > $country_max_char)

                $this->errors['country_error'] = "Country can not exceed $country_max_char characters!";

            }

            if(empty($email)){

                $this->errors['email_error'] = 'Email is required!';

            }else if(strlen($email) > $email_max_char){

                $this->errors['email_error'] = "Email can not exceed $email_max_char characters!";

            }else if(!Validator::validateEmail($email)){

                $this->errors['email_error'] = "Email is invalid!";

            }else{

                if($saveType == 'add' && $this->is_exists($email,'email')){
                    
                    $this->errors['email_error'] = "Email already exists!";

                }

                if($saveType == 'edit' && $email != $oldEmail &&  $this->is_exists($email,'email')){
                    
                    $this->errors['email_error'] = "Email already exists!";

                }

            }

        }

        if($saveType == 'add' || $saveType == 'changePassword'){

            if(empty($password)){

                $this->errors['password_error'] = 'Password is required!';
    
            }else if(strlen($password) > $password_max_char) {
    
                $this->errors['password_error'] = "Password can not exceed $password_max_char characters!";
    
            }else if(strlen($password) < $password_min_char){

                $this->errors['password_error'] = "Password must be at least $password_min_char characters!";

            }else{

                if($saveType == 'changePassword' && !password_verify($password,$oldPassword)){

                    $this->errors['password_error'] = "Password is incorrect!";

                }

                if($saveType == 'add' && $password != $confirmPassword){
                    
                    $this->errors['confirmPassword_error'] = 'Password and confirm password is not match!';
                   
                }
            }

            

            if($saveType == 'changePassword'){

                
                if(empty($newPassword)){

                    $this->errors['newPassword_error'] = 'New password is required!';
        
                }else if(strlen($newPassword) > $password_max_char) {
        
                    $this->errors['newPassword_error'] = "New password can not exceed $password_max_char characters!";
        
                }else if(strlen($newPassword) < $password_min_char){
    
                    $this->errors['newPassword_error'] = "New password must be at least $password_min_char characters!";
    
                }else{

                    if($newPassword != $confirmPassword){

                        $this->errors['confirmPassword_error'] = 'New password and confirm password is not match!';
        
                    }
    
                }

               
            }

        
        }

        if($saveType == 'login'){

            $email           = Validator::skip($data['email']);
            $password        = Validator::skip($data['password']);

            if(empty($email)){

                $this->errors['email_error'] = 'Email is required!';

            }else if(strlen($email) > $email_max_char){

                $this->errors['email_error'] = "Email can not exceed $email_max_char characters!";

            }else {
                if(!Validator::validateEmail($email)){

                    $this->errors['email_error'] = "Email is invalid!";
    
                }
            }

            if(empty($password)){

                $this->errors['password_error'] = 'Password is required!';
    
            }else if(strlen($password) > $password_max_char) {
    
                $this->errors['password_error'] = "Password can not exceed $password_max_char characters!";
    
            }else {

                if(strlen($password) < $password_min_char){

                    $this->errors['password_error'] = "Password must be at least $password_min_char characters!";
    
                }
            }


        }

        return empty($this->errors);

    }

    public static function getFullName($fnmae , $lname){

        return ucwords($fnmae.' '.$lname);
    }

    public static function getAge($dateOfBirth){

        $birthDate = new DateTime($dateOfBirth);

        $currentDate = new DateTime();

        $age = $currentDate->diff($birthDate);

        return $age->y; 
    }

    
}