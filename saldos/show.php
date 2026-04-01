<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');

include ('../app/controllers/saldos/show_saldo.php');

include ('../app/controllers/banco_tyt/listado_banco_tyt.php');
include ('../app/controllers/cuenta_tyt/listado_cuenta_tyt.php');
include ('../app/controllers/nombre_cuenta/listado_nombre_cuenta.php');
include ('../app/controllers/tipo_cuenta/listado_tipo_cuenta.php');
include ('../app/controllers/situacion_cuenta/listado_situacion_cuenta.php');
include ('../app/controllers/estado_saldo/listado_estado_saldo.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Datos del Saldo Bancario</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/saldos"><i class="bi bi-check-circle-fill"></i>
                                Saldo Banco</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-search"></i> Informacion de Saldo Bancario</a></li>
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
                            <h3 class="card-title">Informacion del Saldo Bancario seleccionado</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: block;">



                        <form action="#">
                                <input class="form-control " type="text" name="id_saldo_bancario"
                                    value="<?php echo $id_saldo_bancario; ?>" hidden>
                                <input class="form-control " type="text" name="id_usuario"
                                    value="<?php echo $id_usuario_sesion; ?>" hidden>
                                <div class="form-row">

                                <?php

                                        $sql_cuenta = "SELECT cuenta.id_cuenta_tyt as id_cuenta_tyt,
                                        cuenta.numero_cuenta_tyt as numero_cuenta_tyt,
                                        banco_tyt.id_banco_tyt as id_banco,
                                        banco_tyt.nombre_banco as nombre_banco 
                                        FROM tb_cuenta_tyt as cuenta 
                                        INNER JOIN tb_banco_tyt as banco_tyt ON banco_tyt.id_banco_tyt= cuenta.id_banco 
                                        where cuenta.id_cuenta_tyt!=1 AND banco_tyt.nombre_banco='$nombre_banco' ORDER BY banco_tyt.nombre_banco ASC";
                                        $query_cuenta = $pdo->prepare($sql_cuenta);
                                        $query_cuenta->execute();
                                        $cuenta_tyt_datos = $query_cuenta->fetchAll(PDO::FETCH_ASSOC);


                                        $sql_nombre = "SELECT nombre_cuenta.id_nombre_cuenta as id_nombre_cuenta,
                                        nombre_cuenta.nombre_cuenta as nombre_cuenta,
                                        cuenta_tyt.id_cuenta_tyt as id_cuenta_tyt,
                                        cuenta_tyt.numero_cuenta_tyt as numero_cuenta_tyt,
                                        banco_tyt.nombre_banco as nombre_banco
                                        FROM tb_nombre_cuenta as nombre_cuenta 
                                        INNER JOIN tb_cuenta_tyt as cuenta_tyt ON cuenta_tyt.id_cuenta_tyt = nombre_cuenta.id_numero_cuenta  
                                        LEFT JOIN tb_banco_tyt as banco_tyt ON banco_tyt.id_banco_tyt= cuenta_tyt.id_banco  
                                        WHERE nombre_cuenta.id_nombre_cuenta!=1 AND cuenta_tyt.numero_cuenta_tyt='$numero_cuenta' ORDER BY nombre_cuenta.nombre_cuenta ASC";
                                        $query_nombre = $pdo->prepare($sql_nombre);
                                        $query_nombre->execute();
                                        $nombre_cuenta_datos = $query_nombre->fetchAll(PDO::FETCH_ASSOC);
                                ?>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Banco</label>
                                        <select class="form-control " name="banco" id="combo_banco" style="width:100%" disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($banco_tyt_datos as $banco_tyt_dato) {
                                                $nombre_banco_tabla = $banco_tyt_dato['nombre_banco'];
                                                $id_banco_tyt = $banco_tyt_dato['id_banco_tyt']; ?>
                                                <option value="<?php echo $nombre_banco_tabla; ?>" <?php if ($nombre_banco_tabla == $nombre_banco) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $nombre_banco_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Cuenta</label>
                                        <select class="form-control " name="cuenta" id="combo_cuenta"
                                            style="width:100%" disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($cuenta_tyt_datos as $cuenta_tyt_dato) { 
                                                $numero_cuenta_tyt_tabla = $cuenta_tyt_dato['numero_cuenta_tyt'];
                                                $id_cuenta_tyt_tabla = $cuenta_tyt_dato['id_cuenta_tyt']; ?>
                                                <option value="<?php echo $numero_cuenta_tyt_tabla; ?>" <?php if ($numero_cuenta_tyt_tabla == $numero_cuenta) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $numero_cuenta_tyt_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Nombre</label>
                                        <select class="form-control " name="nombre" id="combo_nombre"
                                            style="width:100%" disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($nombre_cuenta_datos as $nombre_cuenta_dato) { 
                                                $nombre_cuenta_tabla = $nombre_cuenta_dato['nombre_cuenta'];
                                                $id_nombre_cuenta_tabla = $nombre_cuenta_dato['id_nombre_cuenta']; ?>
                                                <option value="<?php echo $nombre_cuenta_tabla; ?>" <?php if ($nombre_cuenta_tabla == $nombre_cuenta) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_cuenta_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <script>
                                        $(document).ready(function () {

                                            $('#combo_banco').change(function () {

                                                $('#combo_nombre').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

                                                $("#combo_banco option:selected").each(function () {
                                                    var nombre_banco = $('#combo_banco').val();
                                                    $.post("../app/controllers/banco_tyt/consulta_cuenta.php",
                                                        { nombre_banco: nombre_banco }, function (data) {
                                                            $("#combo_cuenta").html(data);
                                                        });
                                                });

                                            });
                                        });

                                        $(document).ready(function () {

                                            $('#combo_cuenta').change(function () {

                                                $("#combo_cuenta option:selected").each(function () {
                                                    var numero_cuenta = $('#combo_cuenta').val();
                                                    $.post("../app/controllers/banco_tyt/consulta_nombre.php",
                                                        { numero_cuenta: numero_cuenta }, function (data) {
                                                            $("#combo_nombre").html(data);
                                                        });
                                                });

                                            });
                                        });


                                    </script>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Tipo de Cuenta</label>
                                        <select class="form-control " name="tipo" id="combo_tipo" style="width:100%" disabled>
                                            <option value="1">SELECCIONAR</option>
                                            <?php
                                            foreach ($tipo_cuenta_datos as $tipo_cuenta_dato) {
                                                $cuenta_saldo_tabla = $tipo_cuenta_dato['cuenta_saldo'];
                                                $id_cuenta_saldo = $tipo_cuenta_dato['id_cuenta_saldo']; ?>
                                                <option value="<?php echo $id_cuenta_saldo; ?>" <?php if ($cuenta_saldo_tabla == $cuenta_saldo) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $cuenta_saldo_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Situacion</label>
                                        <select class="form-control " name="situacion" id="combo_situacion"
                                            style="width:100%" disabled>
                                            <option value="1">SELECCIONAR</option>
                                            <?php
                                            foreach ($situacion_saldo_datos as $situacion_saldo_dato) {
                                                $nombre_situacion_tabla = $situacion_saldo_dato['nombre_situacion'];
                                                $id_situacion_saldo = $situacion_saldo_dato['id_situacion_saldo']; ?>
                                                <option value="<?php echo $id_situacion_saldo; ?>" <?php if ($nombre_situacion_tabla == $nombre_situacion) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $nombre_situacion_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">

                                    </div>


                                    <div class="form-group col-md-4" id="" hidden>
                                        <label for="">Detalle de la cuenta</label>
                                        <input type="text" class="form-control " name="detalle_cuenta"
                                            value="<?php echo $detalle_cuenta; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Saldo</label>
                                        <input type="date" class="form-control " name="fecha" value="<?php echo $fecha; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Monto (S/.)</label>
                                        <input type="text" class="form-control " name="monto" value="<?php echo $monto_saldo; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="campo_estado">
                                        <label for="">Estado</label>
                                        <select class="form-control " name="id_estado_saldo" id="combo_estado"
                                            style="width:100%" disabled>
                                            <option value="1">SELECCIONAR</option>
                                            <?php
                                            foreach ($estado_saldo_datos as $estado_saldo_dato) {
                                                $nombre_estado_tabla = $estado_saldo_dato['nombre_estado'];
                                                $id_estado_saldo = $estado_saldo_dato['id_estado_saldo']; ?>
                                                <option value="<?php echo $id_estado_saldo; ?>" <?php if ($nombre_estado_tabla == $nombre_estado) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $nombre_estado_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    

                                    <div class="form-group col-md-4" id="">
                                        <label for="">Observacion</label>
                                        <input type="text" class="form-control " name="observacion" placeholder="Observacion" value="<?php echo $observacion; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="campo_estado">
                                       
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha de Registro</label>
                                        <input type="date" class="form-control " name="fecha" value="<?php echo $fecha; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Usuario</label>
                                        <input type="text" class="form-control " name="usuario" value="<?php echo $usuario; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-12" align="right">
                                       
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

                                        $('#combo_banco').select2({
                                            theme: 'bootstrap4',
                                        });
                                        $('#combo_cuenta').select2({
                                            theme: 'bootstrap4',
                                        });
                                        $('#combo_nombre').select2({
                                            theme: 'bootstrap4',
                                        });
                                        $('#combo_tipo').select2({
                                            theme: 'bootstrap4',
                                        });
                                        $('#combo_situacion').select2({
                                            theme: 'bootstrap4',
                                        });
                                        $('#combo_estado').select2({
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

<?php include ('../layout/mensajes.php'); ?>
<?php include ('../layout/parte2.php'); ?>