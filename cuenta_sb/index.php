<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');


include ('../app/controllers/cuenta_tyt/listado_cuenta_tyt.php');
include ('../app/controllers/banco_tyt/listado_banco_tyt.php');


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1 class="m-0"><b>Consulta de Cuenta</b>
                        <button type="button" class="btn btn-default bg-primary" data-toggle="modal"
                            data-target="#modal-create">
                            <i class="bi bi-plus-circle"></i> Agregar Nueva Cuenta
                        </button>

                    </h1>

                </div><!-- /.col -->
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-check2-square"></i> Cuenta</li>
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
                            <h3 class="card-title">CUENTAS REGISTRADO</h3>
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
                                            <center>Cuenta</center>
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
                                    foreach ($cuenta_tyt_datos as $cuenta_tyt_dato) {
                                        $id_cuenta_tyt = $cuenta_tyt_dato['id_cuenta_tyt'];
                                        $numero_cuenta_tyt = $cuenta_tyt_dato['numero_cuenta_tyt'];
                                        $nombre_banco_tyt = $cuenta_tyt_dato['nombre_banco'];
                                        ?>
                                        <tr>
                                            <td>
                                                <center>
                                                    <?php echo $contador = $contador + 1; ?>
                                                </center>
                                            </td>
                                            <td>
                                                <?php echo $cuenta_tyt_dato['numero_cuenta_tyt']; ?>
                                            </td>
                                            <td>
                                                <?php echo $cuenta_tyt_dato['nombre_banco']; ?>
                                            </td>
                                            <td>
                                                <center>



                                                    <button type="button" class="btn btn-sm btn-default bg-success"
                                                        data-toggle="modal"
                                                        data-target="#modal-update<?php echo $id_cuenta_tyt; ?>">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-sm btn-default bg-danger"
                                                        data-toggle="modal"
                                                        data-target="#modal-delete<?php echo $id_cuenta_tyt; ?>"> <i
                                                            class="fa fa-trash"></i>
                                                    </button>

                                                    <div class="modal fade" id="modal-update<?php echo $id_cuenta_tyt; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header"
                                                                    style="background-color: black; color: white">
                                                                    <h4 class="modal-title">Actualizar Cuenta</h4>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Numero de
                                                                                    cuenta</label>
                                                                                <input type="text"
                                                                                    id="numero_cuenta_tyt<?php echo $id_cuenta_tyt; ?>"
                                                                                    value="<?php echo $numero_cuenta_tyt; ?>"
                                                                                    class="form-control ">
                                                                                <small style="color: red; display: none"
                                                                                    id="lbl_update<?php echo $id_cuenta_tyt; ?>">*
                                                                                    Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Nombre de Banco</label>
                                                                                <select class="form-control" id="id_banco<?php echo $id_cuenta_tyt; ?>" style="width:100%">
                                                                                    <option value="">SELECCIONAR</option>
                                                                                    <?php
                                                                                    foreach ($banco_tyt_datos as $banco_tyt_dato) {
                                                                                        $nombre_banco_tabla = $banco_tyt_dato['nombre_banco'];
                                                                                        $id_banco_tyt = $banco_tyt_dato['id_banco_tyt']; ?>
                                                                                        <option
                                                                                            value="<?php echo $id_banco_tyt; ?>"
                                                                                            <?php if ($nombre_banco_tabla == $nombre_banco_tyt) { ?> selected="selected" <?php } ?>>
                                                                                            <?php echo $nombre_banco_tabla; ?>
                                                                                        </option>
                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                                <small style="color: red; display: none"
                                                                                    id="lbl_update2<?php echo $id_cuenta_tyt; ?>">*
                                                                                    Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer ">
                                                                    <button type="button" class="btn btn-primary"
                                                                        id="btn_update<?php echo $id_cuenta_tyt; ?>"><i
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
                                                        $('#btn_update<?php echo $id_cuenta_tyt; ?>').click(function () {
                                                            var numero_cuenta_tyt = $('#numero_cuenta_tyt<?php echo $id_cuenta_tyt; ?>').val();
                                                            var id_banco = $('#id_banco<?php echo $id_cuenta_tyt; ?>').val();
                                                            var id_cuenta_tyt = '<?php echo $id_cuenta_tyt; ?>';

                                                            if (numero_cuenta_tyt == "") {
                                                                $('#numero_cuenta_tyt<?php echo $id_cuenta_tyt; ?>').focus();
                                                                $('#lbl_update<?php echo $id_cuenta_tyt; ?>').css('display', 'block');
                                                            } else if (id_banco == "") {
                                                                $('#id_banco<?php echo $id_cuenta_tyt; ?>').focus();
                                                                $('#lbl_update2<?php echo $id_cuenta_tyt; ?>').css('display', 'block');
                                                            } else {
                                                                var url = "../app/controllers/cuenta_tyt/update.php";
                                                                $.get(url, { numero_cuenta_tyt: numero_cuenta_tyt, id_banco: id_banco, id_cuenta_tyt: id_cuenta_tyt }, function (datos) {
                                                                    $('#respuesta_update<?php echo $id_cuenta_tyt; ?>').html(datos);
                                                                });
                                                            }
                                                        });
                                                    </script>
                                                    <div id="respuesta_update<?php echo $id_cuenta_tyt; ?>"></div>





                                                    <div class="modal fade" id="modal-delete<?php echo $id_cuenta_tyt; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header"
                                                                    style="background-color: black; color: white;">
                                                                    <h4 class="modal-title">Eliminar Cuenta
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
                                                                                <label class="float-left">Numero de
                                                                                    cuenta</label>
                                                                                <input type="text"
                                                                                    id="numero_cuenta_tyt<?php echo $id_cuenta_tyt; ?>"
                                                                                    value="<?php echo $numero_cuenta_tyt; ?>"
                                                                                    class="form-control " disabled>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger"
                                                                        id="btn_delete<?php echo $id_cuenta_tyt; ?>"><i
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
                                                        $('#btn_delete<?php echo $id_cuenta_tyt; ?>').click(function () {

                                                            var id_cuenta_tyt = '<?php echo $id_cuenta_tyt; ?>';


                                                            var url = "../app/controllers/cuenta_tyt/ocultar_cuenta.php";
                                                            $.get(url, { id_cuenta_tyt: id_cuenta_tyt }, function (datos) {
                                                                $('#respuesta_delete<?php echo $id_cuenta_tyt; ?>').html(datos);
                                                            });

                                                        });
                                                    </script>
                                                    <div id="respuesta_delete<?php echo $id_cuenta_tyt; ?>"></div>

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
                "infoFiltered": "(Filtrado de _MAX_ total Cuentas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Cuentas",
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
                <h4 class="modal-title">Registrar Nueva Cuenta</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Numero de cuenta</label>
                            <input type="text" id="numero_cuenta" class="form-control "
                                onkeypress='return validaNumericos(event)'>
                            <small style="color: red; display: none" id="lbl_create">* Este campo es requerido</small>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Nombre de Banco</label>
                            <select class="form-control " id="id_banco" style="width:100%" required>
                                <option value="">SELECCIONAR</option>
                                <?php
                                foreach ($banco_tyt_datos as $banco_tyt_dato) { ?>
                                    <option value="<?php echo $banco_tyt_dato['id_banco_tyt']; ?>">
                                        <?php echo $banco_tyt_dato['nombre_banco']; ?>
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
    function validaNumericos(event) {
        if ((event.charCode >= 48 && event.charCode <= 57)) {
            return true;
        }

        if ((event.charCode == 45)) {
            return true;
        }

        if ((event.charCode == 46)) {
            return true;
        }
        return false;
    }
</script>

<script>
    $(document).ready(function () {
        $('#id_banco').select2({
            theme: 'bootstrap4',
        });


    });
</script>

<script>
    $('#btn_create').click(function () {
        var numero_cuenta = $('#numero_cuenta').val();
        var id_banco = $('#id_banco').val();

        if (numero_cuenta == "") {
            $('#numero_cuenta').focus();
            $('#lbl_create').css('display', 'block');
        } else if (id_banco == "") {
            $('#id_banco').focus();
            $('#lbl_create2').css('display', 'block');
        } else {
            var url = "../app/controllers/cuenta_tyt/create.php";
            $.get(url, { numero_cuenta: numero_cuenta, id_banco: id_banco }, function (datos) {
                $('#respuesta').html(datos);
            });
        }

    });
</script>
<div id="respuesta"></div>