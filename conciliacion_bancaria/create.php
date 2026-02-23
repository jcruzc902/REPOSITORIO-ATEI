<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');
include('../layout/mensajes.php');


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
                    <h1 class="m-0"><b>Registrar Nuevo Ingreso</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/conciliacion_bancaria"><i class="bi bi-cash"></i> Conciliacion bancaria</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-clipboard-check"></i> Registrar nuevo ingreso</a></li>
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
                            <h3 class="card-title">Digite los datos sobre el nuevo ingreso</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: inline;">
                            <form action="../app/controllers/conciliacion_bancaria/create.php" method="post"
                                enctype="multipart/form-data">
                                <input type="text" name="id_usuario" value="<?php echo $id_usuario_sesion; ?>" hidden>

                                <div class="form-row">

                                    <?php
                                    
                                        $anio_actual= date('Y');
                                    
                                    ?>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Mes conciliado</label>
                                        <select class="form-control " id="mes" name="mes"
                                            style="width:100%;" required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($mes_datos as $mes_dato) { ?>
                                                <option value="<?php echo $mes_dato['nombre_mes']; ?>" >
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
                                            style="width:100%;" required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($anio_cb_datos as $anio_cb_dato) { ?>
                                                <option value="<?php echo $anio_cb_dato['anio_nt']; ?>" <?php if ($anio_cb_dato['anio_nt'] == $anio_actual) { ?> selected="selected"
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
                                        <input type="date" class="form-control " id="fecha" name="fecha" required>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Clasificador</label>
                                        <select class="form-control " id="clasificador" name="clasificador"
                                            style="width:100%;" required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($clasificador_cb_datos as $clasificador_cb_dato) { ?>
                                                <option value="<?php echo $clasificador_cb_dato['clasificador_cb']; ?>" >
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
                                            placeholder="Digite el importe" onkeypress='return validaNumericos(event)' required>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">SIIC</label>
                                        <input type="text" class="form-control " id="siic" name="siic"
                                            placeholder="Digite numero SIIC" onkeypress='return validaNumericos(event)' required>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">SIAF</label>
                                        <input type="text" class="form-control " id="siaf" name="siaf"
                                            placeholder="Digite numero SIAF" onkeypress='return validaNumericos(event)' required>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Dependencia/Facultad</label>
                                        <select class="form-control " id="dependencia" name="dependencia"
                                            style="width:100%;" required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($facultades_cb_datos as $facultades_cb_dato) { ?>
                                                <option value="<?php echo $facultades_cb_dato['nombre_facultad']; ?>" >
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
                                            placeholder="Digite detalle de pago" required>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        
                                    </div>

                                    <div class="form-group col-md-2" id="" hidden>
                                        <label for="">N° Recibo</label>
                                        <input type="text" class="form-control " id="nro_recibo" name="nro_recibo"
                                            placeholder="Digite numero de recibo" >
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Banco</label>
                                        <select class="form-control " id="combo_banco" name="banco"
                                            style="width:100%;" required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($banco_cb_datos as $banco_cb_dato) { ?>
                                                <option value="<?php echo $banco_cb_dato['nombre_banco']; ?>" >
                                                    <?php echo $banco_cb_dato['nombre_banco']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Cuenta</label>
                                        <select class="form-control " id="combo_cuenta" name="cuenta" 
                                            style="width:100%" required>

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

                                    <div class="form-group col-md-2" id="" hidden>
                                        <label for="">Nombre</label>
                                        <input type="text" class="form-control " name="nombre"
                                            placeholder="Digite nombre de la cuenta" >
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Nombre</label>
                                        <input type="text" class="form-control " id="nombre" name="nombre"
                                            placeholder="Digite nombre de la cuenta" disabled>
                                    </div>


                                    <script>
                                        $(document).ready(function () {
                                            $('#combo_cuenta').change(function (e) {
                                                if ($(this).val() == "300152-18") {
                                                    document.getElementById("nombre").value = "";


                                                    $('#nombre').prop("disabled", false);


                                                } else if ($(this).val() != "300152-18") {
                                                    document.getElementById("nombre").value = "";


                                                    $('#nombre').prop("disabled", true);
                                                }
                                            })
                                        });
                                    </script>

                                    <?php
                                    
                                    $estado= "PENDIENTE";
                                    
                                    ?>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Estado</label>
                                        <select class="form-control " id="estado" name="estado"
                                            style="width:100%;" required>
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

<?php include('../layout/parte2.php'); ?>