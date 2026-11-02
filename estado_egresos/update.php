<?php

include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');
include ('../layout/mensajes.php');


require_once ('../app/controllers/estado_egresos/show_egreso.php');

include('../app/controllers/cargo/listado_cargo.php');
include('../app/controllers/actividad_principal/listado_actividad_principal.php');
include('../app/controllers/anio_egreso/listado_de_anios.php');
include('../app/controllers/estado_egreso/listado_de_estado_egreso.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Actualizar Datos del Egreso</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/estado_egresos"><i
                                    class="bi bi-calculator"></i> Estado de egreso</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-pencil"></i> Actualizar Datos del Estado de Egreso</a>
                        </li>
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
                            <h3 class="card-title">Digite los datos del estado de egreso a actualizar</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: inline;">



                            <form action="../app/controllers/estado_egresos/update.php" method="post">
                                <input class="form-control " type="text" name="id_egreso" id="id_egresos" 
                                    value="<?php echo $id_egresos; ?>" hidden>
                                <input class="form-control " type="text" name="id_usuario"
                                    value="<?php echo $id_usuario_sesion; ?>" hidden>
                                <div class="form-row">

                                    <?php
                                    
                                        $sql_actividad_principal = "SELECT actividad_principal.id_actividad_principal as id_actividad_principal,
                                        actividad_principal.nombre_actividad as nombre_actividad,
                                        actividad_principal.id_cargo as id_cargo,
                                        cargo.nombre_cargo as nombre_cargo 
                                        FROM tb_actividad_principal as actividad_principal 
                                        INNER JOIN tb_cargo as cargo ON cargo.id_cargo= actividad_principal.id_cargo 
                                        where cargo.nombre_cargo='$cargo_facultad' ORDER BY actividad_principal.nombre_actividad ASC";
                                        $query_actividad_principal = $pdo->prepare($sql_actividad_principal);
                                        $query_actividad_principal->execute();
                                        $actividad_principal_datos = $query_actividad_principal->fetchAll(PDO::FETCH_ASSOC);


                                        $sql_subactividad= "SELECT subactividad.id_subactividad as id_subactividad,
                                        subactividad.nombre_subactividad as nombre_subactividad,
                                        subactividad.id_actividad_principal as id_actividad_principal,
                                        actividad_principal.nombre_actividad as nombre_actividad,
                                        actividad_principal.id_cargo as id_cargo,
                                        cargo.nombre_cargo as nombre_cargo 
                                        FROM tb_subactividad as subactividad 
                                        INNER JOIN tb_actividad_principal as actividad_principal ON actividad_principal.id_actividad_principal= subactividad.id_actividad_principal 
                                        LEFT JOIN tb_cargo as cargo ON cargo.id_cargo= actividad_principal.id_cargo 
                                        WHERE subactividad.visible!=1 AND cargo.nombre_cargo='$cargo_facultad' AND actividad_principal.nombre_actividad='$actividad_principal' 
                                        ORDER BY subactividad.nombre_subactividad ASC";
                                        $query_subactividad = $pdo->prepare($sql_subactividad);
                                        $query_subactividad->execute();
                                        $subactividad_datos = $query_subactividad->fetchAll(PDO::FETCH_ASSOC);


                                    ?>

                                    <div class="form-group col-md-4" id="campo_anio_nt">
                                        <label for="">Facultad</label>
                                        <div style="display: flex;">
                                            <select class="form-control " name="nombre_cargo" id="combo_cargo"
                                                style="width:100%" required>
                                                <option value="">SELECCIONAR</option>
                                                <?php
                                                    foreach ($tipo_cargo_datos as $tipo_cargo_dato) { 
                                                        $nombre_cargo_tabla= $tipo_cargo_dato['nombre_cargo'];
                                                        $id_cargo= $tipo_cargo_dato['id_cargo'];
                                                ?>
                                                    <option value="<?php echo $tipo_cargo_dato['nombre_cargo']; ?>" <?php if ($nombre_cargo_tabla == $cargo_facultad) { ?> selected="selected" <?php } ?>>
                                                        <?php echo $tipo_cargo_dato['nombre_cargo']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#modal-create-cargo">+</button>
                                        </div>
                                            
                                            


                                    </div>

                                    <div class="form-group col-md-4" id="campo_anio_nt">
                                        <label for="">Actividad Principal</label>
                                        <div style="display: flex;">
                                            <select class="form-control " name="nombre_actividad_principal"
                                                id="combo_actividad" style="width:100%" required>
                                                <option value="">SELECCIONAR</option>
                                                <?php
                                                    foreach ($actividad_principal_datos as $actividad_principal_dato) { 
                                                        $nombre_actividad_tabla= $actividad_principal_dato['nombre_actividad'];
                                                        $id_actividad_principal= $actividad_principal_dato['id_actividad_principal'];
                                                ?>
                                                    <option value="<?php echo $actividad_principal_dato['nombre_actividad']; ?>" <?php if ($nombre_actividad_tabla == $actividad_principal) { ?> selected="selected" <?php } ?>>
                                                        <?php echo $actividad_principal_dato['nombre_actividad']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>


                                            </select>
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#modal-create-actividad-principal">+</button>
                                        </div>
                                            
                                            
                                    </div>


                                    <div class="form-group col-md-4" id="campo_anio_nt">
                                        <label for="">Subactividad</label>
                                        <div style="display: flex;">
                                            <select class="form-control " name="nombre_subactividad" id="combo_subactividad"
                                                style="width:100%">
                                                <option value="">SELECCIONAR</option>
                                                <?php
                                                foreach ($subactividad_datos as $subactividad_dato) {
                                                    $nombre_subactividad_tabla = $subactividad_dato['nombre_subactividad'];
                                                    $id_subactividad = $subactividad_dato['id_subactividad']; ?>
                                                    <option value="<?php echo $subactividad_dato['nombre_subactividad']; ?>" <?php if ($nombre_subactividad_tabla == $subactividad) { ?>
                                                            selected="selected" <?php } ?>>
                                                        <?php echo $subactividad_dato['nombre_subactividad']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#modal-create-subactividad">+</button>
                                        </div>
                                        

                                    </div>


                                    <div class="form-group col-md-2" id="">
                                            <label for="">Saldo Inicial</label>
                                            <input type="text" class="form-control " name="saldo_inicial" id="saldo_inicial" placeholder="Saldo Inicial" value="<?php echo $saldo_inicial; ?>" disabled>
                                    </div>

                                    <?php
                                    if ($rol_sesion == "ADMINISTRADOR") { ?>
                                        <script>

                                            $('#saldo_inicial').prop("disabled", false);



                                        </script>
                                    <?php } else if ($rol_sesion == "EGRESOS") { ?>
                                            <script>

                                                $('#saldo_inicial').prop("disabled", true);



                                            </script>
                                    <?php } else if ($rol_sesion == "JEFATURA") { ?>
                                                <script>

                                                    $('#saldo_inicial').prop("disabled", false);



                                                </script>
                                    <?php } ?>



                                    <div class="form-group col-md-2" id="campo_periodo">
                                        <label for="">Año</label>
                                        <select class="form-control " name="anio_periodo" id="combo_periodo"
                                            style="width:100%" required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($anios_egreso_datos as $anios_egreso_dato) {
                                                $anio_periodo_tabla = $anios_egreso_dato['anio_egreso'];
                                                $id_anio_periodo = $anios_egreso_dato['id_anio_egreso']; ?>
                                                <option value="<?php echo $anio_periodo_tabla; ?>" <?php if ($anio_periodo_tabla == $anio_periodo) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $anio_periodo_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>




                                    <script>

                                        $(document).ready(function () {

                                            $('#combo_cargo').change(function () {

                                                $('#combo_subactividad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

                                                $("#combo_cargo option:selected").each(function () {
                                                    var nombre_cargo = $('#combo_cargo').val();
                                                    $.post("../app/controllers/cargo/consulta_actividad.php",
                                                        { nombre_cargo: nombre_cargo }, function (data) {
                                                            $("#combo_actividad").html(data);
                                                        });
                                                });

                                            });
                                        });


                                        $(document).ready(function () {

                                            $('#combo_actividad').change(function () {

                                                $("#combo_actividad option:selected").each(function () {
                                                    var nombre_actividad = $('#combo_actividad').val();
                                                    $.post("../app/controllers/cargo/consulta_subactividad.php",
                                                        { nombre_actividad: nombre_actividad }, function (data) {
                                                            $("#combo_subactividad").html(data);
                                                        });
                                                });

                                            });
                                        });

                                        
                                    </script>



                                    <div class="form-group col-md-2" id="campo_estado_devolucion">
                                        <label for="">Estado</label>
                                        <select class="form-control " name="id_estado" style="width:100%"
                                            id="combo_estado">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($estado_egreso_datos as $estado_egreso_dato) {
                                                $nombre_estado_egreso = $estado_egreso_dato['nombre_estado_egreso'];
                                                $id_estado_egreso = $estado_egreso_dato['id_estado_egreso']; ?>
                                                <option value="<?php echo $id_estado_egreso; ?>" <?php if ($nombre_estado_egreso == $estado_egreso) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $nombre_estado_egreso; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>


                                    <div class="form-group col-md-2" style="line-height: 100px;" id="boton_ingresos">
                                        <a href="javascript:window.open('../app/controllers/estado_egresos/recargar.php','','width=1650, height=800');"
                                            id="boton_detalle" class="btn btn-lg"
                                            style="background-color: black; color: white;">
                                            <i class="bi bi-box-arrow-in-up-right"></i> Consulta de NT</a>

                                    </div>

                                    <script>
                                        $('#boton_detalle').click(function () {
                                            var facultad = $('#combo_cargo').val();
                                            var actividad = $('#combo_actividad').val();
                                            var subactividad= $('#combo_subactividad').val();
                                            var saldo_inicial = $('#saldo_inicial').val();
                                            var periodo = $('#combo_periodo').val();
                                            var id_egresos = $('#id_egresos').val();


                                            var url = "../app/controllers/estado_egresos/global.php";
                                            $.get(url, {
                                                facultad: facultad, actividad: actividad, subactividad: subactividad, saldo_inicial: saldo_inicial, periodo: periodo, id_egresos: id_egresos
                                            }, function (datos) { });

                                        });
                                    </script>





                                    <div class="form-group col-md-12" align="right">
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i>
                                            Guardar</button>
                                        <a href="index" class="btn" style="background-color: grey; color: white;"><i
                                                class="bi bi-x-circle-fill"></i> Cancelar</a>

                                    </div>
                                </div>

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

                                        $('#combo_cargo').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_actividad').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_subactividad').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_periodo').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_estado').select2({
                                            theme: 'bootstrap4',
                                        });

        
                                    });
                                </script>


                            </form>
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

<div class="modal fade" id="modal-create-cargo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: black; color: white">
                <h4 class="modal-title">Registrar Nuevo Facultad</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Nombre de Facultad</label>
                            <input type="text" id="nombre_cargo" class="form-control " placeholder="Digite una nueva facultad">
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
        var nombre_cargo = $('#nombre_cargo').val();
        var id_egresos = $('#id_egresos').val();

        if (nombre_cargo == "") {
            $('#nombre_cargo').focus();
            $('#lbl_create2').css('display', 'block');
        } else {
            var url = "../app/controllers/cargo/create_modal2.php";
            $.get(url, { nombre_cargo: nombre_cargo, id_egresos: id_egresos }, function (datos) {
                $('#respuesta1').html(datos);
            });
        }

    });
</script>

<div id="respuesta1"></div>


<div class="modal fade" id="modal-create-actividad-principal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: black; color: white">
                <h4 class="modal-title">Registrar Nuevo Actividad Principal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Nombre de Facultad</label>
                            <select class="form-control " id="id_cargo" style="width:100%" required>
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
                            <small style="color: red; display: none" id="lbl_create10">* Este campo es requerido</small>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Nombre de Actividad Principal</label>
                            <input type="text" id="nombre_actividad" class="form-control " placeholder="Digite una nueva actividad principal">
                            <small style="color: red; display: none" id="lbl_create">* Este campo es requerido</small>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-primary" id="btn_create2"><i class="bi bi-floppy-fill"></i>
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
    $('#btn_create2').click(function () {
        var nombre_actividad = $('#nombre_actividad').val();
        var id_cargo = $('#id_cargo').val();
        var id_egresos = $('#id_egresos').val();

        if (id_cargo == 0) {
            $('#id_cargo').focus();
            $('#lbl_create10').css('display', 'block');
            
        } else if(nombre_actividad == ""){
            $('#nombre_actividad').focus();
            $('#lbl_create').css('display', 'block');
        }else {
            var url = "../app/controllers/actividad_principal/create_modal2.php";
            $.get(url, { nombre_actividad: nombre_actividad, id_cargo: id_cargo, id_egresos: id_egresos }, function (datos) {
                $('#respuesta2').html(datos);
            });
        }


    });
</script>

<script>
    $(document).ready(function () {
        $('#id_cargo').select2({
            theme: 'bootstrap4',
        });
    });
</script>
<div id="respuesta2"></div>


<div class="modal fade" id="modal-create-subactividad">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: black; color: white">
                <h4 class="modal-title">Registrar Nuevo Subactividad</h4>
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



<script>
    $('#btn_create3').click(function () {
        var nombre_subactividad = $('#subactividadx').val();
        var id_actividad = $('#combo_actividadx').val();
        var id_cargo = $('#combo_cargox').val();
        var id_egresos = $('#id_egresos').val();

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
            var url = "../app/controllers/subactividad/create_modal2.php";
            $.get(url, { nombre_subactividad: nombre_subactividad, id_actividad: id_actividad, id_cargo: id_cargo, id_egresos: id_egresos }, function (datos) {
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

<?php include ('../layout/mensajes.php'); ?>
<?php include ('../layout/parte2.php'); ?>