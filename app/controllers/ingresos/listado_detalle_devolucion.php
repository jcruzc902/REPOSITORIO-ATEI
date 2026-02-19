<?php

$sql_detalle_devolucion = "SELECT *, 
t_detalle.nombre_solicitante as solicitante,
tip_documento.nombre_documento as tipo_identificacion,
empresa.razon_social as nombre_empresa,
empresa.ruc as nro_ruc,
banco.nombre_banco as nombre_banco,
concepto.nombre as nombre_concepto,
ciclo.ciclo as nombre_ciclo,
anio_concepto.anio_concepto as anio_de_concepto,
anio_siafdevolucion.anio_siaf as anio_siafdevolucion,
anio_siaforigen.anio_siaf as anio_siaforigen,
nrocuenta.nro_cuenta as numero_cuenta,
anio_nt.id_anio_nt as anio_idnt,
anio_nt.anio_nt as anio_numerotramite,
usuario.nombres as nombre_usuario,
usuario.apaterno as apaterno_usuario,
usuario.amaterno as amaterno_usuario,
t_detalle.fyh_creacion as fyh_creacion 
FROM tb_detalle_devolucion as t_detalle 
INNER JOIN tb_tipo_documento as tip_documento ON tip_documento.id_tipo_documento= t_detalle.id_tipo_documento 
INNER JOIN tb_empresas as empresa ON empresa.id_empresa = t_detalle.id_empresa 
INNER JOIN tb_bancos as banco ON banco.id_banco = t_detalle.id_banco 
INNER JOIN tb_conceptos as concepto ON concepto.id_concepto= t_detalle.id_concepto 
INNER JOIN tb_ciclos as ciclo ON ciclo.id_ciclo= t_detalle.id_ciclo_concepto 
INNER JOIN tb_anio_concepto as anio_concepto ON anio_concepto.id_anio_concepto= t_detalle.id_anio_concepto 
INNER JOIN tb_anio_siafdevolucion as anio_siafdevolucion ON anio_siafdevolucion.id_anio_siafdevolucion= t_detalle.id_anio_siaf_devolucion 
INNER JOIN tb_anio_siaforigen as anio_siaforigen ON anio_siaforigen.id_anio_siaforigen = t_detalle.id_anio_siaf_origen 
INNER JOIN tb_nrocuenta as nrocuenta ON nrocuenta.id_nrocuenta = t_detalle.id_nrocuenta
INNER JOIN tb_usuarios as usuario ON usuario.id_usuario= t_detalle.id_usuario 
INNER JOIN tb_anio_nt as anio_nt ON anio_nt.id_anio_nt= t_detalle.id_anio_nt 
WHERE t_detalle.visible!=1";
$query_detalle_devolucion = $pdo->prepare($sql_detalle_devolucion);
$query_detalle_devolucion->execute();
$detalle_devolucion_datos = $query_detalle_devolucion->fetchAll(PDO::FETCH_ASSOC);