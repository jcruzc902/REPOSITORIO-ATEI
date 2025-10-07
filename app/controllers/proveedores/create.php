<?php

include ('../../config.php');

$nombre_proveedor = mb_strtoupper($_GET['nombre_proveedor']);

$contador = 0;
$sql_proveedor = "SELECT * FROM tb_proveedor_cf where visible!=1 and id_proveedor_cf!=1";
$query_proveedor = $pdo->prepare($sql_proveedor);
$query_proveedor->execute();
$proveedor_datos = $query_proveedor->fetchAll(PDO::FETCH_ASSOC);

foreach ($proveedor_datos as $proveedor_dato) {
    if ($proveedor_dato["nombre_proveedor"] == $nombre_proveedor) {
        $contador = 1;
    }
}

if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "El nombre de proveedor ya ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/proveedores";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare("INSERT INTO tb_proveedor_cf (nombre_proveedor) 
    VALUES (:nombre_proveedor)");

    $sentencia->bindParam('nombre_proveedor', $nombre_proveedor);
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro el proveedor de la manera correcta";
        $_SESSION['icono'] = "success";
        #header('Location: ' . $URL . '/categorias/');
        ?>
        <script>
            location.href = "<?php echo $URL; ?>/proveedores";
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
