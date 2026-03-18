<?php

include('../../config.php');

$numero_cta_cb = $_GET['numero_cta_cb'];
$id_banco = $_GET['id_banco'];
$id_cta_cb = $_GET['id_cta_cb'];

$sentencia = $pdo->prepare("UPDATE tb_cta_cb SET 
numero_cta=:numero_cta, id_banco=:id_banco 
WHERE id_cta=:id_cta");

$sentencia->bindParam('numero_cta', $numero_cta_cb);
$sentencia->bindParam('id_banco', $id_banco);
$sentencia->bindParam('id_cta', $id_cta_cb);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo el numero de cuenta de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/cuenta_cb";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/cuenta_cb";
    </script>
    <?php
}