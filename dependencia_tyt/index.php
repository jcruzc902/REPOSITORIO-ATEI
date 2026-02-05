<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');


include('../app/controllers/dependencia_tyt/listado_dependencia_tyt.php');


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1 class="m-0"><b>Consulta de Dependencia</b>
                        <button type="button" class="btn btn-default bg-primary" data-toggle="modal"
                            data-target="#modal-create">
                            <i class="bi bi-plus-circle"></i> Agregar Nueva Dependencia
                        </button>

                    </h1>

                </div><!-- /.col -->
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-check2-square"></i> Dependencia</li>
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
                            <h3 class="card-title">DEPENDENCIAS REGISTRADO</h3>
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
                                            <center>Dependencia</center>
                                        </th>
                                        <th>
                                            <center>Codigo de facultad</center>
                                        </th>

                                        <th>
                                            <center>Acciones</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($dependencia_tyt_datos as $dependencia_tyt_dato) {
                                        $id_dependencias_tyt = $dependencia_tyt_dato['id_dependencias_tyt'];
                                        $nombre_dependencias_tyt = $dependencia_tyt_dato['nombre_dependencias_tyt'];
                                        $codigo_facultad = $dependencia_tyt_dato['codigo_facultad'];
                                        ?>
                                        <tr>
                                            <td>
                                                <center>
                                                    <?php echo $contador = $contador + 1; ?>
                                                </center>
                                            </td>
                                            <td>
                                                <?php echo mb_strtoupper($dependencia_tyt_dato['nombre_dependencias_tyt']); ?>
                                            </td>
                                            <td>
                                                <?php echo mb_strtoupper($dependencia_tyt_dato['codigo_facultad']); ?>
                                            </td>

                                            <td>
                                                <center>



                                                    <button type="button" class="btn btn-sm btn-default bg-success"
                                                        data-toggle="modal"
                                                        data-target="#modal-update<?php echo $id_dependencias_tyt; ?>">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-sm btn-default bg-danger"
                                                        data-toggle="modal"
                                                        data-target="#modal-delete<?php echo $id_dependencias_tyt; ?>"> <i
                                                            class="fa fa-trash"></i>
                                                    </button>

                                                    <div class="modal fade"
                                                        id="modal-update<?php echo $id_dependencias_tyt; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header"
                                                                    style="background-color: black; color: white">
                                                                    <h4 class="modal-title">Actualizar Dependencia</h4>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Nombre de
                                                                                    dependencia</label>
                                                                                <input type="text"
                                                                                    id="nombre_dependencias_tyt<?php echo $id_dependencias_tyt; ?>"
                                                                                    value="<?php echo $nombre_dependencias_tyt; ?>"
                                                                                    class="form-control ">
                                                                                <small style="color: red; display: none"
                                                                                    id="lbl_update<?php echo $id_dependencias_tyt; ?>">*
                                                                                    Este campo es requerido</small>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Codigo de
                                                                                    Facultad</label>
                                                                                <input type="text"
                                                                                    id="codigo_facultad<?php echo $id_dependencias_tyt; ?>"
                                                                                    value="<?php echo $codigo_facultad; ?>"
                                                                                    class="form-control ">
                                                                                <small style="color: red; display: none"
                                                                                    id="lbl_update2<?php echo $id_dependencias_tyt; ?>">*
                                                                                    Este campo es requerido</small>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer ">
                                                                    <button type="button" class="btn btn-primary"
                                                                        id="btn_update<?php echo $id_dependencias_tyt; ?>"><i
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
                                                        $('#btn_update<?php echo $id_dependencias_tyt; ?>').click(function () {
                                                            var nombre_dependencias_tyt = $('#nombre_dependencias_tyt<?php echo $id_dependencias_tyt; ?>').val();
                                                            var codigo_facultad = $('#codigo_facultad<?php echo $id_dependencias_tyt; ?>').val();
                                                            var id_dependencias_tyt = '<?php echo $id_dependencias_tyt; ?>';

                                                            if (nombre_dependencias_tyt == "") {
                                                                $('#nombre_dependencias_tyt<?php echo $id_dependencias_tyt; ?>').focus();
                                                                $('#lbl_update<?php echo $id_dependencias_tyt; ?>').css('display', 'block');
                                                            } else if (codigo_facultad == "") {
                                                                $('#codigo_facultad<?php echo $id_dependencias_tyt; ?>').focus();
                                                                $('#lbl_update2<?php echo $id_dependencias_tyt; ?>').css('display', 'block');
                                                            } else {
                                                                var url = "../app/controllers/dependencia_tyt/update.php";
                                                                $.get(url, { nombre_dependencias_tyt: nombre_dependencias_tyt, codigo_facultad: codigo_facultad, id_dependencias_tyt: id_dependencias_tyt }, function (datos) {
                                                                    $('#respuesta_update<?php echo $id_dependencias_tyt; ?>').html(datos);
                                                                });
                                                            }
                                                        });
                                                    </script>
                                                    <div id="respuesta_update<?php echo $id_dependencias_tyt; ?>"></div>





                                                    <div class="modal fade"
                                                        id="modal-delete<?php echo $id_dependencias_tyt; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header"
                                                                    style="background-color: black; color: white;">
                                                                    <h4 class="modal-title">Eliminar Dependencia
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
                                                                                <label class="float-left">Nombre de
                                                                                    dependencia</label>
                                                                                <input type="text"
                                                                                    id="nombre_dependencias_tyt<?php echo $id_dependencias_tyt; ?>"
                                                                                    value="<?php echo $nombre_dependencias_tyt; ?>"
                                                                                    class="form-control " disabled>

                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Codigo de
                                                                                    Facultad</label>
                                                                                <input type="text"
                                                                                    id="codigo_facultad<?php echo $id_dependencias_tyt; ?>"
                                                                                    value="<?php echo $codigo_facultad; ?>"
                                                                                    class="form-control " disabled>
                                                                                <small style="color: red; display: none"
                                                                                    id="lbl_update2<?php echo $id_dependencias_tyt; ?>">*
                                                                                    Este campo es requerido</small>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger"
                                                                        id="btn_delete<?php echo $id_dependencias_tyt; ?>"><i
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
                                                        $('#btn_delete<?php echo $id_dependencias_tyt; ?>').click(function () {

                                                            var id_dependencias_tyt = '<?php echo $id_dependencias_tyt; ?>';

                                                            var url = "../app/controllers/dependencia_tyt/ocultar_dependencia.php";
                                                            $.get(url, { id_dependencias_tyt: id_dependencias_tyt }, function (datos) {
                                                                $('#respuesta_delete<?php echo $id_dependencias_tyt; ?>').html(datos);
                                                            });

                                                        });
                                                    </script>
                                                    <div id="respuesta_delete<?php echo $id_dependencias_tyt; ?>"></div>

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
                "infoFiltered": "(Filtrado de _MAX_ total Dependencias)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Dependencias",
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
                <h4 class="modal-title">Registrar Nueva Dependencia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Nombre de Dependencia</label>
                            <input type="text" id="nombre_dependencia" class="form-control ">
                            <small style="color: red; display: none" id="lbl_create">* Este campo es requerido</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Codigo de facultad</label>
                            <input type="text" id="codigo_facultad" class="form-control ">
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
        var nombre_dependencia = $('#nombre_dependencia').val();
        var codigo_facultad = $('#codigo_facultad').val();

        if (nombre_dependencia == "") {
            $('#nombre_dependencia').focus();
            $('#lbl_create').css('display', 'block');
        } else if (codigo_facultad == "") {
            $('#codigo_facultad').focus();
            $('#lbl_create2').css('display', 'block');
        } else {
            var url = "../app/controllers/dependencia_tyt/create.php";
            $.get(url, { nombre_dependencia: nombre_dependencia, codigo_facultad: codigo_facultad }, function (datos) {
                $('#respuesta').html(datos);
            });
        }

    });
</script>
<div id="respuesta"></div>