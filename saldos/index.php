<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');

include ('../app/controllers/banco_tyt/listado_banco_tyt.php');
include ('../app/controllers/cuenta_tyt/listado_cuenta_tyt.php');
include ('../app/controllers/nombre_cuenta/listado_nombre_cuenta.php');
include ('../app/controllers/tipo_cuenta/listado_tipo_cuenta.php');
include ('../app/controllers/situacion_cuenta/listado_situacion_cuenta.php');
include ('../app/controllers/estado_saldo/listado_estado_saldo.php');

if (empty($_POST['bancoX'])) {
    $_POST['bancoX'] = "";
}

if (empty($_POST['cuentaX'])) {
    $_POST['cuentaX'] = "";
}

if (empty($_POST['nombreX'])) {
    $_POST['nombreX'] = "";
}

if (empty($_POST['tipo_cuentaX'])) {
    $_POST['tipo_cuentaX'] = "";
}

if (empty($_POST['situacionX'])) {
    $_POST['situacionX'] = "";
}

if (empty($_POST['fechaX'])) {
    $_POST['fechaX'] = "";
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


$sql_saldo_bancario = "SELECT *,
    saldo_banco.nombre_banco as nombre_banco,
    saldo_banco.numero_cuenta as numero_cuenta,
    saldo_banco.nombre_cuenta as nombre_cuenta,
    cuenta_saldo.id_cuenta_saldo as id_cuenta_saldo,
    cuenta_saldo.cuenta_saldo as cuenta_saldo,
    saldo_banco.fecha as fecha,
    saldo_banco.monto as monto_saldo,
    situacion_saldo.id_situacion_saldo as id_situacion_saldo,
    situacion_saldo.nombre_situacion as nombre_situacion,
    estado_saldo.id_estado_saldo as id_estado_saldo,
    estado_saldo.nombre_estado as nombre_estado,
    usuarios.id_usuario as id_usuario,
    usuarios.nombres as nombres,
    usuarios.apaterno as apaterno,
    usuarios.amaterno as amaterno,
    saldo_banco.fyh_creacion as fyh_creacion
    FROM tb_saldo_banco as saldo_banco 
    LEFT JOIN tb_cuenta_saldo as cuenta_saldo ON cuenta_saldo.id_cuenta_saldo = saldo_banco.tipo_cuenta 
    LEFT JOIN tb_situacion_saldo as situacion_saldo ON situacion_saldo.id_situacion_saldo = saldo_banco.situacion 
    LEFT JOIN tb_estado_saldo as estado_saldo ON estado_saldo.id_estado_saldo = saldo_banco.estado 
    LEFT JOIN tb_usuarios as usuarios ON usuarios.id_usuario = saldo_banco.id_usuario
    WHERE saldo_banco.visible!=1 ";

if (isset($_POST["consultar"])) {

    $consultar = 1;
    $banco = $_POST['bancoX'];
    $cuenta = $_POST['cuentaX'];
    $nombre = $_POST['nombreX'];
    $tipo_cuenta = $_POST['tipo_cuentaX'];
    $situacion = $_POST['situacionX'];
    $fecha = $_POST['fechaX'];
    $estado = $_POST['estadoX'];
    $desde = $_POST['fecharegistro_desdeX'];
    $hasta = $_POST['fecharegistro_hastaX'];

    $_SESSION['busqueda_boton_saldo_bancario'] = $consultar;
    $_SESSION['busqueda_banco'] = $banco;
    $_SESSION['busqueda_cuenta'] = $cuenta;
    $_SESSION['busqueda_nombre'] = $nombre;
    $_SESSION['busqueda_tipocuenta'] = $tipo_cuenta;
    $_SESSION['busqueda_situacion'] = $situacion;
    $_SESSION['busqueda_fecha'] = $fecha;
    $_SESSION['busqueda_estado'] = $estado;
    $_SESSION['busqueda_desde'] = $desde;
    $_SESSION['busqueda_hasta'] = $hasta;

    /*
    if (
        !isset($banco) && !isset($cuenta) && !isset($nombre) && !isset($tipocuenta) && !isset($situacion) && !isset($fecha) && !isset($estado) 
        && !isset($desde) && !isset($hasta)
    ) {
        $sql_saldo_bancario .= " ";
    } else {
        if (!empty($banco)) {
            $sql_saldo_bancario .= " AND saldo_banco.nombre_banco='" . $banco . "'";
        }

        if (!empty($cuenta)) {
            $sql_saldo_bancario .= " AND saldo_banco.numero_cuenta='" . $cuenta . "'";
        }

        if (!empty($nombre)) {
            $sql_saldo_bancario .= " AND saldo_banco.nombre_cuenta='" . $nombre . "'";
        }

        if (!empty($tipo_cuenta)) {
            $sql_saldo_bancario .= " AND cuenta_saldo.id_cuenta_saldo='" . $tipo_cuenta . "'";
        }

        if (!empty($situacion)) {
            $sql_saldo_bancario .= " AND situacion_saldo.id_situacion_saldo='" . $situacion . "'";
        }

        if (!empty($fecha)) {
            $sql_saldo_bancario .= " AND saldo_banco.fecha='" . $fecha . "'";
        }

        if (!empty($estado)) {
            $sql_saldo_bancario .= " AND estado_saldo.id_estado_saldo='" . $estado . "'";
        }
        


        if (!empty($desde) && !empty($hasta)) {
            $sql_saldo_bancario .= " AND saldo_banco.fyh_creacion between '" . $desde." 00:00:00" . "' and '" . $hasta." 23:59:59" . "'";
        }
    }
    */

    if ($banco!="") {
        $sql_saldo_bancario .= " AND saldo_banco.nombre_banco='" . $banco . "'";
    }

    if ($banco!="" && $cuenta!="") {
        $sql_saldo_bancario .= " AND saldo_banco.numero_cuenta='" . $cuenta . "'";
    }

    if ($banco!="" && $cuenta!="" && $nombre!="") {
        $sql_saldo_bancario .= " AND saldo_banco.nombre_cuenta='" . $nombre . "'";
    }

    if ($tipo_cuenta!="") {
        $sql_saldo_bancario .= " AND cuenta_saldo.id_cuenta_saldo='" . $tipo_cuenta . "'";
    }

    if ($situacion!="") {
        $sql_saldo_bancario .= " AND situacion_saldo.id_situacion_saldo='" . $situacion . "'";
    }

    if ($fecha!="") {
        $sql_saldo_bancario .= " AND saldo_banco.fecha='" . $fecha . "'";
    }

    if ($estado!="") {
        $sql_saldo_bancario .= " AND estado_saldo.id_estado_saldo='" . $estado . "'";
    }

    if ($desde!="" && $hasta!="") {
        $sql_saldo_bancario .= " AND saldo_banco.fyh_creacion between '" . $desde." 00:00:00" . "' and '" . $hasta." 23:59:59" . "'";
    }


    $query_saldo_bancario = $pdo->prepare($sql_saldo_bancario);
    $query_saldo_bancario->execute();
    $saldo_bancario_datos = $query_saldo_bancario->fetchAll(PDO::FETCH_ASSOC);


}


if ($_POST['fecharegistro_desdeX'] > $_POST['fecharegistro_hastaX']) {
    ?>
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Desde la fecha no puede ser mayor hasta la fecha',
            showConfirmButton: false,
            timer: 5000
        })
    </script>
    <?php
}

