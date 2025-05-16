<?php

include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/detalle_estado_egresos/listado_detalle_egreso.php');

if (
    isset($_SESSION['facultad']) && isset($_SESSION['actividad'])
    && isset($_SESSION['periodo'])
) {
    $facultad = $_SESSION['facultad'];
    $actividad = $_SESSION['actividad'];
    $periodo = $_SESSION['periodo'];
} else {
    $facultad = "";
    $actividad = "";
    $periodo = "";
}

$total = null;

switch ($facultad) {
    case "CENTRO PREUNIVERSITARIO DE LA UNIVERSIDAD NACIONAL FEDERICO VILLARREAL":
        $facultad = "CEPREVI";
        break;
    case "CENTRO DE GESTIÓN CULTURAL FEDERICO VILLARREAL":
        $facultad = "CGCFV";
        break;
    case "CENTRO UNIVERSITARIO DE IDIOMAS":
        $facultad = "CUDI";
        break;
    case "CENTRO DE PRODUCCIÓN DE BIENES Y SERVICIOS":
        $facultad = "CUPBS";
        break;
    case "CENTRO UNIVERSITARIO DE RESPONSABILIDAD SOCIAL":
        $facultad = "CURES";
        break;
    case "EDITORIAL UNIVERSITARIA":
        $facultad = "EU";
        break;
    case "ESCUELA UNIVERSITARIA DE EDUCACIÓN A DISTANCIA":
        $facultad = "EUDED";
        break;
    case "ESCUELA UNIVERSITARIA DE POSTGRADO":
        $facultad = "EUPG";
        break;
    case "FACULTAD DE ADMINISTRACIÓN":
        $facultad = "FA";
        break;
    case "FACULTAD DE PSICOLOGÍA":
        $facultad = "FAPS";
        break;
    case "FACULTAD DE ARQUITECTURA Y URBANISMO":
        $facultad = "FAU";
        break;
    case "FACULTAD DE CIENCIAS SOCIALES":
        $facultad = "FCCSS";
        break;
    case "FACULTAD DE CIENCIAS ECONÓMICAS":
        $facultad = "FCE";
        break;
    case "FACULTAD DE CIENCIAS FINANCIERAS Y CONTABLES":
        $facultad = "FCFC";
        break;
    case "FACULTAD DE CIENCIAS NATURALES Y MATEMÁTICA":
        $facultad = "FCNM";
        break;
    case "FACULTAD DE DERECHO Y CIENCIA POLÍTICA":
        $facultad = "FDCP";
        break;
    case "FACULTAD DE EDUCACIÓN":
        $facultad = "FE";
        break;
    case "FACULTAD DE HUMANIDADES":
        $facultad = "FH";
        break;
    case "FACULTAD DE INGENIERÍA CIVIL":
        $facultad = "FIC";
        break;
    case "FACULTAD DE INGENIERÍA ELECTRÓNICA E INFORMÁTICA":
        $facultad = "FIEI";
        break;
    case "FACULTAD DE INGENIERÍA GEOGRÁFICA, AMBIENTAL Y ECOTURISMO":
        $facultad = "FIGAE";
        break;
    case "FACULTAD DE INGENIERÍA INDUSTRIAL Y DE SISTEMAS":
        $facultad = "FIIS";
        break;
    case "FACULTAD DE MEDICINA DE HIPÓLITO UNANUE":
        $facultad = "FMHU";
        break;
    case "FACULTAD DE ODONTOLOGÍA":
        $facultad = "FO";
        break;
    case "FACULTAD DE OCEANOGRAFÍA, PESQUERÍA Y CC.AA.":
        $facultad = "FOPCA";
        break;
    case "FACULTAD DE TECNOLOGÍA MÉDICA":
        $facultad = "FTM";
        break;
    case "FACULTADES":
        $facultad = "FACULT.";
        break;
    case "INSTITUTO CENTRAL DE GESTIÓN DE LA INVESTIGACIÓN":
        $facultad = "ICGI";
        break;
    case "INSTITUTO DE RECREACIÓN, EDUCACIÓN FÍSICA Y DEPORTE":
        $facultad = "IRED";
        break;
    case "OFICINA CENTRAL DE ADMISIÓN":
        $facultad = "OCA";
        break;
    case "OFICINA CENTRAL DE BIENESTAR UNIVERSITARIO":
        $facultad = "OCBU";
        break;
    case "OFICINA CENTRAL DE REGISTROS ACADÉMICOS":
        $facultad = "OCRAC";
        break;
    case "OFICINA CENTRAL DE LOGÍSTICA Y SERVICIOS AUXILIARES":
        $facultad = "OCLSA";
        break;
    case "OFICINA DE TESORERÍA":
        $facultad = "OT";
        break;
    case "SECRETARÍA GENERAL":
        $facultad = "SG";
        break;
    case "VICERRECTORADO DE INVESTIGACIÓN":
        $facultad = "VRIN";
        break;

}

