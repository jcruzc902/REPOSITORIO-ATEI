<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');


include ('../app/controllers/empresas/listado_de_empresas.php');


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1 class="m-0"><b>Consulta de Empresas</b>
                        <button type="button" class="btn btn-default bg-primary" data-toggle="modal"
                            data-target="#modal-create">
                            <i class="bi bi-plus-circle"></i> Agregar Nueva Empresa
                        </button>
                        <a href="<?php echo $URL; ?>/app/controllers/empresas/exportar_excel" type="button"
                            class="btn btn-default bg-success">
                            <i class="bi bi-file-earmark-excel"></i> Exportar a Excel
                        </a>
                    </h1>

                </div><!-- /.col -->
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-building"></i> Empresas</li>
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
                            <h3 class="card-title">EMPRESAS REGISTRADO</h3>
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
                                            <center>Razon Social</center>
                                        </th>
                                        <th>
                                            <center>Nro. de RUC</center>
                                        </th>
                                        <th>
                                            <center>Acciones</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($empresas_datos as $empresas_dato) {
                                        $id_empresa = $empresas_dato['id_empresa'];
                                        $nombre_empresa = $empresas_dato['razon_social'];
                                        $ruc_empresa = $empresas_dato['ruc'];
                                        ?>
                                        <tr>
                                            <td>
                                                <center>
                                                    <?php echo $contador = $contador + 1; ?>
                                                </center>
                                            </td>
                                            <td>
                                                <?php echo $empresas_dato['razon_social']; ?>
                                            </td>
                                            <td>
                                                <?php echo $empresas_dato['ruc']; ?>
                                            </td>
                                            <td>
                                                <center>


                                                    <button type="button" class="btn btn-sm bg-success"
                                                        data-toggle="modal"
                                                        data-target="#modal-update<?php echo $id_empresa; ?>">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-sm bg-danger"
                                                        data-toggle="modal"
                                                        data-target="#modal-delete<?php echo $id_empresa; ?>"> <i
                                                            class="fa fa-trash"></i>
                                                    </button>

                                                    <div class="modal fade" id="modal-update<?php echo $id_empresa; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header"
                                                                    style="background-color: black; color: white">
                                                                    <h4 class="modal-title">Actualizar
                                                                        Empresa</h4>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Razón
                                                                                    Social</label>
                                                                                <input type="text"
                                                                                    id="nombre_empresa<?php echo $id_empresa; ?>"
                                                                                    value="<?php echo $nombre_empresa; ?>"
                                                                                    class="form-control form-control-sm">
                                                                                <small style="color: red; display: none"
                                                                                    id="lbl_1<?php echo $id_empresa; ?>">*
                                                                                    Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Nro. de
                                                                                    RUC</label>
                                                                                <input type="text"
                                                                                    id="ruc_empresa<?php echo $id_empresa; ?>"
                                                                                    value="<?php echo $ruc_empresa; ?>"
                                                                                    class="form-control form-control-sm">
                                                                                <small style="color: red; display: none"
                                                                                    id="lbl_2<?php echo $id_empresa; ?>">*
                                                                                    Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer ">
                                                                    <button type="button" class="btn btn-primary"
                                                                        id="btn_update<?php echo $id_empresa; ?>"><i
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
                                                        $('#btn_update<?php echo $id_empresa; ?>').click(function () {
                                                            var nombre_empresa = $('#nombre_empresa<?php echo $id_empresa; ?>').val();
                                                            var ruc_empresa = $('#ruc_empresa<?php echo $id_empresa; ?>').val();
                                                            var id_empresa = '<?php echo $id_empresa; ?>';

                                                            if (nombre_empresa == "") {
                                                                $('#nombre_empresa<?php echo $id_empresa; ?>').focus();
                                                                $('#lbl_1<?php echo $id_empresa; ?>').css('display', 'block');
                                                            } else if (ruc_empresa == "") {
                                                                $('#ruc_empresa<?php echo $id_empresa; ?>').focus();
                                                                $('#lbl_2<?php echo $id_empresa; ?>').css('display', 'block');
                                                            } else {
                                                                var url = "../app/controllers/empresas/update.php";
                                                                $.get(url, { nombre_empresa: nombre_empresa, ruc_empresa: ruc_empresa, id_empresa: id_empresa }, function (datos) {
                                                                    $('#respuesta_update<?php echo $id_empresa; ?>').html(datos);
                                                                });
                                                            }
                                                        });
                                                    </script>
                                                    <div id="respuesta_update<?php echo $id_empresa; ?>"></div>




                                                    <div class="modal fade" id="modal-delete<?php echo $id_empresa; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background-color: black; color: white;">
                                                                    <h4 class="modal-title">Eliminar Empresa</h4>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Razón
                                                                                    Social</label>
                                                                                <input type="text"
                                                                                    id="nombre_dependencia<?php echo $id_empresa; ?>"
                                                                                    value="<?php echo $nombre_empresa; ?>"
                                                                                    class="form-control form-control-sm"
                                                                                    disabled>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Nro. de
                                                                                    RUC</label>
                                                                                <input type="text"
                                                                                    id="nombre_dependencia<?php echo $id_empresa; ?>"
                                                                                    value="<?php echo $ruc_empresa; ?>"
                                                                                    class="form-control form-control-sm"
                                                                                    disabled>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">

                                                                    <button type="button" class="btn btn-danger"
                                                                        id="btn_delete<?php echo $id_empresa; ?>"><i
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
                                                        $('#btn_delete<?php echo $id_empresa; ?>').click(function () {

                                                            var id_empresa = '<?php echo $id_empresa; ?>';


                                                            var url = "../app/controllers/empresas/ocultar_empresa.php";
                                                            $.get(url, { id_empresa: id_empresa }, function (datos) {
                                                                $('#respuesta_delete<?php echo $id_empresa; ?>').html(datos);
                                                            });

                                                        });
                                                    </script>
                                                    <div id="respuesta_delete<?php echo $id_empresa; ?>"></div>

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
                "infoFiltered": "(Filtrado de _MAX_ total Empresas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Empresas",
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
                <h4 class="modal-title">Registrar Nueva Empresa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Razón Social</label>
                            <input type="text" id="nombre_empresa" class="form-control form-control-sm">
                            <small style="color: red; display: none" id="lbl_1">* Este campo es requerido</small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Nro. de RUC</label>
                            <input type="text" id="ruc_empresa" class="form-control form-control-sm">
                            <small style="color: red; display: none" id="lbl_2">* Este campo es requerido</small>
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
        var nombre_empresa = $('#nombre_empresa').val();
        var ruc_empresa = $('#ruc_empresa').val();

        if (nombre_empresa == "") {
            $('#nombre_empresa').focus();
            $('#lbl_1').css('display', 'block');
        } else if (ruc_empresa == "") {
            $('#ruc_empresa').focus();
            $('#lbl_2').css('display', 'block');
        } else {
            var url = "../app/controllers/empresas/create.php";
            $.get(url, { nombre_empresa: nombre_empresa, ruc_empresa: ruc_empresa }, function (datos) {
                $('#respuesta').html(datos);
            });
        }

    });
</script>
<div id="respuesta"></div>