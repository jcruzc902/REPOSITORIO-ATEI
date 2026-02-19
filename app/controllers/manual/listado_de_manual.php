<?php
/**
 
 * Date: 23/1/2023
 * Time: 19:00
 */


$sql_manual = "SELECT * FROM tb_manual where visible!=1";
$query_manual = $pdo->prepare($sql_manual);
$query_manual->execute();
$manual_datos = $query_manual->fetchAll(PDO::FETCH_ASSOC);
