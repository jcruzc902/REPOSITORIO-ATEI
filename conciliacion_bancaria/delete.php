<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');

include('../app/controllers/conciliacion_bancaria/show_conciliacion.php');

include('../app/controllers/mes_conciliacion/listado_mes_conciliacion.php');
include('../app/controllers/anio_cb/listado_anio_cb.php');
include('../app/controllers/facultades_cb/listado_facultades_cb.php');
include('../app/controllers/clasificador_cb/listado_clasificador_cb.php');
include('../app/controllers/banco_cb/listado_banco_cb.php');
include('../app/controllers/cta_cb/listado_cta_cb.php');
include('../app/controllers/estado_conciliacion/listado_de_estado_cb.php');


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Eliminar Ingreso</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/conciliacion_bancaria"><i class="bi bi-cash"></i> Conciliacion bancaria</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-x-octagon-fill"></i> Eliminar Ingreso</a></li>
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
                            <h3 class="card-title">¿Esta seguro de eliminar el ingreso seleccionado?</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: block;">



                            <form action="../app/controllers/conciliacion_bancaria/ocultar_conciliacion.php" method="post">
                                <input class="form-control " type="text" name="id_ingresos"
                                    value="<?php echo $id_ingresos; ?>" hidden>
                                <input class="form-control " type="text" name="id_usuario"
                                    value="<?php echo $id_usuario_sesion; ?>" hidden>
                                <div class="form-row">

                                    <?php

                                    $sql_cuenta = "SELECT cuenta.id_cta as id_cta_cb,
                                    cuenta.numero_cta as numero_cta_cb,
                                    cuenta.id_banco as id_banco_cb,
                                    banco_cb.nombre_banco as nombre_banco_cb 
                                    FROM tb_cta_cb as cuenta 
                                    INNER JOIN tb_banco_cb as banco_cb ON banco_cb.id_banco= cuenta.id_banco 
                                    where cuenta.visible!=1 and banco_cb.nombre_banco='$banco_ingresos' ORDER BY cuenta.numero_cta ASC";
                                    $query_cuenta = $pdo->prepare($sql_cuenta);
                                    $query_cuenta->execute();
                                    $cuenta_cb_datos = $query_cuenta->fetchAll(PDO::FETCH_ASSOC);

                                    ?>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Mes conciliado</label>
                                        <select class="form-control " id="mes" name="mes"
                                            style="width:100%;" disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($mes_datos as $mes_dato) { ?>
                                                <option value="<?php echo $mes_dato['nombre_mes']; ?>" <?php if ($mes_dato['nombre_mes'] == $mes_ingresos) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $mes_dato['nombre_mes']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Año</label>
                                        <select class="form-control " id="anio" name="anio"
                                            style="width:100%;" disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($anio_cb_datos as $anio_cb_dato) { ?>
                                                <option value="<?php echo $anio_cb_dato['anio_nt']; ?>" <?php if ($anio_cb_dato['anio_nt'] == $anio_ingresos) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $anio_cb_dato['anio_nt']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha de ingresos</label>
                                        <input type="date" class="form-control " id="fecha" name="fecha" value="<?php echo $fecha_ingresos; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Clasificador</label>
                                        <select class="form-control " id="clasificador" name="clasificador"
                                            style="width:100%;" disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($clasificador_cb_datos as $clasificador_cb_dato) { ?>
                                                <option value="<?php echo $clasificador_cb_dato['clasificador_cb']; ?>" <?php if ($clasificador_cb_dato['clasificador_cb'] == $clasificador_ingresos) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $clasificador_cb_dato['clasificador_cb']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Importe (S/.)</label>
                                        <input type="text" class="form-control " id="importe" name="importe"
                                            placeholder="Digite el importe" onkeypress='return validaNumericos(event)' value="<?php echo $importe_ingresos; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">SIIC</label>
                                        <input type="text" class="form-control " id="siic" name="siic"
                                            placeholder="Digite numero SIIC" onkeypress='return validaNumericos(event)' value="<?php echo $siic_ingresos; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">SIAF</label>
                                        <input type="text" class="form-control " id="siaf" name="siaf"
                                            placeholder="Digite numero SIAF" onkeypress='return validaNumericos(event)' value="<?php echo $siaf_ingresos; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Dependencia/Facultad</label>
                                        <select class="form-control " id="dependencia" name="dependencia"
                                            style="width:100%;" disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($facultades_cb_datos as $facultades_cb_dato) { ?>
                                                <option value="<?php echo $facultades_cb_dato['nombre_facultad']; ?>" <?php if ($facultades_cb_dato['nombre_facultad'] == $dependencia_ingresos) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $facultades_cb_dato['nombre_facultad']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-4" id="">
                                        <label for="">Detalle</label>
                                        <input type="text" class="form-control " id="detalle" name="detalle"
                                            placeholder="Digite detalle de pago" value="<?php echo $detalle_ingresos; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">N° Recibo</label>
                                        <input type="text" class="form-control " id="nro_recibo" name="nro_recibo"
                                            placeholder="Digite detalle de pago" value="<?php echo $nro_recibo; ?>" disabled>
                                    </div>

                                    

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Banco</label>
                                        <select class="form-control " id="combo_banco" name="banco"
                                            style="width:100%;" disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($banco_cb_datos as $banco_cb_dato) { ?>
                                                <option value="<?php echo $banco_cb_dato['nombre_banco']; ?>" <?php if ($banco_cb_dato['nombre_banco'] == $banco_ingresos) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $banco_cb_dato['nombre_banco']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Cuenta</label>
                                        <select class="form-control " id="combo_cuenta" name="cuenta" style="width:100%;" disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($cuenta_cb_datos as $cta_cb_dato) {
                                                $numero_cta_tabla = $cta_cb_dato['numero_cta_cb'];
                                                $id_cta = $cta_cb_dato['id_cta_cb']; ?>
                                                <option value="<?php echo $numero_cta_tabla; ?>" <?php if ($numero_cta_tabla == $cta_ingresos) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $numero_cta_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <script>
                                        $(document).ready(function () {

                                            $('#combo_banco').change(function () {

                                                //$('#combo_nombre').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

                                                $("#combo_banco option:selected").each(function () {
                                                    var nombre_banco = $('#combo_banco').val();
                                                    $.post("../app/controllers/banco_cb/consulta_cuenta.php",
                                                        { nombre_banco: nombre_banco }, function (data) {
                                                            $("#combo_cuenta").html(data);
                                                        });
                                                });

                                            });
                                        });
                                    </script>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Nombre</label>
                                        <input type="text" class="form-control " id="nombre" name="nombre"
                                            placeholder="Digite nombre de la cuenta" value="<?php echo $nombre_ingresos; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Estado</label>
                                        <select class="form-control " id="estado" name="estado"
                                            style="width:100%;" disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($estado_conciliacion_datos as $estado_conciliacion_dato) { ?>
                                                <option value="<?php echo $estado_conciliacion_dato['nombre_estado']; ?>"  <?php if ($estado_conciliacion_dato['nombre_estado'] == $estado) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $estado_conciliacion_dato['nombre_estado']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha de creacion</label>
                                        <input type="text" class="form-control " id="fecha_creacion"
                                            name="fecha_creacion" value="<?php echo $fyh_creacion; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-4" id="">
                                        <label for="">Observacion</label>
                                        <input type="text" class="form-control " id="observacion_eliminar"
                                            name="observacion_eliminar" placeholder="Digite el motivo a eliminar" required>
                                    </div>

                                    <?php
                                        $theDate = new DateTime($fyh_creacion);
                                        $fyh_creacion = $theDate->format('d/m/Y h:i:s a');
                                    ?>

                                    

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Usuario</label>
                                        <input type="text" class="form-control " id="usuario"
                                            name="usuario" value="<?php echo $usuario; ?>" disabled>
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

                                        $('#mes').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#anio').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#clasificador').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#dependencia').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_banco').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_cuenta').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#estado').select2({
                                            theme: 'bootstrap4',
                                        });



                                    });
                                </script>

                                    

                                    <div class="form-group col-md-12" align="right">
                                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i>
                                            Eliminar</button>
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