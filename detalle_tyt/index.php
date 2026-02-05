<?php

include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/modalidad_tyt/listado_modalidad_tyt.php');
include('../app/controllers/concepto_tyt/listado_concepto_consultas.php'); /*conceptos*/
include('../app/controllers/referencia_tyt/listado_referencia_tyt.php');
include('../app/controllers/dependencia_tyt/listado_dependencia_tyt.php');
include('../app/controllers/resolucion_rectoral/listado_resolucion_tyt.php');
include('../app/controllers/estado_resolucion/listado_estado_resolucion.php');
include('../app/controllers/situacion_tyt/listado_situacion_tyt.php');


if (empty($_POST['codigo_pagoX'])) {
    $_POST['codigo_pagoX'] = "";
}

if (empty($_POST['modalidadX'])) {
    $_POST['modalidadX'] = "";
}

if (empty($_POST['conceptoX'])) {
    $_POST['conceptoX'] = "";
}

if (empty($_POST['referenciaX'])) {
    $_POST['referenciaX'] = "";
}

if (empty($_POST['dependenciaX'])) {
    $_POST['dependenciaX'] = "";
}

if (empty($_POST['resolucionX'])) {
    $_POST['resolucionX'] = "";
}

if (empty($_POST['estadoX'])) {
    $_POST['estadoX'] = "";
}

if (empty($_POST['situacionX'])) {
    $_POST['situacionX'] = "";
}

/*
$sql_detalle_tasas_tarifas = "SELECT detalle_tyt.id_detalle_tyt as id_detalle_tyt,
 detalle_tyt.codigo_pago as codigo_pago,
 detalle_tyt.modalidad as modalidad,
 detalle_tyt.concepto as concepto,
 detalle_tyt.referencia as referencia,
 detalle_tyt.dependencia as dependencia,
 detalle_tyt.resolucion as resolucion,
 detalle_tyt.monto as monto,
 estado_resolucion.nombre_estado_resolucion as nombre_estado_resolucion
 FROM tb_detalle_tyt as detalle_tyt 
 LEFT JOIN tb_estado_resolucion as estado_resolucion ON estado_resolucion.id_estado_resolucion = detalle_tyt.id_estado_resolucion 
 WHERE detalle_tyt.visible!=1 ";
 */


$sql_detalle_tasas_tarifas = "SELECT detalle_tyt.id_detalle_tyt as id_detalle_tyt,
 tasas_tarifas.codigo_pago as codigo_pago,
 tasas_tarifas.modalidad as modalidad,
 tasas_tarifas.concepto as concepto,
 tasas_tarifas.referencia as referencia,
 tasas_tarifas.dependencia as dependencia,
 detalle_tyt.resolucion as resolucion,
 detalle_tyt.monto as monto,
 estado_resolucion.nombre_estado_resolucion as nombre_estado_resolucion, 
 tasas_tarifas.situacion as nombre_situacion 
 FROM tb_detalle_tyt as detalle_tyt 
 LEFT JOIN tb_estado_resolucion as estado_resolucion ON estado_resolucion.id_estado_resolucion = detalle_tyt.id_estado_resolucion 
 LEFT JOIN tb_tasas_tarifas as tasas_tarifas ON tasas_tarifas.id_tasas_tarifas = detalle_tyt.id_tasas_tarifas
 WHERE detalle_tyt.visible!=1 ";


