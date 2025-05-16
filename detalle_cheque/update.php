<?php
include ('../app/config.php');
include ('../layout/sesion.php');
include ('../layout/parte1.php');
include ('../layout/mensajes.php');

include ('../app/controllers/detalle_cheque/show_detalle.php');

include ('../app/controllers/cuenta/listado_de_nrocuentas.php');
include ('../app/controllers/estado_cheque/listado_de_estado_cheque.php');



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

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Actualizar Datos del Pago Realizado : NT
                            <?php echo $numero_tramite . " - " . $anio_nt; ?></b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/detalle_cheque"><i
                                    class="bi bi-card-checklist"></i> Pagos realizados</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-pencil"></i> Actualizar pago realizado</a>
                        </li>
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
                            <h3 class="card-title">Digite los datos del pago realizado a actualizar</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: inline;">



                            <form action="../app/controllers/detalle_cheque/update.php" method="post">
                                <input type="text" name="id_detalle_cheque" value="<?php echo $id_detalle_cheque; ?>"
                                    hidden>
                                <input type="text" name="id_usuario" value="<?php echo $id_usuario_sesion; ?>" hidden>

                                <input type="text" name="id_asunto" value="<?php echo $id_asunto; ?>" hidden>

                                <input type="text" name="id_cheque" value="<?php echo $id_cheque; ?>" hidden>

                                <div class="form-row">

                                    <div class="form-group col-md-2" id="nro_cuenta">
                                        <label for="">Tipo de Cheque</label>
                                        <select class="form-control " name="id_nrocuenta" id="combocuenta"
                                            style="width:100%" required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($nrocuentas_datos as $nrocuentas_dato) {
                                                $nro_cuenta_tabla = $nrocuentas_dato['nro_cuenta'];
                                                $id_nrocuenta = $nrocuentas_dato['id_nrocuenta']; ?>
                                                <option value="<?php echo $id_nrocuenta; ?>" <?php if ($nro_cuenta_tabla == $nro_cuenta) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $nro_cuenta_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">N° Comp. Int.</label>
                                        <input type="text" class="form-control " name="nro_comprobante_interno"
                                            id="nro_comprobante_interno" onkeypress='return validaNumericos(event)'
                                            value="<?php echo $nro_ci; ?>" >
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Comp. Int.</label>
                                        <input type="date" class="form-control " name="fecha_comprobante_interno"
                                            id="fecha_comprobante_interno" value="<?php echo $fecha_ci; ?>" >
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">N° Comp. Ext.</label>
                                        <input type="text" class="form-control " name="nro_comprobante_externo"
                                            id="nro_comprobante_externo" onkeypress='return validaNumericos(event)'
                                            value="<?php echo $nro_ce; ?>" >
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Comp. Ext.</label>
                                        <input type="date" class="form-control " name="fecha_comprobante_externo"
                                            id="fecha_comprobante_externo" value="<?php echo $fecha_ce; ?>" >
                                    </div>

                                    <div class="form-group col-md-2" id="">

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">N° Cheque</label>
                                        <input type="text" class="form-control " name="numero_cheque" id="numero_cheque"
                                            onkeypress='return validaNumericos(event)'
                                            value="<?php echo $nro_cheque; ?>" >
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha de Emision (Cheque)</label>
                                        <input type="date" class="form-control " name="fecha_emision_cheque"
                                            id="fecha_emision_cheque" value="<?php echo $fecha_emision_cheque; ?>"
                                            >
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                            <label for="">SIAF</label>
                                            <input type="text" class="form-control " name="siaf" id="siaf"
                                                onkeypress='return validaNumericos(event)' value="<?php echo $siaf;?>">
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Monto</label>
                                        <input type="text" class="form-control " name="monto" id="monto"
                                            onkeypress='return validaNumericos(event)' value="<?php echo $monto; ?>"
                                            >
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">N° Envio</label>
                                        <input type="text" class="form-control " name="numero_envio" id="numero_envio"
                                            onkeypress='return validaNumericos(event)' value="<?php echo $nro_envio; ?>"
                                            >
                                    </div>

                                    <div class="form-group col-md-2" id="">

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Aprobado</label>
                                        <input type="date" class="form-control " name="fecha_aprobado"
                                            id="fecha_aprobado" value="<?php echo $fecha_aprobado; ?>" >
                                    </div>



                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Entregado</label>
                                        <input type="date" class="form-control " name="fecha_entregado"
                                            id="fecha_entregado" value="<?php echo $fecha_entregado; ?>" >
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Pagado</label>
                                        <input type="date" class="form-control " name="fecha_pagado" id="fecha_pagado"
                                            value="<?php echo $fecha_pagado; ?>" >
                                    </div>

                                    <div class="form-group col-md-2" id="campo_estado">
                                            <label for="">Estado</label>
                                            <select class="form-control " name="id_estado_cheque" id="combo_estado"
                                                style="width:100%" required>
                                                <option value="">SELECCIONAR</option>
                                                <?php
                                                foreach ($estado_cheque_datos as $estado_cheque_dato) {
                                                    $nombre_estado_cheque_tabla = $estado_cheque_dato['nombre_estado_cheque'];
                                                    $id_estado_cheque = $estado_cheque_dato['id_estado_cheque']; ?>
                                                    <option value="<?php echo $id_estado_cheque; ?>" <?php if ($nombre_estado_cheque_tabla == $estado_cheque) { ?>
                                                            selected="selected" <?php } ?>>
                                                        <?php echo $nombre_estado_cheque_tabla; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>

                                    </div>

                                    <div class="form-group col-md-4" id="" hidden>
                                        <label for="">Observacion</label>
                                        <input type="text" class="form-control " name="observacion" id="observacion" value="<?php echo $observacion; ?>">
                                    </div>

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
                                $('#combocuenta').select2({
                                    theme: 'bootstrap4',
                                });

                                $('#combo_estado').select2({
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

<?php include ('../layout/mensajes.php'); ?>
<?php include ('../layout/parte2.php'); ?>