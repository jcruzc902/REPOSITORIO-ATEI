<?php

include ('../../config.php');

$nombre_afianzador = mb_strtoupper($_GET['nombre_afianzador']);
$ruc_entidad = $_GET['ruc_entidad'];
$estado = $_GET['estado'];
$direccion = $_GET['direccion'];
$departamento = $_GET['departamento'];


$contador = 0;
$sql_afianzador = "SELECT * FROM tb_afianzador_cf where id_afianzador_cf!=1 and visible!=1";
$query_afianzador = $pdo->prepare($sql_afianzador);
$query_afianzador->execute();
$afianzador_datos = $query_afianzador->fetchAll(PDO::FETCH_ASSOC);

foreach ($afianzador_datos as $afianzador_dato) {
    if ($afianzador_dato["ruc"] == $ruc_entidad) {
        $contador = 1;
    }
}

if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "Este RUC ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/afianzador";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare("INSERT INTO tb_afianzador_cf (nombre_afianzador,ruc,estado,direccion,departamento,fyh_creacion) 
    VALUES (:nombre_afianzador,:ruc,:estado,:direccion,:departamento,:fyh_creacion)");

    $sentencia->bindParam('nombre_afianzador', $nombre_afianzador);
    $sentencia->bindParam('ruc', $ruc_entidad);
    $sentencia->bindParam('estado', $estado);
    $sentencia->bindParam('direccion', $direccion);
    $sentencia->bindParam('departamento', $departamento);
    $sentencia->bindParam('fyh_creacion', $fechaHora);

    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro el afianzador de la manera correcta";
        $_SESSION['icono'] = "success";
        #header('Location: ' . $URL . '/categorias/');
        ?>
        <script>
            location.href = "<?php echo $URL; ?>/afianzador";
        </script>
        <?php
    } else {
        #echo "Error las contraseñas no son iguales";
        session_start();
        $_SESSION['mensaje'] = "Error no se pudo registrar en la base de datos";
        $_SESSION['icono'] = "error";
        #header('Location: ' . $URL . '/categorias');

        

    }

}





