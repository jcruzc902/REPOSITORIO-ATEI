<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-10">
                    <h1 class="m-0"><b>Asistente Virtual IA</b> </h1>
                </div><!-- /.col -->
                <div class="col-sm-2">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-search"></i> Soporte</li>
                    </ol>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">ASISTENTE DE SOPORTE VIRTUAL IA</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <style>
                            /* CSS para el formulario de consulta a GEMINI */

                            textarea {
                                width: 100%;
                                height: 100px;
                                font-size: 16px;
                                padding: 10px;
                                border: 1px solid #ccc;
                                border-radius: 5px;
                            }

                            button {
                                cursor: pointer;
                                background-color: #3498db;
                                color: #fff;
                                padding: 10px 20px;
                                border: 1px solid #3498db;
                                border-radius: 5px;
                                font-size: 16px;
                                margin-top: 10px;
                            }

                            button:hover {
                                background-color: #2980b9;
                            }

                            button:disabled {
                                opacity: 0.5;
                            }

                            pre {
                                background-color: #f5f5f5;
                                padding: 10px;
                                border: 1px solid #ccc;
                                border-radius: 5px;
                                font-size: 16px;
                                margin-top: 10px;
                                white-space: pre-wrap;
                                overflow: auto;
                            }
                        </style>

                        <div class="card-body table-responsive" style="display: block;">

                            <div class="contenedor">

                                <form id="formulario1">
                                    <div>
                                        <textarea id="consulta" name="consulta"
                                            placeholder="Pregunta al Asistente IA"></textarea>
                                    </div>
                                    <input type="submit" class="btn" style="background-color: black; color: white;" id="enter" value="Consultar">
                                    

                                    <pre id="resultado"></pre>
                                </form>
                            </div>

                            <!--automatizar con boton Enter-->
                            <script>


                                document.getElementById('consulta').addEventListener('keydown', function (e) {

                                    //si presiona el teclado Enter
                                    if (e.keyCode === 13) {
                                        // entonces haces lo que quieras para poder reaccionar a la pulsación del enter.

                                        // se establecera como clic en el boton Iniciar Consulta
                                        $("#enter").click();
                                    }
                                });


                            </script>

                            <script>
                                const formulario1 = document.querySelector("#formulario1")

                                formulario1.addEventListener("submit", evento => {
                                    evento.preventDefault()

                                    const consulta = document.querySelector("#consulta").value.trim()
                                    const botonConsultar = document.querySelector("input[type='submit']")

                                    // Desactivar el botón y mostrar mensaje de espera
                                    botonConsultar.disabled = true;
                                    botonConsultar.value = "Espere, por favor..."

                                    const datosFormulario = new FormData()
                                    datosFormulario.append("consulta", consulta)

                                    fetch("consulta.php", {
                                        method: 'POST',
                                        body: datosFormulario
                                    }).then(respuesta => respuesta.json())
                                        .then(respuesta => {
                                            // Mostrar la respuesta y reactivar el botón
                                            document.querySelector("#resultado").innerHTML = `${respuesta.mensaje}<br>`
                                            botonConsultar.disabled = false
                                            botonConsultar.value = "Consultar"
                                        })
                                        .catch(error => {
                                            console.error('Error en la solicitud fetch:', error)
                                            // Reactivar el botón en caso de error
                                            botonConsultar.disabled = false
                                            botonConsultar.value = "Consultar"
                                        })
                                });
                            </script>









                        </div>

                    </div>
                </div>
            </div>



            <br>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>




<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>