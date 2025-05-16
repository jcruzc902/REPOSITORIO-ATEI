<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');
include ('../layout/mensajes.php');

include ('../app/controllers/devolucion/show_devolucion.php');

include ('../app/controllers/anio_periodo/listado_de_periodo.php');
include ('../app/controllers/anio_nt/listado_de_anios.php');
include ('../app/controllers/dependencias/listado_de_dependencias.php');
include ('../app/controllers/doc_pago/listado_de_docpago.php');
include ('../app/controllers/anio_envio/listado_de_envio.php');
include ('../app/controllers/condicion/listado_de_condiciones.php');
include ('../app/controllers/condicion2/listado_de_condiciones_2.php');
include ('../app/controllers/estado_devolucion/listado_de_devolucion.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Actualizar Datos de Devolucion de Dinero</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/devoluciones"><i
                                    class="bi bi-card-checklist"></i> Devoluciones de Dinero</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-pencil"></i> Actualizar Datos de Devolucion
                            de Dinero</a></li>
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
                            <h3 class="card-title">Digite los datos de la devolucion de dinero a actualizar</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: inline;">



                            <form action="../app/controllers/devolucion/update.php" method="post">
                                <input class="form-control " type="text" name="id_devolucion_dinero" value="<?php echo $id_devolucion; ?>" hidden>
                                <input class="form-control " type="text" name="id_usuario" value="<?php echo $id_usuario_sesion; ?>" hidden>
                                <div class="form-row">


                                    <div class="form-group col-md-2" id="campo_periodo">
                                        <label for="">Periodo</label>
                                        <select class="form-control " name="id_anio_periodo" style="width:100%"
                                            id="comboperiodo">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($anio_periodo_datos as $anio_periodo_dato) {
                                                $anio_periodo_tabla = $anio_periodo_dato['anio_periodo'];
                                                $id_anio_periodo = $anio_periodo_dato['id_anio_periodo']; ?>
                                                <option value="<?php echo $id_anio_periodo; ?>" <?php if ($anio_periodo_tabla == $periodo_anio) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $anio_periodo_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2" id="campo_nt">
                                        <label for="">NT.</label>
                                        <input type="text" class="form-control " onkeypress='return validaNumericos(event)' name="nt" id="numero_tramite" value="<?php echo $numero_tramite; ?>" required>
                                    </div>





                                    <div class="form-group col-md-2" id="campo_anio_nt">
                                        <label for="">Año</label>
                                        <select class="form-control " name="id_anio_nt" id="comboaniont"
                                            style="width:100%" required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($anios_datos as $anios_dato) {
                                                $anio_nt_tabla = $anios_dato['anio_nt'];
                                                $id_anio_nt = $anios_dato['id_anio_nt']; ?>
                                                <option value="<?php echo $id_anio_nt; ?>" <?php if ($anio_nt_tabla == $nt_anio) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $anio_nt_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>


                                    <div class="form-group col-md-2" id="campo_proveido">
                                        <label for="">Proveido</label>
                                        <input type="text" class="form-control " onkeypress='return validaNumericos(event)'  name="proveido" id="proveido" value="<?php echo $proveido; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="campo_fecha_proveido">
                                        <label for="">Fecha</label>
                                        <input type="date" class="form-control " name="fecha_proveido" id="fecha_proveido" value="<?php echo $fecha_proveido; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="espaciado1">

                                    </div>

                                    <div class="form-group col-md-2" id="campo_oficio">
                                        <label for="">Oficio</label>
                                        <input type="text" class="form-control " name="oficio" value="<?php echo $oficio; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="campo_fecha_oficio">
                                        <label for="">Fecha</label>
                                        <input type="date" class="form-control " name="fecha_oficio" value="<?php echo $fecha_oficio; ?>">
                                    </div>

                                    <div class="form-group col-md-6" id="campo_observacion">
                                        <label for="">Observación</label>
                                        <input class="form-control" type="text" name="observacion_devolucion" value="<?php echo $observacion; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="espaciado2">
                                        
                                    </div>
                                    
                                    <?php

                                    //si el usuario es john o william, autoincrementa el numero de informe
                                    if($id_usuario_sesion==5 || $id_usuario_sesion==10){
                                        $anio_actual = date("Y"); //anio

                                        $sql_devoluciones = "SELECT MAX(informe) as numero_informe FROM tb_devoluciones WHERE YEAR(fecha_informe)='$anio_actual' AND visible!=1";
                                        $query_devoluciones = $pdo->prepare($sql_devoluciones);
                                        $query_devoluciones->execute();
                                        $devolucion_datos = $query_devoluciones->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($devolucion_datos as $devolucion_dato) {
                                            $numero_informe = $devolucion_dato['numero_informe'];
                                        }

                                        if ($numero_informe != null) {
                                            $numero_informe = $devolucion_dato['numero_informe'] + 1; //autoincrementa el numero de informe
                                        } else {
                                            $numero_informe = 1; //empieza con 1
                                        }
                                    }else{
                                        $numero_informe= $informe;
                                    }

                                    

                                    
                                    ?>
                                    

                                    <div class="form-group col-md-2" id="campo_informe">
                                        <label for="">Informe</label>
                                        <input type="text" class="form-control " name="informe" id="informe" value="<?php echo $numero_informe; ?>" >
                                    </div>

                                    <div class="form-group col-md-2" id="campo_fecha_informe">
                                        <label for="">Fecha</label>
                                        <input type="date" class="form-control " name="fecha_informe" id="fecha_informe" value="<?php echo $fecha_informe; ?>">
                                    </div>

                                    <div class="form-group col-md-4" id="campo_dependencia">
                                        <label for="">Facultad/Dependencia</label>
                                        <select class="form-control " name="id_dependencia" style="width:100%"
                                            id="combofacultad">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($dependencias_datos as $dependencias_dato) {
                                                $nombre_dependencia_tabla = $dependencias_dato['nombre'];
                                                $id_dependencia = $dependencias_dato['id_dependencia']; ?>
                                                <option value="<?php echo $id_dependencia; ?>" <?php if ($nombre_dependencia_tabla == $dependencia) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $nombre_dependencia_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="campo_estado_devolucion">
                                        <label for="">Estado</label>
                                        <select class="form-control " name="id_estado" style="width:100%"
                                            id="combo_estado">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($estado_devolucion_datos as $estado_devolucion_dato) {
                                                $nombre_estado_devolucion_tabla = $estado_devolucion_dato['nombre_estado_devolucion'];
                                                $id_estado_devolucion = $estado_devolucion_dato['id_estado_devolucion']; ?>
                                                <option value="<?php echo $id_estado_devolucion; ?>" <?php if ($nombre_estado_devolucion_tabla == $estado_devolucion) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $nombre_estado_devolucion_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>



                                    <div class="form-group col-md-2" style="line-height: 100px;" id="boton_ingresos">
                                        <a href="javascript:window.open('../app/controllers/devolucion/recargar.php','','width=1650, height=800');" id="boton_vouchers" class="btn btn-lg"
                                            style="background-color: black; color: white;" >
                                            <i class="bi bi-box-arrow-in-up-right"></i> Consulta de Ingresos</a>

                                    </div>

                                    <script>
                                        $('#boton_vouchers').click(function () {
                                            var numero_tramite = $('#numero_tramite').val();
                                            var anio_nt = $('#comboaniont').val();

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
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i>
                                            Guardar</button>
                                        <a href="index" class="btn" style="background-color: grey; color: white;"><i
                                                class="bi bi-x-circle-fill"></i> Cancelar</a>

                                    </div>
                                </div>

                                <script>
                                    function validaNumericos(event) {
                                        if (event.charCode >= 48 && event.charCode <= 57) {
                                            return true;
                                        }
                                        return false;
                                    }
                                </script>

                                <script>
                                    $(document).ready(function () {
                                        $('#comboperiodo').select2({
                                            theme: 'bootstrap4',
                                        });



                                        $('#comboaniont').select2({
                                            theme: 'bootstrap4',
                                        });
                                        $('#combofacultad').select2({
                                            theme: 'bootstrap4',
                                        });


                                        $('#combo_estado').select2({
                                            theme: 'bootstrap4',
                                        });

                                      

                                    });
                                </script>

                                <?php if ($rol_sesion == "SECRETARIA") { ?>
                                    <script>
                                        //ocultar las secciones
                                        document.getElementById('campo_periodo').style.display = 'inline';
                                        document.getElementById('campo_nt').style.display = 'inline';
                                        document.getElementById('campo_anio_nt').style.display = 'inline';
                                        document.getElementById('campo_proveido').style.display = 'inline';
                                        document.getElementById('campo_fecha_proveido').style.display = 'inline';
                                        document.getElementById('espaciado1').style.display = 'inline';
                                        document.getElementById('campo_oficio').style.display = 'inline';
                                        document.getElementById('campo_fecha_oficio').style.display = 'inline';
                                        document.getElementById('campo_observacion').style.display = 'inline';
                                        document.getElementById('campo_informe').style.display = 'none';
                                        document.getElementById('campo_fecha_informe').style.display = 'none';
                                        document.getElementById('campo_dependencia').style.display = 'none';
                                        document.getElementById('campo_estado_devolucion').style.display = 'none';
                                        document.getElementById('boton_ingresos').style.display = 'inline';
                                        



                                    </script>
                                <?php } else if ($rol_sesion == "JEFATURA") { ?>
                                        <script>
                                            //ocultar las secciones
                                            document.getElementById('campo_periodo').style.display = 'inline';
                                            document.getElementById('campo_nt').style.display = 'inline';
                                            document.getElementById('campo_anio_nt').style.display = 'inline';
                                            document.getElementById('campo_proveido').style.display = 'inline';
                                            document.getElementById('campo_fecha_proveido').style.display = 'inline';
                                            document.getElementById('espaciado1').style.display = 'inline';
                                            document.getElementById('campo_oficio').style.display = 'inline';
                                            document.getElementById('campo_fecha_oficio').style.display = 'inline';
                                            document.getElementById('campo_informe').style.display = 'inline';
                                            document.getElementById('campo_fecha_informe').style.display = 'inline';
                                            document.getElementById('campo_dependencia').style.display = 'inline';
                                            document.getElementById('boton_ingresos').style.display = 'inline';
                                            document.getElementById('campo_observacion').style.display = 'inline';


                                        </script>

                                <?php } else if ($rol_sesion == "ADMINISTRADOR") { ?>
                                            <script>
                                                //ocultar las secciones
                                                document.getElementById('campo_periodo').style.display = 'inline';
                                                document.getElementById('campo_nt').style.display = 'inline';
                                                document.getElementById('campo_anio_nt').style.display = 'inline';
                                                document.getElementById('campo_proveido').style.display = 'inline';
                                                document.getElementById('campo_fecha_proveido').style.display = 'inline';
                                                document.getElementById('espaciado1').style.display = 'inline';
                                                document.getElementById('campo_oficio').style.display = 'inline';
                                                document.getElementById('campo_fecha_oficio').style.display = 'inline';
                                                document.getElementById('campo_informe').style.display = 'inline';
                                                document.getElementById('campo_fecha_informe').style.display = 'inline';
                                                document.getElementById('campo_dependencia').style.display = 'inline';
                                                document.getElementById('boton_ingresos').style.display = 'inline';
                                                document.getElementById('campo_observacion').style.display = 'inline';


                                            </script>

                                <?php } else if ($rol_sesion == "INGRESOS") { ?>
                                            <script>
                                                //ocultar las secciones
                                                document.getElementById('campo_periodo').style.display = 'none';
                                                document.getElementById('campo_nt').style.display = 'none';
                                                document.getElementById('campo_anio_nt').style.display = 'none';
                                                document.getElementById('campo_proveido').style.display = 'none';
                                                document.getElementById('campo_fecha_proveido').style.display = 'none';
                                                document.getElementById('espaciado1').style.display = 'none';
                                                document.getElementById('campo_oficio').style.display = 'none';
                                                document.getElementById('campo_fecha_oficio').style.display = 'none';
                                                document.getElementById('campo_observacion').style.display = 'none';
                                                document.getElementById('espaciado2').style.display = 'none';
                                                document.getElementById('campo_informe').style.display = 'inline';
                                                document.getElementById('campo_fecha_informe').style.display = 'inline';
                                                document.getElementById('campo_dependencia').style.display = 'inline';
                                                document.getElementById('boton_ingresos').style.display = 'inline';
                                                


                                            </script>

                                <?php } else if ($rol_sesion == "PAGADURIA") { ?>
                                            <script>
                                                //ocultar las secciones
                                                document.getElementById('campo_periodo').style.display = 'none';
                                                document.getElementById('campo_nt').style.display = 'none';
                                                document.getElementById('campo_anio_nt').style.display = 'none';
                                                document.getElementById('campo_proveido').style.display = 'none';
                                                document.getElementById('campo_fecha_proveido').style.display = 'none';
                                                document.getElementById('espaciado1').style.display = 'none';
                                                document.getElementById('campo_oficio').style.display = 'none';
                                                document.getElementById('campo_fecha_oficio').style.display = 'none';
                                                document.getElementById('campo_informe').style.display = 'none';
                                                document.getElementById('campo_fecha_informe').style.display = 'none';
                                                document.getElementById('campo_dependencia').style.display = 'none';
                                                document.getElementById('boton_ingresos').style.display = 'none';
                                                


                                            </script>

                                <?php } ?>
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