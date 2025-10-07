<?php

include ('../../config.php');

$numero_cuenta = $_GET['numero_cuenta'];
$id_banco = $_GET['id_banco'];

$contador = 0;
$sql_cuenta = "SELECT * FROM tb_cuenta_tyt where visible!=1 and id_cuenta_tyt!=1";
$query_cuenta = $pdo->prepare($sql_cuenta);
$query_cuenta->execute();
$cuenta_datos = $query_cuenta->fetchAll(PDO::FETCH_ASSOC);

foreach ($cuenta_datos as $cuenta_dato) {
    if ($cuenta_dato["numero_cuenta_tyt"] == $numero_cuenta && $cuenta_dato["id_banco"] == $id_banco) {
        $contador = 1;
    }
}

if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "El numero de cuenta ya ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/cuenta_sb";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare("INSERT INTO tb_cuenta_tyt (numero_cuenta_tyt, id_banco) 
    VALUES (:numero_cuenta_tyt, :id_banco)");

    $sentencia->bindParam('numero_cuenta_tyt', $numero_cuenta);
    $sentencia->bindParam('id_banco', $id_banco);
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro el numero de cuenta de la manera correcta";
        $_SESSION['icono'] = "success";
        #header('Location: ' . $URL . '/categorias/');
        ?>
        <script>
            location.href = "<?php echo $URL; ?>/cuenta_sb";
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
