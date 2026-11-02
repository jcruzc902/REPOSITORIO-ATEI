<?php

include('../app/config.php');
include('../layout/sesion.php');

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id <= 0) {
    http_response_code(400);
    exit('El identificador del estado de cuenta no es válido.');
}

$titulo = isset($_GET['titulo'])
    ? trim($_GET['titulo'])
    : 'Estado de cuenta';

if ($titulo === '') {
    $titulo = 'Estado de cuenta';
}

$titulo_seguro = htmlspecialchars(
    $titulo,
    ENT_QUOTES | ENT_SUBSTITUTE,
    'UTF-8'
);

$url_pdf = 'estado_cuenta.php?id=' . urlencode((string) $id);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title><?php echo $titulo_seguro; ?></title>

    <style>
        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            overflow: hidden;
            background-color: #525659;
        }

        .visor-pdf {
            display: block;
            width: 100%;
            height: 100%;
            border: 0;
        }
    </style>
</head>

<body>
    <iframe
        class="visor-pdf"
        src="<?php echo htmlspecialchars(
            $url_pdf,
            ENT_QUOTES,
            'UTF-8'
        ); ?>"
        title="<?php echo $titulo_seguro; ?>">
    </iframe>
</body>
</html>