<?php

include('../app/config.php');
include('../layout/sesion.php');

$nombre_pdf = 'REPORTE_DE_INGRESOS.pdf';
$url_pdf = $URL . '/app/controllers/ingresos/exportar_pdf.php';

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo htmlspecialchars($nombre_pdf); ?></title>

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

        .visor-pdf {
            width: 100%;
            height: 100vh;
            border: none;
            display: block;
        }
    </style>
</head>

<body>

    <iframe
        class="visor-pdf"
        src="<?php echo htmlspecialchars($url_pdf); ?>"
        title="<?php echo htmlspecialchars($nombre_pdf); ?>">
    </iframe>

    <script>
        document.title = <?php echo json_encode($nombre_pdf); ?>;
    </script>

</body>

</html>