<?php $title ='Edit Employee' ?>
<?php ob_start() ?>
<div class="card o-hidden border-0 shadow-lg mb-4  text-dark">
         <div class="card-body p-0">
               <div class="row">
                  <div class="col"> 
                     <div class="p-5">
                           <div class="text-center text-primary">
                              <div class="icon"><i class="fas fa-user fa-3x mb-2"></i></div>
                              <h3 class="mb-5"><b>Edit Employee</b></h3>
                           </div>
                           <div class="d-flex justify-content-center justify-content-md-end mb-5">
                              <div class="remove-avatar text-center">
                                 <a href="<?= ROOT.'employee/show/'.$employee->id?>" class="text-decoration-none text-secondary" title='Go To Show Details'><h4><?= Employee::getFullName($employee->firstName, $employee->lastName) ?></h4></a>
                                 <p class="text-muted">Employee</p>
                                 <a href="<?= ROOT.'employee/show/'.$employee->id?>" title='Go To Show Details'><img src="<?= !empty($employee->avatar) ? ROOT."app/uploads/Employees/avatars/$employee->avatar" : ROOT."app/uploads/Employees/avatars/default-Employee-avatar.png"?>" alt="Employee Avatar" class="square-image img-thumbnail"> </a>
                                    <?php if(!empty($employee->avatar)) :?>
                                       <form action="<?= ROOT ?>employee/removeAvatar" method="POST">
                                          <input type="hidden" name="id" value="<?= $employee->id ?>">
                                          <input type="hidden" name="avatar" value="<?= $employee->avatar ?>">
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

                           <form action="<?= ROOT ?>employee/update" class="Employee" method="POST" enctype="multipart/form-data">

                              <input type="hidden" name="id" value="<?= $employee->id ?>">
    
                              <div class="form-group row">

                                 <div class="col-md-6 mb-3">

                                    <label for="cin">CIN</label>
                                    <input type="text" class="form-control" name="cin" id="cin" value="<?php if(isset($_SESSION['oldData']['cin'])) { echo $_SESSION['oldData']['cin'] ; unset($_SESSION['oldData']['cin']); }else { echo $employee->cin; }  ?>"  placeholder="Enter CIN" >
                                    <input type="hidden" name="oldCIN" value="<?= $employee->cin ?>">

                                    <?php if(isset($_SESSION['errors']['cin_error'])): ?>
                                       <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['cin_error'] ?></span>
                                       <?php unset($_SESSION['errors']['cin_error']) ?>
                                    <?php endif;?>

                                 </div>

                                 <div class="col-md-6 mb-3">

                                       <label for="firstName">First Name</label>
                                       <input type="text" class="form-control" name="firstName" value="<?php if(isset($_SESSION['oldData']['firstName'])) { echo $_SESSION['oldData']['firstName'] ; unset($_SESSION['oldData']['firstName']); }else { echo $employee->firstName; }  ?>" id="firstName" placeholder="Enter First Name" >

                                       <?php if(isset($_SESSION['errors']['firstName_error'])): ?>
                                          <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['firstName_error'] ?></span>
                                          <?php unset($_SESSION['errors']['firstName_error']) ?>
                                       <?php endif;?>

                                 </div>

                                 <div class="col-md-6 mb-3">

                                    <label for="lastName">Last Name</label>
                                    <input type="text" class="form-control" value="<?php if(isset($_SESSION['oldData']['lastName'])) { echo $_SESSION['oldData']['lastName'] ; unset($_SESSION['oldData']['lastName']); }else { echo $employee->lastName; } ?>" name="lastName" id="lastName" placeholder="Enter Last Name" >

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
                                          value="<?php if(isset($_SESSION['oldData']['dateOfBirth'])) { echo $_SESSION['oldData']['dateOfBirth'] ; unset($_SESSION['oldData']['dateOfBirth']); }else { echo $employee->dateOfBirth; } ?>" 
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
                                          <option value="Male" <?php if($employee->gender == 'Male') echo 'selected'; ?> >Male</option>
                                          <option value="Female" <?php if($employee->gender == 'Female') echo 'selected'; ?> >Female</option>
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
                                             <option value="<?= $number ?>" <?php if($number == $employee->maritalStatus ) echo 'selected'; ?> ><?= $marStatus ?></option>
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
                                             <option value="<?= $country ?>" <?php if(strtolower($country) == strtolower($employee->country) ) echo 'selected'; ?> ><?= $country ?></option>
                                          <?php endforeach;?>
                                    </select>
                                    <?php if(isset($_SESSION['errors']['country_error'])): ?>
                                       <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['country_error'] ?></span>
                                       <?php unset($_SESSION['errors']['country_error']) ?>
                                    <?php endif;?>
                                 </div>

                                 <div class="col-md-6 mb-3">

                                    <label for="phone">Phone Number</label>
                                    <input type="tel" class="form-control" name="phone" id="phone" value="<?php if(isset($_SESSION['oldData']['phone'])) { echo $_SESSION['oldData']['phone'] ; unset($_SESSION['oldData']['phone']); }else { echo $employee->phone; } ?>" placeholder="Enter Phone Number" >

                                    <?php if(isset($_SESSION['errors']['phone_error'])): ?>
                                       <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['phone_error'] ?></span>
                                       <?php unset($_SESSION['errors']['phone_error']) ?>
                                    <?php endif;?>

                                 </div>

                                 <div class="col-md-6 mb-3">

                                    <label for="email">Email Address</label>
                                    <input type="text" class="form-control" name="email" id="email" value="<?php if(isset($_SESSION['oldData']['email'])) { echo $_SESSION['oldData']['email'] ; unset($_SESSION['oldData']['email']); }else { echo $employee->email; } ?>" placeholder="Enter Email Address" >
                                    <input type="hidden" name="oldEmail" value="<?= $employee->email ?>">

                                    <?php if(isset($_SESSION['errors']['email_error'])): ?>
                                       <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['email_error'] ?></span>
                                       <?php unset($_SESSION['errors']['email_error']) ?>
                                    <?php endif;?>

                                 </div>

                                 <div class="col-md-6 mb-3">
                                    <label for="departement">Departement</label>
                                    <select class="form-control" name="departementId" id="departement" >
                                          <?php foreach($departements as $departement) :?>
                                             <option value="<?= $departement->id ?>" <?php if($departement->id == $employee->departementId ) echo 'selected'; ?>  ><?= $departement->name ?></option>
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
                                          value="<?php if(isset($_SESSION['oldData']['dateOfJoining'])) { echo $_SESSION['oldData']['dateOfJoining'] ; unset($_SESSION['oldData']['dateOfJoining']); }else { echo $employee->dateOfJoining; } ?>" 
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
                                             <option value="<?= $number ?>" <?php if( $number == $employee->jobType ) echo 'selected'; ?>  ><?= $jobType ?></option>
                                          <?php endforeach;?>
                                    </select>
                                    <?php if(isset($_SESSION['errors']['jobType_error'])): ?>
                                       <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['jobType_error'] ?></span>
                                       <?php unset($_SESSION['errors']['jobType_error']) ?>
                                    <?php endif;?>
                                 </div>       

                                 
                                 <div class="col-md-6 mb-3">

                                    <label for="workingHours">Working Hours</label>
                                    <input type="number" class="form-control" name="workingHours" id="workingHours" min="1" max="24" value="<?php if(isset($_SESSION['oldData']['workingHours'])) { echo $_SESSION['oldData']['workingHours'] ; unset($_SESSION['oldData']['workingHours']); }else { echo $employee->workingHours ; } ?>" placeholder="Enter Working Hours" >
                                    <?php if(isset($_SESSION['errors']['workingHours_error'])): ?>
                                       <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['workingHours_error'] ?></span>
                                       <?php unset($_SESSION['errors']['workingHours_error']) ?>
                                    <?php endif;?>

                                 </div>

                                 <div class="col-md-6 mb-3">
                                    <label for="salary">Salary</label>
                                    <input type="text" class="form-control" name="salary" id="salary" value="<?php if(isset($_SESSION['oldData']['salary'])) { echo $_SESSION['oldData']['salary'] ; unset($_SESSION['oldData']['salary']); }else { echo $employee->salary ; }  ?>" placeholder="Enter Salary" >
                                    
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
                                    <textarea class="form-control" id="exampleTextarea" rows="3" name="address" placeholder="Enter Address"><?php if(isset($_SESSION['oldData']['address'])) { echo $_SESSION['oldData']['address'] ; unset($_SESSION['oldData']['address']); }else { echo $employee->address ; }  ?></textarea>
                                    <?php if(isset($_SESSION['errors']['address_error'])): ?>
                                       <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['address_error'] ?></span>
                                       <?php unset($_SESSION['errors']['address_error']) ?>
                                    <?php endif;?>
                                 </div>
                                 
                              </div>  

                              <div class="d-flex justify-content-end">
                                 <a class="btn btn-sm btn-danger mr-2" href="<?= ROOT ?>Employee"><i class="fas fa-times-circle"></i> Cancel</a>
                                 <button type="submit" class="btn btn-sm btn-primary btn-Employee" name="saveType" value="edit">
                                    <i class="fas fa-save"></i> Save Changes
                                 </button>   
                              </div>

                           </form>

                     </div>
                  </div>
               </div>
         </div>
      </div>

<?php  $content = ob_get_clean()?>