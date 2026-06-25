<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');

include ('../app/controllers/devolucion/show_devolucion.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Datos de Devolucion de Dinero</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/devoluciones"><i
                                    class="bi bi-card-checklist"></i> Devoluciones</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-search"></i> Informacion de Devolucion de Dinero</a></li>
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
                            <h3 class="card-title">Informacion de Devolucion de Dinero seleccionado</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: block;">



                            <form action="#">

                                <div class="form-row">

                                    <div class="form-group col-md-1" id="">
                                        <label for="">Periodo</label>
                                        <input class="form-control" type="text" 
                                            value="<?php echo $periodo_anio; ?>" readonly>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">NT</label>
                                        <input class="form-control" id="numero_tramite" type="text" 
                                            value="<?php echo $numero_tramite; ?>" readonly>
                                    </div>

                                    <input class="form-control" type="text" id="anio_nt" value="<?php echo $id_anio_nt; ?>" hidden>

                                    <div class="form-group col-md-1" id="">
                                        <label for="">Año</label>
                                        <input class="form-control" type="text" 
                                            value="<?php echo $nt_anio; ?>" readonly>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Proveido</label>
                                        <input class="form-control" type="text" 
                                            value="<?php echo $proveido; ?>" id="proveido" readonly>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha</label>
                                        <input class="form-control" type="date" 
                                            value="<?php echo $fecha_proveido; ?>" id="fecha_proveido" readonly>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Oficio</label>
                                        <input class="form-control" type="text" 
                                            value="<?php echo $oficio; ?>" readonly>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha</label>
                                        <input class="form-control" type="date" 
                                            value="<?php echo $fecha_oficio; ?>" readonly>
                                    </div>

                                    <div class="form-group col-md-6" id="">
                                        <label for="">Observación</label>
                                        <input class="form-control" type="text" 
                                            value="<?php echo $observacion; ?>" readonly>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Informe</label>
                                        <input class="form-control" type="text" 
                                            value="<?php echo $informe; ?>" id="informe" readonly>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha</label>
                                        <input class="form-control" type="date" 
                                            value="<?php echo $fecha_informe; ?>" id="fecha_informe" readonly>
                                    </div>

                                    <?php
                                        if($dependencia=="SELECCIONAR"){
                                            $dependencia="";
                                        }
                                    ?>

                                    <input type="text" value="<?php echo $id_dependencia; ?>" id="combofacultad" hidden>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Dependencia</label>
                                        <input class="form-control" type="text" 
                                            value="<?php echo $dependencia; ?>" readonly>
                                    </div>

                                    <?php
                                        $theDate = new DateTime($fecha_registro);
                                        $fecha_registro = $theDate->format('d/m/Y h:i:s a');
                                    ?>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha de Registro</label>
                                        <input class="form-control" type="text" 
                                            value="<?php echo $fecha_registro; ?>" readonly>
                                    </div>


                                    <div class="form-group col-md-2" id="">
                                        <label for="">Usuario</label>
                                        <input class="form-control" type="text" 
                                            value="<?php echo $usuario; ?>" readonly>
                                    </div>

                                    <div class="form-group col-md-2" style="line-height: 100px;" id="boton_ingresos">
                                        <a href="javascript:window.open('../app/controllers/devolucion/recargar.php','','width=1650, height=800');" id="boton_vouchers" class="btn btn-lg"
                                            style="background-color: black; color: white;" >
                                            <i class="bi bi-box-arrow-in-up-right"></i> Consulta de Ingresos</a>

                                    </div> 

                                    <script>
                                        $('#boton_vouchers').click(function () {
                                            var numero_tramite = $('#numero_tramite').val();
                                            var anio_nt = $('#anio_nt').val();

                                            var proveido = $('#proveido').val();
                                            var fecha_proveido = $('#fecha_proveido').val(); 

                                            var informe = $('#informe').val();
                                            var fecha_informe = $('#fecha_informe').val();

                                            var facultad = $('#combofacultad').val();

                                            var url = "../app/controllers/devolucion/global.php"; 
                                            $.get(url, { numero_tramite: numero_tramite, anio_nt: anio_nt, proveido: proveido, fecha_proveido: fecha_proveido, 
                                                informe: informe, fecha_informe: fecha_informe, facultad: facultad}, function (datos) { });

                                        });
                                    </script>

                                    

                                    



                                    

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

<?php include ('../layout/mensajes.php'); ?>
<?php include ('../layout/parte2.php'); ?>