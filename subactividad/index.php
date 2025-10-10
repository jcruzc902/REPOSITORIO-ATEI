<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');


include('../app/controllers/cargo/listado_cargo.php');
include('../app/controllers/actividad_principal/listado_actividad_principal.php');
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
                                            <center>Cargo</center>
                                        </th>
                                        <th>
                                            <center>Actividad Principal</center>
                                        </th>
                                        <th>
                                            <center>Subactividad</center>
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

                                        <?php
                                    
                                        $sql_actividad_principal = "SELECT actividad_principal.id_actividad_principal as id_actividad_principal,
                                        actividad_principal.nombre_actividad as nombre_actividad,
                                        actividad_principal.id_cargo as id_cargo,
                                        cargo.nombre_cargo as nombre_cargo 
                                        FROM tb_actividad_principal as actividad_principal 
                                        INNER JOIN tb_cargo as cargo ON cargo.id_cargo= actividad_principal.id_cargo 
                                        where cargo.nombre_cargo='$nombre_cargo' ORDER BY actividad_principal.nombre_actividad ASC";
                                        $query_actividad_principal = $pdo->prepare($sql_actividad_principal);
                                        $query_actividad_principal->execute();
                                        $actividad_principal_datos = $query_actividad_principal->fetchAll(PDO::FETCH_ASSOC);


                                       


                                        ?>
                                        
                                        <tr>
                                            <td>
                                                <center>
                                                    <?php echo $contador = $contador + 1; ?>
                                                </center>
                                            </td>
                                            
                                            <td>
                                                <?php echo mb_strtoupper($subactividad_dato['nombre_cargo']); ?>
                                            </td>
                                            <td>
                                                <?php echo mb_strtoupper($subactividad_dato['nombre_actividad_principal']); ?>
                                            </td>
                                            <td>
                                                <?php echo mb_strtoupper($subactividad_dato['nombre_subactividad']); ?>
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
                                                        <div class="modal-dialog">
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
                                                                                        <label class="float-left">Cargo</label>
                                                                                        <select class="form-control" id="id_cargo<?php echo $id_subactividad; ?>" style="width:100%">
                                                                                            <option value="">SELECCIONAR</option>
                                                                                            <?php
                                                                                            foreach ($tipo_cargo_datos as $tipo_cargo_dato) {
                                                                                                $nombre_cargo_tabla = $tipo_cargo_dato['nombre_cargo'];
                                                                                                $id_cargo = $tipo_cargo_dato['id_cargo']; ?>
                                                                                                <option
                                                                                                    value="<?php echo $id_cargo; ?>"
                                                                                                    <?php if ($nombre_cargo_tabla== $nombre_cargo) { ?> selected="selected" <?php } ?>>
                                                                                                    <?php echo $nombre_cargo_tabla; ?>
                                                                                                </option>
                                                                                                <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                        <small style="color: red; display: none"
                                                                                            id="lbl_update1<?php echo $id_subactividad; ?>">*
                                                                                            Este campo es requerido</small>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                        <label class="float-left">Actividad Principal</label>
                                                                                        <select class="form-control" id="id_actividad<?php echo $id_subactividad; ?>" style="width:100%">
                                                                                            <option value="">SELECCIONAR</option>
                                                                                            <?php
                                                                                            foreach ($actividad_principal_datos as $actividad_principal_dato) {
                                                                                                $nombre_actividad_tabla = $actividad_principal_dato['nombre_actividad'];
                                                                                                $id_actividad_principal = $actividad_principal_dato['id_actividad_principal']; ?>
                                                                                                <option
                                                                                                    value="<?php echo $id_actividad_principal; ?>"
                                                                                                    <?php if ($nombre_actividad_tabla== $nombre_actividad_principal) { ?> selected="selected" <?php } ?>>
                                                                                                    <?php echo $nombre_actividad_tabla; ?>
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

                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label class="float-left">Nombre de Subactividad</label>
                                                                                    <input type="text"
                                                                                        id="nombre_subactividad<?php echo $id_subactividad; ?>"
                                                                                        value="<?php echo $nombre_subactividad; ?>"
                                                                                        class="form-control ">
                                                                                    <small style="color: red; display: none"
                                                                                        id="lbl_update3<?php echo $id_subactividad; ?>">*
                                                                                        Este campo es requerido</small>
                                                                                </div>
                                                                            </div> 

                                                                            <script>
                                                                                $(document).ready(function () {

                                                                                    $('#id_cargo<?php echo $id_subactividad; ?>').change(function () {

                                                                                        //$('#combo_subactividad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

                                                                                        $("#id_cargo<?php echo $id_subactividad; ?> option:selected").each(function () {
                                                                                            var id_cargo = $('#id_cargo<?php echo $id_subactividad; ?>').val();
                                                                                            $.post("../app/controllers/cargo/consulta_actividad2.php",
                                                                                                { id_cargo: id_cargo }, function (data) {
                                                                                                    $("#id_actividad<?php echo $id_subactividad; ?>").html(data);
                                                                                                });
                                                                                        });

                                                                                    });
                                                                                });
                                                                            </script>

                                                                            
                                                                        
                                                                        
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
                                                            var id_cargo = $('#id_cargo<?php echo $id_subactividad; ?>').val();
                                                            var id_subactividad= '<?php echo $id_subactividad; ?>';

                                                            if (id_cargo == "") {
                                                                $('#id_cargo<?php echo $id_subactividad; ?>').focus();
                                                                $('#lbl_update1<?php echo $id_subactividad; ?>').css('display', 'block');
                                                            }  else if (id_actividad == "") {
                                                                $('#id_actividad<?php echo $id_subactividad; ?>').focus();
                                                                $('#lbl_update2<?php echo $id_subactividad; ?>').css('display', 'block');
                                                            } else if (nombre_subactividad == "") {
                                                                $('#nombre_subactividad<?php echo $id_subactividad; ?>').focus();
                                                                $('#lbl_update3<?php echo $id_subactividad; ?>').css('display', 'block');
                                                            }  else {
                                                                var url = "../app/controllers/subactividad/update.php";
                                                                $.get(url, { nombre_subactividad: nombre_subactividad, id_actividad: id_actividad, id_cargo: id_cargo, id_subactividad: id_subactividad}, function (datos) {
                                                                    $('#respuesta_update<?php echo $id_subactividad; ?>').html(datos);
                                                                });
                                                            }
                                                        });
                                                    </script>
                                                    <div id="respuesta_update<?php echo $id_subactividad; ?>"></div>





                                                    <div class="modal fade"
                                                        id="modal-delete<?php echo $id_subactividad; ?>">
                                                        <div class="modal-dialog">
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
                                                                                        <label class="float-left">Cargo</label>
                                                                                        <select class="form-control" id="id_cargo<?php echo $id_subactividad; ?>" style="width:100%" disabled>
                                                                                            <option value="">SELECCIONAR</option>
                                                                                            <?php
                                                                                            foreach ($tipo_cargo_datos as $tipo_cargo_dato) {
                                                                                                $nombre_cargo_tabla = $tipo_cargo_dato['nombre_cargo'];
                                                                                                $id_cargo = $tipo_cargo_dato['id_cargo']; ?>
                                                                                                <option
                                                                                                    value="<?php echo $id_cargo; ?>"
                                                                                                    <?php if ($nombre_cargo_tabla== $nombre_cargo) { ?> selected="selected" <?php } ?>>
                                                                                                    <?php echo $nombre_cargo_tabla; ?>
                                                                                                </option>
                                                                                                <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                        <small style="color: red; display: none"
                                                                                            id="lbl_update1<?php echo $id_subactividad; ?>">*
                                                                                            Este campo es requerido</small>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                        <label class="float-left">Actividad Principal</label>
                                                                                        <select class="form-control" id="id_actividad<?php echo $id_subactividad; ?>" style="width:100%" disabled>
                                                                                            <option value="">SELECCIONAR</option>
                                                                                            <?php
                                                                                            foreach ($actividad_principal_datos as $actividad_principal_dato) {
                                                                                                $nombre_actividad_tabla = $actividad_principal_dato['nombre_actividad'];
                                                                                                $id_actividad_principal = $actividad_principal_dato['id_actividad_principal']; ?>
                                                                                                <option
                                                                                                    value="<?php echo $id_actividad_principal; ?>"
                                                                                                    <?php if ($nombre_actividad_tabla== $nombre_actividad_principal) { ?> selected="selected" <?php } ?>>
                                                                                                    <?php echo $nombre_actividad_tabla; ?>
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

                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label class="float-left">Nombre de Subactividad</label>
                                                                                    <input type="text"
                                                                                        id="nombre_subactividad<?php echo $id_subactividad; ?>"
                                                                                        value="<?php echo $nombre_subactividad; ?>"
                                                                                        class="form-control " disabled>
                                                                                    <small style="color: red; display: none"
                                                                                        id="lbl_update3<?php echo $id_subactividad; ?>">*
                                                                                        Este campo es requerido</small>
                                                                                </div>
                                                                            </div> 

                                                                            <script>
                                                                                $(document).ready(function () {

                                                                                    $('#id_cargo<?php echo $id_subactividad; ?>').change(function () {

                                                                                        //$('#combo_subactividad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

                                                                                        $("#id_cargo<?php echo $id_subactividad; ?> option:selected").each(function () {
                                                                                            var id_cargo = $('#id_cargo<?php echo $id_subactividad; ?>').val();
                                                                                            $.post("../app/controllers/cargo/consulta_actividad2.php",
                                                                                                { id_cargo: id_cargo }, function (data) {
                                                                                                    $("#id_actividad<?php echo $id_subactividad; ?>").html(data);
                                                                                                });
                                                                                        });

                                                                                    });
                                                                                });
                                                                            </script>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: black; color: white">
                <h4 class="modal-title">Registrar Nueva Subactividad</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    

                                    <div class="form-group col-md-12" id="campo_anio_nt">
                                        <label for="">Facultad</label>
                                        
                                            <select class="form-control " id="combo_cargox" style="width:100%" required>
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
                                            <small style="color: red; display: none" id="lbl_create15">* Este campo es requerido</small>


                                    </div>

                                    <div class="form-group col-md-12" id="campo_anio_nt">
                                        <label for="">Actividad Principal</label>
                                        
                                            <select class="form-control " id="combo_actividadx" style="width:100%" required>



                                            </select>
                                            <small style="color: red; display: none" id="lbl_create25">* Este campo es requerido</small>
                                    </div>

                                    <div class="form-group col-md-12" id="">
                                            <label for="">Subactividad</label>
                                            <input type="text" class="form-control " name="subactividadx" id="subactividadx" placeholder="Digite una nueva subactividad">
                                            <small style="color: red; display: none" id="lbl_create35">* Este campo es requerido</small>
                                    </div>

                                    <script>
                                            $(document).ready(function () {

                                                            $('#combo_cargox').change(function () {

                                                                //$('#combo_subactividad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

                                                                $("#combo_cargox option:selected").each(function () {
                                                                    var id_cargo = $('#combo_cargox').val();
                                                                    $.post("../app/controllers/cargo/consulta_actividad2.php",
                                                                        { id_cargo: id_cargo }, function (data) {
                                                                            $("#combo_actividadx").html(data);
                                                                        });
                                                                });

                                                            });
                                            });
                                    </script>
                </div>

            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-primary" id="btn_create3"><i class="bi bi-floppy-fill"></i>
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
    $('#btn_create3').click(function () {
        var nombre_subactividad = $('#subactividadx').val();
        var id_actividad = $('#combo_actividadx').val();
        var id_cargo = $('#combo_cargox').val();

        if(id_cargo==0){
            $('#combo_cargox').focus();
            $('#lbl_create15').css('display', 'block');
        }else if(id_actividad==0){
            $('#combo_actividadx').focus();
            $('#lbl_create25').css('display', 'block');
        }
        else if (nombre_subactividad == "") {
            $('#subactividadx').focus();
            $('#lbl_create35').css('display', 'block');
        } else {
            var url = "../app/controllers/subactividad/create.php";
            $.get(url, { nombre_subactividad: nombre_subactividad, id_actividad: id_actividad, id_cargo: id_cargo }, function (datos) {
                $('#respuesta3').html(datos);
            });
        }


    });
</script>

<script>
    $(document).ready(function () {
        $('#combo_cargox').select2({
            theme: 'bootstrap4',
        });

        $('#combo_actividadx').select2({
            theme: 'bootstrap4',
        });
    });
</script>
<div id="respuesta3"></div>