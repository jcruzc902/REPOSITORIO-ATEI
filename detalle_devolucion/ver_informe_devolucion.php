<?php
session_start();

$informe = isset($_SESSION['informe'])
    ? str_pad((string) $_SESSION['informe'], 3, '0', STR_PAD_LEFT)
    : '';

$anioInforme = '';
if (!empty($_SESSION['fecha_informe'])) {
    try {
        $anioInforme = (new DateTime($_SESSION['fecha_informe']))->format('Y');
    } catch (Exception $e) {
        $anioInforme = '';
    }
}

$partesTitulo = array_filter([$informe, $anioInforme], static function ($valor) {
    return $valor !== '';
});

$titulo = 'Informe de Devolucion';
if (!empty($partesTitulo)) {
    $titulo .= ' Nro. ' . implode('-', $partesTitulo);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8'); ?></title>

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
            display: block;
            width: 100%;
            height: 100vh;
            border: 0;
        }
    </style>
</head>
<body>
    <iframe
        class="visor-pdf"
        src="exportar_informe.php"
        title="<?php echo htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8'); ?>">
    </iframe>
</body>
</html>
