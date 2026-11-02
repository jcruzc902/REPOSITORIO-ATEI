<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');

include('../app/controllers/mes_conciliacion/listado_mes_conciliacion.php');
include('../app/controllers/anio_cb/listado_anio_cb.php');
include('../app/controllers/facultades_cb/listado_facultades_cb.php');
include('../app/controllers/clasificador_cb/listado_clasificador_cb.php');
include('../app/controllers/banco_cb/listado_banco_cb.php');
include('../app/controllers/cta_cb/listado_cta_cb.php');
include('../app/controllers/estado_conciliacion/listado_de_estado_cb.php');

//-------------------------------------------------------------------------------------------------------------------
if (empty($_POST['mesX'])) {
    $_POST['mesX'] = "";
}

if (empty($_POST['anioX'])) {
    $_POST['anioX'] = "";
}

if (empty($_POST['clasificadorX'])) {
    $_POST['clasificadorX'] = "";
}

if (empty($_POST['siafX'])) {
    $_POST['siafX'] = "";
}

if (empty($_POST['dependenciaX'])) {
    $_POST['dependenciaX'] = "";
}

if (empty($_POST['bancoX'])) {
    $_POST['bancoX'] = "";
}

if (empty($_POST['cuentaX'])) {
    $_POST['cuentaX'] = "";
}

if (empty($_POST['estadoX'])) {
    $_POST['estadoX'] = "";
}

if (empty($_POST['fecharegistro_desdeX'])) {
    $_POST['fecharegistro_desdeX'] = "";
}

if (empty($_POST['fecharegistro_hastaX'])) {
    $_POST['fecharegistro_hastaX'] = "";
}


$sql_conciliacion_bancaria = "SELECT * FROM tb_conciliacion_bancaria WHERE visible!=1 ";

if (isset($_POST["consultar"])) {

    $consultar = 1;
    $mes = $_POST['mesX'];
    $anio = $_POST['anioX'];
    $clasificador = $_POST['clasificadorX'];
    $siaf = $_POST['siafX'];
    $dependencia = $_POST['dependenciaX'];
    $banco = $_POST['bancoX'];
    $cuenta = $_POST['cuentaX'];
    $estado = $_POST['estadoX'];
    $desde = $_POST['fecharegistro_desdeX'];
    $hasta = $_POST['fecharegistro_hastaX'];

    $_SESSION['busqueda_boton_conciliacion'] = $consultar;
    $_SESSION['busqueda_mes'] = $mes;
    $_SESSION['busqueda_anio'] = $anio;
    $_SESSION['busqueda_clasificador'] = $clasificador;
    $_SESSION['busqueda_siaf'] = $siaf;
    $_SESSION['busqueda_dependencia'] = $dependencia;
    $_SESSION['busqueda_banco'] = $banco;
    $_SESSION['busqueda_cuenta'] = $cuenta;
    $_SESSION['busqueda_estado'] = $estado;
    $_SESSION['busqueda_desde'] = $desde;
    $_SESSION['busqueda_hasta'] = $hasta;


    if (
        !isset($mes) && !isset($anio) && !isset($clasificador) && !isset($siaf) && !isset($dependencia) &&
        !isset($banco) && !isset($cuenta) && !isset($estado) && !isset($desde) && !isset($hasta)
    ) {
        $sql_conciliacion_bancaria .= " ";
    } else {

        if (!empty($mes)) {
            $sql_conciliacion_bancaria .= " AND mes_ingresos='" . $mes . "'";
        }

        if (!empty($anio)) {
            $sql_conciliacion_bancaria .= " AND anio_ingresos='" . $anio . "'";
        }

        if (!empty($clasificador)) {
            $sql_conciliacion_bancaria .= " AND clasificador_ingresos='" . $clasificador . "'";
        }

        if (!empty($siaf)) {
            $sql_conciliacion_bancaria .= " AND siaf_ingresos like '%" . $siaf . "%'";
        }

        if (!empty($dependencia)) {
            $sql_conciliacion_bancaria .= " AND dependencia_ingresos='" . $dependencia . "'";
        }

        if (!empty($estado)) {
            $sql_conciliacion_bancaria .= " AND estado='" . $estado . "'";
        }

        if ($banco != "") {
            $sql_conciliacion_bancaria .= " AND banco_ingresos='" . $banco . "'";
        }

        if ($banco != "" && $cuenta != "") {
            $sql_conciliacion_bancaria .= " AND cta_ingresos='" . $cuenta . "'";
        }

        if (!empty($desde) && !empty($hasta)) {
            $sql_conciliacion_bancaria .= " AND fecha_ingresos between '" . $desde . " 00:00:00" . "' and '" . $hasta . " 23:59:59" . "'";
        }




    }


    $query_conciliacion_bancaria = $pdo->prepare($sql_conciliacion_bancaria);
    $query_conciliacion_bancaria->execute();
    $conciliacion_bancaria_datos = $query_conciliacion_bancaria->fetchAll(PDO::FETCH_ASSOC);


}