if (isset($_POST["consultar"])) {

    $consultar = 1;
    $codigo_pago = $_POST['codigo_pagoX'];
    $modalidad = $_POST['modalidadX'];
    $concepto = $_POST['conceptoX'];
    $referencia = $_POST['referenciaX'];
    $dependencia = $_POST['dependenciaX'];
    $resolucion = $_POST['resolucionX'];
    $estado = $_POST['estadoX'];
    $situacion = $_POST['situacionX'];

    $_SESSION['busqueda_boton_tasas_tarifas'] = $consultar;
    $_SESSION['busqueda_codigo_pago'] = $codigo_pago;
    $_SESSION['busqueda_modalidad'] = $modalidad;
    $_SESSION['busqueda_concepto'] = $concepto;
    $_SESSION['busqueda_referencia'] = $referencia;
    $_SESSION['busqueda_dependencia'] = $dependencia;
    $_SESSION['busqueda_resolucion'] = $resolucion;
    $_SESSION['busqueda_estado'] = $estado;
    $_SESSION['busqueda_situacion'] = $situacion;


    if (
        !isset($codigo_pago) && !isset($modalidad) && !isset($concepto) && !isset($referencia) && !isset($dependencia)
        && !isset($resolucion) && !isset($estado) && !isset($situacion)
    ) {
        $sql_detalle_tasas_tarifas .= " ";
    } else {

        if (!empty($codigo_pago)) {
            $sql_detalle_tasas_tarifas .= " AND detalle_tyt.codigo_pago like '%" . $codigo_pago . "%'";
        }

        if (!empty($modalidad)) {
            $sql_detalle_tasas_tarifas .= " AND detalle_tyt.modalidad='" . $modalidad . "'";
        }

        if (!empty($concepto)) {
            $sql_detalle_tasas_tarifas .= " AND detalle_tyt.concepto='" . $concepto . "'";
        }

        if (!empty($referencia)) {
            $sql_detalle_tasas_tarifas .= " AND detalle_tyt.referencia='" . $referencia . "'";
        }

        if (!empty($dependencia)) {
            $sql_detalle_tasas_tarifas .= " AND detalle_tyt.dependencia='" . $dependencia . "'";
        }

        if (!empty($resolucion)) {
            $sql_detalle_tasas_tarifas .= " AND detalle_tyt.resolucion='" . $resolucion . "'";
        }

        if (!empty($estado)) {
            $sql_detalle_tasas_tarifas .= " AND estado_resolucion.nombre_estado_resolucion='" . $estado . "'";
        }

        if (!empty($situacion)) {
            $sql_detalle_tasas_tarifas .= " AND tasas_tarifas.situacion='" . $situacion . "'";
        }

    }


    $query_detalle_tasas_tarifas = $pdo->prepare($sql_detalle_tasas_tarifas);
    $query_detalle_tasas_tarifas->execute();
    $detalle_tasas_tarifas_datos = $query_detalle_tasas_tarifas->fetchAll(PDO::FETCH_ASSOC);


}





