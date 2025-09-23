<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplicativo de Tesoreria Interno</title>

    <link rel="icon" type="image/png" href="../public/images/cheque.png" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/templates/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../public/templates/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/templates/AdminLTE-3.2.0/dist/css/adminlte.min.css">

    <!-- Libreria Sweetallert2-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="hold-transition login-page">

    <?php
    session_start();
    if (isset($_SESSION['mensaje']) && isset($_SESSION['icono'])) {
        $respuesta = $_SESSION['mensaje'];
        $icono = $_SESSION['icono'] ?>
        <script>
            Swal.fire({
                position: 'top-end',
                icon: '<?php echo $icono; ?>',
                title: '<?php echo $respuesta; ?>',
                showConfirmButton: false,
                timer: 3000
            })
        </script>
        <?php
        unset($_SESSION['mensaje']);
        unset($_SESSION['icono']);
    }
    ?>

    <div class="wrapper">
        <br>
        <br>
        <br>

        <div class="login-box">
            <div class="login-logo">
                <a href="#">
                    <h4><b>RECUPERAR CUENTA</b></h4>
                </a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">¿Olvidaste tu contraseña? <br>Digite su usuario para enviarle un correo de
                        restablecimiento de contraseña.</p>

                    <form action="../app/controllers/login/recuperar.php" method="post">
                        <div class="input-group mb-3">
                            <input type="text" name="usuario" class="form-control" placeholder="Usuario" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Solicitar nueva
                                    contraseña</button>
                                <a href="index.php" type="submit" class="btn btn-warning btn-block">Volver</a>
                            </div>

                            <!-- /.col -->
                        </div>
                    </form>



                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    </div>



    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="../public/templates/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../public/templates/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../public/templates/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
</body>

</html>