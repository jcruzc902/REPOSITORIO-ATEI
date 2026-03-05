<?php

include ('../../config.php');

$nombre_resolucion_rectoral = mb_strtoupper($_POST['nombre_resolucion_rectoral']);

$contador = 0;
$sql_resolucion = "SELECT * FROM tb_resoluciones_tyt where visible!=1 and id_resoluciones_tyt!=1";
$query_resolucion = $pdo->prepare($sql_resolucion);
$query_resolucion->execute();
$resolucion_datos = $query_resolucion->fetchAll(PDO::FETCH_ASSOC);



// Comprobar si se ha cargado un archivo
if (isset($_FILES['archivo'])) {
    extract($_POST);

    // Definir la carpeta de destino
    $carpeta_destino = "../detalle_tasas/files/";

    // Obtener el nombre y la extensión del archivo
    $nombre_archivo = basename($_FILES["archivo"]["name"]);
    $extension = strtolower(pathinfo($nombre_archivo, PATHINFO_EXTENSION));

    // Validar la extensión del archivo
    if ($extension == "pdf" || $extension == "PDF") {

        $nombre_archivo = mb_strtoupper($nombre_archivo); //convierte el nombre de archivo en mayusculas
        $nombre_archivo = str_replace('PDF','pdf',$nombre_archivo); //reemplaza PDF por pdf


        foreach ($resolucion_datos as $resolucion_dato) {
            if ($resolucion_dato["archivo"] == $nombre_archivo) {
                $contador = 1;
            }
        }

        if ($contador == 1) {
            session_start();
            $_SESSION['mensaje'] = "Este archivo ya ha sido registrado anteriormente";
            $_SESSION['icono'] = "error";
            #header('Location: ' . $URL . '/categorias/');
            ?>
            <script>
                location.href = "<?php echo $URL; ?>/resolucion_rectoral_tyt";
            </script>
            <?php
        } else {
            // Mover el archivo a la carpeta de destino
            if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $carpeta_destino . $nombre_archivo)) {


                // Insertar la información del archivo en la base de datos
                $sentencia = $pdo->prepare("INSERT INTO tb_resoluciones_tyt (nombre_resolucion_tyt,archivo) 
                VALUES (:nombre_resolucion_tyt,:archivo)");


                $sentencia->bindParam('nombre_resolucion_tyt', $nombre_resolucion_rectoral);
                $sentencia->bindParam('archivo', $nombre_archivo);
                if ($sentencia->execute()) {
                    session_start();
                    $_SESSION['mensaje'] = "Se registro la resolucion rectoral de la manera correcta";
                    $_SESSION['icono'] = "success";
                    #header('Location: ' . $URL . '/categorias/');
                    ?>
                    <script>
                        location.href = "<?php echo $URL; ?>/resolucion_rectoral_tyt";
                    </script>
                    <?php
                } else {
                    #echo "Error las contraseñas no son iguales";
                    session_start();
                    $_SESSION['mensaje'] = "Error no se pudo registrar en la base de datos";
                    $_SESSION['icono'] = "error";
                    #header('Location: ' . $URL . '/categorias');

                }



            } else {
                session_start();
                $_SESSION['mensaje'] = "Error al subir el archivo";
                $_SESSION['icono'] = "error";
                header('Location: ' . $URL . '/resolucion_rectoral_tyt');
            }
        }

    } else {
        session_start();
        $_SESSION['mensaje'] = "Error solo se permiten archivos PDF";
        $_SESSION['icono'] = "error";
        header('Location: ' . $URL . '/resolucion_rectoral_tyt');
    }
}





