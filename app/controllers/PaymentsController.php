<?php

use Dompdf\Dompdf;
use Dompdf\Options;

class PaymentsController extends Controller{

    private $monthlyPaydayConfiguration = null;
    private $isMonthlyPayday = false;
    private $isPaymentCreated = false;

    public function __construct(){
        
        if(isset($_SESSION['admin_email'])){

            $email = $_SESSION['admin_email'];
        
            $payment = new Admin();
        
            self::$currentAdmin = $payment->first($email,'email');

        }

        $monthPaydayConfigObj = new Configuration();

        $this->monthlyPaydayConfiguration = $monthPaydayConfigObj->first('Monthly payday','type');
        
        $this->isMonthlyPayday = ( date('d') == $this->monthlyPaydayConfiguration->value);
        
    }
    public function index(){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');
    
        $playment = new Payment();

        $data['payments']= $playment->inner_join_between_2_tables(['id','reference','amount','launch_date_time' ,'status','month' ,'year','employee_id'],["firstName AS employerfirstName","lastName AS employerLastName"],'employees','employee_id','id','P','E');

        $data['isMonthlyPayday'] = $this->isMonthlyPayday;

        $this->view('payments/list',$data);
    }
    private function isEmployeePaidInCurrentMonth($employee_id,$paymentCurrentMonth):bool{

        $playment = new Payment();

        $playment_id = $playment->where('employee_id =:employee_id AND month =:month AND status = 1',['employee_id'=>$employee_id ,'month'=>$paymentCurrentMonth],['id'],Payment::FETCH_COLUMN);

        return filter_var($playment_id,FILTER_VALIDATE_INT);

    }
    private function create($employee){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');

        if(!$this->isMonthlyPayday) Glb::redirect(ROOT.'payments');

        $data['employee_id'] = $employee->id;

        $paymentCurrentMonth = date('m');
   
        if(!$this->isEmployeePaidInCurrentMonth($employee->id,$paymentCurrentMonth)){

            $data['reference']   = Glb::generateRandomString(10);
            $data['amount']      = $employee->salary;
            $data['status']      = 1;
            $data['month']       = $paymentCurrentMonth;
            $data['year']        = date('Y');

            $playment = new Payment();

            if($playment->insert($data)){

                $this->isPaymentCreated = true;
            }
        }
            
    } 
    public function initiatePayments(){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');

        if($this->isMonthlyPayday){

            $employee = new Employee();
            $employees = $employee->list(['id','salary']);

            if(empty($employees)){
    
                $_SESSION['message'] = "There are no employees to initiate the payment process.";
                $_SESSION['status']  = 400;
    
                Glb::redirect(ROOT.'payments');
    
            }

            $this->isPaymentCreated = false;

            foreach ($employees as $employee) {
               
                $this->create($employee);
    
            }

            $today = new DateTime();
            $monthName = strtoupper($today->format('F'));

            if($this->isPaymentCreated){

         
                $_SESSION['message'] = "Employee payments for the month of <strong>$monthName</strong> have been successfully initiated.";
                $_SESSION['status']  = 200;

            }else{

                $_SESSION['message'] = "Employees have already been paid for the month of <strong>$monthName</strong>.";
                $_SESSION['status']  = 400;
            }


        }

        Glb::redirect(ROOT.'payments');




    }
    public function dowloadInvoice($id = null){

        if(!isset($_SESSION['admin_email'])) Glb::redirect(ROOT.'admin/login');

        $id = Validator::skip($id);
        $id = !empty($id) && filter_var($id,FILTER_VALIDATE_INT) ? $id : false;
        $payment = new Payment();

        if(!$id || !$payment->is_exists($id)){

            $_SESSION['message'] = "This payment id $id does not found!";
            $_SESSION['status']  = 400;
            Glb::redirect(ROOT.'payments');
        }

        try{

            $payment     = $payment->first($id);
            $employer    = new Employee();
            $departement = new Departement();
            $employer    = $employer->first($payment->employee_id);
            $departement = $departement->first($employer->departementId);
            $data["paymentFullInfo"] =[

                'payment'    =>$payment,
                'employer'   =>$employer,
                'departement'=>$departement

            ];
            
            ob_start();
                $this->view('payments/invoice',$data);
            $html = ob_get_clean();

            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait'); 
            $dompdf->render();
            $dompdf->addInfo('Title','test title');
            $dompdf->addInfo('Author','test author');
            $generateNewPDFName ='Invoice_'. $employer->firstName .' '.$employer->lastName.'.pdf';
            return $dompdf->stream($generateNewPDFName, ['Attachment' => 1]);
    

        }catch(Exception $e){

            throw new Exception("Error : $e");
            
        }
     
    }

}