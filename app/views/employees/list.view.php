<?php $title ='Manage Employees' ?>
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

   <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h4 class="m-0 font-weight-bold text-primary"><i class="fa fa-cogs"></i> Manage Employees</h4>
            <div class="add-new-admin">
                  <a href="<?= ROOT ?>employee/add" class="btn btn-sm btn-primary"> <i class="fas fa-plus-circle"></i> Add New Employee</a>
            </div>
      </div>
      <div class="card-body">
            <div class="table-responsive">

               <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                        <tr>
                           <th>#ID</th>
                           <th>CIN</th>
                           <th>Full Name</th>
                           <th>Job Type</th>
                           <th>Departement</th>
                           <th>Start Date</th>                           
                           <th>Actions</th>
                        </tr>
                  </thead>
                  <tfoot>
                        <tr>
                           <th>#ID</th>
                           <th>CIN</th>
                           <th>Full Name</th>
                           <th>Job Type</th>
                           <th>Departement</th>
                           <th>Start Date</th>
                           <th>Actions</th>
                        </tr>
                  </tfoot>
                  <tbody>

                     
                     <?php foreach($employees as $employee):?>
                              <tr>
                                 <td><?= $employee->id ?></td>
                                 <td><?= $employee->cin ?></td>
                                 <td><?= Employee::getFullName($employee->firstName , $employee->lastName ) ?></td>
                                 <td><?= Glb::getJobTypeByNumber($employee->jobType)?></td>
                                 <td><a href="<?= ROOT .'departement/show/'.$employee->departementId ?>" class="text-decoration-none text-secondary"><?= $employee->departementName ?></a></td>
                                 <td><?= $employee->created_date_time ?></td>
                                 <td>
                                    <div class="d-flex justify-content-center align-items-center gap-1">
                                       <a href="<?= ROOT.'employee/show/'.$employee->id?>" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Show</a>
                                       <a href="<?= ROOT.'employee/edit/'.$employee->id?>" class="btn btn-sm btn-warning mx-2"><i class="fas fa-edit" ></i> Edit</a>
                                       <a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal<?=$employee->id?>"><i class="fas fa-trash"></i> Delete</a>

                                       <div class="modal fade" id="deleteModal<?=$employee->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                          aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                   <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
                                                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                      </button>
                                                   </div>
                                                   <div class="modal-body text-left">Are you sure you want to delete the admin <b>id <?= $employee->id ?></b> ?</div>
                                                   <div class="modal-footer">
                                                      <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                      <a class="btn btn-sm btn-danger" href="<?= ROOT.'employee/destroy/'.$employee->id?>">Yes, Delete</a>
                                                   </div>
                                                </div>
                                          </div>
                                       </div>

                                    </div>
                                 </td>
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