<?php $title ='Add New Departement' ?>
<?php ob_start() ?>
<div class="card o-hidden border-0 shadow-lg mb-4  text-dark">
   <div class="card-body p-0">
         <div class="row">
            <div class="col"> 
               <div class="p-5">
                     <div class="text-center text-primary">
                        <div class="icon"><i class="fas fa-sitemap fa-3x mb-2"></i></div>
                        <h3 class="mb-5"><b>Add New Departement</b></h3>
                     </div>
                     <form action="<?= ROOT ?>departement/store" class="departement" method="POST">
                                                      
                        <div class="form-group row">

                           <div class="col-12  mb-3">

                                 <label for="name">Name</label>
                                 <input type="text" class="form-control" name="name" value="<?php if(isset($_SESSION['oldData']['name'])) { echo $_SESSION['oldData']['name'] ; unset($_SESSION['oldData']['name']); } ?>" id="name" placeholder="Enter Departement Name" >

                                 <?php if(isset($_SESSION['errors']['name_error'])): ?>
                                    <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['name_error'] ?></span>
                                    <?php unset($_SESSION['errors']['name_error']) ?>
                                 <?php endif;?>

                           </div>

                           <div class="col-12 mb-3">
                           
                              <label for="description">Description</label>
                              <textarea class="form-control" id="exampleTextarea" rows="4" name="description" placeholder="Enter Departement Description"><?php if(isset($_SESSION['oldData']['description'])) { echo $_SESSION['oldData']['description'] ; unset($_SESSION['oldData']['description']); } ?></textarea>
                            
                           </div>

                           <div class="col-12 mb-3 d-flex justify-content-end">
                                    
                              <a class="btn btn-sm btn-danger mr-2" href="<?= ROOT ?>departement"><i class="fas fa-times-circle"></i> Cancel</a>

                              <button type="submit" class="btn btn-sm btn-primary" name="saveType" value="add">
                                 <i class="fas fa-save"></i> Add Departement
                              </button>   

                           </div>
                        
         

                        </div>

                     </form>
               </div>
            </div>
         </div>
   </div>
</div>

<?php  $content = ob_get_clean()?>