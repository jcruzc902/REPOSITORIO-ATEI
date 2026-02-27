<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');

include('../app/controllers/anio_nt/listado_de_anios.php');
include('../app/controllers/asuntos/listado_de_asuntos.php');
include('../app/controllers/tipo_gasto/listado_tipo_gasto.php');




if (empty($_POST['ntX'])) {
    $_POST['ntX'] = "";
}

if (empty($_POST['aniontX'])) {
    $_POST['aniontX'] = "";
}

if (empty($_POST['proveidoX'])) {
    $_POST['proveidoX'] = "";
}

if (empty($_POST['fechaproveidoX'])) {
    $_POST['fechaproveidoX'] = "";
}

if (empty($_POST['asuntoX'])) {
    $_POST['asuntoX'] = "";
}

if (empty($_POST['tipo_gastoX'])) {
    $_POST['tipo_gastoX'] = "";
}

if (empty($_POST['fecharegistro_desdeX'])) {
    $_POST['fecharegistro_desdeX'] = "";
}

if (empty($_POST['fecharegistro_hastaX'])) {
    $_POST['fecharegistro_hastaX'] = "";
}


$sql_cheques = "SELECT cheque.id_cheque as id_cheque,
    cheque.nt as nt,
    anio_nt.anio_nt as nt_anio,
    cheque.proveido_diga as proveido_diga,
    cheque.fecha_diga as fecha_diga,
    asunto.nombre_asunto as nombre_asunto,
    tipo_gasto.nombre_tipo_gasto as nombre_tipo_gasto,
    cheque.fyh_creacion as fyh_creacion_cheque
    FROM tb_cheque as cheque 
    INNER JOIN tb_anio_nt as anio_nt ON anio_nt.id_anio_nt = cheque.id_anio_nt 
    INNER JOIN tb_asunto as asunto ON asunto.id_asunto = cheque.id_asunto 
    INNER JOIN tb_tipo_gasto as tipo_gasto ON tipo_gasto.id_tipo_gasto = cheque.id_tipo_gasto
    WHERE cheque.visible!=1 ";

