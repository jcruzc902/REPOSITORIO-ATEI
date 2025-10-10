<?php

include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/detalle_devolucion/listado_detalle_devolucion.php');


if ((isset($_SESSION['numero_tramite'])) && isset($_SESSION['anio_nt'])) {
    $numero_tramite = $_SESSION['numero_tramite'];
    $anio_nt = $_SESSION['anio_nt'];
} else {
    $numero_tramite = "";
    $anio_nt = "";
}

$total = 0;

?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1 class="m-0"><b>Consulta de Ingresos de Pagos Realizado: NT
                            <?php echo $numero_tramite . " - " . $anio_nt; ?></b>
                        <a href="<?php echo $URL; ?>/detalle_devolucion/create.php" type="button"
                            class="btn btn-md bg-primary" id="boton_agregar">
                            <i class="bi bi-plus-circle"></i> Agregar Nuevo Pago</a>

                        <!--EXPORTAR INFORME EN PDF AUTOMATIZADO-->
                        <a href="<?php echo $URL; ?>/detalle_devolucion/exportar_informe.php" type="button"
                            class="btn btn-md bg-danger" id="boton_exportar_informe">
                            <i class="bi bi-file-earmark-pdf"></i> Exportar Informe</a>
                    </h1>

                    <?php if ($rol_sesion == "SECRETARIA") { ?>
                        <script>
                            //ocultar las secciones
                            document.getElementById('boton_agregar').style.display = 'none';
                            document.getElementById('boton_exportar_informe').style.display = 'none';




                        </script>
                    <?php } else if ($rol_sesion == "JEFATURA") { ?>
                            <script>
                                //ocultar las secciones
                                document.getElementById('boton_agregar').style.display = 'none';
                                document.getElementById('boton_exportar_informe').style.display = 'none';




                            </script>

                    <?php } else if ($rol_sesion == "ADMINISTRADOR") { ?>
                                <script>
                                    //ocultar las secciones
                                    document.getElementById('boton_agregar').style.display = 'inline';
                                    document.getElementById('boton_exportar_informe').style.display = 'inline';



                                </script>

                    <?php } else if ($rol_sesion == "INGRESOS") { ?>
                                    <script>
                                        //ocultar las secciones
                                        document.getElementById('hr').style.display = 'inline';
                                        document.getElementById('campo_doc_pago').style.display = 'inline';



                                    </script>

                    <?php } else if ($rol_sesion == "PAGADURIA") { ?>
                                        <script>
                                            //ocultar las secciones
                                            document.getElementById('hr').style.display = 'none';
                                            document.getElementById('campo_doc_pago').style.display = 'none';






                                        </script>

                    <?php } ?>
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
                                <center>Estado de Giro</center>
                            </th>
                            <th>
                                <center>Condicion de pago</center>
                            </th>
                            <th>
                                <center>Acciones</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

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

                                    $total = $total + $detalle_devolucion_dato['importe_voucher'];

                                    $importe = number_format($detalle_devolucion_dato['importe_voucher'], 2, '.', ','); //convertir int a decimal
                                    echo $importe;


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
                                    <?php echo $detalle_devolucion_dato['nombre_solicitante']; ?>
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



                                <td>
                                    <center>
                                        <div class="btn-group">
                                            <a href="show.php?id=<?php echo $id_detalle_devolucion; ?>" type="button"
                                                class="btn btn-sm btn-success"
                                                id="boton_consultar<?php echo $id_detalle_devolucion; ?>"><i
                                                    class="bi bi-search"></i></a>

                                            <a href="update.php?id=<?php echo $id_detalle_devolucion; ?>" type="button"
                                                class="btn btn-sm btn-primary"
                                                id="boton_actualizar<?php echo $id_detalle_devolucion; ?>"><i
                                                    class="bi bi-pencil-square"></i>
                                            </a>

                                            <a href="delete.php?id=<?php echo $id_detalle_devolucion; ?>" type="button"
                                                class="btn btn-sm btn-danger"
                                                id="boton_eliminar<?php echo $id_detalle_devolucion; ?>"><i
                                                    class="bi bi-x-lg"></i>
                                            </a>



                                        </div>
                                    </center>
                                    <?php
                                    if ($rol_sesion == "ADMINISTRADOR") { ?>
                                        <script>
                                            document.getElementById('boton_consultar<?php echo $id_detalle_devolucion; ?>').style.display = 'inline';

                                            document.getElementById('boton_actualizar<?php echo $id_detalle_devolucion; ?>').style.display = 'inline';

                                            document.getElementById('boton_eliminar<?php echo $id_detalle_devolucion; ?>').style.display = 'inline';

                                        </script>
                                    <?php } else if ($rol_sesion == "INGRESOS") { ?>
                                            <script>
                                                document.getElementById('boton_consultar<?php echo $id_detalle_devolucion; ?>').style.display = 'inline';

                                                document.getElementById('boton_actualizar<?php echo $id_detalle_devolucion; ?>').style.display = 'inline';

                                                document.getElementById('boton_eliminar<?php echo $id_detalle_devolucion; ?>').style.display = 'inline';

                                            </script>
                                    <?php } else if ($rol_sesion == "SECRETARIA") { ?>
                                                <script>
                                                    document.getElementById('boton_consultar<?php echo $id_detalle_devolucion; ?>').style.display = 'inline';

                                                    document.getElementById('boton_actualizar<?php echo $id_detalle_devolucion; ?>').style.display = 'none';

                                                    document.getElementById('boton_eliminar<?php echo $id_detalle_devolucion; ?>').style.display = 'none';

                                                </script>
                                    <?php } else if ($rol_sesion == "PAGADURIA") { ?>
                                                    <script>
                                                        document.getElementById('boton_consultar<?php echo $id_detalle_devolucion; ?>').style.display = 'inline';

                                                        document.getElementById('boton_actualizar<?php echo $id_detalle_devolucion; ?>').style.display = 'inline';

                                                        document.getElementById('boton_eliminar<?php echo $id_detalle_devolucion; ?>').style.display = 'inline';

                                                    </script>
                                    <?php } else if ($rol_sesion == "JEFATURA") { ?>
                                                        <script>
                                                            document.getElementById('boton_consultar<?php echo $id_detalle_devolucion; ?>').style.display = 'inline';

                                                            document.getElementById('boton_actualizar<?php echo $id_detalle_devolucion; ?>').style.display = 'inline';

                                                            document.getElementById('boton_eliminar<?php echo $id_detalle_devolucion; ?>').style.display = 'inline';
                                                        </script>
                                    <?php } ?>

                                </td>
                            </tr>
                            <?php
                        }

                        ?>
                    </tbody>

                </table>
                <br>

                <div class="form-group col-md-2 float-left" id="">
                    <?php
                    $total = number_format($total, 2, '.', ','); //convertir int a decimal
                    ?>
                    <label for="">Monto Total (S/.)</label>
                    <input type="text" class="form-control" name="total" value="<?php echo $total; ?>" readonly>
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
            "responsive": false, "lengthChange": true, "autoWidth": false, "searching": true,

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>