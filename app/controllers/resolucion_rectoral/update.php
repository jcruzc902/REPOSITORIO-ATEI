<?php

include ('../../config.php');

$id_resoluciones_tyt = $_POST['id_resoluciones_tyt'];
$nombre_resolucion_tyt = $_POST['nombre_resolucion_tyt'];

// Comprobar si se ha cargado un archivo
if ($_FILES["archivo"]["name"] == null) {

    // Insertar la información del archivo en la base de datos
    $sentencia = $pdo->prepare("UPDATE tb_resoluciones_tyt 
    SET nombre_resolucion_tyt=:nombre_resolucion_tyt WHERE id_resoluciones_tyt=:id_resoluciones_tyt");

    $sentencia->bindParam('nombre_resolucion_tyt', $nombre_resolucion_tyt);
    $sentencia->bindParam('id_resoluciones_tyt', $id_resoluciones_tyt);
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se actualizo la resolucion rectoral de la manera correcta";
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
    // Definir la carpeta de destino
    $carpeta_destino = "../detalle_tasas/files/";

    // Obtener el nombre y la extensión del archivo
    $nombre_archivo = basename($_FILES["archivo"]["name"]);
    $extension = strtolower(pathinfo($nombre_archivo, PATHINFO_EXTENSION));

    // Validar la extensión del archivo
    if ($extension == "pdf" || $extension == "PDF") {


        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $carpeta_destino . $nombre_archivo)) {


            // Insertar la información del archivo en la base de datos
            $sentencia = $pdo->prepare("UPDATE tb_resoluciones_tyt SET 
            nombre_resolucion_tyt=:nombre_resolucion_tyt,
            archivo=:archivo 
            WHERE id_resoluciones_tyt=:id_resoluciones_tyt");

            $sentencia->bindParam('nombre_resolucion_tyt', $nombre_resolucion_tyt);
            $sentencia->bindParam('archivo', $nombre_archivo);
            $sentencia->bindParam('id_resoluciones_tyt', $id_resoluciones_tyt);
            if ($sentencia->execute()) {
                session_start();
                $_SESSION['mensaje'] = "Se actualizo la resolucion rectoral de la manera correcta";
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
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error solo se permiten archivos PDF";
        $_SESSION['icono'] = "error";
        header('Location: ' . $URL . '/resolucion_rectoral_tyt');
    }
}





