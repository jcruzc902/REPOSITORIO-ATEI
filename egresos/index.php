<?php

include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/anio_nt/listado_de_anios.php');
include('../app/controllers/cargo/listado_cargo.php');
include('../app/controllers/actividad_principal/listado_actividad_principal.php');
include('../app/controllers/resolucion_egresos/listado_resolucion_egresos.php');
include('../app/controllers/estado_giro/listado_de_estado_giro.php');


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


if (empty($_POST['cargoX'])) {
    $_POST['cargoX'] = "";
}

if (empty($_POST['actividad_principalX'])) {
    $_POST['actividad_principalX'] = "";
}

if (empty($_POST['subactividadX'])) {
    $_POST['subactividadX'] = "";
}

if (empty($_POST['siafX'])) {
    $_POST['siafX'] = "";
}

if (empty($_POST['fecha_giroX'])) {
    $_POST['fecha_giroX'] = "";
}

if (empty($_POST['fecha_giroY'])) {
    $_POST['fecha_giroY'] = "";
}

if (empty($_POST['resolucionX'])) {
    $_POST['resolucionX'] = "";
}

if (empty($_POST['estado_giroX'])) {
    $_POST['estado_giroX'] = "";
}



$sql_detalle_egreso = "SELECT *,
t_detalle.facultad as facultad,
t_detalle.actividad_principal as actividad_principal,
t_detalle.subactividad as subactividad,
t_detalle.fyh_creacion as fyh_creacion_egreso,
anios.anio_nt as anio_nt,
usuario.nombres as nombre_usuario,
usuario.apaterno as apaterno_usuario,
usuario.amaterno as amaterno_usuario 
FROM tb_detalle_egresos as t_detalle 
INNER JOIN tb_usuarios as usuario ON usuario.id_usuario= t_detalle.id_usuario 
LEFT JOIN tb_anio_nt as anios ON  anios.id_anio_nt= t_detalle.id_anio_nt_principal 
WHERE t_detalle.visible!=1 ";