if (isset($_POST["consultar"])) {

    $consultar = 1;
    $nt = $_POST['ntX'];
    $anio_nt = $_POST['aniontX'];
    $proveido = $_POST['proveidoX'];
    $fecha_proveido = $_POST['fechaproveidoX'];
    $asunto = $_POST['asuntoX'];
    $tipo_gasto = $_POST['tipo_gastoX'];
    $desde = $_POST['fecharegistro_desdeX'];
    $hasta = $_POST['fecharegistro_hastaX'];

    $_SESSION['busqueda_boton_cheque'] = $consultar;
    $_SESSION['busqueda_nt_cheque'] = $nt;
    $_SESSION['busqueda_anio_nt_cheque'] = $anio_nt;
    $_SESSION['busqueda_proveido_cheque'] = $proveido;
    $_SESSION['busqueda_fecha_proveido_cheque'] = $fecha_proveido;
    $_SESSION['busqueda_asunto_cheque'] = $asunto;
    $_SESSION['busqueda_tipo_gasto_cheque'] = $tipo_gasto;
    $_SESSION['busqueda_desde_cheque'] = $desde;
    $_SESSION['busqueda_hasta_cheque'] = $hasta;


    if (
        !isset($nt) && !isset($anio_nt) && !isset($proveido) && !isset($fecha_proveido) && !isset($asunto) && !isset($tipo_gasto)
        && !isset($desde) && !isset($hasta)
    ) {
        $sql_cheques .= " ";
    } else {

        if (!empty($nt)) {
            $sql_cheques .= " AND cheque.nt like '%" . $nt . "%'";
        }

        if (!empty($anio_nt)) {
            $sql_cheques .= " AND cheque.id_anio_nt='" . $anio_nt . "'";
        }

        if (!empty($proveido)) {
            $sql_cheques .= " AND cheque.proveido_diga like '%" . $proveido . "%'";
        }

        if (!empty($fecha_proveido)) {
            $sql_cheques .= " AND cheque.fecha_diga='" . $fecha_proveido . "'";
        }

        if (!empty($asunto)) {
            $sql_cheques .= " AND cheque.id_asunto='" . $asunto . "'";
        }

        if (!empty($tipo_gasto)) {
            $sql_cheques .= " AND cheque.id_tipo_gasto='" . $tipo_gasto . "'";
        }

        if (!empty($desde) && !empty($hasta)) {
            $sql_cheques .= " AND cheque.fyh_creacion between '" . $desde." 00:00:00" . "' and '" . $hasta." 23:59:59" . "'";
        }
    }


    $query_cheques = $pdo->prepare($sql_cheques);
    $query_cheques->execute();
    $cheques_datos = $query_cheques->fetchAll(PDO::FETCH_ASSOC);


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
                    <h1 class="m-0"><b>Consulta de Cheques</b>
                        <a href="<?php echo $URL; ?>/cheques/create.php" type="button" class="btn btn-md bg-primary"
                            id="boton_agregar">
                            <i class="bi bi-plus-circle"></i> Agregar Nuevo Cheque</a>
                        <a href="<?php echo $URL; ?>/app/controllers/cheque/exportar_xlsx.php" type="button"
                            class="btn btn-md bg-success" id="boton_exportarExcel" hidden>
                            <i class="bi bi-file-earmark-excel"></i> Exportar a Excel</a>
                        <a href="<?php echo $URL; ?>/app/controllers/cheque/exportar_pdf.php" type="button"
                            class="btn btn-md bg-danger" target="_blank" id="boton_exportarPDF" hidden>
                            <i class="bi bi-file-earmark-pdf"></i> Exportar a PDF</a>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-wallet"></i> Cheques</li>
                    </ol>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <?php
    if ($rol_sesion == "ADMINISTRADOR") { ?>
        <script>
            document.getElementById('boton_agregar').style.display = 'inline';
            document.getElementById('boton_exportarExcel').style.display = 'inline';
            document.getElementById('boton_exportarPDF').style.display = 'inline';
        </script>
    <?php } else if ($rol_sesion == "INGRESOS") { ?>
            <script>
                document.getElementById('boton_agregar').style.display = 'none';
                document.getElementById('boton_exportarExcel').style.display = 'none';
                document.getElementById('boton_exportarPDF').style.display = 'none';
            </script>
    <?php } else if ($rol_sesion == "SECRETARIA") { ?>
                <script>
                    document.getElementById('boton_agregar').style.display = 'none';
                    document.getElementById('boton_exportarExcel').style.display = 'none';
                    document.getElementById('boton_exportarPDF').style.display = 'none';
                </script>
    <?php } else if ($rol_sesion == "JEFATURA") { ?>
                    <script>
                        document.getElementById('boton_agregar').style.display = 'inline';
                        document.getElementById('boton_exportarExcel').style.display = 'inline';
                        document.getElementById('boton_exportarPDF').style.display = 'inline';
                    </script>
    <?php } ?>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">



            <div class="row">
                <div class="col-md-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">LISTADO DE CHEQUES REGISTRADO</h3>
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
                                        <select class="form-control " name="aniontX" style="width:100%" id="anio_nt"
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
                                        <label for="">Proveido (DIGA)</label>
                                        <input type="text" class="form-control " name="proveidoX" id="proveido" class="form-control"
                                            value="<?php echo $_POST['proveidoX']; ?>"
                                            onkeypress='return validaNumericos(event)'>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Fecha</label>
                                        <input type="date" class="form-control " name="fechaproveidoX"
                                            class="form-control" value="<?php echo $_POST['fechaproveidoX']; ?>">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Asunto</label>
                                        <select class="form-control " name="asuntoX" style="width:100%" id="asunto"
                                            class="form-control">
                                            <option value="">TODOS</option>
                                            <?php
                                            foreach ($asuntos_datos as $asuntos_dato) {
                                                $nombre_asunto_tabla = $asuntos_dato['nombre_asunto'];
                                                $id_asunto = $asuntos_dato['id_asunto']; ?>
                                                <option value="<?php echo $id_asunto; ?>" <?php if ($id_asunto == $_POST["asuntoX"]) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $nombre_asunto_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Tipo de Gasto</label>
                                        <select class="form-control " name="tipo_gastoX" style="width:100%"
                                            id="tipo_gasto" class="form-control">
                                            <option value="">TODOS</option>
                                            <?php
                                            foreach ($tipo_gasto_datos as $tipo_gasto_dato) {
                                                $nombre_tipo_gasto_tabla = $tipo_gasto_dato['nombre_tipo_gasto'];
                                                $id_tipo_gasto = $tipo_gasto_dato['id_tipo_gasto']; ?>
                                                <option value="<?php echo $id_tipo_gasto; ?>" <?php if ($id_tipo_gasto == $_POST["tipo_gastoX"]) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $nombre_tipo_gasto_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
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

                                    document.getElementById('proveido').addEventListener('keydown', function (e) {

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
                                        $('#asunto').select2({
                                            theme: 'bootstrap4',
                                        });
                                        $('#tipo_gasto').select2({
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
                                <center>Proveido</center>
                            </th>

                            <th>
                                <center>Fecha</center>
                            </th>

                            <th>
                                <center>Asunto</center>
                            </th>

                            <th>
                                <center>Tipo de Gasto</center>
                            </th>

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
                        if (!isset($cheques_datos)) {
                            $cheques_datos = "";
                        } else {



                            $contador = 0;
                            foreach ($cheques_datos as $cheques_dato) {
                                $id_cheque = $cheques_dato['id_cheque']; ?>
                                <tr>
                                    <td>
                                        <center>
                                            <?php echo $contador = $contador + 1; ?>
                                        </center>
                                    </td>

                                    <td>
                                        <?php echo $cheques_dato['nt']; ?>
                                    </td>

                                    <td>
                                        <?php echo $cheques_dato["nt_anio"]; ?>
                                    </td>

                                    <td>
                                        <?php echo $cheques_dato['proveido_diga']; ?>
                                    </td>

                                    <td>
                                        <?php

                                        if($cheques_dato['fecha_diga']!='0000-00-00'){
                                            $theDate = new DateTime($cheques_dato['fecha_diga']);
                                            $cheques_dato['fecha_diga'] = $theDate->format('d/m/Y');
                                        }else{  
                                            $cheques_dato['fecha_diga']= "";
                                        }

                                        


                                        echo $cheques_dato['fecha_diga']; ?>
                                    </td>

                                    <td>
                                        <?php echo $cheques_dato['nombre_asunto']; ?>
                                    </td>

                                    <td>
                                        <?php echo $cheques_dato['nombre_tipo_gasto']; ?>
                                    </td>



                                    <td>
                                        <?php $theDate = new DateTime($cheques_dato['fyh_creacion_cheque']);
                                        echo $cheques_dato['fyh_creacion_cheque'] = $theDate->format('d/m/Y h:i:s a'); ?>
                                    </td>




                                    <td>
                                        <center>
                                            <div class="btn-group">
                                                <a href="show.php?id=<?php echo $id_cheque; ?>" type="button"
                                                    class="btn btn-sm btn-success"
                                                    id="boton_consultar<?php echo $id_cheque; ?>"><i
                                                        class="bi bi-search"></i></a>
                                                <a href="estado_cheque.php?id=<?php echo $id_cheque; ?>" target="_blank"
                                                    type="button" class="btn btn-sm" style="background-color: bisque;"
                                                    id="boton_imprimir<?php echo $id_cheque; ?>"><i class="bi bi-printer"></i>
                                                </a>
                                                <a href="update.php?id=<?php echo $id_cheque; ?>" type="button"
                                                    class="btn btn-sm btn-primary"
                                                    id="boton_actualizar<?php echo $id_cheque; ?>"><i
                                                        class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="delete.php?id=<?php echo $id_cheque; ?>" type="button"
                                                    class="btn btn-sm btn-danger"
                                                    id="boton_eliminar<?php echo $id_cheque; ?>"><i class="bi bi-x-lg"></i></a>

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
            "responsive": false, "lengthChange": true, "autoWidth": false, "searching": false,

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>