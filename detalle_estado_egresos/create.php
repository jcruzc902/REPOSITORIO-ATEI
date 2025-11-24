<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../layout/mensajes.php');
include('../app/controllers/estado_giro/listado_de_estado_giro.php');
include('../app/controllers/resolucion_egresos/listado_resolucion_egresos.php');
include('../app/controllers/anio_nt/listado_de_anios.php');
include('../app/controllers/detalles/listado_detalles.php');
include('../app/controllers/especialidades/listado_de_especialidades.php');

if (
    isset($_SESSION['facultad']) && isset($_SESSION['actividad']) && !isset($_SESSION['subactividad']) && isset($_SESSION['saldo_inicial']) && isset($_SESSION['periodo']) && isset($_SESSION['id_egresos'])
) {
    $facultad = $_SESSION['facultad'];
    $actividad = $_SESSION['actividad'];
    $saldo_inicial = $_SESSION['saldo_inicial'];
    $periodo_anio = $_SESSION['periodo'];
    $id_egresos = $_SESSION['id_egresos'];
} else if (isset($_SESSION['facultad']) && isset($_SESSION['actividad']) && isset($_SESSION['subactividad']) && isset($_SESSION['saldo_inicial']) && isset($_SESSION['periodo']) && isset($_SESSION['id_egresos'])) {
    $facultad = $_SESSION['facultad'];
    $actividad = $_SESSION['actividad'];
    $subactividad = $_SESSION['subactividad'];
    $saldo_inicial = $_SESSION['saldo_inicial'];
    $periodo_anio = $_SESSION['periodo'];
    $id_egresos = $_SESSION['id_egresos'];
} else {
    $facultad = "";
    $actividad = "";
    $subactividad = "";
    $saldo_inicial = "";
    $periodo_anio = "";
    $id_egresos = "";
}






