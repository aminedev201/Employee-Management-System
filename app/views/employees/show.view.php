<?php $title ='Show employee Details' ?>
<?php ob_start() ?>

    <?php if(isset($_SESSION['message'])): ?>
      <div id="Message" class="alert alert-<?php echo  $_SESSION['status'] == 400 ?  'danger' : 'success' ?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message'] ?>
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
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0"><i class="fas fa-user-cog"></i> Employee Details</h4>
        </div>
        <div class="card-body">
            <div class="profile-header">
                <?php if(!empty($employee->avatar)): ?>
                    <a href="<?= ROOT .'employee/downloadAvatar/'.$employee->id.'/'.$employee->avatar ?>" class="text-decoration-none " title ="Download This Avatar">                
                        <img src="<?=  ROOT."app/uploads/employees/avatars/$employee->avatar" ?>" alt="Employee Avatar" class="profile-avatar">
                    </a>
                <?php else: ?>
                    <img src="<?= ROOT."app/uploads/employees/avatars/default-employee-avatar.png" ?>" alt="Employee Avatar" class="profile-avatar">
                <?php endif; ?>
                <h2><?= Employee::getFullName($employee->firstName, $employee->lastName) ?></h2>
                <p class="text-muted">Employee</p>
            </div>
            <table class="table table-bordered">
                <div class="edit my-2 text-right">
                    <a href="<?= ROOT.'employee/edit/'.$employee->id?>" class="btn btn-sm btn-secondary mx-2"><i class="fas fa-edit" ></i> Edit employee Informations</a>
                </div>

                <tbody>
                    <tr>
                        <th scope="row"><i class="fas fa-id-card"></i> ID</th>
                        <td><?= $employee->id ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fas fa-passport"></i> CIN</th>
                        <td><?= $employee->cin ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fas fa-user"></i> Full Name</th>
                        <td><?= Employee::getFullName($employee->firstName, $employee->lastName) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fas fa-venus-mars"></i> Gender</th>
                        <td class="test"><?= $employee->gender ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fas fa-globe"></i> Country</th>
                        <td><?= $employee->country ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fas fa-birthday-cake"></i> Date Of Birth</th>
                        <td><?= $employee->dateOfBirth ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fas fa-hourglass-half"></i> Age</th>
                        <td><?= employee::getAge($employee->dateOfBirth) ?> Years Old</td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fas fa-envelope"></i> Email</th>
                        <td><?= $employee->email ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fas fa-briefcase"></i> Department Name</th>
                        <td><a href="<?= ROOT .'departement/show/'.$employee->departementId ?>" class="text-decoration-none text-secondary"><?= $departementName ?></a></td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fas fa-dollar-sign"></i> Salary</th>
                        <td>$<?= $employee->salary; ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fas fa-clock"></i> Working Hours</th>
                        <td><?= $employee->workingHours; ?> H</td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fas fa-ring"></i> Marital Status</th>
                        <td><?= Glb::getMaritalStatusByNumber($employee->maritalStatus); ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fas fa-user-tag"></i> Job Type</th>
                        <td><?= Glb::getJobTypeByNumber($employee->jobType) ; ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fas fa-calendar-check"></i> Date of Joining</th>
                        <td><?= $employee->dateOfJoining; ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fas fa-map-marker-alt"></i> Address</th>
                        <td><?= $employee->address; ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fas fa-calendar"></i> Start Date</th>
                        <td><?= $employee->created_date_time ?></td>
                    </tr>

                    <tr>
                        <th scope="row"><i class="fas fa-edit"></i> Last Update Info</th>
                        <td><?= $employee->updated_date_time ?></td>
                    </tr>

    
                </tbody>
            </table>
            <a href="<?= ROOT ?>employee" class="btn btn-sm btn-dark" title="Go Back">
                <i class="fas fa-arrow-left fa-lg"></i> Go Back
            </a>
        </div>
    </div>

<?php  $content = ob_get_clean()?>