<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');
include('../layout/mensajes.php');

include('../app/controllers/anio_nt/listado_de_anios.php');
include('../app/controllers/asuntos/listado_de_asuntos.php');
include('../app/controllers/tipo_gasto/listado_tipo_gasto.php');


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Registrar Nuevo Cheque</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/cheques"><i class="bi bi-wallet"></i>
                                Cheques</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-clipboard-check"></i> Registrar nuevo
                            cheque</a></li>
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
                            <h3 class="card-title">Digite los datos sobre el nuevo cheque</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: inline;">
                            <form action="../app/controllers/cheque/create.php" method="post">
                                <input type="text" name="id_usuario" value="<?php echo $id_usuario_sesion; ?>" hidden>

                                <?php

                                $sql_cheque = "SELECT MAX(id_cheque) AS id_cheque FROM tb_cheque where visible!=1";
                                $query_cheque = $pdo->prepare($sql_cheque);
                                $query_cheque->execute();
                                $cheque_datos = $query_cheque->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($cheque_datos as $cheque_dato) {
                                    $id_cheque = $cheque_dato['id_cheque'];
                                }

                                if ($id_cheque != null) {
                                    $id_cheque = $cheque_dato['id_cheque'] + 1; //autoincrementa el numero de informe
                                } else {
                                    $id_cheque = 1; //empieza con 1
                                }

                                ?>

                                <input type="text" name="id_cheque" id="id_cheque" value="<?php echo $id_cheque; ?>" hidden>

                                <div class="form-row">

                                    <div class="form-group col-md-2" id="campo_nt">
                                        <label for="">NT.</label>
                                        <input type="text" class="form-control " name="nt"
                                            onkeypress='return validaNumericos(event)' id="numero_tramite"
                                            placeholder="Número NT" required>
                                    </div>

                                    <div class="form-group col-md-2" id="campo_anio_nt">
                                        <label for="">Año</label>
                                        <select class="form-control " name="id_anio_nt" id="comboaniont"
                                            style="width:100%" required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($anios_datos as $anios_dato) { ?>
                                                <option value="<?php echo $anios_dato['id_anio_nt']; ?>">
                                                    <?php echo $anios_dato['anio_nt']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>


                                    <div class="form-group col-md-2" id="campo_proveido">
                                        <label for="">Proveido (DIGA)</label>
                                        <input type="text" class="form-control " name="proveido_diga" id="proveido"
                                            placeholder="Número de Proveido" onkeypress='return validaNumericos(event)'>
                                    </div>

                                    <div class="form-group col-md-2" id="campo_fecha_proveido">
                                        <label for="">Fecha</label>
                                        <input type="date" class="form-control " name="fecha_proveido_diga"
                                            id="fecha_proveido">
                                    </div>

                                    <div class="form-group col-md-4" id="">

                                    </div>

                                    <div class="form-group col-md-2" id="campo_proveido">
                                        <label for="">Proveido (CONTABILIDAD)</label>
                                        <input type="text" class="form-control " name="proveido_conta" id="proveido"
                                            placeholder="Número de Proveido" onkeypress='return validaNumericos(event)'>
                                    </div>

                                    <div class="form-group col-md-2" id="campo_fecha_proveido">
                                        <label for="">Fecha</label>
                                        <input type="date" class="form-control " name="fecha_proveido_conta"
                                            id="fecha_proveido">
                                    </div>

                                    <div class="form-group col-md-2" id="campo_informe">
                                        <label for="">Informe</label>
                                        <input type="text" class="form-control " name="informe" id="informe"
                                            placeholder="Informe y Dependencias">
                                    </div>

                                    <div class="form-group col-md-2" id="campo_fecha_informe">
                                        <label for="">Fecha</label>
                                        <input type="date" class="form-control " name="fecha_informe"
                                            id="fecha_informe">
                                    </div>



                                    <div class="form-group col-md-2" id="campo_asunto">
                                        <label for="">Asunto</label>
                                        <div style="display: flex;">
                                            <select class="form-control " name="id_asunto" id="comboasunto"
                                                style="width:100%">
                                                <option value="1">SELECCIONAR</option>
                                                <?php
                                                foreach ($asuntos_datos as $asuntos_dato) { ?>
                                                    <option value="<?php echo $asuntos_dato['id_asunto']; ?>">
                                                        <?php echo $asuntos_dato['nombre_asunto']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#modal-create-asunto">+</button>
                                        </div>

                                    </div>

                                    <div class="form-group col-md-2" id="">

                                    </div>

                                    <div class="form-group col-md-2" id="campo_tipo_gasto">
                                        <label for="">Tipo de gasto</label>
                                        <select class="form-control " name="id_tipo_gasto" id="combotipogasto"
                                            style="width:100%">
                                            <option value="1">SELECCIONAR</option>
                                            <?php
                                            foreach ($tipo_gasto_datos as $tipo_gasto_dato) { ?>
                                                <option value="<?php echo $tipo_gasto_dato['id_tipo_gasto']; ?>">
                                                    <?php echo $tipo_gasto_dato['nombre_tipo_gasto']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>


                                    <div class="form-group col-md-2" id="campo_oficio">
                                        <label for="">Oficio</label>
                                        <input type="text" class="form-control " name="oficio"
                                            placeholder="Número de Oficio y Dependencias">
                                    </div>

                                    <div class="form-group col-md-2" id="campo_fecha_oficio">
                                        <label for="">Fecha</label>
                                        <input type="date" class="form-control " name="fecha_oficio">
                                    </div>


                                    <div class="form-group col-md-2" style="line-height: 100px;" id="boton_ingresos">
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

                                    <div class="form-group col-md-12" align="right">
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i>
                                            Guardar</button>
                                        <a href="index" class="btn" style="background-color: grey; color: white;"><i
                                                class="bi bi-x-circle-fill"></i> Cancelar</a>

                                    </div>
                                </div>

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
<div class="modal fade" id="modal-create-asunto">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: black; color: white">
                <h4 class="modal-title">Registrar Nuevo Asunto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Nombre de Asunto</label>
                            <input type="text" id="nombre_asunto" class="form-control ">
                            <small style="color: red; display: none" id="lbl_create">* Este campo es requerido</small>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-primary" id="btn_create"><i class="bi bi-floppy-fill"></i>
                    Guardar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="bi bi-x-circle"></i>
                    Cancelar</button>


            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    $('#btn_create').click(function () {
        var nombre_asunto = $('#nombre_asunto').val();

        if (nombre_asunto == "") {
            $('#nombre_asunto').focus();
            $('#lbl_create').css('display', 'block');
        } else {
            var url = "../app/controllers/asuntos/create.php";
            $.get(url, { nombre_asunto: nombre_asunto }, function (datos) {
                $('#respuesta').html(datos);
            });
        }

    });
</script>
<div id="respuesta"></div>

<?php include('../layout/parte2.php'); ?>