<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');


include('../app/controllers/dependencia_ingresos/listado_dependencia.php');


if (empty($_POST['dependenciaX'])) {
    $_POST['dependenciaX'] = "";
}

if (empty($_POST['conceptoX'])) {
    $_POST['conceptoX'] = "";
}

if (empty($_POST['fecha_recaudacionX'])) {
    $_POST['fecha_recaudacionX'] = "";
}

if (empty($_POST['fecha_recaudacionY'])) {
    $_POST['fecha_recaudacionY'] = "";
}

if (empty($_POST['documento_recepcionX'])) {
    $_POST['documento_recepcionX'] = "";
}

if (empty($_POST['fecha_depositoX'])) {
    $_POST['fecha_depositoX'] = "";
}

if (empty($_POST['fecha_depositoY'])) {
    $_POST['fecha_depositoY'] = "";
}

if (empty($_POST['codigo_operacionX'])) {
    $_POST['codigo_operacionX'] = "";
}

if (empty($_POST['estadoX'])) {
    $_POST['estadoX'] = "";
}




$sql_recaudacion_ingreso = "SELECT * FROM tb_recaudacion_ingresos WHERE visible!=1 ";

if (isset($_POST["consultar"])) {

    $consultar = 1;
    $dependencia = $_POST['dependenciaX'];
    $concepto = $_POST['conceptoX'];
    $desde_fecha_recaudacion = $_POST['fecha_recaudacionX'];
    $hasta_fecha_recaudacion = $_POST['fecha_recaudacionY'];
    $documento_recepcion = $_POST['documento_recepcionX'];
    $desde_fecha_deposito = $_POST['fecha_depositoX'];
    $hasta_fecha_deposito = $_POST['fecha_depositoY'];
    $codigo_operacion = $_POST['codigo_operacionX'];
    $estado = $_POST['estadoX'];


    $_SESSION['busqueda_boton_recaudacion_ingreso'] = $consultar;
    $_SESSION['busqueda_dependencia'] = $dependencia;
    $_SESSION['busqueda_concepto'] = $concepto;
    $_SESSION['busqueda_desde_fecha_recaudacion'] = $desde_fecha_recaudacion;
    $_SESSION['busqueda_hasta_fecha_recaudacion'] = $hasta_fecha_recaudacion;
    $_SESSION['busqueda_documento_recepcion'] = $documento_recepcion;
    $_SESSION['busqueda_desde_fecha_deposito'] = $desde_fecha_deposito;
    $_SESSION['busqueda_hasta_fecha_deposito'] = $hasta_fecha_deposito;
    $_SESSION['busqueda_codigo_operacion'] = $codigo_operacion;
    $_SESSION['busqueda_estado'] = $estado;



    if (
        !isset($dependencia) && !isset($concepto) && !isset($desde_fecha_recaudacion) && !isset($hasta_fecha_recaudacion) && !isset($documento_recepcion)
        && !isset($desde_fecha_deposito) && !isset($hasta_fecha_deposito) && !isset($codigo_operacion) && !isset($estado)
    ) {
        $sql_recaudacion_ingreso .= "";
    } else {

        if (!empty($dependencia)) {
            $sql_recaudacion_ingreso .= " AND nombre_dependencia='" . $dependencia . "'";
        }

        if (!empty($concepto)) {
            $sql_recaudacion_ingreso .= " AND detalle_concepto like '%" . $concepto . "%'";
        }

        if (!empty($desde_fecha_recaudacion) && !empty($hasta_fecha_recaudacion)) {
            $sql_recaudacion_ingreso .= " AND fecha_recaudacion between '" . $desde_fecha_recaudacion . " 00:00:00" . "' and '" . $hasta_fecha_recaudacion . " 23:59:59" . "'";
        }

        if (!empty($documento_recepcion)) {
            $sql_recaudacion_ingreso .= " AND documento_recepcion like '%" . $documento_recepcion . "%'";
        }

        if (!empty($desde_fecha_deposito) && !empty($hasta_fecha_deposito)) {
            $sql_recaudacion_ingreso .= " AND fecha_deposito between '" . $desde_fecha_deposito . " 00:00:00" . "' and '" . $hasta_fecha_deposito . " 23:59:59" . "'";
        }

        if (!empty($codigo_operacion)) {
            $sql_recaudacion_ingreso .= " AND numero_operacion='" . $codigo_operacion . "'";
        }

        if (!empty($estado)) {
            $sql_recaudacion_ingreso .= " AND estado='" . $estado . "'";
        }

        $sql_recaudacion_ingreso .= " ORDER BY fecha_recaudacion ASC"; //ordena por fecha operacion electronica para el banco


    }


    $query_recaudacion_ingreso = $pdo->prepare($sql_recaudacion_ingreso);
    $query_recaudacion_ingreso->execute();
    $recaudacion_ingreso_datos = $query_recaudacion_ingreso->fetchAll(PDO::FETCH_ASSOC);


}




