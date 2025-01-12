<?php
class Employee extends Model { 

    protected $table = 'employees';
    protected $allowedColumns = [
        'id',
        'cin',
        'firstName',
        'lastName',
        'gender',
        'phone',
        'country',
        'dateOfBirth',
        'maritalStatus',
        'salary',
        'dateOfJoining',
        'jobType',
        'workingHours',
        'departementId',
        'email',
        'address',
        'avatar',
        'created_date_time',
        'updated_date_time',
    ];
    public function __construct(){}
    public function validate($data,$files=[]){

        $saveType = Validator::skip($data['saveType']);

        $firstName_max_char      = 30;
        $lastName_max_char       = 30;
        $gender_max_char         = 10;
        $country_max_char        = 100;
        $email_max_char          = 255;
        $dateOfBirth_max         = 200;
        $dateOfBirth_min         = 18;
        $email_max_char          = 255;
        $address_max_char        = 255;
        $workingHours_max_digit  = 24;
        $workingHours_min_digit  = 1;
        $avatar_max_size         = 1;
        $allowed_extensions      = ['jpg','png','jpeg'];

        $firstName      = Validator::skip($data['firstName']);
        $lastName       = Validator::skip($data['lastName']);
        $gender         = Validator::skip($data['gender']);
        $country        = Validator::skip($data['country']);
        $email          = Validator::skip($data['email']);
        $phone          = Validator::skip($data['phone']);
        $address        = Validator::skip($data['address']);
        $maritalStatus  = Validator::skip($data['maritalStatus']);
        $salary         = Validator::skip($data['salary']);
        $dateOfJoining  = Validator::skip($data['dateOfJoining']);
        $jobType        = Validator::skip($data['jobType']);
        $workingHours   = Validator::skip($data['workingHours']);
        $departementId  = Validator::skip($data['departementId']);
        $cin            = Validator::skip($data['cin']);
        $dateOfBirth    = Validator::skip($data['dateOfBirth']);
        $avatarName     = Validator::skip($files['avatar']['name']);

        if($saveType == 'edit'){

            $oldEmail     = Validator::skip($data['oldEmail']);
            $oldCIN       = Validator::skip($data['oldCIN']);

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
            
            if(empty($address)){

                $this->errors['address_error'] = "Address is required!";

            }else{

                if(strlen($address) > $address_max_char )

                $this->errors['address_error'] = "Address can not exceed $address_max_char characters!";

            }

            if(empty($salary)){

                $this->errors['salary_error'] = 'Salary is required!';

            }else{

                if(!filter_var($salary,FILTER_VALIDATE_FLOAT))

                    $this->errors['salary_error'] = "Salary is a floating number!";

            }

            if(empty($workingHours)){

                $this->errors['workingHours_error'] = 'Working hours is required!';

            }else if(!filter_var($workingHours,FILTER_VALIDATE_INT)){

                $this->errors['workingHours_error'] = "Working hours is a integer number!";

            }else{

                if($workingHours < $workingHours_min_digit || $workingHours > $workingHours_max_digit )

                    $this->errors['workingHours_error'] = "working hours must be between $workingHours_min_digit and $workingHours_max_digit digits!";

                

            }

            if(empty($jobType)){

                $this->errors['jobType_error'] = 'Job type is required!';

            }

            if(empty($dateOfJoining)){

                $this->errors['dateOfJoining_error'] = 'Date of joining is required!';

            }
            
            if(empty($maritalStatus)){

                $this->errors['maritalStatus_error'] = 'Marital status is required!';

            }

            if(empty($departementId)){

                $this->errors['departement_error'] = 'Departement is required!';

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