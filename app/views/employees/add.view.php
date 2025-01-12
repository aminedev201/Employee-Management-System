<?php $title ='Add New Employe' ?>
<?php ob_start() ?>
<div class="card o-hidden border-0 shadow-lg mb-4  text-dark">
         <div class="card-body p-0">
               <div class="row">
                  <div class="col"> 
                     <div class="p-5">
                           <div class="text-center text-primary">
                              <div class="icon"><i class="fas fa-user fa-3x mb-2"></i></div>
                              <h3 class="mb-5"><b>Add New Employe</b></h3>
                              </div>

                           <form action="<?= ROOT ?>employee/store" class="employe" method="POST" enctype="multipart/form-data">
                                                            
                              <div class="form-group row">

                                 <div class="col-md-6 mb-3">

                                    <label for="cin">CIN</label>
                                    <input type="text" class="form-control" name="cin" id="cin" value="<?php if(isset($_SESSION['oldData']['cin'])) { echo $_SESSION['oldData']['cin'] ; unset($_SESSION['oldData']['cin']); } ?>"  placeholder="Enter CIN" >

                                    <?php if(isset($_SESSION['errors']['cin_error'])): ?>
                                       <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['cin_error'] ?></span>
                                       <?php unset($_SESSION['errors']['cin_error']) ?>
                                    <?php endif;?>

                                 </div>

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
                                    <label for="maritalStatus">Marital Status</label>
                                    <select class="form-control" name="maritalStatus" id="maritalStatus" >
                                          <?php foreach($maritalStatus as $number => $marStatus) :?>
                                             <option value="<?= $number ?>" <?php if(isset($_SESSION['oldData']['maritalStatus']) && $_SESSION['oldData']['maritalStatus'] == $number ){ echo 'selected'; unset($_SESSION['oldData']['maritalStatus'])  ;}?>  ><?= $marStatus ?></option>
                                          <?php endforeach;?>
                                    </select>
                                    <?php if(isset($_SESSION['errors']['maritalStatus_error'])): ?>
                                       <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['maritalStatus_error'] ?></span>
                                       <?php unset($_SESSION['errors']['maritalStatus_error']) ?>
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
                                    <label for="departement">Departement</label>
                                    <select class="form-control" name="departementId" id="departement" >
                                          <?php foreach($departements as $departement) :?>
                                             <option value="<?= $departement->id ?>" <?php if(isset($_SESSION['oldData']['departementId']) && $_SESSION['oldData']['departementId'] == $departement->id ){ echo 'selected'; unset($_SESSION['oldData']['departementId'])  ;} ?>  ><?= $departement->name ?></option>
                                          <?php endforeach;?>
                                    </select>
                                    <?php if(isset($_SESSION['errors']['departement_error'])): ?>
                                       <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['departement_error'] ?></span>
                                       <?php unset($_SESSION['errors']['departement_error']) ?>
                                    <?php endif;?>
                                 </div>

                                 <div class="col-md-6 mb-3">
                                    <label for="dateOfJoining">Date Of Joining</label>
                                    <input type="datetime-local" 
                                          class="form-control" 
                                          name="dateOfJoining" 
                                          id="dateOfJoining"  
                                          value="<?php if(isset($_SESSION['oldData']['dateOfJoining'])) { echo $_SESSION['oldData']['dateOfJoining'] ; unset($_SESSION['oldData']['dateOfJoining']); } ?>" 
                                          placeholder="Birth Of Date" >

                                    <?php if(isset($_SESSION['errors']['dateOfJoining_error'])): ?>
                                       <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['dateOfJoining_error'] ?></span>
                                       <?php unset($_SESSION['errors']['dateOfJoining_error']) ?>
                                    <?php endif;?>
                                 </div>

                                 <div class="col-md-6 mb-3">
                                    <label for="jobType">Job Type</label>
                                    <select class="form-control" name="jobType" id="jobType" >
                                    <?php foreach($jobTypes as $number => $jobType) :?>
                                             <option value="<?= $number ?>" <?php if(isset($_SESSION['oldData']['jobType']) && $_SESSION['oldData']['jobType'] == $number ){ echo 'selected'; unset($_SESSION['oldData']['jobType'])  ;} ?>  ><?= $jobType ?></option>
                                          <?php endforeach;?>
                                    </select>
                                    <?php if(isset($_SESSION['errors']['jobType_error'])): ?>
                                       <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['jobType_error'] ?></span>
                                       <?php unset($_SESSION['errors']['jobType_error']) ?>
                                    <?php endif;?>
                                 </div>       

                                 
                                 <div class="col-md-6 mb-3">

                                    <label for="workingHours">Working Hours</label>
                                    <input type="number" class="form-control" name="workingHours" id="workingHours" min="1" max="24" value="<?php if(isset($_SESSION['oldData']['workingHours'])) { echo $_SESSION['oldData']['workingHours'] ; unset($_SESSION['oldData']['workingHours']); } ?>" placeholder="Enter Working Hours" >
                                    
                                    <?php if(isset($_SESSION['errors']['workingHours_error'])): ?>
                                       <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['workingHours_error'] ?></span>
                                       <?php unset($_SESSION['errors']['workingHours_error']) ?>
                                    <?php endif;?>

                                 </div>

                                 <div class="col-md-6 mb-3">
                                    <label for="salary">Salary</label>
                                    <input type="text" class="form-control" name="salary" id="salary" value="<?php if(isset($_SESSION['oldData']['salary'])) { echo $_SESSION['oldData']['salary'] ; unset($_SESSION['oldData']['salary']); } ?>" placeholder="Enter Salary" >
                                    
                                    <?php if(isset($_SESSION['errors']['salary_error'])): ?>
                                       <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['salary_error'] ?></span>
                                       <?php unset($_SESSION['errors']['salary_error']) ?>
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
                                 
                                 <div class="col-12 mb-3">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" id="exampleTextarea" rows="3" name="address" placeholder="Enter Address"><?php if(isset($_SESSION['oldData']['address'])) { echo $_SESSION['oldData']['address'] ; unset($_SESSION['oldData']['address']); } ?></textarea>
                                    <?php if(isset($_SESSION['errors']['address_error'])): ?>
                                       <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['address_error'] ?></span>
                                       <?php unset($_SESSION['errors']['address_error']) ?>
                                    <?php endif;?>
                                 </div>
                                 
                              </div>  

                              <div class="d-flex justify-content-end">
                                 <a class="btn btn-sm btn-danger mr-2" href="<?= ROOT ?>employee"><i class="fas fa-times-circle"></i> Cancel</a>
                                 <button type="submit" class="btn btn-sm btn-primary btn-Employe" name="saveType" value="add">
                                    <i class="fas fa-save"></i> Add Employee
                                 </button>   
                              </div>



                           </form>
                     </div>
                  </div>
               </div>
         </div>
      </div>

<?php  $content = ob_get_clean()?>