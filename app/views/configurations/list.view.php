<?php $title ='Configurations' ?>
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
            <h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-cog icon"></i> Configurations</h4>
      </div>
      <div class="card-body">
            <div class="table-responsive">
               <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                        <tr>
                           <th>#ID</th>
                           <th>Type</th>
                           <th>Value</th>
                           <th>Update Date</th>
                           <th>Actions</th>
                        </tr>
                  </thead>
                  <tfoot>
                        <tr>
                           <th>#ID</th>
                           <th>Type</th>
                           <th>Value</th>
                           <th>Update Date</th>
                           <th>Actions</th>
                        </tr>
                  </tfoot>
                  <tbody>

                     
                     <?php foreach($configurations as $configuration):?>
                              <tr>
                                 <td><?= $configuration->id ?></td>
                                 <td><?= $configuration->type ?></td>
                                 <td><?= $configuration->value ?></td>
                                 <td><?= $configuration->updated_date_time ?></td>
                                 <td>
                                    <div class="d-flex justify-content-center align-items-center gap-1">
                                       <a href="<?= ROOT.'configurations/edit/'.$configuration->id?>" class="btn btn-sm btn-success mx-2"><i class="fas fa-edit" ></i> Edit</a>
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