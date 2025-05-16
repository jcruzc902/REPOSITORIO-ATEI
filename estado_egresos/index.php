<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');

include ('../app/controllers/cargo/listado_cargo.php');
include ('../app/controllers/actividad_principal/listado_actividad_principal.php');
include ('../app/controllers/subactividad/listado_subactividad.php');
include ('../app/controllers/anio_nt/listado_de_anios.php');
include ('../app/controllers/estado_egreso/listado_de_estado_egreso.php');



if (empty($_POST['cargoX'])) {
    $_POST['cargoX'] = "";
}

if (empty($_POST['actividad_principalX'])) {
    $_POST['actividad_principalX'] = "";
}

if (empty($_POST['anio_egresoX'])) {
    $_POST['anio_egresoX'] = "";
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


$sql_egresos = "SELECT egresos.id_egresos as id_egresos,
    egresos.cargo_facultad as cargo_facultad,
    egresos.actividad_principal	 as actividad_principal,
    egresos.saldo_inicial as saldo_inicial,
    egresos.anio as anio_egreso,
    egresos.id_estado as id_estado_egreso,
    estado_egreso.nombre_estado_egreso as estado_egreso,
    egresos.fyh_creacion as fyh_creacion_egreso 
    FROM tb_egresos as egresos 
    INNER JOIN tb_estado_egreso as estado_egreso ON estado_egreso.id_estado_egreso = egresos.id_estado 
    WHERE egresos.visible!=1 ";

if (isset($_POST["consultar"])) {

    $consultar = 1;
    $cargo = $_POST['cargoX'];
    $actividad_principal = $_POST['actividad_principalX'];
    $anio_egreso = $_POST['anio_egresoX'];
    $estado = $_POST['estadoX'];
    $desde = $_POST['fecharegistro_desdeX'];
    $hasta = $_POST['fecharegistro_hastaX'];

    $_SESSION['busqueda_boton_egresos'] = $consultar;
    $_SESSION['busqueda_cargo'] = $cargo;
    $_SESSION['busqueda_actividad_principal'] = $actividad_principal;
    $_SESSION['busqueda_anio_egreso'] = $anio_egreso;
    $_SESSION['busqueda_estado'] = $estado;
    $_SESSION['busqueda_desde'] = $desde;
    $_SESSION['busqueda_hasta'] = $hasta;

    

    if ($cargo!="") {
        $sql_egresos .= " AND egresos.cargo_facultad='" . $cargo . "'";
    }

    if ($cargo!="" && $actividad_principal!="") {
        $sql_egresos .= " AND egresos.actividad_principal='" . $actividad_principal . "'";
    }

    if ($anio_egreso!="") {
        $sql_egresos .= " AND egresos.anio='" . $anio_egreso . "'";
    }

    if ($estado!="") {
        $sql_egresos .= " AND egresos.id_estado='" . $estado . "'";
    }

    if ($desde!="" && $hasta!="") {
        $sql_egresos .= " AND egresos.fyh_creacion between '" . $desde . "' and '" . $hasta . "'";
    }

    

    $query_egresos = $pdo->prepare($sql_egresos);
    $query_egresos->execute();
    $egresos_datos = $query_egresos->fetchAll(PDO::FETCH_ASSOC);


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

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1 class="m-0"><b>Consulta de Estado de Egresos</b>
                        <a href="<?php echo $URL; ?>/estado_egresos/create.php" type="button" class="btn btn-md bg-primary"
                            id="boton_agregar">
                            <i class="bi bi-plus-circle"></i> Agregar Nuevo Egresos</a>
                        <a href="<?php echo $URL; ?>/app/controllers/estado_egresos/exportar_xlsx.php" type="button"
                            class="btn btn-md bg-success" id="boton_exportarExcel" hidden>
                            <i class="bi bi-file-earmark-excel"></i> Exportar a Excel</a>
                        <a href="<?php echo $URL; ?>/app/controllers/estado_egresos/exportar_pdf.php" type="button"
                            class="btn btn-md bg-danger" target="_blank" id="boton_exportarPDF" hidden>
                            <i class="bi bi-file-earmark-pdf"></i> Exportar a PDF</a>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-calculator"></i> Estado de Egresos</li>
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
                            <h3 class="card-title">ESTADO DE EGRESOS REGISTRADO</h3>
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
                                    
                                        $sql_actividad_principal = "SELECT actividad_principal.id_actividad_principal as id_actividad_principal,
                                        actividad_principal.nombre_actividad as nombre_actividad,
                                        actividad_principal.id_cargo as id_cargo,
                                        cargo.nombre_cargo as nombre_cargo 
                                        FROM tb_actividad_principal as actividad_principal 
                                        INNER JOIN tb_cargo as cargo ON cargo.id_cargo= actividad_principal.id_cargo 
                                        where actividad_principal.visible!=1 AND cargo.nombre_cargo='$_POST[cargoX]' ORDER BY actividad_principal.nombre_actividad ASC";
                                        $query_actividad_principal = $pdo->prepare($sql_actividad_principal);
                                        $query_actividad_principal->execute();
                                        $actividad_principal_datos = $query_actividad_principal->fetchAll(PDO::FETCH_ASSOC);
                                    
                                    ?>

                                
                                    <div class="form-group col-md-4" id="campo_anio_nt">
                                        <label for="">Facultad</label>
                                        <select class="form-control " name="cargoX" id="combo_cargo" style="width:100%">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($tipo_cargo_datos as $tipo_cargo_dato) {
                                                $nombre_cargo_tabla = $tipo_cargo_dato['nombre_cargo'];
                                                $id_cargo = $tipo_cargo_dato['id_cargo']; ?>
                                                <option value="<?php echo $nombre_cargo_tabla; ?>" <?php if ($nombre_cargo_tabla == $_POST["cargoX"]) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $nombre_cargo_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-4" id="campo_anio_nt">
                                        <label for="">Actividad Principal</label>
                                        <select class="form-control " name="actividad_principalX" id="combo_actividad"
                                            style="width:100%">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($actividad_principal_datos as $actividad_principal_dato) {
                                                $nombre_actividad_tabla = $actividad_principal_dato['nombre_actividad'];
                                                $id_actividad_principal = $actividad_principal_dato['id_actividad_principal']; ?>
                                                <option value="<?php echo $nombre_actividad_tabla; ?>" <?php if ($nombre_actividad_tabla == $_POST["actividad_principalX"]) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $nombre_actividad_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <script>

                                        $(document).ready(function () {

                                            $('#combo_cargo').change(function () {

                                                //$('#combo_subactividad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

                                                $("#combo_cargo option:selected").each(function () {
                                                    var nombre_cargo = $('#combo_cargo').val();
                                                    $.post("../app/controllers/cargo/consulta_actividad.php",
                                                        { nombre_cargo: nombre_cargo }, function (data) {
                                                            $("#combo_actividad").html(data);
                                                        });
                                                });

                                            });
                                        });


                                    </script>

                                    <div class="form-group col-md-2">
                                        <label for="">Año</label>
                                        <select class="form-control " name="anio_egresoX" style="width:100%" id="comboaniont"
                                            class="form-control">
                                            <option value="">TODOS</option>
                                            <?php
                                            foreach ($anios_datos as $anios_dato) {
                                                $anio_nt_tabla = $anios_dato['anio_nt'];
                                                $id_anio_nt = $anios_dato['id_anio_nt']; ?>
                                                <option value="<?php echo $anio_nt_tabla; ?>" <?php if ($anio_nt_tabla == $_POST["anio_egresoX"]) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $anio_nt_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    

                                    <div class="form-group col-md-2" id="campo_anio_nt">
                                        <label for="">Estado</label>
                                        <select class="form-control " name="estadoX" id="combo_estado"
                                            style="width:100%">
                                            <option value="">TODOS</option>
                                            <?php
                                            foreach ($estado_egreso_datos as $estado_egreso_dato) {
                                                $nombre_estado_egreso_tabla = $estado_egreso_dato['nombre_estado_egreso'];
                                                $id_estado_egreso = $estado_egreso_dato['id_estado_egreso']; ?>
                                                <option value="<?php echo $id_estado_egreso; ?>" <?php if ($id_estado_egreso == $_POST["estadoX"]) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_estado_egreso_tabla; ?>
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



                                        $('#combo_cargo').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_actividad').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#comboaniont').select2({
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
                                <center>Facultad</center>
                            </th>

                            <th>
                                <center>Actividad Principal</center>
                            </th>

                            <th>
                                <center>Saldo Inicial</center>
                            </th>

                            <th>
                                <center>Año</center>
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
                        if (!isset($egresos_datos)) {
                            $egresos_datos = "";
                        } else {



                            $contador = 0;
                            foreach ($egresos_datos as $egresos_dato) {
                                $id_egresos = $egresos_dato['id_egresos']; ?>
                                <tr>
                                    <td>
                                        <center>
                                            <?php echo $contador = $contador + 1; ?>
                                        </center>
                                    </td>

                                    <td>
                                        <?php echo $egresos_dato['cargo_facultad']; ?>
                                    </td>

                                    <td>
                                        <?php echo $egresos_dato['actividad_principal']; ?>
                                    </td>

                                    <td>
                                        <?php 
                                        
                                        $egresos_dato['saldo_inicial'] = floatval($egresos_dato['saldo_inicial']);
                                        $egresos_dato['saldo_inicial'] = number_format($egresos_dato['saldo_inicial'], 2, '.', ',');

                                        echo $egresos_dato['saldo_inicial']; ?>
                                    </td>

                                    <td>
                                        <?php echo $egresos_dato['anio_egreso']; ?>
                                    </td>


                                    <td>
                                        <?php
                                        switch ($egresos_dato['estado_egreso']) {
                                            case 'ATENDIDO': ?>
                                                <span class="badge bg-success">
                                                    <?php echo $egresos_dato['estado_egreso']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'PENDIENTE': ?>
                                                <span class="badge bg-warning">
                                                    <?php echo $egresos_dato['estado_egreso']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'ANULADO': ?>
                                                <span class="badge bg-danger">
                                                    <?php echo $egresos_dato['estado_egreso']; ?>
                                                </span>
                                                <?php
                                                break;
                                        }
                                        ?>
                                    </td>



                                    <td>
                                        <?php $theDate = new DateTime($egresos_dato['fyh_creacion_egreso']);
                                        echo $egresos_dato['fyh_creacion_egreso'] = $theDate->format('d/m/Y h:i:s a'); ?>
                                    </td>




                                    <td>
                                        <center>
                                            <div class="btn-group">
                                                <a href="show.php?id=<?php echo $id_egresos; ?>" type="button"
                                                    class="btn btn-sm btn-success"><i class="bi bi-search"></i></a>

                                                <a href="update.php?id=<?php echo $id_egresos; ?>" type="button"
                                                    class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="delete.php?id=<?php echo $id_egresos; ?>" type="button"
                                                    class="btn btn-sm btn-danger"><i class="bi bi-x-lg"></i></a>

                                            </div>
                                        </center>

                                    </td>
                                </tr>
                                <?php
                            }
                        }

                        ?>
                    </tbody>

                </table>
                <br>

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
                "infoFiltered": "(Filtrado de _MAX_ total Egresos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Egresos",
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