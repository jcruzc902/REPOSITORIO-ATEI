<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');
include('../layout/mensajes.php');

include('../app/controllers/modalidad_tyt/listado_modalidad_tyt.php');
include('../app/controllers/concepto_tyt/listado_concepto_tyt.php');
include('../app/controllers/referencia_tyt/listado_referencia_tyt.php');
include('../app/controllers/dependencia_tyt/listado_dependencia_tyt.php');
include('../app/controllers/cod_servicio_banco/listado_de_cod_servicio_banco.php');
include('../app/controllers/resolucion_rectoral/listado_resolucion_tyt.php');
include('../app/controllers/situacion_tyt/listado_situacion_tyt.php');
include('../app/controllers/tipo_tyt/listado_tipo_tyt.php');
include('../app/controllers/banco_tyt/listado_banco_tyt.php');
include('../app/controllers/cuenta_tyt/listado_cuenta_tyt.php');
include('../app/controllers/estado_tasas/listado_estado_tasas.php');
include('../app/controllers/estado_resolucion/listado_estado_resolucion.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Registrar Nueva Tasa y Tarifa</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/tasas_tarifas"><i
                                    class="bi bi-bar-chart-fill"></i> Tasas y Tarifas</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-clipboard-check"></i> Registrar nueva Tasa y
                            Tarifa</a></li>
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
                            <h3 class="card-title">Digite los datos sobre la nueva tasa y tarifa</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: inline;">
                            <form action="../app/controllers/tasas_tarifas/create.php" method="post"
                                enctype="multipart/form-data">
                                <input type="text" name="id_usuario" value="<?php echo $id_usuario_sesion; ?>" hidden>

                                <?php

                                    $sql_tarifas = "SELECT MAX(id_tasas_tarifas) as id_tasas_tarifas FROM tb_tasas_tarifas WHERE visible!=1";
                                    $query_tarifas = $pdo->prepare($sql_tarifas);
                                    $query_tarifas->execute();
                                    $tarifas_datos = $query_tarifas->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tarifas_datos as $tarifas_dato) {
                                        $id_tasas_tarifas = $tarifas_dato['id_tasas_tarifas'];
                                    }

                                    //AUTOMATIZA EL CODIGO DE PAGO DE TASAS Y TARIFAS
                                    if ($id_tasas_tarifas != null) {
                                        
                                            $id_tasas_tarifas = $tarifas_dato['id_tasas_tarifas'] + 1; //autoincrementa el numero de informe
                                        

                                    } else {
                                        $id_tasas_tarifas = 1; //empieza con 1
                                    }


                                ?>

                                <input type="text" name="id_tasas_tarifas" id="id_tasas_tarifas" value="<?php echo $id_tasas_tarifas; ?>" hidden>


                                <div class="form-row">

                                    <?php

                                    $sql_tasas_tarifas = "SELECT MAX(codigo_pago) as cod_pag FROM tb_tasas_tarifas WHERE visible!=1";
                                    $query_tasas_tarifas = $pdo->prepare($sql_tasas_tarifas);
                                    $query_tasas_tarifas->execute();
                                    $tasas_tarifas_datos = $query_tasas_tarifas->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tasas_tarifas_datos as $tasas_tarifas_dato) {
                                        $codigo_pago = $tasas_tarifas_dato['cod_pag'];
                                    }

                                    //AUTOMATIZA EL CODIGO DE PAGO DE TASAS Y TARIFAS
                                    if ($codigo_pago != null) {
                                        
                                            $codigo_pago = $tasas_tarifas_dato['cod_pag'] + 1; //autoincrementa el numero de informe
                                        

                                    } else {
                                        $codigo_pago = 1; //empieza con 1
                                    }


                                    ?>


                                    <div class="form-group col-md-2" id="">
                                        <label for="">Codigo de Pago</label>
                                        <input type="text" class="form-control " name="codigo_pago" id="codigo_pago"
                                            value="<?php echo $codigo_pago; ?>" readonly>
                                    </div>


                                    <div class="form-group col-md-3" id="">
                                        <label for="">Modalidad</label>
                                        <select class="form-control " name="modalidad" id="combo_modalidad"
                                            style="width:100%">
                                            <option value="SELECCIONAR">SELECCIONAR</option>
                                            <?php
                                            foreach ($modalidad_tyt_datos as $modalidad_tyt_dato) { ?>
                                                <option value="<?php echo $modalidad_tyt_dato['nombre_modalidad']; ?>">
                                                    <?php echo $modalidad_tyt_dato['nombre_modalidad']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <?php
                                    $default_concepto = "OTROS";
                                    ?>


                                    <div class="form-group col-md-3" id="" hidden>
                                        <label for="">Concepto</label>
                                        <select class="form-control " name="concepto" id="combo_concepto"
                                            style="width:100%">
                                            <option value="SELECCIONAR">SELECCIONAR</option>
                                            <?php
                                            foreach ($concepto_tyt_datos as $concepto_tyt_dato) {
                                                $nombre_concepto_tyt_tabla = $concepto_tyt_dato['nombre_concepto_tyt']; ?>
                                                <option value="<?php echo $nombre_concepto_tyt_tabla; ?>" <?php if ($nombre_concepto_tyt_tabla == $default_concepto) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_concepto_tyt_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="" hidden>
                                        <label for="">Nuevo Concepto</label>
                                        <input type="text" class="form-control " name="nuevo_concepto"
                                            placeholder="Digite el nuevo concepto">
                                    </div>

                                    <div class="form-group col-md-5" id="">
                                        <label for="">Nuevo Concepto</label>
                                        <input type="text" class="form-control " name="nuevo_concepto"
                                            id="nuevo_concepto" placeholder="Digite el nuevo concepto" required
                                            disabled>
                                    </div>

                                    <script>
                                        var concepto = $('#combo_concepto').val();

                                        if (concepto == "OTROS") {
                                            $('#nuevo_concepto').prop("disabled", false);
                                        }

                                    </script>

                                    <script>
                                        //habilita y deshabilita los campos
                                        $(document).ready(function () {
                                            $('#combo_concepto').change(function (e) {
                                                if ($(this).val() == "OTROS") {
                                                    document.getElementById("nuevo_concepto").value = "";
                                                    $('#nuevo_concepto').prop("disabled", false);


                                                } else {
                                                    document.getElementById("nuevo_concepto").value = "";
                                                    $('#nuevo_concepto').prop("disabled", true);
                                                }
                                            })
                                        });
                                    </script>



                                    <div class="form-group col-md-2" id="">

                                    </div>

                                    <!--
                                    <div class="form-group col-md-2" id="">
                                        <label for="">Monto</label>
                                        <input type="text" class="form-control " name="monto"
                                            onkeypress='return validaNumericos(event)' id="monto" placeholder="Monto">
                                    </div>
                                    -->


                                    <div class="form-group col-md-4" id="">
                                        <label for="">Referencia</label>
                                        <select class="form-control " name="referencia" id="combo_referencia"
                                            style="width:100%">
                                            <option value="SELECCIONAR">SELECCIONAR</option>
                                            <?php
                                            foreach ($referencia_tyt_datos as $referencia_tyt_dato) { ?>
                                                <option value="<?php echo $referencia_tyt_dato['nombre_referencia']; ?>">
                                                    <?php echo $referencia_tyt_dato['nombre_referencia']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Dependencia</label>
                                        <select class="form-control " name="dependencia" id="combo_dependencia"
                                            style="width:100%">
                                            <option value="SELECCIONAR">SELECCIONAR</option>
                                            <?php
                                            foreach ($dependencia_tyt_datos as $dependencia_tyt_dato) { ?>
                                                <option
                                                    value="<?php echo $dependencia_tyt_dato['nombre_dependencias_tyt']; ?>">
                                                    <?php 
                                                    echo $dependencia_tyt_dato['nombre_dependencias_tyt']; 
                                                    ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>


                                    
<!--
                                    <div class="form-group col-md-2" id="" hidden>
                                        <label for="">Codigo de Facultad</label>
                                        <select class="form-control " name="codigo_facultad" id="codigo_facultad" style="width:100%">

                                        </select>
                                    </div>-->

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Codigo de Facultad</label>
                                        <input class="form-control " name="codigo_facultad" id="codigo_facultad" style="width:100%" readonly>
                                    </div>

                                    <!--
                                    <script>
                                            $(document).ready(function () {

                                                $('#combo_dependencia').change(function () {

                                                    $("#combo_dependencia option:selected").each(function () {
                                                        var nombre_dependencia = $('#combo_dependencia').val();
                                                        $.post("../app/controllers/dependencia_tyt/consulta_codigo_facultad.php",
                                                            { nombre_dependencia: nombre_dependencia }, function (data) {
                                                                $("#codigo_facultad").html(data);
                                                            });
                                                    });

                                                });
                                            });
                                    </script>-->

                                    


                                    <div class="form-group col-md-2" id="">
                                        <label for="">Clasificador</label>
                                        <input type="text" class="form-control " name="clasificador" id="clasificador"
                                            placeholder="Clasificador" maxlength="20">
                                    </div>


                                    <script>
                                            $(document).ready(function () {
                                                $('#combo_dependencia').change(function (e) {

                                                    if ($(this).val() == "CENTRO PREUNIVERSITARIO DE LA UNIVERSIDAD NACIONAL FEDERICO VILLARREAL") {
                                                        document.getElementById("codigo_facultad").value = "03140DCREC";
                                                        document.getElementById("clasificador").value = "03140DCREC";
                                                    } else if ($(this).val() == "CENTRO DE GESTIÓN CULTURAL FEDERICO VILLARREAL") {
                                                        document.getElementById("codigo_facultad").value = "03150DCREC";
                                                        document.getElementById("clasificador").value = "03150DCREC";
                                                    } else if ($(this).val() == "CENTRO DE IDIOMAS") {
                                                        document.getElementById("codigo_facultad").value = "04060APVAC";
                                                        document.getElementById("clasificador").value = "04060APVAC";
                                                    } else if ($(this).val() == "CENTRO DE PRODUCCIÓN DE BIENES Y SERVICIOS") {
                                                        document.getElementById("codigo_facultad").value = "0313ODCREC";
                                                        document.getElementById("clasificador").value = "0313ODCREC";
                                                    } else if ($(this).val() == "CENTRO UNIVERSITARIO DE RESPONSABILIDAD SOCIAL") {
                                                        document.getElementById("codigo_facultad").value = "0313ODCREC";
                                                        document.getElementById("clasificador").value = "0313ODCREC";
                                                    } else if ($(this).val() == "EDITORIAL UNIVERSITARIA") {
                                                        document.getElementById("codigo_facultad").value = "04060APVAC";
                                                        document.getElementById("clasificador").value = "04060APVAC";
                                                    } else if ($(this).val() == "ESCUELA UNIVERSITARIA DE EDUCACION A DISTANCIA") {
                                                        document.getElementById("codigo_facultad").value = "03110DCREC";
                                                        document.getElementById("clasificador").value = "03110DCREC";
                                                    } else if ($(this).val() == "ESCUELA UNIVERSITARIA DE POSTGRADO") {
                                                        document.getElementById("codigo_facultad").value = "03100DCREC";
                                                        document.getElementById("clasificador").value = "03100DCREC";
                                                    } else if ($(this).val() == "FACULTAD DE ADMINISTRACIÓN") {
                                                        document.getElementById("codigo_facultad").value = "06010OLFAC";
                                                        document.getElementById("clasificador").value = "06010OLFAC";
                                                    } else if ($(this).val() == "FACULTAD DE PSICOLOGIA") {
                                                        document.getElementById("codigo_facultad").value = "06170OLFAC";
                                                        document.getElementById("clasificador").value = "06170OLFAC";
                                                    } else if ($(this).val() == "FACULTAD DE ARQUITECTURA Y URBANISMO") {
                                                        document.getElementById("codigo_facultad").value = "06020OLFAC";
                                                        document.getElementById("clasificador").value = "06020OLFAC";
                                                    } else if ($(this).val() == "FACULTAD DE CIENCIAS SOCIALES") {
                                                        document.getElementById("codigo_facultad").value = "06060OLFAC";
                                                        document.getElementById("clasificador").value = "06060OLFAC";
                                                    } else if ($(this).val() == "FACULTAD DE CIENCIAS ECONOMICAS") {
                                                        document.getElementById("codigo_facultad").value = "06030OLFAC";
                                                        document.getElementById("clasificador").value = "06030OLFAC";
                                                    } else if ($(this).val() == "FACULTAD DE CIENCIAS FINANCIERAS Y CONTABLES") {
                                                        document.getElementById("codigo_facultad").value = "06040OLFAC";
                                                        document.getElementById("clasificador").value = "06040OLFAC";
                                                    } else if ($(this).val() == "FACULTAD DE CIENCIAS NATURALES Y MATEMATICA") {
                                                        document.getElementById("codigo_facultad").value = "06050OLFAC";
                                                        document.getElementById("clasificador").value = "06050OLFAC";
                                                    } else if ($(this).val() == "FACULTAD DE DERECHO Y CIENCIA POLITICA") {
                                                        document.getElementById("codigo_facultad").value = "06070OLFAC";
                                                        document.getElementById("clasificador").value = "06070OLFAC";
                                                    } else if ($(this).val() == "FACULTAD DE EDUCACION") {
                                                        document.getElementById("codigo_facultad").value = "06080OLFAC";
                                                        document.getElementById("clasificador").value = "06080OLFAC";
                                                    } else if ($(this).val() == "FACULTAD DE HUMANIDADES") {
                                                        document.getElementById("codigo_facultad").value = "06090OLFAC";
                                                        document.getElementById("clasificador").value = "06090OLFAC";
                                                    } else if ($(this).val() == "FACULTAD DE INGENIERIA CIVIL") {
                                                        document.getElementById("codigo_facultad").value = "06100OLFAC";
                                                        document.getElementById("clasificador").value = "06100OLFAC";
                                                    } else if ($(this).val() == "FACULTAD DE INGENIERIA ELECTRONICA E INFORMATICA") {
                                                        document.getElementById("codigo_facultad").value = "06110OLFAC";
                                                        document.getElementById("clasificador").value = "06110OLFAC";
                                                    } else if ($(this).val() == "FACULTAD DE INGENIERIA GEOGRAFICA, AMBIENTAL Y ECOTURISMO") {
                                                        document.getElementById("codigo_facultad").value = "06120OLFAC";
                                                        document.getElementById("clasificador").value = "06120OLFAC";
                                                    } else if ($(this).val() == "FACULTAD DE INGENIERIA INDUSTRIAL Y DE SISTEMAS") {
                                                        document.getElementById("codigo_facultad").value = "06130OLFAC";
                                                        document.getElementById("clasificador").value = "06130OLFAC";
                                                    } else if ($(this).val() == "FACULTAD DE MEDICINA DE HIPOLITO UNANUE") {
                                                        document.getElementById("codigo_facultad").value = "06140OLFAC";
                                                        document.getElementById("clasificador").value = "06140OLFAC";
                                                    } else if ($(this).val() == "FACULTAD DE ODONTOLOGIA") {
                                                        document.getElementById("codigo_facultad").value = "06160OLFAC";
                                                        document.getElementById("clasificador").value = "06160OLFAC";
                                                    } else if ($(this).val() == "FACULTAD DE OCEANOGRAFIA, PESQUERIA Y CC.AA.") {
                                                        document.getElementById("codigo_facultad").value = "06150OLFAC";
                                                        document.getElementById("clasificador").value = "06150OLFAC";
                                                    } else if ($(this).val() == "FACULTAD DE TECNOLOGIA MEDICA") {
                                                        document.getElementById("codigo_facultad").value = "06180OLFAC";
                                                        document.getElementById("clasificador").value = "06180OLFAC";
                                                    } else if ($(this).val() == "INSTITUTO CENTRAL DE GESTION DE LA INVESTIGACION") {
                                                        document.getElementById("codigo_facultad").value = "04030APVAC";
                                                        document.getElementById("clasificador").value = "04030APVAC";
                                                    } else if ($(this).val() == "INSTITUTO DE RECREACION, EDUCACION FISICA Y DEPORTE") {
                                                        document.getElementById("codigo_facultad").value = "04040APVAC";
                                                        document.getElementById("clasificador").value = "04040APVAC";
                                                    } else if ($(this).val() == "OFICINA CENTRAL DE ADMISION") {
                                                        document.getElementById("codigo_facultad").value = "04010APVAC";
                                                        document.getElementById("clasificador").value = "04010APVAC";
                                                    } else if ($(this).val() == "OFICINA CENTRAL DE BIENESTAR UNIVERSITARIO") {
                                                        document.getElementById("codigo_facultad").value = "03070APREC";
                                                        document.getElementById("clasificador").value = "03070APREC";
                                                    } else if ($(this).val() == "OFICINA CENTRAL DE REGISTRO ACADEMICO") {
                                                        document.getElementById("codigo_facultad").value = "04050APVAC";
                                                        document.getElementById("clasificador").value = "04050APVAC";
                                                    } else if ($(this).val() == "OFICINA DE TESORERIA") {
                                                        document.getElementById("codigo_facultad").value = "0";
                                                        document.getElementById("clasificador").value = "18109901020000000000";
                                                    } else if ($(this).val() == "SECRETARIA GENERAL") {
                                                        document.getElementById("codigo_facultad").value = "03050ASREC";
                                                        document.getElementById("clasificador").value = "03050ASREC";
                                                    } else if ($(this).val() == "VICE-RECTORADO DE INVESTIGACION") {
                                                        document.getElementById("codigo_facultad").value = "04030APVAC";
                                                        document.getElementById("clasificador").value = "04030APVAC";
                                                    } else if ($(this).val() == "SELECCIONAR") {
                                                        document.getElementById("codigo_facultad").value = "";
                                                        document.getElementById("clasificador").value = "";
                                                    } 
                                                })
                                            });
                                    </script>


                                    <div class="form-group col-md-2" id="">
                                        <label for="">Codigo de Servicio Banco</label>
                                        
                                        <select class="form-control " name="codigo_serv_banco" id="codigo_serv_banco" style="width:100%"
                                            required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($cod_servicio_banco_datos as $cod_servicio_banco_dato) { ?>
                                                <option
                                                    value="<?php echo $cod_servicio_banco_dato['nombre_cod_servbnco']; ?>">
                                                    <?php echo $cod_servicio_banco_dato['nombre_cod_servbnco']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <?php
                                        $default_banco= "BANCO DE COMERCIO";
                                    ?>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Banco</label>
                                        <select class="form-control " name="banco" id="combo_banco" style="width:100%"
                                            required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($banco_tyt_datos as $banco_tyt_dato) { 
                                                $nombre_banco_tabla = $banco_tyt_dato['nombre_banco']; ?>
                                                <option value="<?php echo $nombre_banco_tabla; ?>" <?php if ($nombre_banco_tabla == $default_banco) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_banco_tabla; ?>
                                                </option>
                                                
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <?php
                                        $sql_cuenta = "SELECT cuenta.id_cuenta_tyt as id_cuenta_tyt,
                                        cuenta.numero_cuenta_tyt as numero_cuenta_tyt,
                                        banco_tyt.id_banco_tyt as id_banco,
                                        banco_tyt.nombre_banco as nombre_banco 
                                        FROM tb_cuenta_tyt as cuenta 
                                        INNER JOIN tb_banco_tyt as banco_tyt ON banco_tyt.id_banco_tyt= cuenta.id_banco 
                                        where cuenta.id_cuenta_tyt!=1 AND cuenta.visible!=1 AND banco_tyt.nombre_banco='BANCO DE COMERCIO' ORDER BY banco_tyt.nombre_banco ASC";
                                        $query_cuenta = $pdo->prepare($sql_cuenta);
                                        $query_cuenta->execute();
                                        $cuenta_tyt_datos = $query_cuenta->fetchAll(PDO::FETCH_ASSOC);
                                    ?>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Cuenta</label>
                                        <select class="form-control " name="cuenta" id="combo_cuenta" style="width:100%"
                                            required>
                                            <option value="">SELECCIONAR</option>

                                            <?php
                                            foreach ($cuenta_tyt_datos as $cuenta_tyt_dato) { 
                                                $numero_cuenta_tyt_tabla = $cuenta_tyt_dato['numero_cuenta_tyt'];
                                                $id_cuenta_tyt_tabla = $cuenta_tyt_dato['id_cuenta_tyt']; ?>
                                                <option value="<?php echo $numero_cuenta_tyt_tabla; ?>" <?php if ($numero_cuenta_tyt_tabla == 1) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $numero_cuenta_tyt_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>

                                        </select>

                                    </div>

                                    <script>
                                        $(document).ready(function () {

                                            $('#combo_banco').change(function () {

                                                //$('#combo_cuenta').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

                                                $("#combo_banco option:selected").each(function () {
                                                    var nombre_banco = $('#combo_banco').val();
                                                    $.post("../app/controllers/banco_tyt/consulta_cuenta.php",
                                                        { nombre_banco: nombre_banco }, function (data) {
                                                            $("#combo_cuenta").html(data);
                                                        });
                                                });

                                            });
                                        });
                                    </script>

                                    <!--

                                    <div class="form-group col-md-3" id="">
                                        <label for="">Resolucion Rectoral</label>
                                        <select class="form-control " name="resolucion" id="combo_resolucion"
                                            style="width:100%" required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($resolucion_tyt_datos as $resolucion_tyt_dato) { ?>
                                                <option
                                                    value="<?php echo $resolucion_tyt_dato['nombre_resolucion_tyt']; ?>">
                                                    <?php echo mb_strtoupper($resolucion_tyt_dato['nombre_resolucion_tyt']); ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <script>
                                        $(document).ready(function () {

                                            $('#combo_resolucion').change(function () {

                                                $("#combo_resolucion option:selected").each(function () {
                                                    var nombre_resolucion = $('#combo_resolucion').val();
                                                    $.post("../app/controllers/resolucion_rectoral/consulta_archivo.php",
                                                        { nombre_resolucion: nombre_resolucion }, function (data) {
                                                            $("#combo_archivo").html(data);
                                                        });
                                                });

                                            });
                                        });
                                    </script>



                                    <div class="form-group col-md-2" id="" hidden>
                                        <label for="">Nuevo Nombre de Resolucion</label>
                                        <input type="text" class="form-control " name="nuevo_resolucion"
                                            placeholder="Digite el nuevo nombre de resolucion">
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Nuevo Nombre de Resolucion</label>
                                        <input type="text" class="form-control " name="nuevo_resolucion"
                                            id="nuevo_resolucion" placeholder="Digite el nuevo nombre de resolucion"
                                            required disabled>
                                    </div>

                                    <div class="form-group col-md-3" id="" hidden>
                                        <label for="">Subir Nuevo Archivo de R.R.</label>
                                        <input class="form-control-file" type="file" name="nuevo_archivo">
                                    </div>

                                    <div class="form-group col-md-3" id="">
                                        <label for="">Subir Nuevo Archivo de R.R.</label>
                                        <input class="form-control-file" type="file" name="nuevo_archivo"
                                            accept=".pdf,.PDF" id="archivo" required disabled>
                                    </div>

                                    <script>
                                        //habilita y deshabilita los campos
                                        $(document).ready(function () {
                                            $('#combo_resolucion').change(function (e) {
                                                if ($(this).val() == "OTROS") {
                                                    document.getElementById("nuevo_resolucion").value = "";
                                                    document.getElementById("archivo").value = "";
                                                    $('#nuevo_resolucion').prop("disabled", false);
                                                    $('#archivo').prop("disabled", false);


                                                } else {
                                                    document.getElementById("nuevo_resolucion").value = "";
                                                    document.getElementById("archivo").value = "";
                                                    $('#nuevo_resolucion').prop("disabled", true);
                                                    $('#archivo').prop("disabled", true);

                                                }
                                            })
                                        });
                                    </script>



                                    <div class="form-group col-md-3" id="" hidden>
                                        <label for="">Generar Archivo</label>
                                        <select class="form-control " name="archivo_resolucion" id="combo_archivo"
                                            style="width:100%">

                                        </select>

                                    </div>

                                        -->


                                    <div class="form-group col-md-2" id="">
                                        <label for="">Vigencia</label>
                                        <input type="date" class="form-control " name="vigencia" id="vigencia"
                                            onkeypress='return validaNumericos(event)'>
                                    </div>



                                    <div class="form-group col-md-2" id="">
                                        <label for="">Situacion</label>
                                        <select class="form-control " name="situacion" id="combo_situacion"
                                            style="width:100%">
                                            <option value="SELECCIONAR">SELECCIONAR</option>
                                            <?php
                                            foreach ($situacion_tyt_datos as $situacion_tyt_dato) { ?>
                                                <option value="<?php echo $situacion_tyt_dato['nombre_situacion_tyt']; ?>">
                                                    <?php echo $situacion_tyt_dato['nombre_situacion_tyt']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Tipo</label>
                                        <select class="form-control " name="tipo" id="combo_tipo" style="width:100%"
                                            required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($tipo_tyt_datos as $tipo_tyt_dato) { ?>
                                                <option value="<?php echo $tipo_tyt_dato['nombre_tipo_tyt']; ?>">
                                                    <?php echo $tipo_tyt_dato['nombre_tipo_tyt']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" style="line-height: 100px; display: none" id="boton_tasas">
                                        <a href="javascript:window.open('../app/controllers/tasas_tarifas/recargar.php','','width=1650, height=800');"
                                            id="boton_resolucion" class="btn btn-lg"
                                            style="background-color: black; color: white;">
                                            <i class="bi bi-box-arrow-in-up-right"></i> Consulta de Resolucion</a>

                                    </div>

                                    <script>
                                        $('#boton_resolucion').click(function () {

                                            var codigo_pago = $('#codigo_pago').val();
                                            var modalidad = $('#combo_modalidad').val();

                                            if ($('#combo_concepto').val() == "OTROS") {
                                                var concepto = $('#nuevo_concepto').val();
                                            } else {
                                                var concepto = $('#combo_concepto').val();
                                            }




                                            var referencia = $('#combo_referencia').val();
                                            var dependencia = $('#combo_dependencia').val();

                                            var id_tasas_tarifas = $('#id_tasas_tarifas').val();

                                            var url = "../app/controllers/tasas_tarifas/global.php";
                                            $.get(url, { codigo_pago: codigo_pago, modalidad: modalidad, concepto: concepto, referencia: referencia, dependencia: dependencia, id_tasas_tarifas: id_tasas_tarifas }, function (datos) { });

                                        });
                                    </script>

                                    <?php
                                    $estado_tasas = "ATENDIDO";
                                    ?>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Estado</label>
                                        <select class="form-control " name="estado" id="combo_estado" style="width:100%"
                                            required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($estado_tasas_datos as $estado_tasas_dato) {
                                                $nombre_estado_tasas_tabla = $estado_tasas_dato['nombre_estado_tasas'];
                                                $id_estado_tasas = $estado_tasas_dato['id_estado_tasas']; ?>
                                                <option value="<?php echo $id_estado_tasas; ?>" <?php if ($nombre_estado_tasas_tabla == $estado_tasas) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_estado_tasas_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-6" id="" hidden>
                                        <label for="">Observacion</label>
                                        <input type="text" class="form-control " name="observacion"
                                            placeholder="Observacion">
                                    </div>

                                    <hr style="width:100%;">

                                    <div class="form-group col-md-3" id="">
                                            <label for="">EJM: RESOLUCION RECTORAL N° 7418-2020-CU-UNFV</label>
                                            <input class="form-control-file" type="file" name="nuevo_archivo"
                                                accept=".pdf,.PDF" id="archivo"  >
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Monto</label>
                                            <input type="text" class="form-control " name="monto" id="monto"
                                                onkeypress='return validaNumericos(event)' required>
                                        </div>

                                        <?php
                                        $estado_resolucion = "APROBADO";
                                        ?>

                                        <div class="form-group col-md-2" id="campo_estado">
                                            <label for="">Estado Resolucion</label>
                                            <select class="form-control " name="id_estado_resolucion" id="combo_estado_resolucion"
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

                                        <div class="form-group col-md-5" id="">
                                            <label for="">Observacion</label>
                                            <input type="text" class="form-control " name="observacion"
                                                id="observacion">
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

                                        $('#combo_modalidad').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_concepto').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_referencia').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_dependencia').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#codigo_serv_banco').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_banco').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_cuenta').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_resolucion').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_archivo').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_situacion').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_tipo').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_estado').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_estado_resolucion').select2({
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

<?php include('../layout/parte2.php'); ?>