if (isset($_POST["consultar"])) {

    $consultar = 1;
    $nt = $_POST['ntX'];
    $anio_nt = $_POST['aniontX'];
    $facultad = $_POST['cargoX'];
    $actividad_principal = $_POST['actividad_principalX'];
    $subactividad = $_POST['subactividadX'];
    $siaf = $_POST['siafX'];
    $fecha_giro = $_POST['fecha_giroX'];
    $fecha_giro2 = $_POST['fecha_giroY'];
    $estado_giro = $_POST['estado_giroX'];
    $resolucion = $_POST['resolucionX'];
    $desde = $_POST['fecharegistro_desdeX'];
    $hasta = $_POST['fecharegistro_hastaX'];

    $_SESSION['busqueda_boton_detalle_egresos'] = $consultar;
    $_SESSION['busqueda_detalle_nt'] = $nt;
    $_SESSION['busqueda_detalle_anio_nt'] = $anio_nt;
    $_SESSION['busqueda_detalle_facultad'] = $facultad;
    $_SESSION['busqueda_detalle_actividad'] = $actividad_principal;
    $_SESSION['busqueda_detalle_subactividad'] = $subactividad;
    $_SESSION['busqueda_detalle_siaf'] = $siaf;
    $_SESSION['busqueda_detalle_fecha_giro'] = $fecha_giro;
    $_SESSION['busqueda_detalle_fecha_giro2'] = $fecha_giro2;
    $_SESSION['busqueda_detalle_estado_giro'] = $estado_giro;
    $_SESSION['busqueda_detalle_resolucion'] = $resolucion;
    $_SESSION['busqueda_detalle_desde'] = $desde;
    $_SESSION['busqueda_detalle_hasta'] = $hasta;


    if (
        !isset($nt) && !isset($anio_nt) && !isset($facultad) && !isset($actividad_principal) && !isset($subactividad) 
        && !isset($siaf) && !isset($fecha_giro) && !isset($fecha_giro2) && !isset($estado_giro)
        && !isset($resolucion) && !isset($desde) && !isset($hasta)
    ) {
        $sql_detalle_egreso .= "";
    } else {

        if (!empty($nt)) {
            $sql_detalle_egreso .= " AND t_detalle.nt_principal like '%" . $nt . "%'";
        }

        if (!empty($anio_nt)) {
            $sql_detalle_egreso .= " AND anios.anio_nt='" . $anio_nt . "'";
        }

        if (!empty($facultad)) {
            $sql_detalle_egreso .= " AND t_detalle.facultad='" . $facultad . "'";
        }

        if (!empty($facultad) && !empty($actividad_principal)) {
            $sql_detalle_egreso .= " AND t_detalle.actividad_principal='" . $actividad_principal . "'";
        }

        if (!empty($facultad) && !empty($actividad_principal) && !empty($subactividad)) {
            $sql_detalle_egreso .= " AND t_detalle.subactividad='" . $subactividad . "'";
        }

        if (!empty($siaf)) {
            $sql_detalle_egreso .= " AND t_detalle.siaf like '%" . $siaf . "%'";
        }

        /*
        if (!empty($fecha_giro)) {
            $sql_detalle_egreso .= " AND t_detalle.fecha_giro='" . $fecha_giro . "'";
        }*/

        if (!empty($fecha_giro) && !empty($fecha_giro2)) {
            $sql_detalle_egreso .= " AND t_detalle.fecha_giro between '" . $fecha_giro." 00:00:00" . "' and '" . $fecha_giro2." 23:59:59" . "'";
        }

        if (!empty($estado_giro)) {
            $sql_detalle_egreso .= " AND t_detalle.estado_giro='" . $estado_giro . "'";
        }

        if (!empty($resolucion)) {
            $sql_detalle_egreso .= " AND t_detalle.resolucion='" . $resolucion . "'";
        }

        
        if (!empty($desde) && !empty($hasta)) {
            $sql_detalle_egreso .= " AND t_detalle.fyh_creacion between '" . $desde." 00:00:00" . "' and '" . $hasta." 23:59:59" . "'";
        }

        

        $sql_detalle_egreso .= " ORDER BY t_detalle.egresos ASC"; //ordena el nombre del banco en forma ascendente
    }


    $query_detalle_egreso = $pdo->prepare($sql_detalle_egreso);
    $query_detalle_egreso->execute();
    $detalle_egreso_datos = $query_detalle_egreso->fetchAll(PDO::FETCH_ASSOC);


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
                    <h1 class="m-0"><b>Consulta de Egresos de Pagos Realizado</b>
                        <a href="<?php echo $URL; ?>/app/controllers/estado_egresos/exportar_xlsx.php" type="button"
                            class="btn btn-md bg-success" id="boton_exportarExcel">
                            <i class="bi bi-file-earmark-excel"></i> Exportar a Excel</a>
                        <a href="<?php echo $URL; ?>/app/controllers/estado_egresos/exportar_pdf.php" type="button"
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
                            <h3 class="card-title">DETALLE DE REGISTROS DE EGRESOS</h3>
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
                                        <select class="form-control " name="aniontX" id="anio_nt" style="width:100%"
                                            class="form-control">
                                            <option value="">TODOS</option>
                                            <?php
                                            foreach ($anios_datos as $anios_dato) {
                                                $anio_nt_tabla = $anios_dato['anio_nt'];
                                                $id_anio_nt = $anios_dato['id_anio_nt']; ?>
                                                <option value="<?php echo $anio_nt_tabla; ?>" <?php if ($anio_nt_tabla == $_POST["aniontX"]) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $anio_nt_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>


                                    <?php

                                    $sql_actividad_principal = "SELECT actividad_principal.id_actividad_principal as id_actividad_principal,
                                    actividad_principal.nombre_actividad as nombre_actividad,
                                    actividad_principal.id_cargo as id_cargo,
                                    cargo.nombre_cargo as nombre_cargo 
                                    FROM tb_actividad_principal as actividad_principal 
                                    INNER JOIN tb_cargo as cargo ON cargo.id_cargo= actividad_principal.id_cargo 
                                    where actividad_principal.visible!=1 AND cargo.nombre_cargo='$_POST[cargoX]' ORDER BY actividad_principal.nombre_actividad ASC";
                                    $query_actividad_principal = $pdo->prepare($sql_actividad_principal);
                                    $query_actividad_principal->execute();
                                    $actividad_principal_datos = $query_actividad_principal->fetchAll(PDO::FETCH_ASSOC);


                                    $sql_subactividad = "SELECT subactividad.id_subactividad as id_subactividad,
                                    subactividad.nombre_subactividad as nombre_subactividad,
                                    subactividad.id_actividad_principal as id_actividad_principal,
                                    actividad_principal.nombre_actividad as nombre_actividad,
                                    actividad_principal.id_cargo as id_cargo,
                                    cargo.nombre_cargo as nombre_cargo 
                                    FROM tb_subactividad as subactividad 
                                    INNER JOIN tb_actividad_principal as actividad_principal ON actividad_principal.id_actividad_principal= subactividad.id_actividad_principal 
                                    LEFT JOIN tb_cargo as cargo ON cargo.id_cargo= actividad_principal.id_cargo 
                                    WHERE subactividad.visible!=1 AND cargo.nombre_cargo='$_POST[cargoX]' AND actividad_principal.nombre_actividad='$_POST[actividad_principalX]' 
                                    ORDER BY subactividad.nombre_subactividad ASC";
                                    $query_subactividad = $pdo->prepare($sql_subactividad);
                                    $query_subactividad->execute();
                                    $subactividad_datos = $query_subactividad->fetchAll(PDO::FETCH_ASSOC);

                                    ?>


                                    <div class="form-group col-md-3" id="campo_anio_nt">
                                        <label for="">Facultad</label>
                                        <select class="form-control " name="cargoX" id="combo_cargo" style="width:100%">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($tipo_cargo_datos as $tipo_cargo_dato) {
                                                $nombre_cargo_tabla = $tipo_cargo_dato['nombre_cargo'];
                                                $id_cargo = $tipo_cargo_dato['id_cargo']; ?>
                                                <option value="<?php echo $nombre_cargo_tabla; ?>" <?php if ($nombre_cargo_tabla == $_POST["cargoX"]) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $nombre_cargo_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-3" id="campo_anio_nt">
                                        <label for="">Actividad Principal</label>
                                        <select class="form-control " name="actividad_principalX" id="combo_actividad"
                                            style="width:100%">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($actividad_principal_datos as $actividad_principal_dato) {
                                                $nombre_actividad_tabla = $actividad_principal_dato['nombre_actividad'];
                                                $id_actividad_principal = $actividad_principal_dato['id_actividad_principal']; ?>
                                                <option value="<?php echo $nombre_actividad_tabla; ?>" <?php if ($nombre_actividad_tabla == $_POST["actividad_principalX"]) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $nombre_actividad_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-3" id="campo_anio_nt">
                                        <label for="">Subactividad</label>
                                        <select class="form-control " name="subactividadX" id="combo_subactividad"
                                            style="width:100%">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($subactividad_datos as $subactividad_dato) {
                                                $nombre_subactividad_tabla = $subactividad_dato['nombre_subactividad'];
                                                $id_subactividad = $subactividad_dato['id_subactividad']; ?>
                                                <option value="<?php echo $nombre_subactividad_tabla; ?>" <?php if ($nombre_subactividad_tabla == $_POST["subactividadX"]) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $nombre_subactividad_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <script>

                                        $(document).ready(function () {

                                            $('#combo_cargo').change(function () {

                                                $('#combo_subactividad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

                                                $("#combo_cargo option:selected").each(function () {
                                                    var nombre_cargo = $('#combo_cargo').val();
                                                    $.post("../app/controllers/cargo/consulta_actividad.php",
                                                        { nombre_cargo: nombre_cargo }, function (data) {
                                                            $("#combo_actividad").html(data);
                                                        });
                                                });

                                            });
                                        });

                                        $(document).ready(function () {

                                            $('#combo_actividad').change(function () {

                                                $("#combo_actividad option:selected").each(function () {
                                                    var nombre_actividad = $('#combo_actividad').val();
                                                    $.post("../app/controllers/cargo/consulta_subactividad.php",
                                                        { nombre_actividad: nombre_actividad }, function (data) {
                                                            $("#combo_subactividad").html(data);
                                                        });
                                                });

                                            });
                                        });


                                    </script>

                                    <div class="form-group col-md-2">
                                        <label for="">SIAF</label>
                                        <input type="text" class="form-control " name="siafX" id="siaf"
                                            class="form-control" value="<?php echo $_POST['siafX']; ?>"
                                            onkeypress='return validaNumericos(event)'>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Fecha Giro Desde</label>
                                        <input type="date" class="form-control " name="fecha_giroX" class="form-control"
                                            value="<?php echo $_POST["fecha_giroX"] ?>">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Fecha Giro Hasta</label>
                                        <input type="date" class="form-control " name="fecha_giroY" class="form-control"
                                            value="<?php echo $_POST["fecha_giroY"] ?>">
                                    </div>


                                    <div class="form-group col-md-3" id="campo_anio_nt">
                                        <label for="">Resolucion</label>
                                        <select class="form-control " name="resolucionX" id="combo_resolucion"
                                            style="width:100%">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($resolucion_egresos_datos as $resolucion_egresos_dato) {
                                                $nombre_resolucion_tabla = $resolucion_egresos_dato['resolucion'];
                                                $id_resolucion_egreso = $resolucion_egresos_dato['id_resoluciones_egresos']; ?>
                                                <option value="<?php echo $nombre_resolucion_tabla; ?>" <?php if ($nombre_resolucion_tabla == $_POST["resolucionX"]) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $nombre_resolucion_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-3" id="">
                                        <label for="">Estado de Giro</label>
                                        <select class="form-control " name="estado_giroX" id="estado_giro"
                                            style="width:100%">
                                            <option value="">TODOS</option>
                                            <?php
                                            foreach ($estado_giro_datos as $estado_giro_dato) {
                                                $estado_giro_tabla = $estado_giro_dato['estado'];
                                                $id_estado_giro = $estado_giro_dato['id_estado_giro'];
                                                ?>
                                                <option value="<?php echo $estado_giro_dato['estado']; ?>" <?php if ($estado_giro_tabla == $_POST["estado_giroX"]) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $estado_giro_dato['estado']; ?>
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

                                <script>
                                    document.getElementById('nt').addEventListener('keydown', function (e) {

                                        //si presiona el teclado Enter
                                        if (e.keyCode === 13) {
                                            // entonces haces lo que quieras para poder reaccionar a la pulsación del enter.

                                            // se establecera como clic en el boton Iniciar Consulta
                                            $("#consultar").click();
                                        }
                                    });

                                    document.getElementById('proveido_contabilidad').addEventListener('keydown', function (e) {

                                        //si presiona el teclado Enter
                                        if (e.keyCode === 13) {
                                            // entonces haces lo que quieras para poder reaccionar a la pulsación del enter.

                                            // se establecera como clic en el boton Iniciar Consulta
                                            $("#consultar").click();
                                        }
                                    });

                                    document.getElementById('proveido_diga').addEventListener('keydown', function (e) {

                                        //si presiona el teclado Enter
                                        if (e.keyCode === 13) {
                                            // entonces haces lo que quieras para poder reaccionar a la pulsación del enter.

                                            // se establecera como clic en el boton Iniciar Consulta
                                            $("#consultar").click();
                                        }
                                    });

                                    document.getElementById('siaf').addEventListener('keydown', function (e) {

                                        //si presiona el teclado Enter
                                        if (e.keyCode === 13) {
                                            // entonces haces lo que quieras para poder reaccionar a la pulsación del enter.

                                            // se establecera como clic en el boton Iniciar Consulta
                                            $("#consultar").click();
                                        }
                                    });

                                    document.getElementById('resolucion').addEventListener('keydown', function (e) {

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
                                        $('#estado_giro').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_cargo').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_actividad').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_subactividad').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_resolucion').select2({
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
                                <center>Facultad</center>
                            </th>
                            <th>
                                <center>Actividad</center>
                            </th>
                            <th>
                                <center>Subactividad</center>
                            </th>

                            <th>
                                <center>SIAF</center>
                            </th>
                            <th>
                                <center>Fecha Giro</center>
                            </th>
                            <th>
                                <center>Resolucion Rectoral</center>
                            </th>
                            <th>
                                <center>Estado de Giro</center>
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
                        if (!isset($detalle_egreso_datos)) {
                            $detalle_egreso_datos = "";
                        } else {

                            $contador = 0;
                            foreach ($detalle_egreso_datos as $detalle_egreso_dato) {
                                $id_detalle_egreso = $detalle_egreso_dato['id_detalle_egreso']; ?>
                                <tr>
                                    <td>
                                        <center>
                                            <?php echo $contador = $contador + 1; ?>
                                        </center>
                                    </td>
                                    <td>
                                        <?php echo $detalle_egreso_dato['nt_principal']; ?>
                                    </td>
                                    <td>
                                        <?php echo $detalle_egreso_dato['anio_nt']; ?>
                                    </td>
                                    <td>
                                        <?php echo $detalle_egreso_dato['facultad']; ?>
                                    </td>
                                    <td>
                                        <?php echo $detalle_egreso_dato['actividad_principal']; ?>
                                    </td>
                                    <td>
                                        <?php echo $detalle_egreso_dato['subactividad']; ?>
                                    </td>

                                    <td>
                                        <?php echo $detalle_egreso_dato['siaf']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($detalle_egreso_dato['fecha_giro'] == "0000-00-00") {
                                            $fecha_giro = "";
                                        } else {
                                            $theDate = new DateTime($detalle_egreso_dato['fecha_giro']);
                                            $fecha_giro = $theDate->format('d/m/Y');
                                        }

                                        echo $fecha_giro; ?>
                                    </td>
                                    <td>
                                        <?php

                                        if ($detalle_egreso_dato['resolucion'] == "SELECCIONAR") {
                                            $detalle_egreso_dato['resolucion'] = "";
                                        }

                                        echo $detalle_egreso_dato['resolucion'];

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        switch ($detalle_egreso_dato['estado_giro']) {
                                            case 'APROBADO': ?>
                                                <span class="badge bg-success">
                                                    <?php echo $detalle_egreso_dato['estado_giro']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'PENDIENTE': ?>
                                                <span class="badge bg-warning">
                                                    <?php echo $detalle_egreso_dato['estado_giro']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'ANULADO': ?>
                                                <span class="badge bg-danger">
                                                    <?php echo $detalle_egreso_dato['estado_giro']; ?>
                                                </span>
                                                <?php
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php $theDate = new DateTime($detalle_egreso_dato['fyh_creacion_egreso']);
                                        echo $detalle_egreso_dato['fyh_creacion_egreso'] = $theDate->format('d/m/Y h:i:s a'); ?>
                                    </td>


                                    <td>
                                        <?php
                                        if ($detalle_egreso_dato['checkbox_informe'] == "YES") {
                                            ?>
                                            <a href="../detalle_estado_egresos/informe.php?id=<?php echo $id_detalle_egreso; ?>"
                                                target="_blank" type="button" class="btn btn-sm"
                                                style="background-color: lightblue;"
                                                id="boton_informe<?php echo $id_detalle_egreso; ?>"><i
                                                    class="bi bi-file-earmark-pdf"></i>
                                            </a>
                                            <?php
                                        }
                                        ?>

                                        <?php
                                        if ($detalle_egreso_dato['checkbox_ec'] == "YES") {
                                            ?>
                                            <a href="../detalle_estado_egresos/estado_cuenta.php?id=<?php echo $id_detalle_egreso; ?>"
                                                target="_blank" type="button" class="btn btn-sm" style="background-color: gold;"
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
            "responsive": false, "lengthChange": true, "autoWidth": false, "searching": false,

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>