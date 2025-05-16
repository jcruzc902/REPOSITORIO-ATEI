<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');


include ('../app/controllers/actividad_principal/listado_actividad_principal.php');
include ('../app/controllers/cargo/listado_cargo.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1 class="m-0"><b>Consulta de Actividad Principal</b>
                        <button type="button" class="btn btn-default bg-primary" data-toggle="modal"
                            data-target="#modal-create">
                            <i class="bi bi-plus-circle"></i> Agregar Nueva Actividad Principal
                        </button>

                    </h1>

                </div><!-- /.col -->
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-check2-square"></i> Actividad Principal</li>
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
                            <h3 class="card-title">ACTIVIDADES REGISTRADO</h3>
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
                                            <center>Actividad Principal</center>
                                        </th>
                                        <th>
                                            <center>Cargo</center>
                                        </th>
                                        <th>
                                            <center>Acciones</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($actividad_principal_datos as $actividad_principal_dato) {
                                        $id_actividad_principal = $actividad_principal_dato['id_actividad_principal'];
                                        $nombre_actividad = $actividad_principal_dato['nombre_actividad'];
                                        $nombre_cargo = $actividad_principal_dato['nombre_cargo'];
                                        ?>
                                        <tr>
                                            <td>
                                                <center>
                                                    <?php echo $contador = $contador + 1; ?>
                                                </center>
                                            </td>
                                            <td>
                                                <?php echo mb_strtoupper($actividad_principal_dato['nombre_actividad']); ?>
                                            </td>
                                            <td>
                                                <?php echo mb_strtoupper($actividad_principal_dato['nombre_cargo']); ?>
                                            </td>
                                            <td>
                                                <center>



                                                    <button type="button" class="btn btn-sm btn-default bg-success"
                                                        data-toggle="modal"
                                                        data-target="#modal-update<?php echo $id_actividad_principal; ?>">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-sm btn-default bg-danger"
                                                        data-toggle="modal"
                                                        data-target="#modal-delete<?php echo $id_actividad_principal; ?>">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                    <div class="modal fade"
                                                        id="modal-update<?php echo $id_actividad_principal; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header"
                                                                    style="background-color: black; color: white">
                                                                    <h4 class="modal-title">Actualizar Actividad Principal
                                                                    </h4>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Nombre de Actividad Principal</label>
                                                                                <input type="text"
                                                                                    id="nombre_actividad<?php echo $id_actividad_principal; ?>"
                                                                                    value="<?php echo $nombre_actividad; ?>"
                                                                                    class="form-control ">
                                                                                <small style="color: red; display: none"
                                                                                    id="lbl_update<?php echo $id_actividad_principal; ?>">*
                                                                                    Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Nombre de Cargo</label>
                                                                                <select class="form-control" id="id_cargo<?php echo $id_actividad_principal; ?>" style="width:100%">
                                                                                    <option value="">SELECCIONAR</option>
                                                                                    <?php
                                                                                    foreach ($tipo_cargo_datos as $tipo_cargo_dato) {
                                                                                        $nombre_cargo_tabla = $tipo_cargo_dato['nombre_cargo'];
                                                                                        $id_cargo = $tipo_cargo_dato['id_cargo']; ?>
                                                                                        <option
                                                                                            value="<?php echo $id_cargo; ?>"
                                                                                            <?php if ($nombre_cargo_tabla == $nombre_cargo) { ?> selected="selected" <?php } ?>>
                                                                                            <?php echo $nombre_cargo_tabla; ?>
                                                                                        </option>
                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                                <small style="color: red; display: none"
                                                                                    id="lbl_update2<?php echo $id_actividad_principal; ?>">*
                                                                                    Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer ">
                                                                    <button type="button" class="btn btn-primary"
                                                                        id="btn_update<?php echo $id_actividad_principal; ?>"><i
                                                                            class="bi bi-pencil-square"></i> Guardar
                                                                    </button>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal"><i class="bi bi-x-circle"></i>
                                                                        Cancelar
                                                                    </button>



                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- /.modal -->
                                                    

                                                    <script>
                                                        $('#btn_update<?php echo $id_actividad_principal; ?>').click(function () {
                                                            var nombre_actividad = $('#nombre_actividad<?php echo $id_actividad_principal; ?>').val();
                                                            var id_cargo = $('#id_cargo<?php echo $id_actividad_principal; ?>').val();
                                                            var id_actividad_principal= '<?php echo $id_actividad_principal; ?>';

                                                            if (nombre_actividad == "") {
                                                                $('#nombre_actividad<?php echo $id_actividad_principal; ?>').focus();
                                                                $('#lbl_update<?php echo $id_actividad_principal; ?>').css('display', 'block');
                                                            } else if (id_cargo == "") {
                                                                $('#id_cargo<?php echo $id_actividad_principal; ?>').focus();
                                                                $('#lbl_update2<?php echo $id_actividad_principal; ?>').css('display', 'block');
                                                            } else {
                                                                var url = "../app/controllers/actividad_principal/update.php";
                                                                $.get(url, { nombre_actividad: nombre_actividad, id_cargo: id_cargo, id_actividad_principal: id_actividad_principal}, function (datos) {
                                                                    $('#respuesta_update<?php echo $id_actividad_principal; ?>').html(datos);
                                                                });
                                                            }
                                                        });
                                                    </script>
                                                    <div id="respuesta_update<?php echo $id_actividad_principal; ?>"></div>





                                                    <div class="modal fade"
                                                        id="modal-delete<?php echo $id_actividad_principal; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header"
                                                                    style="background-color: black; color: white;">
                                                                    <h4 class="modal-title">Eliminar Actividad Principal
                                                                    </h4>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                    <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Nombre de Actividad Principal</label>
                                                                                <input type="text"
                                                                                    id="nombre_actividad<?php echo $id_actividad_principal; ?>"
                                                                                    value="<?php echo $nombre_actividad; ?>"
                                                                                    class="form-control " disabled>
                                                                                <small style="color: red; display: none"
                                                                                    id="lbl_update<?php echo $id_actividad_principal; ?>">*
                                                                                    Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Nombre de Cargo</label>
                                                                                <select class="form-control" id="id_cargo<?php echo $id_actividad_principal; ?>" style="width:100%" disabled>
                                                                                    <option value="">SELECCIONAR</option>
                                                                                    <?php
                                                                                    foreach ($tipo_cargo_datos as $tipo_cargo_dato) {
                                                                                        $nombre_cargo_tabla = $tipo_cargo_dato['nombre_cargo'];
                                                                                        $id_cargo = $tipo_cargo_dato['id_cargo']; ?>
                                                                                        <option
                                                                                            value="<?php echo $id_cargo; ?>"
                                                                                            <?php if ($nombre_cargo_tabla == $nombre_cargo) { ?> selected="selected" <?php } ?>>
                                                                                            <?php echo $nombre_cargo_tabla; ?>
                                                                                        </option>
                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                                <small style="color: red; display: none"
                                                                                    id="lbl_update2<?php echo $id_actividad_principal; ?>">*
                                                                                    Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger"
                                                                        id="btn_delete<?php echo $id_actividad_principal; ?>"><i
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
                                                        $('#btn_delete<?php echo $id_actividad_principal; ?>').click(function () {

                                                            var id_actividad_principal = '<?php echo $id_actividad_principal; ?>';


                                                            var url = "../app/controllers/actividad_principal/ocultar_actividad_principal.php";
                                                            $.get(url, { id_actividad_principal: id_actividad_principal }, function (datos) {
                                                                $('#respuesta_delete<?php echo $id_actividad_principal; ?>').html(datos);
                                                            });

                                                        });
                                                    </script>
                                                    <div id="respuesta_delete<?php echo $id_actividad_principal; ?>"></div>

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
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include ('../layout/mensajes.php'); ?>
<?php include ('../layout/parte2.php'); ?>


<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 10,
            "language": {
                "emptyTable": "No hay información",
                "info": "Registros encontrados: _TOTAL_",
                "infoEmpty": "Registros encontrados: 0",
                "infoFiltered": "(Filtrado de _MAX_ total Actidades)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Actidades",
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
            <div class="modal-header" style="background-color: black; color: white">
                <h4 class="modal-title">Registrar Nueva Actividad Principal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Nombre de Actividad Principal</label>
                            <input type="text" id="nombre_actividad" class="form-control ">
                            <small style="color: red; display: none" id="lbl_create">* Este campo es requerido</small>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Nombre de Cargo</label>
                            <select class="form-control " id="id_cargo" style="width:100%" required>
                                <option value="">SELECCIONAR</option>
                                <?php
                                foreach ($tipo_cargo_datos as $tipo_cargo_dato) { ?>
                                    <option value="<?php echo $tipo_cargo_dato['id_cargo']; ?>">
                                        <?php echo $tipo_cargo_dato['nombre_cargo']; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                            <small style="color: red; display: none" id="lbl_create2">* Este campo es requerido</small>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-primary" id="btn_create"><i class="bi bi-floppy-fill"></i>
                    Guardar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="bi bi-x-circle"></i>
                    Cancelar</button>


            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    $('#btn_create').click(function () {
        var nombre_actividad = $('#nombre_actividad').val();
        var id_cargo = $('#id_cargo').val();

        if (nombre_actividad == "") {
            $('#nombre_actividad').focus();
            $('#lbl_create').css('display', 'block');
        } else if (id_cargo == "") {
            $('#id_cargo').focus();
            $('#lbl_create2').css('display', 'block');
        } else {
            var url = "../app/controllers/actividad_principal/create.php";
            $.get(url, { nombre_actividad: nombre_actividad, id_cargo: id_cargo }, function (datos) {
                $('#respuesta').html(datos);
            });
        }

    });
</script>

<script>
    $(document).ready(function () {
        $('#id_cargo').select2({
            theme: 'bootstrap4',
        });
    });
</script>
<div id="respuesta"></div>