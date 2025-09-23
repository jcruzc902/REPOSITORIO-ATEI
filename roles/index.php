<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');


include('../app/controllers/roles/listado_de_roles.php');


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1 class="m-0"><b>Consulta de Roles</b>
                        <button type="button" class="btn btn-default bg-primary" style="display: inline;"
                            data-toggle="modal" data-target="#modal-create">
                            <i class="bi bi-plus-circle"></i> Agregar Nuevo Rol
                        </button>
                        <a href="<?php echo $URL; ?>/app/controllers/roles/exportar_excel" type="button"
                            class="btn btn-default bg-success">
                            <i class="bi bi-file-earmark-excel"></i> Exportar a Excel
                        </a>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-person-vcard-fill"></i> Roles</li>
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
                            <h3 class="card-title">ROLES REGISTRADO</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body table-responsive" style="display: block;">
                            <table id="example1" class="table table-hover text-center">
                                <thead>
                                    <tr style="background-color: darkblue; color: white;">
                                        <th>
                                            <center>Nro</center>
                                        </th>
                                        <th>
                                            <center>Nombre del Rol</center>
                                        </th>
                                        <th>
                                            <center>Acciones</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($roles_datos as $roles_dato) {
                                        $id_rol = $roles_dato['id_rol'];
                                        $nombre_rol = $roles_dato['rol'];
                                        $modulo_devolucion = $roles_dato['modulo_devolucion'];
                                        $modulo_cheques = $roles_dato['modulo_cheques'];
                                        $modulo_tyt = $roles_dato['modulo_tyt'];
                                        $modulo_saldo = $roles_dato['modulo_saldo'];
                                        $modulo_estado_cta = $roles_dato['modulo_estado_cta'];
                                        $modulo_usuario = $roles_dato['modulo_usuario'];
                                        $modulo_roles = $roles_dato['modulo_roles'];

                                        ?>
                                        <tr>
                                            <td>
                                                <center>
                                                    <?php echo $contador = $contador + 1; ?>
                                                </center>
                                            </td>
                                            <td>
                                                <?php echo $roles_dato['rol']; ?>

                                            </td>
                                            <td>
                                                <center>
                                                    <button type="button" class="btn btn-sm btn-success"
                                                        style="display: inline;" data-toggle="modal"
                                                        data-target="#modal-update<?php echo $id_rol; ?>">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                                        data-target="#modal-delete<?php echo $id_rol; ?>"
                                                        style="display: none;"> <i class="fa fa-trash"></i>
                                                    </button>

                                                    <form action="../app/controllers/roles/update.php" method="post">
                                                        <div class="modal fade" id="modal-update<?php echo $id_rol; ?>">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header"
                                                                        style="background-color: black; color: white">
                                                                        <h4 class="modal-title">Actualizar Rol</h4>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <input type="text" name="id_rol"
                                                                                value="<?php echo $id_rol; ?>"
                                                                                class="form-control " hidden>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label class="float-left">Nombre de
                                                                                        Rol</label>
                                                                                    <input type="text" name="nombre_rol"
                                                                                        value="<?php echo $nombre_rol; ?>"
                                                                                        class="form-control " required>

                                                                                </div>


                                                                            </div>


                                                                            <div class="col-md-12">
                                                                                <div class="float-left form-check">
                                                                                    <input type="checkbox"
                                                                                        class="form-check-input"
                                                                                        name="modulo_devoluciones"
                                                                                        <?php if ($modulo_devolucion == "YES") {
                                                                                            echo "checked";
                                                                                        } ?>>
                                                                                    <label class="form-check-label"
                                                                                        for="modulo_devoluciones">Devoluciones</label>
                                                                                </div>
                                                                            </div>




                                                                            <div class="col-md-12">
                                                                                <div class="float-left form-check">
                                                                                    <input type="checkbox"
                                                                                        class="form-check-input"
                                                                                        name="modulo_cheques"
                                                                                        <?php if ($modulo_cheques == "YES") {
                                                                                            echo "checked";
                                                                                        } ?>>
                                                                                    <label class="form-check-label"
                                                                                        for="modulo_cheques">Cheques</label>
                                                                                </div>
                                                                            </div>





                                                                            <div class="col-md-12">
                                                                                <div class="float-left form-check">
                                                                                    <input type="checkbox"
                                                                                        class="form-check-input"
                                                                                        name="modulo_tyt"
                                                                                        <?php if ($modulo_tyt == "YES") {
                                                                                            echo "checked";
                                                                                        } ?>>
                                                                                    <label class="form-check-label"
                                                                                        for="modulo_tyt">Tasas y
                                                                                        Tarifas</label>
                                                                                </div>
                                                                            </div>





                                                                            <div class="col-md-12">
                                                                                <div class="float-left form-check">
                                                                                    <input type="checkbox"
                                                                                        class="form-check-input"
                                                                                        name="modulo_saldos"
                                                                                        <?php if ($modulo_saldo == "YES") {
                                                                                            echo "checked";
                                                                                        } ?>>
                                                                                    <label class="form-check-label"
                                                                                        for="modulo_saldos">Saldo
                                                                                        Bancarios</label>
                                                                                </div>
                                                                            </div>





                                                                            <div class="col-md-12">
                                                                                <div class="float-left form-check">
                                                                                    <input type="checkbox"
                                                                                        class="form-check-input"
                                                                                        name="modulo_cuentas"
                                                                                        <?php if ($modulo_estado_cta == "YES") {
                                                                                            echo "checked";
                                                                                        } ?>>
                                                                                    <label class="form-check-label"
                                                                                        for="modulo_cuentas">Estado
                                                                                        de cuentas</label>
                                                                                </div>
                                                                            </div>





                                                                            <div class="col-md-12">
                                                                                <div class="float-left form-check">
                                                                                    <input type="checkbox"
                                                                                        class="form-check-input"
                                                                                        name="modulo_usuarios"
                                                                                        <?php if ($modulo_usuario == "YES") {
                                                                                            echo "checked";
                                                                                        } ?>>
                                                                                    <label class="form-check-label"
                                                                                        for="modulo_usuarios">Usuarios</label>
                                                                                </div>
                                                                            </div>



                                                                            <div class="col-md-12">
                                                                                <div class="float-left form-check">
                                                                                    <input type="checkbox"
                                                                                        class="form-check-input"
                                                                                        name="modulo_roles"
                                                                                        <?php if ($modulo_roles == "YES") {
                                                                                            echo "checked";
                                                                                        } ?>>
                                                                                    <label class="form-check-label"
                                                                                        for="modulo_roles">Roles</label>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer">


                                                                        <button type="submit" class="btn btn-primary"
                                                                            id="btn_update<?php echo $id_rol; ?>"><i
                                                                                class="bi bi-pencil-square"></i> Guardar
                                                                        </button>

                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal"><i
                                                                                class="bi bi-x-circle-fill"></i> Cancelar
                                                                        </button>

                                                                    </div>
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>
                                                    </form>


                                                    <!-- /.modal -->
                                                    <!--
                                                    <script>
                                                        $('#btn_update<?php echo $id_rol; ?>').click(function () {
                                                            var nombre_rol = $('#nombre_rol<?php echo $id_rol; ?>').val();
                                                            var id_rol = '<?php echo $id_rol; ?>';

                                                            if (nombre_rol == "") {
                                                                $('#nombre_rol<?php echo $id_rol; ?>').focus();
                                                                $('#lbl_update<?php echo $id_rol; ?>').css('display', 'block');
                                                            } else {
                                                                var url = "../app/controllers/roles/update.php";
                                                                $.get(url, { nombre_rol: nombre_rol, id_rol: id_rol }, function (datos) {
                                                                    $('#respuesta_update<?php echo $id_rol; ?>').html(datos);
                                                                });
                                                            }
                                                        });
                                                    </script>
                                                    <div id="respuesta_update<?php echo $id_rol; ?>"></div>
                                    -->







                                                    <div class="modal fade" id="modal-delete<?php echo $id_rol; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header"
                                                                    style="background-color: black; color: white;">
                                                                    <h4 class="modal-title">Eliminar Rol</h4>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Nombre del
                                                                                    Rol</label>
                                                                                <input type="text"
                                                                                    id="nombre_rol<?php echo $id_rol; ?>"
                                                                                    value="<?php echo $nombre_rol; ?>"
                                                                                    class="form-control " disabled>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">

                                                                    <button type="button" class="btn btn-danger"
                                                                        id="btn_delete<?php echo $id_rol; ?>"><i
                                                                            class="bi bi-trash-fill"></i> Eliminar</button>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal"><i
                                                                            class="bi bi-x-circle-fill"></i>
                                                                        Cancelar</button>

                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- /.modal -->

                                                    <script>
                                                        $('#btn_delete<?php echo $id_rol; ?>').click(function () {

                                                            var id_rol = '<?php echo $id_rol; ?>';


                                                            var url = "../app/controllers/roles/ocultar_rol.php";
                                                            $.get(url, { id_rol: id_rol }, function (datos) {
                                                                $('#respuesta_delete<?php echo $id_rol; ?>').html(datos);
                                                            });

                                                        });
                                                    </script>
                                                    <div id="respuesta_delete<?php echo $id_rol; ?>"></div>



                                                </center>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>



            <!-- /.row -->
        </div><!-- /.container-fluid -->

        <div class="col-md-12">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">FUNCIONES SEGUN EL ROL</h3>
                </div>

                <div class="card-body">

                    <div id="accordion">
                        <div class="card card-dark">
                            <div class="card-header">
                                <h4 class="card-title w-100">
                                    <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseOne"
                                        aria-expanded="false"><i class="bi bi-person-vcard-fill"></i>
                                        ADMINISTRADOR (Clic aqui)
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body">
                                    El rol de administrador tiene todos los modulos disponible en el sistema.
                                </div>
                            </div>
                        </div>
                        <div class="card card-dark">
                            <div class="card-header">
                                <h4 class="card-title w-100">
                                    <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseTwo"
                                        aria-expanded="false"><i class="bi bi-person-vcard-fill"></i>
                                        SECRETARIA (Clic aqui)
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body">
                                    El rol de secretaria solo tiene disponible el modulo de devolucion de dinero.
                                </div>
                            </div>
                        </div>
                        <div class="card card-dark">
                            <div class="card-header">
                                <h4 class="card-title w-100">
                                    <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseThree"
                                        aria-expanded="false"><i class="bi bi-person-vcard-fill"></i>
                                        INGRESOS (Clic aqui)
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body">
                                    El rol de ingresos solo tiene disponible el modulo de devolucion de dinero.
                                </div>
                            </div>
                        </div>
                        <div class="card card-dark">
                            <div class="card-header">
                                <h4 class="card-title w-100">
                                    <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseFour"
                                        aria-expanded="false"><i class="bi bi-person-vcard-fill"></i>
                                        JEFATURA (Clic aqui)
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body">
                                    El rol de jefatura solo tiene disponible el modulo de devolucion de dinero y
                                    cheques.
                                </div>
                            </div>
                        </div>
                        <div class="card card-dark">
                            <div class="card-header">
                                <h4 class="card-title w-100">
                                    <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseFive"
                                        aria-expanded="false"><i class="bi bi-person-vcard-fill"></i>
                                        DIGA (Clic aqui)
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFive" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body">
                                    El rol de diga solo tiene disponible el modulo de saldo bancario y tasas-tarifas.
                                </div>
                            </div>
                        </div>
                        <div class="card card-dark">
                            <div class="card-header">
                                <h4 class="card-title w-100">
                                    <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseSix"
                                        aria-expanded="false"><i class="bi bi-person-vcard-fill"></i>
                                        EGRESOS (Clic aqui)
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseSix" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body">
                                    El rol de egresos solo tiene disponible el modulo de estado de cuentas.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>


<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 10,
            "language": {
                "emptyTable": "No hay información",
                "info": "Registros encontrados: _TOTAL_",
                "infoEmpty": "Registros encontrados: 0",
                "infoFiltered": "(Filtrado de _MAX_ total Roles)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Roles",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": false, "lengthChange": true, "autoWidth": false,

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

<div class="modal fade" id="modal-create">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../app/controllers/roles/create.php" method="post">


                <div class="modal-header" style="background-color: black; color: white">
                    <h4 class="modal-title">Registrar Nuevo Rol</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="float-left">Nombre de Rol</label>
                                <input type="text" name="nombre_rol" class="form-control " required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="modulo_devoluciones">
                                <label class="form-check-label" for="modulo_devoluciones">Devoluciones</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="modulo_cheques">
                                <label class="form-check-label" for="modulo_cheques">Cheques</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="modulo_tyt">
                                <label class="form-check-label" for="modulo_tyt">Tasas y Tarifas</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="modulo_saldos">
                                <label class="form-check-label" for="modulo_saldos">Saldo Bancarios</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="modulo_cuentas">
                                <label class="form-check-label" for="modulo_cuentas">Estado de cuentas</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="modulo_usuarios">
                                <label class="form-check-label" for="modulo_usuarios">Usuarios</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="modulo_roles">
                                <label class="form-check-label" for="modulo_roles">Roles</label>
                            </div>
                        </div>

                    </div>



                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_create"><i class="bi bi-floppy-fill"></i>
                        Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                            class="bi bi-x-circle-fill"></i>
                        Cancelar</button>

                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--
<script>
    $('#btn_create').click(function () {
        var nombre_rol = $('#nombre_rol').val();
        var modulo_devolucion = $('#modulo_devoluciones').val();
        var modulo_cheques = $('#modulo_cheques').val();
        var modulo_tyt = $('#modulo_tyt').val();
        var modulo_saldo = $('#modulo_saldos').val();
        var modulo_cuenta = $('#modulo_cuentas').val();
        var modulo_usuario = $('#modulo_usuarios').val();

        if (nombre_rol == "") {
            $('#nombre_rol').focus();
            $('#lbl_create').css('display', 'block');
        } else {
            var url = "../app/controllers/roles/create.php";
            $.get(url, {
                nombre_rol: nombre_rol, modulo_devolucion: modulo_devolucion,
                modulo_cheques: modulo_cheques, modulo_tyt: modulo_tyt, modulo_saldo, modulo_saldo,
                modulo_cuenta: modulo_cuenta, modulo_usuario: modulo_usuario
            }, function (datos) {
                $('#respuesta').html(datos);
            });
        }

    });
</script>
<div id="respuesta"></div>

-->