<?php

include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
#include ('../app/controllers/ingresos/listado_detalle_devolucion.php');
include('../app/controllers/anio_nt/listado_de_anios.php');
include('../app/controllers/bancos/listado_de_bancos.php');
include('../app/controllers/conceptos/listado_de_conceptos.php');
include('../app/controllers/estado_giro/listado_de_estado_giro.php');
include('../app/controllers/condicion2/listado_de_condiciones_2.php');

if (empty($_POST['ntX'])) {
    $_POST['ntX'] = "";
}

if (empty($_POST['aniontX'])) {
    $_POST['aniontX'] = "";
}

if (empty($_POST['fecharegistro_desdeX'])) {
    $_POST['fecharegistro_desdeX'] = "";
}

if (empty($_POST['fecharegistro_hastaX'])) {
    $_POST['fecharegistro_hastaX'] = "";
}


if (empty($_POST['nro_reciboX'])) {
    $_POST['nro_reciboX'] = "";
}

if (empty($_POST['bancoX'])) {
    $_POST['bancoX'] = "";
}

if (empty($_POST['importe_voucherX'])) {
    $_POST['importe_voucherX'] = "";
}

if (empty($_POST['fecha_voucherX'])) {
    $_POST['fecha_voucherX'] = "";
}

if (empty($_POST['conceptoX'])) {
    $_POST['conceptoX'] = "";
}

if (empty($_POST['estado_giroX'])) {
    $_POST['estado_giroX'] = "";
}

if (empty($_POST['estado_condicionX'])) {
    $_POST['estado_condicionX'] = "";
}

if (empty($_POST['solicitanteX'])) {
    $_POST['solicitanteX'] = "";
}

if (empty($_POST['numero_opeX'])) {
    $_POST['numero_opeX'] = "";
}

if (empty($_POST['fechaopeX'])) {
    $_POST['fechaopeX'] = "";
}


$sql_detalle_devolucion = "SELECT *, 
t_detalle.nombre_solicitante as solicitante,
tip_documento.nombre_documento as tipo_identificacion,
empresa.razon_social as nombre_empresa,
empresa.ruc as nro_ruc,
banco.nombre_banco as nombre_banco,
concepto.nombre as nombre_concepto,
ciclo.ciclo as nombre_ciclo,
anio_concepto.anio_concepto as anio_de_concepto,
anio_siafdevolucion.anio_siaf as anio_siafdevolucion,
anio_siaforigen.anio_siaf as anio_siaforigen,
nrocuenta.nro_cuenta as numero_cuenta,
anio_nt.id_anio_nt as anio_idnt,
anio_nt.anio_nt as anio_numerotramite,
usuario.nombres as nombre_usuario,
usuario.apaterno as apaterno_usuario,
usuario.amaterno as amaterno_usuario,
estado_giro.estado as estado_giro,
condicion2.condicion as condicion_pago,
t_detalle.numero_ope as numero_ope,
t_detalle.fecha_ope as fecha_ope,
t_detalle.fyh_creacion as fyh_creacion 
FROM tb_detalle_devolucion as t_detalle 
INNER JOIN tb_tipo_documento as tip_documento ON tip_documento.id_tipo_documento= t_detalle.id_tipo_documento 
INNER JOIN tb_empresas as empresa ON empresa.id_empresa = t_detalle.id_empresa 
INNER JOIN tb_bancos as banco ON banco.id_banco = t_detalle.id_banco 
INNER JOIN tb_conceptos as concepto ON concepto.id_concepto= t_detalle.id_concepto 
INNER JOIN tb_ciclos as ciclo ON ciclo.id_ciclo= t_detalle.id_ciclo_concepto 
INNER JOIN tb_anio_concepto as anio_concepto ON anio_concepto.id_anio_concepto= t_detalle.id_anio_concepto 
INNER JOIN tb_anio_siafdevolucion as anio_siafdevolucion ON anio_siafdevolucion.id_anio_siafdevolucion= t_detalle.id_anio_siaf_devolucion 
INNER JOIN tb_anio_siaforigen as anio_siaforigen ON anio_siaforigen.id_anio_siaforigen = t_detalle.id_anio_siaf_origen 
INNER JOIN tb_nrocuenta as nrocuenta ON nrocuenta.id_nrocuenta = t_detalle.id_nrocuenta
INNER JOIN tb_usuarios as usuario ON usuario.id_usuario= t_detalle.id_usuario 
INNER JOIN tb_anio_nt as anio_nt ON anio_nt.id_anio_nt= t_detalle.id_anio_nt 
INNER JOIN tb_estado_giro as estado_giro ON estado_giro.id_estado_giro= t_detalle.id_estado_giro 
LEFT JOIN tb_condicion2 as condicion2 ON condicion2.id_condicion2= t_detalle.id_condicion2 
WHERE t_detalle.visible!=1 ";

