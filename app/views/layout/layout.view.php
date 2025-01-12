<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?= ROOT_ASSEST ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"rel="stylesheet">
    <link href="<?= ROOT_ASSEST ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= ROOT_ASSEST ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="<?= ROOT_ASSEST ?>css/main.css" rel="stylesheet">
    <title><?= $title ?></title>

</head>
<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= ROOT ?>home">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fa fa-users"></i>
                </div>
                <div class="sidebar-brand-text mx-3"><sup>EMPS MS</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?= ROOT ?>home">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                MANAGEMENTS
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdmins"
                    aria-expanded="true" aria-controls="collapseAdmins">
                    <i class="fas fa-users-cog"></i>
                    <span>Admins</span>
                </a>
                <div id="collapseAdmins" class="collapse" aria-labelledby="headingAdmins" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?= ROOT ?>admin/add">Add New Admin</a>
                        <a class="collapse-item" href="<?= ROOT ?>admin">Manage Admins</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDepartements"
                    aria-expanded="true" aria-controls="collapseDepartements">
                    <i class="fas fa-sitemap"></i>
                    <span>Departements</span>
                </a>
                <div id="collapseDepartements" class="collapse" aria-labelledby="headingDepartements" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?= ROOT ?>departement/add">Add New Departement</a>
                        <a class="collapse-item" href="<?= ROOT ?>departement">Manage Departements</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmployees"
                    aria-expanded="true" aria-controls="collapseEmployees">
                    <i class="fas fa-users"></i>                    
                    <span>Employees</span>
                </a>
                <div id="collapseEmployees" class="collapse" aria-labelledby="headingemployeees" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?= ROOT ?>employee/add">Add New employee</a>
                        <a class="collapse-item" href="<?= ROOT ?>employee">Manage Employees</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= ROOT ."payments"?>">
                    <i class="fas fa-credit-card"></i>
                    <span>Payments</span>
                </a>
            
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="<?= ROOT ?>configurations">
                    <i class="fas fa-cog icon"></i>
                    <span>Configurations</span>
                </a>
            
            </li>

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <button id="sidebarToggleTop" class="btn text-dark d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

            
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= Admin::getFullName($curAdmin->firstName,$curAdmin->lastName); ?></span>
                                <img src="<?= !empty($curAdmin->avatar) ? ROOT."app/uploads/admins/avatars/$curAdmin->avatar" : ROOT."app/uploads/admins/avatars/default-admin-avatar.png"?>" alt="Current Admin Avatar" class="img-profile rounded-circle">

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= ROOT .'admin/show/'.$curAdmin->id ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="<?= ROOT .'admin/edit/'.$curAdmin->id ?>">
                                    <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Edit my informations
                                </a>
                                <a class="dropdown-item" href="<?= ROOT .'admin/edit/'.$curAdmin->id.'#change-password' ?>">
                                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Change my password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>

                <div class="container-fluid">

                     <?= $content ?>
                          
                </div>

            </div>

    
        </div>

    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Logout</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to logout ?</div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-sm btn-danger" href="<?= ROOT.'admin/logout'?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= ROOT_ASSEST ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= ROOT_ASSEST ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= ROOT_ASSEST ?>vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?= ROOT_ASSEST ?>js/sb-admin-2.min.js"></script>
    <script src="<?= ROOT_ASSEST ?>vendor/chart.js/Chart.min.js"></script>
    <script src="<?= ROOT_ASSEST ?>js/demo/chart-area-demo.js"></script>
    <script src="<?= ROOT_ASSEST ?>js/demo/chart-pie-demo.js"></script>
    <script src="<?= ROOT_ASSEST ?>vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= ROOT_ASSEST ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?= ROOT_ASSEST ?>js/demo/datatables-demo.js"></script>
    <script src="<?= ROOT_ASSEST ?>js/main.js"></script>

</body>

</html>