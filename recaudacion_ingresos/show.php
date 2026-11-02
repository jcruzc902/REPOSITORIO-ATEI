<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');

include('../app/controllers/recaudacion_ingresos/show_recaudacion.php');

include('../app/controllers/dependencia_ingresos/listado_dependencia.php');
include('../app/controllers/banco_ingresos/listado_banco_ingresos.php');
include('../app/controllers/banco_tyt/listado_banco_tyt.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Datos de la Recaudacion de Ingreso</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/recaudacion_ingresos"><i
                                    class="bi bi-check-circle-fill"></i>
                                Recaudacion de Ingresos</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-search"></i> Informacion de Recaudacion de Ingreso</a></li>
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
                            <h3 class="card-title">Informacion de Recaudacion de Ingreso seleccionado</h3>
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

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Dependencia</label>
                                        <select class="form-control " name="dependencia" id="combo_dependencia"
                                            style="width:100%" disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($dependencias_ing_datos as $dependencias_ing_dato) {
                                                $nombre_dependencia_tabla = $dependencias_ing_dato['nombre_dependencia'];
                                                $id_dependencia_ingresos = $dependencias_ing_dato['id_dependencia_ingresos']; ?>

                                                ?>
                                                <option value="<?php echo $nombre_dependencia_tabla; ?>" <?php if ($nombre_dependencia_tabla == $nombre_dependencia) { ?>
                                                        selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_dependencia_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-3" id="detalle_concepto">
                                        <label for="">Detalle del concepto</label>
                                        <input type="text" class="form-control " name="detalle_concepto"
                                            value="<?php echo $detalle_concepto; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Banco (Casilleros)</label>
                                        <select class="form-control " name="banco" id="combo_banco" style="width:100%"
                                            disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($banco_ingresos_datos as $banco_ingresos_dato) {
                                                $nombre_banco_tabla = $banco_ingresos_dato['nombre_banco'];
                                                $id_banco_ingreso = $banco_ingresos_dato['id_banco_ingreso']; ?>

                                                ?>
                                                <option value="<?php echo $nombre_banco_tabla; ?>" <?php if ($nombre_banco_tabla == $nombre_banco) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_banco_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="detalle_concepto" hidden>
                                        <label for="">Cuenta (Opcional)</label>
                                        <input type="text" class="form-control " name="cuenta"
                                            value="<?php echo $numero_cuenta; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha de recaudacion</label>
                                        <input type="date" class="form-control " name="fecha_recaudacion"
                                            value="<?php echo $fecha_recaudacion; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Nombre del encargado</label>
                                        <input type="text" class="form-control " name="nombre_encargado"
                                            value="<?php echo $nombre_encargado; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-3" id="">
                                        <label for="">Documento de recepcion</label>
                                        <input type="text" class="form-control " name="documento_recepcion"
                                            value="<?php echo $documento_recepcion; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Monto recaudado (S/.)</label>
                                        <input type="text" class="form-control " name="monto_recaudado"
                                            onkeypress='return validaNumericos(event)'
                                            value="<?php echo $monto_recaudado; ?>" disabled>
                                    </div>

                                    <?php

                                    //$nombre_banco_x = "BANCO DE LA NACION";
                                    
                                    $sql_cuenta = "SELECT cuenta.id_cuenta_tyt as id_cuenta_tyt,
                                        cuenta.numero_cuenta_tyt as numero_cuenta_tyt,
                                        banco_tyt.id_banco_tyt as id_banco,
                                        banco_tyt.nombre_banco as nombre_banco 
                                        FROM tb_cuenta_tyt as cuenta 
                                        INNER JOIN tb_banco_tyt as banco_tyt ON banco_tyt.id_banco_tyt= cuenta.id_banco 
                                        where cuenta.id_cuenta_tyt!=1 AND banco_tyt.nombre_banco='$nombre_banco2' ORDER BY banco_tyt.nombre_banco ASC";
                                    $query_cuenta = $pdo->prepare($sql_cuenta);
                                    $query_cuenta->execute();
                                    $cuenta_tyt_datos = $query_cuenta->fetchAll(PDO::FETCH_ASSOC);

                                    //$numero_cuenta = "0000-257443";
                                    
                                    ?>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Banco deposito</label>
                                        <select class="form-control " name="banco_deposito" id="combo_banco_deposito"
                                            style="width:100%" disabled>

                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($banco_tyt_datos as $banco_tyt_dato) {
                                                $nombre_banco_tabla = $banco_tyt_dato['nombre_banco']; ?>
                                                <option value="<?php echo $nombre_banco_tabla; ?>" <?php if ($nombre_banco_tabla == $nombre_banco2) { ?>
                                                        selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_banco_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>


                                    <div class="form-group col-md-2" id="">
                                        <label for="">Cuenta deposito</label>
                                        <select class="form-control " name="cuenta_deposito" id="combo_cuenta_deposito"
                                            style="width:100%" disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($cuenta_tyt_datos as $cuenta_tyt_dato) {
                                                $numero_cuenta_tyt_tabla = $cuenta_tyt_dato['numero_cuenta_tyt'];
                                                $id_cuenta_tyt_tabla = $cuenta_tyt_dato['id_cuenta_tyt']; ?>
                                                <option value="<?php echo $numero_cuenta_tyt_tabla; ?>" <?php if ($numero_cuenta_tyt_tabla == $numero_cuenta2) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $numero_cuenta_tyt_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>

                                        </select>

                                    </div>

                                    <script>
                                        $(document).ready(function () {

                                            $('#combo_banco_deposito').change(function () {

                                                //$('#combo_nombre').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

                                                $("#combo_banco_deposito option:selected").each(function () {
                                                    var nombre_banco = $('#combo_banco_deposito').val();
                                                    $.post("../app/controllers/banco_tyt/consulta_cuenta.php",
                                                        { nombre_banco: nombre_banco }, function (data) {
                                                            $("#combo_cuenta_deposito").html(data);
                                                        });
                                                });

                                            });
                                        });



                                    </script>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha de deposito</label>
                                        <input type="date" class="form-control " name="fecha_deposito"
                                            value="<?php echo $fecha_deposito; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Codigo de operacion</label>
                                        <input type="text" class="form-control " name="numero_operacion"
                                            onkeypress='return validaNumericos(event)'
                                            value="<?php echo $numero_operacion; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">N° documento</label>
                                        <input type="text" class="form-control " name="nro_documento"
                                            onkeypress='return validaNumericos(event)'
                                            value="<?php echo $numero_documento; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Importe (S/.)</label>
                                        <input type="text" class="form-control " name="importe"
                                            onkeypress='return validaNumericos(event)' value="<?php echo $importe; ?>"
                                            disabled>
                                    </div>

                                    <div class="form-group col-md-3" id="">
                                        <label for="">Nombre del depositante</label>
                                        <input type="text" class="form-control " name="nombre_depositante"
                                            value="<?php echo $nombre_depositante; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">N° DNI</label>
                                        <input type="text" class="form-control " name="numero_dni"
                                            onkeypress='return validaNumericos(event)' value="<?php echo $dni; ?>"
                                            disabled>
                                    </div>


                                    

                                    <div class="form-group col-md-2">
                                        <label>Estado</label>

                                        <select class="form-control" name="estado" id="combo_estado" style="width:100%"
                                            disabled>

                                            <option value="">SELECCIONAR</option>

                                            <option value="PAGADO" <?php if ($estado_recaudacion == 'PAGADO')
                                                echo 'selected'; ?>>
                                                PAGADO
                                            </option>

                                            <option value="PENDIENTE" <?php if ($estado_recaudacion == 'PENDIENTE')
                                                echo 'selected'; ?>>
                                                PENDIENTE
                                            </option>

                                            <option value="ANULADO" <?php if ($estado_recaudacion == 'ANULADO')
                                                echo 'selected'; ?>>
                                                ANULADO
                                            </option>

                                        </select>
                                    </div>

                                    <?php
                                    $theDate = new DateTime($fyh_creacion);
                                    $fyh_creacion = $theDate->format('d/m/Y h:i:s a');
                                    ?>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha de Registro</label>
                                        <input type="text" class="form-control " name="fecha" value="<?php echo $fyh_creacion; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Usuario</label>
                                        <input type="text" class="form-control " name="usuario"
                                            value="<?php echo $usuario; ?>" disabled>
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

<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>