<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');


include ('../app/controllers/actividad_principal/listado_actividad_principal.php');
include ('../app/controllers/subactividad/listado_subactividad.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1 class="m-0"><b>Consulta de Subactividad</b>
                        <button type="button" class="btn btn-default bg-primary" data-toggle="modal"
                            data-target="#modal-create">
                            <i class="bi bi-plus-circle"></i> Agregar Nuevo Subactividad
                        </button>

                    </h1>

                </div><!-- /.col -->
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-check2-square"></i> Subactividad</li>
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
                            <h3 class="card-title">SUBACTIVIDADES REGISTRADO</h3>
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
                                            <center>Subactividad</center>
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
                                    foreach ($subactividad_datos as $subactividad_dato) {
                                        $id_subactividad = $subactividad_dato['id_subactividad'];
                                        $nombre_subactividad = $subactividad_dato['nombre_subactividad'];
                                        $nombre_actividad_principal = $subactividad_dato['nombre_actividad_principal'];
                                        $nombre_cargo = $subactividad_dato['nombre_cargo'];
                                        ?>
                                        <tr>
                                            <td>
                                                <center>
                                                    <?php echo $contador = $contador + 1; ?>
                                                </center>
                                            </td>
                                            <td>
                                                <?php echo mb_strtoupper($subactividad_dato['nombre_subactividad']); ?>
                                            </td>
                                            <td>
                                                <?php echo mb_strtoupper($subactividad_dato['nombre_actividad_principal']); ?>
                                            </td>
                                            <td>
                                                <?php echo mb_strtoupper($subactividad_dato['nombre_cargo']); ?>
                                            </td>
                                            <td>
                                                <center>



                                                    <button type="button" class="btn btn-sm btn-default bg-success"
                                                        data-toggle="modal"
                                                        data-target="#modal-update<?php echo $id_subactividad; ?>">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-sm btn-default bg-danger"
                                                        data-toggle="modal"
                                                        data-target="#modal-delete<?php echo $id_subactividad; ?>">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                    <div class="modal fade"
                                                        id="modal-update<?php echo $id_subactividad; ?>">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header"
                                                                    style="background-color: black; color: white">
                                                                    <h4 class="modal-title">Actualizar Subactividad
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
                                                                                <label class="float-left">Nombre de Subactividad</label>
                                                                                <input type="text"
                                                                                    id="nombre_subactividad<?php echo $id_subactividad; ?>"
                                                                                    value="<?php echo $nombre_subactividad; ?>"
                                                                                    class="form-control ">
                                                                                <small style="color: red; display: none"
                                                                                    id="lbl_update<?php echo $id_subactividad; ?>">*
                                                                                    Este campo es requerido</small>
                                                                            </div>
                                                                        </div> 
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Cargo - Actividad Principal</label>
                                                                                <select class="form-control" id="id_actividad<?php echo $id_subactividad; ?>" style="width:100%">
                                                                                    <option value="">SELECCIONAR</option>
                                                                                    <?php
                                                                                    foreach ($actividad_principal_datos as $actividad_principal_dato) {
                                                                                        $nombre_cargo_tabla = $actividad_principal_dato['nombre_cargo'];
                                                                                        $nombre_actividad_tabla = $actividad_principal_dato['nombre_actividad'];
                                                                                        $id_actividad_principal = $actividad_principal_dato['id_actividad_principal']; ?>
                                                                                        <option
                                                                                            value="<?php echo $id_actividad_principal; ?>"
                                                                                            <?php if ($nombre_actividad_tabla == $nombre_actividad_principal && $nombre_cargo_tabla== $nombre_cargo) { ?> selected="selected" <?php } ?>>
                                                                                            <?php echo $nombre_cargo_tabla." - ".$nombre_actividad_tabla; ?>
                                                                                        </option>
                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                                <small style="color: red; display: none"
                                                                                    id="lbl_update2<?php echo $id_subactividad; ?>">*
                                                                                    Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer ">
                                                                    <button type="button" class="btn btn-primary"
                                                                        id="btn_update<?php echo $id_subactividad; ?>"><i
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
                                                        $('#btn_update<?php echo $id_subactividad; ?>').click(function () {
                                                            var nombre_subactividad = $('#nombre_subactividad<?php echo $id_subactividad; ?>').val();
                                                            var id_actividad = $('#id_actividad<?php echo $id_subactividad; ?>').val();
                                                            var id_subactividad= '<?php echo $id_subactividad; ?>';

                                                            if (nombre_subactividad == "") {
                                                                $('#nombre_subactividad<?php echo $id_subactividad; ?>').focus();
                                                                $('#lbl_update<?php echo $id_subactividad; ?>').css('display', 'block');
                                                            } else if (id_actividad == "") {
                                                                $('#id_actividad<?php echo $id_subactividad; ?>').focus();
                                                                $('#lbl_update2<?php echo $id_subactividad; ?>').css('display', 'block');
                                                            } else {
                                                                var url = "../app/controllers/subactividad/update.php";
                                                                $.get(url, { nombre_subactividad: nombre_subactividad, id_actividad: id_actividad, id_subactividad: id_subactividad}, function (datos) {
                                                                    $('#respuesta_update<?php echo $id_subactividad; ?>').html(datos);
                                                                });
                                                            }
                                                        });
                                                    </script>
                                                    <div id="respuesta_update<?php echo $id_subactividad; ?>"></div>





                                                    <div class="modal fade"
                                                        id="modal-delete<?php echo $id_subactividad; ?>">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header"
                                                                    style="background-color: black; color: white;">
                                                                    <h4 class="modal-title">Eliminar Subactividad
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
                                                                                <label class="float-left">Nombre de Subactividad</label>
                                                                                <input type="text"
                                                                                    id="nombre_subactividad<?php echo $id_subactividad; ?>"
                                                                                    value="<?php echo $nombre_subactividad; ?>"
                                                                                    class="form-control " disabled>
                                                                                <small style="color: red; display: none"
                                                                                    id="lbl_update<?php echo $id_subactividad; ?>">*
                                                                                    Este campo es requerido</small>
                                                                            </div>
                                                                        </div> 
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Cargo - Actividad Principal</label>
                                                                                <select class="form-control" id="id_actividad<?php echo $id_subactividad; ?>" style="width:100%" disabled>
                                                                                    <option value="">SELECCIONAR</option>
                                                                                    <?php
                                                                                    foreach ($actividad_principal_datos as $actividad_principal_dato) {
                                                                                        $nombre_cargo_tabla = $actividad_principal_dato['nombre_cargo'];
                                                                                        $nombre_actividad_tabla = $actividad_principal_dato['nombre_actividad'];
                                                                                        $id_actividad_principal = $actividad_principal_dato['id_actividad_principal']; ?>
                                                                                        <option
                                                                                            value="<?php echo $id_actividad_principal; ?>"
                                                                                            <?php if ($nombre_actividad_tabla == $nombre_actividad_principal && $nombre_cargo_tabla== $nombre_cargo) { ?> selected="selected" <?php } ?>>
                                                                                            <?php echo $nombre_cargo_tabla." - ".$nombre_actividad_tabla; ?>
                                                                                        </option>
                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                                <small style="color: red; display: none" id="lbl_update2<?php echo $id_subactividad; ?>">*Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger"
                                                                        id="btn_delete<?php echo $id_subactividad; ?>"><i
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
                                                        $('#btn_delete<?php echo $id_subactividad; ?>').click(function () {

                                                            var id_subactividad = '<?php echo $id_subactividad; ?>';


                                                            var url = "../app/controllers/subactividad/ocultar_subactividad.php";
                                                            $.get(url, { id_subactividad: id_subactividad }, function (datos) {
                                                                $('#respuesta_delete<?php echo $id_subactividad; ?>').html(datos);
                                                            });

                                                        });
                                                    </script>
                                                    <div id="respuesta_delete<?php echo $id_subactividad; ?>"></div>

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
                "infoFiltered": "(Filtrado de _MAX_ total Subactividades)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Subactividades",
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: black; color: white">
                <h4 class="modal-title">Registrar Nueva Subactividad</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Nombre de Subactividad</label>
                            <input type="text" id="nombre_subactividad" class="form-control ">
                            <small style="color: red; display: none" id="lbl_create">* Este campo es requerido</small>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Cargo - Actividad Principal</label>
                            <select class="form-control " id="id_actividad" style="width:100%" required>
                                <option value="">SELECCIONAR</option>
                                <?php
                                foreach ($actividad_principal_datos as $actividad_principal_dato) { ?>
                                    <option value="<?php echo $actividad_principal_dato['id_actividad_principal']; ?>">
                                        <?php echo $actividad_principal_dato['nombre_cargo']." - ".$actividad_principal_dato['nombre_actividad']; ?>
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
        var nombre_subactividad = $('#nombre_subactividad').val();
        var id_actividad = $('#id_actividad').val();

        if (nombre_subactividad == "") {
            $('#nombre_subactividad').focus();
            $('#lbl_create').css('display', 'block');
        } else if (id_actividad == "") {
            $('#id_actividad').focus();
            $('#lbl_create2').css('display', 'block');
        } else {
            var url = "../app/controllers/subactividad/create.php";
            $.get(url, { nombre_subactividad: nombre_subactividad, id_actividad: id_actividad }, function (datos) {
                $('#respuesta').html(datos);
            });
        }

    });
</script>

<script>
    $(document).ready(function () {
        $('#id_actividad').select2({
            theme: 'bootstrap4',
        });
    });
</script>

<div id="respuesta"></div>