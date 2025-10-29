<?php

include ('../../config.php');

for ($i = 0; $i < 100000; $i++) {
    header('Location: ' . $URL . '/detalle_estado_egresos/');
}

