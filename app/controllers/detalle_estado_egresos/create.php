<?php

include('../../config.php');

$facultad = $_POST['facultad'];
$actividad = $_POST['actividad'];
$subactividad = $_POST['subactividad'];

if($subactividad==null){
    $subactividad="";
}

$saldo_inicial = $_POST['saldo_inicial'];
$periodo_anio = $_POST['periodo'];
$nt_principal = $_POST['nt_principal'];
$anio_nt_principal = $_POST['anio_nt_principal'];
$nt_expediente = $_POST['nt_expediente'];
$anio_nt_expediente = $_POST['anio_nt_expediente'];
$proveido_contabilidad = $_POST['proveido_contabilidad'];
//$fecha_proveido_contabilidad = $_POST['fecha_proveido_contabilidad'];
$proveido_diga = $_POST['proveido_diga'];
//$fecha_proveido_diga = $_POST['fecha_proveido_diga'];
$oficio_oclsa_orh = $_POST['oficio_oclsa_orh'];
//$fecha_oclsa_orh = $_POST['fecha_oclsa_orh'];
$resolucion = $_POST['resolucion'];
$fecha_resolucion = $_POST['fecha_resolucion'];
$especialidad = mb_strtoupper($_POST['especialidad']);
$numero_comprobante= $_POST['numero_comprobante'];
$orden_compra = $_POST['orden_compra'];
$orden_servicio = $_POST['orden_servicio'];
$siaf = $_POST['siaf'];
$monto = $_POST['monto'];
$egresos = $_POST['egresos'];
$saldo_ingresos = $_POST['saldo_ingresos'];
$nota_pago = $_POST['nota_pago'];
$fecha_giro = $_POST['fecha_giro'];
$estado_giro = $_POST['estado_giro'];
$observacion_giro= $_POST['observacion_giro'];
$fecha_pago = $_POST['fecha_pago'];
$informe_ingreso = $_POST['informe_ingreso'];
$fecha_informe_ingreso = $_POST['fecha_informe_ingreso'];
$documento_pago = mb_strtoupper($_POST['documento_pago']);
$fecha_documento = $_POST['fecha_documento'];
$tipo_pago = mb_strtoupper($_POST['tipo_pago']);
$detalle_pago = $_POST['detalle_pago'];
$periodo_pago = mb_strtoupper($_POST['periodo_pago']);
$informe = $_POST['informe'];
$fecha_informe = $_POST['fecha_informe'];
$asunto_informe_egreso = $_POST['asunto_informe_egreso'];
$descripcion = $_POST['descripcion'];
$numero_estado_cuenta = $_POST['numero_estado_cuenta'];
$fecha_estado_cuenta = $_POST['fecha_estado_cuenta'];
$asunto_estado_cuenta = $_POST['asunto_estado_cuenta'];
$descripcion_ec = $_POST['descripcion_ec'];
$id_egresos = $_POST['id_egresos'];
$usuario = $_POST['id_usuario'];
$visible = 0;

if (isset($_POST['informe_egresos'])) {
    $checkbox_informe_egresos = "YES";
} else {
    $checkbox_informe_egresos = "NO";
}

if (isset($_POST['estado_cuenta'])) {
    $checkbox_estado_cuenta = "YES";
} else {
    $checkbox_estado_cuenta = "NO";
}

$contador = 0;
$sql_detalle_egresos = "SELECT * FROM tb_detalle_egresos where siaf!=null AND visible!=1";
$query_detalle_egresos = $pdo->prepare($sql_detalle_egresos);
$query_detalle_egresos->execute();
$detalle_egresos_datos = $query_detalle_egresos->fetchAll(PDO::FETCH_ASSOC);

foreach ($detalle_egresos_datos as $detalle_egresos_dato) {
    if ($detalle_egresos_dato["siaf"] == $siaf) {
        $contador = 1;
    }

}



function conexion()
{

    try {
        $conn = new PDO('mysql:host=localhost;dbname=aplicativo_tesoreria_interno', 'root', 'Huaweiy635@25');
    } catch (PDOException $e) {
        echo "Error " . $e;
    }

    return $conn;
}
//-------------------------------------------------------------------------------------------------------


$con = conexion();

$total_egresos_acumulado = current($con->query("SELECT MAX(egresos) as maximo_egresos FROM tb_detalle_egresos WHERE facultad='$facultad' AND actividad_principal='$actividad' AND subactividad='$subactividad' AND estado_giro='APROBADO' AND visible!=1")->fetch());


if ($total_egresos_acumulado == null) {
    $total_egresos_acumulado = 0;
}

//-------------------------------------------------------------------------------------------------------





if ($estado_giro == "APROBADO" && $egresos==0) { //si egresos es igual a cero o vacio
    $egresos = $total_egresos_acumulado + $_POST['monto']; //aumenta egresos
    $saldo_ingresos = $saldo_inicial - $egresos; //disminuye ingresos
}else if($estado_giro=="APROBADO" && $egresos!=0){ //si egresos es diferente de vacio
    $egresos = $_POST['egresos'] + $_POST['monto']; //aumenta egresos
    $saldo_ingresos = $saldo_inicial - $egresos; //disminuye ingresos
} 

if($estado_giro=="PENDIENTE" || $estado_giro=="SELECCIONAR"){
    $egresos = $_POST['egresos']; //mantiene el anterior egresos
    $saldo_ingresos = $saldo_inicial - $egresos; //disminuye ingresos
}


if($estado_giro=="ANULADO"){
    $monto= $_POST['monto'];
    $egresos = 0; //mantiene el anterior egresos
    $saldo_ingresos = 0; //disminuye ingresos
}


