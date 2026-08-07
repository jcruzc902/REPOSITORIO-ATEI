<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');
include('../layout/mensajes.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Importar datos de Recaudacion de Ingresos</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/recaudacion_ingresos"><i class="bi bi-file-earmark-text"></i> Recaudacion de Ingresos</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-clipboard-check"></i> Importar datos de Recaudacion</a></li>
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
                            <h3 class="card-title">Importe el archivo Excel para cargar los datos sobre la recaudacion de ingresos
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: inline;">
                            <form action="../app/controllers/recaudacion_ingresos/importar_xlsx.php" method="post"
                                enctype="multipart/form-data">
                                <input type="text" name="id_usuario" value="<?php echo $id_usuario_sesion; ?>" hidden>

                                <div class="form-row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Archivo</label>
                                            <input class="form-control-file" type="file" name="dataRecaudacion"
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
                                    <img src="../public/images/plantilla_recaudacion_archivo.png" style="width: 90%;">
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