<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');
include('../layout/mensajes.php');

include('../app/controllers/carta_fianza/show_carta_fianza.php');

include('../app/controllers/entidades/listado_de_entidades.php');
include('../app/controllers/afianzador/listado_de_afianzador.php');
include('../app/controllers/condicion_cf/listado_de_condicion.php');
include('../app/controllers/proce_selec/listado_de_proce_selec.php');
include('../app/controllers/tipo_garantia/listado_de_tipo_garantia.php');
include('../app/controllers/anio_convocatoria/listado_anio_convocatoria.php');
include('../app/controllers/observacion_cf/listado_observacion_cf.php');
include('../app/controllers/objeto_contratacion/listado_objeto_contratacion.php');
include('../app/controllers/anio_nt/listado_de_anios.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Actualizar Datos de Cartas Fianza</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/cartas_fianza"><i
                                    class="bi bi-folder"></i> Cartas Fianza</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-pencil"></i> Actualizar Datos de Cartas
                            Fianza</a></li>
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
                            <h3 class="card-title">Digite los datos de la carta fianza a actualizar</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: inline;">



                            <form action="../app/controllers/carta_fianza/update.php" method="post" enctype="multipart/form-data">
                                <input class="form-control " type="text" name="id_carta_fianza"
                                    value="<?php echo $id_carta_fianza; ?>" hidden>
                                <input class="form-control " type="text" name="id_usuario"
                                    value="<?php echo $id_usuario_sesion; ?>" hidden>
                                <div class="form-row">

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Periodo</label>
                                        <select class="form-control " id="periodo" name="periodo"
                                            style="width:100%;">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($anios_datos as $anios_dato) {
                                                $anio_nt_tabla = $anios_dato['anio_nt'];
                                                $id_anio_nt = $anios_dato['id_anio_nt']; ?>
                                                <option value="<?php echo $anio_nt_tabla; ?>" <?php if ($anio_nt_tabla == $periodo) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $anio_nt_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-4" id="">
                                        <label for="">Entidad Financiera</label>
                                        <select class="form-control " id="entidad_financiera" name="entidad_financiera"
                                            onchange="obtenerRUC(this.value)" style="width:100%;" required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($entidades_datos as $entidades_dato) {
                                                $nombre_entidad_tabla = $entidades_dato['nombre_entidad'];
                                                $id_entidad_cf = $entidades_dato['id_entidad_cf']; ?>
                                                <option value="<?php echo $nombre_entidad_tabla; ?>" <?php if ($nombre_entidad_tabla == $entidad_financiera) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_entidad_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Nro. RUC</label>
                                        <input type="text" class="form-control " id="nro_ruc" name="nro_ruc"
                                            placeholder="Número RUC" value="<?php echo $ruc_entidad; ?>" required>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Estado</label>
                                        <input type="text" class="form-control " id="estado" name="estado"
                                            placeholder="Estado" value="<?php echo $estado_entidad; ?>" required>
                                    </div>

                                    <!-- AJAX con JavaScript -->
                                    <script>
                                        //completa los campos automaticamente al seleccionar
                                        function obtenerRUC(nombre_entidad) {
                                            if (nombre_entidad === "") {
                                                document.getElementById("nro_ruc").value = "";
                                                document.getElementById("estado").value = "";
                                                return;
                                            }
                                            let xhr = new XMLHttpRequest();
                                            xhr.open("GET", "getData.php?nombre_entidad=" + nombre_entidad, true);
                                            xhr.onreadystatechange = function () {
                                                if (xhr.readyState === 4 && xhr.status === 200) {


                                                    let datos = JSON.parse(xhr.responseText); // Convertir a objeto
                                                    document.getElementById("nro_ruc").value = datos.ruc;
                                                    document.getElementById("estado").value = datos.estado;
                                                }
                                            };
                                            xhr.send();
                                        }
                                    </script>

                                    <div class="form-group col-md-2">

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Carta Fianza N°</label>
                                        <input type="text" class="form-control " id="carta_fianza_nro"
                                            name="carta_fianza_nro" placeholder="Carta Fianza N°"
                                            value="<?php echo $nro_carta_fianza; ?>" required>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Monto (S/.)</label>
                                        <input type="text" class="form-control " id="monto" name="monto"
                                            placeholder="Monto (S/.)" value="<?php echo $monto; ?>" required>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Codigo Carta de Fianza N°</label>
                                        <input type="text" class="form-control " id="codigo" name="codigo"
                                            placeholder="Codigo Carta Fianza N°" value="<?php echo $codigo; ?>"
                                            required>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Tipo de garantia</label>
                                        <select class="form-control " id="tipo_garantia" name="tipo_garantia"
                                            style="width:100%;">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($tipo_garantia_cf_datos as $tipo_garantia_cf_dato) {
                                                $nombre_tipo_garantia_tabla = $tipo_garantia_cf_dato['nombre_tipo_garantia'];
                                                $id_tipo_garantia = $tipo_garantia_cf_dato['id_tipo_garantia']; ?>
                                                <option value="<?php echo $nombre_tipo_garantia_tabla; ?>" <?php if ($nombre_tipo_garantia_tabla == $tipo_garantia) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_tipo_garantia_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-4">

                                    </div>

                                    <div class="form-group col-md-4" id="">
                                        <label for="">Afianzador</label>
                                        <select class="form-control " id="afianzador" name="afianzador"
                                            onchange="obtenerRUC_2(this.value)" style="width:100%;" required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($afianzador_datos as $afianzador_dato) {
                                                $nombre_afianzador_tabla = $afianzador_dato['nombre_afianzador'];
                                                $id_afianzador_cf = $afianzador_dato['id_afianzador_cf']; ?>
                                                <option value="<?php echo $nombre_afianzador_tabla; ?>" <?php if ($nombre_afianzador_tabla == $afianzador) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $nombre_afianzador_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Nro. RUC</label>
                                        <input type="text" class="form-control " id="nro_ruc_2" name="nro_ruc_2"
                                            placeholder="Número RUC" value="<?php echo $ruc_afianzador; ?>" required>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Estado</label>
                                        <input type="text" class="form-control " id="estado_2" name="estado_2"
                                            placeholder="Estado" value="<?php echo $estado_afianzador; ?>" required>
                                    </div>

                                    <!-- AJAX con JavaScript -->
                                    <script>
                                        //completa los campos automaticamente al seleccionar
                                        function obtenerRUC_2(nombre_afianzador) {
                                            if (nombre_afianzador === "") {
                                                document.getElementById("nro_ruc_2").value = "";
                                                document.getElementById("estado_2").value = "";
                                                return;
                                            }
                                            let xhr = new XMLHttpRequest();
                                            xhr.open("GET", "getData2.php?nombre_afianzador=" + nombre_afianzador, true);
                                            xhr.onreadystatechange = function () {
                                                if (xhr.readyState === 4 && xhr.status === 200) {


                                                    let datos = JSON.parse(xhr.responseText); // Convertir a objeto
                                                    document.getElementById("nro_ruc_2").value = datos.ruc;
                                                    document.getElementById("estado_2").value = datos.estado;
                                                }
                                            };
                                            xhr.send();
                                        }
                                    </script>

                                    <div class="form-group col-md-4">

                                    </div>



                                    <div class="form-group col-md-2" id="">
                                        <label for="">Objeto de contratacion</label>
                                        <select class="form-control " id="objeto_contratacion"
                                            name="objeto_contratacion" style="width:100%;">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($objeto_contratacion_datos as $objeto_contratacion_dato) {
                                                $nombre_contratacion_tabla = $objeto_contratacion_dato['nombre_contratacion'];
                                                $id_objeto_contratacion = $objeto_contratacion_dato['id_objeto_contratacion']; ?>
                                                <option value="<?php echo $nombre_contratacion_tabla; ?>" <?php if ($nombre_contratacion_tabla == $objeto_contratacion) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $nombre_contratacion_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Descripcion del objeto</label>
                                        <input type="text" class="form-control " id="descripcion_objeto"
                                            name="descripcion_objeto" placeholder="Descripcion del objeto"
                                            value="<?php echo $descripcion_objeto; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Tipo de seleccion</label>
                                        <select class="form-control " id="proce_selec" name="tipo_seleccion"
                                            style="width:100%;">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($proce_selec_cf_datos as $proce_selec_cf_dato) {
                                                $nombre_proce_tabla = $proce_selec_cf_dato['nombre_proce'];
                                                $id_proce_selec = $proce_selec_cf_dato['id_proce_selec']; ?>
                                                <option value="<?php echo $nombre_proce_tabla; ?>" <?php if ($nombre_proce_tabla == $tipo_seleccion) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $nombre_proce_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Numero de seleccion</label>
                                        <input type="text" class="form-control " id="numero_seleccion"
                                            name="numero_seleccion" placeholder="Numero de seleccion"
                                            value="<?php echo $numero_seleccion; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Año de la convocatoria</label>
                                        <select class="form-control " id="anio_convocatoria" name="anio_convocatoria"
                                            style="width:100%;">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($anio_convocatoria_datos as $anio_convocatoria_dato) {
                                                $anio_convocatoria_tabla = $anio_convocatoria_dato['anio_convocatoria'];
                                                $id_anio_convocatoria = $anio_convocatoria_dato['id_anio_convocatoria']; ?>
                                                <option value="<?php echo $anio_convocatoria_tabla; ?>" <?php if ($anio_convocatoria_tabla == $anio_convocatoria) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $anio_convocatoria_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Orden de servicio</label>
                                        <input type="text" class="form-control " id="orden_servicio"
                                            name="orden_servicio" placeholder="Orden de servicio"
                                            value="<?php echo $orden_servicio; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Orden de compra</label>
                                        <input type="text" class="form-control " id="orden_compra" name="orden_compra"
                                            placeholder="Orden de compra" value="<?php echo $orden_compra; ?>">
                                    </div>


                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha de inicio</label>
                                        <input type="date" class="form-control " id="fecha_inicio" name="fecha_inicio"
                                            value="<?php echo $fecha_inicio; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha de termino</label>
                                        <input type="date" class="form-control " id="fecha_termino" name="fecha_termino"
                                            value="<?php echo $fecha_termino; ?>">
                                    </div>

                                    <div class="form-group col-md-4">

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Condicion</label>
                                        <select class="form-control " id="condicion_cf" name="condicion_cf"
                                            style="width:100%;" required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($condicion_cf_datos as $condicion_cf_dato) {
                                                $nombre_condicion_tabla = $condicion_cf_dato['nombre_condicion'];
                                                $id_condicion_cf = $condicion_cf_dato['id_condicion_cf']; ?>
                                                <option value="<?php echo $nombre_condicion_tabla; ?>" <?php if ($nombre_condicion_tabla == $condicion) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $nombre_condicion_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>


                                    <div class="form-group col-md-2" id="">
                                        <label for="">Observacion</label>
                                        <select class="form-control " id="observacion_1" name="observacion"
                                            style="width:100%;" required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($observacion_cf_datos as $observacion_cf_dato) {
                                                $observacion_cf_tabla = $observacion_cf_dato['observacion_cf'];
                                                $id_observacion_cf = $observacion_cf_dato['id_observacion_cf']; ?>
                                                <option value="<?php echo $observacion_cf_tabla; ?>" <?php if ($observacion_cf_tabla == $observacion) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $observacion_cf_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="" hidden>
                                        <label for="">Documento</label>
                                        <input type="text" class="form-control " name="documento"
                                            placeholder="Documento" value="<?php echo $documento; ?>">
                                    </div>


                                    <div class="form-group col-md-2" id="">
                                        <label for="">Documento</label>
                                        <input type="text" class="form-control " id="documento_x" name="documento"
                                            placeholder="Documento" value="<?php echo $documento; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="" hidden>
                                        <label for="">Fecha</label>
                                        <input type="date" class="form-control " name="fecha_documento"
                                            value="<?php echo $fecha_documento; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha</label>
                                        <input type="date" class="form-control " id="fecha_x" name="fecha_documento"
                                            value="<?php echo $fecha_documento; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="" hidden>
                                        <label for="">Receptor</label>
                                        <input type="text" class="form-control " name="receptor"
                                            placeholder="Nombre de la persona a recoger"
                                            value="<?php echo $receptor; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Receptor</label>
                                        <input type="text" class="form-control " id="receptor_x" name="receptor"
                                            placeholder="Nombre de la persona a recoger"
                                            value="<?php echo $receptor; ?>" disabled>
                                    </div>

                                    <script>
                                        var observacion_1 = $('#observacion_1').val();

                                        if (observacion_1 == "ENTREGADA AL PROVEEDOR") {
                                            $('#documento_x').prop("disabled", false);
                                            $('#fecha_x').prop("disabled", false);
                                            $('#receptor_x').prop("disabled", false);
                                        } else {
                                            $('#documento_x').prop("disabled", true);
                                            $('#fecha_x').prop("disabled", true);
                                            $('#receptor_x').prop("disabled", true);
                                        } 
                                    </script>

                                    <script>
                                        $(document).ready(function () {
                                            $('#observacion_1').change(function (e) {
                                                if ($(this).val() == "SE ENCUENTRA EN ARCHIVO" || $(this).val() == "") {
                                                    document.getElementById("documento_x").value = "";
                                                    document.getElementById("fecha_x").value = "";
                                                    document.getElementById("receptor_x").value = "";

                                                    $('#documento_x').prop("disabled", true);
                                                    $('#fecha_x').prop("disabled", true);
                                                    $('#receptor_x').prop("disabled", true);



                                                } else if ($(this).val() == "ENTREGADA AL PROVEEDOR") {
                                                    document.getElementById("documento_x").value = "";
                                                    document.getElementById("fecha_x").value = "";
                                                    document.getElementById("receptor_x").value = "";

                                                    $('#documento_x').prop("disabled", false);
                                                    $('#fecha_x').prop("disabled", false);
                                                    $('#receptor_x').prop("disabled", false);
                                                }
                                            })
                                        });
                                    </script>

                                    <div class="form-group col-md-2" id="">

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">NT N°</label>
                                        <input type="text" class="form-control " id="nt" name="nt" placeholder="NT N°"
                                            value="<?php echo $nt_nro; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">NT Año</label>
                                        <select class="form-control " id="anio_nt" name="anio_nt"
                                            style="width:100%;">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($anios_datos as $anios_dato) {
                                                $anio_nt_tabla = $anios_dato['anio_nt'];
                                                $id_anio_nt = $anios_dato['id_anio_nt']; ?>
                                                <option value="<?php echo $anio_nt_tabla; ?>" <?php if ($anio_nt_tabla == $nt_anio) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $anio_nt_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-4" id="">
                                        <label for="">Documento NT</label>
                                        <input type="text" class="form-control " id="observacion_nt"
                                            name="observacion_nt" placeholder="Documento que autoriza el ingreso"
                                            value="<?php echo $observacion_nt; ?>">
                                    </div>


                                    
                                    

                                    <div class="form-group col-md-2" id="">

                                    </div>

                                    
                                    <div class="form-group col-md-4" id="">
                                        <label for="">Seleccione archivo</label>
                                        <input class="form-control-file" type="file" name="nuevo_archivo"
                                            accept=".pdf,.PDF" id="archivo">
                                    </div>

                                        
                                    
                                    <!--
                                    <div class="form-group col-md-4" id="" >
                                        <label for="">Seleccione archivo</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFileLang" name="nuevo_archivo" accept=".pdf,.PDF">
                                            <label class="custom-file-label" for="customFileLang" data-browse="Seleccionar archivo" >Ningun archivo seleccionado</label>
                                        </div>
                                    </div>
                                        -->

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

                                        if ((event.charCode == 103)) {
                                            return true;
                                        }

                                        if ((event.charCode == 110)) {
                                            return true;
                                        }


                                        return false;
                                    }
                                </script>

                                <script>
                                    $(document).ready(function () {

                                        $('#periodo').select2({
                                            theme: 'bootstrap4',
                                        });


                                        $('#entidad_financiera').select2({
                                            theme: 'bootstrap4',
                                        });


                                        $('#afianzador').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#condicion_cf').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#proce_selec').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#tipo_garantia').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#objeto_contratacion').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#anio_convocatoria').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#observacion_1').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#anio_nt').select2({
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