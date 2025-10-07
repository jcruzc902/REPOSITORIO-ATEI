<?php
include('app/config.php');
include('layout/sesion.php');

include('layout/parte1.php');

/*
$voice = new COM("SAPI.SpVoice");

if(isset($_SESSION['nombre_usuario'])){
    $respuesta = $_SESSION['nombre_usuario'];
    $voice->Speak($respuesta); //CODIFICA TEXTO A VOZ
}
*/

if (isset($_SESSION['nombre_usuario'])) {
    $respuesta = $_SESSION['nombre_usuario'];
} else {
    $respuesta = "";
}


function conexion()
{

    try {
        $conn = new PDO('mysql:host=localhost;dbname=aplicativo_tesoreria_interno', 'root', '');
    } catch (PDOException $e) {
        echo "Error " . $e;
    }

    return $conn;
}


?>

<script>
    window.onload = function ventanaRedimensionar() {
        var boton = document.getElementById('soporte');
        var boton2 = document.getElementById('name_user');
        var boton3 = document.getElementById('name_system');

        // Si el tamaño de la ventana es demasiado pequeño, probablemente esté minimizada o muy reducida
        if (window.innerWidth < 1300 || window.innerHeight < 800) {
            boton.style.display = 'none'; // Oculta el botón
            boton2.style.display = 'none'; // Oculta el botón
            boton3.style.display = 'none'; // Oculta el botón
        } else {
            boton.style.display = 'block'; // Muestra el botón
            boton2.style.display = 'inline'; // Muestra el botón
            boton3.style.display = 'inline'; // Muestra el botón
        }
    }
