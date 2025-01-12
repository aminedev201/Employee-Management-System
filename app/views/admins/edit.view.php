<?php $title ='Edit Admin' ?>
<?php ob_start() ?>

   <div class="card o-hidden border-0 shadow-lg mb-4  text-dark">
      <div class="card-body p-0">
            <div class="row">
               <div class="col"> 
                  <div class="p-5">
                        <div class="text-center text-primary mb-5">
                           <div class="icon"><i class="fa fa-user-shield fa-3x mb-2"></i></div>
                           <h3><b>Edit Admin</b></h3>
                        </div>

                        <div class="d-flex justify-content-center justify-content-md-end mb-5">
                           <div class="remove-avatar text-center">
                              <a href="<?= ROOT.'admin/show/'.$admin->id?>" class="text-decoration-none text-secondary" title='Go To Show Details'><h4><?= Admin::getFullName($admin->firstName, $admin->lastName) ?></h4></a>
                              <p class="text-muted">Administrator</p>
                              <a href="<?= ROOT.'admin/show/'.$admin->id?>" title='Go To Show Details'><img src="<?= !empty($admin->avatar) ? ROOT."app/uploads/admins/avatars/$admin->avatar" : ROOT."app/uploads/admins/avatars/default-admin-avatar.png"?>" alt="Admin Avatar" class="square-image img-thumbnail"> </a>
                                 <?php if(!empty($admin->avatar)) :?>
                                    <form action="<?= ROOT ?>admin/removeAvatar" method="POST">
                                       <input type="hidden" name="id" value="<?= $admin->id ?>">
                                       <input type="hidden" name="avatar" value="<?= $admin->avatar ?>">
                                       <div>
                                          <button type="submit" value="remove_avatar" name="saveType" class="btn btn-sm btn-danger mt-3">
                                             <i class="fas fa-trash-alt"></i> Remove Avatar
                                          </button>
                                       </div>
                                    </form>
                                 <?php endif;?>
                           </div>
                        </div>

                        <div class="d-flex justify-content-center justify-content-md-start">
                           <h5 class="mb-4"><b><i class="fas fa-sync"></i> Change Informations</b></h5>
                        </div>

                        <form action="<?= ROOT ?>admin/update" class="admin" method="POST" enctype="multipart/form-data">
                                                        
                           <input type="hidden" name="id" value="<?= $admin->id ?>">

                           <div class="form-group row">

                              <div class="col-md-6 mb-3">

                                    <label for="firstName">First Name</label>
                                    <input type="text" class="form-control" name="firstName" value="<?php if(isset($_SESSION['oldData']['firstName'])) { echo $_SESSION['oldData']['firstName'] ; unset($_SESSION['oldData']['firstName']); } else { echo $admin->firstName; } ?>" id="firstName" placeholder="Enter First Name" >

                                    <?php if(isset($_SESSION['errors']['firstName_error'])): ?>
                                       <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['firstName_error'] ?></span>
                                       <?php unset($_SESSION['errors']['firstName_error']) ?>
                                    <?php endif;?>

                              </div>

                              <div class="col-md-6 mb-3">
                              
                                 <label for="lastName">Last Name</label>
                                 <input type="text" class="form-control" value="<?php if(isset($_SESSION['oldData']['lastName'])) { echo $_SESSION['oldData']['lastName'] ; unset($_SESSION['oldData']['lastName']); } else { echo $admin->lastName; }  ?>" name="lastName" id="lastName" placeholder="Enter Last Name" >

                                 <?php if(isset($_SESSION['errors']['lastName_error'])): ?>
                                    <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['lastName_error'] ?></span>
                                    <?php unset($_SESSION['errors']['lastName_error']) ?>
                                 <?php endif;?>

                              </div>

                              <div class="col-md-6 mb-3">

                                 <label for="gender">Gender</label>

                                 <?php var_dump(isset($_SESSION['oldData']['gender']) && $_SESSION['oldData']['gender'] == "Male") ?>
                                 <select class="form-control" name="gender" id="gender" >
                                    <option value="Male" <?php if($admin->gender == 'Male'){ echo 'selected' ;} ?> >Male</option>
                                    <option value="Female" <?php if($admin->gender == 'Female'){ echo 'selected' ;} ?> >Female</option>
                                 </select>
                                 <?php if(isset($_SESSION['errors']['gender_error'])): ?>
                                    <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['gender_error'] ?></span>
                                    <?php unset($_SESSION['errors']['gender_error']) ?>
                                 <?php endif;?>
                              </div>

                              <div class="col-md-6 mb-3">

                              <label for="country">Country</label>
                              <select class="form-control" name="country" id="country" >
                                 
                                    <?php foreach($countries as $country) :?>
                                       <option value="<?= $country ?>" <?php if(strtolower($admin->country ) == strtolower($country)){ echo 'selected' ;}  ?> > <?= $country ?></option>
                                    <?php endforeach;?>

                              </select>

                              <?php if(isset($_SESSION['errors']['country_error'])): ?>
                                 <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['country_error'] ?></span>
                                 <?php unset($_SESSION['errors']['country_error']) ?>
                              <?php endif;?>

                              </div>

                              <div class="col-md-6 mb-3">

                                 <label for="phone">Phone Number</label>
                                 <input type="tel" class="form-control" name="phone"  id="phone" value="<?php if(isset($_SESSION['oldData']['phone'])) { echo $_SESSION['oldData']['phone'] ; unset($_SESSION['oldData']['phone']); } else { echo $admin->phone; } ?>" placeholder="Enter Phone Number" >

                                 <?php if(isset($_SESSION['errors']['phone_error'])): ?>
                                    <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['phone_error'] ?></span>
                                    <?php unset($_SESSION['errors']['phone_error']) ?>
                                 <?php endif;?>

                              </div>

                              <div class="col-md-6 mb-3">

                                 <label for="email">Email Address</label>
                                 <input type="text" class="form-control" name="email" id="email" value="<?php if(isset($_SESSION['oldData']['email'])) { echo $_SESSION['oldData']['email'] ; unset($_SESSION['oldData']['email']); }else { echo $admin->email; } ?>" placeholder="Enter Email Address" >
                                 <input type="hidden" name="oldEmail" value="<?= $admin->email ?>">

                                 <?php if(isset($_SESSION['errors']['email_error'])): ?>
                                    <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['email_error'] ?></span>
                                    <?php unset($_SESSION['errors']['email_error']) ?>
                                 <?php endif;?>

                              </div>

                              <div class="col-md-6 mb-3">

                                 <label for="cin">CIN</label>
                                 <input type="text" class="form-control" name="cin" id="cin" value="<?php if(isset($_SESSION['oldData']['cin'])) { echo $_SESSION['oldData']['cin'] ; unset($_SESSION['oldData']['cin']); } else { echo $admin->cin; } ?>"  placeholder="Enter CIN" >
                                 <input type="hidden" name="oldCIN" value="<?= $admin->cin ?>">

                                 <?php if(isset($_SESSION['errors']['cin_error'])): ?>
                                    <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['cin_error'] ?></span>
                                    <?php unset($_SESSION['errors']['cin_error']) ?>
                                 <?php endif;?>

                              </div>
                              <div class="col-md-6 mb-3">

                                 <label for="cin">Date Of Birth</label>
                                 <input type="date" 
                                       class="form-control" 
                                       name="dateOfBirth" 
                                       id="dateOfBirth"  
                                       value="<?php if(isset($_SESSION['oldData']['dateOfBirth'])) { echo $_SESSION['oldData']['dateOfBirth'] ; unset($_SESSION['oldData']['dateOfBirth']); }else { echo $admin->dateOfBirth; } ?>" 
                                       min="<?php echo date('Y-m-d', strtotime('-200 years')); ?>"
                                       max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>"
                                       placeholder="Birth Of Date" >

                                 <?php if(isset($_SESSION['errors']['dateOfBirth_error'])): ?>
                                    <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['dateOfBirth_error'] ?></span>
                                    <?php unset($_SESSION['errors']['dateOfBirth_error']) ?>
                                 <?php endif;?>

                              </div>
                              
                              <div class="col-12 mb-3">

                                 <label for="avatar">Avatar</label>
                                 <input type="file" class="form-control" name="avatar" accept=".jpg,.png,.jpeg" id="avatar">

                                 <?php if(isset($_SESSION['errors']['avatar_error'])): ?>
                                    <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['avatar_error'] ?></span>
                                    <?php unset($_SESSION['errors']['avatar_error']) ?>
                                 <?php endif;?>

                              </div>
                           
                           </div>  

                           <div class="d-flex justify-content-center justify-content-md-end">

                              <button type="submit" class="btn btn-sm btn-primary btn-admin" name="saveType" value="edit">
                                 <i class="fas fa-save"></i> Save Changes
                              </button>   

                           </div>

                        </form>

                        
                        <?php if(isset($_SESSION['message'])): ?>
                           <div id="Message" class="alert alert-<?php echo  $_SESSION['status'] == 400 ?  'danger' : 'success' ?> alert-dismissible fade show mt-5" role="alert">
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

                        <div class="mt-5 d-flex justify-content-center justify-content-md-start">
                           <h5 class="mb-4"><b><i class="fas fa-key"></i> Change Password</b></h5>
                        </div>

                        <form action="<?= ROOT ?>admin/changePassword" class="admin" id="change-password" method="POST" enctype="multipart/form-data">

                           <input type="hidden" name="id" value="<?= $admin->id ?>">
                           <div class="form-group row">

                              <div class="col-12 mb-3">

                                 <label for="password">Passowrd</label>

                                 <input type="password" class="form-control" name="password" id="password" value="<?php if(isset($_SESSION['oldData']['password'])) { echo $_SESSION['oldData']['password'] ; unset($_SESSION['oldData']['password']); } ?>" placeholder="Enter Password" >

                                 <input type="hidden" name="oldPassword" value="<?= $admin->password ?>">

                                 <?php if(isset($_SESSION['errors']['password_error'])): ?>
                                    <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['password_error'] ?></span>
                                    <?php unset($_SESSION['errors']['password_error']) ?>
                                 <?php endif;?>

                              </div>

                              <div class="col-12 mb-3">

                                 <label for="newPassword">New Passowrd</label>
                                 <input type="password" class="form-control" name="newPassword" id="newPassword" value="<?php if(isset($_SESSION['oldData']['newPassword'])) { echo $_SESSION['oldData']['newPassword'] ; unset($_SESSION['oldData']['newPassword']); } ?>" placeholder="Enter New Password" >

                                 <?php if(isset($_SESSION['errors']['newPassword_error'])): ?>
                                    <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['newPassword_error'] ?></span>
                                    <?php unset($_SESSION['errors']['newPassword_error']) ?>
                                 <?php endif;?>

                              </div>

                              <div class="col-12 mb-3">

                                 <label for="confirmPassword">Confirm Passowrd</label>
                                 <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" value="<?php if(isset($_SESSION['oldData']['confirmPassword'])) { echo $_SESSION['oldData']['confirmPassword'] ; unset($_SESSION['oldData']['confirmPassword']); } ?>" placeholder="Confirm Password" >
                                    
                                 <?php if(isset($_SESSION['errors']['confirmPassword_error'])): ?>
                                    <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['confirmPassword_error'] ?></span>
                                    <?php unset($_SESSION['errors']['confirmPassword_error']) ?>
                                 <?php endif;?>

                              </div>

                           </div>

                           <div class="d-flex justify-content-center justify-content-md-end">

                              <button type="submit" class="btn btn-sm btn-primary btn-admin" name="saveType" value="changePassword">
                                 <i class="fas fa-save"></i> Save Changes
                              </button>   

                           </div>

                        </form>

                  </div>
               </div>
            </div>
            <a href="<?= ROOT ?>admin" class="btn btn-sm btn-dark mb-3 ml-3" title="Go Back">
                <i class="fas fa-arrow-left fa-lg"></i> Go Back
            </a>
      </div>
     
   </div>

<?php  $content = ob_get_clean()?>