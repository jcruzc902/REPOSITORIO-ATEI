<?php


$id_ingresos = $_GET['id'];

$sql_conciliacion_bancaria = "SELECT *,
cb.fyh_creacion as fyh_creacion_cb, 
us.id_usuario as id_usuario,
us.nombres as nombres_usuario,
us.apaterno as apellido_paterno,
us.amaterno as apellido_materno 
FROM tb_conciliacion_bancaria as cb 
INNER JOIN tb_usuarios as us ON us.id_usuario= cb.id_usuario 
WHERE cb.visible!=1 AND cb.id_ingresos='$id_ingresos'";
$query_conciliacion_bancaria = $pdo->prepare($sql_conciliacion_bancaria);
$query_conciliacion_bancaria->execute();
$conciliacion_bancaria_datos = $query_conciliacion_bancaria->fetchAll(PDO::FETCH_ASSOC);

foreach ($conciliacion_bancaria_datos as $conciliacion_bancaria_dato) {
    $id_ingresos= $conciliacion_bancaria_dato["id_ingresos"];
    $mes_ingresos= $conciliacion_bancaria_dato["mes_ingresos"];
    $anio_ingresos= $conciliacion_bancaria_dato["anio_ingresos"];
    $fecha_ingresos= $conciliacion_bancaria_dato["fecha_ingresos"];
    $clasificador_ingresos= $conciliacion_bancaria_dato["clasificador_ingresos"];
    $importe_ingresos= $conciliacion_bancaria_dato["importe_ingresos"];
    $siic_ingresos= $conciliacion_bancaria_dato["siic_ingresos"];
    $siaf_ingresos= $conciliacion_bancaria_dato["siaf_ingresos"];
    $dependencia_ingresos= $conciliacion_bancaria_dato["dependencia_ingresos"];
    $detalle_ingresos= $conciliacion_bancaria_dato["detalle_ingresos"];
    $nro_recibo= $conciliacion_bancaria_dato["nro_recibo"];
    $banco_ingresos= $conciliacion_bancaria_dato["banco_ingresos"];
    $cta_ingresos= $conciliacion_bancaria_dato["cta_ingresos"];
    $nombre_ingresos= $conciliacion_bancaria_dato["nombre_ingresos"];
    $estado= $conciliacion_bancaria_dato["estado"];
    $id_usuario= $conciliacion_bancaria_dato["id_usuario"];
    $fyh_creacion= $conciliacion_bancaria_dato["fyh_creacion_cb"];
    $usuario= $conciliacion_bancaria_dato["nombres_usuario"]." ".$conciliacion_bancaria_dato["apellido_paterno"]." ".$conciliacion_bancaria_dato["apellido_materno"];


}