if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "El detalle de este estado de egreso ya ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/detalle_estado_egresos/create.php";
    </script>
    <?php
} else {


    $sentencia = $pdo->prepare("INSERT INTO tb_detalle_egresos (nt_principal,id_anio_nt_principal,nt_expediente,id_anio_nt_expediente,proveido_contabilidad,proveido_diga,oficio,
        resolucion,fecha_resolucion,especialidad,numero_comprobante,n_oc,n_os,siaf,monto,egresos,ingresos,nota_pago,fecha_giro,estado_giro,observacion_giro,fecha_pago,informe_ingreso,fecha_informe_ingreso,documento,fecha_documento,tipo_pago,detalle_pago,periodo_pago,
        checkbox_informe,informe,fecha_informe,asunto_informe,descripcion_informe,checkbox_ec,numero_ec,fecha_ec,asunto_ec,descripcion_ec,facultad,actividad_principal,subactividad,saldo_inicial,periodo_anio,visible,id_egresos,id_usuario,fyh_creacion) 
        VALUES (:nt_principal,:id_anio_nt_principal,:nt_expediente,:id_anio_nt_expediente,:proveido_contabilidad,:proveido_diga,:oficio,:resolucion,:fecha_resolucion,:especialidad,:numero_comprobante,:n_oc,:n_os,
        :siaf,:monto,:egresos,:ingresos,:nota_pago,:fecha_giro,:estado_giro,:observacion_giro,:fecha_pago,:informe_ingreso,:fecha_informe_ingreso,:documento,:fecha_documento,:tipo_pago,:detalle_pago,:periodo_pago,
        :checkbox_informe,:informe,:fecha_informe,:asunto_informe,:descripcion_informe,:checkbox_ec,:numero_ec,:fecha_ec,:asunto_ec,:descripcion_ec,:facultad,:actividad_principal,:subactividad,:saldo_inicial,:periodo_anio,:visible,:id_egresos,:id_usuario,:fyh_creacion)");

    $sentencia->bindParam('nt_principal', $nt_principal);
    $sentencia->bindParam('id_anio_nt_principal', $anio_nt_principal);
    $sentencia->bindParam('nt_expediente', $nt_expediente);
    $sentencia->bindParam('id_anio_nt_expediente', $anio_nt_expediente);
    $sentencia->bindParam('proveido_contabilidad', $proveido_contabilidad);
    //$sentencia->bindParam('fecha_contabilidad', $fecha_proveido_contabilidad);
    $sentencia->bindParam('proveido_diga', $proveido_diga);
    //$sentencia->bindParam('fecha_diga', $fecha_proveido_diga);
    $sentencia->bindParam('oficio', $oficio_oclsa_orh);
    //$sentencia->bindParam('fecha_oficio', $fecha_oclsa_orh);
    $sentencia->bindParam('resolucion', $resolucion);
    $sentencia->bindParam('fecha_resolucion', $fecha_resolucion);
    $sentencia->bindParam('especialidad', $especialidad);
    $sentencia->bindParam('numero_comprobante', $numero_comprobante);
    $sentencia->bindParam('n_oc', $orden_compra); 
    $sentencia->bindParam('n_os', $orden_servicio);
    $sentencia->bindParam('siaf', $siaf);
    $sentencia->bindParam('monto', $monto);
    $sentencia->bindParam('egresos', $egresos);
    $sentencia->bindParam('ingresos', $saldo_ingresos);
    $sentencia->bindParam('nota_pago', $nota_pago);
    $sentencia->bindParam('fecha_giro', $fecha_giro);
    $sentencia->bindParam('estado_giro', $estado_giro);
    $sentencia->bindParam('observacion_giro', $observacion_giro);
    $sentencia->bindParam('fecha_pago', $fecha_pago);
    $sentencia->bindParam('informe_ingreso', $informe_ingreso);
    $sentencia->bindParam('fecha_informe_ingreso', $fecha_informe_ingreso);
    $sentencia->bindParam('documento', $documento_pago);
    $sentencia->bindParam('fecha_documento', $fecha_documento);
    $sentencia->bindParam('tipo_pago', $tipo_pago);
    $sentencia->bindParam('detalle_pago', $detalle_pago);
    $sentencia->bindParam('periodo_pago', $periodo_pago);
    $sentencia->bindParam('checkbox_informe', $checkbox_informe_egresos);
    $sentencia->bindParam('informe', $informe);
    $sentencia->bindParam('fecha_informe', $fecha_informe);
    $sentencia->bindParam('asunto_informe', $asunto_informe_egreso);
    $sentencia->bindParam('descripcion_informe', $descripcion);
    $sentencia->bindParam('checkbox_ec', $checkbox_estado_cuenta);
    $sentencia->bindParam('numero_ec', $numero_estado_cuenta);
    $sentencia->bindParam('fecha_ec', $fecha_estado_cuenta);
    $sentencia->bindParam('asunto_ec', $asunto_estado_cuenta);
    $sentencia->bindParam('descripcion_ec', $descripcion_ec);
    $sentencia->bindParam('facultad', $facultad);
    $sentencia->bindParam('actividad_principal', $actividad);
    $sentencia->bindParam('subactividad', $subactividad);
    $sentencia->bindParam('saldo_inicial', $saldo_inicial);
    $sentencia->bindParam('periodo_anio', $periodo_anio);
    $sentencia->bindParam('visible', $visible);
    $sentencia->bindParam('id_egresos', $id_egresos);
    $sentencia->bindParam('id_usuario', $usuario);
    $sentencia->bindParam('fyh_creacion', $fechaHora);


    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro el detalle del estado de egreso de la manera correcta";
        $_SESSION['icono'] = "success";
        #header('Location: ' . $URL . '/categorias/');
        ?>
        <script>
            location.href = "<?php echo $URL; ?>/detalle_estado_egresos";
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
