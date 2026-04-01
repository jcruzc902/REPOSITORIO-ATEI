<?php

include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/detalle_cheque/listado_detalle_cheque.php');


if ((isset($_SESSION['numero_tramite_cheque'])) && isset($_SESSION['anio_nt_cheque'])) {
    $numero_tramite = $_SESSION['numero_tramite_cheque'];
    $anio_nt = $_SESSION['anio_nt_cheque'];
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
                    <h1 class="m-0"><b>Consulta de Pagos: NT
                            <?php echo $numero_tramite . " - " . $anio_nt; ?></b>
                        <a href="<?php echo $URL; ?>/detalle_cheque/create.php" type="button"
                            class="btn btn-md bg-primary" id="boton_agregar">
                            <i class="bi bi-plus-circle"></i> Agregar Nuevo Pago</a>
                    </h1>

                    
                    <?php if ($rol_sesion == "JEFATURA") { ?>
                            <script>
                                //ocultar las secciones
                                document.getElementById('boton_agregar').style.display = 'inline';

                            </script>

                    <?php } else if ($rol_sesion == "ADMINISTRADOR") { ?>
                                <script>
                                    //ocultar las secciones
                                    document.getElementById('boton_agregar').style.display = 'inline';

                                </script>

                    <?php } else if ($rol_sesion == "EGRESOS") { ?>
                                <script>
                                    //ocultar las secciones
                                    document.getElementById('boton_agregar').style.display = 'none';

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
                                <center>NT.</center>
                            </th>
                            <th>
                                <center>Año</center>
                            </th>
                            <th>
                                <center>Tipo de Cheque</center>
                            </th>
                            <th>
                                <center>SIAF</center>
                            </th>
                            <th>
                                <center>N° Comp.Int.</center>
                            </th>
                            <th>
                                <center>Fecha Comp.Int.</center>
                            </th>
                            <th>
                                <center>N° Comp.Ext.</center>
                            </th>
                            <th>
                                <center>Fecha Comp.Ext.</center>
                            </th>
                            <th>
                                <center>N° Cheque</center>
                            </th>
                            <th>
                                <center>Fecha Emision de Cheque</center>
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
                        foreach ($detalle_cheque_datos as $detalle_cheque_dato) {
                            $id_detalle_cheque = $detalle_cheque_dato['id_detalle_cheque']; ?>
                            <tr>
                                <td>
                                    <center>
                                        <?php echo $contador = $contador + 1; ?>
                                    </center>
                                </td>
                                <td>
                                    <?php echo $detalle_cheque_dato['nt']; ?>
                                </td>
                                <td>
                                    <?php echo $detalle_cheque_dato['anio_nt']; ?>
                                </td>
                                <td>
                                    <?php echo $detalle_cheque_dato['nro_cuenta']; ?>
                                </td>
                                <td>
                                    <?php echo $detalle_cheque_dato['siaf']; ?>
                                </td>
                                <td>
                                    <?php echo $detalle_cheque_dato['nro_ci']; ?>
                                </td>
                                <td>
                                    <?php
                                    
                                    if ($detalle_cheque_dato['fecha_ci'] != "0000-00-00") {
                                        $theDate = new DateTime($detalle_cheque_dato['fecha_ci']);
                                        $detalle_cheque_dato['fecha_ci'] = $theDate->format('d/m/Y');
                                    } else {
                                        $detalle_cheque_dato['fecha_ci']= "";
                                    }

                                    echo $detalle_cheque_dato['fecha_ci']; 
                                    
                                    ?>
                                </td>
                                <td>
                                    <?php echo $detalle_cheque_dato['nro_ce']; ?>
                                </td>
                                <td>
                                    <?php 
                                    
                                    
                                    if ($detalle_cheque_dato['fecha_ce'] != "0000-00-00") {
                                        $theDate = new DateTime($detalle_cheque_dato['fecha_ce']);
                                        $detalle_cheque_dato['fecha_ce'] = $theDate->format('d/m/Y');
                                    } else {
                                        $detalle_cheque_dato['fecha_ce']= "";
                                    }

                                    echo $detalle_cheque_dato['fecha_ce']; 
                                    
                                    ?>
                                </td>
                                <td>
                                    <?php echo $detalle_cheque_dato['nro_cheque']; ?>
                                </td>
                                <td>
                                    <?php 
                                    
                                    
                                    if ($detalle_cheque_dato['fecha_emision'] != "0000-00-00") {
                                        $theDate = new DateTime($detalle_cheque_dato['fecha_emision']);
                                        $detalle_cheque_dato['fecha_emision'] = $theDate->format('d/m/Y');
                                    } else {
                                        $detalle_cheque_dato['fecha_emision']= "";
                                    }

                                    echo $detalle_cheque_dato['fecha_emision']; 

                                    ?>
                                </td>
                                <td>

                                    <?php

                                    $total = $total + $detalle_cheque_dato['monto'];

                                    $monto = number_format($detalle_cheque_dato['monto'], 2, '.', ','); //convertir int a decimal
                                    echo $monto;


                                    ?>
                                </td>


                                <td>
                                    <?php
                                    switch ($detalle_cheque_dato['estado_cheque']) {
                                        case 'COBRADO': ?>
                                            <span class="badge bg-success">
                                                <?php echo $detalle_cheque_dato['estado_cheque']; ?>
                                            </span>
                                            <?php
                                            break;
                                        case 'PENDIENTE': ?>
                                            <span class="badge bg-warning">
                                                <?php echo $detalle_cheque_dato['estado_cheque']; ?>
                                            </span>
                                            <?php
                                            break;
                                        case 'ANULADO': ?>
                                            <span class="badge bg-danger">
                                                <?php echo $detalle_cheque_dato['estado_cheque']; ?>
                                            </span>
                                            <?php
                                            break;
                                    }
                                    ?>
                                </td>


                                <td>
                                    <center>
                                        <div class="btn-group">
                                            <a href="show.php?id=<?php echo $id_detalle_cheque; ?>" type="button"
                                                class="btn btn-sm btn-success"
                                                id="boton_consultar<?php echo $id_detalle_cheque; ?>"><i
                                                    class="bi bi-search"></i></a>

                                            <a href="update.php?id=<?php echo $id_detalle_cheque; ?>" type="button"
                                                class="btn btn-sm btn-primary"
                                                id="boton_actualizar<?php echo $id_detalle_cheque; ?>"><i
                                                    class="bi bi-pencil-square"></i>
                                            </a>

                                            <a href="delete.php?id=<?php echo $id_detalle_cheque; ?>" type="button"
                                                class="btn btn-sm btn-danger"
                                                id="boton_eliminar<?php echo $id_detalle_cheque; ?>"><i
                                                    class="bi bi-x-lg"></i>
                                            </a>



                                        </div>
                                    </center>

                                    <?php
                                    if ($rol_sesion == "ADMINISTRADOR") { ?>
                                        <script>
                                            document.getElementById('boton_consultar<?php echo $id_detalle_cheque; ?>').style.display = 'inline';

                                            document.getElementById('boton_actualizar<?php echo $id_detalle_cheque; ?>').style.display = 'inline';

                                            document.getElementById('boton_eliminar<?php echo $id_detalle_cheque; ?>').style.display = 'inline';

                                        </script>
                                    <?php } else if ($rol_sesion == "EGRESOS") { ?>
                                                    <script>
                                                        document.getElementById('boton_consultar<?php echo $id_detalle_cheque; ?>').style.display = 'inline';

                                                        document.getElementById('boton_actualizar<?php echo $id_detalle_cheque; ?>').style.display = 'none';

                                                        document.getElementById('boton_eliminar<?php echo $id_detalle_cheque; ?>').style.display = 'none';

                                                    </script>
                                    <?php } else if ($rol_sesion == "JEFATURA") { ?>
                                                        <script>
                                                            document.getElementById('boton_consultar<?php echo $id_detalle_cheque; ?>').style.display = 'inline';

                                                            document.getElementById('boton_actualizar<?php echo $id_detalle_cheque; ?>').style.display = 'inline';

                                                            document.getElementById('boton_eliminar<?php echo $id_detalle_cheque; ?>').style.display = 'inline';
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
                "infoFiltered": "(Filtrado de _MAX_ total Cheques)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Cheques",
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