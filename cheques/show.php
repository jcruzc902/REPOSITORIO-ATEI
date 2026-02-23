<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');

include ('../app/controllers/cheque/show_cheque.php');

include ('../app/controllers/anio_nt/listado_de_anios.php');
include ('../app/controllers/asuntos/listado_de_asuntos.php');
include ('../app/controllers/tipo_gasto/listado_tipo_gasto.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Datos del Cheque</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/cheques"><i class="bi bi-wallet"></i>
                                Cheques</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-search"></i> Informacion de Cheque</a></li>
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
                            <h3 class="card-title">Informacion de Cheque seleccionado</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: block;">



                            <form action="#">
                                

                                <div class="form-row">

                                    <input class="form-control " type="text" name="id_cheque" id="id_cheque"
                                        value="<?php echo $id_cheque; ?>" hidden>

                                    <div class="form-group col-md-2" id="campo_nt">
                                        <label for="">NT.</label>
                                        <input type="text" class="form-control " name="nt"
                                            onkeypress='return validaNumericos(event)' id="numero_tramite"
                                            placeholder="Número NT" value="<?php echo $nt; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="campo_nt" hidden>
                                        <label for="">NT.</label>
                                        <input type="text" class="form-control " name="nt"
                                            onkeypress='return validaNumericos(event)' id="numero_tramite"
                                            placeholder="Número NT" value="<?php echo $nt; ?>" >
                                    </div>

                                    <div class="form-group col-md-2" id="campo_anio_nt">
                                        <label for="">Año</label>
                                        <select class="form-control " name="id_anio_nt" id="comboaniont"
                                            style="width:100%" disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($anios_datos as $anios_dato) {
                                                $anio_nt_tabla = $anios_dato['anio_nt'];
                                                $id_anio_nt = $anios_dato['id_anio_nt']; ?>
                                                <option value="<?php echo $id_anio_nt; ?>" <?php if ($anio_nt_tabla == $nt_anio) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $anio_nt_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" hidden>
                                        <label for="">Año</label>
                                        <select class="form-control " name="id_anio_nt" id="comboaniont"
                                            style="width:100%" >
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($anios_datos as $anios_dato) {
                                                $anio_nt_tabla = $anios_dato['anio_nt'];
                                                $id_anio_nt = $anios_dato['id_anio_nt']; ?>
                                                <option value="<?php echo $id_anio_nt; ?>" <?php if ($anio_nt_tabla == $nt_anio) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $anio_nt_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>


                                    <div class="form-group col-md-2" id="campo_proveido">
                                        <label for="">Proveido (DIGA)</label>
                                        <input type="text" class="form-control " name="proveido_diga" id="proveido"
                                            placeholder="Número de Proveido" onkeypress='return validaNumericos(event)'
                                            value="<?php echo $proveido_diga; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="campo_fecha_proveido">
                                        <label for="">Fecha</label>
                                        <input type="date" class="form-control " name="fecha_proveido_diga"
                                            id="fecha_proveido" value="<?php echo $fecha_diga; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-4" id="">

                                    </div>


                                    <div class="form-group col-md-2" id="campo_proveido">
                                        <label for="">Proveido (CONTABILIDAD)</label>
                                        <input type="text" class="form-control " name="proveido_conta" id="proveido"
                                            placeholder="Número de Proveido" onkeypress='return validaNumericos(event)'
                                            value="<?php echo $proveido_conta; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="campo_fecha_proveido">
                                        <label for="">Fecha</label>
                                        <input type="date" class="form-control " name="fecha_proveido_conta"
                                            id="fecha_proveido" value="<?php echo $fecha_conta; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="campo_informe">
                                        <label for="">Informe</label>
                                        <input type="text" class="form-control " name="informe" id="informe"
                                            placeholder="Informe y Dependencias" value="<?php echo $informe; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="campo_fecha_informe">
                                        <label for="">Fecha</label>
                                        <input type="date" class="form-control " name="fecha_informe" id="fecha_informe"
                                            value="<?php echo $fecha_informe; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="campo_asunto">
                                        <label for="">Asunto</label>
                                        <select class="form-control " name="id_asunto" id="comboasunto"
                                            style="width:100%" disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($asuntos_datos as $asuntos_dato) {
                                                $nombre_asunto_tabla = $asuntos_dato['nombre_asunto'];
                                                $id_asunto = $asuntos_dato['id_asunto']; ?>
                                                <option value="<?php echo $id_asunto; ?>" <?php if ($nombre_asunto_tabla == $nombre_asunto) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $nombre_asunto_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" hidden>
                                        <label for="">Asunto</label>
                                        <select class="form-control " name="id_asunto" id="comboasunto"
                                            style="width:100%" >
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($asuntos_datos as $asuntos_dato) {
                                                $nombre_asunto_tabla = $asuntos_dato['nombre_asunto'];
                                                $id_asunto = $asuntos_dato['id_asunto']; ?>
                                                <option value="<?php echo $id_asunto; ?>" <?php if ($nombre_asunto_tabla == $nombre_asunto) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $nombre_asunto_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">

                                    </div>
                                    
                                    

                                    <div class="form-group col-md-2" id="campo_tipo_gasto">
                                        <label for="">Tipo de gasto</label>
                                        <select class="form-control " name="id_tipo_gasto" id="combotipogasto"
                                            style="width:100%" disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($tipo_gasto_datos as $tipo_gasto_dato) {
                                                $nombre_tipo_gasto_tabla = $tipo_gasto_dato['nombre_tipo_gasto'];
                                                $id_tipo_gasto = $tipo_gasto_dato['id_tipo_gasto']; ?>
                                                <option value="<?php echo $id_tipo_gasto; ?>" <?php if ($nombre_tipo_gasto_tabla == $nombre_tipo_gasto) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_tipo_gasto_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="campo_oficio">
                                        <label for="">Oficio</label>
                                        <input type="text" class="form-control " name="oficio"
                                            placeholder="Número de Oficio y Dependencias" value="<?php echo $oficio; ?>"
                                            disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="campo_fecha_oficio">
                                        <label for="">Fecha</label>
                                        <input type="date" class="form-control " name="fecha_oficio"
                                            value="<?php echo $fecha_oficio; ?>" disabled>
                                    </div>


                                    <div class="form-group col-md-2" style="line-height: 100px;" id="boton_ingresos" hidden>
                                        <a href="javascript:window.open('../app/controllers/cheque/recargar.php','','width=1650, height=800');"
                                            id="boton_vouchers" class="btn btn-lg"
                                            style="background-color: black; color: white;">
                                            <i class="bi bi-box-arrow-in-up-right"></i> Consulta de Pagos</a>

                                    </div>

                                    <script>
                                        $('#boton_vouchers').click(function () {
                                            var numero_tramite = $('#numero_tramite').val();
                                            var anio_nt = $('#comboaniont').val();
                                            var asunto = $('#comboasunto').val();
                                            var id_cheque = $('#id_cheque').val();

                                            var url = "../app/controllers/cheque/global.php";
                                            $.get(url, {
                                                numero_tramite: numero_tramite, anio_nt: anio_nt, asunto: asunto, id_cheque: id_cheque
                                            }, function (datos) { });

                                        });
                                    </script>

                                    

                                    <div class="form-group col-md-2" id="campo_usuario">
                                        <label for="">Usuario</label>
                                        <input type="text" class="form-control " name="usuario"
                                            placeholder="Usuario" value="<?php echo $usuario; ?>"
                                            disabled>
                                    </div>

                                    <div class="form-group col-md-6" id="campo_observacion">
                                        <label for="">Observacion</label>
                                        <input type="text" class="form-control " name="observacion"
                                            placeholder="Observacion" value="<?php echo $observacion; ?>" disabled>
                                    </div>

                                    <script>
                                        $('#boton_vouchers').click(function () {
                                            var numero_tramite = $('#numero_tramite').val();
                                            var anio_nt = $('#comboaniont').val();
                                            var asunto= $('#comboasunto').val();
                                            var id_cheque = $('#id_cheque').val();

                                            var url = "../app/controllers/cheque/global.php";
                                            $.get(url, {
                                                numero_tramite: numero_tramite, anio_nt: anio_nt, asunto: asunto, id_cheque: id_cheque
                                            }, function (datos) { });

                                        });
                                    </script>

                                    <script>
                                        function validaNumericos(event) {
                                            if ((event.charCode >= 48 && event.charCode <= 57)) {
                                                return true;
                                            }

                                            if ((event.charCode == 45)) {
                                                return true;
                                            }

                                            if ((event.charCode == 46)) {
                                                return true;
                                            }
                                            return false;
                                        }
                                    </script>

                                    <script>
                                        $(document).ready(function () {

                                            $('#comboaniont').select2({
                                                theme: 'bootstrap4',
                                            });
                                            $('#comboasunto').select2({
                                                theme: 'bootstrap4',
                                            });
                                            $('#combotipogasto').select2({
                                                theme: 'bootstrap4',
                                            });

                                        });
                                    </script>

                                    <div class="form-group col-md-12" align="right">
                                        <a href="index" class="btn" style="background-color: grey; color: white;"><i
                                                class="bi bi-x-circle-fill"></i> Cancelar</a>

                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include ('../layout/mensajes.php'); ?>
<?php include ('../layout/parte2.php'); ?>