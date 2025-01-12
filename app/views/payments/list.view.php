<?php $title ='Payments' ?>
<?php ob_start() ?>

  <?php if(isset($_SESSION['message'])): ?>
      <div id="Message" class="alert alert-<?php echo  $_SESSION['status'] == 400 ?  'danger' : 'success' ?> alert-dismissible fade show" role="alert">
         <strong><?php echo  $_SESSION['status'] == 400 ?  'Faile !' : 'Success !' ?></strong> <?= $_SESSION['message'] ?>
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
      
  <?php 
      unset($_SESSION['message']);
      unset($_SESSION['status']);
      endif; 
   ?>

   <?php if(!$isMonthlyPayday): ?>
      <div class="alert alert-info d-flex align-items-center" role="alert">
         <i class="fas fa-info-circle mr-1"></i>
         <div>
            You can only make payments on the payment day.
         </div>
      </div>
   <?php endif; ?>

   <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-credit-card"></i> Payments</h4>
            <?php if($isMonthlyPayday): ?>
               <div class="Initiate Payments">
                  <a href="<?= ROOT ?>payments/initiatePayments" class="btn btn-sm btn-primary"><i class="fas fa-download"></i> Initiate Payments</a>
               </div>
            <?php endif; ?>

      </div>
      <div class="card-body">
            <div class="table-responsive">
               <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                        <tr>
                           <th>#ID</th>
                           <th>Reference</th>
                           <th>Employer</th>
                           <th>Amount</th>
                           <th>Transaction Date</th>
                           <th>Month</th>
                           <th>Year</th>
                           <th>Status</th>
                           <th>PDF</th>
                        </tr>
                  </thead>
                  <tfoot>
                        <tr>
                           <th>#ID</th>
                           <th>Reference</th>
                           <th>Employer</th>
                           <th>Amount</th>
                           <th>Transaction Date</th>
                           <th>Month</th>
                           <th>Year</th>
                           <th>Status</th>
                           <th>PDF</th>

                        </tr>
                  </tfoot>
                  <tbody>

                     <?php foreach($payments as $payment):?>
                              <tr>
                                 <td><?= $payment->id ?></td>
                                 <td><?= $payment->reference ?></td>
                                 <td><a href="<?= ROOT .'employee/show/'.$payment->employee_id ?>" class="text-decoration-none text-secondary"><?= Employee::getFullName($payment->employerfirstName,$payment->employerLastName) ?></a></td>
                                 <td><i class="fas fa-dollar-sign"></i> <?= $payment->amount ?></td>
                                 <td><?= $payment->launch_date_time ?></td>
                                 <td><?= Glb::getMonthName($payment->month) ?></td>
                                 <td><?= $payment->year ?></td>
                                 <td><div class="p-1 text-white bg-<?= $payment->status == 1 ? "success" : "danger" ?>"><i class="fas fa-<?= $payment->status == 1 ? "check-circle" : "times-circle" ?>"></i> <?= $payment->status == 1 ? "Success" : "Faile" ?></div></td>
                                 <td><a href="<?= ROOT .'payments/dowloadInvoice/'.$payment->id?>" class="text-decoration-none text-success" title='Download Invoice PDF'><i class="fas fa-download"></i></a></td>
                              </tr>
                        <?php endforeach;?>
              
                  </tbody>
               </table>
               <a href="<?= ROOT ?>home" class="btn btn-sm btn-dark mt-2" title="Go Back">
                  <i class="fas fa-arrow-left fa-lg"></i> Go Back
               </a>
            </div>
      </div>
   </div>


<?php  $content = ob_get_clean()?>