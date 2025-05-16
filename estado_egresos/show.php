<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');

require_once ('../app/controllers/estado_egresos/show_egreso.php');

include('../app/controllers/cargo/listado_cargo.php');
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
                    <h1 class="m-0"><b>Datos del Estado de Cuenta</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/estado_egresos"><i
                                    class="bi bi-calculator"></i> Estado de egreso</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-search"></i> Informacion del estado de egreso</a></li>
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
                            <h3 class="card-title">Informacion del estado de egreso seleccionado</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: block;">



                            <form action="#">

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
                                    
                                    ?>

                                    <div class="form-group col-md-4" id="campo_anio_nt">
                                        <label for="">Facultad</label>
                                        <div style="display: flex;">
                                            <select class="form-control " name="nombre_cargo" id="combo_cargo"
                                                style="width:100%" disabled>
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
                                        </div>


                                    </div>

                                    <div class="form-group col-md-4" id="campo_anio_nt">
                                        <label for="">Actividad Principal</label>
                                        <div style="display: flex;">
                                            <select class="form-control " name="nombre_actividad_principal"
                                                id="combo_actividad" style="width:100%" disabled>
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
                                        </div>
                                    </div>

                                    <?php
                                    $saldo_inicial= number_format($saldo_inicial,2,'.',',');
                                    ?>

                                    <div class="form-group col-md-2" id="">
                                            <label for="">Saldo Inicial</label>
                                            <input type="text" class="form-control " name="saldo_inicial" id="saldo_inicial" placeholder="Saldo Inicial" value="<?php echo $saldo_inicial; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                            
                                    </div>

                                    

                                    <div class="form-group col-md-2" id="campo_periodo">
                                        <label for="">Año</label>
                                        <select class="form-control " name="anio_periodo" id="combo_periodo"
                                            style="width:100%" disabled>
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

                                                //$('#combo_subactividad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

                                                $("#combo_cargo option:selected").each(function () {
                                                    var nombre_cargo = $('#combo_cargo').val();
                                                    $.post("../app/controllers/cargo/consulta_actividad.php",
                                                        { nombre_cargo: nombre_cargo }, function (data) {
                                                            $("#combo_actividad").html(data);
                                                        });
                                                });

                                            });
                                        });


                                    </script>


                                    <div class="form-group col-md-2" id="campo_estado_devolucion">
                                        <label for="">Estado</label>
                                        <select class="form-control " name="id_estado" style="width:100%"
                                            id="combo_estado" disabled>
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

                                    <?php 
                                        $theDate = new DateTime($fyh_creacion_egreso);
                                        $fyh_creacion_egreso = $theDate->format('d/m/Y h:i:s a');
                                    ?>

                                    <div class="form-group col-md-2" id="campo_fecha_registro">
                                        <label for="">Fecha de Registro</label>
                                        <input type="text" class="form-control " name="fecha_registro"
                                            value="<?php echo $fyh_creacion_egreso; ?>" disabled>
                                    </div>



                                    <div class="form-group col-md-2" id="campo_observacion">
                                        <label for="">Usuario</label>
                                        <input type="text" class="form-control " name="usuario" disabled
                                            value="<?php echo $usuario; ?>">
                                    </div>

                                    <div class="form-group col-md-2" style="line-height: 100px;" id="boton_ingresos" hidden>
                                        <a href="javascript:window.open('../app/controllers/estado_egresos/recargar.php','','width=1650, height=800');"
                                            id="boton_detalle" class="btn btn-lg"
                                            style="background-color: black; color: white;" >
                                            <i class="bi bi-box-arrow-in-up-right"></i> Consulta de NT</a>

                                    </div>

                                    <script>
                                        $('#boton_detalle').click(function () {
                                            var facultad = $('#combo_cargo').val();
                                            var actividad = $('#combo_actividad').val();
                                            var saldo_inicial = $('#saldo_inicial').val();
                                            var periodo = $('#combo_periodo').val();


                                            var url = "../app/controllers/estado_egresos/global.php";
                                            $.get(url, {
                                                facultad: facultad, actividad: actividad, saldo_inicial: saldo_inicial, periodo: periodo
                                            }, function (datos) { });

                                        });
                                    </script>






                                    <div class="form-group col-md-12" align="right">
                                        <a href="index" class="btn" style="background-color: grey; color: white;"><i
                                                class="bi bi-x-circle-fill"></i> Cancelar</a>

                                    </div>
                                </div>


                                <script>
                                    $(document).ready(function () {



                                        $('#combo_cargo').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_actividad').select2({
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

<?php include ('../layout/mensajes.php'); ?>
<?php include ('../layout/parte2.php'); ?>