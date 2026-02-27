<?php

include('../../config.php');

$nombre_modalidad = mb_strtoupper($_GET['nombre_modalidad']);
$id_modalidad_tyt = $_GET['id_modalidad_tyt'];

$sentencia = $pdo->prepare("UPDATE tb_modalidad_tyt SET 
nombre_modalidad=:nombre_modalidad 
WHERE id_modalidad_tyt=:id_modalidad_tyt");

$sentencia->bindParam('nombre_modalidad', $nombre_modalidad);
$sentencia->bindParam('id_modalidad_tyt', $id_modalidad_tyt);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo la modalidad de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/modalidad_tyt";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/modalidad_tyt";
    </script>
    <?php
}