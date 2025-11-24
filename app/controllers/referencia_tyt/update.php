<?php

include('../../config.php');

$nombre_referencia = mb_strtoupper($_GET['nombre_referencia']);
$id_referencia_tyt = $_GET['id_referencia_tyt'];

$sentencia = $pdo->prepare("UPDATE tb_referencias_tyt SET 
nombre_referencia=:nombre_referencia 
WHERE id_referencia_tyt=:id_referencia_tyt");

$sentencia->bindParam('nombre_referencia', $nombre_referencia);
$sentencia->bindParam('id_referencia_tyt', $id_referencia_tyt);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo la referencia de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/referencia_tyt";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/referencia_tyt";
    </script>
    <?php
}