</script>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Panel principal del Sistema</b>
                    </h1>


                    <select id="voces" hidden>
                    </select>

                    <textarea id="mensaje" cols="30" rows="5" hidden><?php echo $respuesta; ?></textarea>

                    <script>



                        //Carga de funcion automatica
                        window.onload = function saludo() {

                            var text = document.getElementById("mensaje").value;
                            if (text != "") {

                                window.speechSynthesis.cancel(); //cancela el audio para chrome

                                voz.text = text;
                                window.speechSynthesis.speak(voz); //empieza a hablar
                            }

                        }


                        var voz = new SpeechSynthesisUtterance();
                        voz.lang = "es-ES";
                        voz.volume = 0;
                        var timer = setInterval(function () {
                            var voices = speechSynthesis.getVoices();
                            if (voices.length != 0) {
                                voz.voice = voices[0];
                                voz.voiceURI = voices[0].voiceURI;
                                clearInterval(timer);
                            }
                            console.log(voices);
                        }, 1000);



                    </script>
                    <?php
                    unset($_SESSION['nombre_usuario']); //destruye la variable
                    ?>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-gear-fill"></i> Panel principal</li>
                    </ol>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">


            <div id="tarjetas_acceso_rapido" style="display: inline;">


                <div class="row">

                    <div class="col-lg-4 col-6" id="card_devoluciones">
                        <div class="small-box " style="background-color: gainsboro; color: black;">
                            <div class="inner">

                                <h1><b>
                                        <?php

                                        //consulta sql
                                        $con = conexion();
                                        $contador_devoluciones = current($con->query("select count(*) from tb_devoluciones where visible!=1")->fetch());


                                        if ($contador_devoluciones == NULL) {
                                            $contador_devoluciones = 0;
                                        } else {
                                            $contador_devoluciones;
                                        }

                                        echo $contador_devoluciones;
                                        ?>
                                    </b></h1>
                                <p>
                                <h5><b>Devoluciones <br> Registrados</b></h5>
                                </p>
                            </div>
                            <a href="<?php echo $URL; ?>/devoluciones/create.php">
                                <div class="icon" style="background-color: black; color: black">
                                    <i class="fas fa-coins"></i>
                                </div>
                            </a>
                            <a href="<?php echo $URL; ?>/devoluciones" class="small-box-footer"
                                style="background-color: midnightblue; color: white;">
                                Más detalle <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-6" id="card_egresos">
                        <div class="small-box " style="background-color: gainsboro; color: black;">
                            <div class="inner">

                                <h1><b>
                                        <?php

                                        //consulta sql
                                        $con = conexion();
                                        $contador_egresos = current($con->query("select count(*) from tb_egresos where visible!=1")->fetch());


                                        if ($contador_egresos == NULL) {
                                            $contador_egresos = 0;
                                        } else {
                                            $contador_egresos;
                                        }

                                        echo $contador_egresos;
                                        ?>
                                    </b></h1>
                                <p>
                                <h5><b>Estado de cuenta <br> Registrados</b></h5>
                                </p>
                            </div>
                            <a href="<?php echo $URL; ?>/estado_egresos/create.php">
                                <div class="icon" style="background-color: black; color: black">
                                    <i class="fas fa-calculator"></i>
                                </div>
                            </a>
                            <a href="<?php echo $URL; ?>/estado_egresos" class="small-box-footer"
                                style="background-color: midnightblue; color: white;">
                                Más detalle <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-6" id="card_cheques">
                        <div class="small-box " style="background-color: gainsboro; color: black;">
                            <div class="inner">

                                <h1><b>
                                        <?php

                                        //consulta sql
                                        $con = conexion();
                                        $contador_cheques = current($con->query("select count(*) from tb_cheque where visible!=1")->fetch());


                                        if ($contador_cheques == NULL) {
                                            $contador_cheques = 0;
                                        } else {
                                            $contador_cheques;
                                        }

                                        echo $contador_cheques;
                                        ?>
                                    </b></h1>
                                <p>
                                <h5><b>Cheques <br> Registrados</b></h5>
                                </p>
                            </div>
                            <a href="<?php echo $URL; ?>/cheques/create.php">
                                <div class="icon" style="background-color: black; color: black">
                                    <i class="fas fa-money-check"></i>
                                </div>
                            </a>
                            <a href="<?php echo $URL; ?>/cheques" class="small-box-footer"
                                style="background-color: midnightblue; color: white;">
                                Más detalle <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-6" id="card_tasas_tarifas">
                        <div class="small-box " style="background-color: gainsboro; color: black;">
                            <div class="inner">

                                <h1><b>
                                        <?php

                                        //consulta sql
                                        $con = conexion();
                                        $contador_tasas_tarifas = current($con->query("select count(*) from tb_tasas_tarifas where visible!=1")->fetch());


                                        if ($contador_tasas_tarifas == NULL) {
                                            $contador_tasas_tarifas = 0;
                                        } else {
                                            $contador_tasas_tarifas;
                                        }

                                        echo $contador_tasas_tarifas;
                                        ?>
                                    </b></h1>
                                <p>
                                <h5><b>Tasas y Tarifas <br> Registrados</b></h5>
                                </p>
                            </div>
                            <a href="<?php echo $URL; ?>/tasas_tarifas/create.php">
                                <div class="icon" style="background-color: black; color: black">
                                    <i class="fas fa-signal"></i>
                                </div>
                            </a>
                            <a href="<?php echo $URL; ?>/tasas_tarifas" class="small-box-footer"
                                style="background-color: midnightblue; color: white;">
                                Más detalle <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-6" id="card_saldos_bancarios">
                        <div class="small-box " style="background-color: gainsboro; color: black;">
                            <div class="inner">

                                <h1><b>
                                        <?php

                                        //consulta sql
                                        $con = conexion();
                                        $contador_saldos_bancarios = current($con->query("select count(*) from tb_saldo_banco where visible!=1")->fetch());


                                        if ($contador_saldos_bancarios == NULL) {
                                            $contador_saldos_bancarios = 0;
                                        } else {
                                            $contador_saldos_bancarios;
                                        }

                                        echo $contador_saldos_bancarios;
                                        ?>
                                    </b></h1>
                                <p>
                                <h5><b>Saldos Bancarios <br> Registrados</b></h5>
                                </p>
                            </div>
                            <a href="<?php echo $URL; ?>/saldos/create.php">
                                <div class="icon" style="background-color: black; color: black">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            </a>
                            <a href="<?php echo $URL; ?>/saldos" class="small-box-footer"
                                style="background-color: midnightblue; color: white;">
                                Más detalle <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <!--
                <div class="col-lg-4 col-6" id="card_cartas_fianza">
                    <div class="small-box " style="background-color: gainsboro; color: black;">
                        <div class="inner">

                            <h1><b>
                                    <?php

                                    //consulta sql
                                    $con = conexion();
                                    $contador_cartas_fianza = current($con->query("select count(*) from tb_cartas_fianza where visible!=1")->fetch());


                                    if ($contador_cartas_fianza == NULL) {
                                        $contador_cartas_fianza = 0;
                                    } else {
                                        $contador_cartas_fianza;
                                    }

                                    echo $contador_cartas_fianza;
                                    ?>
                                </b></h1>
                            <p>
                            <h5><b>Cartas Fianza <br> Registrados</b></h5>
                            </p>
                        </div>
                        <a href="<?php echo $URL; ?>/cartas_fianza/create.php">
                            <div class="icon" style="background-color: black; color: black">
                                <i class="fas fa-folder-open"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL; ?>/cartas_fianza" class="small-box-footer"
                            style="background-color: midnightblue; color: white;">
                            Más detalle <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                -->

                    <div class="col-lg-4 col-6" id="card_roles">
                        <div class="small-box " style="background-color: gainsboro; color: black;">
                            <div class="inner">

                                <h1><b>
                                        <?php

                                        //consulta sql
                                        $con = conexion();
                                        $contador_roles = current($con->query("select count(*) from tb_roles where visible!=1")->fetch());


                                        if ($contador_roles == NULL) {
                                            $contador_roles = 0;
                                        } else {
                                            $contador_roles;
                                        }

                                        echo $contador_roles;
                                        ?>
                                    </b></h1>
                                <p>
                                <h5><b>Roles <br> Registrados</b></h5>
                                </p>
                            </div>
                            <a href="#">
                                <div class="icon" style="background-color: black; color: black">
                                    <i class="fas fa-address-card"></i>
                                </div>
                            </a>
                            <a href="<?php echo $URL; ?>/roles" class="small-box-footer"
                                style="background-color: midnightblue; color: white;">
                                Más detalle <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-6" id="card_usuarios">
                        <div class="small-box " style="background-color: gainsboro; color: black;">
                            <div class="inner">

                                <h1><b>
                                        <?php

                                        //consulta sql
                                        $con = conexion();
                                        $contador_usuarios = current($con->query("select count(*) from tb_usuarios where visible!=1")->fetch());


                                        if ($contador_usuarios == NULL) {
                                            $contador_usuarios = 0;
                                        } else {
                                            $contador_usuarios;
                                        }

                                        echo $contador_usuarios;
                                        ?>
                                    </b></h1>
                                <p>
                                <h5><b>Usuarios <br> Registrados</b></h5>
                                </p>
                            </div>
                            <a href="<?php echo $URL; ?>/usuarios/create.php">
                                <div class="icon" style="background-color: black; color: black">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                            </a>
                            <a href="<?php echo $URL; ?>/usuarios" class="small-box-footer"
                                style="background-color: midnightblue; color: white;">
                                Más detalle <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                </div>

            </div>

            <?php
            if ($rol_sesion != "ADMINISTRADOR") {
                ?>
                <script>document.getElementById('tarjetas_acceso_rapido').style.display = 'none';</script>
                <?php
            }

            //JOEL
            if ($rol_sesion == "ADMINISTRADOR" && $id_usuario_sesion == 11) {
                ?>
                <script>document.getElementById('card_saldos_bancarios').style.display = 'none';</script>
                <?php
            }

            ?>


            <br>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <?php
    date_default_timezone_set("America/Lima");
    $year_current = date('Y');
    ?>


    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12" id="chart_importe_devolucion">
                    <div class="card card-dark shadow-lg"
                        style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
                        <div class="card-header">
                            <h1 class="card-title">Estadística de Importe Total de Devolucion de Dinero Mensual (S/.)
                            </h1>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                        class="fas fa-expand"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body">

                            <div class='col-md-2' style="margin-left: 50px;">
                                <label>Selecciona período</label>
                                <select id="periodo" class="form-control " style="width: 100%;"
                                    onchange="drawVisualization();">
                                    <?php

                                    for ($i = 2000; $i <= 2050; $i++) {
                                        if ($i == $year_current) {
                                            echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                        } else {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div id="chart_div" style="width: 100%; height: 550px; "></div>


                        </div>


                        <script type="text/javascript">
                            google.charts.load('current', { 'packages': ['corechart'] });
                            google.charts.setOnLoadCallback(drawVisualization);

                            function errorHandler(errorMessage) {
                                //curisosity, check out the error in the console
                                console.log(errorMessage);
                                //simply remove the error, the user never see it
                                google.visualization.errors.removeError(errorMessage.id);
                            }

                            function drawVisualization() {
                                // Some raw data (not necessarily accurate)
                                var periodo = $("#periodo").val();//Datos que enviaremos para generar una consulta en la base de datos
                                var jsonData = $.ajax({
                                    url: '<?php echo $URL; ?>/grafica/chart.php',
                                    data: { 'periodo': periodo, 'action': 'ajax' },
                                    dataType: 'json',
                                    async: false
                                }).responseText;

                                var obj = jQuery.parseJSON(jsonData);
                                var data = google.visualization.arrayToDataTable(obj);


                                var options = {
                                    title: 'REPORTE DE NRO. CUENTA 300152 - PERIODO ' + periodo,
                                    vAxis: { title: 'Monto' },
                                    hAxis: { title: 'Meses' },
                                    seriesType: 'bars',
                                    colors: ['green'],
                                    series: { 5: { type: 'line' } }
                                };

                                var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
                                google.visualization.events.addListener(chart, 'error', errorHandler);
                                chart.draw(data, options);
                            }

                            // Haciendo los graficos responsivos
                            jQuery(document).ready(function () {
                                jQuery(window).resize(function () {
                                    drawVisualization();
                                });
                            });

                        </script>



                    </div>

                </div>

                <div class="col-md-12" id="chart_cantidad_devolucion">
                    <div class="card card-dark shadow-lg"
                        style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
                        <div class="card-header">
                            <h1 class="card-title">Estadística de Cantidad de Recibos Registrados de Devolucion de
                                Dinero</h1>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                        class="fas fa-expand"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body">

                            <div class='col-md-2' style="margin-left: 50px;">
                                <label>Selecciona período</label>
                                <select id="periodo2" class="form-control " style="width: 100%;"
                                    onchange="drawVisualization2();">
                                    <?php

                                    for ($i = 2000; $i <= 2050; $i++) {
                                        if ($i == $year_current) {
                                            echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                        } else {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div id="chart_div2" style="width: 100%; height: 550px; "></div>


                        </div>

                        <script type="text/javascript">
                            google.charts.load('current', { 'packages': ['corechart'] });
                            google.charts.setOnLoadCallback(drawVisualization2);

                            function errorHandler(errorMessage) {
                                //curisosity, check out the error in the console
                                console.log(errorMessage);
                                //simply remove the error, the user never see it
                                google.visualization.errors.removeError(errorMessage.id);
                            }

                            function drawVisualization2() {
                                // Some raw data (not necessarily accurate)
                                var periodo2 = $("#periodo2").val();//Datos que enviaremos para generar una consulta en la base de datos
                                var jsonData = $.ajax({
                                    url: '<?php echo $URL; ?>/grafica/chart2.php',
                                    data: { 'periodo2': periodo2, 'action': 'ajax' },
                                    dataType: 'json',
                                    async: false
                                }).responseText;

                                var obj = jQuery.parseJSON(jsonData);
                                var data = google.visualization.arrayToDataTable(obj);



                                var options = {
                                    title: 'REPORTE DE NRO. CUENTA 300152 - PERIODO ' + periodo2,
                                    vAxis: { title: 'Cantidad' },
                                    hAxis: { title: 'Meses' },
                                    seriesType: 'bars',
                                    colors: ['green'],
                                    series: { 5: { type: 'line' } }
                                };

                                var chart = new google.visualization.ComboChart(document.getElementById('chart_div2'));
                                google.visualization.events.addListener(chart, 'error', errorHandler);
                                chart.draw(data, options);
                            }

                            // Haciendo los graficos responsivos
                            jQuery(document).ready(function () {
                                jQuery(window).resize(function () {
                                    drawVisualization2();
                                });
                            });

                        </script>



                    </div>

                </div>



                <div class="col-md-12" id="chart_importe_cheque">
                    <div class="card card-dark shadow-lg"
                        style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
                        <div class="card-header">
                            <h1 class="card-title">Estadística de Importe Total de Cheque Mensual (S/.)
                            </h1>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                        class="fas fa-expand"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body">

                            <div class='col-md-2' style="margin-left: 50px;">
                                <label>Selecciona período</label>
                                <select id="periodo4" class="form-control " style="width: 100%;"
                                    onchange="drawVisualization4();">
                                    <?php

                                    for ($i = 2000; $i <= 2050; $i++) {
                                        if ($i == $year_current) {
                                            echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                        } else {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div id="chart_div4" style="width: 100%; height: 550px; "></div>


                        </div>


                        <script type="text/javascript">
                            google.charts.load('current', { 'packages': ['corechart'] });
                            google.charts.setOnLoadCallback(drawVisualization4);

                            function errorHandler(errorMessage) {
                                //curisosity, check out the error in the console
                                console.log(errorMessage);
                                //simply remove the error, the user never see it
                                google.visualization.errors.removeError(errorMessage.id);
                            }

                            function drawVisualization4() {
                                // Some raw data (not necessarily accurate)
                                var periodo4 = $("#periodo4").val();//Datos que enviaremos para generar una consulta en la base de datos
                                var jsonData = $.ajax({
                                    url: '<?php echo $URL; ?>/grafica/chart4.php',
                                    data: { 'periodo4': periodo4, 'action': 'ajax' },
                                    dataType: 'json',
                                    async: false
                                }).responseText;

                                var obj = jQuery.parseJSON(jsonData);
                                var data = google.visualization.arrayToDataTable(obj);



                                var options = {
                                    title: 'REPORTE DE NRO. CUENTA 257443 Y 300152 - PERIODO ' + periodo4,

                                    vAxis: { title: 'Monto' },
                                    hAxis: { title: 'Meses' },
                                    seriesType: 'bars',
                                    series: { 5: { type: 'line' } }
                                };

                                var chart = new google.visualization.ComboChart(document.getElementById('chart_div4'));
                                google.visualization.events.addListener(chart, 'error', errorHandler);
                                chart.draw(data, options);
                            }

                            // Haciendo los graficos responsivos
                            jQuery(document).ready(function () {
                                jQuery(window).resize(function () {
                                    drawVisualization4();
                                });
                            });

                        </script>



                    </div>

                </div>

                <div class="col-md-12" id="chart_cantidad_cheque">
                    <div class="card card-dark shadow-lg"
                        style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
                        <div class="card-header">
                            <h1 class="card-title">Estadística de Cantidad de Cheques Registrados
                            </h1>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                        class="fas fa-expand"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body">

                            <div class='col-md-2' style="margin-left: 50px;">
                                <label>Selecciona período</label>
                                <select id="periodo5" class="form-control " style="width: 100%;"
                                    onchange="drawVisualization5();">
                                    <?php

                                    for ($i = 2000; $i <= 2050; $i++) {
                                        if ($i == $year_current) {
                                            echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                        } else {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div id="chart_div5" style="width: 100%; height: 550px; "></div>


                        </div>


                        <script type="text/javascript">
                            google.charts.load('current', { 'packages': ['corechart'] });
                            google.charts.setOnLoadCallback(drawVisualization5);

                            function errorHandler(errorMessage) {
                                //curisosity, check out the error in the console
                                console.log(errorMessage);
                                //simply remove the error, the user never see it
                                google.visualization.errors.removeError(errorMessage.id);
                            }

                            function drawVisualization5() {
                                // Some raw data (not necessarily accurate)
                                var periodo5 = $("#periodo5").val();//Datos que enviaremos para generar una consulta en la base de datos
                                var jsonData = $.ajax({
                                    url: '<?php echo $URL; ?>/grafica/chart5.php',
                                    data: { 'periodo5': periodo5, 'action': 'ajax' },
                                    dataType: 'json',
                                    async: false
                                }).responseText;

                                var obj = jQuery.parseJSON(jsonData);
                                var data = google.visualization.arrayToDataTable(obj);



                                var options = {
                                    title: 'REPORTE DE NRO. CUENTA 257443 Y 300152 - PERIODO ' + periodo5,

                                    vAxis: { title: 'Cantidad' },
                                    hAxis: { title: 'Meses' },
                                    seriesType: 'bars',
                                    series: { 5: { type: 'line' } }
                                };

                                var chart = new google.visualization.ComboChart(document.getElementById('chart_div5'));
                                google.visualization.events.addListener(chart, 'error', errorHandler);
                                chart.draw(data, options);
                            }

                            // Haciendo los graficos responsivos
                            jQuery(document).ready(function () {
                                jQuery(window).resize(function () {
                                    drawVisualization5();
                                });
                            });

                        </script>



                    </div>

                </div>

                <div class="col-md-12" id="chart_egresos">
                    <div class="card card-dark shadow-lg"
                        style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
                        <div class="card-header">
                            <h1 class="card-title">Estadística de Monto Total de Estado de Cuenta Mensual (S/.)</h1>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                        class="fas fa-expand"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body">

                            <div class='col-md-2' style="margin-left: 50px;">
                                <label>Selecciona período</label>
                                <select id="periodo3" class="form-control " style="width: 100%;"
                                    onchange="drawVisualization3();">
                                    <?php

                                    for ($i = 2000; $i <= 2050; $i++) {
                                        if ($i == $year_current) {
                                            echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                        } else {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div id="chart_div3" style="width: 100%; height: 550px; "></div>


                        </div>

                        <script type="text/javascript">
                            google.charts.load('current', { 'packages': ['corechart'] });
                            google.charts.setOnLoadCallback(drawVisualization3);

                            function errorHandler(errorMessage) {
                                //curisosity, check out the error in the console
                                console.log(errorMessage);
                                //simply remove the error, the user never see it
                                google.visualization.errors.removeError(errorMessage.id);
                            }

                            function drawVisualization3() {
                                // Some raw data (not necessarily accurate)
                                var periodo3 = $("#periodo3").val();//Datos que enviaremos para generar una consulta en la base de datos
                                var jsonData = $.ajax({
                                    url: '<?php echo $URL; ?>/grafica/chart3.php',
                                    data: { 'periodo3': periodo3, 'action': 'ajax' },
                                    dataType: 'json',
                                    async: false
                                }).responseText;

                                var obj = jQuery.parseJSON(jsonData);
                                var data = google.visualization.arrayToDataTable(obj);



                                var options = {
                                    title: 'REPORTE DE EGRESOS - PERIODO ' + periodo3,
                                    vAxis: { title: 'Monto' },
                                    hAxis: { title: 'Meses' },
                                    seriesType: 'bars',
                                    colors: ['black'],
                                    series: { 5: { type: 'line' } }
                                };

                                var chart = new google.visualization.ComboChart(document.getElementById('chart_div3'));
                                google.visualization.events.addListener(chart, 'error', errorHandler);
                                chart.draw(data, options);
                            }

                            // Haciendo los graficos responsivos
                            jQuery(document).ready(function () {
                                jQuery(window).resize(function () {
                                    drawVisualization3();
                                });
                            });

                        </script>



                    </div>

                </div>

                <div class="col-md-12" id="chart_cantidad_egresos">
                    <div class="card card-dark shadow-lg"
                        style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
                        <div class="card-header">
                            <h1 class="card-title">Estadística de Cantidad de Estado de Cuenta Registrados
                            </h1>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                        class="fas fa-expand"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body">

                            <div class='col-md-2' style="margin-left: 50px;">
                                <label>Selecciona período</label>
                                <select id="periodo6" class="form-control " style="width: 100%;"
                                    onchange="drawVisualization6();">
                                    <?php

                                    for ($i = 2000; $i <= 2050; $i++) {
                                        if ($i == $year_current) {
                                            echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                        } else {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div id="chart_div6" style="width: 100%; height: 550px; "></div>


                        </div>


                        <script type="text/javascript">
                            google.charts.load('current', { 'packages': ['corechart'] });
                            google.charts.setOnLoadCallback(drawVisualization6);

                            function errorHandler(errorMessage) {
                                //curisosity, check out the error in the console
                                console.log(errorMessage);
                                //simply remove the error, the user never see it
                                google.visualization.errors.removeError(errorMessage.id);
                            }

                            function drawVisualization6() {
                                // Some raw data (not necessarily accurate)
                                var periodo6 = $("#periodo6").val();//Datos que enviaremos para generar una consulta en la base de datos
                                var jsonData = $.ajax({
                                    url: '<?php echo $URL; ?>/grafica/chart6.php',
                                    data: { 'periodo6': periodo6, 'action': 'ajax' },
                                    dataType: 'json',
                                    async: false
                                }).responseText;

                                var obj = jQuery.parseJSON(jsonData);
                                var data = google.visualization.arrayToDataTable(obj);



                                var options = {
                                    title: 'REPORTE DE EGRESOS - PERIODO ' + periodo6,

                                    vAxis: { title: 'Cantidad' },
                                    hAxis: { title: 'Meses' },
                                    seriesType: 'bars',
                                    colors: ['black'],
                                    series: { 5: { type: 'line' } }
                                };

                                var chart = new google.visualization.ComboChart(document.getElementById('chart_div6'));
                                google.visualization.events.addListener(chart, 'error', errorHandler);
                                chart.draw(data, options);
                            }

                            // Haciendo los graficos responsivos
                            jQuery(document).ready(function () {
                                jQuery(window).resize(function () {
                                    drawVisualization6();
                                });
                            });

                        </script>



                    </div>

                </div>

                <div class="col-md-12" id="chart_importe_tasas_tarifas">
                    <div class="card card-dark shadow-lg"
                        style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
                        <div class="card-header">
                            <h1 class="card-title">Estadística de Importe Total de Tasas y Tarifas Mensual (S/.)
                            </h1>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                        class="fas fa-expand"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body">

                            <div class='col-md-2' style="margin-left: 50px;">
                                <label>Selecciona período</label>
                                <select id="periodo7" class="form-control " style="width: 100%;"
                                    onchange="drawVisualization7();">
                                    <?php

                                    for ($i = 2000; $i <= 2050; $i++) {
                                        if ($i == $year_current) {
                                            echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                        } else {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div id="chart_div7" style="width: 100%; height: 550px; "></div>


                        </div>


                        <script type="text/javascript">
                            google.charts.load('current', { 'packages': ['corechart'] });
                            google.charts.setOnLoadCallback(drawVisualization7);

                            function errorHandler(errorMessage) {
                                //curisosity, check out the error in the console
                                console.log(errorMessage);
                                //simply remove the error, the user never see it
                                google.visualization.errors.removeError(errorMessage.id);
                            }

                            function drawVisualization7() {
                                // Some raw data (not necessarily accurate)
                                var periodo7 = $("#periodo7").val();//Datos que enviaremos para generar una consulta en la base de datos
                                var jsonData = $.ajax({
                                    url: '<?php echo $URL; ?>/grafica/chart7.php',
                                    data: { 'periodo7': periodo7, 'action': 'ajax' },
                                    dataType: 'json',
                                    async: false
                                }).responseText;

                                var obj = jQuery.parseJSON(jsonData);
                                var data = google.visualization.arrayToDataTable(obj);



                                var options = {
                                    title: 'REPORTE DE TASAS Y TARIFAS ' + periodo7,

                                    vAxis: { title: 'Monto' },
                                    hAxis: { title: 'Meses' },
                                    seriesType: 'bars',
                                    series: { 5: { type: 'line' } }
                                };

                                var chart = new google.visualization.ComboChart(document.getElementById('chart_div7'));
                                google.visualization.events.addListener(chart, 'error', errorHandler);
                                chart.draw(data, options);
                            }

                            // Haciendo los graficos responsivos
                            jQuery(document).ready(function () {
                                jQuery(window).resize(function () {
                                    drawVisualization7();
                                });
                            });

                        </script>



                    </div>

                </div>

                <div class="col-md-12" id="chart_cantidad_tasas_tarifas">
                    <div class="card card-dark shadow-lg"
                        style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
                        <div class="card-header">
                            <h1 class="card-title">Estadística de Cantidad de Tasas y Tarifas Registrados
                            </h1>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                        class="fas fa-expand"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body">

                            <div class='col-md-2' style="margin-left: 50px;">
                                <label>Selecciona período</label>
                                <select id="periodo8" class="form-control " style="width: 100%;"
                                    onchange="drawVisualization8();">
                                    <?php

                                    for ($i = 2000; $i <= 2050; $i++) {
                                        if ($i == $year_current) {
                                            echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                        } else {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div id="chart_div8" style="width: 100%; height: 550px; "></div>


                        </div>


                        <script type="text/javascript">
                            google.charts.load('current', { 'packages': ['corechart'] });
                            google.charts.setOnLoadCallback(drawVisualization8);

                            function errorHandler(errorMessage) {
                                //curisosity, check out the error in the console
                                console.log(errorMessage);
                                //simply remove the error, the user never see it
                                google.visualization.errors.removeError(errorMessage.id);
                            }

                            function drawVisualization8() {
                                // Some raw data (not necessarily accurate)
                                var periodo8 = $("#periodo8").val();//Datos que enviaremos para generar una consulta en la base de datos
                                var jsonData = $.ajax({
                                    url: '<?php echo $URL; ?>/grafica/chart8.php',
                                    data: { 'periodo8': periodo8, 'action': 'ajax' },
                                    dataType: 'json',
                                    async: false
                                }).responseText;

                                var obj = jQuery.parseJSON(jsonData);
                                var data = google.visualization.arrayToDataTable(obj);



                                var options = {
                                    title: 'REPORTE DE TASAS Y TARIFAS - PERIODO ' + periodo8,

                                    vAxis: { title: 'Cantidad' },
                                    hAxis: { title: 'Meses' },
                                    seriesType: 'bars',
                                    series: { 5: { type: 'line' } }
                                };

                                var chart = new google.visualization.ComboChart(document.getElementById('chart_div8'));
                                google.visualization.events.addListener(chart, 'error', errorHandler);
                                chart.draw(data, options);
                            }

                            // Haciendo los graficos responsivos
                            jQuery(document).ready(function () {
                                jQuery(window).resize(function () {
                                    drawVisualization8();
                                });
                            });

                        </script>



                    </div>

                </div>

                <div class="col-md-12" id="chart_importe_saldo_bancario">
                    <div class="card card-dark shadow-lg"
                        style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
                        <div class="card-header">
                            <h1 class="card-title">Estadística de Importe Total de Saldo Bancario Mensual (S/.)
                            </h1>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                        class="fas fa-expand"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body">

                            <div class='col-md-2' style="margin-left: 50px;">
                                <label>Selecciona período</label>
                                <select id="periodo9" class="form-control " style="width: 100%;"
                                    onchange="drawVisualization9();">
                                    <?php

                                    for ($i = 2000; $i <= 2050; $i++) {
                                        if ($i == $year_current) {
                                            echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                        } else {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div id="chart_div9" style="width: 100%; height: 550px; "></div>


                        </div>


                        <script type="text/javascript">
                            google.charts.load('current', { 'packages': ['corechart'] });
                            google.charts.setOnLoadCallback(drawVisualization9);

                            function errorHandler(errorMessage) {
                                //curisosity, check out the error in the console
                                console.log(errorMessage);
                                //simply remove the error, the user never see it
                                google.visualization.errors.removeError(errorMessage.id);
                            }

                            function drawVisualization9() {
                                // Some raw data (not necessarily accurate)
                                var periodo9 = $("#periodo9").val();//Datos que enviaremos para generar una consulta en la base de datos
                                var jsonData = $.ajax({
                                    url: '<?php echo $URL; ?>/grafica/chart9.php',
                                    data: { 'periodo9': periodo9, 'action': 'ajax' },
                                    dataType: 'json',
                                    async: false
                                }).responseText;

                                var obj = jQuery.parseJSON(jsonData);
                                var data = google.visualization.arrayToDataTable(obj);



                                var options = {
                                    title: 'REPORTE DE SALDO BANCARIO ' + periodo9,

                                    vAxis: { title: 'Monto' },
                                    hAxis: { title: 'Meses' },
                                    seriesType: 'bars',
                                    series: { 5: { type: 'line' } }
                                };

                                var chart = new google.visualization.ComboChart(document.getElementById('chart_div9'));
                                google.visualization.events.addListener(chart, 'error', errorHandler);
                                chart.draw(data, options);
                            }

                            // Haciendo los graficos responsivos
                            jQuery(document).ready(function () {
                                jQuery(window).resize(function () {
                                    drawVisualization9();
                                });
                            });

                        </script>



                    </div>

                </div>

                <div class="col-md-12" id="chart_cantidad_saldo_bancario">
                    <div class="card card-dark shadow-lg"
                        style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
                        <div class="card-header">
                            <h1 class="card-title">Estadística de Cantidad de Saldo Bancario Registrados
                            </h1>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                        class="fas fa-expand"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body">

                            <div class='col-md-2' style="margin-left: 50px;">
                                <label>Selecciona período</label>
                                <select id="periodo10" class="form-control " style="width: 100%;"
                                    onchange="drawVisualization10();">
                                    <?php

                                    for ($i = 2000; $i <= 2050; $i++) {
                                        if ($i == $year_current) {
                                            echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                        } else {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div id="chart_div10" style="width: 100%; height: 550px; "></div>


                        </div>


                        <script type="text/javascript">
                            google.charts.load('current', { 'packages': ['corechart'] });
                            google.charts.setOnLoadCallback(drawVisualization10);

                            function errorHandler(errorMessage) {
                                //curisosity, check out the error in the console
                                console.log(errorMessage);
                                //simply remove the error, the user never see it
                                google.visualization.errors.removeError(errorMessage.id);
                            }

                            function drawVisualization10() {
                                // Some raw data (not necessarily accurate)
                                var periodo10 = $("#periodo10").val();//Datos que enviaremos para generar una consulta en la base de datos
                                var jsonData = $.ajax({
                                    url: '<?php echo $URL; ?>/grafica/chart10.php',
                                    data: { 'periodo10': periodo10, 'action': 'ajax' },
                                    dataType: 'json',
                                    async: false
                                }).responseText;

                                var obj = jQuery.parseJSON(jsonData);
                                var data = google.visualization.arrayToDataTable(obj);



                                var options = {
                                    title: 'REPORTE DE SALDO BANCARIO - PERIODO ' + periodo10,
                                    //colors: ['#24b27e'],
                                    vAxis: { title: 'Cantidad' },
                                    hAxis: { title: 'Meses' },
                                    seriesType: 'bars',
                                    series: { 5: { type: 'line' } }
                                };

                                var chart = new google.visualization.ComboChart(document.getElementById('chart_div10'));
                                google.visualization.events.addListener(chart, 'error', errorHandler);
                                chart.draw(data, options);
                            }

                            // Haciendo los graficos responsivos
                            jQuery(document).ready(function () {
                                jQuery(window).resize(function () {
                                    drawVisualization10();
                                });
                            });

                        </script>



                    </div>

                </div>

                <script>
                    $(document).ready(function () {
                        $('#periodo').select2({
                            theme: 'bootstrap4',
                        });
                        $('#periodo2').select2({
                            theme: 'bootstrap4',
                        });
                        $('#periodo3').select2({
                            theme: 'bootstrap4',
                        });
                        $('#periodo4').select2({
                            theme: 'bootstrap4',
                        });
                        $('#periodo5').select2({
                            theme: 'bootstrap4',
                        });
                        $('#periodo6').select2({
                            theme: 'bootstrap4',
                        });
                        $('#periodo7').select2({
                            theme: 'bootstrap4',
                        });
                        $('#periodo8').select2({
                            theme: 'bootstrap4',
                        });
                        $('#periodo9').select2({
                            theme: 'bootstrap4',
                        });
                        $('#periodo10').select2({
                            theme: 'bootstrap4',
                        });
                    });
                </script>

            </div>
        </div>
    </div>

</div>
<!-- /.content-wrapper -->

<?php include('layout/mensajes.php'); ?>
<?php include('layout/parte2.php'); ?>