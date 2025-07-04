<?php
/**
 
 * Date: 29/1/2023
 * Time: 22:50
 */


include('../../config.php');


$nombre_cargo = $_POST['nombre_cargo'];
$nombre_actividad_principal = $_POST['nombre_actividad_principal'];
$saldo_inicial= $_POST['saldo_inicial'];
$anio_periodo = $_POST['anio_periodo'];
$id_usuario = $_POST['id_usuario'];
$id_estado = $_POST['id_estado'];
$contador = 0;
$visible = 0;

$sql_egreso = "SELECT * FROM tb_egresos where visible!=1";
$query_egreso = $pdo->prepare($sql_egreso);
$query_egreso->execute();
$egreso_datos = $query_egreso->fetchAll(PDO::FETCH_ASSOC);

foreach ($egreso_datos as $egreso_dato) {
    if (
        ($egreso_dato["cargo_facultad"] == $_POST['nombre_cargo']) && ($egreso_dato["actividad_principal"] == $_POST['nombre_actividad_principal'])
         && ($egreso_dato["anio"] == $_POST['anio_periodo'])
    ) {
        $contador = 1;
    }
}



if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "El estado de egresos ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/estado_egresos/create.php";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare('INSERT INTO tb_egresos(cargo_facultad,actividad_principal,saldo_inicial,anio,
    visible,id_estado,id_usuario,fyh_creacion) VALUES (:cargo_facultad,:actividad_principal,
    :saldo_inicial,:anio,:visible,:id_estado,:id_usuario,:fyh_creacion)');

    $sentencia->bindParam('cargo_facultad', $nombre_cargo);
    $sentencia->bindParam('actividad_principal', $nombre_actividad_principal);
    $sentencia->bindParam('saldo_inicial', $saldo_inicial);
    $sentencia->bindParam('anio', $anio_periodo);
    $sentencia->bindParam('visible', $visible);
    $sentencia->bindParam('id_estado', $id_estado);
    $sentencia->bindParam('id_usuario', $id_usuario);
    $sentencia->bindParam('fyh_creacion', $fechaHora);
    $sentencia->execute();

    session_start();
    $_SESSION['mensaje'] = "Se registro el estado de egresos de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/estado_egresos/');

}