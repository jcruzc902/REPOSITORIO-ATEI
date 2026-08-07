<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');


include ('../app/controllers/resolucion_rectoral/listado_resolucion_tyt.php');


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1 class="m-0"><b>Consulta de Resolucion Rectoral</b>
                        <button type="button" class="btn btn-default bg-primary" data-toggle="modal"
                            data-target="#modal-create">
                            <i class="bi bi-plus-circle"></i> Agregar Nueva Resolucion Rectoral
                        </button>

                    </h1>

                </div><!-- /.col -->
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-check2-square"></i> Resolucion Rectoral</li>
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
                            <h3 class="card-title">RESOLUCIONES REGISTRADO</h3>
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
                                            <center>Resolucion Rectoral</center>
                                        </th>
                                        <th>
                                            <center>Archivo</center>
                                        </th>
                                        <th>
                                            <center>Acciones</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($resolucion_tyt_datos as $resolucion_tyt_dato) {
                                        $id_resoluciones_tyt = $resolucion_tyt_dato['id_resoluciones_tyt'];
                                        $nombre_resolucion_tyt = $resolucion_tyt_dato['nombre_resolucion_tyt'];
                                        ?>
                                        <tr>
                                            <td>
                                                <center>
                                                    <?php echo $contador = $contador + 1; ?>
                                                </center>
                                            </td>
                                            <td>
                                                <?php echo $resolucion_tyt_dato['nombre_resolucion_tyt']; ?>
                                            </td>
                                            <td>
                                                <?php echo $resolucion_tyt_dato['archivo']; ?>
                                            </td>
                                            <td>
                                                <center>

                                                    <a href="../app/controllers/resolucion_rectoral/download.php?id=<?php echo $id_resoluciones_tyt; ?>"
                                                        class="btn btn-sm bg-warning" target="_blank">
                                                        <i class="bi bi-printer"></i></a>

                                                    <button type="button" class="btn btn-sm btn-default bg-success"
                                                        data-toggle="modal"
                                                        data-target="#modal-update<?php echo $id_resoluciones_tyt; ?>">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-sm btn-default bg-danger"
                                                        data-toggle="modal"
                                                        data-target="#modal-delete<?php echo $id_resoluciones_tyt; ?>"> <i
                                                            class="fa fa-trash"></i>
                                                    </button>

                                                    <div class="modal fade"
                                                        id="modal-update<?php echo $id_resoluciones_tyt; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header"
                                                                    style="background-color: black; color: white">
                                                                    <h4 class="modal-title">Actualizar Resolucion Rectoral
                                                                    </h4>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="../app/controllers/resolucion_rectoral/update.php"
                                                                        method="post" enctype="multipart/form-data">
                                                                        <div class="form-row">
                                                                            <input type="text" name="id_resoluciones_tyt"
                                                                                value="<?php echo $id_resoluciones_tyt; ?>"
                                                                                hidden>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label class="float-left">Nombre de la
                                                                                        resolucion rectoral</label>
                                                                                    <input
                                                                                        class="form-control form-control-sm"
                                                                                        type="text"
                                                                                        name="nombre_resolucion_tyt"
                                                                                        value="<?php echo $resolucion_tyt_dato['nombre_resolucion_tyt']; ?>"
                                                                                        required>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        class="float-left">Archivo</label>
                                                                                    <input
                                                                                        class="form-control form-control-sm"
                                                                                        type="text"
                                                                                        value="<?php echo $resolucion_tyt_dato['archivo']; ?>"
                                                                                        disabled>

                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label class="float-left"></label>
                                                                                    <input type="file"
                                                                                        class="form-control-file"
                                                                                        name="archivo">

                                                                                </div>
                                                                            </div>

                                                                            <hr width=100%>

                                                                            <div class="form-group col-md-12" align="right">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary"><i
                                                                                        class="bi bi-floppy-fill"></i>
                                                                                    Guardar</button>
                                                                                <a href="index" class="btn"
                                                                                    data-dismiss="modal"
                                                                                    style="background-color: grey; color: white;"><i
                                                                                        class="bi bi-x-circle-fill"></i>
                                                                                    Cancelar</a>

                                                                            </div>
                                                                        </div>

                                                                    </form>

                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- /.modal -->






                                                    <div class="modal fade"
                                                        id="modal-delete<?php echo $id_resoluciones_tyt; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header"
                                                                    style="background-color: black; color: white;">
                                                                    <h4 class="modal-title">Eliminar Resolucion Rectoral
                                                                    </h4>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="../app/controllers/resolucion_rectoral/ocultar_resolucion.php"
                                                                        method="post" enctype="multipart/form-data">
                                                                        <div class="form-row">
                                                                            <input type="text" name="id_resoluciones_tyt"
                                                                                value="<?php echo $id_resoluciones_tyt; ?>"
                                                                                hidden>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label class="float-left">Nombre de la
                                                                                        resolucion rectoral</label>
                                                                                    <input
                                                                                        class="form-control form-control-sm"
                                                                                        type="text"
                                                                                        name="nombre_resolucion_tyt"
                                                                                        value="<?php echo $resolucion_tyt_dato['nombre_resolucion_tyt']; ?>"
                                                                                        disabled>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        class="float-left">Archivo</label>
                                                                                    <input
                                                                                        class="form-control form-control-sm"
                                                                                        type="text"
                                                                                        value="<?php echo $resolucion_tyt_dato['archivo']; ?>"
                                                                                        disabled>

                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label class="float-left"></label>
                                                                                    <input type="file"
                                                                                        class="form-control-file"
                                                                                        name="archivo" disabled>

                                                                                </div>
                                                                            </div>

                                                                            <hr width=100%>

                                                                            <div class="form-group col-md-12" align="right">
                                                                                <button type="submit"
                                                                                    class="btn btn-danger"><i
                                                                                        class="fa fa-trash"></i>
                                                                                    Eliminar</button>
                                                                                <a href="index" class="btn"
                                                                                    data-dismiss="modal"
                                                                                    style="background-color: grey; color: white;"><i
                                                                                        class="bi bi-x-circle-fill"></i>
                                                                                    Cancelar</a>

                                                                            </div>
                                                                        </div>

                                                                    </form>
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
                "infoFiltered": "(Filtrado de _MAX_ total Resoluciones)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Resoluciones",
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
                <h4 class="modal-title">Registrar Nueva Resolucion Rectoral</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../app/controllers/resolucion_rectoral/create.php" method="post"
                    enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Nombre de Resolucion Rectoral</label>
                                <input class="form-control form-control-sm" type="text"
                                    name="nombre_resolucion_rectoral" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Archivo</label>
                                <input class="form-control-file" type="file" name="archivo" required>

                            </div>
                        </div>

                        <hr width=100%>


                        <div class="form-group col-md-12" align="right">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i>
                                Guardar</button>
                            <a href="index" class="btn" data-dismiss="modal"
                                style="background-color: grey; color: white;"><i class="bi bi-x-circle-fill"></i>
                                Cancelar</a>

                        </div>
                    </div>

                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->