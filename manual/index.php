<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');

include ('../app/controllers/manual/listado_de_manual.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1 class="m-0"><b>Consulta de Manual de Usuario</b>
                        <button type="button" class="btn btn-default bg-primary" data-toggle="modal"
                            data-target="#modal-create">
                            <i class="bi bi-plus-circle"></i> Agregar Nuevo Manual
                        </button>
                        
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="fa fa-book"></i> Manual</li>
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
                            <h3 class="card-title">MANUAL DE USUARIO REGISTRADO</h3>
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
                                            <center>Nombre de Manual</center>
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
                                    foreach ($manual_datos as $manual_dato) {
                                        $id_manual = $manual_dato['id_manual'];
                                        ?>
                                        <tr>
                                            <td>
                                                <center>
                                                    <?php echo $contador = $contador + 1; ?>
                                                </center>
                                            </td>
                                            <td>
                                                <?php echo $manual_dato['nombre_manual']; ?>

                                            </td>

                                            <td>
                                                <a href="../app/controllers/manual/download.php?id=<?php echo $id_manual; ?>"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fas fa-download"></i></a>
                                            </td>
                                            <td>
                                                <center>
                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                                                        data-target="#modal-update<?php echo $id_manual; ?>">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                                        data-target="#modal-delete<?php echo $id_manual; ?>"> <i
                                                            class="fa fa-trash"></i>
                                                    </button>

                                                    <div class="modal fade" id="modal-update<?php echo $id_manual; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header"
                                                                    style="background-color: black; color: white">
                                                                    <h4 class="modal-title">Actualizar Manual</h4>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="../app/controllers/manual/update.php"
                                                                        method="post" enctype="multipart/form-data">
                                                                        <div class="form-row">
                                                                            <input type="text" name="id_manual"
                                                                                value="<?php echo $id_manual; ?>" hidden>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label class="float-left">Nombre del
                                                                                        Manual</label>
                                                                                    <input
                                                                                        class="form-control form-control-sm"
                                                                                        type="text" name="nombre_manual"
                                                                                        value="<?php echo $manual_dato['nombre_manual']; ?>"
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
                                                                                        value="<?php echo $manual_dato['archivo']; ?>"
                                                                                        disabled>

                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        class="float-left"></label>
                                                                                    <input type="file"
                                                                                        class="form-control-file"
                                                                                        name="archivo" >

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


                                                    <div class="modal fade" id="modal-delete<?php echo $id_manual; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background-color: black; color: white;">
                                                                    <h4 class="modal-title">Eliminar Manual</h4>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="../app/controllers/manual/ocultar_manual.php"
                                                                        method="post">
                                                                        <div class="form-row">
                                                                            <input type="text" name="id_manual"
                                                                                value="<?php echo $id_manual; ?>" hidden>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label class="float-left">Nombre del
                                                                                        Manual</label>
                                                                                    <input
                                                                                        class="form-control form-control-sm"
                                                                                        type="text" name="nombre_manual"
                                                                                        value="<?php echo $manual_dato['nombre_manual']; ?>"
                                                                                        disabled>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        class="float-left">Archivo</label>
                                                                                    <input
                                                                                        class="form-control form-control-sm"
                                                                                        type="text" name="archivo"
                                                                                        value="<?php echo $manual_dato['archivo']; ?>"
                                                                                        disabled>

                                                                                </div>
                                                                            </div>

                                                                            <hr width=100%>

                                                                            <div class="form-group col-md-12" align="right">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary"><i
                                                                                        class="bi bi-floppy-fill"></i>
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
                "infoFiltered": "(Filtrado de _MAX_ total manual)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ manual",
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
                <h4 class="modal-title">Registrar Nuevo Manual</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../app/controllers/manual/create.php" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Nombre del Manual</label>
                                <input class="form-control form-control-sm" type="text" name="nombre_manual" required>
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