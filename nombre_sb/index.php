<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');


include ('../app/controllers/cuenta_tyt/listado_cuenta_tyt.php');
include ('../app/controllers/nombre_cuenta/listado_nombre_cuenta.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1 class="m-0"><b>Consulta de Nombre Cuenta</b>
                        <button type="button" class="btn btn-default bg-primary" data-toggle="modal"
                            data-target="#modal-create">
                            <i class="bi bi-plus-circle"></i> Agregar Nuevo Nombre Cuenta
                        </button>

                    </h1>

                </div><!-- /.col -->
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-check2-square"></i> Nombre Cuenta</li>
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
                            <h3 class="card-title">NOMBRES REGISTRADO</h3>
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
                                            <center>Nombre de la Cuenta</center>
                                        </th>
                                        <th>
                                            <center>Numero de Cuenta</center>
                                        </th>
                                        <th>
                                            <center>Banco</center>
                                        </th>
                                        <th>
                                            <center>Acciones</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($nombre_cuenta_datos as $nombre_cuenta_dato) {
                                        $id_nombre_cuenta = $nombre_cuenta_dato['id_nombre_cuenta'];
                                        $nombre_cuenta = $nombre_cuenta_dato['nombre_cuenta'];
                                        $numero_cuenta_tyt = $nombre_cuenta_dato['numero_cuenta_tyt'];
                                        $nombre_banco = $nombre_cuenta_dato['nombre_banco'];
                                        ?>
                                        <tr>
                                            <td>
                                                <center>
                                                    <?php echo $contador = $contador + 1; ?>
                                                </center>
                                            </td>
                                            <td>
                                                <?php echo mb_strtoupper($nombre_cuenta_dato['nombre_cuenta']); ?>
                                            </td>
                                            <td>
                                                <?php echo mb_strtoupper($nombre_cuenta_dato['numero_cuenta_tyt']); ?>
                                            </td>
                                            <td>
                                                <?php echo mb_strtoupper($nombre_cuenta_dato['nombre_banco']); ?>
                                            </td>
                                            <td>
                                                <center>



                                                    <button type="button" class="btn btn-sm btn-default bg-success"
                                                        data-toggle="modal"
                                                        data-target="#modal-update<?php echo $id_nombre_cuenta; ?>">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-sm btn-default bg-danger"
                                                        data-toggle="modal"
                                                        data-target="#modal-delete<?php echo $id_nombre_cuenta; ?>">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                    <div class="modal fade"
                                                        id="modal-update<?php echo $id_nombre_cuenta; ?>">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header"
                                                                    style="background-color: black; color: white">
                                                                    <h4 class="modal-title">Actualizar Nombre Cuenta
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
                                                                                <label class="float-left">Nombre de Cuenta</label>
                                                                                <input type="text"
                                                                                    id="nombre_cuenta<?php echo $id_nombre_cuenta; ?>"
                                                                                    value="<?php echo $nombre_cuenta; ?>"
                                                                                    class="form-control ">
                                                                                <small style="color: red; display: none"
                                                                                    id="lbl_update<?php echo $id_nombre_cuenta; ?>">*
                                                                                    Este campo es requerido</small>
                                                                            </div>
                                                                        </div> 
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Banco - Numero Cuenta</label>
                                                                                <select class="form-control" id="id_banco_cuenta<?php echo $id_nombre_cuenta; ?>" style="width:100%">
                                                                                    <option value="">SELECCIONAR</option>
                                                                                    <?php
                                                                                    foreach ($cuenta_tyt_datos as $cuenta_tyt_dato) {
                                                                                        $nombre_banco_tabla = $cuenta_tyt_dato['nombre_banco'];
                                                                                        $numero_cuenta_tabla = $cuenta_tyt_dato['numero_cuenta_tyt'];
                                                                                        $id_cuenta_tyt = $cuenta_tyt_dato['id_cuenta_tyt']; ?>
                                                                                        <option
                                                                                            value="<?php echo $id_cuenta_tyt; ?>"
                                                                                            <?php if ($nombre_banco_tabla == $nombre_banco && $numero_cuenta_tabla== $numero_cuenta_tyt) { ?> selected="selected" <?php } ?>>
                                                                                            <?php echo $nombre_banco_tabla." - ".$numero_cuenta_tabla; ?>
                                                                                        </option>
                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                                <small style="color: red; display: none"
                                                                                    id="lbl_update2<?php echo $id_nombre_cuenta; ?>">*
                                                                                    Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer ">
                                                                    <button type="button" class="btn btn-primary"
                                                                        id="btn_update<?php echo $id_nombre_cuenta; ?>"><i
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
                                                        $('#btn_update<?php echo $id_nombre_cuenta; ?>').click(function () {
                                                            var nombre_cuenta = $('#nombre_cuenta<?php echo $id_nombre_cuenta; ?>').val();
                                                            var id_banco_cuenta = $('#id_banco_cuenta<?php echo $id_nombre_cuenta; ?>').val();
                                                            var id_nombre_cuenta= '<?php echo $id_nombre_cuenta; ?>';

                                                            if (nombre_cuenta == "") {
                                                                $('#nombre_cuenta<?php echo $id_nombre_cuenta; ?>').focus();
                                                                $('#lbl_update<?php echo $id_nombre_cuenta; ?>').css('display', 'block');
                                                            } else if (id_banco_cuenta == "") {
                                                                $('#id_banco_cuenta<?php echo $id_nombre_cuenta; ?>').focus();
                                                                $('#lbl_update2<?php echo $id_nombre_cuenta; ?>').css('display', 'block');
                                                            } else {
                                                                var url = "../app/controllers/nombre_cuenta/update.php";
                                                                $.get(url, { nombre_cuenta: nombre_cuenta, id_banco_cuenta: id_banco_cuenta, id_nombre_cuenta: id_nombre_cuenta}, function (datos) {
                                                                    $('#respuesta_update<?php echo $id_nombre_cuenta; ?>').html(datos);
                                                                });
                                                            }
                                                        });
                                                    </script>
                                                    <div id="respuesta_update<?php echo $id_nombre_cuenta; ?>"></div>





                                                    <div class="modal fade"
                                                        id="modal-delete<?php echo $id_nombre_cuenta; ?>">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header"
                                                                    style="background-color: black; color: white;">
                                                                    <h4 class="modal-title">Eliminar Nombre Cuenta
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
                                                                                <label class="float-left">Nombre de Cuenta</label>
                                                                                <input type="text"
                                                                                    id="nombre_cuenta<?php echo $id_nombre_cuenta; ?>"
                                                                                    value="<?php echo $nombre_cuenta; ?>"
                                                                                    class="form-control " disabled>
                                                                                <small style="color: red; display: none"
                                                                                    id="lbl_update<?php echo $id_nombre_cuenta; ?>">*
                                                                                    Este campo es requerido</small>
                                                                            </div>
                                                                        </div> 
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Banco - Numero Cuenta</label>
                                                                                <select class="form-control" id="id_banco_cuenta<?php echo $id_nombre_cuenta; ?>" style="width:100%" disabled>
                                                                                    <option value="">SELECCIONAR</option>
                                                                                    <?php
                                                                                    foreach ($cuenta_tyt_datos as $cuenta_tyt_dato) {
                                                                                        $nombre_banco_tabla = $cuenta_tyt_dato['nombre_banco'];
                                                                                        $numero_cuenta_tabla = $cuenta_tyt_dato['numero_cuenta_tyt'];
                                                                                        $id_cuenta_tyt = $cuenta_tyt_dato['id_cuenta_tyt']; ?>
                                                                                        <option
                                                                                            value="<?php echo $id_cuenta_tyt; ?>"
                                                                                            <?php if ($nombre_banco_tabla == $nombre_banco && $numero_cuenta_tabla== $numero_cuenta_tyt) { ?> selected="selected" <?php } ?>>
                                                                                            <?php echo $nombre_banco_tabla." - ".$numero_cuenta_tabla; ?>
                                                                                        </option>
                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                                <small style="color: red; display: none"
                                                                                    id="lbl_update2<?php echo $id_nombre_cuenta; ?>">*
                                                                                    Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger"
                                                                        id="btn_delete<?php echo $id_nombre_cuenta; ?>"><i
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
                                                        $('#btn_delete<?php echo $id_nombre_cuenta; ?>').click(function () {

                                                            var id_nombre_cuenta = '<?php echo $id_nombre_cuenta; ?>';

                                                            var url = "../app/controllers/nombre_cuenta/ocultar_nombre.php";
                                                            $.get(url, { id_nombre_cuenta: id_nombre_cuenta }, function (datos) {
                                                                $('#respuesta_delete<?php echo $id_nombre_cuenta; ?>').html(datos);
                                                            });

                                                        });
                                                    </script>
                                                    <div id="respuesta_delete<?php echo $id_nombre_cuenta; ?>"></div>

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
                "infoFiltered": "(Filtrado de _MAX_ total Nombres)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Nombres",
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
                <h4 class="modal-title">Registrar Nueva Nombre Cuenta</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Nombre de Cuenta</label>
                            <input type="text" id="nombre_cuenta" class="form-control ">
                            <small style="color: red; display: none" id="lbl_create">* Este campo es requerido</small>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Banco - Numero de Cuenta</label>
                            <select class="form-control " id="id_banco_cuenta" style="width:100%" required>
                                <option value="">SELECCIONAR</option>
                                <?php
                                foreach ($cuenta_tyt_datos as $cuenta_tyt_dato) { ?>
                                    <option value="<?php echo $cuenta_tyt_dato['id_cuenta_tyt']; ?>">
                                        <?php echo $cuenta_tyt_dato['nombre_banco']." - ".$cuenta_tyt_dato['numero_cuenta_tyt']; ?>
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
        var nombre_cuenta = $('#nombre_cuenta').val();
        var id_banco_cuenta = $('#id_banco_cuenta').val();

        if (nombre_cuenta == "") {
            $('#nombre_cuenta').focus();
            $('#lbl_create').css('display', 'block');
        } else if (id_banco_cuenta == "") {
            $('#id_banco_cuenta').focus();
            $('#lbl_create2').css('display', 'block');
        } else {
            var url = "../app/controllers/nombre_cuenta/create.php";
            $.get(url, { nombre_cuenta: nombre_cuenta, id_banco_cuenta: id_banco_cuenta }, function (datos) {
                $('#respuesta').html(datos);
            });
        }

    });
</script>

<script>
    $(document).ready(function () {
        $('#id_banco_cuenta').select2({
            theme: 'bootstrap4',
        });
    });
</script>

<div id="respuesta"></div>