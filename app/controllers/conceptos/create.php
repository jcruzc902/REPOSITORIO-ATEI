<?php

include('../../config.php');

$nombre_concepto = mb_strtoupper($_GET['nombre_concepto']);

$contador=0;
$sql_conceptos = "SELECT * FROM tb_conceptos where visible!=1 and id_concepto!=1";
$query_conceptos = $pdo->prepare($sql_conceptos);
$query_conceptos->execute();
$conceptos_datos = $query_conceptos->fetchAll(PDO::FETCH_ASSOC);

foreach($conceptos_datos as $conceptos_dato){
    if($conceptos_dato["nombre"]==$nombre_concepto){
        $contador=1;
    }
}

if($contador==1){
    session_start();
    $_SESSION['mensaje'] = "El nombre del concepto se ha registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href="<?php echo $URL; ?>/conceptos";
    </script>
    <?php
}else{
    $sentencia = $pdo->prepare("INSERT INTO tb_conceptos (nombre,fyh_creacion) 
    VALUES (:nombre,:fyh_creacion)");
    
    $sentencia->bindParam('nombre', $nombre_concepto);
    $sentencia->bindParam('fyh_creacion', $fechaHora);
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro el concepto de la manera correcta";
        $_SESSION['icono'] = "success";
        #header('Location: ' . $URL . '/categorias/');
        ?>
        <script>
            location.href="<?php echo $URL; ?>/conceptos";
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





