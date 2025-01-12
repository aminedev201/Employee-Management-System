<?php
class Departement extends Model { 

    protected $table = 'departements';
    protected $allowedColumns = [
        'id',
        'name',
        'description',
        'created_date_time',
        'updated_date_time',
    ];
 
    public function __construct(){}

    public function validate($data){

        $name_max_char  = 50;
        $saveType       = Validator::skip($data['saveType']);
        $name           =  ucwords(strtolower(Validator::skip($data['name'])));

        if($saveType == 'edit'){

            $oldName           =  Validator::skip($data['oldName']);

        }

        if(empty($name)){

            $this->errors['name_error'] = 'Departement name is required!';

        }else if(strlen($name) > $name_max_char ){

            $this->errors['name_error'] = "Departement name can not exceed $name_max_char characters!";

        }else{


            if($saveType == 'add' && $this->is_exists($name,'name')){

                $this->errors['name_error'] = "Departement name already exists!";

            }

            
            if($saveType == 'edit' && $name != $oldName &&  $this->is_exists($name,'name')){

                $this->errors['name_error'] = "Departement name already exists!";

            }
        }


        return empty($this->errors);

    }


    
}