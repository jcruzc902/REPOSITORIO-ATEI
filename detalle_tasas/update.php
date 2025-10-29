<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../layout/mensajes.php');

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
                    <h1 class="m-0"><b>Actualizar Datos de Resolucion: Codigo de Pago
                            <?php echo $codigo_pago; ?></b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/detalle_tasas/index.php"><i
                                    class="bi bi-card-checklist"></i> Resolucion</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-pencil"></i> Actualizar Resolucion</a>
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
                            <h3 class="card-title">Digite los datos de la resolucion a actualizar</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: inline;">



                            <form action="../app/controllers/detalle_tasas/update.php" method="post" enctype="multipart/form-data" id="add-form">
                                <input type="text" name="id_detalle_tyt" value="<?php echo $id_detalle_tyt; ?>" hidden>
                                <input type="text" name="id_usuario" value="<?php echo $id_usuario_sesion; ?>" hidden>
                                <input type="text" name="id_tasas_tarifas" value="<?php echo $id_tasas_tarifas; ?>" hidden>

                                <div class="form-row">




                                    <div class="form-group col-md-3" id="">
                                        <label for="">EJM: RESOLUCION RECTORAL N° 7418-2020-CU-UNFV</label>
                                        <input class="form-control-file" type="file" name="nuevo_archivo"
                                            accept=".pdf,.PDF" id="archivo">
                                    </div>



                                    <?php
                                    $sql_resolucion = "SELECT * FROM tb_resoluciones_tyt where nombre_resolucion_tyt='$resolucion' ORDER BY archivo ASC";
                                    $query_resolucion = $pdo->prepare($sql_resolucion);
                                    $query_resolucion->execute();
                                    $resolucion_datos = $query_resolucion->fetchAll(PDO::FETCH_ASSOC);
                                    ?>


                                    <div class="form-group col-md-2" id="">
                                        <label for="">Monto</label>
                                        <input type="text" class="form-control " name="monto" id="monto"
                                            onkeypress='return validaNumericos(event)' value="<?php echo $monto; ?>">
                                    </div>


                                    <div class="form-group col-md-2" id="campo_estado">
                                        <label for="">Estado</label>
                                        <select class="form-control " name="id_estado_resolucion" id="combo_estado"
                                            style="width:100%" required>
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
                                            value="<?php echo $observacion; ?>">
                                    </div>

                                </div>


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

<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>