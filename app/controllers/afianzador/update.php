<?php

include('../../config.php');

$nombre_afianzador = mb_strtoupper($_GET['nombre_afianzador']);
$ruc_entidad = $_GET['ruc_entidad'];
$estado = $_GET['estado'];
$direccion = $_GET['direccion'];
$departamento = $_GET['departamento'];
$id_afianzador_cf = $_GET['id_afianzador_cf'];

$sentencia = $pdo->prepare("UPDATE tb_afianzador_cf SET 
nombre_afianzador=:nombre_afianzador,
ruc=:ruc,
estado=:estado,
direccion=:direccion,
departamento=:departamento,
fyh_actualizacion=:fyh_actualizacion
WHERE id_afianzador_cf=:id_afianzador_cf");

$sentencia->bindParam('nombre_afianzador', $nombre_afianzador);
$sentencia->bindParam('ruc', $ruc_entidad);
$sentencia->bindParam('estado', $estado);
$sentencia->bindParam('direccion', $direccion);
$sentencia->bindParam('departamento', $departamento);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_afianzador_cf', $id_afianzador_cf);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo el afianzador de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/afianzador";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/afianzador";
    </script>
    <?php
}





