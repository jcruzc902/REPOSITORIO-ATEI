<?php
$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {
	include ("conexion.php");//Contiene los datos de conexion a la base de datos
	$periodo = intval($_REQUEST['periodo']);
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

	function monto($table, $mes, $periodo)
	{
		global $con;
		$fecha_inicial = "$periodo-$mes-1";
		if ($mes == 1 or $mes == 3 or $mes == 5 or $mes == 7 or $mes == 8 or $mes == 10 or $mes == 12) {
			$dia_fin = 31;
		} else if ($mes == 2) {
			if ($periodo % 4 == 0) {
				$dia_fin = 29;
			} else {
				$dia_fin = 28;
			}
		} else {
			$dia_fin = 30;
		}
		$fecha_final = "$periodo-$mes-$dia_fin";

		$query = mysqli_query($con, "select sum(monto) as monto from $table where fyh_creacion between '$fecha_inicial' and '$fecha_final'");
		$row = mysqli_fetch_array($query);
		$monto = floatval($row['monto']);
		return $monto;
	}

	$categorias[] = array('Mes', "300152 - $periodo ");//Nombre de la primera y segunda fila del grafico
	for ($inicio = 1; $inicio <= 12; $inicio++) {
		$mes = $txt_mes[$inicio];//Obtengo la abreviatura del mes
		//$cuenta1 = monto('cuenta_257443', $inicio, $periodo);//Obtengo el  monto de vista_cuenta1
		$cuenta2 = monto('cuenta_300152', $inicio, $periodo);//Obtengo el monto de vista_cuenta2
		$categorias[] = array($mes, $cuenta2);//Agrego elementos al arreglo


	}
	echo json_encode(($categorias));//Convierto el arreglo a formato json
}
?>