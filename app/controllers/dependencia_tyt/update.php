<?php

include('../../config.php');

$nombre_dependencias_tyt = mb_strtoupper($_GET['nombre_dependencias_tyt']);
$codigo_facultad = mb_strtoupper($_GET['codigo_facultad']);
$id_dependencias_tyt = $_GET['id_dependencias_tyt'];

$sentencia = $pdo->prepare("UPDATE tb_dependencias_tyt SET 
nombre_dependencias_tyt=:nombre_dependencias_tyt, 
codigo_facultad=:codigo_facultad 
WHERE id_dependencias_tyt=:id_dependencias_tyt");

$sentencia->bindParam('nombre_dependencias_tyt', $nombre_dependencias_tyt);
$sentencia->bindParam('codigo_facultad', $codigo_facultad);
$sentencia->bindParam('id_dependencias_tyt', $id_dependencias_tyt);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo la dependencia de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/dependencia_tyt";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/dependencia_tyt";
    </script>
    <?php
}