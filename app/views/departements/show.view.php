<?php $title ='Show Departement Details' ?>
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
            <h4 class="mb-0"><i class="fas fa-file-alt"></i> Departement Details</h4>
        </div>
        <div class="card-body">
            <div class="profile-header">
                <h2><?= $departement->name ?></h2>
                <p class="text-muted">Departement</p>
            </div>
            <table class="table table-bordered">
                <div class="edit my-2 text-right">
                    <a href="<?= ROOT.'departement/edit/'.$departement->id?>" class="btn btn-sm btn-secondary mx-2"><i class="fas fa-edit" ></i> Edit Departement Informations</a>
                </div>

                <tbody>
                    <tr>
                        <th scope="row"><i class="fas fa-id-card"></i> ID</th>
                        <td><?= $departement->id ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fas fa-sitemap"></i> Departement Name</th>
                        <td><?= $departement->name ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fas fa-file-alt"></i> Description</th>
                        <td><?= !empty($departement->description) ? $departement->description : 'No Description'  ?></td>
                    </tr>
                
                    <tr>
                        <th scope="row"><i class="fas fa-calendar"></i> Start Date</th>
                        <td><?= $departement->created_date_time ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><i class="fas fa-edit"></i> Last Update Info</th>
                        <td><?= $departement->updated_date_time ?></td>
                    </tr>

                </tbody>
            </table>
            <a href="<?= ROOT ?>departement" class="btn btn-sm btn-dark" title="Go Back">
                <i class="fas fa-arrow-left fa-lg"></i> Go Back
            </a>
        </div>
    </div>

<?php  $content = ob_get_clean()?>