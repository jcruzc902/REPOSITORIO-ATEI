<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../librerias/PHP_MAILER/Exception.php';
require '../../librerias/PHP_MAILER/PHPMailer.php';
require '../../librerias/PHP_MAILER/SMTP.php';

include('../../config.php');


$usuarioX = $_POST["usuario"];

$sql_usuarios = "SELECT id_usuario,email,usuario FROM tb_usuarios where usuario='$usuarioX'";
$query_usuarios = $pdo->prepare($sql_usuarios);
$query_usuarios->execute();
$usuarios_datos = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuarios_datos as $usuarios_dato) {
    $usuario = $usuarios_dato['usuario'];
    $email = $usuarios_dato['email'];
    $id_usuario = $usuarios_dato['id_usuario'];
}



if ($email != "") {


    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.office365.com';                     //smtp-mail.outlook.com or smtp.gmail.com or smtp.office365.com
        $mail->Port = 587;                                    //587 or 465
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'ot@unfv.edu.pe';                     //SMTP username
        $mail->Password = 'Ale351024';                               //SMTP password
        $mail->SMTPSecure = 'tls';            //tls or ssl
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);

        //Recipients
        $mail->setFrom('ot@unfv.edu.pe', 'Oficina de Tesorería');
        $mail->addAddress($email);     //Add a recipient

        //Content
        //Set email format to HTML
        $mail->Subject = 'RESTABLECER CUENTA';

        $link = $URL . "/login/cambiar_clave.php?id=".$id_usuario;
        $mail->Body = '
        <html>     
        <body>     
        <p>Clic <a href=' . $link . '>aquí</a> para restablecer su contraseña</p>     
        </body>     
        </html>';

        $mail->send();
        echo 'Enviado correctamente';
    } catch (Exception $e) {
        echo "Error al enviar: {$mail->ErrorInfo}";
    }

    session_start();
    $_SESSION['mensaje'] = "Se envio un correo a $email para restablecer su cuenta";
    $_SESSION["icono"] = "success";
    $_SESSION["usuario_recovery"] = $usuarioX;
    header('Location: ' . $URL . '/login/recuperar_cuenta.php');
} else {
    session_start();
    $_SESSION['mensaje'] = "No se encontro ningun usuario registrado en la base de datos";
    $_SESSION["icono"] = "error";
    header('Location: ' . $URL . '/login/recuperar_cuenta.php');
}