?>





<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1 class="m-0"><b>Consulta de NT: <?php echo $facultad; ?> </b>
                        <a href="<?php echo $URL; ?>/detalle_estado_egresos/create.php" type="button"
                            class="btn btn-md bg-primary" id="boton_agregar">
                            <i class="bi bi-plus-circle"></i> Agregar Nuevo Pago</a>

                    </h1>

                    <?php if ($rol_sesion == "SECRETARIA") { ?>
                        <script>
                            //ocultar las secciones
                            document.getElementById('boton_agregar').style.display = 'none';

                        </script>
                    <?php } else if ($rol_sesion == "JEFATURA") { ?>
                            <script>
                                //ocultar las secciones
                                document.getElementById('boton_agregar').style.display = 'none';

                            </script>

                    <?php } else if ($rol_sesion == "ADMINISTRADOR") { ?>
                                <script>
                                    //ocultar las secciones
                                    document.getElementById('boton_agregar').style.display = 'inline';

                                </script>

                    <?php } ?>

                </div><!-- /.col -->
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-card-checklist"></i> Detalle Egresos</li>
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
                                <center>Informe</center>
                            </th>
                            <th>
                                <center>Fecha Informe</center>
                            </th>
                            <th>
                                <center>Estado de Cta.</center>
                            </th>
                            <th>
                                <center>NT</center>
                            </th>
                            <th>
                                <center>Año NT</center>
                            </th>
                            <th>
                                <center>Tipo de actividad</center>
                            </th>

                            <th>
                                <center>Resolucion</center>
                            </th>
                            <th>
                                <center>Fecha Resolucion</center>
                            </th>
                            <th>
                                <center>SIAF</center>
                            </th>
                            <th>
                                <center>Monto</center>
                            </th>
                            <th>
                                <center>Egresos</center>
                            </th>
                            <th>
                                <center>Saldo</center>
                            </th>
                            <th>
                                <center>Saldo Inicial</center>
                            </th>
                            <th>
                                <center>Estado de Giro</center>
                            </th>
                            <th>
                                <center>Archivo</center>
                            </th>
                            <th>
                                <center>Acciones</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $contador = 0;
                        foreach ($detalle_egresos_datos as $detalle_egresos_dato) {
                            $id_detalle_egreso = $detalle_egresos_dato['id_detalle_egreso']; ?>
                            <tr>
                                <td>
                                    <center>
                                        <?php echo $contador = $contador + 1; ?>
                                    </center>
                                </td>
                                <td>
                                    <?php
                                    if ($detalle_egresos_dato['informe'] == 0) {
                                        $detalle_egresos_dato['informe'] = "";
                                    }

                                    echo $detalle_egresos_dato['informe']; ?>
                                </td>
                                <td>
                                    <?php


                                    if ($detalle_egresos_dato['fecha_informe'] == "0000-00-00") {
                                        $fechaInforme = "";
                                    } else {
                                        $theDate = new DateTime($detalle_egresos_dato['fecha_informe']);
                                        $fechaInforme = $theDate->format('d/m/Y');
                                    }

                                    echo $fechaInforme; ?>
                                </td>
                                <td>
                                    <?php
                                    if ($detalle_egresos_dato['numero_ec'] == 0) {
                                        $detalle_egresos_dato['numero_ec'] = "";
                                    }

                                    echo $detalle_egresos_dato['numero_ec']; ?>
                                </td>
                                <td>
                                    <?php echo $detalle_egresos_dato['nt_principal']; ?>
                                </td>
                                <td>
                                    <?php echo $detalle_egresos_dato['nt_anio']; ?>
                                </td>
                                <td>
                                    <?php echo $detalle_egresos_dato['actividad_principal']; ?>
                                </td>
                                <td>


                                    <?php
                                    if ($detalle_egresos_dato['resolucion'] == "SELECCIONAR") {
                                        $detalle_egresos_dato['resolucion'] = "";
                                    }

                                    echo $detalle_egresos_dato['resolucion']; ?>
                                </td>
                                <td>

                                    <?php
                                    if ($detalle_egresos_dato['fecha_resolucion'] == "SELECCIONAR") {
                                        $detalle_egresos_dato['fecha_resolucion'] = "";
                                    }

                                    echo $detalle_egresos_dato['fecha_resolucion']; ?>
                                </td>
                                <td>
                                    <?php echo $detalle_egresos_dato['siaf']; ?>
                                </td>
                                <td>
                                    <?php

                                    $total = $total + $detalle_egresos_dato['monto'];

                                    $monto_detalle = floatval($detalle_egresos_dato['monto']);
                                    $monto_detalle = number_format($monto_detalle, 2, '.', ',');

                                    echo $monto_detalle; ?>
                                </td>
                                <td>
                                    <?php
                                    $monto_egresos = floatval($detalle_egresos_dato['egresos']);
                                    $monto_egresos = number_format($monto_egresos, 2, '.', ','); //convertir int a decimal
                                
                                    echo $monto_egresos; ?>
                                </td>
                                <td>
                                    <?php
                                    $monto_ingresos = floatval($detalle_egresos_dato['ingresos']);
                                    $monto_ingresos = number_format($monto_ingresos, 2, '.', ','); //convertir int a decimal
                                

                                    echo $monto_ingresos; ?>
                                </td>
                                <td>
                                    <?php
                                    $saldo_inicial = floatval($detalle_egresos_dato['saldo_inicial']);
                                    $saldo_inicial = number_format($saldo_inicial, 2, '.', ','); //convertir int a decimal
                                

                                    echo $saldo_inicial; ?>
                                </td>

                                <td>
                                    <?php
                                    switch ($detalle_egresos_dato['estado_giro']) {
                                        case 'APROBADO': ?>
                                            <span class="badge bg-success">
                                                <?php echo $detalle_egresos_dato['estado_giro']; ?>
                                            </span>
                                            <?php
                                            break;
                                        case 'PENDIENTE': ?>
                                            <span class="badge bg-warning">
                                                <?php echo $detalle_egresos_dato['estado_giro']; ?>
                                            </span>
                                            <?php
                                            break;
                                        case 'ANULADO': ?>
                                            <span class="badge bg-danger">
                                                <?php echo $detalle_egresos_dato['estado_giro']; ?>
                                            </span>
                                            <?php
                                            break;
                                    }
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    if ($detalle_egresos_dato['checkbox_informe'] == "YES") {
                                        ?>
                                        <a href="informe.php?id=<?php echo $id_detalle_egreso; ?>" target="_blank" type="button"
                                            class="btn btn-sm" style="background-color: lightblue;"
                                            id="boton_informe<?php echo $id_detalle_egreso; ?>"><i
                                                class="bi bi-file-earmark-pdf"></i>
                                        </a>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                    if ($detalle_egresos_dato['checkbox_ec'] == "YES") {
                                        ?>
                                        <a href="estado_cuenta.php?id=<?php echo $id_detalle_egreso; ?>" target="_blank"
                                            type="button" class="btn btn-sm" style="background-color: gold;"
                                            id="boton_estado_cuenta<?php echo $id_detalle_egreso; ?>"><i
                                                class="bi bi-file-earmark-pdf"></i>
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </td>

                                <td>
                                    <center>
                                        <div class="btn-group">
                                            <a href="show.php?id=<?php echo $id_detalle_egreso; ?>" type="button"
                                                class="btn btn-sm btn-success"
                                                id="boton_consultar<?php echo $id_detalle_egreso; ?>"><i
                                                    class="bi bi-search"></i></a>



                                            <a href="update.php?id=<?php echo $id_detalle_egreso; ?>" type="button"
                                                class="btn btn-sm btn-primary"
                                                id="boton_actualizar<?php echo $id_detalle_egreso; ?>"><i
                                                    class="bi bi-pencil-square"></i>
                                            </a>

                                            <a href="delete.php?id=<?php echo $id_detalle_egreso; ?>" type="button"
                                                class="btn btn-sm btn-danger"
                                                id="boton_eliminar<?php echo $id_detalle_egreso; ?>"><i
                                                    class="bi bi-x-lg"></i>
                                            </a>



                                        </div>
                                    </center>


                                </td>
                            </tr>
                            <?php
                        }

                        ?>
                    </tbody>

                </table>

                <br>

                <?php

                function conexion()
                {

                    try {
                        $conn = new PDO('mysql:host=localhost;dbname=aplicativo_tesoreria_interno', 'root', '');
                    } catch (PDOException $e) {
                        echo "Error " . $e;
                    }

                    return $conn;
                }
                //-------------------------------------------------------------------------------------------------------
                
                $facultad_detalle= $_SESSION['facultad'];
                $actividad_detalle= $_SESSION['actividad'];

                $con = conexion();
                $total_egresos_acumulado = current($con->query("SELECT MAX(egresos) as maximo_egresos FROM tb_detalle_egresos WHERE facultad='$facultad_detalle' AND actividad_principal='$actividad_detalle' AND estado_giro='APROBADO' AND visible!=1")->fetch());


                ?>

                <div class="form-group col-md-2 float-left" id="">
                    <?php
                    $total_egresos_acumulado = number_format($total_egresos_acumulado, 2, '.', ','); //convertir int a decimal
                    ?>
                    <label for="">Monto Total (S/.)</label>
                    <input type="text" class="form-control" name="total" value="<?php echo $total_egresos_acumulado; ?>" readonly>
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
                "infoFiltered": "(Filtrado de _MAX_ total Egresos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Egresos",
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