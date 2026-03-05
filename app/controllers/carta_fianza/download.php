<?php
include ('../../config.php');


// Obtener el nombre del archivo desde la URL
$id_carta_fianza_get = $_GET['id'];

// Buscar el archivo en la base de datos
$sql_cf = "SELECT * FROM tb_cartas_fianza where id_carta_fianza= '$id_carta_fianza_get' ";
$query_cf = $pdo->prepare($sql_cf);
$query_cf->execute();
$cf_datos = $query_cf->fetchAll(PDO::FETCH_ASSOC);

foreach($cf_datos as $cf_dato){
    $archivo = $cf_dato["archivo_pdf"];
    $ruta_archivo = "files/" . $archivo;

    // Verificar que el archivo exista en el servidor
    if (file_exists($ruta_archivo)) {
        // Enviar el archivo al navegador

        //descargar archivo
        //header('Content-Type: application/octet-stream');
        //header('Content-Disposition: attachment; filename="' . $archivo . '"');
        
        //visualizar archivo online solo pdf
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . $archivo . '"');
        readfile($ruta_archivo);
    } else {
        echo "El archivo no existe en el servidor.";
    }
}

