<?php
include ('../../config.php');


// Obtener el nombre del archivo desde la URL
$id_manual_get = $_GET['id'];

// Buscar el archivo en la base de datos
$sql_manual = "SELECT * FROM tb_manual where id_manual = '$id_manual_get' ";
$query_manual = $pdo->prepare($sql_manual);
$query_manual->execute();
$manual_datos = $query_manual->fetchAll(PDO::FETCH_ASSOC);

foreach($manual_datos as $manual_dato){
    $archivo = $manual_dato["archivo"];
    $ruta_archivo = "files/" . $archivo;

    // Verificar que el archivo exista en el servidor
    if (file_exists($ruta_archivo)) {
        // Enviar el archivo al navegador
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $archivo . '"');
        readfile($ruta_archivo);
    } else {
        echo "El archivo no existe en el servidor.";
    }
}