if ($_POST['fecharegistro_desdeX'] > $_POST['fecharegistro_hastaX']) {
    ?>
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Desde la fecha no puede ser mayor Hasta la fecha',
            showConfirmButton: false,
            timer: 5000
        })
    </script>
    <?php
}



$monto= 0;

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1 class="m-0"><b>Consulta de Control Nota de Pago</b>
                        <a href="<?php echo $URL; ?>/control_nota_pago/create.php" type="button"
                            class="btn btn-md bg-primary" id="boton_agregar">
                            <i class="bi bi-plus-circle"></i> Agregar Nuevo Control Nota Pago</a>
                        <a href="<?php echo $URL; ?>/app/controllers/control_nota_pago/exportar_xlsx.php"
                            type="button" class="btn btn-md bg-success" id="boton_exportarExcel">
                            <i class="bi bi-file-earmark-excel"></i> Exportar a Excel</a>
                        <a href="<?php echo $URL; ?>/app/controllers/control_nota_pago/exportar_recibos.php"
                            type="button" class="btn btn-md bg-danger" target="_blank" id="boton_exportarPDF">
                            <i class="bi bi-file-earmark-pdf"></i> Exportar a PDF</a>
                        
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-cash"></i> Conciliacion bancaria</li>
                    </ol>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php
    if ($rol_sesion == "ADMINISTRADOR") { ?>
        <script>
            document.getElementById('boton_agregar').style.display = 'inline';
            document.getElementById('boton_importar_xlsx').style.display = 'inline';
            document.getElementById('boton_exportarExcel').style.display = 'inline';
            document.getElementById('boton_exportarPDF').style.display = 'inline';
        </script>
    <?php } else if ($rol_sesion == "INGRESOS") { ?>
            <script>
                document.getElementById('boton_agregar').style.display = 'inline';
                document.getElementById('boton_importar_xlsx').style.display = 'inline';
                document.getElementById('boton_exportarExcel').style.display = 'inline';
                document.getElementById('boton_exportarPDF').style.display = 'inline';
            </script>
    <?php } else if ($rol_sesion == "EGRESOS") { ?>
            <script>
                document.getElementById('boton_agregar').style.display = 'none';
                document.getElementById('boton_importar_xlsx').style.display = 'none';
                document.getElementById('boton_exportarExcel').style.display = 'inline';
                document.getElementById('boton_exportarPDF').style.display = 'inline';
            </script>
    <?php }  ?>
                




    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">



            <div class="row">
                <div class="col-md-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">CONCILIACION BANCARIA REGISTRADO</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body table-responsive" style="display: inline;">
                            <form action="index" method="post">

                                <div class="form-row">

                                    <?php

                                        $sql_cuenta = "SELECT cuenta.id_cta as id_cta_cb,
                                        cuenta.numero_cta as numero_cta_cb,
                                        cuenta.id_banco as id_banco_cb,
                                        banco_cb.nombre_banco as nombre_banco_cb 
                                        FROM tb_cta_cb as cuenta 
                                        INNER JOIN tb_banco_cb as banco_cb ON banco_cb.id_banco= cuenta.id_banco 
                                        where cuenta.visible!=1 and banco_cb.nombre_banco='$_POST[bancoX]' ORDER BY cuenta.numero_cta ASC";
                                        $query_cuenta = $pdo->prepare($sql_cuenta);
                                        $query_cuenta->execute();
                                        $cuenta_cb_datos = $query_cuenta->fetchAll(PDO::FETCH_ASSOC);

                                    ?>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Mes conciliado</label>
                                        <select class="form-control " id="mes" name="mesX" style="width:100%;">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($mes_datos as $mes_dato) {
                                                $nombre_mes_tabla = $mes_dato['nombre_mes'];
                                                $id_mes = $mes_dato['id_mes']; ?>
                                                <option value="<?php echo $nombre_mes_tabla; ?>" <?php if ($nombre_mes_tabla == $_POST["mesX"]) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_mes_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Año</label>
                                        <select class="form-control " id="anio" name="anioX" style="width:100%;">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($anio_cb_datos as $anio_cb_dato) {
                                                $anio_cb_tabla = $anio_cb_dato['anio_nt'];
                                                $id_anio_cb = $anio_cb_dato['id_anio_nt']; ?>
                                                <option value="<?php echo $anio_cb_tabla; ?>" <?php if ($anio_cb_tabla == $_POST["anioX"]) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $anio_cb_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Clasificador</label>
                                        <select class="form-control " id="clasificador" name="clasificadorX" style="width:100%;">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($clasificador_cb_datos as $clasificador_cb_dato) {
                                                $clasificador_cb_tabla = $clasificador_cb_dato['clasificador_cb'];
                                                $id_clasificador = $clasificador_cb_dato['id_clasificador']; ?>
                                                <option value="<?php echo $clasificador_cb_tabla; ?>" <?php if ($clasificador_cb_tabla == $_POST["clasificadorX"]) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $clasificador_cb_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    

                                    <div class="form-group col-md-2" id="">
                                        <label for="">SIAF</label>
                                        <input type="text" class="form-control " id="siaf" name="siafX"
                                            placeholder="N° SIAF" value="<?php echo $_POST["siafX"]; ?>" onkeypress='return validaNumericos(event)'>
                                    </div>

                                    <div class="form-group col-md-4" id="">
                                        <label for="">Dependencia/Facultad</label>
                                        <select class="form-control " id="dependencia" name="dependenciaX" style="width:100%;">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($facultades_cb_datos as $facultades_cb_dato) {
                                                $nombre_facultad_tabla = $facultades_cb_dato['nombre_facultad'];
                                                $id_facultad = $facultades_cb_dato['id_facultad']; ?>
                                                <option value="<?php echo $nombre_facultad_tabla; ?>" <?php if ($nombre_facultad_tabla == $_POST["dependenciaX"]) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_facultad_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Banco</label>
                                        <select class="form-control " id="banco" name="bancoX" style="width:100%;">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($banco_cb_datos as $banco_cb_dato) {
                                                $nombre_banco_tabla = $banco_cb_dato['nombre_banco'];
                                                $id_banco = $banco_cb_dato['id_banco']; ?>
                                                <option value="<?php echo $nombre_banco_tabla; ?>" <?php if ($nombre_banco_tabla == $_POST["bancoX"]) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_banco_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Cuenta</label>
                                        <select class="form-control " id="cuenta" name="cuentaX" style="width:100%;">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($cuenta_cb_datos as $cta_cb_dato) {
                                                $numero_cta_tabla = $cta_cb_dato['numero_cta_cb'];
                                                $id_cta = $cta_cb_dato['id_cta_cb']; ?>
                                                <option value="<?php echo $numero_cta_tabla; ?>" <?php if ($numero_cta_tabla == $_POST["cuentaX"]) { ?> selected="selected"
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

                                            $('#banco').change(function () {

                                                //$('#combo_nombre').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

                                                $("#banco option:selected").each(function () {
                                                    var nombre_banco = $('#banco').val();
                                                    $.post("../app/controllers/banco_cb/consulta_cuenta.php",
                                                        { nombre_banco: nombre_banco }, function (data) {
                                                            $("#cuenta").html(data);
                                                        });
                                                });

                                            });
                                        });
                                    </script>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Estado</label>
                                        <select class="form-control " id="estado" name="estadoX" style="width:100%;">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($estado_conciliacion_datos as $estado_conciliacion_dato) {
                                                $nombre_estado_tabla = $estado_conciliacion_dato['nombre_estado'];
                                                $id_estado_conciliacion = $estado_conciliacion_dato['id_estado_conciliacion']; ?>
                                                <option value="<?php echo $nombre_estado_tabla; ?>" <?php if ($nombre_estado_tabla == $_POST["estadoX"]) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_estado_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>



                                    <div class="form-group col-md-2">
                                        <label for="">Desde</label>
                                        <input type="date" class="form-control " name="fecharegistro_desdeX"
                                            class="form-control" value="<?php echo $_POST["fecharegistro_desdeX"] ?>">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Hasta</label>
                                        <input type="date" class="form-control " name="fecharegistro_hastaX"
                                            class="form-control" value="<?php echo $_POST["fecharegistro_hastaX"] ?>">
                                    </div>

                                    <div class="form-group col-md-2" style="line-height: 100px;">

                                        <button type="submit" name="consultar" id="consultar" class="btn"
                                            style="background-color: black; color: white;"><i class="bi bi-search"></i>
                                            Iniciar consulta</button>
                                    </div>



                                </div>


                                <!--automatizar con boton Enter-->
                                <script>

                                    document.getElementById('siaf').addEventListener('keydown', function (e) {

                                        //si presiona el teclado Enter
                                        if (e.keyCode === 13) {
                                            // entonces haces lo que quieras para poder reaccionar a la pulsación del enter.

                                            // se establecera como clic en el boton Iniciar Consulta
                                            $("#consultar").click();
                                        }
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

                                        $('#banco').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#cuenta').select2({
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

            <div class="table-responsive">
                <table id="example1" class="table table-md table-hover text-center">
                    <thead>
                        <tr style="background-color: midnightblue; color: white">
                            <th>
                                <center>N°</center>
                            </th>

                            <th>
                                <center>Mes</center>
                            </th>

                            <th>
                                <center>Año</center>
                            </th>

                            <th>
                                <center>Clasificador</center>
                            </th>

                            <th>
                                <center>SIAF</center>
                            </th>

                            <th>
                                <center>Importe (S/.)</center>
                            </th>

                            <th>
                                <center>Dependencia</center>
                            </th>

                            <th>
                                <center>Banco</center>
                            </th>

                            <th>
                                <center>Cuenta</center>
                            </th>

                            <th>
                                <center>Estado</center>
                            </th>

                            <th>
                                <center>Fecha de Registro</center>
                            </th>
                            

                            <th>
                                <center>Acciones</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!isset($conciliacion_bancaria_datos)) {
                            $conciliacion_bancaria_datos = "";
                        } else {



                            $contador = 0;
                            foreach ($conciliacion_bancaria_datos as $conciliacion_bancaria_dato) {
                                $id_ingresos = $conciliacion_bancaria_dato['id_ingresos']; ?>
                                <tr>
                                    <td>
                                        <center>
                                            <?php echo $contador = $contador + 1; ?>
                                        </center>
                                    </td>

                                    <td>
                                        <?php echo $conciliacion_bancaria_dato['mes_ingresos']; ?>
                                    </td>

                                    <td>
                                        <?php echo $conciliacion_bancaria_dato["anio_ingresos"];

                                        ?>
                                    </td>

                                    <td>
                                        <?php echo $conciliacion_bancaria_dato['clasificador_ingresos']; ?>
                                    </td>

                                    <td>
                                        <?php echo $conciliacion_bancaria_dato["siaf_ingresos"];

                                        ?>
                                    </td>
                                    
                                    <td>
                                        <?php 

                                        $monto= $monto + $conciliacion_bancaria_dato["importe_ingresos"]; //suma de importe
                                        
                                        $importe= number_format($conciliacion_bancaria_dato["importe_ingresos"],2,'.',',');

                                        echo $importe;

                                        ?>
                                    </td>

                                    <td>
                                        <?php echo $conciliacion_bancaria_dato["dependencia_ingresos"];

                                        ?>
                                    </td>

                                    <td>
                                        <?php echo $conciliacion_bancaria_dato["banco_ingresos"];

                                        ?>
                                    </td>

                                    <td>
                                        <?php echo $conciliacion_bancaria_dato["cta_ingresos"];

                                        ?>
                                    </td>


                                    <td>

                                        <?php
                                        switch ($conciliacion_bancaria_dato['estado']) {
                                            case 'ATENDIDO': ?>
                                                <span class="badge bg-success">
                                                    <?php echo $conciliacion_bancaria_dato['estado']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'PENDIENTE': ?>
                                                <span class="badge bg-warning">
                                                    <?php echo $conciliacion_bancaria_dato['estado']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'ANULADO': ?>
                                                <span class="badge bg-danger">
                                                    <?php echo $conciliacion_bancaria_dato['estado']; ?>
                                                </span>
                                                <?php
                                                break;
                                        }
                                        ?>

                                    </td>




                                    <td>
                                        <?php $theDate = new DateTime($conciliacion_bancaria_dato['fyh_creacion']);
                                        echo $conciliacion_bancaria_dato['fyh_creacion'] = $theDate->format('d/m/Y h:i:s a'); ?>
                                    </td>

                                   

                                    <td>
                                        <center>
                                            <div class="btn-group">
                                                <a href="show.php?id=<?php echo $id_ingresos; ?>" type="button"
                                                    class="btn btn-sm btn-success"
                                                    id="boton_consultar<?php echo $id_ingresos; ?>"><i
                                                        class="bi bi-search"></i></a>
                                                <!--<a href="estado_devolucion.php?id=<?php echo $id_ingresos; ?>" target="_blank"
                                                    type="button" class="btn btn-sm" style="background-color: bisque;"
                                                    id="boton_imprimir<?php echo $id_ingresos; ?>"><i
                                                        class="bi bi-printer"></i>
                                                </a>-->
                                                <a href="update.php?id=<?php echo $id_ingresos; ?>" type="button"
                                                    class="btn btn-sm btn-primary"
                                                    id="boton_actualizar<?php echo $id_ingresos; ?>"><i
                                                        class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="delete.php?id=<?php echo $id_ingresos; ?>" type="button"
                                                    class="btn btn-sm btn-danger"
                                                    id="boton_eliminar<?php echo $id_ingresos; ?>"><i
                                                        class="bi bi-x-lg"></i></a>

                                            </div>
                                        </center>

                                        <?php
                                        if ($rol_sesion == "ADMINISTRADOR") { ?>
                                            <script>
                                                document.getElementById('boton_consultar<?php echo $id_ingresos; ?>').style.display = 'inline';
                                                
                                                document.getElementById('boton_actualizar<?php echo $id_ingresos; ?>').style.display = 'inline';
                                                document.getElementById('boton_eliminar<?php echo $id_ingresos; ?>').style.display = 'inline';
                                            </script>
                                        <?php } else if ($rol_sesion == "INGRESOS") { ?>
                                                <script>
                                                    document.getElementById('boton_consultar<?php echo $id_ingresos; ?>').style.display = 'inline';
                                                    
                                                    document.getElementById('boton_actualizar<?php echo $id_ingresos; ?>').style.display = 'inline';
                                                    document.getElementById('boton_eliminar<?php echo $id_ingresos; ?>').style.display = 'inline';
                                                </script>
                                        
                                        <?php } else if ($rol_sesion == "EGRESOS") { ?>
                                                            <script>
                                                                document.getElementById('boton_consultar<?php echo $id_ingresos; ?>').style.display = 'inline';
                                                                
                                                                document.getElementById('boton_actualizar<?php echo $id_ingresos; ?>').style.display = 'none';
                                                                document.getElementById('boton_eliminar<?php echo $id_ingresos; ?>').style.display = 'none';
                                                            </script>
                                        <?php } ?>

                                    </td>
                                </tr>
                                <?php
                            }
                        }

                        ?>
                    </tbody>

                </table>
                <br>
                <div class="form-group col-md-2 float-left" id="">
                    <?php
                    $monto = number_format($monto, 2, '.', ','); //convertir int a decimal
                    ?>
                    <label for="">Monto Total (S/.)</label>
                    <input type="text" class="form-control" name="total" value="<?php echo $monto; ?>" readonly>
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


<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 10,
            "language": {
                "emptyTable": "No hay información",
                "info": "Registros encontrados: _TOTAL_",
                "infoEmpty": "Registros encontrados: 0",
                "infoFiltered": "(Filtrado de _MAX_ total Conciliacion Bancaria)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Conciliacion Bancaria",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": false, "lengthChange": true, "autoWidth": false, "searching": false,

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>