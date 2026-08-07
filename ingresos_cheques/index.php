<?php

include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
#include ('../app/controllers/ingresos/listado_detalle_devolucion.php');
include('../app/controllers/anio_nt/listado_de_anios.php');
include('../app/controllers/cuenta/listado_de_nrocuentas.php');
include('../app/controllers/estado_cheque/listado_de_estado_cheque.php');

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


if (empty($_POST['siafX'])) {
    $_POST['siafX'] = "";
}

if (empty($_POST['tipo_chequeX'])) {
    $_POST['tipo_chequeX'] = "";
}

if (empty($_POST['nro_chequeX'])) {
    $_POST['nro_chequeX'] = "";
}

if (empty($_POST['fecha_emisionX'])) {
    $_POST['fecha_emisionX'] = "";
}

if (empty($_POST['fecha_emisionY'])) {
    $_POST['fecha_emisionY'] = "";
}

if (empty($_POST['estado_chequeX'])) {
    $_POST['estado_chequeX'] = "";
}



$sql_detalle_cheque = "SELECT *, 
anio_nt.anio_nt as anio_numerotramite,
nrocuenta.nro_cuenta as nro_cuenta,
estado_cheque.nombre_estado_cheque as estado_cheque,
usuario.nombres as nombre_usuario,
usuario.apaterno as apaterno_usuario,
usuario.amaterno as amaterno_usuario,
t_detalle.fyh_creacion as fyh_creacion 
FROM tb_detalle_cheque as t_detalle 
INNER JOIN tb_nrocuenta as nrocuenta ON nrocuenta.id_nrocuenta = t_detalle.id_nrocuenta
INNER JOIN tb_usuarios as usuario ON usuario.id_usuario= t_detalle.id_usuario 
INNER JOIN tb_anio_nt as anio_nt ON anio_nt.id_anio_nt= t_detalle.id_anio_nt 
INNER JOIN tb_estado_cheque as estado_cheque ON estado_cheque.id_estado_cheque= t_detalle.id_estado_cheque
WHERE t_detalle.visible!=1 ";

