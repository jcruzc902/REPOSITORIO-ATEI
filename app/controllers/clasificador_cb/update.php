<?php

include('../../config.php');

$clasificador_cb = mb_strtoupper($_GET['clasificador_cb']);
$descripcion_cb = mb_strtoupper($_GET['descripcion_cb']);
$id_clasificador = $_GET['id_clasificador'];

$sentencia = $pdo->prepare("UPDATE tb_clasificador_cb SET 
clasificador_cb=:clasificador_cb,
descripcion_cb=:descripcion_cb,
fyh_actualizacion=:fyh_actualizacion
WHERE id_clasificador=:id_clasificador");

$sentencia->bindParam('clasificador_cb', $clasificador_cb);
$sentencia->bindParam('descripcion_cb', $descripcion_cb);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_clasificador', $id_clasificador);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo el clasificador de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/clasificador_cb";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/clasificador_cb";
    </script>
    <?php
}





