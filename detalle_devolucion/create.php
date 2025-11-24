<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');
include('../layout/mensajes.php');

if ((isset($_SESSION['numero_tramite'])) && isset($_SESSION['anio_nt']) && isset($_SESSION['id_anio_nt'])) {
    $numero_tramite = $_SESSION['numero_tramite'];
    $anio_nt = $_SESSION['anio_nt'];
    $id_anio_nt = $_SESSION['id_anio_nt'];
} else {
    $numero_tramite = "";
    $anio_nt = "";
    $id_anio_nt = "";
}

include('../app/controllers/bancos/listado_de_bancos.php');
include('../app/controllers/conceptos/listado_de_conceptos.php');
include('../app/controllers/anio_concepto/listado_de_anios.php');
include('../app/controllers/ciclo/listado_de_ciclos.php');
include('../app/controllers/anio_siafdevolucion/listado_siafdevolucion.php');
include('../app/controllers/anio_siaforigen/listado_siaforigen.php');
include('../app/controllers/tipo_documento/listado_tipo_documento.php');
include('../app/controllers/empresas/listado_de_empresas.php');
include('../app/controllers/cuenta/listado_de_nrocuentas.php');
include('../app/controllers/estado_giro/listado_de_estado_giro.php');



?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Registrar Nuevo Pago Realizado: NT
                            <?php echo $numero_tramite . " - " . $anio_nt; ?></b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/detalle_devolucion/index.php"><i
                                    class="bi bi-card-checklist"></i> Pagos realizado</a></li>
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
                            <h3 class="card-title">Digite los datos a detallar segun el informe del pago realizado
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: inline;">
                            <form action="../app/controllers/detalle_devolucion/create.php" method="post" id="add-form">

                                <div id="show_item">
                                    <div class="form-row">
                                        <input type="text" name="id_usuario[]" value="<?php echo $id_usuario_sesion; ?>"
                                            hidden>
                                        <input type="text" name="nt[]" value="<?php echo $numero_tramite; ?>" hidden>
                                        <input type="text" name="id_anio_nt[]" value="<?php echo $id_anio_nt; ?>"
                                            hidden>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Nro. Recibo</label>
                                            <input type="text" class="form-control " name="nliquidacion[]"
                                                id="nliquidacion" onkeypress='return validaNumericosRecibo(event)'
                                                required>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Banco</label>
                                            <select class="form-control " name="banco[]" id="banco" style="width:100%"
                                                required>
                                                <option value="">SELECCIONAR</option>
                                                <?php
                                                foreach ($bancos_datos as $bancos_dato) { ?>
                                                    <option value="<?php echo $bancos_dato['id_banco']; ?>">
                                                        <?php echo $bancos_dato['nombre_banco']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>

                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Nro. Cuenta del Banco</label>
                                            <input type="text" class="form-control " name="ncuentabanco[]"
                                                id="ncuentabanco" required onkeypress='return validaNumericos(event)'>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Importe del Voucher</label>
                                            <input type="text" class="form-control " name="importevoucher[]"
                                                id="importevoucher" required onkeypress='return validaNumericos(event)'>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha del Voucher</label>
                                            <input type="date" class="form-control " name="fechavoucher[]"
                                                id="fechavoucher" required>
                                        </div>

                                        <div class="form-group col-md-4" id="concepto">
                                            <label for="">Concepto</label>
                                            <div style="display: flex;">
                                                <select class="form-control " name="id_concepto[]" style="width:100%"
                                                    id="id_concepto" required>
                                                    <option value="1">SELECCIONAR</option>
                                                    <?php
                                                    foreach ($conceptos_datos as $conceptos_dato) { ?>
                                                        <option value="<?php echo $conceptos_dato['id_concepto']; ?>">
                                                            <?php echo $conceptos_dato['nombre']; ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#modal-create-concepto">+</button>
                                            </div>


                                        </div>

                                        <div class="form-group col-md-2" hidden>
                                            <label for="">Año</label>
                                            <select class="form-control " name="id_anio_concepto[]">
                                                <option value="1">SELECCIONAR</option>
                                                <?php
                                                foreach ($anios_conceptos_datos as $anios_conceptos_dato) { ?>
                                                    <option
                                                        value="<?php echo $anios_conceptos_dato['id_anio_concepto']; ?>">
                                                        <?php echo $anios_conceptos_dato['anio_concepto']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>

                                        </div>

                                        <div class="form-group col-md-2" id="anio_concepto">
                                            <label for="">Año</label>
                                            <select class="form-control " name="id_anio_concepto[]"
                                                id="id_anio_concepto" style="width:100%" disabled>
                                                <option value="1">SELECCIONAR</option>
                                                <?php
                                                foreach ($anios_conceptos_datos as $anios_conceptos_dato) { ?>
                                                    <option
                                                        value="<?php echo $anios_conceptos_dato['id_anio_concepto']; ?>">
                                                        <?php echo $anios_conceptos_dato['anio_concepto']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>

                                        </div>


                                        <div class="form-group col-md-2" hidden>
                                            <label for="">Ciclo</label>
                                            <select class="form-control " name="id_ciclo_concepto[]">
                                                <option value="1">SELECCIONAR</option>
                                                <?php
                                                foreach ($ciclos_datos as $ciclos_dato) { ?>
                                                    <option value="<?php echo $ciclos_dato['id_ciclo']; ?>">
                                                        <?php echo $ciclos_dato['ciclo']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>

                                        </div>

                                        <div class="form-group col-md-2" id="ciclo_concepto">
                                            <label for="">Ciclo</label>
                                            <select class="form-control " name="id_ciclo_concepto[]"
                                                id="id_ciclo_concepto" style="width:100%" disabled>
                                                <option value="1">SELECCIONAR</option>
                                                <?php
                                                foreach ($ciclos_datos as $ciclos_dato) { ?>
                                                    <option value="<?php echo $ciclos_dato['id_ciclo']; ?>">
                                                        <?php echo $ciclos_dato['ciclo']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>

                                        </div>

                                        <script>
                                            $(document).ready(function () {
                                                $('#id_concepto').change(function (e) {
                                                    if ($(this).val() == "10" || $(this).val() == "31" || $(this).val() == "39") {
                                                        document.getElementById("id_anio_concepto").value = "1";
                                                        document.getElementById("id_ciclo_concepto").value = "1";
                                                        $('#id_anio_concepto').prop("disabled", false);
                                                        $('#id_ciclo_concepto').prop("disabled", false);


                                                    } else if ($(this).val() == "1") {
                                                        document.getElementById("id_anio_concepto").value = "1";
                                                        document.getElementById("id_ciclo_concepto").value = "1";
                                                        $('#id_anio_concepto').prop("disabled", true);
                                                        $('#id_ciclo_concepto').prop("disabled", true);
                                                    } else {
                                                        document.getElementById("id_anio_concepto").value = "1";
                                                        document.getElementById("id_ciclo_concepto").value = "1";
                                                        $('#id_anio_concepto').prop("disabled", false);
                                                        $('#id_ciclo_concepto').prop("disabled", true);
                                                    }
                                                })
                                            });
                                        </script>





                                        <div class="form-group col-md-2" id="">
                                            <label for="">Clasificador</label>
                                            <input type="text" class="form-control " name="clasificador[]"
                                                id="clasificador" required onkeypress='return validaNumericos(event)'>
                                        </div>

                                        <div class="form-group col-md-2" id="">

                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">SIAF (DEVOLUCION)</label>
                                            <input type="text" class="form-control " name="siafdevolucion[]" required
                                                onkeypress='return validaNumericos(event)'>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Año</label>
                                            <select class="form-control " name="id_anio_siaf_devolucion[]"
                                                id="comboaniosiafdevolucion" style="width:100%" required>
                                                <option value="">SELECCIONAR</option>
                                                <?php
                                                foreach ($aniosiafdevolucion_datos as $aniosiafdevolucion_dato) { ?>
                                                    <option
                                                        value="<?php echo $aniosiafdevolucion_dato['id_anio_siafdevolucion']; ?>">
                                                        <?php echo $aniosiafdevolucion_dato['anio_siaf']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>

                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">SIAF (ORIGEN)</label>
                                            <input type="text" class="form-control " name="siaforigen[]" required
                                                onkeypress='return validaNumericos(event)'>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Año</label>
                                            <select class="form-control " name="id_anio_siaf_origen[]"
                                                id="comboaniosiaforigen" style="width:100%" required>
                                                <option value="">SELECCIONAR</option>
                                                <?php
                                                foreach ($anio_siaforigen_datos as $anio_siaforigen_dato) { ?>
                                                    <option
                                                        value="<?php echo $anio_siaforigen_dato['id_anio_siaforigen']; ?>">
                                                        <?php echo $anio_siaforigen_dato['anio_siaf']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>

                                        </div>

                                        <div class="form-group col-md-2" id="tipo_documento">
                                            <label for="">Tipo de Identificacion</label>
                                            <select class="form-control " name="id_tipo_documento[]" style="width:100%"
                                                id="id_tipo_documento" required>
                                                <option value="">SELECCIONAR</option>
                                                <?php
                                                foreach ($tipo_documento_datos as $tipo_documento_dato) { ?>
                                                    <option
                                                        value="<?php echo $tipo_documento_dato['id_tipo_documento']; ?>">
                                                        <?php echo $tipo_documento_dato['nombre_documento']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>

                                        </div>

                                        <div class="form-group col-md-2" id="">

                                        </div>



                                        <div class="form-group col-md-2" id="dni">
                                            <label for="">DNI (Solicitante)</label>
                                            <input type="text" class="form-control " name="nro_dni[]" id="nro_dni"
                                                onkeypress='return validaNumericos(event)'>
                                        </div>


                                        <div class="form-group col-md-2" id="nombresolicitante">
                                            <label for="">Nombre del Solicitante</label>
                                            <input type="text" class="form-control " name="nsolicitante[]"
                                                id="nsolicitante">
                                        </div>

                                        <div class="form-group col-md-2" id="dni">
                                            <label for="">DNI (Apoderado)</label>
                                            <input type="text" class="form-control " name="nro_dni_apoderado[]"
                                                id="nro_dni_apoderado" onkeypress='return validaNumericos(event)'>
                                        </div>


                                        <div class="form-group col-md-2" id="nombrepostulante">
                                            <label for="">Nombre del Apoderado</label>
                                            <input type="text" class="form-control " name="npostulante[]"
                                                id="npostulante">
                                        </div>



                                        <div class="form-group col-md-2" id="empresa">
                                            <label for="">Empresa</label>
                                            <select class="form-control " name="razon_social[]" id="razon_social"
                                                style="width:100%">
                                                <option value="1">SELECCIONAR</option>
                                                <?php
                                                foreach ($empresas_datos as $empresas_dato) { ?>
                                                    <option value="<?php echo $empresas_dato['id_empresa']; ?>">
                                                        <?php echo $empresas_dato['razon_social']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>

                                        </div>




                                        <div class="form-group col-md-2" id="">

                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Teléfono</label>
                                            <input type="text" class="form-control " name="telefono[]" id="telefono"
                                                onkeypress='return validaNumericos(event)' required>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Correo</label>
                                            <input type="text" class="form-control " name="correo[]" id="correo"
                                                required>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Importe Devolucion (UNFV)</label>
                                            <input type="text" class="form-control " name="devolucionunfv[]" required
                                                onkeypress='return validaNumericos(event)'>
                                        </div>



                                        <div class="form-group col-md-2" id="nro_cuenta">
                                            <label for="">Nro. de Cuenta</label>
                                            <select class="form-control " name="id_nrocuenta[]" id="combocuenta"
                                                style="width:100%" required>
                                                <option value="">SELECCIONAR</option>
                                                <?php
                                                foreach ($nrocuentas_datos as $nrocuentas_dato) { ?>
                                                    <option value="<?php echo $nrocuentas_dato['id_nrocuenta']; ?>">
                                                        <?php echo $nrocuentas_dato['nro_cuenta']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>

                                        </div>



                                        <div class="form-group col-md-2" id="">
                                            <label for="">Estado de Giro</label>
                                            <select class="form-control " name="id_estado_giro[]" id="combogiro"
                                                style="width:100%" required>
                                                <option value="">SELECCIONAR</option>
                                                <?php
                                                $estado_giro = "PENDIENTE";

                                                foreach ($estado_giro_datos as $estado_giro_dato) {
                                                    $estadogiro_tabla = $estado_giro_dato['estado'];
                                                    $id_estado_giro = $estado_giro_dato['id_estado_giro']; ?>
                                                    <option value="<?php echo $id_estado_giro; ?>" <?php if ($estadogiro_tabla == $estado_giro) { ?> selected="selected" <?php } ?>>
                                                        <?php echo $estadogiro_tabla; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>

                                        </div>

                                        <div class="form-group col-md-2" id="">

                                        </div>

                                        <div class="form-group col-md-4" id="" hidden>
                                            <label for="">Observacion (Estado de Giro)</label>
                                            <input type="text" class="form-control " name="observacion_giro[]">
                                        </div>

                                        <div class="form-group col-md-4" id="">
                                            <label for="">Observacion (Estado de Giro)</label>
                                            <input type="text" class="form-control " name="observacion_giro[]"
                                                id="observacion_giro" disabled>
                                        </div>

                                        <script>
                                            $(document).ready(function () {
                                                $('#combogiro').change(function (e) {
                                                    if ($(this).val() == "1" || $(this).val() == "2" || $(this).val() == "3") {
                                                        document.getElementById("observacion_giro").value = "";
                                                        $('#observacion_giro').prop("disabled", true);


                                                    } else if ($(this).val() == "4") {
                                                        document.getElementById("observacion_giro").value = "";
                                                        $('#observacion_giro').prop("disabled", false);

                                                    }
                                                })
                                            });
                                        </script>

                                        <!--
                                        <div class="form-group col-md-2" style="line-height: 100px;" hidden>

                                            <button class="btn btn-success add_item_btn"><i
                                                    class="bi bi-plus-circle"></i> Añadir</button>
                                        </div>-->




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

                            function validaNumericosRecibo(event){
                                if ((event.charCode >= 48 && event.charCode <= 57)) {
                                    return true;
                                }

                                if ((event.charCode == 45)) {
                                    return true;
                                }

                                if ((event.charCode == 46)) {
                                    return true;
                                }

                                if ((event.charCode == 103)) {
                                    return true;
                                }

                                if ((event.charCode == 110)) {
                                    return true;
                                }

                                return false;
                            }
                        </script>

                        <script>

                            $(document).ready(function () {
                                $(".add_item_btn").click(function (e) {
                                    e.preventDefault();
                                    $("#show_item").prepend(`<div class="form-row">
                                    <input type="text" name="id_usuario[]" value="<?php echo $id_usuario_sesion; ?>" hidden>
                                        <input type="text" name="nt[]" value="<?php echo $numero_tramite; ?>" hidden>
                                        <input type="text" name="id_anio_nt[]" value="<?php echo $id_anio_nt; ?>" hidden>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Nro. Recibo</label>
                                            <input type="text" class="form-control " name="nliquidacion[]"
                                                id="nliquidacion" onkeypress='return validaNumericos(event)' required>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Banco</label>
                                            <select class="form-control " name="banco[]" id="banco" style="width:100%"
                                                required>
                                                <option value="">SELECCIONAR</option>
                                                <?php
                                                foreach ($bancos_datos as $bancos_dato) { ?>
                                                                        <option value="<?php echo $bancos_dato['id_banco']; ?>">
                                                                            <?php echo $bancos_dato['nombre_banco']; ?>
                                                                        </option>
                                                                        <?php
                                                }
                                                ?>
                                            </select>

                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Nro. Cuenta del Banco</label>
                                            <input type="text" class="form-control " name="ncuentabanco[]"
                                                id="ncuentabanco" required onkeypress='return validaNumericos(event)'>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Importe del Voucher</label>
                                            <input type="text" class="form-control " name="importevoucher[]"
                                                id="importevoucher" required onkeypress='return validaNumericos(event)'>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha del Voucher</label>
                                            <input type="date" class="form-control " name="fechavoucher[]"
                                                id="fechavoucher" required>
                                        </div>

                                        <div class="form-group col-md-4" id="concepto">
                                            <label for="">Concepto</label>
                                            <select class="form-control " name="id_concepto[]" style="width:100%"
                                                id="id_concepto[]" required>
                                                <option value="">SELECCIONAR</option>
                                                <?php
                                                foreach ($conceptos_datos as $conceptos_dato) { ?>
                                                                        <option value="<?php echo $conceptos_dato['id_concepto']; ?>">
                                                                            <?php echo $conceptos_dato['nombre']; ?>
                                                                        </option>
                                                                        <?php
                                                }
                                                ?>
                                            </select>

                                        </div>



                                        <div class="form-group col-md-2" id="anio_concepto">
                                            <label for="">Año</label>
                                            <select class="form-control " name="id_anio_concepto[]"
                                                id="id_anio_concepto" style="width:100%">
                                                <option value="1">SELECCIONAR</option>
                                                <?php
                                                foreach ($anios_conceptos_datos as $anios_conceptos_dato) { ?>
                                                                        <option
                                                                            value="<?php echo $anios_conceptos_dato['id_anio_concepto']; ?>">
                                                                            <?php echo $anios_conceptos_dato['anio_concepto']; ?>
                                                                        </option>
                                                                        <?php
                                                }
                                                ?>
                                            </select>

                                        </div>




                                        <div class="form-group col-md-2" id="ciclo_concepto">
                                            <label for="">Ciclo</label>
                                            <select class="form-control " name="id_ciclo_concepto[]"
                                                id="id_ciclo_concepto" style="width:100%">
                                                <option value="1">SELECCIONAR</option>
                                                <?php
                                                foreach ($ciclos_datos as $ciclos_dato) { ?>
                                                                        <option value="<?php echo $ciclos_dato['id_ciclo']; ?>">
                                                                            <?php echo $ciclos_dato['ciclo']; ?>
                                                                        </option>
                                                                        <?php
                                                }
                                                ?>
                                            </select>

                                        </div>







                                        <div class="form-group col-md-2" id="">
                                            <label for="">Clasificador</label>
                                            <input type="text" class="form-control " name="clasificador[]"
                                                id="clasificador" required onkeypress='return validaNumericos(event)'>
                                        </div>

                                        <div class="form-group col-md-2" id="">

                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">SIAF (DEVOLUCION)</label>
                                            <input type="text" class="form-control " name="siafdevolucion[]" required onkeypress='return validaNumericos(event)'>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Año</label>
                                            <select class="form-control " name="id_anio_siaf_devolucion[]"
                                                id="comboaniosiafdevolucion" style="width:100%" required>
                                                <option value="">SELECCIONAR</option>
                                                <?php
                                                foreach ($aniosiafdevolucion_datos as $aniosiafdevolucion_dato) { ?>
                                                                        <option
                                                                            value="<?php echo $aniosiafdevolucion_dato['id_anio_siafdevolucion']; ?>">
                                                                            <?php echo $aniosiafdevolucion_dato['anio_siaf']; ?>
                                                                        </option>
                                                                        <?php
                                                }
                                                ?>
                                            </select>

                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">SIAF (ORIGEN)</label>
                                            <input type="text" class="form-control " name="siaforigen[]" required onkeypress='return validaNumericos(event)'>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Año</label>
                                            <select class="form-control " name="id_anio_siaf_origen[]"
                                                id="comboaniosiaforigen" style="width:100%" required>
                                                <option value="">SELECCIONAR</option>
                                                <?php
                                                foreach ($anio_siaforigen_datos as $anio_siaforigen_dato) { ?>
                                                                        <option
                                                                            value="<?php echo $anio_siaforigen_dato['id_anio_siaforigen']; ?>">
                                                                            <?php echo $anio_siaforigen_dato['anio_siaf']; ?>
                                                                        </option>
                                                                        <?php
                                                }
                                                ?>
                                            </select>

                                        </div>

                                        <div class="form-group col-md-2" id="tipo_documento">
                                            <label for="">Tipo de Identificacion</label>
                                            <select class="form-control " name="id_tipo_documento[]" style="width:100%"
                                                id="id_tipo_documento" required>
                                                <option value="">SELECCIONAR</option>
                                                <?php
                                                foreach ($tipo_documento_datos as $tipo_documento_dato) { ?>
                                                                        <option
                                                                            value="<?php echo $tipo_documento_dato['id_tipo_documento']; ?>">
                                                                            <?php echo $tipo_documento_dato['nombre_documento']; ?>
                                                                        </option>
                                                                        <?php
                                                }
                                                ?>
                                            </select>

                                        </div>

                                        <div class="form-group col-md-2" id="">

                                        </div>



                                        <div class="form-group col-md-2" id="dni">
                                            <label for="">DNI</label>
                                            <input type="text" class="form-control " name="nro_dni[]" id="nro_dni" onkeypress='return validaNumericos(event)'>
                                        </div>


                                        <div class="form-group col-md-2" id="nombresolicitante">
                                            <label for="">Nombre del Solicitante</label>
                                            <input type="text" class="form-control " name="nsolicitante[]"
                                                id="nsolicitante">
                                        </div>


                                        <div class="form-group col-md-2" id="nombrepostulante">
                                            <label for="">Nombre del Apoderado</label>
                                            <input type="text" class="form-control " name="npostulante[]"
                                                id="npostulante">
                                        </div>



                                        <div class="form-group col-md-4" id="empresa">
                                            <label for="">Empresa</label>
                                            <select class="form-control " name="razon_social[]" id="razon_social"
                                                style="width:100%">
                                                <option value="1">SELECCIONAR</option>
                                                <?php
                                                foreach ($empresas_datos as $empresas_dato) { ?>
                                                                        <option value="<?php echo $empresas_dato['id_empresa']; ?>">
                                                                            <?php echo $empresas_dato['razon_social']; ?>
                                                                        </option>
                                                                        <?php
                                                }
                                                ?>
                                            </select>

                                        </div>

                                        <div class="form-group col-md-2" id="">

                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Telefono</label>
                                            <input type="text" class="form-control " name="telefono[]" id="telefono"
                                            onkeypress='return validaNumericos(event)' required>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Correo</label>
                                            <input type="email" class="form-control " name="correo[]" id="correo"
                                                required>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Importe Devolucion (UNFV)</label>
                                            <input type="text" class="form-control " name="devolucionunfv[]" required onkeypress='return validaNumericos(event)'>
                                        </div>



                                        <div class="form-group col-md-2" id="nro_cuenta">
                                            <label for="">Nro. de Cuenta</label>
                                            <select class="form-control " name="id_nrocuenta[]" id="combocuenta"
                                                style="width:100%" required>
                                                <option value="">SELECCIONAR</option>
                                                <?php
                                                foreach ($nrocuentas_datos as $nrocuentas_dato) { ?>
                                                                        <option value="<?php echo $nrocuentas_dato['id_nrocuenta']; ?>">
                                                                            <?php echo $nrocuentas_dato['nro_cuenta']; ?>
                                                                        </option>
                                                                        <?php
                                                }
                                                ?>
                                            </select>

                                        </div>



                                        <div class="form-group col-md-2" id="">
                                            <label for="">Estado de Giro</label>
                                            <select class="form-control " name="id_estado_giro[]" id="combogiro"
                                                style="width:100%" required>
                                                <option value="">SELECCIONAR</option>
                                                                        <?php
                                                                        $estado_giro = "PENDIENTE";

                                                                        foreach ($estado_giro_datos as $estado_giro_dato) {
                                                                            $estadogiro_tabla = $estado_giro_dato['estado'];
                                                                            $id_estado_giro = $estado_giro_dato['id_estado_giro']; ?>
                                                                        <option value="<?php echo $id_estado_giro; ?>" <?php if ($estadogiro_tabla == $estado_giro) { ?> selected="selected" <?php } ?>>
                                                                            <?php echo $estadogiro_tabla; ?>
                                                                        </option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                            </select>

                                        </div>
                                        
                                        <div class="form-group col-md-2" style="line-height: 100px;">

            <button class="btn btn-danger remove_item_btn"><i class="bi bi-x-circle"></i> Eliminar</button>
                                        </div>


                                        <hr style="width:100%;background-color: black;">
                                    </div>`);
                                });
                            });

                            $(document).on('click', '.remove_item_btn', function (e) {
                                e.preventDefault();
                                let row_item = $(this).parent().parent();
                                $(row_item).remove();
                            });
                        </script>

                        <script>
                            $(document).ready(function () {
                                $('#banco').select2({
                                    theme: 'bootstrap4',
                                });

                                $('#id_concepto').select2({
                                    theme: 'bootstrap4',
                                });




                                $('#comboaniosiafdevolucion').select2({
                                    theme: 'bootstrap4',
                                });

                                $('#comboaniosiaforigen').select2({
                                    theme: 'bootstrap4',
                                });

                                $('#id_tipo_documento').select2({
                                    theme: 'bootstrap4',
                                });

                                $('#razon_social').select2({
                                    theme: 'bootstrap4',
                                });

                                $('#combocuenta').select2({
                                    theme: 'bootstrap4',
                                });

                                $('#combogiro').select2({
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

<?php include('../layout/parte2.php'); ?>

<div class="modal fade" id="modal-create-concepto">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: black; color: white">
                <h4 class="modal-title">Registrar Nuevo Concepto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Nombre de Concepto</label>
                            <input type="text" id="nombre_concepto" class="form-control ">
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
        var nombre_concepto = $('#nombre_concepto').val();

        if (nombre_concepto == "") {
            $('#nombre_concepto').focus();
            $('#lbl_create2').css('display', 'block');
        } else {
            var url = "../app/controllers/conceptos/create_modal.php";
            $.get(url, { nombre_concepto: nombre_concepto }, function (datos) {
                $('#respuesta3').html(datos);
            });
        }

    });
</script>

<div id="respuesta3"></div>