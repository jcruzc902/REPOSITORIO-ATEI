<?php
include ('../../config.php');


// Obtener el nombre del archivo desde la URL
$id_tasas_tarifas_get = $_GET['id'];

// Buscar el archivo en la base de datos
$sql_tasas_tarifas = "SELECT * FROM tb_tasas_tarifas where id_tasas_tarifas = '$id_tasas_tarifas_get' ";
$query_tasas_tarifas = $pdo->prepare($sql_tasas_tarifas);
$query_tasas_tarifas->execute();
$tasas_tarifas_datos = $query_tasas_tarifas->fetchAll(PDO::FETCH_ASSOC);

foreach($tasas_tarifas_datos as $tasas_tarifas_dato){
    $archivo = $tasas_tarifas_dato["archivo_resolucion"];
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

