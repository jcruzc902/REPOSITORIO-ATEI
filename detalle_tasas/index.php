<?php

include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/detalle_tasas/listado_detalle_tasas.php');


if (isset($_SESSION['codigo_pago'])) {
    $codigo_pago = $_SESSION['codigo_pago'];
} else {
    $codigo_pago = "";
}


?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1 class="m-0"><b>Consulta de Resoluciones: Codigo de Pago
                            <?php echo $codigo_pago; ?></b>
                        <a href="<?php echo $URL; ?>/detalle_tasas/create.php" type="button"
                            class="btn btn-md bg-primary" id="boton_agregar" style="display: none">
                            <i class="bi bi-plus-circle"></i> Agregar Nueva Resolucion</a>
                    </h1>


                </div><!-- /.col -->
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-card-checklist"></i> Resoluciones</li>
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
                                <center>Resolucion</center>
                            </th>
                            <th>
                                <center>Monto</center>
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

                        $contador = 0;
                        foreach ($resolucion_tyt_datos as $resolucion_tyt_dato) {
                            $id_detalle_tyt = $resolucion_tyt_dato['id_detalle_tyt']; ?>
                            <tr>
                                <td>
                                    <center>
                                        <?php echo $contador = $contador + 1; ?>
                                    </center>
                                </td>
                                <td>
                                    <?php echo $resolucion_tyt_dato['resolucion']; ?>
                                </td>

                                <td>

                                    <?php
                                    $resolucion_tyt_dato['monto']= floatval($resolucion_tyt_dato['monto']);
                                    $resolucion_tyt_dato['monto'] = number_format($resolucion_tyt_dato['monto'], 2, '.', ','); //convertir int a decimal
                                    echo $resolucion_tyt_dato['monto'];

                                    ?>
                                </td>


                                <td>
                                    <?php
                                    switch ($resolucion_tyt_dato['estado_resolucion']) {
                                        case 'APROBADO': ?>
                                            <span class="badge bg-success">
                                                <?php echo $resolucion_tyt_dato['estado_resolucion']; ?>
                                            </span>
                                            <?php
                                            break;
                                        case 'PENDIENTE': ?>
                                            <span class="badge bg-warning">
                                                <?php echo $resolucion_tyt_dato['estado_resolucion']; ?>
                                            </span>
                                            <?php
                                            break;
                                        case 'ANULADO': ?>
                                            <span class="badge bg-danger">
                                                <?php echo $resolucion_tyt_dato['estado_resolucion']; ?>
                                            </span>
                                            <?php
                                            break;
                                        case 'INACTIVO': ?>
                                            <span class="badge bg-dark">
                                                <?php echo $resolucion_tyt_dato['estado_resolucion']; ?>
                                            </span>
                                            <?php
                                            break;
                                    }
                                    ?>
                                </td>


                                <td>
                                    <center>
                                        <div class="btn-group">
                                            <a href="show.php?id=<?php echo $id_detalle_tyt; ?>" type="button"
                                                class="btn btn-sm btn-success"
                                                id="boton_consultar<?php echo $id_detalle_tyt; ?>"><i
                                                    class="bi bi-search"></i></a>

                                            <a href="../app/controllers/detalle_tasas/download.php?id=<?php echo $id_detalle_tyt; ?>"
                                                type="button" class="btn btn-sm" style="background-color: bisque;"
                                                id="boton_imprimir<?php echo $id_detalle_tyt; ?>">
                                                <i class="bi bi-printer"></i>
                                            </a>

                                            <a href="update.php?id=<?php echo $id_detalle_tyt; ?>" type="button"
                                                class="btn btn-sm btn-primary"
                                                id="boton_actualizar<?php echo $id_detalle_tyt; ?>"><i
                                                    class="bi bi-pencil-square"></i>
                                            </a>

                                            <a href="delete.php?id=<?php echo $id_detalle_tyt; ?>" type="button"
                                                class="btn btn-sm btn-danger"
                                                id="boton_eliminar<?php echo $id_detalle_tyt; ?>"><i class="bi bi-x-lg"></i>
                                            </a>



                                        </div>
                                    </center>

                                    

                                    <?php
                                    if ($rol_sesion == "ADMINISTRADOR") { ?>
                                        <script>

                                            document.getElementById('boton_actualizar<?php echo $id_detalle_tyt; ?>').style.display = 'inline';

                                            document.getElementById('boton_eliminar<?php echo $id_detalle_tyt; ?>').style.display = 'inline';

                                        </script>
                                    <?php } else if ($rol_sesion == "DIGA") { ?>
                                            <script>
                                                document.getElementById('boton_actualizar<?php echo $id_detalle_tyt; ?>').style.display = 'none';

                                                document.getElementById('boton_eliminar<?php echo $id_detalle_tyt; ?>').style.display = 'none';

                                            </script>
                                    <?php } else if ($rol_sesion == "INGRESOS") { ?>
                                            <script>
                                                document.getElementById('boton_actualizar<?php echo $id_detalle_tyt; ?>').style.display = 'none';

                                                document.getElementById('boton_eliminar<?php echo $id_detalle_tyt; ?>').style.display = 'none';

                                            </script>
                                    <?php }  ?>

                                    


                                </td>
                            </tr>
                            <?php
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
                "infoFiltered": "(Filtrado de _MAX_ total Resoluciones)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Resoluciones",
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