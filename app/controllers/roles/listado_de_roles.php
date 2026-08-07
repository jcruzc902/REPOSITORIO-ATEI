<?php
/**
 
 * Date: 23/1/2023
 * Time: 19:00
 */


$sql_roles = "SELECT * FROM tb_roles where visible!=1";
$query_roles = $pdo->prepare($sql_roles);
$query_roles->execute();
$roles_datos = $query_roles->fetchAll(PDO::FETCH_ASSOC);