?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1 class="m-0"><b>Consulta de Detalle Tasas y Tarifas</b>

                        <a href="<?php echo $URL; ?>/detalle_tyt/reporte_xlsx.php" type="button"
                            class="btn btn-md bg-success" target="_blank" id="boton_exportarExcel">
                            <i class="bi bi-file-earmark-excel"></i> Exportar a Excel</a>

                        <a href="<?php echo $URL; ?>/detalle_tyt/reporte_pdf.php" type="button"
                            class="btn btn-md bg-danger" target="_blank" id="boton_exportarPDF">
                            <i class="bi bi-file-earmark-pdf"></i> Exportar a PDF</a>
                    </h1>


                </div><!-- /.col -->
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-card-checklist"></i> Detalle Tasas y Tarifas
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
                            <h3 class="card-title">DETALLE DE REGISTROS DE TASAS Y TARIFAS</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body table-responsive" style="display: inline;">
                            <form action="index" method="post">

                                <div class="form-row">

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Codigo de Pago</label>
                                        <input type="text" class="form-control " name="codigo_pagoX"
                                            onkeypress='return validaNumericos(event)' id="codigo_pago"
                                            placeholder="Codigo de Pago" value="<?php echo $_POST['codigo_pagoX']; ?>">
                                    </div>


                                    <div class="form-group col-md-3" id="">
                                        <label for="">Modalidad</label>
                                        <select class="form-control " name="modalidadX" id="combo_modalidad"
                                            style="width:100%">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($modalidad_tyt_datos as $modalidad_tyt_dato) {
                                                $nombre_modalidad_tabla = $modalidad_tyt_dato['nombre_modalidad']; ?>
                                                <option value="<?php echo $nombre_modalidad_tabla; ?>" <?php if ($nombre_modalidad_tabla == $_POST["modalidadX"]) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_modalidad_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-3" id="">
                                        <label for="">Concepto</label>
                                        <select class="form-control " name="conceptoX" id="combo_concepto"
                                            style="width:100%">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($concepto_tyt_datos as $concepto_tyt_dato) {
                                                $nombre_concepto_tyt_tabla = $concepto_tyt_dato['nombre_concepto_tyt']; ?>
                                                <option value="<?php echo $nombre_concepto_tyt_tabla; ?>" <?php if ($nombre_concepto_tyt_tabla == $_POST["conceptoX"]) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $nombre_concepto_tyt_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-3" id="">
                                        <label for="">Referencia</label>
                                        <select class="form-control " name="referenciaX" id="combo_referencia"
                                            style="width:100%">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($referencia_tyt_datos as $referencia_tyt_dato) {
                                                $nombre_referencia_tabla = $referencia_tyt_dato['nombre_referencia']; ?>
                                                <option value="<?php echo $nombre_referencia_tabla; ?>" <?php if ($nombre_referencia_tabla == $_POST["referenciaX"]) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $nombre_referencia_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Dependencia</label>
                                        <select class="form-control " name="dependenciaX" id="combo_dependencia"
                                            style="width:100%">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($dependencia_tyt_datos as $dependencia_tyt_dato) {

                                                $nombre_dependencias_tyt_tabla = $dependencia_tyt_dato['nombre_dependencias_tyt']; ?>
                                                <option value="<?php echo $nombre_dependencias_tyt_tabla; ?>" <?php if ($nombre_dependencias_tyt_tabla == $_POST["dependenciaX"]) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php
                                                    echo $nombre_dependencias_tyt_tabla;
                                                    ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-3" id="">
                                        <label for="">Resolucion</label>
                                        <select class="form-control " name="resolucionX" id="combo_resolucion"
                                            style="width:100%">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($resolucion_tyt_datos as $resolucion_tyt_dato) {
                                                $nombre_resolucion_tyt = $resolucion_tyt_dato['nombre_resolucion_tyt'];
                                                ?>
                                                <option value="<?php echo $nombre_resolucion_tyt; ?>" <?php if ($nombre_resolucion_tyt == $_POST["resolucionX"]) { ?>selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_resolucion_tyt; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>


                                    <div class="form-group col-md-2" id="">
                                        <label for="">Estado Resolucion</label>
                                        <select class="form-control " name="estadoX" id="combo_estado"
                                            style="width:100%">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($estado_resolucion_datos as $estado_resolucion_dato) {
                                                $nombre_estado_resolucion_tabla = $estado_resolucion_dato['nombre_estado_resolucion'];
                                                $id_estado_resolucion = $estado_resolucion_dato['id_estado_resolucion'];
                                                ?>
                                                <option value="<?php echo $nombre_estado_resolucion_tabla; ?>" <?php if ($nombre_estado_resolucion_tabla == $_POST["estadoX"]) { ?>selected="selected" <?php } ?>>
                                                    <?php echo $nombre_estado_resolucion_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Situacion</label>
                                        <select class="form-control " name="situacionX" id="combo_situacion"
                                            style="width:100%">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($situacion_tyt_datos as $situacion_tyt_dato) {
                                                $nombre_situacion_tyt_tabla = $situacion_tyt_dato['nombre_situacion_tyt'];
                                                $id_situacion_tyt = $situacion_tyt_dato['id_situacion_tyt'];
                                                ?>
                                                <option value="<?php echo $nombre_situacion_tyt_tabla; ?>" <?php if ($nombre_situacion_tyt_tabla == $_POST["situacionX"]) { ?>selected="selected" <?php } ?>>
                                                    <?php echo $nombre_situacion_tyt_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" style="line-height: 100px;">

                                        <button type="submit" name="consultar" id="consultar" class="btn"
                                            style="background-color: black; color: white;"><i class="bi bi-search"></i>
                                            Iniciar consulta</button>
                                    </div>


                                </div>

                                <!--automatizar con boton Enter-->
                                <script>


                                    document.getElementById('codigo_pago').addEventListener('keydown', function (e) {

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

                                        $('#combo_resolucion').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_estado').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_situacion').select2({
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
                                <center>Codigo</center>
                            </th>
                            <th>
                                <center>Modalidad</center>
                            </th>
                            <th>
                                <center>Concepto</center>
                            </th>
                            <th>
                                <center>Referencia</center>
                            </th>
                            <th>
                                <center>Dependencia</center>
                            </th>
                            <th>
                                <center>Resolucion</center>
                            </th>
                            <th>
                                <center>Monto</center>
                            </th>

                            <th>
                                <center>Estado Resolucion</center>
                            </th>

                            <th>
                                <center>Situacion</center>
                            </th>

                            <th>
                                <center>Acciones</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!isset($detalle_tasas_tarifas_datos)) {
                            $detalle_tasas_tarifas_datos = "";
                        } else {



                            $contador = 0;
                            foreach ($detalle_tasas_tarifas_datos as $detalle_tasas_tarifas_dato) {
                                $id_tasas_tarifas = $detalle_tasas_tarifas_dato['id_detalle_tyt']; ?>
                                <tr>
                                    <td>
                                        <center>
                                            <?php echo $contador = $contador + 1; ?>
                                        </center>
                                    </td>


                                    <td>
                                        <?php echo $detalle_tasas_tarifas_dato['codigo_pago']; ?>
                                    </td>

                                    <td>
                                        <?php
                                        #echo substr($tasas_tarifas_dato['modalidad'], 0, 35); 
                                        echo $detalle_tasas_tarifas_dato['modalidad'];
                                        ?>
                                    </td>


                                    <td>
                                        <?php
                                        #echo substr($tasas_tarifas_dato['concepto'], 0, 35); 
                                        echo $detalle_tasas_tarifas_dato['concepto'];
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        #echo substr($tasas_tarifas_dato['referencia'], 0, 35); 
                                        echo $detalle_tasas_tarifas_dato['referencia'];
                                        ?>
                                    </td>

                                    <td>
                                        <?php


                                        echo $detalle_tasas_tarifas_dato['dependencia'];
                                        ?>
                                    </td>

                                    <td>
                                        <?php echo $detalle_tasas_tarifas_dato['resolucion']; ?>
                                    </td>

                                    <td>
                                        <?php echo $detalle_tasas_tarifas_dato['monto']; ?>
                                    </td>

                                    <td>
                                        <?php
                                        switch ($detalle_tasas_tarifas_dato['nombre_estado_resolucion']) {
                                            case 'APROBADO': ?>
                                                <span class="badge bg-success">
                                                    <?php echo $detalle_tasas_tarifas_dato['nombre_estado_resolucion']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'PENDIENTE': ?>
                                                <span class="badge bg-warning">
                                                    <?php echo $detalle_tasas_tarifas_dato['nombre_estado_resolucion']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'ANULADO': ?>
                                                <span class="badge bg-danger">
                                                    <?php echo $detalle_tasas_tarifas_dato['nombre_estado_resolucion']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'INACTIVO': ?>
                                                <span class="badge bg-dark">
                                                    <?php echo $detalle_tasas_tarifas_dato['nombre_estado_resolucion']; ?>
                                                </span>
                                                <?php
                                                break;
                                        }
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        switch ($detalle_tasas_tarifas_dato['nombre_situacion']) {
                                            case 'ACTUALIZACION': ?>
                                                <span class="badge bg-dark">
                                                    <?php echo $detalle_tasas_tarifas_dato['nombre_situacion']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'NO VIGENTE': ?>
                                                <span class="badge bg-dark">
                                                    <?php echo $detalle_tasas_tarifas_dato['nombre_situacion']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'INCORPORACION': ?>
                                                <span class="badge bg-dark">
                                                    <?php echo $detalle_tasas_tarifas_dato['nombre_situacion']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'ELIMINADO': ?>
                                                <span class="badge bg-dark">
                                                    <?php echo $detalle_tasas_tarifas_dato['nombre_situacion']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'MODIFICACION': ?>
                                                <span class="badge bg-dark">
                                                    <?php echo $detalle_tasas_tarifas_dato['nombre_situacion']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'INACTIVO': ?>
                                                <span class="badge bg-dark">
                                                    <?php echo $detalle_tasas_tarifas_dato['nombre_situacion']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'CONTROL INTERNO DE TESORERIA': ?>
                                                <span class="badge bg-dark">
                                                    <?php echo $detalle_tasas_tarifas_dato['nombre_situacion']; ?>
                                                </span>
                                                <?php
                                                break;
                                        }
                                        ?>
                                    </td>





                                    <td>
                                        <center>
                                            <div class="btn-group">
                                                <a href="show.php?id=<?php echo $id_tasas_tarifas; ?>" type="button"
                                                    class="btn btn-sm btn-success"><i class="bi bi-search"></i></a>

                                                <a href="../app/controllers/detalle_tasas/download.php?id=<?php echo $id_tasas_tarifas; ?>"
                                                    type="button" class="btn btn-sm" target="_blank"
                                                    style="background-color: gold;"
                                                    id="boton_imprimir<?php echo $id_detalle_tyt; ?>">
                                                    <i class="bi bi-printer"></i>
                                                </a>
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
                "infoFiltered": "(Filtrado de _MAX_ total Detalle)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Detalle",
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