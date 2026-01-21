<?php

include('../../config.php');

$nombre_entidad = mb_strtoupper($_GET['nombre_entidad']);
$ruc_entidad = $_GET['ruc_entidad'];
$estado = $_GET['estado'];
$direccion = $_GET['direccion'];
$departamento = $_GET['departamento'];
$id_entidad_cf = $_GET['id_entidad_cf'];

$sentencia = $pdo->prepare("UPDATE tb_entidad_cf SET 
nombre_entidad=:nombre_entidad,
ruc=:ruc,
estado=:estado,
direccion=:direccion,
departamento=:departamento,
fyh_actualizacion=:fyh_actualizacion
WHERE id_entidad_cf=:id_entidad_cf");

$sentencia->bindParam('nombre_entidad', $nombre_entidad);
$sentencia->bindParam('ruc', $ruc_entidad);
$sentencia->bindParam('estado', $estado);
$sentencia->bindParam('direccion', $direccion);
$sentencia->bindParam('departamento', $departamento);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_entidad_cf', $id_entidad_cf);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo la entidad de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/entidades";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/entidades";
    </script>
    <?php
}





