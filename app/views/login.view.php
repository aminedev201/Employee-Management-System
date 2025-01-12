<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= ROOT_ASSEST ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"rel="stylesheet">
    <link href="<?= ROOT_ASSEST ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= ROOT_ASSEST ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= ROOT_ASSEST ?>css/login.css" rel="stylesheet">
    <title>Admin Login</title>
</head>
<body class="bg-gradient-dark">

    <div class="container">
    
        <div class="card text-white shadow-lg p-4 login-admin bg-gradient-dark">

            <?php if(isset($_SESSION['message']) && !isset($_SESSION['errors']['email_error']) && !isset($_SESSION['errors']['password_error']) ): ?>
                <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert">
                    <div><i class="fas fa-exclamation-triangle me-2"></i><?= $_SESSION['message'] ?><?php unset($_SESSION['message']) ?></div>
                </div>
            <?php endif;?>

            <h3 class="text-center mb-4">Welcome Back</h3>
            <form action="<?= ROOT ?>admin/authenticateAdmin" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="text" class="form-control" name="email" id="email" value="<?php if(isset($_SESSION['oldData']['email'])) { echo $_SESSION['oldData']['email'] ; unset($_SESSION['oldData']['email']); } ?>" autocomplete="off">
                    <?php if(isset($_SESSION['errors']['email_error'])): ?>
                        <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['email_error'] ?></span>
                        <?php unset($_SESSION['errors']['email_error']) ?>
                    <?php endif;?>

                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" value="<?php if(isset($_SESSION['oldData']['password'])) { echo $_SESSION['oldData']['password'] ; unset($_SESSION['oldData']['password']); } ?>" autocomplete="new-password">
                    <?php if(isset($_SESSION['errors']['password_error'])): ?>
                        <span class="msg-error text-danger mt-1"><i class="fas fa-exclamation-circle"></i> <?= $_SESSION['errors']['password_error'] ?></span>
                        <?php unset($_SESSION['errors']['password_error']) ?>
                    <?php endif;?>
                </div>

                <button type="submit" class="btn btn-primary w-100" name="saveType" value="login" >Login</button>
            </form>
        </div>
    </div>

    <script src="<?= ROOT_ASSEST ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
