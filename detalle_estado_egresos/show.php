<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/anio_nt/listado_de_anios.php');
include('../app/controllers/estado_giro/listado_de_estado_giro.php');
include('../app/controllers/resolucion_egresos/listado_resolucion_egresos.php');
include('../app/controllers/detalle_estado_egresos/show_detalle_egreso.php');
include('../app/controllers/detalles/listado_detalles.php');
include('../app/controllers/especialidades/listado_de_especialidades.php');


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Datos del Pago Realizado : NT
                    <?php echo $nt_principal . " - " . $anio_nt_principal; ?></b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/detalle_estado_egresos"><i
                                    class="bi bi-card-checklist"></i> Detalle Estado de Cuenta</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-search"></i> Informacion del Pago</a></li>
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
                            <h3 class="card-title">Informacion del pago realizado seleccionado</h3>
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
                                        <label for="">NT Principal</label>
                                        <input type="text" class="form-control " name="nt_principal" id="nt"
                                            onkeypress='return validaNumericos(event)' placeholder="Numero Tramite"
                                            value="<?php echo $nt_principal; ?>" disabled>
                                    </div>

                                    <?php
                                    date_default_timezone_set("America/Lima");
                                    #$anio_nt = date('Y'); //año actual
                                    ?>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Año NT</label>
                                        <select class="form-control " name="anio_nt_principal" id="anio_nt"
                                            style="width:100%" disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($anios_datos as $anios_dato) {
                                                $anio_nt_tabla = $anios_dato['anio_nt'];
                                                $id_anio_nt = $anios_dato['id_anio_nt'];
                                                ?>
                                                <option value="<?php echo $anios_dato['id_anio_nt']; ?>" <?php if ($id_anio_nt == $id_anio_nt_principal) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $anios_dato['anio_nt']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">NT del Expediente</label>
                                        <input type="text" class="form-control " name="nt_expediente" id="nt_expediente"
                                            placeholder="Numero Tramite" value="<?php echo $nt_expediente; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Año NT</label>
                                        <select class="form-control " name="anio_nt_expediente" id="anio_nt_expediente"
                                            style="width:100%" disabled>
                                            <option value="SELECCIONAR">SELECCIONAR</option>
                                            <?php
                                            foreach ($anios_datos as $anios_dato) {
                                                $anio_nt_tabla = $anios_dato['anio_nt'];
                                                $id_anio_nt_exp = $anios_dato['id_anio_nt'];
                                                ?>
                                                <option value="<?php echo $anios_dato['id_anio_nt']; ?>" <?php if ($id_anio_nt_exp == $id_anio_nt_expediente) { ?> selected="selected" <?php } ?>>
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
                                        <input type="text" class="form-control " name="proveido_contabilidad" id="nt"
                                            onkeypress='return validaNumericos(event)' placeholder="Numero-Año"
                                            value="<?php echo $proveido_contabilidad; ?>" disabled>
                                    </div>

                                    <!--
                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Proveido Contabilidad</label>
                                        <input type="date" class="form-control " name="fecha_proveido_contabilidad"
                                            id="fecha_proveido_contabilidad" value="<?php echo $fecha_contabilidad; ?>" disabled>
                                    </div>
                                    -->

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Proveido DIGA</label>
                                        <input type="text" class="form-control " name="proveido_diga" id="proveido_diga"
                                            onkeypress='return validaNumericos(event)' placeholder="Numero-Año"
                                            value="<?php echo $proveido_diga; ?>" disabled>
                                    </div>

                                    <!--
                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Proveido DIGA</label>
                                        <input type="date" class="form-control " name="fecha_proveido_diga"
                                            id="fecha_proveido_diga" value="<?php echo $fecha_diga; ?>" disabled>
                                    </div>
                                    -->

                                    

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Oficio OCLSA-ORH</label>
                                        <input type="text" class="form-control " name="oficio_oclsa_orh"
                                            id="oficio_oclsa_orh" placeholder="Numero-Año-Dependencias"
                                            value="<?php echo $oficio; ?>" disabled>
                                    </div>

                                    <!--
                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Oficio</label>
                                        <input type="date" class="form-control " name="fecha_oclsa_orh"
                                            id="fecha_oclsa_orh" value="<?php echo $fecha_oficio; ?>" disabled>
                                    </div>
                                    -->


                                    <div class="form-group col-md-2" id="">
                                        <label for="">Resolución</label>
                                        <div style="display: flex;">
                                            <select class="form-control " name="resolucion" id="resolucion"
                                                style="width:100%" disabled>
                                                <option value="SELECCIONAR">SELECCIONAR</option>
                                                <?php
                                                foreach ($resolucion_egresos_datos as $resolucion_egresos_dato) {
                                                    $resolucion_tabla = $resolucion_egresos_dato['resolucion'];
                                                    $id_resoluciones_egresos = $resolucion_egresos_dato['id_resoluciones_egresos'];
                                                    ?>
                                                    <option value="<?php echo $resolucion_egresos_dato['resolucion']; ?>" <?php if ($resolucion_tabla == $resolucion) { ?> selected="selected"<?php } ?>>
                                                        <?php echo $resolucion_egresos_dato['resolucion']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#modal-create-resolucion" hidden>+</button>
                                        </div>


                                    </div>

                                    <?php

                                    $sql_resolucion= "SELECT * FROM tb_resoluciones_egresos WHERE resolucion='$resolucion'";
                                    $query_resolucion = $pdo->prepare($sql_resolucion);
                                    $query_resolucion->execute();
                                    $fecha_resolucion_egresos_datos = $query_resolucion->fetchAll(PDO::FETCH_ASSOC);

                                    ?>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Resolución</label>
                                        <select class="form-control " name="fecha_resolucion" id="fecha_resolucion"
                                            style="width:100%" disabled>
                                            <option value="SELECCIONAR">SELECCIONAR</option>
                                            <?php
                                            foreach ($fecha_resolucion_egresos_datos as $resolucion_egresos_dato) {
                                                $fecha_resolucion_tabla = $resolucion_egresos_dato['fecha'];
                                                $id_resoluciones_egresos = $resolucion_egresos_dato['id_resoluciones_egresos'];

                                                $theDate = new DateTime($resolucion_egresos_dato["fecha"]);
                                                $resolucion_egresos_dato["fecha"] = $theDate->format('d/m/Y');

                                                ?>
                                                <option value="<?php echo $resolucion_egresos_dato['fecha']; ?>" <?php if ($resolucion_egresos_dato["fecha"] == $fecha_resolucion) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $resolucion_egresos_dato['fecha']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>


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


                                    <div class="form-group col-md-2" id="">

                                    </div>

                                    <div class="form-group col-md-4" id="">
                                            <label for="">Especialidad</label>
                                            <div style="display: flex;">
                                                <select class="form-control " name="especialidad" id="especialidad"
                                                    style="width:100%" disabled>
                                                    <option value="SELECCIONAR">SELECCIONAR</option>
                                                    <?php
                                                    foreach ($especialidades_datos as $especialidades_dato) {
                                                        $nombre_especialidad_tabla = $especialidades_dato['nombre_especialidad'];
                                                        $id_especialidades = $especialidades_dato['id_especialidades'];
                                                        ?>
                                                        <option
                                                            value="<?php echo $especialidades_dato['nombre_especialidad']; ?>" <?php if ($especialidades_dato['nombre_especialidad'] == $especialidad) { ?> selected="selected"
                                                                <?php } ?>>
                                                            <?php echo $especialidades_dato['nombre_especialidad']; ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#modal-create-especialidad" hidden>+</button>
                                            </div>


                                    </div>


                                        


                                    <div class="form-group col-md-2" id="">
                                        <label for="">Periodo de pago</label>
                                        <input type="text" class="form-control " name="periodo_pago" id="periodo_pago"
                                            placeholder="Periodo" value="<?php echo $periodo_pago; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                            <label for="">N° Comprobante</label>
                                            <input type="text" class="form-control " name="numero_comprobante"
                                                id="numero_comprobante" placeholder="Numero de Comprobante" value="<?php echo $numero_comprobante; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-4" id="">

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">N° Orden de Compra</label>
                                        <input type="text" class="form-control " name="orden_compra" id="orden_compra"
                                            onkeypress='return validaNumericos(event)' placeholder="N° Orden Compra" value="<?php echo $n_oc; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">N° Orden de Servicio</label>
                                        <input type="text" class="form-control " name="orden_servicio"
                                            id="orden_servicio" onkeypress='return validaNumericos(event)'
                                            placeholder="N° Orden Servicio" value="<?php echo $n_os; ?>" disabled>
                                    </div>


                                    <div class="form-group col-md-2" id="">
                                        <label for="">SIAF</label>
                                        <input type="text" class="form-control " name="siaf" id="siaf"
                                            onkeypress='return validaNumericos(event)' placeholder="N° SIAF" value="<?php echo $siaf; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-6" id="">

                                    </div>

                                    

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Monto (S/.)</label>
                                        <input type="text" class="form-control " name="monto" id="monto"
                                            onkeypress='return validaNumericos(event)' placeholder="Monto"
                                            value="<?php echo $monto; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Egresos(S/.)</label>
                                        <input type="text" class="form-control " name="egresos" id="total_egresos"
                                            value="<?php echo $egresos; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Saldo de Ingresos(S/.)</label>
                                        <input type="text" class="form-control " name="saldo_ingresos"
                                            id="total_egresos" value="<?php echo $ingresos; ?>"
                                            disabled>
                                    </div>



                                    <div class="form-group col-md-6" id="">

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Nota de Pago</label>
                                        <input type="text" class="form-control " name="nota_pago" id="nota_pago"
                                            placeholder="N° Nota de Pago" value="<?php echo $nota_pago; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Giro</label>
                                        <input type="date" class="form-control " name="fecha_giro" id="fecha_giro" value="<?php echo $fecha_giro; ?>" disabled>
                                    </div>

                                  


                                    <div class="form-group col-md-2" id="">
                                        <label for="">Estado de Giro</label>
                                        <select class="form-control " name="estado_giro" id="estado_giro"
                                            style="width:100%" disabled>
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
                                        <input type="date" class="form-control " name="fecha_pago" id="fecha_pago" value="<?php echo $fecha_pago; ?>" disabled>
                                    </div>






                                    <div class="form-group col-md-4" id="">

                                    </div>


                                    <div class="form-group col-md-2" id="">
                                        <label for="">Informe de Ingreso</label>
                                        <input type="text" class="form-control " name="informe_ingreso"
                                            id="informe_ingreso" placeholder="Numero-Año"
                                            onkeypress='return validaNumericos(event)' value="<?php echo $informe_ingreso; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Informe Ingreso</label>
                                        <input type="date" class="form-control " name="fecha_informe_ingreso" value="<?php echo $fecha_informe_ingreso; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-4" id="">
                                            <label for="">Observacion Estado de Giro</label>
                                            <input type="text" class="form-control " name="observacion_giro" value="<?php echo $observacion_giro; ?>" disabled>
                                    </div>

                                    <hr style="width: 100%" id="hr">

                                    <div class="form-group col-md-4" id="">
                                            <label for="">Detalle de pago</label>
                                            <div style="display: flex;">
                                                <select class="form-control " name="detalle_pago" id="detalle_pago"
                                                    style="width:100%" disabled>
                                                    <option value="SELECCIONAR">SELECCIONAR</option>
                                                    <?php
                                                    foreach ($detalles_datos as $detalles_dato) {
                                                        $nombre_detalles_tabla = $detalles_dato['nombre_detalles'];
                                                        $id_detalles = $detalles_dato['id_detalles'];
                                                        ?>
                                                        <option value="<?php echo $detalles_dato['nombre_detalles']; ?>" <?php if ($detalles_dato['nombre_detalles'] == $detalle_pago) { ?> selected="selected"
                                                            <?php } ?>>
                                                            <?php echo $detalles_dato['nombre_detalles']; ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>

                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#modal-create-detalle-pago" hidden>+</button>
                                            </div>


                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Proveido/Resolucion</label>
                                        <input type="text" class="form-control " name="documento_pago"
                                            id="documento_pago" placeholder="Documento" value="<?php echo $documento; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                            <label for="">Fecha</label>
                                            <input type="date" class="form-control " name="fecha_documento"
                                                id="fecha_documento" value="<?php echo $fecha_documento; ?>" disabled>
                                        </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Concepto</label>
                                        <input type="text" class="form-control " name="tipo_pago" id="tipo_pago"
                                            placeholder="Concepto" value="<?php echo $tipo_pago; ?>" disabled>
                                    </div>



                                    <hr style="width: 100%" id="hr">

                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="informe_egresos"
                                                id="informe_egresos" onclick="activarCampo_InformeEgresos()" <?php if ($checkbox_informe == "YES") { echo "checked";} ?> disabled>
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
                                        <input type="text" class="form-control " name="informe" value="<?php echo $informe; ?>" >
                                    </div>


                                    <div class="form-group col-md-2" id="">
                                        <label for="">N° Informe de Egreso</label>
                                        <input type="text" class="form-control " name="informe"
                                            id="numero_informe_egreso" value="<?php echo $informe; ?>" readonly>
                                    </div>

                                    <div class="form-group col-md-2" hidden>
                                        <label for="">Fecha Informe</label>
                                        <input type="date" class="form-control " name="fecha_informe" value="<?php echo $fecha_informe; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Informe</label>
                                        <input type="date" class="form-control " name="fecha_informe"
                                            id="fecha_informe_egreso" value="<?php echo $fecha_informe; ?>" readonly>
                                    </div>

                                    <div class="form-group col-md-10" id="">

                                    </div>

                                    <div class="form-group col-md-8" hidden>
                                        <label for="">Asunto</label>
                                        <input type="text" class="form-control " name="asunto_informe_egreso"
                                            placeholder="Describa el asunto para el informe" value="<?php echo $asunto_informe; ?>">
                                    </div>

                                    <div class="form-group col-md-8" id="">
                                        <label for="">Asunto</label>
                                        <input type="text" class="form-control " name="asunto_informe_egreso"
                                            id="asunto_informe_egreso" placeholder="Describa el asunto para el informe" value="<?php echo $asunto_informe; ?>" 
                                            readonly>
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
                                            placeholder="Descripción del informe"><?php echo $descripcion_informe; ?></textarea>
                                    </div>

                                    <div class="form-group col-md-8" id="">
                                        <label for="">Descripción del informe</label>
                                        <textarea type="text" class="form-control " name="descripcion" id="descripcion"
                                            rows="4" placeholder="Descripción del informe" readonly><?php echo $descripcion_informe; ?></textarea>
                                    </div>

                                    <script>

                                        function activarCampo_InformeEgresos() {
                                            var checkbox = document.getElementById("informe_egresos");
                                            var numero_informe_egreso = document.getElementById("numero_informe_egreso");
                                            var fecha_informe_egreso = document.getElementById("fecha_informe_egreso");
                                            var asunto_informe_egreso = document.getElementById("asunto_informe_egreso");
                                            var descripcion = document.getElementById("descripcion");

                                            // Si el checkbox está marcado, habilitamos el campo; si no, lo deshabilitamos
                                            if (checkbox.checked) {
                                                document.getElementById("numero_informe_egreso").value = "<?php echo $numero_informe; ?>";
                                                numero_informe_egreso.disabled = false; // Activa el campo
                                                document.getElementById("fecha_informe_egreso").value = "<?php echo date("Y-m-d"); ?>";
                                                fecha_informe_egreso.disabled = false; // Activa el campo
                                                asunto_informe_egreso.disabled = false; // Activa el campo
                                                document.getElementById("descripcion").value = "<?php echo "Por medio del presente se informan los egresos referentes a $actividad, realizado por la $facultad"; ?>";
                                                descripcion.disabled = false; // Activa el campo
                                            } else {
                                                document.getElementById("numero_informe_egreso").value = "";
                                                numero_informe_egreso.disabled = true; // Desactiva el campo
                                                document.getElementById("fecha_informe_egreso").value = "";
                                                fecha_informe_egreso.disabled = true; // Desactiva el campo
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
                                                id="estado_cuenta" onclick="activarCampo_EstadoCuenta()" <?php if ($checkbox_ec == "YES") { echo "checked";} ?> disabled>
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
                                        <input type="text" class="form-control " name="numero_estado_cuenta" value="<?php echo $numero_estado_cuenta; ?>" readonly>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">N° Estado de Cuenta</label>
                                        <input type="text" class="form-control " name="numero_estado_cuenta"
                                            id="numero_estado_cuenta" value="<?php echo $numero_estado_cuenta; ?>" readonly>
                                    </div>

                                    <div class="form-group col-md-2" hidden>
                                        <label for="">Fecha Estado de Cuenta</label>
                                        <input type="date" class="form-control " name="fecha_estado_cuenta" value="<?php echo $fecha_ec; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Estado de Cuenta</label>
                                        <input type="date" class="form-control " name="fecha_estado_cuenta"
                                            id="fecha_estado_cuenta" value="<?php echo $fecha_ec; ?>" readonly>
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
                                            placeholder="Describa el asunto para el estado de cuenta" value="<?php echo $asunto_ec; ?>">
                                    </div>

                                    <div class="form-group col-md-8" id="">
                                        <label for="">Asunto</label>
                                        <input type="text" class="form-control " name="asunto_estado_cuenta"
                                            id="asunto_estado_cuenta"
                                            placeholder="Describa el asunto para el estado de cuenta" value="<?php echo $asunto_ec; ?>" readonly>
                                    </div>

                                    <div class="form-group col-md-8" hidden>
                                        <label for="">Descripción del estado de cuenta</label>
                                        <textarea type="text" class="form-control " name="descripcion_ec" rows="4"
                                            placeholder="Descripción del estado de cuenta"><?php echo $descripcion_ec; ?></textarea>
                                    </div>

                                    <div class="form-group col-md-8" id="">
                                        <label for="">Descripción del estado de cuenta</label>
                                        <textarea type="text" class="form-control " name="descripcion_ec"
                                            id="descripcion_ec" rows="4" placeholder="Descripción del estado de cuenta"
                                            readonly><?php echo $descripcion_ec; ?></textarea>
                                    </div>

                                    <script>

                                        function activarCampo_EstadoCuenta() {
                                            var checkbox2 = document.getElementById("estado_cuenta");
                                            var numero_estado_cuenta = document.getElementById("numero_estado_cuenta");
                                            var fecha_estado_cuenta = document.getElementById("fecha_estado_cuenta");
                                            var asunto_estado_cuenta = document.getElementById("asunto_estado_cuenta");
                                            var descripcion_ec = document.getElementById("descripcion_ec");

                                            // Si el checkbox está marcado, habilitamos el campo; si no, lo deshabilitamos
                                            if (checkbox2.checked) {
                                                document.getElementById("numero_estado_cuenta").value = "<?php echo $numero_ec; ?>";
                                                numero_estado_cuenta.disabled = false; // Activa el campo
                                                document.getElementById("fecha_estado_cuenta").value = "<?php echo date("Y-m-d"); ?>";
                                                fecha_estado_cuenta.disabled = false; // Activa el campo
                                                asunto_estado_cuenta.disabled = false; // Activa el campo
                                                document.getElementById("descripcion_ec").value = "<?php echo "Me dirijo a usted, con relación al asunto del rubro y documentos referentes de $actividad, realizado por la $facultad; así mismo se remite el Informe N° 00-$anio_actual-PI-OT-DIGA-UNFV de Programación de Ingresos y el Informe de Egresos N° $numero_informe-$anio_actual-OT-DIGA-UNFV"; ?>";
                                                descripcion_ec.disabled = false; // Activa el campo
                                            } else {
                                                document.getElementById("numero_estado_cuenta").value = "";
                                                numero_estado_cuenta.disabled = true; // Desactiva el campo
                                                document.getElementById("fecha_estado_cuenta").value = "";
                                                fecha_estado_cuenta.disabled = true; // Desactiva el campo
                                                asunto_estado_cuenta.disabled = true; // Desactiva el campo
                                                document.getElementById("descripcion_ec").value = "";
                                                descripcion_ec.disabled = true; // Desactiva el campo
                                            }
                                        }

                                    </script>

                                    
                                    <?php
                                     if($checkbox_informe=="YES"){
                                    ?>
                                    <script>
                                        $('#numero_informe_egreso').prop("disabled", false);
                                        $('#fecha_informe_egreso').prop("disabled", false);
                                        $('#asunto_informe_egreso').prop("disabled", false);
                                        $('#descripcion').prop("disabled", false);
                                    </script>
                                    <?php } ?>

                                    <?php
                                     if($checkbox_ec=="YES"){
                                    ?>
                                    <script>
                                        $('#numero_estado_cuenta').prop("disabled", false);
                                        $('#fecha_estado_cuenta').prop("disabled", false);
                                        $('#asunto_estado_cuenta').prop("disabled", false);
                                        $('#descripcion_ec').prop("disabled", false);
                                    </script>
                                    <?php } ?>

                                    <div class="form-group col-md-4" id="">
                                            
                                    </div>

                                    <?php 
                                        $theDate = new DateTime($fecha_registro);
                                        $fecha_registro = $theDate->format('d/m/Y h:i:s a');
                                    ?>

                                    <div class="form-group col-md-2" id="">
                                            <label for="">Fecha de Registro</label>
                                            <input class="form-control" type="text" 
                                                value="<?php echo $fecha_registro; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                            <label for="">Usuario</label>
                                            <input class="form-control" type="text" 
                                                value="<?php echo $usuario; ?>" disabled>
                                    </div>




                                </div>







                                <div class="form-group col-md-12" align="right">
                                    <a href="index" class="btn" style="background-color: grey; color: white;"><i
                                            class="bi bi-x-circle-fill"></i> Cancelar</a>

                                </div>

                            </form>
                        </div>



                       
                    </div>


                    <script>
                        $(document).ready(function () {
                            $('#anio_nt').select2({
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

<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>