if (isset($_POST["consultar"])) {

    $consultar = 1;
    $nt = $_POST['ntX'];
    $anio_nt = $_POST['aniontX'];
    $nro_recibo = $_POST['nro_reciboX'];
    $banco = $_POST['bancoX'];
    $importe_voucher = $_POST['importe_voucherX'];
    $fecha_voucher = $_POST['fecha_voucherX'];
    $concepto = $_POST['conceptoX'];
    $estado_giro = $_POST['estado_giroX'];
    $estado_condicion = $_POST['estado_condicionX'];
    $solicitante = $_POST['solicitanteX'];
    $numero_ope = $_POST['numero_opeX'];
    $fecha_ope = $_POST['fechaopeX'];
    $desde = $_POST['fecharegistro_desdeX'];
    $hasta = $_POST['fecharegistro_hastaX'];

    $_SESSION['busqueda_boton_detalle_devolucion'] = $consultar;
    $_SESSION['busqueda_detalle_nt'] = $nt;
    $_SESSION['busqueda_detalle_anio_nt'] = $anio_nt;
    $_SESSION['busqueda_detalle_nro_recibo'] = $nro_recibo;
    $_SESSION['busqueda_detalle_banco'] = $banco;
    $_SESSION['busqueda_detalle_importe_voucher'] = $importe_voucher;
    $_SESSION['busqueda_detalle_fecha_voucher'] = $fecha_voucher;
    $_SESSION['busqueda_detalle_concepto'] = $concepto;
    $_SESSION['busqueda_detalle_estado_giro'] = $estado_giro;
    $_SESSION['busqueda_detalle_condicion'] = $estado_condicion;
    $_SESSION['busqueda_detalle_solicitante'] = $solicitante;
    $_SESSION['busqueda_detalle_numero_ope'] = $numero_ope;
    $_SESSION['busqueda_detalle_fecha_ope'] = $fecha_ope;
    $_SESSION['busqueda_desde'] = $desde;
    $_SESSION['busqueda_hasta'] = $hasta;


    if (
        !isset($nt) && !isset($anio_nt) && !isset($nro_recibo) && !isset($banco) && !isset($importe_voucher) && !isset($fecha_voucher) && !isset($concepto)
        && !isset($estado_giro) && !isset($estado_condicion) && !isset($solicitante) && !isset($numero_ope) && !isset($fecha_ope) && !isset($desde) && !isset($hasta)
    ) {
        $sql_detalle_devolucion .= "";
    } else {

        if (!empty($nt)) {
            $sql_detalle_devolucion .= " AND t_detalle.nt like '%" . $nt . "%'";
        }

        if (!empty($anio_nt)) {
            $sql_detalle_devolucion .= " AND t_detalle.id_anio_nt='" . $anio_nt . "'";
        }

        if (!empty($nro_recibo)) {
            $sql_detalle_devolucion .= " AND t_detalle.nro_liquidacion like '%" . $nro_recibo . "%'";
        }

        if (!empty($banco)) {
            $sql_detalle_devolucion .= " AND t_detalle.id_banco='" . $banco . "'";
        }

        if (!empty($importe_voucher)) {
            $sql_detalle_devolucion .= " AND t_detalle.importe_voucher like '%" . $importe_voucher . "%'";
        }

        if (!empty($fecha_voucher)) {
            $sql_detalle_devolucion .= " AND t_detalle.fecha_voucher='" . $fecha_voucher . "'";
        }

        if (!empty($concepto)) {
            $sql_detalle_devolucion .= " AND t_detalle.id_concepto='" . $concepto . "'";
        }

        if (!empty($estado_giro)) {
            $sql_detalle_devolucion .= " AND t_detalle.id_estado_giro='" . $estado_giro . "'";
        }

        if (!empty($estado_condicion)) {
            $sql_detalle_devolucion .= " AND t_detalle.id_condicion2='" . $estado_condicion . "'";
        }

        if (!empty($solicitante)) {
            $sql_detalle_devolucion .= " AND t_detalle.nombre_solicitante like '%" . $solicitante . "%'";
        }

        if (!empty($numero_ope)) {
            $sql_detalle_devolucion .= " AND t_detalle.numero_ope like '%" . $numero_ope . "%'";
        }

        if (!empty($fecha_ope)) {
            $sql_detalle_devolucion .= " AND t_detalle.fecha_ope='" . $fecha_ope . "'";
        }

        if (!empty($desde) && !empty($hasta)) {
            $sql_detalle_devolucion .= " AND t_detalle.fecha_ope between '" . $desde." 00:00:00" . "' and '" . $hasta." 23:59:59" . "'";
        }
    }


    $query_detalle_devolucion = $pdo->prepare($sql_detalle_devolucion);
    $query_detalle_devolucion->execute();
    $detalle_devolucion_datos = $query_detalle_devolucion->fetchAll(PDO::FETCH_ASSOC);


}




