<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');

include('../app/controllers/usuarios/show_usuario.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Datos del Usuario</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/usuarios"><i
                                    class="bi bi-person-fill"></i> Usuarios</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-search"></i> Informacion del usuario</a></li>
                    </ol>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">INFORMACION DEL USUARIO SELECCIONADO</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: block;">

                            <form action="#">
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="">Nombres</label>
                                        <input type="text" class="form-control "
                                            value="<?php echo $nombres; ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Apellido Paterno</label>
                                        <input type="text" class="form-control "
                                            value="<?php echo $apaterno; ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Apellido Materno</label>
                                        <input type="text" class="form-control "
                                            value="<?php echo $amaterno; ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Correo</label>
                                        <input type="email" class="form-control "
                                            value="<?php echo $email; ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Rol del Usurio</label>
                                        <input type="text" class="form-control "
                                            value="<?php echo $rol; ?>" readonly>

                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Estado</label>
                                        <input type="text" class="form-control "
                                            value="<?php echo $estado; ?>" readonly>

                                    </div>

                                    <div class="form-group col-md-2">

                                        <label for="">Fecha de Registro</label>
                                        <input type="text" class="form-control " value="<?php
                                        $theDate = new DateTime($fyh_registro);
                                        echo $stringDate = $theDate->format('d/m/Y');
                                        ?>" readonly>

                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Usuario</label>
                                        <input type="text" class="form-control "
                                            value="<?php echo $user; ?>" readonly>
                                    </div>

                                    <div class="form-group col-md-12 text-right">
                                        <a href="index" class="btn" style="background-color: grey; color: white;"><i
                                                class="bi bi-x-circle-fill"></i> Cancelar</a>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>