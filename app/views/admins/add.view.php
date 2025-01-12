<?php $title ='Add New Admin' ?>
<?php ob_start() ?>
<div class="card o-hidden border-0 shadow-lg mb-4  text-dark">
         <div class="card-body p-0">
               <div class="row">
                  <div class="col"> 
                     <div class="p-5">
                           <div class="text-center text-primary">
                              <div class="icon"><i class="fa fa-user-shield fa-3x mb-2"></i></div>
                              <h3 class="mb-5"><b>Add New Admin</b></h3>
                              </div>
                           <form action="<?= ROOT ?>admin/store" class="admin" method="POST" enctype="multipart/form-data">
                                                            
                              <div class="form-group row">

                                 <div class="col-md-6 mb-3">

                                      <label for="firstName">First Name</label>
                                       <input type="text" class="form-control" name="firstName" value="<?php if(isset($_SESSION['oldData']['firstName'])) { echo $_SESSION['oldData']['firstName'] ; unset($_SESSION['oldData']['firstName']); } ?>" id="firstName" placeholder="Enter First Name" >

                                       <?php if(isset($_SESSION['errors']['firstName_error'])): ?>
                                          <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['firstName_error'] ?></span>
                                          <?php unset($_SESSION['errors']['firstName_error']) ?>
                                       <?php endif;?>

                                 </div>

                                 <div class="col-md-6 mb-3">
                                 
                                    <label for="lastName">Last Name</label>
                                    <input type="text" class="form-control" value="<?php if(isset($_SESSION['oldData']['lastName'])) { echo $_SESSION['oldData']['lastName'] ; unset($_SESSION['oldData']['lastName']); } ?>" name="lastName" id="lastName" placeholder="Enter Last Name" >

                                    <?php if(isset($_SESSION['errors']['lastName_error'])): ?>
                                       <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['lastName_error'] ?></span>
                                       <?php unset($_SESSION['errors']['lastName_error']) ?>
                                    <?php endif;?>

                                 </div>

                                 <div class="col-md-6 mb-3">

                                    <label for="gender">Gender</label>

                                    <select class="form-control" name="gender" id="gender" >
                                          <option value="Male" <?php if(isset($_SESSION['oldData']['gender']) && $_SESSION['oldData']['gender'] == "Male" ){ echo 'selected'; unset($_SESSION['oldData']['gender'])  ;} ?> >Male</option>
                                          <option value="Female" <?php if(isset($_SESSION['oldData']['gender']) && $_SESSION['oldData']['gender'] == "Female" ){ echo 'selected'; unset($_SESSION['oldData']['gender'])  ;} ?> >Female</option>
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
                                          <option value="<?= $country ?>" <?php if(isset($_SESSION['oldData']['country']) && $_SESSION['oldData']['country'] == $country ){ echo 'selected'; unset($_SESSION['oldData']['country'])  ;}else if($country == 'Morocco') echo 'selected'; ?>  ><?= $country ?></option>
                                       <?php endforeach;?>

                                 </select>

                                 <?php if(isset($_SESSION['errors']['country_error'])): ?>
                                    <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['country_error'] ?></span>
                                    <?php unset($_SESSION['errors']['country_error']) ?>
                                 <?php endif;?>

                                 </div>

                                 <div class="col-md-6 mb-3">

                                    <label for="phone">Phone Number</label>
                                    <input type="tel" class="form-control" name="phone" id="phone" value="<?php if(isset($_SESSION['oldData']['phone'])) { echo $_SESSION['oldData']['phone'] ; unset($_SESSION['oldData']['phone']); } ?>" placeholder="Enter Phone Number" >

                                    <?php if(isset($_SESSION['errors']['phone_error'])): ?>
                                       <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['phone_error'] ?></span>
                                       <?php unset($_SESSION['errors']['phone_error']) ?>
                                    <?php endif;?>

                                 </div>

                                 <div class="col-md-6 mb-3">

                                    <label for="email">Email Address</label>
                                    <input type="text" class="form-control" name="email" id="email" value="<?php if(isset($_SESSION['oldData']['email'])) { echo $_SESSION['oldData']['email'] ; unset($_SESSION['oldData']['email']); } ?>" placeholder="Enter Email Address" >

                                    <?php if(isset($_SESSION['errors']['email_error'])): ?>
                                       <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['email_error'] ?></span>
                                       <?php unset($_SESSION['errors']['email_error']) ?>
                                    <?php endif;?>

                                 </div>

                                 <div class="col-md-6 mb-3">

                                    <label for="password">Passowrd</label>
                                    <input type="password" class="form-control" name="password" id="password" value="<?php if(isset($_SESSION['oldData']['password'])) { echo $_SESSION['oldData']['password'] ; unset($_SESSION['oldData']['password']); } ?>" placeholder="Enter Password" >
                                    
                                    <?php if(isset($_SESSION['errors']['password_error'])): ?>
                                       <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['password_error'] ?></span>
                                       <?php unset($_SESSION['errors']['password_error']) ?>
                                    <?php endif;?>

                                 </div>

                                 <div class="col-md-6 mb-3">

                                    <label for="confirmPassword">Confirm Passowrd</label>
                                    <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" value="<?php if(isset($_SESSION['oldData']['confirmPassword'])) { echo $_SESSION['oldData']['confirmPassword'] ; unset($_SESSION['oldData']['confirmPassword']); } ?>" placeholder="Confirm Password" >
                                       
                                    <?php if(isset($_SESSION['errors']['confirmPassword_error'])): ?>
                                       <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['confirmPassword_error'] ?></span>
                                       <?php unset($_SESSION['errors']['confirmPassword_error']) ?>
                                    <?php endif;?>

                                 </div>

                                 <div class="col-md-6 mb-3">

                                    <label for="cin">CIN</label>
                                    <input type="text" class="form-control" name="cin" id="cin" value="<?php if(isset($_SESSION['oldData']['cin'])) { echo $_SESSION['oldData']['cin'] ; unset($_SESSION['oldData']['cin']); } ?>"  placeholder="Enter CIN" >

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
                                          value="<?php if(isset($_SESSION['oldData']['dateOfBirth'])) { echo $_SESSION['oldData']['dateOfBirth'] ; unset($_SESSION['oldData']['dateOfBirth']); } ?>" 
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

                              <div class="d-flex justify-content-end">
                                    
                                 <a class="btn btn-sm btn-danger mr-2" href="<?= ROOT ?>admin"><i class="fas fa-times-circle"></i> Cancel</a>

                                 <button type="submit" class="btn btn-sm btn-primary btn-admin" name="saveType" value="add">
                                    <i class="fas fa-save"></i> Add Admin
                                 </button>   

                              </div>



                           </form>
                     </div>
                  </div>
               </div>
         </div>
      </div>

<?php  $content = ob_get_clean()?>