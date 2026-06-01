<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');

include('../app/controllers/anio_periodo/listado_de_periodo.php');
include('../app/controllers/anio_nt/listado_de_anios.php');
include('../app/controllers/dependencias/listado_de_dependencias.php');
include('../app/controllers/estado_devolucion/listado_de_devolucion.php');


if (empty($_POST['periodoX'])) {
    $_POST['periodoX'] = "";
}

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

if (empty($_POST['oficioX'])) {
    $_POST['oficioX'] = "";
}

if (empty($_POST['fechaoficioX'])) {
    $_POST['fechaoficioX'] = "";
}

if (empty($_POST['informeX'])) {
    $_POST['informeX'] = "";
}

if (empty($_POST['fechainformeX'])) {
    $_POST['fechainformeX'] = "";
}

if (empty($_POST['dependenciaX'])) {
    $_POST['dependenciaX'] = "";
}

if (empty($_POST['estadoX'])) {
    $_POST['estadoX'] = "";
}



if (empty($_POST['fecharegistro_desdeX'])) {
    $_POST['fecharegistro_desdeX'] = "";
}

if (empty($_POST['fecharegistro_hastaX'])) {
    $_POST['fecharegistro_hastaX'] = "";
}


$sql_devoluciones = "SELECT *, 
    anio_periodo.anio_periodo as periodo_anio, 
    anio_nt.anio_nt as nt_anio,
    dep.nombre as dependencia,
    estado_devolucion.nombre_estado_devolucion as nombre_estado_devolucion,
    dev.fyh_creacion as fecha_registro,
    us.nombres as nombres,
    us.apaterno as apellidopaterno,
    us.amaterno as apellidomaterno,
    dev.fyh_creacion as fyh_creacion_dev,
    dev.fyh_actualizacion as fyh_actualizacion_dev
    FROM tb_devoluciones as dev 
    INNER JOIN tb_dependencias as dep ON dep.id_dependencia = dev.id_dependencia 
    INNER JOIN tb_usuarios as us ON us.id_usuario = dev.id_usuario 
    INNER JOIN tb_anio_nt as anio_nt ON anio_nt.id_anio_nt = dev.id_anio_nt 
    INNER JOIN tb_anio_periodo as anio_periodo ON anio_periodo.id_anio_periodo = dev.id_anio_periodo 
    LEFT JOIN tb_estado_devolucion as estado_devolucion ON estado_devolucion.id_estado_devolucion = dev.id_estado_devolucion 
    WHERE dev.visible!=1 ";