?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0"><b>Registrar Nuevo Pago</b></h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/detalle_estado_egresos/index.php"><i
                                    class="bi bi-card-checklist"></i> Detalle Estado de Egreso</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-clipboard-check"></i> Registrar nuevo
                            pago</a></li>
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
                            <h4 class="card-title">Digite los datos a detallar sobre el nuevo egreso</h4>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: inline;">
                            <form action="../app/controllers/detalle_estado_egresos/create.php" method="post">

                                <div id="show_item">
                                    <div class="form-row">
                                        <input type="text" name="id_usuario" value="<?php echo $id_usuario_sesion; ?>"
                                            hidden>
                                        <input type="text" name="facultad" value="<?php echo $facultad; ?>" hidden>
                                        <input type="text" name="actividad" value="<?php echo $actividad; ?>" hidden>
                                        <input type="text" name="subactividad" value="<?php echo $subactividad; ?>" hidden>
                                        <input type="text" name="saldo_inicial" value="<?php echo $saldo_inicial; ?>"
                                            hidden>
                                        <input type="text" name="periodo" value="<?php echo $periodo_anio; ?>" hidden>

                                        <input type="text" name="id_egresos" value="<?php echo $id_egresos; ?>" hidden>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">NT Principal</label>
                                            <input type="text" class="form-control " name="nt_principal" id="nt"
                                                oninput="copiarDato()" onkeypress='return validaNumericos(event)'
                                                placeholder="Numero Tramite" required>
                                        </div>

                                        <?php
                                        date_default_timezone_set("America/Lima");
                                        $anio_nt = date('Y'); //año actual
                                        ?>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Año NT</label>
                                            <select class="form-control " name="anio_nt_principal" id="anio_nt"
                                                style="width:100%" required>
                                                <option value="">SELECCIONAR</option>
                                                <?php
                                                foreach ($anios_datos as $anios_dato) {
                                                    $anio_nt_tabla = $anios_dato['anio_nt'];
                                                    $id_anio_nt = $anios_dato['id_anio_nt'];
                                                    ?>
                                                    <option value="<?php echo $anios_dato['id_anio_nt']; ?>" <?php if ($anio_nt_tabla == $anio_nt) { ?> selected="selected" <?php } ?>>
                                                        <?php echo $anios_dato['anio_nt']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>

                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">NT del Expediente</label>
                                            <input type="text" class="form-control " name="nt_expediente"
                                                id="nt_expediente" placeholder="Numero Tramite">
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Año NT</label>
                                            <select class="form-control " name="anio_nt_expediente"
                                                id="anio_nt_expediente" style="width:100%">
                                                <option value="SELECCIONAR">SELECCIONAR</option>
                                                <?php
                                                foreach ($anios_datos as $anios_dato) {
                                                    $anio_nt_tabla = $anios_dato['anio_nt'];
                                                    $id_anio_nt = $anios_dato['id_anio_nt'];
                                                    ?>
                                                    <option value="<?php echo $anios_dato['id_anio_nt']; ?>">
                                                        <?php echo $anios_dato['anio_nt']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>

                                        </div>

                                        <div class="form-group col-md-4" id="">

                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Proveido Contabilidad</label>
                                            <input type="text" class="form-control " name="proveido_contabilidad"
                                                id="nt" onkeypress='return validaNumericos(event)'
                                                placeholder="Numero-Año">
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Proveido Contabilidad</label>
                                            <input type="date" class="form-control " name="fecha_proveido_contabilidad"
                                                id="fecha_proveido_contabilidad">
                                        </div>


                                        <div class="form-group col-md-2" id="">
                                            <label for="">Proveido DIGA</label>
                                            <input type="text" class="form-control " name="proveido_diga"
                                                id="proveido_diga" onkeypress='return validaNumericos(event)'
                                                placeholder="Numero-Año">
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Proveido DIGA</label>
                                            <input type="date" class="form-control " name="fecha_proveido_diga"
                                                id="fecha_proveido_diga">
                                        </div>

                                        <div class="form-group col-md-4" id="">

                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Oficio OCLSA-ORH</label>
                                            <input type="text" class="form-control " name="oficio_oclsa_orh"
                                                id="oficio_oclsa_orh" placeholder="Numero-Año-Dependencias">
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Oficio</label>
                                            <input type="date" class="form-control " name="fecha_oclsa_orh"
                                                id="fecha_oclsa_orh">
                                        </div>





                                        <div class="form-group col-md-2" id="">
                                            <label for="">Resolución</label>
                                            <div style="display: flex;">
                                                <select class="form-control " name="resolucion" id="resolucion"
                                                    style="width:100%">
                                                    <option value="SELECCIONAR">SELECCIONAR</option>
                                                    <?php
                                                    foreach ($resolucion_egresos_datos as $resolucion_egresos_dato) {
                                                        $resolucion_tabla = $resolucion_egresos_dato['resolucion'];
                                                        $id_resoluciones_egresos = $resolucion_egresos_dato['id_resoluciones_egresos'];
                                                        ?>
                                                        <option
                                                            value="<?php echo $resolucion_egresos_dato['resolucion']; ?>">
                                                            <?php echo $resolucion_egresos_dato['resolucion']; ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#modal-create-resolucion">+</button>
                                            </div>


                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Resolución</label>
                                            <select class="form-control " name="fecha_resolucion" id="fecha_resolucion"
                                                style="width:100%">
                                                <option value="SELECCIONAR">SELECCIONAR</option>


                                            </select>
                                        </div>

                                        <script>
                                            $(document).ready(function () {

                                                $('#resolucion').change(function () {

                                                    //$('#combo_subactividad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

                                                    $("#resolucion option:selected").each(function () {
                                                        var resolucion = $('#resolucion').val();
                                                        $.post("../app/controllers/resolucion_egresos/consulta_resolucion.php",
                                                            { resolucion: resolucion }, function (data) {
                                                                $("#fecha_resolucion").html(data);
                                                            });
                                                    });

                                                });
                                            });
                                        </script>


                                        <div class="form-group col-md-4" id="">

                                        </div>



                                        <div class="form-group col-md-4" id="">
                                            <label for="">Especialidad</label>
                                            <div style="display: flex;">
                                                <select class="form-control " name="especialidad" id="especialidad"
                                                    style="width:100%">
                                                    <option value="SELECCIONAR">SELECCIONAR</option>
                                                    <?php
                                                    foreach ($especialidades_datos as $especialidades_dato) {
                                                        $nombre_especialidad_tabla = $especialidades_dato['nombre_especialidad'];
                                                        $id_especialidades = $especialidades_dato['id_especialidades'];
                                                        ?>
                                                        <option
                                                            value="<?php echo $especialidades_dato['nombre_especialidad']; ?>">
                                                            <?php echo $especialidades_dato['nombre_especialidad']; ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#modal-create-especialidad">+</button>
                                            </div>


                                        </div>





                                        <div class="form-group col-md-2" id="">
                                            <label for="">Periodo de pago</label>
                                            <input type="text" class="form-control " name="periodo_pago"
                                                id="periodo_pago" placeholder="Periodo">
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">N° Comprobante</label>
                                            <input type="text" class="form-control " name="numero_comprobante"
                                                id="numero_comprobante" placeholder="Numero de Comprobante">
                                        </div>

                                        <div class="form-group col-md-4" id="">

                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">N° Orden de Compra</label>
                                            <input type="text" class="form-control " name="orden_compra"
                                                id="orden_compra" onkeypress='return validaNumericos(event)'
                                                placeholder="N° Orden Compra">
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">N° Orden de Servicio</label>
                                            <input type="text" class="form-control " name="orden_servicio"
                                                id="orden_servicio" onkeypress='return validaNumericos(event)'
                                                placeholder="N° Orden Servicio">
                                        </div>


                                        <div class="form-group col-md-2" id="">
                                            <label for="">SIAF</label>
                                            <input type="text" class="form-control " name="siaf" id="siaf"
                                                onkeypress='return validaNumericos(event)' placeholder="N° SIAF">
                                        </div>

                                        <div class="form-group col-md-6" id="">

                                        </div>

                                        <?php


                                        function conexion()
                                        {

                                            try {
                                                $conn = new PDO('mysql:host=localhost;dbname=aplicativo_tesoreria_interno', 'root', 'Huaweiy635');
                                            } catch (PDOException $e) {
                                                echo "Error " . $e;
                                            }

                                            return $conn;
                                        }

                                        $con = conexion();
                                        $total_egresos_acumulado = current($con->query("SELECT MAX(egresos) as maximo_egresos FROM tb_detalle_egresos WHERE facultad='$facultad' AND actividad_principal='$actividad' AND subactividad='$subactividad' AND estado_giro='APROBADO' AND visible!=1")->fetch());

                                        $total_ingresos_acumulado = current($con->query("SELECT ingresos FROM tb_detalle_egresos WHERE egresos='$total_egresos_acumulado'")->fetch());


                                        if ($total_egresos_acumulado == null) {
                                            $total_egresos_acumulado = 0;
                                        }

                                        if ($total_ingresos_acumulado == null) {
                                            $total_ingresos_acumulado = $saldo_inicial;
                                        }


                                        #$total_egresos_acumulado = 0;
                                        
                                        #$total_ingresos_acumulado = 0;
                                        
                                        ?>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Monto (S/.)</label>
                                            <input type="text" class="form-control " name="monto" id="monto"
                                                onkeypress='return validaNumericos(event)' placeholder="Monto"
                                                value="<?php echo 0; ?>">
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Egresos(S/.)</label>
                                            <input type="text" class="form-control " name="egresos" id="total_egresos"
                                                value="<?php echo $total_egresos_acumulado; ?>">
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Saldo de Ingresos(S/.)</label>
                                            <input type="text" class="form-control " name="saldo_ingresos"
                                                id="total_egresos" value="<?php echo $total_ingresos_acumulado; ?>"
                                                readonly>
                                        </div>



                                        <div class="form-group col-md-6" id="">

                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Nota de Pago</label>
                                            <input type="text" class="form-control " name="nota_pago" id="nota_pago"
                                                placeholder="N° Nota de Pago">
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Giro</label>
                                            <input type="date" class="form-control " name="fecha_giro" id="fecha_giro">
                                        </div>

                                        <?php

                                        $estado_giro = "PENDIENTE";

                                        ?>


                                        <div class="form-group col-md-2" id="">
                                            <label for="">Estado de Giro</label>
                                            <select class="form-control " name="estado_giro" id="estado_giro"
                                                style="width:100%">
                                                <option value="SELECCIONAR">SELECCIONAR</option>
                                                <?php
                                                foreach ($estado_giro_datos as $estado_giro_dato) {
                                                    $estado_giro_tabla = $estado_giro_dato['estado'];
                                                    $id_estado_giro = $estado_giro_dato['id_estado_giro'];
                                                    ?>
                                                    <option value="<?php echo $estado_giro_dato['estado']; ?>" <?php if ($estado_giro_tabla == $estado_giro) { ?> selected="selected" <?php } ?>>
                                                        <?php echo $estado_giro_dato['estado']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>

                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Pago</label>
                                            <input type="date" class="form-control " name="fecha_pago" id="fecha_pago">
                                        </div>






                                        <div class="form-group col-md-4" id="">

                                        </div>


                                        <div class="form-group col-md-2" id="">
                                            <label for="">Informe de Ingreso</label>
                                            <input type="text" class="form-control " name="informe_ingreso"
                                                id="informe_ingreso" placeholder="Numero-Año"
                                                onkeypress='return validaNumericos(event)'>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Informe Ingreso</label>
                                            <input type="date" class="form-control " name="fecha_informe_ingreso">
                                        </div>

                                        <div class="form-group col-md-4" id="" hidden>
                                            <label for="">Observacion Estado de Giro</label>
                                            <input type="text" class="form-control " name="observacion_giro">
                                        </div>

                                        <div class="form-group col-md-4" id="">
                                            <label for="">Observacion Estado de Giro</label>
                                            <input type="text" class="form-control " name="observacion_giro"
                                                id="observacion_giro" required disabled>
                                        </div>

                                        <script>
                                            $(document).ready(function () {
                                                $('#estado_giro').change(function (e) {
                                                    if ($(this).val() != "ANULADO") {
                                                        document.getElementById("observacion_giro").value = "";
                                                        $('#observacion_giro').prop("disabled", true);


                                                    } else {
                                                        document.getElementById("observacion_giro").value = "";
                                                        $('#observacion_giro').prop("disabled", false);

                                                    }
                                                })
                                            });
                                        </script>



                                        <hr style="width: 100%" id="hr">

                                        <div class="form-group col-md-4" id="">
                                            <label for="">Detalle de pago</label>
                                            <div style="display: flex;">
                                                <select class="form-control " name="detalle_pago" id="detalle_pago"
                                                    style="width:100%">
                                                    <option value="SELECCIONAR">SELECCIONAR</option>
                                                    <?php
                                                    foreach ($detalles_datos as $detalles_dato) {
                                                        $nombre_detalles_tabla = $detalles_dato['nombre_detalles'];
                                                        $id_detalles = $detalles_dato['id_detalles'];
                                                        ?>
                                                        <option value="<?php echo $detalles_dato['nombre_detalles']; ?>">
                                                            <?php echo $detalles_dato['nombre_detalles']; ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>

                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#modal-create-detalle-pago">+</button>
                                            </div>


                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Proveido/Resolucion</label>
                                            <input type="text" class="form-control " name="documento_pago"
                                                id="documento_pago" placeholder="Documento">
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha</label>
                                            <input type="date" class="form-control " name="fecha_documento"
                                                id="fecha_documento">
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Concepto</label>
                                            <input type="text" class="form-control " name="tipo_pago" id="tipo_pago"
                                                placeholder="Concepto">
                                        </div>

                                        <div class="form-group col-md-2" id="">

                                        </div>





                                        <hr style="width: 100%" id="hr">

                                        <div class="col-md-12">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="informe_egresos"
                                                    id="informe_egresos" onclick="activarCampo_InformeEgresos()">
                                                <label class="form-check-label" for="informe_egresos">Emitir Informe de
                                                    Egreso</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12" id="">

                                        </div>


                                        <?php

                                        $anio_actual = date("Y"); //anio
                                        
                                        $sql_detalle_egresos = "SELECT MAX(informe) as numero_informe FROM tb_detalle_egresos WHERE YEAR(fecha_informe)='$anio_actual' AND visible!=1";
                                        $query_detalle_egresos = $pdo->prepare($sql_detalle_egresos);
                                        $query_detalle_egresos->execute();
                                        $detalle_egresos_datos = $query_detalle_egresos->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($detalle_egresos_datos as $detalle_egresos_dato) {
                                            $numero_informe = $detalle_egresos_dato['numero_informe'];
                                        }

                                        if ($numero_informe != null) {
                                            $numero_informe = $detalle_egresos_dato['numero_informe'] + 1; //autoincrementa el numero de informe
                                        } else {
                                            $numero_informe = 1; //empieza con 1
                                        }


                                        ?>

                                        <div class="form-group col-md-2" hidden>
                                            <label for="">N° Informe de Egreso</label>
                                            <input type="text" class="form-control " name="informe">
                                        </div>


                                        <div class="form-group col-md-2" id="">
                                            <label for="">N° Informe de Egreso</label>
                                            <input type="text" class="form-control " name="informe"
                                                id="numero_informe_egreso" disabled>
                                        </div>

                                        <div class="form-group col-md-2" hidden>
                                            <label for="">Fecha Informe</label>
                                            <input type="date" class="form-control " name="fecha_informe">
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Informe</label>
                                            <input type="date" class="form-control " name="fecha_informe"
                                                id="fecha_informe_egreso" disabled>
                                        </div>

                                        <div class="form-group col-md-10" id="">

                                        </div>

                                        <div class="form-group col-md-8" hidden>
                                            <label for="">Asunto</label>
                                            <input type="text" class="form-control " name="asunto_informe_egreso"
                                                placeholder="Describa el asunto para el informe">
                                        </div>

                                        <div class="form-group col-md-8" id="">
                                            <label for="">Asunto</label>
                                            <input type="text" class="form-control " name="asunto_informe_egreso"
                                                id="asunto_informe_egreso"
                                                placeholder="Describa el asunto para el informe" disabled>
                                        </div>

                                        <?php

                                        //convierte cada letra inicial de una palabra en mayuscula
                                        if (isset($facultad) && isset($actividad)) {
                                            $facultad = mb_strtoupper($facultad);
                                            $actividad = mb_strtoupper($actividad);
                                        }

                                        ?>

                                        <div class="form-group col-md-8" hidden>
                                            <label for="">Descripción del informe</label>
                                            <textarea type="text" class="form-control " name="descripcion" rows="4"
                                                placeholder="Descripción del informe"></textarea>
                                        </div>

                                        <div class="form-group col-md-8" id="">
                                            <label for="">Descripción del informe</label>
                                            <textarea type="text" class="form-control " name="descripcion"
                                                id="descripcion" rows="4" placeholder="Descripción del informe"
                                                disabled></textarea>
                                        </div>





                                        <script>

                                            function activarCampo_InformeEgresos() {
                                                var checkbox = document.getElementById("informe_egresos");
                                                var numero_informe_egreso = document.getElementById("numero_informe_egreso");
                                                var fecha_informe_egreso = document.getElementById("fecha_informe_egreso");
                                                var asunto_informe_egreso = document.getElementById("asunto_informe_egreso");
                                                var descripcion = document.getElementById("descripcion");

                                                var resolucion = document.getElementById("resolucion").value; // Obtiene el valor seleccionado del select
                                                var fecha_resolucion = document.getElementById("fecha_resolucion").value;

                                                var fecha_resolucion = fecha_resolucion.replace("/", ".");
                                                var fecha_resolucion = fecha_resolucion.replace("/", ".");

                                                // Si el checkbox está marcado, habilitamos el campo; si no, lo deshabilitamos
                                                if (checkbox.checked) {
                                                    document.getElementById("numero_informe_egreso").value = "<?php echo $numero_informe; ?>";
                                                    numero_informe_egreso.disabled = false; // Activa el campo
                                                    document.getElementById("fecha_informe_egreso").value = "<?php echo date("Y-m-d"); ?>";
                                                    fecha_informe_egreso.disabled = false; // Activa el campo
                                                    asunto_informe_egreso.disabled = false; // Activa el campo
                                                    document.getElementById("descripcion").value = "<?php echo "Por medio del presente se informan los egresos referentes a $actividad, realizado por la $facultad, en mérito a la Resolución Rectoral N° " ?>" + resolucion + "<?php echo "-CU-UNFV, con fecha "; ?>" + fecha_resolucion + "<?php echo "; el cual es el siguiente:"; ?>";
                                                    descripcion.disabled = false; // Activa el campo
                                                } else {
                                                    document.getElementById("numero_informe_egreso").value = "";
                                                    numero_informe_egreso.disabled = true; // Desactiva el campo
                                                    document.getElementById("fecha_informe_egreso").value = "";
                                                    fecha_informe_egreso.disabled = true; // Desactiva el campo
                                                    document.getElementById("asunto_informe_egreso").value = "";
                                                    asunto_informe_egreso.disabled = true; // Desactiva el campo
                                                    document.getElementById("descripcion").value = "";
                                                    descripcion.disabled = true; // Desactiva el campo
                                                }
                                            }

                                        </script>






                                        <hr style="width: 100%" id="hr">

                                        <div class="col-md-12">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="estado_cuenta"
                                                    id="estado_cuenta" onclick="activarCampo_EstadoCuenta()">
                                                <label class="form-check-label" for="estado_cuenta">Emitir Estado de
                                                    Cuenta</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12" id="">

                                        </div>

                                        <?php

                                        $anio_actual = date("Y"); //anio
                                        
                                        $sql_detalle_ec = "SELECT MAX(numero_ec) as numero_estado_cta FROM tb_detalle_egresos WHERE YEAR(fecha_ec)='$anio_actual' AND visible!=1";
                                        $query_detalle_ec = $pdo->prepare($sql_detalle_ec);
                                        $query_detalle_ec->execute();
                                        $detalle_ec_datos = $query_detalle_ec->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($detalle_ec_datos as $detalle_ec_dato) {
                                            $numero_ec = $detalle_ec_dato['numero_estado_cta'];
                                        }

                                        if ($numero_ec != null) {
                                            $numero_ec = $detalle_ec_dato['numero_estado_cta'] + 1; //autoincrementa el numero de informe
                                        } else {
                                            $numero_ec = 1; //empieza con 1
                                        }


                                        ?>

                                        <div class="form-group col-md-2" hidden>
                                            <label for="">N° Estado de Cuenta</label>
                                            <input type="text" class="form-control " name="numero_estado_cuenta">
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">N° Estado de Cuenta</label>
                                            <input type="text" class="form-control " name="numero_estado_cuenta"
                                                id="numero_estado_cuenta" disabled>
                                        </div>

                                        <div class="form-group col-md-2" hidden>
                                            <label for="">Fecha Estado de Cuenta</label>
                                            <input type="date" class="form-control " name="fecha_estado_cuenta">
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Estado de Cuenta</label>
                                            <input type="date" class="form-control " name="fecha_estado_cuenta"
                                                id="fecha_estado_cuenta" disabled>
                                        </div>

                                        <?php

                                        $anio_actual = date("Y");

                                        $numero_informe = str_pad($numero_informe, 3, "0", STR_PAD_LEFT); //rellena con ceros a la izquierda
                                        

                                        ?>

                                        <div class="form-group col-md-10" id="">

                                        </div>

                                        <div class="form-group col-md-8" hidden>
                                            <label for="">Asunto</label>
                                            <input type="text" class="form-control " name="asunto_estado_cuenta"
                                                placeholder="Describa el asunto para el estado de cuenta">
                                        </div>

                                        <div class="form-group col-md-8" id="">
                                            <label for="">Asunto</label>
                                            <input type="text" class="form-control " name="asunto_estado_cuenta"
                                                id="asunto_estado_cuenta"
                                                placeholder="Describa el asunto para el estado de cuenta" disabled>
                                        </div>

                                        <div class="form-group col-md-8" hidden>
                                            <label for="">Descripción del estado de cuenta</label>
                                            <textarea type="text" class="form-control " name="descripcion_ec" rows="4"
                                                placeholder="Descripción del estado de cuenta"></textarea>
                                        </div>

                                        <div class="form-group col-md-8" id="">
                                            <label for="">Descripción del estado de cuenta</label>
                                            <textarea type="text" class="form-control " name="descripcion_ec"
                                                id="descripcion_ec" rows="4"
                                                placeholder="Descripción del estado de cuenta" disabled></textarea>
                                        </div>

                                        <script>

                                            function activarCampo_EstadoCuenta() {
                                                var checkbox2 = document.getElementById("estado_cuenta");
                                                var numero_estado_cuenta = document.getElementById("numero_estado_cuenta");
                                                var fecha_estado_cuenta = document.getElementById("fecha_estado_cuenta");
                                                var asunto_estado_cuenta = document.getElementById("asunto_estado_cuenta");
                                                var descripcion_ec = document.getElementById("descripcion_ec");

                                                var informe_ingreso = document.getElementById("informe_ingreso").value;

                                                // Si el checkbox está marcado, habilitamos el campo; si no, lo deshabilitamos
                                                if (checkbox2.checked) {
                                                    document.getElementById("numero_estado_cuenta").value = "<?php echo $numero_ec; ?>";
                                                    numero_estado_cuenta.disabled = false; // Activa el campo
                                                    document.getElementById("fecha_estado_cuenta").value = "<?php echo date("Y-m-d"); ?>";
                                                    fecha_estado_cuenta.disabled = false; // Activa el campo
                                                    asunto_estado_cuenta.disabled = false; // Activa el campo
                                                    document.getElementById("descripcion_ec").value = "<?php echo "Me dirijo a usted, con relación al asunto del rubro y documentos referentes de $actividad, realizado por la $facultad; así mismo se remite el Informe N° "; ?>" + informe_ingreso + "<?php echo "-PI-OT-DIGA-UNFV de Programación de Ingresos y el Informe de Egresos N° $numero_informe-$anio_actual-OT-DIGA-UNFV, mediante las cuales se obtiene el siguiente saldo:"; ?>";
                                                    descripcion_ec.disabled = false; // Activa el campo
                                                } else {
                                                    document.getElementById("numero_estado_cuenta").value = "";
                                                    numero_estado_cuenta.disabled = true; // Desactiva el campo
                                                    document.getElementById("fecha_estado_cuenta").value = "";
                                                    fecha_estado_cuenta.disabled = true; // Desactiva el campo
                                                    document.getElementById("asunto_estado_cuenta").value = "";
                                                    asunto_estado_cuenta.disabled = true; // Desactiva el campo
                                                    document.getElementById("descripcion_ec").value = "";
                                                    descripcion_ec.disabled = true; // Desactiva el campo
                                                }
                                            }

                                        </script>




                                        <div class="form-group col-md-12" align="right">
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="bi bi-floppy-fill"></i>
                                                Guardar</button>
                                            <a href="index" class="btn" style="background-color: grey; color: white;"><i
                                                    class="bi bi-x-circle-fill"></i> Cancelar</a>

                                        </div>
                                    </div>



                                </div>
                            </form>
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
                                $('#anio_nt').select2({
                                    theme: 'bootstrap4',
                                });

                                $('#anio_nt_expediente').select2({
                                    theme: 'bootstrap4',
                                });

                                $('#estado_giro').select2({
                                    theme: 'bootstrap4',
                                });

                                $('#resolucion').select2({
                                    theme: 'bootstrap4',
                                });

                                $('#fecha_resolucion').select2({
                                    theme: 'bootstrap4',
                                });



                                $('#estado_giro_saldo').select2({
                                    theme: 'bootstrap4',
                                });


                                $('#detalle_pago').select2({
                                    theme: 'bootstrap4',
                                });

                                $('#especialidad').select2({
                                    theme: 'bootstrap4',
                                });



                            });
                        </script>

                    </div>
                </div>
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- /.content-wrapper -->
<div class="modal fade" id="modal-create-resolucion">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: black; color: white">
                <h4 class="modal-title">Registrar Nuevo Resolucion</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Resolucion</label>
                            <input type="text" id="numero_resolucion" class="form-control " placeholder="Numero-Año"
                                onkeypress='return validaNumericos(event)'>
                            <small style="color: red; display: none" id="lbl_create">* Este campo es requerido</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Fecha de Resolucion</label>
                            <input type="date" id="fecha" class="form-control ">
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
        var numero_resolucion = $('#numero_resolucion').val();
        var fecha = $('#fecha').val();

        if (numero_resolucion == "") {
            $('#numero_resolucion').focus();
            $('#lbl_create').css('display', 'block');
        } else if (fecha == "") {
            $('#fecha').focus();
            $('#lbl_create2').css('display', 'block');
        } else {
            var url = "../app/controllers/resolucion_egresos/create.php";
            $.get(url, { numero_resolucion: numero_resolucion, fecha: fecha }, function (datos) {
                $('#respuesta').html(datos);
            });
        }

    });
</script>
<div id="respuesta"></div>


<div class="modal fade" id="modal-create-especialidad">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: black; color: white">
                <h4 class="modal-title">Registrar Nuevo Especialidad</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Especialidad</label>
                            <input type="text" id="nombre_especialidad" class="form-control "
                                placeholder="Nombre de especialidad">
                            <small style="color: red; display: none" id="lbl_create3">* Este campo es requerido</small>
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
        var nombre_especialidad = $('#nombre_especialidad').val();

        if (nombre_especialidad == "") {
            $('#nombre_especialidad').focus();
            $('#lbl_create3').css('display', 'block');
        } else {
            var url = "../app/controllers/especialidades/create.php";
            $.get(url, { nombre_especialidad: nombre_especialidad }, function (datos) {
                $('#respuesta2').html(datos);
            });
        }

    });
</script>
<div id="respuesta2"></div>


<div class="modal fade" id="modal-create-detalle-pago">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: black; color: white">
                <h4 class="modal-title">Registrar Nuevo Detalle de Pago</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Detalle de pago</label>
                            <input type="text" id="nombre_detalle_pago" class="form-control "
                                placeholder="Nombre de detalle de pago">
                            <small style="color: red; display: none" id="lbl_create4">* Este campo es requerido</small>
                        </div>
                    </div>
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
<!-- /.modal -->

<script>
    $('#btn_create3').click(function () {
        var nombre_detalle_pago = $('#nombre_detalle_pago').val();

        if (nombre_detalle_pago == "") {
            $('#nombre_detalle_pago').focus();
            $('#lbl_create4').css('display', 'block');
        } else {
            var url = "../app/controllers/detalles/create.php";
            $.get(url, { nombre_detalle_pago: nombre_detalle_pago }, function (datos) {
                $('#respuesta3').html(datos);
            });
        }

    });
</script>
<div id="respuesta3"></div>

<?php include('../layout/parte2.php'); ?>