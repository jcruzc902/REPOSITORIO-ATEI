<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');

include('../app/controllers/detalle_tasas/show_detalle.php');

include('../app/controllers/resolucion_rectoral/listado_resolucion_tyt.php');
include('../app/controllers/estado_resolucion/listado_estado_resolucion.php');

if (isset($_SESSION['codigo_pago'])) {
    $codigo_pago = $_SESSION['codigo_pago'];
} else {
    $codigo_pago = "";
}


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Eliminar Datos de Resolucion: Codigo de Pago
                            <?php echo $codigo_pago; ?></b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/detalle_cheque"><i
                                    class="bi bi-card-checklist"></i> Pagos realizado</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-x-octagon-fill"></i> Eliminar pago
                            realizado</a></li>
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
                            <h3 class="card-title">¿Esta seguro de eliminar la resolucion seleccionado?</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: block;">



                            <form action="../app/controllers/detalle_tasas/ocultar_detalle.php" method="post">
                                <input type="text" name="id_detalle_tyt" value="<?php echo $id_detalle_tyt; ?>" hidden>
                                <input type="text" name="id_usuario" value="<?php echo $id_usuario_sesion; ?>" hidden>

                                <div class="form-row">
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
                                            onkeypress='return validaNumericos(event)' value="<?php echo $monto; ?>"
                                            disabled>
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

                                    <div class="form-group col-md-6" id="">
                                        <label for="">Observacion</label>
                                        <input type="text" class="form-control " name="observacion" id="observacion"
                                            value="<?php echo $observacion; ?>" required>
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

                                    <div class="form-group col-md-2" id="">

                                    </div>

                                    <div class="form-group col-md-4" id="">
                                        <label for="">Usuario</label>
                                        <input type="text" class="form-control " name="usuario" id="usuario"
                                            value="<?php echo $usuario; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-12" align="right">
                                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i>
                                            Eliminar</button>
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