<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');
include('../layout/mensajes.php');

include('../app/controllers/modalidad_tyt/listado_modalidad_tyt.php');
include('../app/controllers/concepto_tyt/listado_concepto_tyt.php');
include('../app/controllers/referencia_tyt/listado_referencia_tyt.php');
include('../app/controllers/dependencia_tyt/listado_dependencia_tyt.php');
include('../app/controllers/cuenta_tyt/listado_cuenta_tyt.php');
include('../app/controllers/resolucion_rectoral/listado_resolucion_tyt.php');
include('../app/controllers/situacion_tyt/listado_situacion_tyt.php');
include('../app/controllers/tipo_tyt/listado_tipo_tyt.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Importar datos de Tasas y Tarifas</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/tasas_tarifas"><i
                                    class="bi bi-bar-chart-fill"></i> Tasas y Tarifas</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-clipboard-check"></i> Importar datos de Tasas
                            y Tarifas</a></li>
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
                            <h3 class="card-title">Importe el archivo Excel para cargar los datos sobre tasas y tarifas
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: inline;">
                            <form action="../app/controllers/tasas_tarifas/importar_xlsx.php" method="post"
                                enctype="multipart/form-data">
                                <input type="text" name="id_usuario" value="<?php echo $id_usuario_sesion; ?>" hidden>

                                <div class="form-row">


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Archivo</label>
                                            <input class="form-control-file" type="file" name="dataTasas_Tarifas"
                                            accept=".xlsx" required>
                                        </div>
                                    </div>



                                    <hr style="width:100%;background-color: black;">

                                    <div class="form-group col-md-12" align="right">
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i>
                                            Guardar</button>
                                        <a href="index" class="btn" style="background-color: grey; color: white;"><i
                                                class="bi bi-x-circle-fill"></i> Cancelar</a>

                                    </div>
                                </div>

                                <div class="text-center">

                                    <h5 class="text-left text-danger text-bold"><i
                                            class="bi bi-exclamation-triangle-fill"></i> NOTA: PARA SUBIR EL ARCHIVO DE
                                        LA FORMA CORRECTA, ORDENE LAS COLUMNAS SEGUN EL FORMATO DE LA IMAGEN</h5>
                                    <img src="../public/images/formato_carga.png" style="width: 90%;">
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

<?php include('../layout/parte2.php'); ?>