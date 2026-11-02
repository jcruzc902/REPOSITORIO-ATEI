<?php
// Archivo intermedio para conservar un nombre personalizado en la pestaña.
include('../app/config.php');

$tituloPestana = 'Reporte de Egresos de Pagos Realizados';
$urlPdf = $URL . '/app/controllers/estado_egresos/exportar_pdf.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($tituloPestana, ENT_QUOTES, 'UTF-8'); ?></title>

    <style>
        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #525659;
        }

        iframe {
            display: block;
            width: 100%;
            height: 100%;
            border: 0;
        }
    </style>
</head>
<body>
    <iframe
        src="<?php echo htmlspecialchars($urlPdf, ENT_QUOTES, 'UTF-8'); ?>"
        title="<?php echo htmlspecialchars($tituloPestana, ENT_QUOTES, 'UTF-8'); ?>">
    </iframe>
</body>
</html>
