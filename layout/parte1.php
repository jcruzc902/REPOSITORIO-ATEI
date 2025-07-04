<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">

<head>
    <meta charset="utf-8">
    <script type="text/javascript" src="<?php echo $URL; ?>/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo $URL; ?>/app/librerias/CHARTJS/Chart.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplicativo de Tesoreria Interno</title>


    <link rel="icon" type="image/png" href="<?php echo $URL; ?>/public/images/cheque.png" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet"
        href="<?php echo $URL; ?>/public/templates/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/templates/AdminLTE-3.2.0/dist/css/adminlte.min.css">

    <!-- Libreria Sweetallert2-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- DataTables -->
    <link rel="stylesheet"
        href="<?php echo $URL; ?>/public/templates/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?php echo $URL; ?>/public/templates/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?php echo $URL; ?>/public/templates/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- jQuery -->
    <script src="<?php echo $URL; ?>/public/templates/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="/path/to/select2.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>




</head>


<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">


    <!--Ocultar botones al minimizar la ventana-->
    <script>
        function checkWindowSize() {
            var boton = document.getElementById('soporte');
            var boton2 = document.getElementById('name_user');
            var boton3 = document.getElementById('name_system');

            // Si el tamaño de la ventana es demasiado pequeño, probablemente esté minimizada o muy reducida
            if (window.innerWidth < 1300 || window.innerHeight < 800) {
                boton.style.display = 'none'; // Oculta el botón
                boton2.style.display = 'none'; // Oculta el botón
                boton3.style.display = 'none'; // Oculta el botón
            } else {
                boton.style.display = 'block'; // Muestra el botón
                boton2.style.display = 'inline'; // Muestra el botón
                boton3.style.display = 'inline'; // Muestra el botón
            }
        }

        // También verificar el tamaño al cargar la página
        window.onload = checkWindowSize;

        // Llamar a la función cuando se redimensiona la ventana
        window.onresize = checkWindowSize;


    </script>



    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand" style="background-color: crimson; color: white;">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" style="color: white" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>

                <a class="brand-image" href="#">
                    <img src="<?php echo $URL; ?>/app/controllers/login/Login_v18/images/logo_main.png"
                        style="max-width: 105px;" class="d-inline-block align-top" alt="">

                </a>

                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo $URL; ?>" class="nav-link" style="color: white; line-height: 20px;">
                        <span id="name_system" class="hidden-xs" style="font-size: large;">
                            Aplicativo de Tesoreria Interno
                        </span>
                    </a>
                </li>





            </ul>





            <div class="navbar-custom-menu ml-auto">



                <ul class="nav navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link btn-warning btn-sm" id="soporte" style="margin-right: 20px;"
                            href="<?php echo $URL; ?>/soporte" role="button">
                            <h5><b>¿Necesitas ayuda?</b></h5>
                        </a>


                    </li>



                    <li class="dropdown user user-menu">



                        <a href="#" class="dropdown-toggle" style="color: white; line-height: 40px;"
                            data-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo $URL; ?>/public/images/usuario.jpg" class="user-image"
                                alt="User Image">
                            <span id="name_user" class="hidden-xs" style="font-size: large;">

                                <?php


                                $nombre_completo = $nombres_sesion . " " . $apaterno . " " . $amaterno;


                                echo mb_strtoupper($nombre_completo);
                                ?>
                            </span>
                        </a>

                        <ul class="dropdown-menu">

                            <li class="user-header" style="background-color: #212F3D; color: white">
                                <img src="<?php echo $URL; ?>/public/images/usuario.jpg" class="img-circle"
                                    alt="User Image">
                                <p>
                                    <?php echo "Usuario: " . $user; ?>
                                    <br>
                                    OFICINA DE TESORERÍA
                                </p>
                            </li>



                            <li class="user-footer" style="background-color: #566573; color: white">
                                <div class="pull-left">
                                    <a href="<?php echo $URL; ?>/perfil/update.php?id=<?php echo $id_usuario_sesion; ?>"
                                        class="btn btn-default btn-flat float-left"
                                        style="background-color: royalblue; color: white"><i class="bi bi-sliders2"></i>
                                        Perfil</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?php echo $URL; ?>/app/controllers/login/cerrar_sesion.php"
                                        class="btn btn-default btn-flat float-right"
                                        style="background-color: red; color: white"><i
                                            class="bi bi-box-arrow-right"></i> Salir</a>
                                </div>
                            </li>
                        </ul>
                    </li>


                </ul>
            </div>



        </nav>
        <!-- /.navbar -->


        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4 " style="background-color: black;">
            <!-- Brand Logo -->
            <a href="<?php echo $URL; ?>" class="brand-link" style="background-color: black;">
                <img src="<?php echo $URL; ?>/public/images/cheque.png" alt="AdminLTE Logo" class="brand-image">
                <span class="brand-text font-weight-light text-md" style="color: white;"><b>OFICINA DE
                        TESORERÍA</b></span>
            </a>


            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php echo $URL; ?>/public/images/usuario.jpg" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" id="#tipo_rol" class="d-block">
                            <?php echo strtoupper($rol_sesion); ?>
                        </a>

                    </div>
                </div>


                <!-- Sidebar Menu -->
                <nav class="mt-2 ">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->


                        <li class="nav-item " id="seccion_principal">
                            <a href="<?php echo $URL; ?>" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Inicio
                                </p>
                            </a>

                        </li>





                        <li class="nav-item " id="seccion_devoluciones">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-coins"></i>
                                <p>
                                    Devolucion de Dinero
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item" id="seccion_devolucion">
                                    <a href="<?php echo $URL; ?>/devoluciones" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Devolucion</p>
                                    </a>
                                </li>
                                <li class="nav-item" id="seccion_ingresos">
                                    <a href="<?php echo $URL; ?>/ingresos" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Ingresos</p>
                                    </a>
                                </li>
                                <li class="nav-item" id="seccion_empresas">
                                    <a href="<?php echo $URL; ?>/empresas" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Empresas</p>
                                    </a>
                                </li>
                                <li class="nav-item" id="seccion_dependencias">
                                    <a href="<?php echo $URL; ?>/dependencias" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Depend.</p>
                                    </a>
                                </li>

                                <li class="nav-item" id="seccion_conceptos">
                                    <a href="<?php echo $URL; ?>/conceptos" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Conceptos</p>
                                    </a>
                                </li>
                                <li class="nav-item" id="seccion_bancos">
                                    <a href="<?php echo $URL; ?>/bancos" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Bancos</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item " id="seccion_egresos">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-calculator"></i>
                                <p>
                                    Estado de cuenta
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/estado_egresos" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Egresos</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item" id="seccion_detalle_egresos">
                                    <a href="<?php echo $URL; ?>/egresos" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta Detalle de Estado de Egresos</p>
                                    </a>
                                </li>
                            </ul>



                            <ul class="nav nav-treeview">
                                <li class="nav-item" id="seccion_cargos">
                                    <a href="<?php echo $URL; ?>/cargo" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Cargos</p>
                                    </a>
                                </li>


                            </ul>

                            <ul class="nav nav-treeview">
                                <li class="nav-item" id="seccion_actividades">
                                    <a href="<?php echo $URL; ?>/actividad" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Actividades</p>
                                    </a>
                                </li>


                            </ul>

                            <ul class="nav nav-treeview" hidden>
                                <li class="nav-item" id="seccion_subactividades">
                                    <a href="<?php echo $URL; ?>/subactividad" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Subactividades</p>
                                    </a>
                                </li>


                            </ul>


                        </li>

                        <li class="nav-item " id="seccion_cheques">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-money-check"></i>
                                <p>
                                    Cheques
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/cheques" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Cheques</p>
                                    </a>
                                </li>

                                <li class="nav-item" id="seccion_ingresos">
                                    <a href="<?php echo $URL; ?>/ingresos_cheques" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Pagos</p>
                                    </a>
                                </li>

                            </ul>

                        </li>

                        <li class="nav-item " id="seccion_tasas_tarifas">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-signal"></i>
                                <p>
                                    Tasas y Tarifas
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item" id="seccion_tasas_tarifas">
                                    <a href="<?php echo $URL; ?>/tasas_tarifas" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Tasas y Tarif.</p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item" id="seccion_detalle_tarifas">
                                    <a href="<?php echo $URL; ?>/detalle_tyt" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Detalle TyT</p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item" id="seccion_modalidad">
                                    <a href="<?php echo $URL; ?>/modalidad_tyt" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Modalidad</p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item" id="seccion_concepto_tyt">
                                    <a href="<?php echo $URL; ?>/concepto_tyt" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Concepto</p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item" id="seccion_referencia">
                                    <a href="<?php echo $URL; ?>/referencia_tyt" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Referencia</p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item" id="seccion_dependencia_tyt">
                                    <a href="<?php echo $URL; ?>/dependencia_tyt" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Dependenc.</p>
                                    </a>
                                </li>

                            </ul>

                            <ul class="nav nav-treeview">
                                <li class="nav-item" id="seccion_resolucion">
                                    <a href="<?php echo $URL; ?>/resolucion_rectoral_tyt" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Resol. Recto.</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item " id="seccion_saldos">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-check-circle"></i>
                                <p>
                                    Saldo Bancario
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/saldos" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Saldos</p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item" id="seccion_banco_tyt">
                                    <a href="<?php echo $URL; ?>/banco_sb" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Banco</p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item" id="seccion_cuenta_tyt">
                                    <a href="<?php echo $URL; ?>/cuenta_sb" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Cuenta</p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item" id="seccion_nombre_cuenta_tyt">
                                    <a href="<?php echo $URL; ?>/nombre_sb" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Nombre</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item " id="seccion_cartas_fianza" style="display: none;">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-folder-open"></i>
                                <p>
                                    Cartas Fianza
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/cartas_fianza" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Cartas F.</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/entidades" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Entidades</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/proveedores" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Proveedores</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item " id="seccion_roles">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-address-card"></i>
                                <p>
                                    Roles
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/roles" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Roles</p>
                                    </a>
                                </li>

                            </ul>
                        </li>





                        <li class="nav-item " id="seccion_usuarios">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Usuarios
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/usuarios" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Consulta de Usuarios</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item " id="seccion_manual">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Manual
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/manual" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Manual de Usuario </p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                    </ul>
                </nav>


                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!--PANEL DE ROLES-->
        <?php

        $sql_roles = "SELECT * FROM tb_roles where rol='$rol_sesion' AND visible!=1";
        $query_roles = $pdo->prepare($sql_roles);
        $query_roles->execute();
        $roles_datos = $query_roles->fetchAll(PDO::FETCH_ASSOC);

        foreach ($roles_datos as $rol_dato) {
            $nombre_rol = $rol_dato['rol'];
            $modulo_devolucion = $rol_dato['modulo_devolucion'];
            $modulo_cheques = $rol_dato['modulo_cheques'];
            $modulo_tyt = $rol_dato['modulo_tyt'];
            $modulo_saldo = $rol_dato['modulo_saldo'];
            $modulo_estado_cta = $rol_dato['modulo_estado_cta'];
            $modulo_usuario = $rol_dato['modulo_usuario'];
            $modulo_roles = $rol_dato['modulo_roles'];
        }

        if ($rol_sesion == $nombre_rol) {

            switch ($modulo_devolucion) {
                case 'YES': ?>
                    <script>document.getElementById('seccion_devoluciones').style.display = 'inline';</script><?php break;
                case 'NO': ?>
                    <script>document.getElementById('seccion_devoluciones').style.display = 'none';</script><?php break;
            }

            switch ($modulo_cheques) {
                case 'YES': ?>
                    <script>document.getElementById('seccion_cheques').style.display = 'inline';</script><?php break;
                case 'NO': ?>
                    <script>document.getElementById('seccion_cheques').style.display = 'none';</script><?php break;
            }

            switch ($modulo_tyt) {
                case 'YES': ?>
                    <script>document.getElementById('seccion_tasas_tarifas').style.display = 'inline';</script><?php break;
                case 'NO': ?>
                    <script>document.getElementById('seccion_tasas_tarifas').style.display = 'none';</script><?php break;
            }

            switch ($modulo_saldo) {
                case 'YES': ?>
                    <script>document.getElementById('seccion_saldos').style.display = 'inline';</script><?php break;
                case 'NO': ?>
                    <script>document.getElementById('seccion_saldos').style.display = 'none';</script><?php break;
            }

            switch ($modulo_estado_cta) {
                case 'YES': ?>
                    <script>document.getElementById('seccion_egresos').style.display = 'inline';</script><?php break;
                case 'NO': ?>
                    <script>document.getElementById('seccion_egresos').style.display = 'none';</script><?php break;
            }

            switch ($modulo_usuario) {
                case 'YES': ?>
                    <script>document.getElementById('seccion_usuarios').style.display = 'inline';</script><?php break;
                case 'NO': ?>
                    <script>document.getElementById('seccion_usuarios').style.display = 'none';</script><?php break;
            }

            switch ($modulo_roles) {
                case 'YES': ?>
                    <script>document.getElementById('seccion_roles').style.display = 'inline';</script><?php break;
                case 'NO': ?>
                    <script>document.getElementById('seccion_roles').style.display = 'none';</script><?php break;
            }

        }

        if ($rol_sesion != "ADMINISTRADOR") {
            ?>
            <script>document.getElementById('seccion_manual').style.display = 'none';</script>
            <?php
        }

        //JOEL
        if ($rol_sesion == "ADMINISTRADOR" && $id_usuario_sesion == 11) {
            ?>
            <script>document.getElementById('seccion_saldos').style.display = 'none';</script>
            <?php
        }

        //MARIA CELIA
        if ($rol_sesion == "DIGA" && $id_usuario_sesion == 13) {
            ?>
            <script>document.getElementById('seccion_saldos').style.display = 'none';</script>
            <?php
        }

        ?>