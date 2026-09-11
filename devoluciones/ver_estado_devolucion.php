<?php

$id_devolucion = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id_devolucion || $id_devolucion <= 0) {
    http_response_code(400);
    exit('El identificador de la devolución no es válido.');
}

$nombreDocumento = 'Estado_de_Devolucion_' . $id_devolucion;
$urlPdf = 'estado_devolucion.php?id=' . urlencode($id_devolucion);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        <?php echo htmlspecialchars($nombreDocumento, ENT_QUOTES, 'UTF-8'); ?>
    </title>

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
            height: 100%;
            border: none;
            display: block;
        }
    </style>
</head>

<body>

    <iframe
        class="visor-pdf"
        src="<?php echo htmlspecialchars($urlPdf, ENT_QUOTES, 'UTF-8'); ?>"
        title="<?php echo htmlspecialchars($nombreDocumento, ENT_QUOTES, 'UTF-8'); ?>">
    </iframe>

</body>

</html>