$monto = 0;
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1 class="m-0"><b>Consulta de Saldo Bancario</b>
                        <a href="<?php echo $URL; ?>/saldos/create.php" type="button" class="btn btn-md bg-primary"
                            id="boton_agregar">
                            <i class="bi bi-plus-circle"></i> Agregar Nuevo Saldo Bancario</a>
                        <a href="<?php echo $URL; ?>/app/controllers/saldos/exportar_xlsx.php" type="button"
                            class="btn btn-md bg-success" id="boton_exportarExcel">
                            <i class="bi bi-file-earmark-excel"></i> Exportar a Excel</a>
                        <a href="<?php echo $URL; ?>/app/controllers/saldos/exportar_pdf.php" type="button"
                            class="btn btn-md bg-danger" target="_blank" id="boton_exportarPDF">
                            <i class="bi bi-file-earmark-pdf"></i> Exportar a PDF</a>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-check-circle-fill"></i> Saldo Bancario</li>
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
            document.getElementById('boton_exportarExcel').style.display = 'inline';
            document.getElementById('boton_exportarPDF').style.display = 'inline';
        </script>
    <?php } else if ($rol_sesion == "DIGA") { ?>
            <script>
                document.getElementById('boton_agregar').style.display = 'none';
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
                            <h3 class="card-title">SALDOS BANCOS REGISTRADO</h3>
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

                                        $sql_cuenta = "SELECT cuenta.id_cuenta_tyt as id_cuenta_tyt,
                                        cuenta.numero_cuenta_tyt as numero_cuenta_tyt,
                                        banco_tyt.id_banco_tyt as id_banco,
                                        banco_tyt.nombre_banco as nombre_banco 
                                        FROM tb_cuenta_tyt as cuenta 
                                        INNER JOIN tb_banco_tyt as banco_tyt ON banco_tyt.id_banco_tyt= cuenta.id_banco 
                                        where cuenta.visible!=1 AND cuenta.id_cuenta_tyt!=1 AND banco_tyt.nombre_banco='$_POST[bancoX]' ORDER BY banco_tyt.nombre_banco ASC";
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
                                        WHERE nombre_cuenta.visible!=1 AND nombre_cuenta.id_nombre_cuenta!=1 AND cuenta_tyt.numero_cuenta_tyt='$_POST[cuentaX]' ORDER BY nombre_cuenta.nombre_cuenta ASC";
                                        $query_nombre = $pdo->prepare($sql_nombre);
                                        $query_nombre->execute();
                                        $nombre_cuenta_datos = $query_nombre->fetchAll(PDO::FETCH_ASSOC);
                                    ?>

                                    
                                    <div class="form-group col-md-2" id="">
                                        <label for="">Banco</label>
                                        <select class="form-control " name="bancoX" id="combo_banco" style="width:100%"
                                            >
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($banco_tyt_datos as $banco_tyt_dato) { 
                                                $nombre_banco_tabla = $banco_tyt_dato['nombre_banco'];
                                                $id_banco_tyt_tabla = $banco_tyt_dato['id_banco_tyt']; ?>
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
                                        <select class="form-control " name="cuentaX" id="combo_cuenta" style="width:100%"
                                            >
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($cuenta_tyt_datos as $cuenta_tyt_dato) { 
                                                $numero_cuenta_tyt_tabla = $cuenta_tyt_dato['numero_cuenta_tyt'];
                                                $id_cuenta_tyt_tabla = $cuenta_tyt_dato['id_cuenta_tyt']; ?>
                                                <option value="<?php echo $numero_cuenta_tyt_tabla; ?>" <?php if ($numero_cuenta_tyt_tabla == $_POST["cuentaX"]) { ?> selected="selected"
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
                                        <select class="form-control " name="nombreX" id="combo_nombre" style="width:100%"
                                            >
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($nombre_cuenta_datos as $nombre_cuenta_dato) { 
                                                $nombre_cuenta_tabla = $nombre_cuenta_dato['nombre_cuenta'];
                                                $id_nombre_cuenta_tabla = $nombre_cuenta_dato['id_nombre_cuenta']; ?>
                                                <option value="<?php echo $nombre_cuenta_tabla; ?>" <?php if ($nombre_cuenta_tabla == $_POST["nombreX"]) { ?> selected="selected"
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
                                        <label for="">Tipo Cuenta</label>
                                        <select class="form-control " name="tipo_cuentaX" id="combo_tipocuenta" style="width:100%"
                                            >
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($tipo_cuenta_datos as $tipo_cuenta_dato) { 
                                                $cuenta_saldo_tabla = $tipo_cuenta_dato['cuenta_saldo'];
                                                $id_cuenta_saldo_tabla = $tipo_cuenta_dato['id_cuenta_saldo']; ?>
                                                <option value="<?php echo $id_cuenta_saldo_tabla; ?>" <?php if ($id_cuenta_saldo_tabla == $_POST["tipo_cuentaX"]) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $cuenta_saldo_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Situacion</label>
                                        <select class="form-control " name="situacionX" id="combo_situacion" style="width:100%"
                                            >
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($situacion_saldo_datos as $situacion_saldo_dato) { 
                                                $nombre_situacion_tabla = $situacion_saldo_dato['nombre_situacion'];
                                                $id_situacion_saldo_tabla = $situacion_saldo_dato['id_situacion_saldo']; ?>
                                                <option value="<?php echo $id_situacion_saldo_tabla; ?>" <?php if ($id_situacion_saldo_tabla == $_POST["situacionX"]) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_situacion_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Saldo</label>
                                        <input type="date" class="form-control " name="fechaX" value="<?php echo $_POST['fechaX']; ?>">

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Estado</label>
                                        <select class="form-control " name="estadoX" id="combo_estado" style="width:100%"
                                            >
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($estado_saldo_datos as $estado_saldo_dato) { 
                                                $nombre_estado_tabla = $estado_saldo_dato['nombre_estado'];
                                                $id_estado_saldo_tabla = $estado_saldo_dato['id_estado_saldo']; ?>
                                                <option value="<?php echo $id_estado_saldo_tabla; ?>" <?php if ($id_estado_saldo_tabla == $_POST["estadoX"]) { ?> selected="selected"
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

                                        <button type="submit" name="consultar" class="btn"
                                            style="background-color: black; color: white;"><i class="bi bi-search"></i>
                                            Iniciar consulta</button>
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
                                        $('#combo_tipocuenta').select2({
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

            <div class="table-responsive">
                <table id="example1" class="table table-md table-hover text-center">
                    <thead>
                        <tr style="background-color: midnightblue; color: white">
                            <th>
                                <center>N°</center>
                            </th>

                            <th>
                                <center>Banco</center>
                            </th>

                            <th>
                                <center>Cuenta</center>
                            </th>

                            <th>
                                <center>Nombre</center>
                            </th>

                            <th>
                                <center>Tipo Cuenta</center>
                            </th>

                            <th>
                                <center>Situacion</center>
                            </th>

                            <th>
                                <center>Fecha Saldo</center>
                            </th>

                            <th>
                                <center>Estado</center>
                            </th>

                            <th>
                                <center>Monto</center>
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
                        if (!isset($saldo_bancario_datos)) {
                            $saldo_bancario_datos = "";
                        } else {



                            $contador = 0;
                            
                            foreach ($saldo_bancario_datos as $saldo_bancario_dato) {
                                $id_saldo_bancario = $saldo_bancario_dato['id_saldo_banco']; ?>
                                <tr>
                                    <td>
                                        <center>
                                            <?php echo $contador = $contador + 1; ?>
                                        </center>
                                    </td>

                                    <td>
                                        <?php

                                        echo $saldo_bancario_dato["nombre_banco"];

                                        ?>
                                    </td>

                                    <td>
                                        <?php echo $saldo_bancario_dato['numero_cuenta']; ?>
                                    </td>

                                    <td>
                                        <?php echo $saldo_bancario_dato['nombre_cuenta']; ?>
                                    </td>

                                    <td>
                                        <?php 
                                        if($saldo_bancario_dato['cuenta_saldo']=="SELECCIONAR"){
                                            $saldo_bancario_dato['cuenta_saldo']="";
                                        }
                                        
                                        echo $saldo_bancario_dato['cuenta_saldo']; ?>
                                    </td>

                                    <td>


                                        <?php
                                        switch ($saldo_bancario_dato['nombre_situacion']) {
                                            case 'ACTIVO': ?>
                                                <span class="badge bg-dark">
                                                    <?php echo $saldo_bancario_dato['nombre_situacion']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'CANCELADO': ?>
                                                <span class="badge bg-dark">
                                                    <?php echo $saldo_bancario_dato['nombre_situacion']; ?>
                                                </span>
                                                <?php
                                                break;
                                            
                                        }
                                        ?>



                                    </td>

                                    <td>
                                        

                                        <?php
                                        if ($saldo_bancario_dato['fecha'] == "0000-00-00") {
                                            $saldo_bancario_dato['fecha'] = "";
                                        } else {
                                            $theDate = new DateTime($saldo_bancario_dato['fecha']);
                                            $saldo_bancario_dato['fecha'] = $theDate->format('d/m/Y');
                                        }

                                        echo $saldo_bancario_dato['fecha']; ?>

                                    </td>

                                    <td>

                                        <?php
                                        switch ($saldo_bancario_dato['nombre_estado']) {
                                            case 'ATENDIDO': ?>
                                                <span class="badge bg-success">
                                                    <?php echo $saldo_bancario_dato['nombre_estado']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'PENDIENTE': ?>
                                                <span class="badge bg-warning">
                                                    <?php echo $saldo_bancario_dato['nombre_estado']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'ANULADO': ?>
                                                <span class="badge bg-danger">
                                                    <?php echo $saldo_bancario_dato['nombre_estado']; ?>
                                                </span>
                                                <?php
                                                break;
                                        }
                                        ?>

                                    </td>

                                    <td>
                                        <?php 
                                        $monto=$monto+$saldo_bancario_dato['monto_saldo'];

                                        $saldo_banco= number_format($saldo_bancario_dato['monto_saldo'],2,'.',',');


                                        echo $saldo_banco; 
                                        ?>
                                    </td>

                                    <td>

                                        <?php $theDate = new DateTime($saldo_bancario_dato['fyh_creacion']);
                                        echo $saldo_bancario_dato['fyh_creacion'] = $theDate->format('d/m/Y h:i:s a'); ?>

                                    </td>




                                    <td>
                                        <center>
                                            <div class="btn-group">
                                                <a href="show.php?id=<?php echo $id_saldo_bancario; ?>" type="button"
                                                    class="btn btn-sm btn-success"
                                                    id="boton_consultar<?php echo $id_saldo_bancario; ?>"><i
                                                        class="bi bi-search"></i></a>
                                                <a href="estado_saldo.php?id=<?php echo $id_saldo_bancario; ?>" target="_blank"
                                                    type="button" class="btn btn-sm" style="background-color: bisque;"
                                                    id="boton_imprimir<?php echo $id_saldo_bancario; ?>"><i
                                                        class="bi bi-printer"></i>
                                                </a>
                                                <a href="update.php?id=<?php echo $id_saldo_bancario; ?>" type="button"
                                                    class="btn btn-sm btn-primary"
                                                    id="boton_actualizar<?php echo $id_saldo_bancario; ?>"><i
                                                        class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="delete.php?id=<?php echo $id_saldo_bancario; ?>" type="button"
                                                    class="btn btn-sm btn-danger"
                                                    id="boton_eliminar<?php echo $id_saldo_bancario; ?>"><i
                                                        class="bi bi-x-lg"></i></a>

                                            </div>
                                        </center>
                                        <?php
                                        if ($rol_sesion == "ADMINISTRADOR") { ?>
                                            <script>
                                                document.getElementById('boton_consultar<?php echo $id_saldo_bancario; ?>').style.display = 'inline';
                                                document.getElementById('boton_imprimir<?php echo $id_saldo_bancario; ?>').style.display = 'inline';
                                                document.getElementById('boton_actualizar<?php echo $id_saldo_bancario; ?>').style.display = 'inline';
                                                document.getElementById('boton_eliminar<?php echo $id_saldo_bancario; ?>').style.display = 'inline';
                                            </script>
                                        <?php } else if ($rol_sesion == "DIGA") { ?>
                                                <script>
                                                    document.getElementById('boton_consultar<?php echo $id_saldo_bancario; ?>').style.display = 'inline';
                                                    document.getElementById('boton_imprimir<?php echo $id_saldo_bancario; ?>').style.display = 'inline';
                                                    document.getElementById('boton_actualizar<?php echo $id_saldo_bancario; ?>').style.display = 'none';
                                                    document.getElementById('boton_eliminar<?php echo $id_saldo_bancario; ?>').style.display = 'none';
                                                </script>
                                        <?php }  ?>
                                                   
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


<?php include ('../layout/mensajes.php'); ?>
<?php include ('../layout/parte2.php'); ?>


<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 10,
            "language": {
                "emptyTable": "No hay información",
                "info": "Registros encontrados: _TOTAL_",
                "infoEmpty": "Registros encontrados: 0",
                "infoFiltered": "(Filtrado de _MAX_ total Registros)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Registros",
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