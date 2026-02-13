<?php
include ('../../config.php');


// Obtener el nombre del archivo desde la URL
$id_resolucion_rectoral_get = $_GET['id'];

// Buscar el archivo en la base de datos
$sql_resolucion_rectoral = "SELECT * FROM tb_resoluciones_tyt where id_resoluciones_tyt = '$id_resolucion_rectoral_get' ";
$query_resolucion_rectoral = $pdo->prepare($sql_resolucion_rectoral);
$query_resolucion_rectoral->execute();
$resolucion_rectoral_datos = $query_resolucion_rectoral->fetchAll(PDO::FETCH_ASSOC);

foreach($resolucion_rectoral_datos as $resolucion_rectoral_dato){
    $archivo = $resolucion_rectoral_dato["archivo"];
    $ruta_archivo = "../detalle_tasas/files/" . $archivo;

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

