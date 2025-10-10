<?php
/**
 
 * Date: 18/1/2023
 * Time: 08:47
 */

include ('../../config.php');

session_start();
if(isset($_SESSION['sesion_user_sistemadedevoluciondedinero'])){
    session_destroy();
    header('Location: '.$URL.'/login');
}