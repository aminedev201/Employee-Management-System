<?php $title ='Home' ?>
<?php ob_start() ?>

      <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      </div>

      <div class="row">

         <div class="col-xl-3 col-md-6 mb-4">
               <a href="<?= ROOT .'admin' ?>" class="text-decoration-none text-secondary">
               <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                     <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                 Admins</div>
                              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $admins_count ?></div>
                           </div>
                           <div class="col-auto">
                              <i class="fas fa-users-cog fa-3x text-gray-300"></i>
                           </div>
                     </div>
                  </div>
               </div>
               </a>
         </div>
         
         <div class="col-xl-3 col-md-6 mb-4">
               <a href="<?= ROOT .'departement' ?>" class="text-decoration-none text-secondary">
               <div class="card border-left-info shadow h-100 py-2">
                  <div class="card-body">
                     <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                 Departements</div>
                              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $departements_count ?></div>
                           </div>
                           <div class="col-auto">
                              <i class="fas fa-sitemap fa-3x text-gray-300"></i>
                           </div>
                     </div>
                  </div>
               </div>
               </a>
         </div>

         <div class="col-xl-3 col-md-6 mb-4">
               <a href="<?= ROOT .'employee' ?>" class="text-decoration-none text-secondary">
               <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                     <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                 Employees</div>
                              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $employees_count ?></div>
                           </div>
                           <div class="col-auto">
                              <i class="fas fa-users fa-3x text-gray-300"></i>
                           </div>
                     </div>
                  </div>
               </div>
               </a>
         </div>

         <div class="col-xl-3 col-md-6 mb-4">
               <a href="<?= ROOT .'payments' ?>" class="text-decoration-none text-secondary">
               <div class="card border-left-warning shadow h-100 py-2">
                  <div class="card-body">
                     <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Payments</div>
                              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $payments_count ?></div>
                           </div>
                           <div class="col-auto">
                              <i class="fas fa-credit-card fa-3x text-gray-300"></i>
                           </div>
                     </div>
                  </div>
               </div>
               </a>
         </div>


      </div>

<?php  $content = ob_get_clean()?>