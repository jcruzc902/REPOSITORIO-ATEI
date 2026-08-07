<?php

include('../../config.php');

$nombre_concepto = mb_strtoupper($_GET['nombre_concepto']);
$id_concepto_tyt = $_GET['id_concepto_tyt'];

$sentencia = $pdo->prepare("UPDATE tb_concepto_tyt SET 
nombre_concepto_tyt=:nombre_concepto_tyt 
WHERE id_concepto_tyt=:id_concepto_tyt");

$sentencia->bindParam('nombre_concepto_tyt', $nombre_concepto);
$sentencia->bindParam('id_concepto_tyt', $id_concepto_tyt);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo el concepto de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/concepto_tyt";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/concepto_tyt";
    </script>
    <?php
}