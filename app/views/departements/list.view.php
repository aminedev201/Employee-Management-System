<?php $title ='Manage Departements' ?>
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
            <h4 class="m-0 font-weight-bold text-primary"><i class="fa fa-cogs"></i> Manage Departements</h4>
            <div class="add-new-departement">
                  <a href="<?= ROOT ?>departement/add" class="btn btn-sm btn-primary"> <i class="fas fa-plus-circle"></i> Add New Departement</a>
            </div>
      </div>
      <div class="card-body">
            <div class="table-responsive">
               <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                        <tr>
                           <th>#ID</th>
                           <th>Departement Name</th>
                           <th>Start date</th>
                           <th>Actions</th>
                        </tr>
                  </thead>
                  <tfoot>
                        <tr>
                           <th>#ID</th>
                           <th>Departement Name</th>
                           <th>Start date</th>
                           <th>Actions</th>
                        </tr>
                  </tfoot>
                  <tbody>

                     
                     <?php foreach($departements as $departement):?>
                              <tr>
                                 <td><?= $departement->id ?></td>
                                 <td><?= $departement->name ?></td>
                                 <td><?= $departement->created_date_time ?></td>
                                 <td>
                                    <div class="d-flex justify-content-center align-items-center gap-1">
                                       <a href="<?= ROOT.'departement/show/'.$departement->id?>" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Show</a>
                                       <a href="<?= ROOT.'departement/edit/'.$departement->id?>" class="btn btn-sm btn-warning mx-2"><i class="fas fa-edit" ></i> Edit</a>
                                       <a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal<?=$departement->id?>"><i class="fas fa-trash"></i> Delete</a>

                                       <div class="modal fade" id="deleteModal<?=$departement->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                          aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                   <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
                                                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                      </button>
                                                   </div>
                                                   <div class="modal-body text-left">Are you sure you want to delete the departement <b>id <?= $departement->id ?></b> ?</div>
                                                   <div class="modal-footer">
                                                      <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                      <a class="btn btn-sm btn-danger" href="<?= ROOT.'departement/destroy/'.$departement->id?>">Yes, Delete</a>
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