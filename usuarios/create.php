<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');

include('../app/controllers/roles/listado_de_roles.php');
include('../app/controllers/estado/listado_de_estados.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Registrar Nuevo Usuario</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/usuarios"><i
                                    class="bi bi-person-fill"></i> Usuarios</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-clipboard-check"></i> Registrar nuevo
                            usuario</a></li>
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
                            <h3 class="card-title">DIGITE LOS DATOS DEL NUEVO USUARIO</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: block;">
                            <form action="../app/controllers/usuarios/create.php" method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="">Nombres</label>
                                        <input class="form-control " type="text" name="nombres"
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Apellido Paterno</label>
                                        <input class="form-control " type="text" name="apaterno"
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Apellido Materno</label>
                                        <input class="form-control " type="text" name="amaterno"
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Correo</label>
                                        <input class="form-control " type="email" name="email"
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Rol del Usurio</label>
                                        <select class="form-control " name="rol" id="rolusuario"
                                            class="form-control" required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($roles_datos as $roles_dato) { ?>
                                                <option value="<?php echo $roles_dato['id_rol']; ?>">
                                                    <?php echo $roles_dato['rol']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Estado</label>
                                        <select name="estado" id="estado" class="form-control " required>
                                        <option value="">SELECCIONAR</option>
                                            <?php
                                            $estado="HABILITADO";
                                            foreach ($estados_datos as $estados_dato) {
                                                $estado_tabla = $estados_dato['nombre_estado'];
                                                $id_estado = $estados_dato['id_estado']; ?>
                                                <option value="<?php echo $id_estado; ?>" <?php if ($estado_tabla == $estado) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $estado_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Usuario</label>
                                        <input class="form-control " type="text" name="usuario"
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Contraseña</label>
                                        <input class="form-control " type="password" name="password_user"
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Repita la Contraseña</label>
                                        <input class="form-control " type="password" name="password_repeat"
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-12" align="right">
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i>
                                            Guardar</button>
                                        <a href="index" class="btn" style="background-color: grey; color: white;"><i
                                                class="bi bi-x-circle-fill"></i> Cancelar</a>

                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function () {
                                        $('#rolusuario').select2({
                                            theme: 'bootstrap4',
                                        });
                                        $('#estado').select2({
                                            theme: 'bootstrap4',
                                        });

                                        
                                    });
                                </script>
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

<?php include('../layout/parte2.php'); ?>
<?php include('../layout/mensajes.php'); ?>