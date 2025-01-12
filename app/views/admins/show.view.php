<?php $title ='Show Admin Details' ?>
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
            <h4 class="mb-0"><i class="fas fa-user-cog"></i> Admin Details</h4>
        </div>
        <div class="card-body">
            <div class="profile-header">
                <?php if(!empty($admin->avatar)): ?>
                    <a href="<?= ROOT .'admin/downloadAvatar/'.$admin->id.'/'.$admin->avatar ?>" class="text-decoration-none " title ="Download This Avatar">                
                        <img src="<?=  ROOT."app/uploads/admins/avatars/$admin->avatar" ?>" alt="Admin Avatar" class="profile-avatar">
                    </a>
                <?php else: ?>
                    <img src="<?= ROOT."app/uploads/admins/avatars/default-admin-avatar.png" ?>" alt="Admin Avatar" class="profile-avatar">
                <?php endif; ?>
                <h2><?= Admin::getFullName($admin->firstName, $admin->lastName) ?></h2>
                <p class="text-muted">Administrator</p>
            </div>
            <table class="table table-bordered">
                <div class="edit my-2 text-right">
                    <a href="<?= ROOT.'admin/edit/'.$admin->id?>" class="btn btn-sm btn-secondary mx-2"><i class="fas fa-edit" ></i> Edit Admin Informations</a>
                </div>

                <tbody>
                    <tr>
                        <th scope="row"><i class="fas fa-id-card"></i> ID</th>
                        <td><?= $admin->id ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fas fa-passport"></i> CIN</th>
                        <td><?= $admin->cin ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fas fa-user"></i> Full Name</th>
                        <td><?= Admin::getFullName($admin->firstName, $admin->lastName) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fas fa-venus-mars"></i> Gender</th>
                        <td class="test"><?= $admin->gender ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fas fa-globe"></i> Country</th>
                        <td><?= $admin->country ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fas fa-birthday-cake"></i> Date Of Birth</th>
                        <td><?= $admin->dateOfBirth ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fas fa-hourglass-half"></i> Age</th>
                        <td><?= Admin::getAge($admin->dateOfBirth) ?> Years Old</td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fas fa-envelope"></i> Email</th>
                        <td><?= $admin->email ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fas fa-calendar"></i> Start Date</th>
                        <td><?= $admin->created_date_time ?></td>
                    </tr>

                    <tr>
                        <th scope="row"><i class="fas fa-edit"></i> Last Update Info</th>
                        <td><?= $admin->updated_date_time ?></td>
                    </tr>

                    <?php if(!empty($admin->lastLogin)): ?>
                        <tr>
                            <th scope="row"><i class="fas fa-sign-in-alt"></i> Last Login</th>
                            <td><?= $admin->lastLogin ?></td>
                        </tr>
                    <?php endif; ?>

                    <?php if(!empty($admin->lastLogout)): ?>
                        <tr>
                            <th scope="row"><i class="fas fa-sign-out-alt"></i> Last Logout</th>
                            <td><?= $admin->lastLogout ?></td>
                        </tr>
                    <?php endif; ?>

                </tbody>
            </table>

            <?php if($curAdmin->id == $admin->id) :?>
               <div class="delete-my-account mb-3 text-right">
                    <a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteMyAccount" >
                        <i class="fas fa-trash"></i> Delete My Account
                    </a>
                    
                    <div class="modal fade" id="deleteMyAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Confirm Account Deletion</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form action="<?= ROOT ?>admin/deleteMyAccount" method="post">

                                    <div class="modal-body text-left">
                                        <label for="password">Enter your password for Delete your account</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" >
                                        <input type="hidden" name="oldPassword" value="<?= $curAdmin->password ?>">
                                        <input type="hidden" name="id" value="<?= $curAdmin->id ?>">             
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <button class="btn btn-sm btn-danger" type="submit" name="saveType" value="deleteMyAccount">Confirm Deletion</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
               </div>
            <?php endif;?>



            <a href="<?= ROOT ?>admin" class="btn btn-sm btn-dark" title="Go Back">
                <i class="fas fa-arrow-left fa-lg"></i> Go Back
            </a>

        </div>
    </div>

<?php  $content = ob_get_clean()?>