if (isset($_POST["consultar"])) {

    $consultar = 1;
    $periodo = $_POST['periodoX'];
    $nt = $_POST['ntX'];
    $anio_nt = $_POST['aniontX'];
    $proveido = $_POST['proveidoX'];
    $fecha_proveido = $_POST['fechaproveidoX'];
    $oficio = $_POST['oficioX'];
    $fecha_oficio = $_POST['fechaoficioX'];
    $informe = $_POST['informeX'];
    $fecha_informe = $_POST['fechainformeX'];
    $dependencia = $_POST['dependenciaX'];
    $estado = $_POST['estadoX'];
    $desde = $_POST['fecharegistro_desdeX'];
    $hasta = $_POST['fecharegistro_hastaX'];

    $_SESSION['busqueda_boton_devolucion'] = $consultar;
    $_SESSION['busqueda_periodo'] = $periodo;
    $_SESSION['busqueda_nt'] = $nt;
    $_SESSION['busqueda_anio_nt'] = $anio_nt;
    $_SESSION['busqueda_proveido'] = $proveido;
    $_SESSION['busqueda_fecha_proveido'] = $fecha_proveido;
    $_SESSION['busqueda_oficio'] = $oficio;
    $_SESSION['busqueda_fecha_oficio'] = $fecha_oficio;
    $_SESSION['busqueda_informe'] = $informe;
    $_SESSION['busqueda_fecha_informe'] = $fecha_informe;
    $_SESSION['busqueda_dependencia'] = $dependencia;
    $_SESSION['busqueda_desde'] = $desde;
    $_SESSION['busqueda_hasta'] = $hasta;


    if (
        !isset($periodo) && !isset($nt) && !isset($anio_nt) && !isset($proveido) && !isset($fecha_proveido) && !isset($oficio) && !isset($fecha_oficio)
        && !isset($informe) && !isset($fecha_informe) && !isset($dependencia) && !isset($estado) && !isset($desde) && !isset($hasta)
    ) {
        $sql_devoluciones .= " ";
    } else {
        if (!empty($periodo)) {
            $sql_devoluciones .= " AND dev.id_anio_periodo='" . $periodo . "'";
        }

        if (!empty($nt)) {
            $sql_devoluciones .= " AND dev.nt like '%" . $nt . "%'";
        }

        if (!empty($anio_nt)) {
            $sql_devoluciones .= " AND dev.id_anio_nt='" . $anio_nt . "'";
        }

        if (!empty($proveido)) {
            $sql_devoluciones .= " AND dev.proveido like '%" . $proveido . "%'";
        }

        if (!empty($fecha_proveido)) {
            $sql_devoluciones .= " AND dev.fecha_proveido='" . $fecha_proveido . "'";
        }

        if (!empty($oficio)) {
            $sql_devoluciones .= " AND dev.oficio like '%" . $oficio . "%'";
        }

        if (!empty($fecha_oficio)) {
            $sql_devoluciones .= " AND dev.fecha_oficio='" . $fecha_oficio . "'";
        }

        if (!empty($informe)) {
            $sql_devoluciones .= " AND dev.informe like '%" . $informe . "%'";
        }

        if (!empty($fecha_informe)) {
            $sql_devoluciones .= " AND dev.fecha_informe='" . $fecha_informe . "'";
        }

        if (!empty($dependencia)) {
            $sql_devoluciones .= " AND dev.id_dependencia='" . $dependencia . "'";
        }

        if (!empty($estado)) {
            $sql_devoluciones .= " AND dev.id_estado_devolucion='" . $estado . "'";
        }


        if (!empty($desde) && !empty($hasta)) {
            $sql_devoluciones .= " AND dev.fyh_creacion between '" . $desde." 00:00:00" . "' and '" . $hasta." 23:59:59" . "'";
        }
    }


    $query_devoluciones = $pdo->prepare($sql_devoluciones);
    $query_devoluciones->execute();
    $devolucion_datos = $query_devoluciones->fetchAll(PDO::FETCH_ASSOC);


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
                    <h1 class="m-0"><b>Consulta de Devoluciones de Dinero</b>
                        <a href="<?php echo $URL; ?>/devoluciones/create.php" type="button"
                            class="btn btn-md bg-primary" id="boton_agregar">
                            <i class="bi bi-plus-circle"></i> Agregar Nuevo Devolucion</a>
                        <a href="<?php echo $URL; ?>/app/controllers/devolucion/exportar_xlsx.php" type="button"
                            class="btn btn-md bg-success" id="boton_exportarExcel" >
                            <i class="bi bi-file-earmark-excel"></i> Exportar a Excel</a>
                        <a href="<?php echo $URL; ?>/app/controllers/devolucion/exportar_pdf.php" type="button"
                            class="btn btn-md bg-danger" target="_blank" id="boton_exportarPDF" >
                            <i class="bi bi-file-earmark-pdf"></i> Exportar a PDF</a>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-card-checklist"></i> Devoluciones</li>
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
            document.getElementById('boton_exportarExcel').style.display = 'none';
            document.getElementById('boton_exportarPDF').style.display = 'none';
        </script>
    <?php } else if ($rol_sesion == "INGRESOS") { ?>
            <script>
                document.getElementById('boton_agregar').style.display = 'none';
                document.getElementById('boton_exportarExcel').style.display = 'none';
                document.getElementById('boton_exportarPDF').style.display = 'none';
            </script>
    <?php } else if ($rol_sesion == "SECRETARIA") { ?>
                <script>
                    document.getElementById('boton_agregar').style.display = 'inline';
                    document.getElementById('boton_exportarExcel').style.display = 'none';
                    document.getElementById('boton_exportarPDF').style.display = 'none';
                </script>
    <?php } else if ($rol_sesion == "JEFATURA") { ?>
                    <script>
                        document.getElementById('boton_agregar').style.display = 'none';
                        document.getElementById('boton_exportarExcel').style.display = 'none';
                        document.getElementById('boton_exportarPDF').style.display = 'none';
                    </script>
    <?php } else if ($rol_sesion == "EGRESOS") { ?>
                    <script>
                        document.getElementById('boton_agregar').style.display = 'none';
                        document.getElementById('boton_exportarExcel').style.display = 'none';
                        document.getElementById('boton_exportarPDF').style.display = 'none';
                    </script>
    <?php } ?>


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">



            <div class="row">
                <div class="col-md-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">DEVOLUCIONES REGISTRADO</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body table-responsive" style="display: inline;">
                            <form action="index" method="post">

                                <div class="form-row">

                                    <div class="form-group col-md-1">
                                        <label for="">Periodo</label>
                                        <select class="form-control " name="periodoX" style="width:100%" id="periodo"
                                            class="form-control">
                                            <option value="">TODOS</option>
                                            <?php
                                            foreach ($anio_periodo_datos as $anio_periodo_dato) {
                                                $periodo_tabla = $anio_periodo_dato['anio_periodo'];
                                                $id_anio_periodo_tabla = $anio_periodo_dato['id_anio_periodo']; ?>
                                                <option value="<?php echo $id_anio_periodo_tabla; ?>" <?php if ($id_anio_periodo_tabla == $_POST["periodoX"]) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $periodo_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

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
                                        <label for="">Proveido</label>
                                        <input type="text" class="form-control " name="proveidoX" id="proveido"
                                            class="form-control" value="<?php echo $_POST['proveidoX']; ?>"
                                            onkeypress='return validaNumericos(event)'>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Fecha</label>
                                        <input type="date" class="form-control " name="fechaproveidoX"
                                            class="form-control" value="<?php echo $_POST['fechaproveidoX']; ?>">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Oficio</label>
                                        <input type="text" class="form-control " name="oficioX" id="oficio"
                                            class="form-control" value="<?php echo $_POST['oficioX']; ?>">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Fecha</label>
                                        <input type="date" class="form-control " name="fechaoficioX"
                                            class="form-control" value="<?php echo $_POST['fechaoficioX']; ?>">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Informe</label>
                                        <input type="text" class="form-control " name="informeX" id="informe"
                                            class="form-control" value="<?php echo $_POST['informeX']; ?>"
                                            onkeypress='return validaNumericos(event)'>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Fecha</label>
                                        <input type="date" class="form-control " name="fechainformeX"
                                            class="form-control" value="<?php echo $_POST['fechainformeX']; ?>">
                                    </div>


                                    <div class="form-group col-md-2">
                                        <label for="">Facultad/Dependencia</label>
                                        <select class="form-control " name="dependenciaX" style="width:100%"
                                            id="facultad" class="form-control">
                                            <option value="">TODOS</option>
                                            <?php
                                            foreach ($dependencias_datos as $dependencias_dato) {
                                                $dependencia_tabla = $dependencias_dato['nombre'];
                                                $id_dependencias = $dependencias_dato['id_dependencia']; ?>
                                                <option value="<?php echo $id_dependencias; ?>" <?php if ($id_dependencias == $_POST["dependenciaX"]) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $dependencia_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Estado</label>
                                        <select class="form-control " name="estadoX" style="width:100%" id="estado"
                                            class="form-control">
                                            <option value="">TODOS</option>
                                            <?php
                                            foreach ($estado_devolucion_datos as $estado_devolucion_dato) {
                                                $nombre_estado_devolucion_tabla = $estado_devolucion_dato['nombre_estado_devolucion'];
                                                $id_estado_devolucion = $estado_devolucion_dato['id_estado_devolucion']; ?>
                                                <option value="<?php echo $id_estado_devolucion; ?>" <?php if ($id_estado_devolucion == $_POST["estadoX"]) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_estado_devolucion_tabla; ?>
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

                                    document.getElementById('proveido').addEventListener('keydown', function (e) {

                                        //si presiona el teclado Enter
                                        if (e.keyCode === 13) {
                                            // entonces haces lo que quieras para poder reaccionar a la pulsación del enter.

                                            // se establecera como clic en el boton Iniciar Consulta
                                            $("#consultar").click();
                                        }
                                    });

                                    document.getElementById('oficio').addEventListener('keydown', function (e) {

                                        //si presiona el teclado Enter
                                        if (e.keyCode === 13) {
                                            // entonces haces lo que quieras para poder reaccionar a la pulsación del enter.

                                            // se establecera como clic en el boton Iniciar Consulta
                                            $("#consultar").click();
                                        }
                                    });

                                    document.getElementById('informe').addEventListener('keydown', function (e) {

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

                                        if ((event.charCode == 103)) {
                                            return true;
                                        }

                                        if ((event.charCode == 110)) {
                                            return true;
                                        }


                                        return false;
                                    }
                                </script>

                                <script>
                                    $(document).ready(function () {
                                        $('#periodo').select2({
                                            theme: 'bootstrap4',
                                        });
                                        $('#anio_nt').select2({
                                            theme: 'bootstrap4',
                                        });
                                        $('#facultad').select2({
                                            theme: 'bootstrap4',
                                        });
                                        $('#estado').select2({
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
                                <center>Periodo</center>
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
                                <center>Oficio</center>
                            </th>

                            <th>
                                <center>Fecha</center>
                            </th>

                            <th>
                                <center>Informe</center>
                            </th>

                            <th>
                                <center>Fecha</center>
                            </th>

                            <th>
                                <center>Dependencia</center>
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
                        if (!isset($devolucion_datos)) {
                            $devolucion_datos = "";
                        } else {



                            $contador = 0;
                            foreach ($devolucion_datos as $devolucion_dato) {
                                $id_devolucion = $devolucion_dato['id_devolucion']; ?>
                                <tr>
                                    <td>
                                        <center>
                                            <?php echo $contador = $contador + 1; ?>
                                        </center>
                                    </td>

                                    <td>
                                        <?php
                                        if ($devolucion_dato['periodo_anio'] == "SELECCIONAR") {
                                            $devolucion_dato['periodo_anio'] = "";
                                        }

                                        echo $devolucion_dato["periodo_anio"];

                                        ?>
                                    </td>

                                    <td>
                                        <?php echo $devolucion_dato['nt']; ?>
                                    </td>

                                    <td>
                                        <?php
                                        if ($devolucion_dato['nt_anio'] == "SELECCIONAR") {
                                            $devolucion_dato['nt_anio'] = "";
                                        }

                                        echo $devolucion_dato["nt_anio"];

                                        ?>
                                    </td>

                                    <td>
                                        <?php echo $devolucion_dato['proveido']; ?>
                                    </td>

                                    <td>
                                        <?php
                                        if ($devolucion_dato['fecha_proveido'] == "0000-00-00") {
                                            $devolucion_dato['fecha_proveido'] = "";
                                        } else {
                                            $theDate = new DateTime($devolucion_dato['fecha_proveido']);
                                            $devolucion_dato['fecha_proveido'] = $theDate->format('d/m/Y');
                                        }

                                        echo $devolucion_dato['fecha_proveido']; ?>
                                    </td>

                                    <td>
                                        <?php echo $devolucion_dato['oficio']; ?>
                                    </td>

                                    <td>
                                        <?php
                                        if ($devolucion_dato['fecha_oficio'] == "0000-00-00") {
                                            $devolucion_dato['fecha_oficio'] = "";
                                        } else {
                                            $theDate = new DateTime($devolucion_dato['fecha_oficio']);
                                            $devolucion_dato['fecha_oficio'] = $theDate->format('d/m/Y');
                                        }

                                        echo $devolucion_dato['fecha_oficio']; ?>
                                    </td>

                                    <td>
                                        <?php echo $devolucion_dato['informe']; ?>
                                    </td>

                                    <td>
                                        <?php
                                        if ($devolucion_dato['fecha_informe'] == "0000-00-00") {
                                            $devolucion_dato['fecha_informe'] = "";
                                        } else {
                                            $theDate = new DateTime($devolucion_dato['fecha_informe']);
                                            $devolucion_dato['fecha_informe'] = $theDate->format('d/m/Y');
                                        }

                                        echo $devolucion_dato['fecha_informe']; ?>
                                    </td>

                                    <td>
                                        <?php
                                        if ($devolucion_dato['dependencia'] == "SELECCIONAR") {
                                            $devolucion_dato['dependencia'] = "";
                                        }

                                        echo $devolucion_dato["dependencia"];

                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        switch ($devolucion_dato['nombre_estado_devolucion']) {
                                            case 'ATENDIDO': ?>
                                                <span class="badge bg-success">
                                                    <?php echo $devolucion_dato['nombre_estado_devolucion']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'PENDIENTE': ?>
                                                <span class="badge bg-warning">
                                                    <?php echo $devolucion_dato['nombre_estado_devolucion']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'ANULADO': ?>
                                                <span class="badge bg-danger">
                                                    <?php echo $devolucion_dato['nombre_estado_devolucion']; ?>
                                                </span>
                                                <?php
                                                break;
                                        }
                                        ?>
                                    </td>



                                    <td>
                                        <?php $theDate = new DateTime($devolucion_dato['fecha_registro']);
                                        echo $devolucion_dato['fecha_registro'] = $theDate->format('d/m/Y h:i:s a'); ?>
                                    </td>




                                    <td>
                                        <center>
                                            <div class="btn-group">
                                                <a href="show.php?id=<?php echo $id_devolucion; ?>" type="button"
                                                    class="btn btn-sm btn-success"
                                                    id="boton_consultar<?php echo $id_devolucion; ?>"><i
                                                        class="bi bi-search"></i></a>
                                                <a href="estado_devolucion.php?id=<?php echo $id_devolucion; ?>" target="_blank"
                                                    type="button" class="btn btn-sm" style="background-color: bisque;"
                                                    id="boton_imprimir<?php echo $id_devolucion; ?>"><i
                                                        class="bi bi-printer"></i>
                                                </a>
                                                <a href="update.php?id=<?php echo $id_devolucion; ?>" type="button"
                                                    class="btn btn-sm btn-primary"
                                                    id="boton_actualizar<?php echo $id_devolucion; ?>"><i
                                                        class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="delete.php?id=<?php echo $id_devolucion; ?>" type="button"
                                                    class="btn btn-sm btn-danger"
                                                    id="boton_eliminar<?php echo $id_devolucion; ?>"><i
                                                        class="bi bi-x-lg"></i></a>

                                            </div>
                                        </center>
                                        <?php
                                        if ($rol_sesion == "ADMINISTRADOR") { ?>
                                            <script>
                                                document.getElementById('boton_consultar<?php echo $id_devolucion; ?>').style.display = 'inline';
                                                document.getElementById('boton_imprimir<?php echo $id_devolucion; ?>').style.display = 'inline';
                                                document.getElementById('boton_actualizar<?php echo $id_devolucion; ?>').style.display = 'inline';
                                                document.getElementById('boton_eliminar<?php echo $id_devolucion; ?>').style.display = 'inline';
                                            </script>
                                        <?php } else if ($rol_sesion == "INGRESOS") { ?>
                                                <script>
                                                    document.getElementById('boton_consultar<?php echo $id_devolucion; ?>').style.display = 'inline';
                                                    document.getElementById('boton_imprimir<?php echo $id_devolucion; ?>').style.display = 'inline';
                                                    document.getElementById('boton_actualizar<?php echo $id_devolucion; ?>').style.display = 'inline';
                                                    document.getElementById('boton_eliminar<?php echo $id_devolucion; ?>').style.display = 'none';
                                                </script>
                                        <?php } else if ($rol_sesion == "SECRETARIA") { ?>
                                                    <script>
                                                        document.getElementById('boton_consultar<?php echo $id_devolucion; ?>').style.display = 'inline';
                                                        document.getElementById('boton_imprimir<?php echo $id_devolucion; ?>').style.display = 'inline';
                                                        document.getElementById('boton_actualizar<?php echo $id_devolucion; ?>').style.display = 'inline';
                                                        document.getElementById('boton_eliminar<?php echo $id_devolucion; ?>').style.display = 'inline';
                                                    </script>
                                        
                                        <?php } else if ($rol_sesion == "JEFATURA") { ?>
                                                            <script>
                                                                document.getElementById('boton_consultar<?php echo $id_devolucion; ?>').style.display = 'inline';
                                                                document.getElementById('boton_imprimir<?php echo $id_devolucion; ?>').style.display = 'inline';
                                                                document.getElementById('boton_actualizar<?php echo $id_devolucion; ?>').style.display = 'inline';
                                                                document.getElementById('boton_eliminar<?php echo $id_devolucion; ?>').style.display = 'none';
                                                            </script>
                                        <?php } else if ($rol_sesion == "EGRESOS") { ?>
                                                            <script>
                                                                document.getElementById('boton_consultar<?php echo $id_devolucion; ?>').style.display = 'inline';
                                                                document.getElementById('boton_imprimir<?php echo $id_devolucion; ?>').style.display = 'inline';
                                                                document.getElementById('boton_actualizar<?php echo $id_devolucion; ?>').style.display = 'inline';
                                                                document.getElementById('boton_eliminar<?php echo $id_devolucion; ?>').style.display = 'none';
                                                            </script>
                                        <?php } ?>
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
                "infoFiltered": "(Filtrado de _MAX_ total Devoluciones)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Devoluciones",
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