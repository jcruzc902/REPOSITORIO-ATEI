<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');

if (isset($_SESSION['codigo_pago'])) {
    $codigo_pago = $_SESSION['codigo_pago'];
} else {
    $codigo_pago = "";
}

include('../app/controllers/detalle_tasas/show_detalle.php');

include('../app/controllers/resolucion_rectoral/listado_resolucion_tyt.php');
include('../app/controllers/estado_resolucion/listado_estado_resolucion.php');
include('../app/controllers/modalidad_tyt/listado_modalidad_tyt.php');
include('../app/controllers/concepto_tyt/listado_concepto_tyt.php');
include('../app/controllers/referencia_tyt/listado_referencia_tyt.php');
include('../app/controllers/dependencia_tyt/listado_dependencia_tyt.php');


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Datos de la Tasa/Tarifa: Codigo de pago 
                            <?php echo $codigo_pago; ?></b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/detalle_tyt"><i
                                    class="bi bi-card-checklist"></i> Detalle Tasas y Tarifas</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-search"></i> Informacion de Detalle Tasa y Tarifa</a>
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
                            <h3 class="card-title">Informacion de la tasa/tarifa seleccionado</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: block;">



                            <form action="#">

                                <div class="form-row">

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Codigo de Pago</label>
                                        <input type="text" class="form-control " name="codigo_pago" id="codigo_pago"
                                            value="<?php echo $codigo_pago; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-4" id="">
                                        <label for="">Modalidad</label>
                                        <select class="form-control " name="modalidad" id="combo_modalidad"
                                            style="width:100%" disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($modalidad_tyt_datos as $modalidad_tyt_dato) {
                                                $nombre_modalidad_tabla = $modalidad_tyt_dato['nombre_modalidad'];
                                                $id_modalidad_tyt = $modalidad_tyt_dato['id_modalidad_tyt']; ?>
                                                <option value="<?php echo $nombre_modalidad_tabla; ?>" <?php if ($nombre_modalidad_tabla == $modalidad) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_modalidad_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-4" id="">
                                        <label for="">Concepto</label>
                                        <select class="form-control " name="concepto" id="combo_concepto"
                                            style="width:100%" disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($concepto_tyt_datos as $concepto_tyt_dato) {
                                                $nombre_concepto_tyt_tabla = $concepto_tyt_dato['nombre_concepto_tyt'];
                                                $id_concepto_tyt = $concepto_tyt_dato['id_concepto_tyt']; ?>
                                                <option value="<?php echo $nombre_concepto_tyt_tabla; ?>" <?php if ($nombre_concepto_tyt_tabla == $concepto) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_concepto_tyt_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-4" id="">
                                        <label for="">Referencia</label>
                                        <select class="form-control " name="referencia" id="combo_referencia"
                                            style="width:100%" disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($referencia_tyt_datos as $referencia_tyt_dato) {
                                                $nombre_referencia_tabla = $referencia_tyt_dato['nombre_referencia'];
                                                $id_referencia_tyt = $referencia_tyt_dato['id_referencia_tyt']; ?>
                                                <option value="<?php echo $nombre_referencia_tabla; ?>" <?php if ($nombre_referencia_tabla == $referencia) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_referencia_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-4" id="">
                                        <label for="">Dependencia</label>
                                        <select class="form-control " name="dependencia" id="combo_dependencia"
                                            style="width:100%" disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($dependencia_tyt_datos as $dependencia_tyt_dato) {
                                                $nombre_dependencias_tyt_tabla = $dependencia_tyt_dato['nombre_dependencias_tyt'];
                                                $id_dependencias_tyt = $dependencia_tyt_dato['id_dependencias_tyt']; ?>
                                                <option value="<?php echo $nombre_dependencias_tyt_tabla; ?>" <?php if ($nombre_dependencias_tyt_tabla == $dependencia) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_dependencias_tyt_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-4" id="">


                                    </div>

                                    <div class="form-group col-md-4" id="">
                                        <label for="">Resolucion Rectoral</label>
                                        <select class="form-control " name="resolucion" id="combo_resolucion"
                                            style="width:100%" disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($resolucion_tyt_datos as $resolucion_tyt_dato) {
                                                $nombre_resolucion_tyt_tabla = $resolucion_tyt_dato['nombre_resolucion_tyt'];
                                                $id_resoluciones_tyt = $resolucion_tyt_dato['id_resoluciones_tyt']; ?>
                                                <option value="<?php echo $nombre_resolucion_tyt_tabla; ?>" <?php if ($nombre_resolucion_tyt_tabla == $resolucion) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_resolucion_tyt_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>



                                    <div class="form-group col-md-2" id="">
                                        <label for="">Monto</label>
                                        <input type="text" class="form-control " name="monto" id="monto"
                                            onkeypress='return validaNumericos(event)' value="<?php echo $monto; ?>" disabled>
                                    </div>



                                    <div class="form-group col-md-2" id="campo_estado">
                                        <label for="">Estado</label>
                                        <select class="form-control " name="id_estado_resolucion" id="combo_estado"
                                            style="width:100%" disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($estado_resolucion_datos as $estado_resolucion_dato) {
                                                $nombre_estado_resolucion_tabla = $estado_resolucion_dato['nombre_estado_resolucion'];
                                                $id_estado_resolucion = $estado_resolucion_dato['id_estado_resolucion']; ?>
                                                <option value="<?php echo $id_estado_resolucion; ?>" <?php if ($nombre_estado_resolucion_tabla == $estado_resolucion) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $nombre_estado_resolucion_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-4" id="">


                                    </div>

                                    <?php
                                    $theDate = new DateTime($fecha_registro);
                                    $fecha_registro = $theDate->format('d/m/Y h:i:s a');
                                    ?>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha de Registro</label>
                                        <input type="text" class="form-control " name="fecha_registro"
                                            id="fecha_registro" value="<?php echo $fecha_registro; ?>" disabled>
                                    </div>


                                    <div class="form-group col-md-4" id="">
                                        <label for="">Usuario</label>
                                        <input type="text" class="form-control " name="usuario" id="usuario"
                                            value="<?php echo $usuario; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-12" align="right">
                                        <a href="index" class="btn" style="background-color: grey; color: white;"><i
                                                class="bi bi-x-circle-fill"></i> Cancelar</a>

                                    </div>
                                </div>



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

<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>