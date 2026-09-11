<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');
include('../layout/mensajes.php');

if ((isset($_SESSION['numero_tramite_cheque'])) && isset($_SESSION['anio_nt_cheque']) && isset($_SESSION['id_anio_nt_cheque']) && isset($_SESSION['id_asunto'])) {
    $numero_tramite = $_SESSION['numero_tramite_cheque'];
    $anio_nt = $_SESSION['anio_nt_cheque'];
    $id_anio_nt = $_SESSION['id_anio_nt_cheque'];
    $id_asunto = $_SESSION['id_asunto'];
    $id_cheque= $_SESSION['id_cheque'];

} else {
    $numero_tramite = "";
    $anio_nt = "";
    $id_anio_nt = "";
    $id_asunto = "";
    $id_cheque= "";
}

include('../app/controllers/cuenta/listado_de_nrocuentas.php');
include('../app/controllers/estado_cheque/listado_de_estado_cheque.php');

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
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/detalle_cheque/index.php"><i
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
                            <h3 class="card-title">Digite los datos a detallar segun el cheque del pago realizado</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: inline;">
                            <form action="../app/controllers/detalle_cheque/create.php" method="post" id="add-form">

                                <div id="show_item">
                                    <div class="form-row">
                                        <input type="text" name="id_usuario[]" value="<?php echo $id_usuario_sesion; ?>"
                                            hidden>
                                        <input type="text" name="nt[]" value="<?php echo $numero_tramite; ?>" hidden>
                                        <input type="text" name="id_anio_nt[]" value="<?php echo $id_anio_nt; ?>"
                                            hidden>
                                        <input type="text" name="id_asunto[]" value="<?php echo $id_asunto; ?>" hidden>
                                        <input type="text" name="id_cheque[]" value="<?php echo $id_cheque; ?>" hidden>

                                        <div class="form-group col-md-2" id="nro_cuenta">
                                            <label for="">Tipo de Cheque</label>
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
                                            <label for="">N° Comp. Int.</label>
                                            <input type="text" class="form-control " name="nro_comprobante_interno[]"
                                                id="nro_comprobante_interno" onkeypress='return validaNumericos(event)'>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Comp. Int.</label>
                                            <input type="date" class="form-control " name="fecha_comprobante_interno[]"
                                                id="fecha_comprobante_interno">
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">N° Comp. Ext.</label>
                                            <input type="text" class="form-control " name="nro_comprobante_externo[]"
                                                id="nro_comprobante_externo" onkeypress='return validaNumericos(event)'>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Comp. Ext.</label>
                                            <input type="date" class="form-control " name="fecha_comprobante_externo[]"
                                                id="fecha_comprobante_externo">
                                        </div>

                                        <div class="form-group col-md-2" id="">

                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">N° Cheque</label>
                                            <input type="text" class="form-control " name="numero_cheque[]"
                                                id="numero_cheque" onkeypress='return validaNumericos(event)'>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha de Emision (Cheque)</label>
                                            <input type="date" class="form-control " name="fecha_emision_cheque[]"
                                                id="fecha_emision_cheque">
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">SIAF</label>
                                            <input type="text" class="form-control " name="siaf[]" id="siaf"
                                                onkeypress='return validaNumericos(event)'>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Monto</label>
                                            <input type="text" class="form-control " name="monto[]" id="monto"
                                                onkeypress='return validaNumericos(event)'>
                                        </div>



                                        <div class="form-group col-md-3" id="">
                                            <label for="">N° Envio</label>
                                            <input type="text" class="form-control " name="numero_envio[]"
                                                id="numero_envio" onkeypress='return validaNumericos(event)'>
                                        </div>

                                        

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Aprobado</label>
                                            <input type="date" class="form-control " name="fecha_aprobado[]"
                                                id="fecha_aprobado">
                                        </div>



                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Entregado</label>
                                            <input type="date" class="form-control " name="fecha_entregado[]"
                                                id="fecha_entregado">
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Pagado</label>
                                            <input type="date" class="form-control " name="fecha_pagado[]"
                                                id="fecha_pagado">
                                        </div>

                                        <div class="form-group col-md-3" id="">
                                            <label for="">Nombre de solicitante</label>
                                            <input type="text" class="form-control " name="nombre_solicitante[]"
                                                id="nombre_solicitante">
                                        </div>

                                        <?php
                                        $estado_egreso = "PENDIENTE";
                                        ?>

                                        <div class="form-group col-md-2" id="campo_estado">
                                            <label for="">Estado</label>
                                            <select class="form-control " name="id_estado_cheque" id="combo_estado"
                                                style="width:100%" required>
                                                <option value="">SELECCIONAR</option>
                                                <?php
                                                foreach ($estado_cheque_datos as $estado_cheque_dato) {
                                                    $nombre_estado_cheque_tabla = $estado_cheque_dato['nombre_estado_cheque'];
                                                    $id_estado_cheque = $estado_cheque_dato['id_estado_cheque']; ?>
                                                    <option value="<?php echo $id_estado_cheque; ?>" <?php if ($nombre_estado_cheque_tabla == $estado_egreso) { ?>
                                                            selected="selected" <?php } ?>>
                                                        <?php echo $nombre_estado_cheque_tabla; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>

                                        </div>

                                        

                                        <div class="form-group col-md-3" id="" hidden>
                                            <label for="">Observacion</label>
                                            <input type="text" class="form-control " name="observacion_anulado[]">
                                        </div>

                                        <div class="form-group col-md-3" id="">
                                            <label for="">Observacion</label>
                                            <input type="text" class="form-control " name="observacion_anulado[]"
                                                id="observacion_anulado" disabled>
                                        </div>

                                        <script>
                                            $(document).ready(function () {
                                                $('#combo_estado').change(function (e) {
                                                    if ($(this).val() == "" || $(this).val() == "2" || $(this).val() == "3") {
                                                        document.getElementById("observacion_anulado").value = "";
                                                        $('#observacion_anulado').prop("disabled", true);


                                                    } else if ($(this).val() == "4") {
                                                        document.getElementById("observacion_anulado").value = "";
                                                        $('#observacion_anulado').prop("disabled", false);

                                                    }
                                                })
                                            });
                                        </script>

                                        <div class="form-group col-md-4" id="" hidden>
                                            <label for="">Observacion</label>
                                            <input type="text" class="form-control " name="observacion[]"
                                                id="observacion">
                                        </div>

                                        <div class="form-group col-md-2" style="line-height: 100px;" hidden>

                                            <button class="btn btn-success add_item_btn"><i
                                                    class="bi bi-plus-circle"></i> Añadir</button>
                                        </div>




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

                                $('#combocuenta').select2({
                                    theme: 'bootstrap4',
                                });

                                $('#combo_estado').select2({
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