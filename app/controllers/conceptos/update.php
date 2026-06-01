<?php

include('../../config.php');

$nombre_concepto = mb_strtoupper($_GET['nombre_concepto']);
$id_concepto = $_GET['id_concepto'];

$sentencia = $pdo->prepare("UPDATE tb_conceptos SET 
nombre=:nombre,
fyh_actualizacion=:fyh_actualizacion
WHERE id_concepto=:id_concepto");

$sentencia->bindParam('nombre', $nombre_concepto);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_concepto', $id_concepto);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo el concepto de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/conceptos";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/conceptos";
    </script>
    <?php
}





