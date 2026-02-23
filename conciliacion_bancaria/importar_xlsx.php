<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');
include('../layout/mensajes.php');

include('../app/controllers/mes_conciliacion/listado_mes_conciliacion.php');
include('../app/controllers/anio_cb/listado_anio_cb.php');
include('../app/controllers/facultades_cb/listado_facultades_cb.php');
include('../app/controllers/clasificador_cb/listado_clasificador_cb.php');
include('../app/controllers/banco_cb/listado_banco_cb.php');
include('../app/controllers/cta_cb/listado_cta_cb.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Importar datos de Notas de Abono</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/conciliacion_bancaria"><i class="bi bi-cash"></i> Conciliacion bancaria</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-clipboard-check"></i> Importar datos de Conciliacion Bancaria</a></li>
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
                            <h3 class="card-title">Importe el archivo Excel para cargar los datos sobre notas de abono
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: inline;">
                            <form action="../app/controllers/conciliacion_bancaria/importar_xlsx.php" method="post"
                                enctype="multipart/form-data">
                                <input type="text" name="id_usuario" value="<?php echo $id_usuario_sesion; ?>" hidden>

                                <div class="form-row">

                                    <?php
                                    
                                        $anio_actual= date('Y');
                                    
                                    ?>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Mes conciliado</label>
                                        <select class="form-control " id="mes" name="mes"
                                            style="width:100%;" required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($mes_datos as $mes_dato) { ?>
                                                <option value="<?php echo $mes_dato['nombre_mes']; ?>" >
                                                    <?php echo $mes_dato['nombre_mes']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Año</label>
                                        <select class="form-control " id="anio" name="anio"
                                            style="width:100%;" required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($anio_cb_datos as $anio_cb_dato) { ?>
                                                <option value="<?php echo $anio_cb_dato['anio_nt']; ?>" <?php if ($anio_cb_dato['anio_nt'] == $anio_actual) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $anio_cb_dato['anio_nt']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Archivo</label>
                                            <input class="form-control-file" type="file" name="dataConciliacion"
                                            accept=".xlsx" required>
                                        </div>
                                    </div>

                                    <script>
                                        $(document).ready(function () {

                                            $('#mes').select2({
                                                theme: 'bootstrap4',
                                            });

                                            $('#anio').select2({
                                                theme: 'bootstrap4',
                                            });

                                            

                                        });
                                    </script>



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
                                    <img src="../public/images/formato_carga_conciliacion.png" style="width: 90%;">
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