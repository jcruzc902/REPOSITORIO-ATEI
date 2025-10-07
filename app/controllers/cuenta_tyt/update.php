<?php

include('../../config.php');

$numero_cuenta_tyt = $_GET['numero_cuenta_tyt'];
$id_banco = $_GET['id_banco'];
$id_cuenta_tyt = $_GET['id_cuenta_tyt'];

$sentencia = $pdo->prepare("UPDATE tb_cuenta_tyt SET 
numero_cuenta_tyt=:numero_cuenta_tyt, id_banco=:id_banco 
WHERE id_cuenta_tyt=:id_cuenta_tyt");

$sentencia->bindParam('numero_cuenta_tyt', $numero_cuenta_tyt);
$sentencia->bindParam('id_banco', $id_banco);
$sentencia->bindParam('id_cuenta_tyt', $id_cuenta_tyt);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo el numero de cuenta de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/cuenta_sb";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/cuenta_sb";
    </script>
    <?php
}