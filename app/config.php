<?php
/**
 
 * Date: 17/1/2023
 * Time: 13:00
 */
define('SERVIDOR', 'localhost');
define('USUARIO', 'root');
define('PASSWORD', '71755313');
define('BD', 'aplicativo_tesoreria_interno');

$servidor = "mysql:dbname=" . BD . ";host=" . SERVIDOR;


$dia_actual = date("d"); //dia
$mes_actual = date("m"); //mes
$anio = date("Y"); //año

/*
if ($dia_actual >= 01 && $mes_actual >= 12 && $anio >=2026) {
    $pdo= null;
    
}else{
*/

    try {
        $pdo = new PDO($servidor, USUARIO, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        //echo "La conexión a la base de datos fue con exito";
    } catch (PDOException $e) {
        //print_r($e);
        echo "Error al conectar a la base de datos";
    }
    
    $URL = "http://localhost/aplicativotesoreriainterno";

    //solo funciona si habilito el certificado SSL en apache copiando los archivos
    //$URL = "https://10.200.0.21/aplicativotesoreriainterno";

    
    date_default_timezone_set("America/Lima");
    $fechaHora = date('Y-m-d H:i:s');


/*
}
*/





