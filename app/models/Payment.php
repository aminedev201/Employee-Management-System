<?php
class Payment extends Model { 

    protected $table = 'payments';
    protected $allowedColumns = [
        'id',
        'reference',
        'amount',
        'launch_date_time',
        'done_date_time',
        'status',
        'month',
        'year',
        'employee_id',
        'created_date_time',
        'updated_date_time',
    ];
 
    public function __construct(){}

    public function validate($data){

    }


    
}