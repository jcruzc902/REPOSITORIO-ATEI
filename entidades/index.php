<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');


include('../app/controllers/entidades/listado_de_entidades.php');


?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1 class="m-0"><b>Consulta de Entidades Financiera</b>
                        <button type="button" class="btn btn-default bg-primary" data-toggle="modal"
                            data-target="#modal-create">
                            <i class="bi bi-plus-circle"></i> Agregar Nueva Entidad
                        </button>

                    </h1>

                </div><!-- /.col -->
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-building"></i> Entidades</li>
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
                            <h3 class="card-title">ENTIDADES FINANCIERA REGISTRADO</h3>
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
                                            <center>Entidad Financiera</center>
                                        </th>
                                        <th>
                                            <center>Nro. de RUC</center>
                                        </th>
                                        <th>
                                            <center>Estado</center>
                                        </th>
                                        <th>
                                            <center>Acciones</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    foreach ($entidades_datos as $entidades_dato) {
                                        $id_entidad_cf = $entidades_dato['id_entidad_cf'];
                                        $nombre_entidad = $entidades_dato['nombre_entidad'];
                                        $ruc_entidad = $entidades_dato['ruc'];
                                        $estado = $entidades_dato['estado'];
                                        $direccion = $entidades_dato['direccion'];
                                        $departamento = $entidades_dato['departamento'];
                                        ?>
                                        <tr>
                                            <td>
                                                <center>
                                                    <?php echo $contador = $contador + 1; ?>
                                                </center>
                                            </td>
                                            <td>
                                                <?php echo $entidades_dato['nombre_entidad']; ?>
                                            </td>
                                            <td>
                                                <?php echo $entidades_dato['ruc']; ?>
                                            </td>

                                            <td>
                                                <?php
                                                switch ($entidades_dato['estado']) {
                                                    case 'ACTIVO': ?>
                                                        <span class="badge bg-success">
                                                            <?php echo $entidades_dato['estado']; ?>
                                                        </span>
                                                        <?php
                                                        break;

                                                    default: ?>
                                                        <span class="badge bg-danger">
                                                            <?php echo $entidades_dato['estado']; ?>
                                                        </span>
                                                        <?php
                                                        break;
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <center>


                                                    <button type="button" class="btn btn-sm bg-success" data-toggle="modal"
                                                        data-target="#modal-update<?php echo $id_entidad_cf; ?>">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-sm bg-danger" data-toggle="modal"
                                                        data-target="#modal-delete<?php echo $id_entidad_cf; ?>"> <i
                                                            class="fa fa-trash"></i>
                                                    </button>

                                                    <div class="modal fade" id="modal-update<?php echo $id_entidad_cf; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header"
                                                                    style="background-color: black; color: white">
                                                                    <h4 class="modal-title">Actualizar Entidad</h4>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">

                                                                        <div class="col-md-8">
                                                                            <div class="form-group">
                                                                                <label for="">Ingrese el número de
                                                                                    RUC</label>
                                                                                <input type="text"
                                                                                    id="ruc2<?php echo $id_entidad_cf; ?>"
                                                                                    class="form-control form-control-sm">
                                                                                <small style="color: red; display: none"
                                                                                    id="lbl_1">* Este campo es
                                                                                    requerido</small>
                                                                            </div>


                                                                        </div>

                                                                        <div class="col-md-4" style="line-height: 90px">
                                                                            <button type="button" class="btn btn-success"
                                                                                id="pruebaruc2<?php echo $id_entidad_cf; ?>"><i
                                                                                    class="bi bi-search"></i>
                                                                                Consultar</button>
                                                                        </div>

                                                                        <script>
                                                                            document.getElementById('ruc2<?php echo $id_entidad_cf; ?>').addEventListener('keydown', function (e) {

                                                                                //si presiona el teclado Enter
                                                                                if (e.keyCode === 13) {
                                                                                    // entonces haces lo que quieras para poder reaccionar a la pulsación del enter.

                                                                                    // se establecera como clic en el boton Iniciar Consulta
                                                                                    $("#pruebaruc2<?php echo $id_entidad_cf; ?>").click();
                                                                                }
                                                                            });
                                                                        </script>

                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Entidad
                                                                                    Financiera</label>
                                                                                <input type="text"
                                                                                    id="nombre_entidad<?php echo $id_entidad_cf; ?>"
                                                                                    value="<?php echo $nombre_entidad; ?>"
                                                                                    class="form-control form-control-sm">
                                                                                <small style="color: red; display: none"
                                                                                    id="lbl_1<?php echo $id_entidad_cf; ?>">*
                                                                                    Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Nro. de
                                                                                    RUC</label>
                                                                                <input type="text"
                                                                                    id="ruc_entidad<?php echo $id_entidad_cf; ?>"
                                                                                    value="<?php echo $ruc_entidad; ?>"
                                                                                    class="form-control form-control-sm">
                                                                                <small style="color: red; display: none"
                                                                                    id="lbl_2<?php echo $id_entidad_cf; ?>">*
                                                                                    Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Estado</label>
                                                                                <input type="text"
                                                                                    id="estado<?php echo $id_entidad_cf; ?>"
                                                                                    value="<?php echo $estado; ?>"
                                                                                    class="form-control form-control-sm">
                                                                                <small style="color: red; display: none"
                                                                                    id="lbl_2<?php echo $id_entidad_cf; ?>">*
                                                                                    Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Direccion</label>
                                                                                <input type="text"
                                                                                    id="direccion<?php echo $id_entidad_cf; ?>"
                                                                                    value="<?php echo $direccion; ?>"
                                                                                    class="form-control form-control-sm">
                                                                                <small style="color: red; display: none"
                                                                                    id="lbl_2<?php echo $id_entidad_cf; ?>">*
                                                                                    Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    class="float-left">Departamento</label>
                                                                                <input type="text"
                                                                                    id="departamento<?php echo $id_entidad_cf; ?>"
                                                                                    value="<?php echo $departamento; ?>"
                                                                                    class="form-control form-control-sm">
                                                                                <small style="color: red; display: none"
                                                                                    id="lbl_2<?php echo $id_entidad_cf; ?>">*
                                                                                    Este campo es requerido</small>
                                                                            </div>
                                                                        </div>

                                                                        <script>

                                                                            $("#pruebaruc2<?php echo $id_entidad_cf; ?>").click(function () {

                                                                                var ruc = $("#ruc2<?php echo $id_entidad_cf; ?>").val();


                                                                                $.ajax({
                                                                                    type: "POST",
                                                                                    url: "consultar-ruc-ajax.php",
                                                                                    data: 'ruc=' + ruc,
                                                                                    dataType: 'json',
                                                                                    success: function (data) {

                                                                                        if (data == 1) {
                                                                                            alert('El RUC tiene que tener 11 digitos');
                                                                                        }
                                                                                        else {
                                                                                            console.log(data);

                                                                                            $("#ruc_entidad<?php echo $id_entidad_cf; ?>").val(data.numeroDocumento);
                                                                                            $("#nombre_entidad<?php echo $id_entidad_cf; ?>").val(data.nombre);
                                                                                            $("#estado<?php echo $id_entidad_cf; ?>").val(data.estado);

                                                                                            $("#direccion<?php echo $id_entidad_cf; ?>").val(data.direccion);
                                                                                            $("#departamento<?php echo $id_entidad_cf; ?>").val(data.departamento);
                                                                                        }

                                                                                    }
                                                                                });

                                                                            })

                                                                        </script>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer ">
                                                                    <button type="button" class="btn btn-primary"
                                                                        id="btn_update<?php echo $id_entidad_cf; ?>"><i
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
                                                        $('#btn_update<?php echo $id_entidad_cf; ?>').click(function () {
                                                            var nombre_entidad = $('#nombre_entidad<?php echo $id_entidad_cf; ?>').val();
                                                            var ruc_entidad = $('#ruc_entidad<?php echo $id_entidad_cf; ?>').val();
                                                            var estado = $('#estado<?php echo $id_entidad_cf; ?>').val();
                                                            var direccion = $('#direccion<?php echo $id_entidad_cf; ?>').val();
                                                            var departamento = $('#departamento<?php echo $id_entidad_cf; ?>').val();
                                                            var id_entidad_cf = '<?php echo $id_entidad_cf; ?>';

                                                            if (nombre_entidad == "") {
                                                                $('#nombre_entidad<?php echo $id_entidad_cf; ?>').focus();
                                                                $('#lbl_1<?php echo $id_entidad_cf; ?>').css('display', 'block');
                                                            } else if (ruc_entidad == "") {
                                                                $('#ruc_entidad<?php echo $id_entidad_cf; ?>').focus();
                                                                $('#lbl_2<?php echo $id_entidad_cf; ?>').css('display', 'block');
                                                            } else {
                                                                var url = "../app/controllers/entidades/update.php";
                                                                $.get(url, { nombre_entidad: nombre_entidad, ruc_entidad: ruc_entidad, estado: estado, direccion: direccion, departamento: departamento, id_entidad_cf: id_entidad_cf }, function (datos) {
                                                                    $('#respuesta_update<?php echo $id_entidad_cf; ?>').html(datos);
                                                                });
                                                            }
                                                        });
                                                    </script>
                                                    <div id="respuesta_update<?php echo $id_entidad_cf; ?>"></div>




                                                    <div class="modal fade" id="modal-delete<?php echo $id_entidad_cf; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header"
                                                                    style="background-color: black; color: white;">
                                                                    <h4 class="modal-title">Eliminar Entidad</h4>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Entidad
                                                                                    Financiera</label>
                                                                                <input type="text"
                                                                                    id="nombre_entidad<?php echo $id_entidad_cf; ?>"
                                                                                    value="<?php echo $nombre_entidad; ?>"
                                                                                    class="form-control form-control-sm"
                                                                                    disabled>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Nro. de
                                                                                    RUC</label>
                                                                                <input type="text"
                                                                                    id="ruc_entidad<?php echo $id_entidad_cf; ?>"
                                                                                    value="<?php echo $ruc_entidad; ?>"
                                                                                    class="form-control form-control-sm"
                                                                                    disabled>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Estado</label>
                                                                                <input type="text"
                                                                                    id="estado<?php echo $id_entidad_cf; ?>"
                                                                                    value="<?php echo $estado; ?>"
                                                                                    class="form-control form-control-sm"
                                                                                    disabled>
                                                                                <small style="color: red; display: none"
                                                                                    id="lbl_2<?php echo $id_entidad_cf; ?>">*
                                                                                    Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="float-left">Direccion</label>
                                                                                <input type="text"
                                                                                    id="direccion<?php echo $id_entidad_cf; ?>"
                                                                                    value="<?php echo $direccion; ?>"
                                                                                    class="form-control form-control-sm"
                                                                                    disabled>
                                                                                <small style="color: red; display: none"
                                                                                    id="lbl_2<?php echo $id_entidad_cf; ?>">*
                                                                                    Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    class="float-left">Departamento</label>
                                                                                <input type="text"
                                                                                    id="departamento<?php echo $id_entidad_cf; ?>"
                                                                                    value="<?php echo $departamento; ?>"
                                                                                    class="form-control form-control-sm"
                                                                                    disabled>
                                                                                <small style="color: red; display: none"
                                                                                    id="lbl_2<?php echo $id_entidad_cf; ?>">*
                                                                                    Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">

                                                                    <button type="button" class="btn btn-danger"
                                                                        id="btn_delete<?php echo $id_entidad_cf; ?>"><i
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
                                                        $('#btn_delete<?php echo $id_entidad_cf; ?>').click(function () {

                                                            var id_entidad_cf = '<?php echo $id_entidad_cf; ?>';


                                                            var url = "../app/controllers/entidades/ocultar_entidad.php";
                                                            $.get(url, { id_entidad_cf: id_entidad_cf }, function (datos) {
                                                                $('#respuesta_delete<?php echo $id_entidad_cf; ?>').html(datos);
                                                            });

                                                        });
                                                    </script>
                                                    <div id="respuesta_delete<?php echo $id_entidad_cf; ?>"></div>

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
                "infoFiltered": "(Filtrado de _MAX_ total Entidades)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entidades",
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
                <h4 class="modal-title">Registrar Nueva Entidad</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">



                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="">Ingrese el número de RUC</label>
                            <input type="text" id="ruc" class="form-control form-control-sm">
                            <small style="color: red; display: none" id="lbl_0">* Este campo es requerido</small>
                        </div>


                    </div>

                    <div class="col-md-4" style="line-height: 90px">
                        <button type="button" class="btn btn-success" id="pruebaruc"><i class="bi bi-search"></i>
                            Consultar</button>
                    </div>

                    <script>
                        document.getElementById('ruc').addEventListener('keydown', function (e) {

                            //si presiona el teclado Enter
                            if (e.keyCode === 13) {
                                // entonces haces lo que quieras para poder reaccionar a la pulsación del enter.

                                // se establecera como clic en el boton Iniciar Consulta
                                $("#pruebaruc").click();
                            }
                        });
                    </script>




                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Entidad Financiera</label>
                            <input type="text" id="nombre_entidad" class="form-control form-control-sm">
                            <small style="color: red; display: none" id="lbl_1">* Este campo es requerido</small>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Nro. de RUC</label>
                            <input type="text" id="ruc_entidad" class="form-control form-control-sm">
                            <small style="color: red; display: none" id="lbl_2">* Este campo es requerido</small>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Estado</label>
                            <input type="text" id="estado" class="form-control form-control-sm">
                            <small style="color: red; display: none" id="lbl_3">* Este campo es requerido</small>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Direccion</label>
                            <input type="text" id="direccion" class="form-control form-control-sm">
                            <small style="color: red; display: none" id="lbl_4">* Este campo es requerido</small>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Departamento</label>
                            <input type="text" id="departamento" class="form-control form-control-sm">
                            <small style="color: red; display: none" id="lbl_5">* Este campo es requerido</small>
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

    $("#pruebaruc").click(function () {

        var ruc = $("#ruc").val();


        $.ajax({
            type: "POST",
            url: "consultar-ruc-ajax.php",
            data: 'ruc=' + ruc,
            dataType: 'json',
            success: function (data) {

                if (data == 1) {
                    alert('El RUC tiene que tener 11 digitos');
                }
                else {
                    console.log(data);

                    $("#ruc_entidad").val(data.numeroDocumento);
                    $("#nombre_entidad").val(data.nombre);
                    $("#estado").val(data.estado);

                    $("#direccion").val(data.direccion);
                    $("#departamento").val(data.departamento);
                }

            }
        });

    })

</script>



<script>
    $('#btn_create').click(function () {
        var nombre_entidad = $('#nombre_entidad').val();
        var ruc_entidad = $('#ruc_entidad').val();
        var estado = $('#estado').val();
        var direccion = $('#direccion').val();
        var departamento = $('#departamento').val();

        if (nombre_entidad == "") {
            $('#nombre_entidad').focus();
            $('#lbl_1').css('display', 'block');
        } else if (ruc_entidad == "") {
            $('#ruc_entidad').focus();
            $('#lbl_2').css('display', 'block');
        } else {
            var url = "../app/controllers/entidades/create.php";
            $.get(url, { nombre_entidad: nombre_entidad, ruc_entidad: ruc_entidad, estado: estado, direccion: direccion, departamento: departamento }, function (datos) {
                $('#respuesta').html(datos);
            });
        }

    });
</script>
<div id="respuesta"></div>