<?php

include ('../../config.php');

$nombre_empresa = mb_strtoupper($_GET['nombre_empresa']);
$ruc_empresa = $_GET['ruc_empresa'];

$contador = 0;
$sql_empresas = "SELECT * FROM tb_empresas where id_empresa!=1 and visible!=1";
$query_empresas = $pdo->prepare($sql_empresas);
$query_empresas->execute();
$empresas_datos = $query_empresas->fetchAll(PDO::FETCH_ASSOC);

foreach ($empresas_datos as $empresas_dato) {
    if ($empresas_dato["ruc"] == $ruc_empresa) {
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
        location.href = "<?php echo $URL; ?>/empresas";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare("INSERT INTO tb_empresas (razon_social,ruc,fyh_creacion) 
    VALUES (:razon_social,:ruc,:fyh_creacion)");

    $sentencia->bindParam('razon_social', $nombre_empresa);
    $sentencia->bindParam('ruc', $ruc_empresa);
    $sentencia->bindParam('fyh_creacion', $fechaHora);

    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro la empresa de la manera correcta";
        $_SESSION['icono'] = "success";
        #header('Location: ' . $URL . '/categorias/');
        ?>
        <script>
            location.href = "<?php echo $URL; ?>/empresas";
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