if ($_POST['fecharegistro_desdeX'] > $_POST['fecharegistro_hastaX']) {
    ?>
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Desde la fecha no puede ser mayor hasta la fecha',
            showConfirmButton: false,
            timer: 5000
        })
    </script>
    <?php
}

?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1 class="m-0"><b>Consulta de Ingresos de Pagos Realizado</b>
                        <a href="<?php echo $URL; ?>/app/controllers/ingresos/exportar_xlsx.php" type="button"
                            class="btn btn-md bg-success" id="boton_exportarExcel">
                            <i class="bi bi-file-earmark-excel"></i> Exportar a Excel</a>
                        <a href="<?php echo $URL; ?>/app/controllers/ingresos/exportar_pdf.php" type="button"
                            class="btn btn-md bg-danger" target="_blank" id="boton_exportarPDF">
                            <i class="bi bi-file-earmark-pdf"></i> Exportar a PDF</a>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-card-checklist"></i> Pagos Realizado</li>
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
                            <h3 class="card-title">DETALLE DE REGISTROS DE DEVOLUCIONES</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body table-responsive" style="display: inline;">
                            <form action="index" method="post">

                                <div class="form-row">


                                    <div class="form-group col-md-2">
                                        <label for="">NT.</label>
                                        <input type="text" class="form-control " name="ntX" id="nt" class="form-control"
                                            value="<?php echo $_POST['ntX']; ?>"
                                            onkeypress='return validaNumericos(event)'>
                                    </div>

                                    <div class="form-group col-md-1">
                                        <label for="">Año</label>
                                        <select class="form-control " name="aniontX" id="anio_nt" style="width:100%"
                                            class="form-control">
                                            <option value="">TODOS</option>
                                            <?php
                                            foreach ($anios_datos as $anios_dato) {
                                                $anio_nt_tabla = $anios_dato['anio_nt'];
                                                $id_anio_nt = $anios_dato['id_anio_nt']; ?>
                                                <option value="<?php echo $id_anio_nt; ?>" <?php if ($id_anio_nt == $_POST["aniontX"]) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $anio_nt_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">N° Recibo</label>
                                        <input type="text" class="form-control " name="nro_reciboX" id="nro_recibo"
                                            class="form-control" value="<?php echo $_POST['nro_reciboX']; ?>"
                                            onkeypress='return validaNumericos(event)'>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Banco</label>
                                        <select class="form-control " name="bancoX" style="width:100%" id="banco"
                                            class="form-control">
                                            <option value="">TODOS</option>
                                            <?php
                                            foreach ($bancos_datos as $bancos_dato) {
                                                $nombre_banco_tabla = $bancos_dato['nombre_banco'];
                                                $id_banco = $bancos_dato['id_banco']; ?>
                                                <option value="<?php echo $id_banco; ?>" <?php if ($id_banco == $_POST["bancoX"]) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $nombre_banco_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Importe del Voucher</label>
                                        <input type="text" class="form-control " name="importe_voucherX"
                                            id="importe_voucher" class="form-control"
                                            value="<?php echo $_POST['importe_voucherX']; ?>"
                                            onkeypress='return validaNumericos(event)'>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Fecha del Voucher</label>
                                        <input type="date" class="form-control " name="fecha_voucherX"
                                            class="form-control" value="<?php echo $_POST['fecha_voucherX']; ?>">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="">Concepto</label>
                                        <select class="form-control " name="conceptoX" style="width:100%" id="concepto"
                                            class="form-control">
                                            <option value="">TODOS</option>
                                            <?php
                                            foreach ($conceptos_datos as $conceptos_dato) {
                                                $nombre_concepto_tabla = $conceptos_dato['nombre'];
                                                $id_concepto = $conceptos_dato['id_concepto']; ?>
                                                <option value="<?php echo $id_concepto; ?>" <?php if ($id_concepto == $_POST["conceptoX"]) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $nombre_concepto_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="">Nombre del Solicitante</label>
                                        <input type="text" class="form-control " name="solicitanteX"
                                            class="form-control" value="<?php echo $_POST['solicitanteX']; ?>">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Estado de Giro</label>
                                        <select class="form-control " name="estado_giroX" style="width:100%"
                                            id="estado_giro" class="form-control">
                                            <option value="">TODOS</option>
                                            <?php
                                            foreach ($estado_giro_datos as $estado_giro_dato) {
                                                $nombre_estado_tabla = $estado_giro_dato['estado'];
                                                $id_estado_giro = $estado_giro_dato['id_estado_giro']; ?>
                                                <option value="<?php echo $id_estado_giro; ?>" <?php if ($id_estado_giro == $_POST["estado_giroX"]) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $nombre_estado_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Condicion de Pago</label>
                                        <select class="form-control " name="estado_condicionX" style="width:100%"
                                            id="condicion_pago" class="form-control">
                                            <option value="">TODOS</option>
                                            <?php
                                            foreach ($condiciones2_datos as $condiciones2_dato) {
                                                $condicion_tabla = $condiciones2_dato['condicion'];
                                                $id_condicion2 = $condiciones2_dato['id_condicion2']; ?>
                                                <option value="<?php echo $id_condicion2; ?>" <?php if ($id_condicion2 == $_POST["estado_condicionX"]) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $condicion_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">N° OPE</label>
                                        <input type="text" class="form-control " name="numero_opeX" id="numero_ope"
                                            class="form-control" value="<?php echo $_POST["numero_opeX"] ?>">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Fecha OPE</label>
                                        <input type="date" class="form-control " name="fechaopeX" class="form-control"
                                            value="<?php echo $_POST["fechaopeX"] ?>">
                                    </div>


                                    <div class="form-group col-md-2">
                                        <label for="">Desde</label>
                                        <input type="date" class="form-control " name="fecharegistro_desdeX"
                                            class="form-control" value="<?php echo $_POST["fecharegistro_desdeX"] ?>">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Hasta</label>
                                        <input type="date" class="form-control " name="fecharegistro_hastaX"
                                            class="form-control" value="<?php echo $_POST["fecharegistro_hastaX"] ?>">
                                    </div>

                                    <div class="form-group col-md-2" style="line-height: 100px;">

                                        <button type="submit" name="consultar" id="consultar" class="btn"
                                            style="background-color: black; color: white;"><i class="bi bi-search"></i>
                                            Iniciar consulta</button>
                                    </div>



                                </div>

                                <script>
                                    document.getElementById('nt').addEventListener('keydown', function (e) {

                                        //si presiona el teclado Enter
                                        if (e.keyCode === 13) {
                                            // entonces haces lo que quieras para poder reaccionar a la pulsación del enter.

                                            // se establecera como clic en el boton Iniciar Consulta
                                            $("#consultar").click();
                                        }
                                    });

                                    document.getElementById('nro_recibo').addEventListener('keydown', function (e) {

                                        //si presiona el teclado Enter
                                        if (e.keyCode === 13) {
                                            // entonces haces lo que quieras para poder reaccionar a la pulsación del enter.

                                            // se establecera como clic en el boton Iniciar Consulta
                                            $("#consultar").click();
                                        }
                                    });

                                    document.getElementById('importe_voucher').addEventListener('keydown', function (e) {

                                        //si presiona el teclado Enter
                                        if (e.keyCode === 13) {
                                            // entonces haces lo que quieras para poder reaccionar a la pulsación del enter.

                                            // se establecera como clic en el boton Iniciar Consulta
                                            $("#consultar").click();
                                        }
                                    });

                                    document.getElementById('numero_ope').addEventListener('keydown', function (e) {

                                        //si presiona el teclado Enter
                                        if (e.keyCode === 13) {
                                            // entonces haces lo que quieras para poder reaccionar a la pulsación del enter.

                                            // se establecera como clic en el boton Iniciar Consulta
                                            $("#consultar").click();
                                        }
                                    });
                                </script>

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
                                        $('#banco').select2({
                                            theme: 'bootstrap4',
                                        });
                                        $('#concepto').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#estado_giro').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#condicion_pago').select2({
                                            theme: 'bootstrap4',
                                        });

                                    });
                                </script>
                            </form>

                        </div>

                    </div>
                </div>
            </div>



            <div class="table-responsive">
                <table id="example1" class="table table-md table-hover text-center">
                    <thead>
                        <tr style="background-color: midnightblue; color: white">
                            <th>
                                <center>N°</center>
                            </th>
                            <th>
                                <center>NT</center>
                            </th>
                            <th>
                                <center>Año</center>
                            </th>
                            <th>
                                <center>N° Recibo</center>
                            </th>
                            <th>
                                <center>Banco</center>
                            </th>
                            <th>
                                <center>Importe del Voucher</center>
                            </th>
                            <th>
                                <center>Fecha del Voucher</center>
                            </th>
                            <th>
                                <center>Concepto</center>
                            </th>
                            <th>
                                <center>Clasificador</center>
                            </th>
                            <th>
                                <center>Solicitante</center>
                            </th>
                            <th>
                                <center>Estado Giro</center>
                            </th>
                            <th>
                                <center>Condicion Pago</center>
                            </th>
                            <!--
                            <th>
                                <center>N° OPE</center>
                            </th>
                            <th>
                                <center>Fecha OPE</center>
                            </th>
                                -->
                            <th>
                                <center>Fecha de Registro</center>
                            </th>
                            <th>
                                <center>Acciones</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!isset($detalle_devolucion_datos)) {
                            $detalle_devolucion_datos = "";
                        } else {

                            $contador = 0;
                            foreach ($detalle_devolucion_datos as $detalle_devolucion_dato) {
                                $id_detalle_devolucion = $detalle_devolucion_dato['id_detalle_devolucion']; ?>
                                <tr>
                                    <td>
                                        <center>
                                            <?php echo $contador = $contador + 1; ?>
                                        </center>
                                    </td>
                                    <td>
                                        <?php echo $detalle_devolucion_dato['nt']; ?>
                                    </td>
                                    <td>
                                        <?php echo $detalle_devolucion_dato['anio_numerotramite']; ?>
                                    </td>
                                    <td>
                                        <?php echo $detalle_devolucion_dato['nro_liquidacion']; ?>
                                    </td>
                                    <td>
                                        <?php echo $detalle_devolucion_dato['nombre_banco']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $detalle_devolucion_dato['importe_voucher'] = number_format($detalle_devolucion_dato['importe_voucher'], 2, '.', ','); //convertir int a decimal
                                        echo $detalle_devolucion_dato['importe_voucher'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php $theDate = new DateTime($detalle_devolucion_dato['fecha_voucher']);
                                        echo $stringDate = $theDate->format('d/m/Y'); ?>
                                    </td>
                                    <td>
                                        <?php echo $detalle_devolucion_dato['nombre_concepto']; ?>
                                    </td>
                                    <td>
                                        <?php echo $detalle_devolucion_dato['clasificador']; ?>
                                    </td>
                                    <td>
                                        <?php echo $detalle_devolucion_dato['solicitante']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        switch ($detalle_devolucion_dato['estado_giro']) {
                                            case 'APROBADO': ?>
                                                <span class="badge bg-success">
                                                    <?php echo $detalle_devolucion_dato['estado_giro']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'PENDIENTE': ?>
                                                <span class="badge bg-warning">
                                                    <?php echo $detalle_devolucion_dato['estado_giro']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'ANULADO': ?>
                                                <span class="badge bg-danger">
                                                    <?php echo $detalle_devolucion_dato['estado_giro']; ?>
                                                </span>
                                                <?php
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        switch ($detalle_devolucion_dato['condicion_pago']) {
                                            case 'COBRADO': ?>
                                                <span class="badge bg-dark">
                                                    <?php echo $detalle_devolucion_dato['condicion_pago']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'ANULADO': ?>
                                                <span class="badge bg-danger">
                                                    <?php echo $detalle_devolucion_dato['condicion_pago']; ?>
                                                </span>
                                                <?php
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <!--
                                    <td>
                                        <?php echo $detalle_devolucion_dato['numero_ope']; ?>
                                    </td>
                                    <td>
                                        <?php

                                        if ($detalle_devolucion_dato['fecha_ope'] != '0000-00-00') {
                                            $theDate = new DateTime($detalle_devolucion_dato['fecha_ope']);
                                            $detalle_devolucion_dato['fecha_ope'] = $theDate->format('d/m/Y');
                                        } else {
                                            $detalle_devolucion_dato['fecha_ope'] = "";
                                        }

                                        echo $detalle_devolucion_dato['fecha_ope'];

                                        ?>
                                        
                                        
                                    </td>

                                    -->
                                    <td>
                                        <?php $theDate = new DateTime($detalle_devolucion_dato['fyh_creacion']);
                                        echo $detalle_devolucion_dato['fyh_creacion'] = $theDate->format('d/m/Y h:i:s a'); ?>
                                    </td>


                                    <td>
                                        <center>
                                            <div class="btn-group">
                                                <a href="show.php?id=<?php echo $id_detalle_devolucion; ?>" type="button"
                                                    class="btn btn-sm btn-success"><i class="bi bi-search"></i></a>
                                            </div>
                                        </center>

                                    </td>
                                </tr>
                                <?php
                            }
                        }

                        ?>
                    </tbody>

                </table>
                <br>

            </div>




            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>


<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 10,
            "language": {
                "emptyTable": "No hay información",
                "info": "Registros encontrados: _TOTAL_",
                "infoEmpty": "Registros encontrados: 0",
                "infoFiltered": "(Filtrado de _MAX_ total Ingresos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Ingresos",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": false, "lengthChange": true, "autoWidth": false, "searching": false,

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>