if (isset($_POST["consultar"])) {

    $consultar= 1;
    $nt = $_POST['ntX'];
    $anio_nt = $_POST['aniontX'];
    $tipo_cheque = $_POST['tipo_chequeX'];
    $nro_cheque = $_POST['nro_chequeX'];
    $fecha_emision = $_POST['fecha_emisionX'];
    $fecha_emision2 = $_POST['fecha_emisionY'];
    $estado_cheque = $_POST['estado_chequeX'];
    $desde = $_POST['fecharegistro_desdeX'];
    $hasta = $_POST['fecharegistro_hastaX'];

    $_SESSION['busqueda_boton_detalle_cheque'] = $consultar;
    $_SESSION['busqueda_detalle_c_nt'] = $nt;
    $_SESSION['busqueda_detalle_c_anio_nt'] = $anio_nt;
    $_SESSION['busqueda_detalle_c_tipo_cheque'] = $tipo_cheque;
    $_SESSION['busqueda_detalle_c_nro_cheque'] = $nro_cheque;
    $_SESSION['busqueda_detalle_c_fecha_emision'] = $fecha_emision;
    $_SESSION['busqueda_detalle_c_fecha_emision2'] = $fecha_emision2;
    $_SESSION['busqueda_detalle_c_estado_cheque'] = $estado_cheque;
    $_SESSION['busqueda_c_desde'] = $desde;
    $_SESSION['busqueda_c_hasta'] = $hasta;


    if (
        !isset($nt) && !isset($anio_nt) && !isset($tipo_cheque) && !isset($nro_cheque) && !isset($fecha_emision) && !isset($fecha_emision2) 
        && !isset($estado_cheque) && !isset($desde) && !isset($hasta)
    ) {
        $sql_detalle_cheque .= "";
    } else {

        if (!empty($nt)) {
            $sql_detalle_cheque .= " AND t_detalle.nt like '%" . $nt . "%'";
        }

        if (!empty($anio_nt)) {
            $sql_detalle_cheque .= " AND t_detalle.id_anio_nt='" . $anio_nt . "'";
        }

        if (!empty($tipo_cheque)) {
            $sql_detalle_cheque .= " AND t_detalle.id_nrocuenta='" . $tipo_cheque . "'";
        }

        if (!empty($nro_cheque)) {
            $sql_detalle_cheque .= " AND t_detalle.nro_cheque like '%" . $nro_cheque . "%'";
        }

        /*
        if (!empty($fecha_emision)) {
            $sql_detalle_cheque .= " AND t_detalle.fecha_emision_cheque='" . $fecha_emision . "'";
        }*/

        if (!empty($fecha_emision) && !empty($fecha_emision2)) {
            $sql_detalle_cheque .= " AND t_detalle.fecha_emision_cheque between '" . $fecha_emision." 00:00:00" . "' and '" . $fecha_emision2." 23:59:59" . "'";
        }


        if (!empty($estado_cheque)) {
            $sql_detalle_cheque .= " AND t_detalle.id_estado_cheque like '%" . $estado_cheque . "%'";
        }


        if (!empty($desde) && !empty($hasta)) {
            $sql_detalle_cheque .= " AND t_detalle.fyh_creacion between '" . $desde." 00:00:00" . "' and '" . $hasta." 23:59:59" . "'";
        }

        $sql_detalle_cheque .= " ORDER BY t_detalle.fecha_emision_cheque, t_detalle.nt ASC"; //ordena el nombre del banco en forma ascendente
    }


    $query_detalle_cheque = $pdo->prepare($sql_detalle_cheque);
    $query_detalle_cheque->execute();
    $detalle_cheque_datos = $query_detalle_cheque->fetchAll(PDO::FETCH_ASSOC);


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
                    <h1 class="m-0"><b>Consulta de Pagos de Cheques</b>
                        <a href="<?php echo $URL; ?>/app/controllers/ingresos_cheques/exportar_xlsx.php" type="button"
                            class="btn btn-md bg-success" id="boton_exportarExcel">
                            <i class="bi bi-file-earmark-excel"></i> Exportar a Excel</a>
                        <a href="<?php echo $URL; ?>/app/controllers/ingresos_cheques/exportar_pdf.php" type="button"
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
                            <h3 class="card-title">DETALLE DE REGISTROS DE CHEQUES</h3>
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
                                        <input type="text" class="form-control " name="ntX" class="form-control"
                                            value="<?php echo $_POST['ntX']; ?>" id="nt"
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
                                        <label for="">Tipo de Cheque</label>
                                        <select class="form-control " name="tipo_chequeX" style="width:100%"
                                            id="tipo_cheque" class="form-control">
                                            <option value="">TODOS</option>
                                            <?php
                                            foreach ($nrocuentas_datos as $nrocuentas_dato) {
                                                $nro_cuenta_tabla = $nrocuentas_dato['nro_cuenta'];
                                                $id_nrocuenta = $nrocuentas_dato['id_nrocuenta']; ?>
                                                <option value="<?php echo $id_nrocuenta; ?>" <?php if ($id_nrocuenta == $_POST["tipo_chequeX"]) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $nro_cuenta_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Numero de Cheque</label>
                                        <input type="text" class="form-control " name="nro_chequeX" class="form-control"
                                            value="<?php echo $_POST['nro_chequeX']; ?>" id="numero_cheque"
                                            onkeypress='return validaNumericos(event)'>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Fecha de Emision Desde</label>
                                        <input type="date" class="form-control " name="fecha_emisionX"
                                            class="form-control" value="<?php echo $_POST['fecha_emisionX']; ?>">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Fecha de Emision Hasta</label>
                                        <input type="date" class="form-control " name="fecha_emisionY"
                                            class="form-control" value="<?php echo $_POST['fecha_emisionY']; ?>">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Estado</label>
                                        <select class="form-control " name="estado_chequeX" style="width:100%"
                                            id="estado_cheque" class="form-control">
                                            <option value="">TODOS</option>
                                            <?php
                                            foreach ($estado_cheque_datos as $estado_cheque_dato) {
                                                $nombre_estado_cheque_tabla = $estado_cheque_dato['nombre_estado_cheque'];
                                                $id_estado_cheque = $estado_cheque_dato['id_estado_cheque']; ?>
                                                <option value="<?php echo $id_estado_cheque; ?>" <?php if ($id_estado_cheque == $_POST["estado_chequeX"]) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_estado_cheque_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Registro Desde</label>
                                        <input type="date" class="form-control " name="fecharegistro_desdeX"
                                            class="form-control" value="<?php echo $_POST["fecharegistro_desdeX"] ?>">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Registro Hasta</label>
                                        <input type="date" class="form-control " name="fecharegistro_hastaX"
                                            class="form-control" value="<?php echo $_POST["fecharegistro_hastaX"] ?>">
                                    </div>

                                    <div class="form-group col-md-2" style="line-height: 100px;">

                                        <button type="submit" name="consultar" id="consultar" class="btn"
                                            style="background-color: black; color: white;"><i class="bi bi-search"></i>
                                            Iniciar consulta</button>
                                    </div>



                                </div>

                                <!--automatizar con boton Enter-->
                                <script>


                                    document.getElementById('nt').addEventListener('keydown', function (e) {

                                        //si presiona el teclado Enter
                                        if (e.keyCode === 13) {
                                            // entonces haces lo que quieras para poder reaccionar a la pulsación del enter.

                                            // se establecera como clic en el boton Iniciar Consulta
                                            $("#consultar").click();
                                        }
                                    });

                                    document.getElementById('numero_cheque').addEventListener('keydown', function (e) {

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

                                        $('#tipo_cheque').select2({
                                            theme: 'bootstrap4',
                                        });
                                        $('#estado_cheque').select2({
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
                                <center>Tipo de Cheque</center>
                            </th>
                            <th>
                                <center>Numero de Cheque</center>
                            </th>
                            <th>
                                <center>Fecha de Emision</center>
                            </th>
                            <th>
                                <center>Monto</center>
                            </th>
                            <th>
                                <center>Estado</center>
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
                        if (!isset($detalle_cheque_datos)) {
                            $detalle_cheque_datos = "";
                        } else {

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
                                        <?php echo $detalle_cheque_dato['anio_numerotramite']; ?>
                                    </td>
                                    <td>
                                        <?php echo $detalle_cheque_dato['nro_cuenta']; ?>
                                    </td>
                                    <td>
                                        <?php echo $detalle_cheque_dato['nro_cheque']; ?>
                                    </td>
                                    <td>
                                        <?php $theDate = new DateTime($detalle_cheque_dato['fecha_emision_cheque']);
                                        echo $stringDate = $theDate->format('d/m/Y'); ?>
                                    </td>
                                    <td>
                                        <?php
                                        $detalle_cheque_dato['monto'] = number_format($detalle_cheque_dato['monto'], 2, '.', ','); //convertir int a decimal
                                        echo $detalle_cheque_dato['monto'];
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
                                        <?php $theDate = new DateTime($detalle_cheque_dato['fyh_creacion']);
                                        echo $detalle_cheque_dato['fyh_creacion'] = $theDate->format('d/m/Y h:i:s a'); ?>
                                    </td>


                                    <td>
                                        <center>
                                            <div class="btn-group">
                                                <a href="show.php?id=<?php echo $id_detalle_cheque; ?>" type="button"
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
                "infoFiltered": "(Filtrado de _MAX_ total Pagos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Pagos",
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