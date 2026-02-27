<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');


include ('../app/controllers/referencia_tyt/listado_referencia_tyt.php');


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1 class="m-0"><b>Consulta de Referencia</b>
                        <button type="button" class="btn btn-default bg-primary" data-toggle="modal"
                            data-target="#modal-create">
                            <i class="bi bi-plus-circle"></i> Agregar Nueva Referencia
                        </button>

                    </h1>

                </div><!-- /.col -->
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-check2-square"></i> Referencia</li>
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
                            <h3 class="card-title">REFERENCIAS REGISTRADO</h3>
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
                                            <center>Referencia</center>
                                        </th>
                                        <th>
                                            <center>Acciones</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($referencia_tyt_datos as $referencia_tyt_dato) {
                                        $id_referencia_tyt = $referencia_tyt_dato['id_referencia_tyt'];
                                        $nombre_referencia = $referencia_tyt_dato['nombre_referencia'];
                                        ?>
                                        <tr>
                                            <td>
                                                <center>
                                                    <?php echo $contador = $contador + 1; ?>
                                                </center>
                                            </td>
                                            <td>
                                                <?php echo mb_strtoupper($referencia_tyt_dato['nombre_referencia']); ?>
                                            </td>
                                            <td>
                                                <center>



                                                    <button type="button" class="btn btn-sm btn-default bg-success"
                                                        data-toggle="modal"
                                                        data-target="#modal-update<?php echo $id_referencia_tyt; ?>">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-sm btn-default bg-danger"
                                                        data-toggle="modal"
                                                        data-target="#modal-delete<?php echo $id_referencia_tyt; ?>"> <i
                                                            class="fa fa-trash"></i>
                                                    </button>

                                                    <div class="modal fade"
                                                        id="modal-update<?php echo $id_referencia_tyt; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header"
                                                                    style="background-color: black; color: white">
                                                                    <h4 class="modal-title">Actualizar Referencia</h4>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Nombre de referencia</label>
                                                                                <input type="text"
                                                                                    id="nombre_referencia<?php echo $id_referencia_tyt; ?>"
                                                                                    value="<?php echo $nombre_referencia; ?>" 
                                                                                    class="form-control ">
                                                                                <small style="color: red; display: none"
                                                                                    id="lbl_update<?php echo $id_referencia_tyt; ?>">*
                                                                                    Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer ">
                                                                    <button type="button" class="btn btn-primary"
                                                                        id="btn_update<?php echo $id_referencia_tyt; ?>"><i
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
                                                        $('#btn_update<?php echo $id_referencia_tyt; ?>').click(function () {
                                                            var nombre_referencia = $('#nombre_referencia<?php echo $id_referencia_tyt; ?>').val();
                                                            var id_referencia_tyt = '<?php echo $id_referencia_tyt; ?>';

                                                            if (nombre_referencia == "") {
                                                                $('#nombre_referencia<?php echo $id_referencia_tyt; ?>').focus();
                                                                $('#lbl_update<?php echo $id_referencia_tyt; ?>').css('display', 'block');
                                                            } else {
                                                                var url = "../app/controllers/referencia_tyt/update.php";
                                                                $.get(url, { nombre_referencia: nombre_referencia, id_referencia_tyt: id_referencia_tyt }, function (datos) {
                                                                    $('#respuesta_update<?php echo $id_referencia_tyt; ?>').html(datos);
                                                                });
                                                            }
                                                        });
                                                    </script>
                                                    <div id="respuesta_update<?php echo $id_referencia_tyt; ?>"></div>





                                                    <div class="modal fade"
                                                        id="modal-delete<?php echo $id_referencia_tyt; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header"
                                                                    style="background-color: black; color: white;">
                                                                    <h4 class="modal-title">Eliminar Referencia
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
                                                                                <label class="float-left">Nombre de referencia</label>
                                                                                <input type="text"
                                                                                    id="nombre_referencia<?php echo $id_referencia_tyt; ?>"
                                                                                    value="<?php echo $nombre_referencia; ?>"
                                                                                    class="form-control " disabled>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger"
                                                                        id="btn_delete<?php echo $id_referencia_tyt; ?>"><i
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
                                                        $('#btn_delete<?php echo $id_referencia_tyt; ?>').click(function () {

                                                            var id_referencia_tyt = '<?php echo $id_referencia_tyt; ?>';


                                                            var url = "../app/controllers/referencia_tyt/ocultar_referencia.php";
                                                            $.get(url, { id_referencia_tyt: id_referencia_tyt }, function (datos) {
                                                                $('#respuesta_delete<?php echo $id_referencia_tyt; ?>').html(datos);
                                                            });

                                                        });
                                                    </script>
                                                    <div id="respuesta_delete<?php echo $id_referencia_tyt; ?>"></div>

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
                "infoFiltered": "(Filtrado de _MAX_ total Referencias)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Referencias",
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
                <h4 class="modal-title">Registrar Nueva Referencia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Nombre de Referencia</label>
                            <input type="text" id="nombre_referencia" class="form-control ">
                            <small style="color: red; display: none" id="lbl_create">* Este campo es requerido</small>
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
        var nombre_referencia = $('#nombre_referencia').val();

        if (nombre_referencia == "") {
            $('#nombre_referencia').focus();
            $('#lbl_create').css('display', 'block');
        } else {
            var url = "../app/controllers/referencia_tyt/create.php";
            $.get(url, { nombre_referencia: nombre_referencia }, function (datos) {
                $('#respuesta').html(datos);
            });
        }

    });
</script>
<div id="respuesta"></div>