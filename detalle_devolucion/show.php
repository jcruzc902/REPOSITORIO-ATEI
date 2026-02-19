<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');

include ('../app/controllers/detalle_devolucion/show_detalle.php');
include ('../app/controllers/bancos/listado_de_bancos.php');
include ('../app/controllers/conceptos/listado_de_conceptos.php');
include ('../app/controllers/anio_concepto/listado_de_anios.php');
include ('../app/controllers/ciclo/listado_de_ciclos.php');
include ('../app/controllers/anio_siafdevolucion/listado_siafdevolucion.php');
include ('../app/controllers/anio_siaforigen/listado_siaforigen.php');
include ('../app/controllers/tipo_documento/listado_tipo_documento.php');
include ('../app/controllers/empresas/listado_de_empresas.php');
include ('../app/controllers/cuenta/listado_de_nrocuentas.php');
include ('../app/controllers/estado_giro/listado_de_estado_giro.php');
include ('../app/controllers/doc_pago/listado_de_docpago.php');
include ('../app/controllers/anio_envio/listado_de_envio.php');
include ('../app/controllers/condicion/listado_de_condiciones.php');
include ('../app/controllers/condicion2/listado_de_condiciones_2.php');

if ((isset($_SESSION['numero_tramite'])) && isset($_SESSION['anio_nt']) && isset($_SESSION['id_anio_nt'])) {
    $numero_tramite = $_SESSION['numero_tramite'];
    $anio_nt = $_SESSION['anio_nt'];
    $id_anio_nt = $_SESSION['id_anio_nt'];
} else {
    $numero_tramite = "";
    $anio_nt = "";
    $id_anio_nt = "";
}