$monto = 0;
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1 class="m-0"><b>Consulta de Recaudacion de Ingresos</b>
                        <a href="<?php echo $URL; ?>/recaudacion_ingresos/create.php" type="button"
                            class="btn btn-md bg-primary" id="boton_agregar">
                            <i class="bi bi-plus-circle"></i> Agregar Nuevo Ingreso</a>
                        <a href="<?php echo $URL; ?>/recaudacion_ingresos/importar_xlsx.php"
                            type="button" class="btn btn-md bg-black" id="boton_importarExcel">
                            <i class="bi bi-file-earmark-excel"></i> Importar Excel</a>
                        <a href="<?php echo $URL; ?>/app/controllers/recaudacion_ingresos/exportar_xlsx.php"
                            type="button" class="btn btn-md bg-success" id="boton_exportarExcel">
                            <i class="bi bi-file-earmark-excel"></i> Exportar a Excel</a>
                        <a href="<?php echo $URL; ?>/app/controllers/recaudacion_ingresos/exportar_pdf.php"
                            type="button" class="btn btn-md bg-danger" target="_blank" id="boton_exportarPDF">
                            <i class="bi bi-file-earmark-pdf"></i> Exportar a PDF</a>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-file-earmark-text"></i> Recaudacion de
                            Ingresos</li>
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
                            <h3 class="card-title">INGRESOS REGISTRADO</h3>
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
                                        <label for="">Dependencia</label>
                                        <select class="form-control " name="dependenciaX" id="combo_dependencia"
                                            style="width:100%">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($dependencias_ing_datos as $dependencias_ing_dato) {
                                                $nombre_dependencia_tabla = $dependencias_ing_dato['nombre_dependencia'];
                                                $id_dependencia_ingresos_tabla = $dependencias_ing_dato['id_dependencia_ingresos']; ?>
                                                <option value="<?php echo $nombre_dependencia_tabla; ?>" <?php if ($nombre_dependencia_tabla == $_POST["dependenciaX"]) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $nombre_dependencia_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-3" id="">
                                        <label for="">Concepto</label>
                                        <input type="text" class="form-control " name="conceptoX" id="concepto"
                                            value="<?php echo $_POST['conceptoX']; ?>">

                                    </div>


                                    <div class="form-group col-md-2" id="">
                                        <label for="">Desde fecha de recaudacion</label>
                                        <input type="date" class="form-control " name="fecha_recaudacionX"
                                            value="<?php echo $_POST['fecha_recaudacionX']; ?>">

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Hasta fecha de recaudacion</label>
                                        <input type="date" class="form-control " name="fecha_recaudacionY"
                                            value="<?php echo $_POST['fecha_recaudacionY']; ?>">

                                    </div>

                                    <div class="form-group col-md-3" id="">
                                        <label for="">Documento de recepcion</label>
                                        <input type="text" class="form-control " name="documento_recepcionX"
                                            id="documento_recepcion"
                                            value="<?php echo $_POST['documento_recepcionX']; ?>">

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Desde fecha de deposito</label>
                                        <input type="date" class="form-control " name="fecha_depositoX"
                                            value="<?php echo $_POST['fecha_depositoX']; ?>">

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Hasta fecha de deposito</label>
                                        <input type="date" class="form-control " name="fecha_depositoY"
                                            value="<?php echo $_POST['fecha_depositoY']; ?>">

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Codigo de operacion</label>
                                        <input type="text" class="form-control " name="codigo_operacionX"
                                            id="codigo_operacion" onkeypress='return validaNumericos(event)'
                                            value="<?php echo $_POST['codigo_operacionX']; ?>">

                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Estado</label>

                                        <select class="form-control" name="estadoX" id="combo_estado"
                                            style="width:100%">

                                            <option value="">SELECCIONAR</option>

                                            <option value="PAGADO" <?php if (isset($_POST["estadoX"]) && $_POST["estadoX"] == 'PAGADO')
                                                echo 'selected'; ?>>
                                                PAGADO
                                            </option>

                                            <option value="PENDIENTE" <?php if (isset($_POST["estadoX"]) && $_POST["estadoX"] == 'PENDIENTE')
                                                echo 'selected'; ?>>
                                                PENDIENTE
                                            </option>

                                            <option value="ANULADO" <?php if (isset($_POST["estadoX"]) && $_POST["estadoX"] == 'ANULADO')
                                                echo 'selected'; ?>>
                                                ANULADO
                                            </option>

                                        </select>
                                    </div>


                                    <div class="form-group col-md-2" style="line-height: 100px;">

                                        <button type="submit" name="consultar" id="consultar" class="btn"
                                            style="background-color: black; color: white;"><i class="bi bi-search"></i>
                                            Iniciar consulta</button>
                                    </div>



                                </div>

                                <script>
                                    function validaNumericos(event) {
                                        if ((event.charCode >= 48 && event.charCode <= 57)) {
                                            return true;
                                        }



                                        return false;
                                    }
                                </script>

                                <script>
                                    $(document).ready(function () {
                                        $('#combo_dependencia').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_estado').select2({
                                            theme: 'bootstrap4',
                                        });

                                    });
                                </script>

                                <script>
                                    document.getElementById('concepto').addEventListener('keydown', function (e) {

                                        //si presiona el teclado Enter
                                        if (e.keyCode === 13) {
                                            // entonces haces lo que quieras para poder reaccionar a la pulsación del enter.

                                            // se establecera como clic en el boton Iniciar Consulta
                                            $("#consultar").click();
                                        }
                                    });

                                    document.getElementById('documento_recepcion').addEventListener('keydown', function (e) {

                                        //si presiona el teclado Enter
                                        if (e.keyCode === 13) {
                                            // entonces haces lo que quieras para poder reaccionar a la pulsación del enter.

                                            // se establecera como clic en el boton Iniciar Consulta
                                            $("#consultar").click();
                                        }
                                    });


                                    document.getElementById('codigo_operacion').addEventListener('keydown', function (e) {

                                        //si presiona el teclado Enter
                                        if (e.keyCode === 13) {
                                            // entonces haces lo que quieras para poder reaccionar a la pulsación del enter.

                                            // se establecera como clic en el boton Iniciar Consulta
                                            $("#consultar").click();
                                        }
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
                                <center>Dependencia</center>
                            </th>

                            <th>
                                <center>Concepto</center>
                            </th>

                            <th>
                                <center>Fecha de recaudacion</center>
                            </th>

                            <th>
                                <center>Documento de recepcion</center>
                            </th>

                            <th>
                                <center>Fecha de deposito</center>
                            </th>

                            <th>
                                <center>Codigo de operacion</center>
                            </th>

                            <th>
                                <center>Importe (S/)</center>
                            </th>

                            <th>
                                <center>Estado</center>
                            </th>

                            <th>
                                <center>Acciones</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!isset($recaudacion_ingreso_datos)) {
                            $recaudacion_ingreso_datos = "";
                        } else {



                            $contador = 0;

                            foreach ($recaudacion_ingreso_datos as $recaudacion_ingreso_dato) {
                                $id_recaudacion = $recaudacion_ingreso_dato['id_recaudacion']; ?>
                                <tr>
                                    <td>
                                        <center>
                                            <?php echo $contador = $contador + 1; ?>
                                        </center>
                                    </td>

                                    <td>
                                        <?php

                                        echo $recaudacion_ingreso_dato["nombre_dependencia"];

                                        ?>
                                    </td>

                                    <td>
                                        <?php echo $recaudacion_ingreso_dato['detalle_concepto']; ?>
                                    </td>



                                    <td>


                                        <?php
                                        if ($recaudacion_ingreso_dato['fecha_recaudacion'] == "0000-00-00") {
                                            $recaudacion_ingreso_dato['fecha_recaudacion'] = "";
                                        } else {
                                            $theDate = new DateTime($recaudacion_ingreso_dato['fecha_recaudacion']);
                                            $recaudacion_ingreso_dato['fecha_recaudacion'] = $theDate->format('d/m/Y');
                                        }

                                        echo $recaudacion_ingreso_dato['fecha_recaudacion']; ?>

                                    </td>

                                    <td>
                                        <?php echo $recaudacion_ingreso_dato['documento_recepcion']; ?>
                                    </td>


                                    <td>


                                        <?php
                                        if ($recaudacion_ingreso_dato['fecha_deposito'] == "0000-00-00") {
                                            $recaudacion_ingreso_dato['fecha_deposito'] = "";
                                        } else {
                                            $theDate = new DateTime($recaudacion_ingreso_dato['fecha_deposito']);
                                            $recaudacion_ingreso_dato['fecha_deposito'] = $theDate->format('d/m/Y');
                                        }

                                        echo $recaudacion_ingreso_dato['fecha_deposito']; ?>

                                    </td>

                                    <td>
                                        <?php echo $recaudacion_ingreso_dato['numero_operacion']; ?>
                                    </td>



                                    <td>
                                        <?php
                                        $monto = $monto + $recaudacion_ingreso_dato['importe'];

                                        $importe_recaudado = number_format($recaudacion_ingreso_dato['importe'], 2, '.', ',');


                                        echo $importe_recaudado;
                                        ?>
                                    </td>



                                    <td>


                                        <?php
                                        switch ($recaudacion_ingreso_dato['estado']) {
                                            case 'PAGADO': ?>
                                                <span class="badge bg-dark">
                                                    <?php echo $recaudacion_ingreso_dato['estado']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'PENDIENTE': ?>
                                                <span class="badge bg-warning">
                                                    <?php echo $recaudacion_ingreso_dato['estado']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'ANULADO': ?>
                                                <span class="badge bg-danger">
                                                    <?php echo $recaudacion_ingreso_dato['estado']; ?>
                                                </span>
                                                <?php
                                                break;

                                        }
                                        ?>



                                    </td>


                                    <td>
                                        <center>
                                            <div class="btn-group">
                                                <a href="show.php?id=<?php echo $id_recaudacion; ?>" type="button"
                                                    class="btn btn-sm btn-success"
                                                    id="boton_consultar<?php echo $id_recaudacion; ?>"><i
                                                        class="bi bi-search"></i></a>

                                                <a href="update.php?id=<?php echo $id_recaudacion; ?>" type="button"
                                                    class="btn btn-sm btn-primary"
                                                    id="boton_actualizar<?php echo $id_recaudacion; ?>"><i
                                                        class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="delete.php?id=<?php echo $id_recaudacion; ?>" type="button"
                                                    class="btn btn-sm btn-danger"
                                                    id="boton_eliminar<?php echo $id_recaudacion; ?>"><i
                                                        class="bi bi-x-lg"></i></a>

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
                <div class="form-group col-md-2 float-left" id="">
                    <?php
                    $monto = number_format($monto, 2, '.', ','); //convertir int a decimal
                    ?>
                    <label for="">Monto Total (S/.)</label>
                    <input type="text" class="form-control" name="total" value="<?php echo $monto; ?>" readonly>
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


<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 10,
            "language": {
                "emptyTable": "No hay información",
                "info": "Registros encontrados: _TOTAL_",
                "infoEmpty": "Registros encontrados: 0",
                "infoFiltered": "(Filtrado de _MAX_ total Registros)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Registros",
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