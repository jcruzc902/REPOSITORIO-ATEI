<?php

include('../../config.php');

$nombre_banco = mb_strtoupper($_GET['nombre_banco']);
$id_banco_ingreso = $_GET['id_banco_ingreso'];

$sentencia = $pdo->prepare("UPDATE tb_banco_ingresos SET 
nombre_banco=:nombre_banco 
WHERE id_banco_ingreso=:id_banco_ingreso");

$sentencia->bindParam('nombre_banco', $nombre_banco);
$sentencia->bindParam('id_banco_ingreso', $id_banco_ingreso);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo el nombre del banco de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/banco_ingresos";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/banco_ingresos";
    </script>
    <?php
}