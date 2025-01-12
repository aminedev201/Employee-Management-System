<?php
class Configuration extends Model { 

    protected $table = 'configurations';
    protected $allowedColumns = [
        'id',
        'type',
        'value',
        'created_date_time',
        'updated_date_time',
    ];
 
    public function __construct(){}

    public function validate($data){

        $type  = strtolower(Validator::skip($data['type']));

        $value = Validator::skip($data['value']);

        if(empty($value)){

            $this->errors['value_error'] = 'Configuration value is required!';

        }else{

            if($type == 'monthly payday'){

                if(!filter_var($value,FILTER_VALIDATE_INT)){

                    $this->errors['value_error'] = 'Configuration value is unsined integer!';

                }else{

                    if($value < 1 || $value > 28){

                        $this->errors['value_error'] = 'Configuration value is between 1 and 28 !';

                    }
                }

            }
        }

        return empty($this->errors);


    }


    
}