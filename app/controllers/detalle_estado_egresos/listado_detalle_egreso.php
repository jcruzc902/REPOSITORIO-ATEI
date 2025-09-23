<?php



if (
    isset($_SESSION['facultad']) && isset($_SESSION['actividad'])
     && isset($_SESSION['periodo']) && isset($_SESSION['id_egresos'])
) {
    $facultad = $_SESSION['facultad'];
    $actividad = $_SESSION['actividad'];
    $periodo = $_SESSION['periodo'];
    $id_egresos = $_SESSION['id_egresos'];
} else {
    $facultad = "";
    $actividad = "";
    $periodo = "";
    $id_egresos = "";
}

$sql_detalle_egresos = "SELECT *,
anio_nt.anio_nt as nt_anio,
usuario.nombres as nombre_usuario,
usuario.apaterno as apaterno_usuario,
usuario.amaterno as amaterno_usuario 
FROM tb_detalle_egresos as t_detalle 
LEFT JOIN tb_usuarios as usuario ON usuario.id_usuario= t_detalle.id_usuario 
LEFT JOIN tb_anio_nt as anio_nt ON anio_nt.id_anio_nt= t_detalle.id_anio_nt_principal 
WHERE t_detalle.visible!=1 AND t_detalle.id_egresos='$id_egresos' ORDER BY t_detalle.egresos ASC";
$query_detalle_egresos = $pdo->prepare($sql_detalle_egresos);
$query_detalle_egresos->execute();
$detalle_egresos_datos = $query_detalle_egresos->fetchAll(PDO::FETCH_ASSOC);