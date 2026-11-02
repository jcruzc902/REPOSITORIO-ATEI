<?php
/**

 * Date: 29/1/2023
 * Time: 22:50
 */


include('../../config.php');

$mes = $_POST['mes'];
$anio = $_POST['anio'];
$fecha = $_POST['fecha'];
$clasificador = $_POST['clasificador'];
$importe = $_POST['importe'];
$importe= str_replace(",","",$importe); //reemplazo la coma por vacio
$importe= str_replace("'","",$importe); //reemplaza el millar por vacio
$importe = floatval($importe);
$importe = number_format($importe, 2, '.', ''); //convertir int a decimal
$siic = $_POST['siic'];
$siaf = $_POST['siaf'];
$dependencia = $_POST['dependencia'];
$detalle = $_POST['detalle'];
$nro_recibo = $_POST['nro_recibo'];
$banco = $_POST['banco'];
$cuenta = $_POST['cuenta'];
$nombre = $_POST['nombre'];
$estado = $_POST['estado'];
$id_usuario = $_POST['id_usuario'];

$contador = 0;


$sql_conciliacion_bancaria = "SELECT * FROM tb_conciliacion_bancaria where visible!=1";
$query_conciliacion = $pdo->prepare($sql_conciliacion_bancaria);
$query_conciliacion->execute();
$conciliacion_datos = $query_conciliacion->fetchAll(PDO::FETCH_ASSOC);

foreach ($conciliacion_datos as $conciliacion_dato) {
    if (($conciliacion_dato["clasificador_ingresos"] == $clasificador) && ($conciliacion_dato["siaf_ingresos"] == $siaf) 
        && ($conciliacion_dato["dependencia_ingresos"] == $dependencia) && ($conciliacion_dato["importe_ingresos"] == $importe)) {
        
        $contador = 1;
    }
}


if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "Este ingreso ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/conciliacion_bancaria/create.php";
    </script>
    <?php
} else {

    $visible = 0;


    $sentencia = $pdo->prepare('INSERT INTO tb_conciliacion_bancaria(mes_ingresos,anio_ingresos,fecha_ingresos,clasificador_ingresos,
    importe_ingresos,siic_ingresos,siaf_ingresos,dependencia_ingresos,detalle_ingresos,nro_recibo,banco_ingresos,cta_ingresos,nombre_ingresos,estado,id_usuario,fyh_creacion) 
    VALUES (:mes_ingresos,:anio_ingresos,:fecha_ingresos,:clasificador_ingresos,:importe_ingresos,:siic_ingresos,:siaf_ingresos,:dependencia_ingresos,
    :detalle_ingresos,:nro_recibo,:banco_ingresos,:cta_ingresos,:nombre_ingresos,:estado,:id_usuario,:fyh_creacion)');


    $sentencia->bindParam('mes_ingresos', $mes);
    $sentencia->bindParam('anio_ingresos', $anio);
    $sentencia->bindParam('fecha_ingresos', $fecha);
    $sentencia->bindParam('clasificador_ingresos', $clasificador);
    $sentencia->bindParam('importe_ingresos', $importe);
    $sentencia->bindParam('siic_ingresos', $siic);
    $sentencia->bindParam('siaf_ingresos', $siaf);
    $sentencia->bindParam('dependencia_ingresos', $dependencia);
    $sentencia->bindParam('detalle_ingresos', $detalle);
    $sentencia->bindParam('nro_recibo', $nro_recibo);
    $sentencia->bindParam('banco_ingresos', $banco);
    $sentencia->bindParam('cta_ingresos', $cuenta);
    $sentencia->bindParam('nombre_ingresos', $nombre);
    $sentencia->bindParam('estado', $estado);
    $sentencia->bindParam('id_usuario', $id_usuario);
    $sentencia->bindParam('fyh_creacion', $fechaHora);
    $sentencia->execute();


    session_start();
    $_SESSION['mensaje'] = "Se registro el ingreso de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/conciliacion_bancaria/');

}