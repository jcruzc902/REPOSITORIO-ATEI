<?php

include ('../../config.php');

$nombre_manual = mb_strtoupper($_POST['nombre_manual']);

// Comprobar si se ha cargado un archivo
if (isset($_FILES['archivo'])) {
    extract($_POST);

    // Definir la carpeta de destino
    $carpeta_destino = "files/";

    // Obtener el nombre y la extensión del archivo
    $nombre_archivo = basename($_FILES["archivo"]["name"]);
    $extension = strtolower(pathinfo($nombre_archivo, PATHINFO_EXTENSION));

    // Validar la extensión del archivo
    if ($extension == "pdf" || $extension == "PDF") {


        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $carpeta_destino . $nombre_archivo)) {


            // Insertar la información del archivo en la base de datos
            $sentencia = $pdo->prepare("INSERT INTO tb_manual (nombre_manual,archivo,fyh_creacion) 
            VALUES (:nombre_manual,:archivo,:fyh_creacion)");

            $sentencia->bindParam('nombre_manual', $nombre_manual);
            $sentencia->bindParam('archivo', $nombre_archivo);
            $sentencia->bindParam('fyh_creacion', $fechaHora);
            if ($sentencia->execute()) {
                session_start();
                $_SESSION['mensaje'] = "Se registro el manual de la manera correcta";
                $_SESSION['icono'] = "success";
                #header('Location: ' . $URL . '/categorias/');
                ?>
                <script>
                    location.href = "<?php echo $URL; ?>/manual";
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
            header('Location: ' . $URL . '/manual');
        }
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error solo se permiten archivos PDF";
        $_SESSION['icono'] = "error";
        header('Location: ' . $URL . '/manual');
    }
}