?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Datos del Pago Realizado : NT
                            <?php echo $numero_tramite . " - " . $anio_nt; ?></b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/detalle_devolucion"><i
                                    class="bi bi-card-checklist"></i> Pagos Realizado</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-search"></i> Informacion del Pago Realizado</a></li>
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
                                        <label for="">Nro. Recibo</label>
                                        <input type="text" class="form-control " name="nliquidacion" id="nliquidacion"
                                            value="<?php echo $numero_liquidacion; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Banco</label>
                                        <select class="form-control " name="banco" id="banco" style="width:100%"
                                            required disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($bancos_datos as $bancos_dato) {
                                                $nombre_banco_tabla = $bancos_dato['nombre_banco'];
                                                $id_banco = $bancos_dato['id_banco']; ?>
                                                <option value="<?php echo $id_banco; ?>" <?php if ($nombre_banco_tabla == $nombre_banco) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $nombre_banco_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Nro. Cuenta del Banco</label>
                                        <input type="text" class="form-control " name="ncuentabanco" id="ncuentabanco"
                                            value="<?php echo $nro_cuenta_banco; ?>" required disabled>
                                    </div>

                                    <?php
                                    $importe_voucher= number_format($importe_voucher, 2, '.', ','); //convertir int a decimal
                                    ?>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Importe del Voucher</label>
                                        <input type="text" class="form-control " name="importevoucher"
                                            id="importevoucher" value="<?php echo $importe_voucher; ?>" required disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha del Voucher</label>
                                        <input type="date" class="form-control " name="fechavoucher" id="fechavoucher"
                                            value="<?php echo $fecha_voucher; ?>" required disabled>
                                    </div>

                                    <div class="form-group col-md-4" id="concepto">
                                        <label for="">Concepto</label>
                                        <select class="form-control " name="id_concepto" style="width:100%"
                                            id="id_concepto" required disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($conceptos_datos as $conceptos_dato) {
                                                $nombreconcepto_tabla = $conceptos_dato['nombre'];
                                                $id_concepto = $conceptos_dato['id_concepto']; ?>
                                                <option value="<?php echo $id_concepto; ?>" <?php if ($nombreconcepto_tabla == $nombre_concepto) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $nombreconcepto_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>



                                    <div class="form-group col-md-2" id="anio_concepto">
                                        <label for="">Año</label>
                                        <select class="form-control " name="id_anio_concepto" id="id_anio_concepto"
                                            style="width:100%" disabled>
                                            <option value="1">SELECCIONAR</option>
                                            <?php
                                            foreach ($anios_conceptos_datos as $anios_conceptos_dato) {
                                                $anio_concepto_tabla = $anios_conceptos_dato['anio_concepto'];
                                                $id_anio_concepto = $anios_conceptos_dato['id_anio_concepto']; ?>
                                                <option value="<?php echo $id_anio_concepto; ?>" <?php if ($anio_concepto_tabla == $anio_de_concepto) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $anio_concepto_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>




                                    <div class="form-group col-md-2" id="ciclo_concepto">
                                        <label for="">Ciclo</label>
                                        <select class="form-control " name="id_ciclo_concepto" id="id_ciclo_concepto"
                                            style="width:100%" disabled>
                                            <option value="1">SELECCIONAR</option>
                                            <?php
                                            foreach ($ciclos_datos as $ciclos_dato) {
                                                $ciclo_tabla = $ciclos_dato['ciclo'];
                                                $id_ciclo = $ciclos_dato['id_ciclo']; ?>
                                                <option value="<?php echo $id_ciclo; ?>" <?php if ($ciclo_tabla == $nombre_ciclo) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $ciclo_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>







                                    <div class="form-group col-md-2" id="">
                                        <label for="">Clasificador</label>
                                        <input type="text" class="form-control " name="clasificador" id="clasificador"
                                            value="<?php echo $clasificador; ?>" required disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">SIAF (DEVOLUCION)</label>
                                        <input type="text" class="form-control " name="siafdevolucion"
                                            value="<?php echo $siaf_devolucion; ?>" required disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Año</label>
                                        <select class="form-control " name="id_anio_siaf_devolucion"
                                            id="comboaniosiafdevolucion" style="width:100%" required disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($aniosiafdevolucion_datos as $aniosiafdevolucion_dato) {
                                                $anio_siafdev_tabla = $aniosiafdevolucion_dato['anio_siaf'];
                                                $id_anio_siafdevolucion = $aniosiafdevolucion_dato['id_anio_siafdevolucion']; ?>
                                                <option value="<?php echo $id_anio_siafdevolucion; ?>" <?php if ($anio_siafdev_tabla == $anio_siafdevolucion) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $anio_siafdev_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">SIAF (ORIGEN)</label>
                                        <input type="text" class="form-control " name="siaforigen"
                                            value="<?php echo $siaf_origen; ?>" required disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Año</label>
                                        <select class="form-control " name="id_anio_siaf_origen"
                                            id="comboaniosiaforigen" style="width:100%" required disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($anio_siaforigen_datos as $anio_siaforigen_dato) {
                                                $anio_siafori_tabla = $anio_siaforigen_dato['anio_siaf'];
                                                $id_anio_siaforigen = $anio_siaforigen_dato['id_anio_siaforigen']; ?>
                                                <option value="<?php echo $id_anio_siaforigen; ?>" <?php if ($anio_siafori_tabla == $anio_siaforigen) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $anio_siafori_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="tipo_documento">
                                        <label for="">Tipo de Identificacion</label>
                                        <select class="form-control " name="id_tipo_documento" style="width:100%"
                                            id="id_tipo_documento" required disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($tipo_documento_datos as $tipo_documento_dato) {
                                                $nombre_documento_tabla = $tipo_documento_dato['nombre_documento'];
                                                $id_tipo_documento = $tipo_documento_dato['id_tipo_documento']; ?>
                                                <option value="<?php echo $id_tipo_documento; ?>" <?php if ($nombre_documento_tabla == $tipo_identificacion) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_documento_tabla; ?>
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
                                        <input type="text" class="form-control " name="nro_dni"
                                            value="<?php echo $dni; ?>" id="nro_dni" disabled>
                                    </div>


                                    <div class="form-group col-md-2" id="nombresolicitante">
                                        <label for="">Nombre del Solicitante</label>
                                        <input type="text" class="form-control " name="nsolicitante"
                                            value="<?php echo $nombre_solicitante; ?>" id="nsolicitante" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="dni">
                                        <label for="">DNI (Apoderado)</label>
                                        <input type="text" class="form-control " name="nro_dni_apoderado"
                                            value="<?php echo $dni_apoderado; ?>" id="nro_dni_apoderado" disabled>
                                    </div>


                                    <div class="form-group col-md-2" id="nombrepostulante">
                                        <label for="">Nombre del Apoderado</label>
                                        <input type="text" class="form-control " name="npostulante"
                                            value="<?php echo $nombre_apoderado; ?>" id="npostulante" disabled>
                                    </div>



                                    <div class="form-group col-md-2" id="empresa">
                                        <label for="">Empresa</label>
                                        <select class="form-control " name="razon_social" id="razon_social"
                                            style="width:100%" disabled>
                                            <option value="1">SELECCIONAR</option>
                                            <?php
                                            foreach ($empresas_datos as $empresas_dato) {
                                                $razon_social_tabla = $empresas_dato['razon_social'];
                                                $id_empresa = $empresas_dato['id_empresa']; ?>
                                                <option value="<?php echo $id_empresa; ?>" <?php if ($razon_social_tabla == $nombre_empresa) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $razon_social_tabla; ?>
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
                                        <input type="text" class="form-control " name="telefono"
                                            value="<?php echo $telefono; ?>" id="telefono" required disabled> 
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Correo</label>
                                        <input type="email" class="form-control " name="correo"
                                            value="<?php echo $correo; ?>" id="correo" required disabled>
                                    </div>

                                    <?php
                                    $importe_devolucion_unfv= number_format($importe_devolucion_unfv, 2, '.', ','); //convertir int a decimal
                                    ?>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Importe Devolucion (UNFV)</label>
                                        <input type="text" class="form-control " name="devolucionunfv"
                                            value="<?php echo $importe_devolucion_unfv; ?>" required disabled>
                                    </div>



                                    <div class="form-group col-md-2" id="nro_cuenta">
                                        <label for="">Nro. de Cuenta</label>
                                        <select class="form-control " name="id_nrocuenta" id="combocuenta"
                                            style="width:100%" required disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($nrocuentas_datos as $nrocuentas_dato) {
                                                $nro_cuenta_tabla = $nrocuentas_dato['nro_cuenta'];
                                                $id_nrocuenta = $nrocuentas_dato['id_nrocuenta']; ?>
                                                <option value="<?php echo $id_nrocuenta; ?>" <?php if ($nro_cuenta_tabla == $numero_cuenta) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $nro_cuenta_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>



                                    <div class="form-group col-md-2" id="">
                                        <label for="">Estado de Giro</label>
                                        <select class="form-control " name="id_estado_giro" id="combogiro"
                                            style="width:100%" required disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
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

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Saldo (IV-ID)</label>
                                        <input class="form-control" type="text" value="<?php echo $saldo; ?>" readonly >
                                    </div>


                                    

                                        <hr style="width: 100%" id="hr">


                                        <div class="form-group col-md-2" id="campo_doc_pago">
                                            <label for="">Documento de Pago</label>
                                            <select class="form-control " name="doc_pago" id="combodocpago"
                                                style="width:100%" disabled>
                                                <option value="">SELECCIONAR</option>
                                                <?php
                                                foreach ($docpagos_datos as $docpagos_dato) {
                                                    $nombre_docpagos_tabla = $docpagos_dato['nombre'];
                                                    $id_doc_pagos = $docpagos_dato['id_doc_pagos']; ?>
                                                    <option value="<?php echo $id_doc_pagos; ?>" <?php if ($nombre_docpagos_tabla == $documento_pago) { ?> selected="selected"
                                                        <?php } ?>>
                                                        <?php echo $nombre_docpagos_tabla; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>

                                        </div>

                                        <div class="form-group col-md-2" hidden>
                                            <label for="">Nro. Cheque</label>
                                            <input type="text" class="form-control " name="nro_cheque">
                                        </div>

                                        <div class="form-group col-md-2" id="campo_nro_cheque">
                                            <label for="">Nro. Cheque</label>
                                            <input type="text" class="form-control " name="nro_cheque"
                                                value="<?php echo $numero_cheque; ?>" id="nro_cheque_campo" disabled>
                                        </div>

                                        <div class="form-group col-md-2" hidden>
                                            <label for="">Fecha Cheque</label>
                                            <input type="date" class="form-control " name="fecha_cheque">
                                        </div>

                                        <div class="form-group col-md-2" id="campo_fecha_cheque">
                                            <label for="">Fecha Cheque</label>
                                            <input type="date" class="form-control " name="fecha_cheque"
                                                value="<?php echo $fecha_cheque; ?>" id="fecha_cheque_campo" disabled>
                                        </div>

                                        <div class="form-group col-md-2" hidden>
                                            <label for="">Nro. de Envio</label>
                                            <input type="text" class="form-control " name="nro_envio">
                                        </div>

                                        <div class="form-group col-md-2" id="campo_nro_envio">
                                            <label for="">Nro. de Envio</label>
                                            <input type="text" class="form-control " name="nro_envio" id="nro_envio"
                                                value="<?php echo $numero_envio; ?>" disabled>
                                        </div>

                                        <div class="form-group col-md-2" hidden>
                                            <label for="">Año</label>
                                            <select class="form-control " name="id_anio_envio" style="width:100%">
                                                <option value="">SELECCIONAR</option>

                                            </select>

                                        </div>

                                        <div class="form-group col-md-2" id="campo_anio_envio">
                                            <label for="">Año</label>
                                            <select class="form-control " name="id_anio_envio" id="comboanioenvio"
                                                style="width:100%" disabled>
                                                <option value="">SELECCIONAR</option>
                                                <?php
                                                foreach ($anio_envio_datos as $anio_envio_dato) {
                                                    $anio_envio_tabla = $anio_envio_dato['anio_envio'];
                                                    $id_anio_envio = $anio_envio_dato['id_anio_envio']; ?>
                                                    <option value="<?php echo $id_anio_envio; ?>" <?php if ($anio_envio_tabla == $anio_envio) { ?> selected="selected" <?php } ?>>
                                                        <?php echo $anio_envio_tabla; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>

                                        </div>

                                        <div class="form-group col-md-2" id="espaciado2">

                                        </div>

                                        <div class="form-group col-md-2" hidden>
                                            <label for="">Nro. OPE</label>
                                            <input type="text" class="form-control " name="nro_ope">
                                        </div>

                                        <div class="form-group col-md-2" id="campo_nro_ope">
                                            <label for="">Nro. OPE</label>
                                            <input type="text" class="form-control " name="nro_ope" id="nro_ope_campo"
                                                value="<?php echo $numero_ope; ?>" disabled>
                                        </div>

                                        <div class="form-group col-md-2" hidden>
                                            <label for="">Fecha OPE</label>
                                            <input type="date" class="form-control " name="fecha_ope">
                                        </div>

                                        <div class="form-group col-md-2" id="campo_fecha_ope">
                                            <label for="">Fecha OPE</label>
                                            <input type="date" class="form-control " name="fecha_ope"
                                                id="fecha_ope_campo" value="<?php echo $fecha_ope; ?>" disabled>
                                        </div>

                                       


                                        <div class="form-group col-md-2" hidden>
                                            <label for="">Nro. CCI</label>
                                            <input type="text" class="form-control " name="nro_cci">
                                        </div>

                                        <div class="form-group col-md-2" id="campo_nro_cci">
                                            <label for="">Nro. CCI</label>
                                            <input type="text" class="form-control " name="nro_cci" id="nro_cci_campo"
                                                value="<?php echo $numero_cci; ?>" disabled>
                                        </div>

                                        <div class="form-group col-md-2" hidden>
                                            <label for="">Fecha CCI</label>
                                            <input type="date" class="form-control " name="fecha_cci">
                                        </div>

                                        <div class="form-group col-md-2" id="campo_fecha_cci">
                                            <label for="">Fecha CCI</label>
                                            <input type="date" class="form-control " name="fecha_cci"
                                                id="fecha_cci_campo" value="<?php echo $fecha_cci; ?>" disabled>
                                        </div>

                                        <div class="form-group col-md-2" hidden>
                                            <label for="">Nro. Carta de Orden</label>
                                            <input type="text" class="form-control " name="nro_cart_ord">
                                        </div>

                                        <div class="form-group col-md-2" id="campo_nro_cart_ord">
                                            <label for="">Nro. Carta de Orden</label>
                                            <input type="text" class="form-control " name="nro_cart_ord"
                                                value="<?php echo $numero_cartaorden; ?>" id="nro_carta_campo" disabled>
                                        </div>

                                        <div class="form-group col-md-2" hidden>
                                            <label for="">Fecha Carta de Orden</label>
                                            <input type="date" class="form-control " name="fecha_cart_ord">
                                        </div>

                                        <div class="form-group col-md-2" id="campo_fecha_cart_ord">
                                            <label for="">Fecha Carta de Orden</label>
                                            <input type="date" class="form-control " name="fecha_cart_ord"
                                                value="<?php echo $fecha_cartaorden; ?>" id="fecha_carta_campo"
                                                disabled>
                                        </div>

                                        

                                        


                                        <div class="form-group col-md-2" id="campo_nro_ci">
                                            <label for="">Nro. Comp.Int.</label>
                                            <input type="text" class="form-control " name="nro_comp_int"
                                                value="<?php echo $numero_comprobanteinterno; ?>" disabled>
                                        </div>

                                        <div class="form-group col-md-2" id="campo_nro_ce">
                                            <label for="">Nro. Comp.Ext.</label>
                                            <input type="text" class="form-control " name="nro_comp_ext"
                                                value="<?php echo $numero_comprobanteexterno; ?>" disabled>
                                        </div>








                                        <div class="form-group col-md-2" id="campo_fecha_entrega">
                                            <label for="">Fecha de Entrega (Pagaduria)</label>
                                            <input type="date" class="form-control " name="fecha_entrega"
                                                value="<?php echo $fecha_entrega; ?>" disabled>
                                        </div>

                                        <div class="form-group col-md-2" id="campo_condicion">
                                            <label for="">Condición</label>
                                            <select class="form-control " name="id_condicion" id="combocondicional"
                                                style="width:100%" disabled>
                                                <option value="">SELECCIONAR</option>
                                                <?php
                                                foreach ($condiciones_datos as $condiciones_dato) {
                                                    $condicion_tabla = $condiciones_dato['condicion'];
                                                    $id_condicion = $condiciones_dato['id_condicion']; ?>
                                                    <option value="<?php echo $id_condicion; ?>" <?php if ($condicion_tabla == $condicion_entrega) { ?> selected="selected"
                                                        <?php } ?>>
                                                        <?php echo $condicion_tabla; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>

                                        </div>

                                        <div class="form-group col-md-2" id="campo_fecha_pago">
                                            <label for="">Fecha de Pago (BN)</label>
                                            <input type="date" class="form-control " name="fecha_pago"
                                                value="<?php echo $fecha_pago; ?>" disabled>
                                        </div>

                                        <div class="form-group col-md-2" id="campo_condicion2">
                                            <label for="">Condición</label>
                                            <select class="form-control " name="id_condicion2" id="combocondicional2"
                                                style="width:100%" disabled>
                                                <option value="">SELECCIONAR</option>
                                                <?php
                                                foreach ($condiciones2_datos as $condiciones2_dato) {
                                                    $condicion2_tabla = $condiciones2_dato['condicion'];
                                                    $id_condicion2 = $condiciones2_dato['id_condicion2']; ?>
                                                    <option value="<?php echo $id_condicion2; ?>" <?php if ($condicion2_tabla == $condicion_pago) { ?> selected="selected" <?php } ?>>
                                                        <?php echo $condicion2_tabla; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>

                                        </div>

                                        <?php
                                        $importe_devolucion_bn= number_format($importe_devolucion_bn, 2, '.', ','); //convertir int a decimal
                                        ?>

                                        <div class="form-group col-md-2" id="campo_importe_devolucionbn">
                                            <label for="">Importe Devolucion (BN)</label>
                                            <input type="text" class="form-control " name="devolucionbn"
                                                value="<?php echo $importe_devolucion_bn; ?>" disabled>
                                        </div>

                                        <div class="form-group col-md-2" id="campo_diferencia">
                                            <label for="">Diferencia (UNFV-BN)</label>
                                            <input class="form-control" type="text" value="<?php echo $diferencia; ?>"
                                                readonly>
                                        </div>

                                        <div class="form-group col-md-4" id="campo_observacion">
                                            <label for="">Observación</label>
                                            <input type="text" class="form-control " name="observacion"
                                                value="<?php echo $observacion; ?>" disabled>
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
                                    
                                </div>

                                    


                                    
                                    

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