<?php
include('../../config.php');

session_start();

if (isset($_SESSION['busqueda_periodo'])) {
    $periodo = $_SESSION['busqueda_periodo'];
} else {
    $periodo = "";
}

if (isset($_SESSION['busqueda_entidad_financiera'])) {
    $entidad_financiera = $_SESSION['busqueda_entidad_financiera'];
} else {
    $entidad_financiera = "";
}

if (isset($_SESSION['busqueda_cf_numero'])) {
    $cf_numero = $_SESSION['busqueda_cf_numero'];
} else {
    $cf_numero = "";
}

if (isset($_SESSION['busqueda_afianzador'])) {
    $afianzador = $_SESSION['busqueda_afianzador'];
} else {
    $afianzador = "";
}

if (isset($_SESSION['busqueda_tipo_seleccion'])) {
    $tipo_seleccion = $_SESSION['busqueda_tipo_seleccion'];
} else {
    $tipo_seleccion = "";
}

if (isset($_SESSION['busqueda_condicion'])) {
    $condicion = $_SESSION['busqueda_condicion'];
} else {
    $condicion = "";
}

if (isset($_SESSION['busqueda_observacion'])) {
    $observacion = $_SESSION['busqueda_observacion'];
} else {
    $observacion = "";
}

if (isset($_SESSION['busqueda_nt_numero'])) {
    $nt_numero = $_SESSION['busqueda_nt_numero'];
} else {
    $nt_numero = "";
}

if (isset($_SESSION['busqueda_nt_anio'])) {
    $nt_anio = $_SESSION['busqueda_nt_anio'];
} else {
    $nt_anio = "";
}

if (isset($_SESSION['busqueda_desde'])) {
    $desde = $_SESSION['busqueda_desde'];
} else {
    $desde = "";
}

if (isset($_SESSION['busqueda_hasta'])) {
    $hasta = $_SESSION['busqueda_hasta'];
} else {
    $hasta = "";
}

$sql_carta_fianza = "SELECT *,
cf.fyh_creacion as fyh_creacioncf,
cf.fyh_actualizacion as fyh_actualizacioncf, 
us.id_usuario as id_usuario,
us.nombres as nombres_usuario,
us.apaterno as apellido_paterno,
us.amaterno as apellido_materno 
FROM tb_cartas_fianza as cf 
INNER JOIN tb_usuarios as us ON us.id_usuario= cf.id_usuario 
WHERE cf.visible>=0 ";

if (isset($_SESSION['busqueda_boton_carta_fianza'])) {

    if (
        !isset($periodo) && !isset($entidad_financiera) && !isset($cf_numero) && !isset($afianzador) && !isset($tipo_seleccion) && !isset($condicion) &&
        !isset($observacion) && !isset($nt_numero) && !isset($nt_anio) && !isset($desde) && !isset($hasta)
    ) {
        $sql_carta_fianza .= " ";
    } else {

        if (!empty($periodo)) {
            $sql_carta_fianza .= " AND cf.periodo='" . $periodo . "'";
        }

        if (!empty($entidad_financiera)) {
            $sql_carta_fianza .= " AND cf.entidad_financiera='" . $entidad_financiera . "'";
        }

        if (!empty($cf_numero)) {
            $sql_carta_fianza .= " AND cf.nro_carta_fianza like '%" . $cf_numero . "%'";
        }

        if (!empty($afianzador)) {
            $sql_carta_fianza .= " AND cf.afianzador='" . $afianzador . "'";
        }

        if (!empty($tipo_seleccion)) {
            $sql_carta_fianza .= " AND cf.tipo_seleccion='" . $tipo_seleccion . "'";
        }

        if (!empty($condicion)) {
            $sql_carta_fianza .= " AND cf.condicion='" . $condicion . "'";
        }

        if (!empty($observacion)) {
            $sql_carta_fianza .= " AND cf.observacion='" . $observacion . "'";
        }

        if (!empty($nt_numero)) {
            $sql_carta_fianza .= " AND cf.nt_nro like '%" . $nt_numero . "%'";
        }

        if (!empty($nt_anio)) {
            $sql_carta_fianza .= " AND cf.nt_anio='" . $nt_anio . "'";
        }


        if (!empty($desde) && !empty($hasta)) {
            $sql_carta_fianza .= " AND cf.fyh_creacion between '" . $desde . " 00:00:00" . "' and '" . $hasta . " 23:59:59" . "'";
        }




    }


    $query_carta_fianza = $pdo->prepare($sql_carta_fianza);
    $query_carta_fianza->execute();
    $carta_fianza_datos = $query_carta_fianza->fetchAll(PDO::FETCH_ASSOC);
}

if (!isset($carta_fianza_datos)) {
    $carta_fianza_datos = '';
} else {


    //libreria zip
    $zip = new ZipArchive(); 
    $zipFile = "Cartas Fianza ".date('d-m-Y').".zip"; //nombre del fichero zip

    if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {


        
        foreach ($carta_fianza_datos as $carta_fianza_dato) {
            $archivo = $carta_fianza_dato["archivo_pdf"];
            $ruta_archivo = "files/" . $archivo;

            $zip->addFile($ruta_archivo); // Agregar cada PDF al ZIP

        }

        $zip->close();
    }

    // Descargar el ZIP al navegador
    header("Content-Type: application/zip");
    header("Content-Disposition: attachment; filename=$zipFile");
    header("Content-Length: " . filesize($zipFile));
    readfile($zipFile); //lee y descarga el archivo
    unlink($zipFile); //borrar el archivo

}