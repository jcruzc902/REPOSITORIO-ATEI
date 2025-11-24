<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');

include('../app/controllers/entidades/listado_de_entidades.php');
include('../app/controllers/afianzador/listado_de_afianzador.php');
include('../app/controllers/condicion_cf/listado_de_condicion.php');
include('../app/controllers/proce_selec/listado_de_proce_selec.php');
include('../app/controllers/tipo_garantia/listado_de_tipo_garantia.php');
include('../app/controllers/anio_convocatoria/listado_anio_convocatoria.php');
include('../app/controllers/observacion_cf/listado_observacion_cf.php');

//-------------------------------------------------------------------------------------------------------------------
//fecha actual
$fecha_actual_xyz = date("Y-m-d");

$condicion_xy = "VIGENTE";
$condicion_xyz = "NO VIGENTE";

$sql_carta_fianza2 = "SELECT * FROM tb_cartas_fianza WHERE visible!=1 ";

$query_carta_fianza2 = $pdo->prepare($sql_carta_fianza2);
$query_carta_fianza2->execute();
$carta_fianza_datos2 = $query_carta_fianza2->fetchAll(PDO::FETCH_ASSOC);

foreach ($carta_fianza_datos2 as $carta_fianza_x) {
    $id_carta_fianza_x = $carta_fianza_x["id_carta_fianza"];
    $fecha_termino_x = $carta_fianza_x["fecha_termino"];
    $condicion_x = $carta_fianza_x["condicion"];

    //si la fecha de termino es igual a la fecha actual, que actualize la condicion de la carta fianza
    if ($fecha_termino_x == $fecha_actual_xyz && $condicion_x == $condicion_xy) {
        $sentencia2 = $pdo->prepare("UPDATE tb_cartas_fianza 
            SET condicion=:condicion,
            fyh_actualizacion=:fyh_actualizacion  
            WHERE id_carta_fianza = :id_carta_fianza ");

        $sentencia2->bindParam('condicion', $condicion_xyz);
        $sentencia2->bindParam('fyh_actualizacion', $fechaHora);
        $sentencia2->bindParam('id_carta_fianza', $id_carta_fianza_x);
        $sentencia2->execute();
    }
}
//-------------------------------------------------------------------------------------------------------------------
if (empty($_POST['periodoX'])) {
    $_POST['periodoX'] = "";
}

if (empty($_POST['entidad_financieraX'])) {
    $_POST['entidad_financieraX'] = "";
}

if (empty($_POST['cf_numeroX'])) {
    $_POST['cf_numeroX'] = "";
}

if (empty($_POST['afianzadorX'])) {
    $_POST['afianzadorX'] = "";
}

if (empty($_POST['tipo_seleccionX'])) {
    $_POST['tipo_seleccionX'] = "";
}

if (empty($_POST['condicionX'])) {
    $_POST['condicionX'] = "";
}

if (empty($_POST['observacionX'])) {
    $_POST['observacionX'] = "";
}

if (empty($_POST['nt_numeroX'])) {
    $_POST['nt_numeroX'] = "";
}

if (empty($_POST['nt_anioX'])) {
    $_POST['nt_anioX'] = "";
}

if (empty($_POST['fecharegistro_desdeX'])) {
    $_POST['fecharegistro_desdeX'] = "";
}

if (empty($_POST['fecharegistro_hastaX'])) {
    $_POST['fecharegistro_hastaX'] = "";
}


$sql_carta_fianza = "SELECT * FROM tb_cartas_fianza WHERE visible!=1 ";

if (isset($_POST["consultar"])) {

    $consultar = 1;
    $periodo = $_POST['periodoX'];
    $entidad_financiera = $_POST['entidad_financieraX'];
    $cf_numero = $_POST['cf_numeroX'];
    $afianzador = $_POST['afianzadorX'];
    $tipo_seleccion = $_POST['tipo_seleccionX'];
    $condicion = $_POST['condicionX'];
    $observacion = $_POST['observacionX'];
    $nt_numero = $_POST['nt_numeroX'];
    $nt_anio = $_POST['nt_anioX'];
    $desde = $_POST['fecharegistro_desdeX'];
    $hasta = $_POST['fecharegistro_hastaX'];

    $_SESSION['busqueda_boton_carta_fianza'] = $consultar;
    $_SESSION['busqueda_periodo'] = $periodo;
    $_SESSION['busqueda_entidad_financiera'] = $entidad_financiera;
    $_SESSION['busqueda_cf_numero'] = $cf_numero;
    $_SESSION['busqueda_afianzador'] = $afianzador;
    $_SESSION['busqueda_tipo_seleccion'] = $tipo_seleccion;
    $_SESSION['busqueda_condicion'] = $condicion;
    $_SESSION['busqueda_observacion'] = $observacion;
    $_SESSION['busqueda_nt_numero'] = $nt_numero;
    $_SESSION['busqueda_nt_anio'] = $nt_anio;
    $_SESSION['busqueda_desde'] = $desde;
    $_SESSION['busqueda_hasta'] = $hasta;


    if (
        !isset($periodo) && !isset($entidad_financiera) && !isset($cf_numero) && !isset($afianzador) && !isset($tipo_seleccion) && !isset($condicion) &&
        !isset($observacion) && !isset($nt_numero) && !isset($nt_anio) && !isset($desde) && !isset($hasta)
    ) {
        $sql_carta_fianza .= " ";
    } else {

        if (!empty($periodo)) {
            $sql_carta_fianza .= " AND periodo='" . $periodo . "'";
        }

        if (!empty($entidad_financiera)) {
            $sql_carta_fianza .= " AND entidad_financiera='" . $entidad_financiera . "'";
        }

        if (!empty($cf_numero)) {
            $sql_carta_fianza .= " AND nro_carta_fianza like '%" . $cf_numero . "%'";
        }

        if (!empty($afianzador)) {
            $sql_carta_fianza .= " AND afianzador='" . $afianzador . "'";
        }

        if (!empty($tipo_seleccion)) {
            $sql_carta_fianza .= " AND tipo_seleccion='" . $tipo_seleccion . "'";
        }

        if (!empty($condicion)) {
            $sql_carta_fianza .= " AND condicion='" . $condicion . "'";
        }

        if (!empty($observacion)) {
            $sql_carta_fianza .= " AND observacion='" . $observacion . "'";
        }

        if (!empty($nt_numero)) {
            $sql_carta_fianza .= " AND nt_nro like '%" . $nt_numero . "%'";
        }

        if (!empty($nt_anio)) {
            $sql_carta_fianza .= " AND nt_anio='" . $nt_anio . "'";
        }


        if (!empty($desde) && !empty($hasta)) {
            $sql_carta_fianza .= " AND fyh_creacion between '" . $desde . " 00:00:00" . "' and '" . $hasta . " 23:59:59" . "'";
        }




    }


    $query_carta_fianza = $pdo->prepare($sql_carta_fianza);
    $query_carta_fianza->execute();
    $carta_fianza_datos = $query_carta_fianza->fetchAll(PDO::FETCH_ASSOC);


}


if ($_POST['fecharegistro_desdeX'] > $_POST['fecharegistro_hastaX']) {
    ?>
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Desde la fecha no puede ser mayor Hasta la fecha',
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
                    <h1 class="m-0"><b>Consulta de Cartas Fianza</b>
                        <a href="<?php echo $URL; ?>/cartas_fianza/create.php" type="button"
                            class="btn btn-md bg-primary" id="boton_agregar">
                            <i class="bi bi-plus-circle"></i> Agregar Nuevo Carta Fianza</a>
                        <a href="<?php echo $URL; ?>/app/controllers/carta_fianza/exportar_xlsx.php" type="button"
                            class="btn btn-md bg-success" id="boton_exportarExcel">
                            <i class="bi bi-file-earmark-excel"></i> Exportar a Excel</a>
                        <a href="<?php echo $URL; ?>/app/controllers/carta_fianza/exportar_pdf.php" type="button"
                            class="btn btn-md bg-danger" target="_blank" id="boton_exportarPDF">
                            <i class="bi bi-file-earmark-pdf"></i> Exportar a PDF</a>
                        <a href="<?php echo $URL; ?>/app/controllers/carta_fianza/exportar_zip.php" type="button"
                            class="btn btn-md bg-secondary" target="_blank" id="boton_exportarZIP">
                            <i class="bi bi-file-earmark-zip"></i> Exportar archivos a ZIP</a>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-folder"></i> Cartas Fianza</li>
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
                            <h3 class="card-title">CARTAS FIANZA REGISTRADO</h3>
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
                                        <label for="">Periodo</label>
                                        <select class="form-control " id="periodo" name="periodoX" style="width:100%;">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($anio_convocatoria_datos as $anio_convocatoria_dato) {
                                                $anio_convocatoria_tabla = $anio_convocatoria_dato['anio_convocatoria'];
                                                $id_anio_convocatoria = $anio_convocatoria_dato['id_anio_convocatoria']; ?>
                                                <option value="<?php echo $anio_convocatoria_tabla; ?>" <?php if ($anio_convocatoria_tabla == $_POST["periodoX"]) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $anio_convocatoria_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-3" id="">
                                        <label for="">Entidad Financiera</label>
                                        <select class="form-control " id="entidad_financiera" name="entidad_financieraX"
                                            style="width:100%;">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($entidades_datos as $entidades_dato) {
                                                $nombre_entidad_tabla = $entidades_dato['nombre_entidad'];
                                                $id_entidad_cf = $entidades_dato['id_entidad_cf']; ?>
                                                <option value="<?php echo $nombre_entidad_tabla; ?>" <?php if ($nombre_entidad_tabla == $_POST["entidad_financieraX"]) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $nombre_entidad_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Carta Fianza N°</label>
                                        <input type="text" class="form-control " id="carta_fianza_nro" name="cf_numeroX"
                                            placeholder="Carta Fianza N°" value="<?php echo $_POST['cf_numeroX']; ?>">
                                    </div>



                                    <div class="form-group col-md-3" id="">
                                        <label for="">Afianzador</label>
                                        <select class="form-control " id="afianzador" name="afianzadorX"
                                            style="width:100%;">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($afianzador_datos as $afianzador_dato) {
                                                $nombre_afianzador_tabla = $afianzador_dato['nombre_afianzador'];
                                                $id_afianzador_cf = $afianzador_dato['id_afianzador_cf']; ?>
                                                <option value="<?php echo $nombre_afianzador_tabla; ?>" <?php if ($nombre_afianzador_tabla == $_POST["afianzadorX"]) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $nombre_afianzador_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Tipo de seleccion</label>
                                        <select class="form-control " id="proce_selec" name="tipo_seleccionX"
                                            style="width:100%;">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($proce_selec_cf_datos as $proce_selec_cf_dato) {
                                                $nombre_proce_tabla = $proce_selec_cf_dato['nombre_proce'];
                                                $id_proce_selec = $proce_selec_cf_dato['id_proce_selec']; ?>
                                                <option value="<?php echo $nombre_proce_tabla; ?>" <?php if ($nombre_proce_tabla == $_POST["tipo_seleccionX"]) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $nombre_proce_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Condicion</label>
                                        <select class="form-control " id="condicion_cf" name="condicionX"
                                            style="width:100%;">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($condicion_cf_datos as $condicion_cf_dato) {
                                                $nombre_condicion_tabla = $condicion_cf_dato['nombre_condicion'];
                                                $id_condicion_cf = $condicion_cf_dato['id_condicion_cf']; ?>
                                                <option value="<?php echo $nombre_condicion_tabla; ?>" <?php if ($nombre_condicion_tabla == $_POST["condicionX"]) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_condicion_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>


                                    <div class="form-group col-md-2" id="">
                                        <label for="">Observacion</label>
                                        <select class="form-control " id="observacion_1" name="observacionX"
                                            style="width:100%;">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($observacion_cf_datos as $observacion_cf_dato) {
                                                $observacion_cf_tabla = $observacion_cf_dato['observacion_cf'];
                                                $id_observacion_cf = $observacion_cf_dato['id_observacion_cf']; ?>
                                                <option value="<?php echo $observacion_cf_tabla; ?>" <?php if ($observacion_cf_tabla == $_POST["observacionX"]) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $observacion_cf_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">NT N°</label>
                                        <input type="text" class="form-control " id="nt" name="nt_numeroX"
                                            placeholder="NT N°" value="<?php echo $_POST["nt_numeroX"]; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">NT Año</label>
                                        <select class="form-control " id="anio_nt" name="nt_anioX" style="width:100%;">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($anio_convocatoria_datos as $anio_convocatoria_dato) {
                                                $anio_convocatoria_tabla = $anio_convocatoria_dato['anio_convocatoria'];
                                                $id_anio_convocatoria = $anio_convocatoria_dato['id_anio_convocatoria']; ?>
                                                <option value="<?php echo $anio_convocatoria_tabla; ?>" <?php if ($anio_convocatoria_tabla == $_POST["nt_anioX"]) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $anio_convocatoria_tabla; ?>
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


                                    document.getElementById('carta_fianza_nro').addEventListener('keydown', function (e) {

                                        //si presiona el teclado Enter
                                        if (e.keyCode === 13) {
                                            // entonces haces lo que quieras para poder reaccionar a la pulsación del enter.

                                            // se establecera como clic en el boton Iniciar Consulta
                                            $("#consultar").click();
                                        }
                                    });

                                    document.getElementById('nt').addEventListener('keydown', function (e) {

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
                                        $('#entidad_financiera').select2({
                                            theme: 'bootstrap4',
                                        });
                                        $('#afianzador').select2({
                                            theme: 'bootstrap4',
                                        });
                                        $('#proce_selec').select2({
                                            theme: 'bootstrap4',
                                        });
                                        $('#condicion_cf').select2({
                                            theme: 'bootstrap4',
                                        });
                                        $('#observacion_1').select2({
                                            theme: 'bootstrap4',
                                        });
                                        $('#anio_nt').select2({
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
                                <center>Entidad Financiera</center>
                            </th>

                            <th>
                                <center>Carta Fianza N°</center>
                            </th>

                            <th>
                                <center>Afianzador</center>
                            </th>

                            <th>
                                <center>Tipo de Seleccion</center>
                            </th>

                            <th>
                                <center>Condicion</center>
                            </th>

                            <th>
                                <center>Observacion</center>
                            </th>

                            <th>
                                <center>NT N°</center>
                            </th>

                            <th>
                                <center>NT Año</center>
                            </th>

                            <th>
                                <center>Fecha de Registro</center>
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
                        if (!isset($carta_fianza_datos)) {
                            $carta_fianza_datos = "";
                        } else {



                            $contador = 0;
                            foreach ($carta_fianza_datos as $carta_fianza_dato) {
                                $id_carta_fianza = $carta_fianza_dato['id_carta_fianza']; ?>
                                <tr>
                                    <td>
                                        <center>
                                            <?php echo $contador = $contador + 1; ?>
                                        </center>
                                    </td>

                                    <td>
                                        <?php echo $carta_fianza_dato['periodo']; ?>
                                    </td>

                                    <td>
                                        <?php
                                        if ($carta_fianza_dato['entidad_financiera'] == "SELECCIONAR") {
                                            $carta_fianza_dato['entidad_financiera'] = "";
                                        }

                                        echo $carta_fianza_dato["entidad_financiera"];

                                        ?>
                                    </td>

                                    <td>
                                        <?php echo $carta_fianza_dato['nro_carta_fianza']; ?>
                                    </td>

                                    <td>
                                        <?php
                                        if ($carta_fianza_dato['afianzador'] == "SELECCIONAR") {
                                            $carta_fianza_dato['afianzador'] = "";
                                        }

                                        echo $carta_fianza_dato["afianzador"];

                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        if ($carta_fianza_dato['tipo_seleccion'] == "SELECCIONAR") {
                                            $carta_fianza_dato['tipo_seleccion'] = "";
                                        }

                                        echo $carta_fianza_dato["tipo_seleccion"];

                                        ?>
                                    </td>



                                    <td>
                                        <?php
                                        switch ($carta_fianza_dato['condicion']) {
                                            case 'VIGENTE': ?>
                                                <span class="badge bg-success">
                                                    <?php echo $carta_fianza_dato['condicion']; ?>
                                                </span>
                                                <?php
                                                break;

                                            case 'NO VIGENTE': ?>
                                                <span class="badge bg-danger">
                                                    <?php echo $carta_fianza_dato['condicion']; ?>
                                                </span>
                                                <?php
                                                break;
                                        }
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        if ($carta_fianza_dato['observacion'] == "SELECCIONAR") {
                                            $carta_fianza_dato['observacion'] = "";
                                        }

                                        echo $carta_fianza_dato["observacion"];

                                        ?>
                                    </td>

                                    <td>
                                        <?php echo $carta_fianza_dato['nt_nro']; ?>
                                    </td>

                                    <td>
                                        <?php
                                        if ($carta_fianza_dato['nt_anio'] == "SELECCIONAR") {
                                            $carta_fianza_dato['nt_anio'] = "";
                                        }

                                        echo $carta_fianza_dato["nt_anio"];

                                        ?>
                                    </td>

                                    <td>
                                        <?php $theDate = new DateTime($carta_fianza_dato['fyh_creacion']);
                                        echo $carta_fianza_dato['fyh_creacion'] = $theDate->format('d/m/Y h:i:s a'); ?>
                                    </td>

                                    <td>
                                        <?php
                                        
                                        if($carta_fianza_dato['nombre_archivo']!=null){
                                        
                                        ?>

                                        <a href="../app/controllers/carta_fianza/download.php?id=<?php echo $id_carta_fianza; ?>"
                                            target="_blank" type="button" class="btn btn-sm"
                                            style="background-color: lightblue;"
                                            id="boton_archivo_cf<?php echo $id_carta_fianza; ?>"><i
                                                class="bi bi-file-earmark-pdf"></i>
                                        </a>

                                        <?php

                                            }
                                        ?>

                                    </td>

                                    <td>
                                        <center>
                                            <div class="btn-group">
                                                <a href="show.php?id=<?php echo $id_carta_fianza; ?>" type="button"
                                                    class="btn btn-sm btn-success"
                                                    id="boton_consultar<?php echo $id_carta_fianza; ?>"><i
                                                        class="bi bi-search"></i></a>
                                                <!--<a href="estado_devolucion.php?id=<?php echo $id_carta_fianza; ?>" target="_blank"
                                                    type="button" class="btn btn-sm" style="background-color: bisque;"
                                                    id="boton_imprimir<?php echo $id_carta_fianza; ?>"><i
                                                        class="bi bi-printer"></i>
                                                </a>-->
                                                <a href="update.php?id=<?php echo $id_carta_fianza; ?>" type="button"
                                                    class="btn btn-sm btn-primary"
                                                    id="boton_actualizar<?php echo $id_carta_fianza; ?>"><i
                                                        class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="delete.php?id=<?php echo $id_carta_fianza; ?>" type="button"
                                                    class="btn btn-sm btn-danger"
                                                    id="boton_eliminar<?php echo $id_carta_fianza; ?>"><i
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
                "infoFiltered": "(Filtrado de _MAX_ total Cartas Fianza)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Cartas Fianza",
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