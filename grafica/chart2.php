<?php
$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {
	include ("conexion.php");//Contiene los datos de conexion a la base de datos
	$periodo2 = intval($_REQUEST['periodo2']);
	$txt_mes = array(
		"1" => "Ene",
		"2" => "Feb",
		"3" => "Mar",
		"4" => "Abr",
		"5" => "May",
		"6" => "Jun",
		"7" => "Jul",
		"8" => "Ago",
		"9" => "Sep",
		"10" => "Oct",
		"11" => "Nov",
		"12" => "Dic"
	);//Arreglo que contiene las abreviaturas de los meses del año

	function cantidad($table, $mes, $periodo2)
	{
		global $con;
		$fecha_inicial = "$periodo2-$mes-1";
		if ($mes == 1 or $mes == 3 or $mes == 5 or $mes == 7 or $mes == 8 or $mes == 10 or $mes == 12) {
			$dia_fin = 31;
		} else if ($mes == 2) {
			if ($periodo2 % 4 == 0) {
				$dia_fin = 29;
			} else {
				$dia_fin = 28;
			}
		} else {
			$dia_fin = 30;
		}
		$fecha_final = "$periodo2-$mes-$dia_fin";

		$query = mysqli_query($con, "select count(*) as cantidad from $table where fyh_creacion between '$fecha_inicial' and '$fecha_final'");
		$row = mysqli_fetch_array($query);
		$cantidad = floatval($row['cantidad']);
		return $cantidad;
	}

	$categorias[] = array('Mes', "300152 - $periodo2 ");//Nombre de la primera y segunda fila del grafico
	for ($inicio = 1; $inicio <= 12; $inicio++) {
		$mes = $txt_mes[$inicio];//Obtengo la abreviatura del mes
		//$cuenta1 = cantidad('cuenta_257443', $inicio, $periodo2);//Obtengo el  cantidad de vista_cuenta1
		$cuenta2 = cantidad('cuenta_300152', $inicio, $periodo2);//Obtengo el cantidad de vista_cuenta2
		$categorias[] = array($mes, $cuenta2);//Agrego elementos al arreglo


	}
	echo json_encode(($categorias));//Convierto el arreglo a formato json
}
?>