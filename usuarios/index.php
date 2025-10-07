<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');


#include('../app/controllers/usuarios/listado_de_usuarios.php');
include('../app/controllers/roles/listado_de_roles.php');
include('../app/controllers/estado/listado_de_estados.php');



if(!isset($_POST['nombresX'])){
    $_POST['nombresX']="";
}

if(!isset($_POST['apaternoX'])){
    $_POST['apaternoX']="";
}

if(!isset($_POST['amaternoX'])){
    $_POST['amaternoX']="";
}

if(!isset($_POST['emailX'])){
    $_POST['emailX']="";
}

if(!isset($_POST['usuarioX'])){
    $_POST['usuarioX']="";
}

if(!isset($_POST['rolX'])){
    $_POST['rolX']="";
}

if(!isset($_POST['estadoX'])){
    $_POST['estadoX']="";
}


if(!isset($_POST['desdeX'])){
    $_POST['desdeX']="";
}


if(!isset($_POST['hastaX'])){
    $_POST['hastaX']="";
}

$sql_usuarios = "SELECT *, us.fyh_creacion as fyh_creacion_usuario, us.fyh_actualizacion as fyh_actualizacion_usuario, us.operador as operador, 
      rol.rol as rol, estado.nombre_estado as nombre_estado 
      FROM tb_usuarios as us 
      INNER JOIN tb_roles as rol ON rol.id_rol =  us.id_rol
      INNER JOIN tb_estado as estado ON estado.id_estado = us.id_estado WHERE us.visible!=1 ";

if (isset($_POST["consultar"])) {

    $nombres = $_POST['nombresX'];
    $apaterno = $_POST['apaternoX'];
    $amaterno = $_POST['amaternoX'];
    $email = $_POST['emailX'];
    $user = $_POST['usuarioX'];
    $rol = $_POST['rolX'];
    $estado = $_POST['estadoX'];
    $desde = $_POST['desdeX'];
    $hasta = $_POST['hastaX'];

    

    if ($nombres == "" && $apaterno == "" && $amaterno == "" && $email == "" && $user == "" && $rol == "" && $estado=="" && $desde=="" && $hasta=="") {
        $sql_usuarios .= "";
    } else {
        if ($nombres != "") {
            $sql_usuarios .= " AND us.nombres like '%" . $nombres . "%'";
        } 
        
        if ($apaterno != "") {
            $sql_usuarios .= " AND us.apaterno like '%" . $apaterno . "%'";
        } 
        
        if ($amaterno != "") {
            $sql_usuarios .= " AND us.amaterno like '%" . $amaterno . "%'";
        } 
        
        if ($email != "") {
            $sql_usuarios .= " AND us.email like '%" . $email . "%'";
        } 
        
        if ($user != "") {
            $sql_usuarios .= " AND us.usuario like '%" . $user . "%'";
        } 
        
        if ($rol != "") {
            $sql_usuarios .= " AND us.id_rol = '" . $rol . "'";
        }  
        
        if ($estado != "") {
            $sql_usuarios .= " AND us.id_estado = '" . $estado . "'";
        } 
        
        if($desde != "" && $hasta != ""){
            $sql_usuarios .= " AND us.fyh_creacion between '".$desde."' AND '".$hasta."'";
        }
    }

    $query_usuarios = $pdo->prepare($sql_usuarios);
    $query_usuarios->execute();
    $usuarios_datos = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);


    $_SESSION['array_datos_usuarios'] = $usuarios_datos;
    
    
}



if($_POST['desdeX']>$_POST['hastaX']){
    ?>
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Desde la fecha no puede ser mayor Hasta la fecha',
            showConfirmButton: false,
            timer: 3000
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
                <div class="col-sm-10">
                    <h1 class="m-0"><b>Consulta de Usuarios</b> <a href="<?php echo $URL; ?>/usuarios/create" type="button"
                            class="btn btn-default bg-primary">
                            <i class="bi bi-plus-circle"></i> Agregar Nuevo Usuario
                        </a> <a href="<?php echo $URL; ?>/app/controllers/usuarios/exportar_excel" type="button"
                            class="btn btn-default bg-success">
                            <i class="bi bi-file-earmark-excel"></i> Exportar a Excel
                        </a> <a href="<?php echo $URL; ?>/app/controllers/usuarios/exportar_pdf" target="_blank" type="button"
                            class="btn btn-default bg-danger">
                            <i class="bi bi-file-earmark-pdf"></i> Exportar a PDF
                        </a></h1>
                </div><!-- /.col -->
                <div class="col-sm-2">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-person-fill"></i> Usuarios</li>
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
                            <h3 class="card-title">USUARIOS REGISTRADO</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body table-responsive" style="display: block;">

                            <form action="index" method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="">Nombres</label>
                                        <input class="form-control " type="text" name="nombresX"
                                            class="form-control" value="<?php echo $_POST["nombresX"]; ?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Apellido Paterno</label>
                                        <input class="form-control " type="text" name="apaternoX"
                                            class="form-control" value="<?php echo $_POST["apaternoX"]; ?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Apellido Materno</label>
                                        <input class="form-control " type="text" name="amaternoX"
                                            class="form-control" value="<?php echo $_POST["amaternoX"]; ?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Correo</label>
                                        <input class="form-control " type="email" name="emailX"
                                            class="form-control" value="<?php echo $_POST["emailX"]; ?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Rol del Usurio</label>
                                        <select class="form-control " name="rolX" id="id_rol"
                                            class="form-control" style="width: 100%;">

                                            <option value="">TODOS</option>
                                            <?php
                                            foreach ($roles_datos as $roles_dato) {
                                                $rol_tabla = $roles_dato['rol'];
                                                $id_rol = $roles_dato['id_rol']; ?>
                                                <option value="<?php echo $id_rol; ?>" <?php if ($id_rol == $_POST["rolX"]) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $rol_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Estado</label>
                                        <select class="form-control " name="estadoX" id="id_estado"
                                            class="form-control" style="width: 100%;">

                                            <option value="">TODOS</option>
                                            <?php
                                            foreach ($estados_datos as $estados_dato) {
                                                $estado_tabla = $estados_dato['nombre_estado'];
                                                $id_estados = $estados_dato['id_estado']; ?>
                                                <option value="<?php echo $id_estados; ?>" <?php if ($id_estados == $_POST["estadoX"]) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $estado_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Usuario</label>
                                        <input class="form-control " type="text" name="usuarioX"
                                            class="form-control" value="<?php echo $_POST["usuarioX"]; ?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Desde</label>
                                        <input class="form-control " type="date" name="desdeX"
                                            class="form-control" value="<?php echo $_POST["desdeX"]; ?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Hasta</label>
                                        <input class="form-control " type="date" name="hastaX"
                                            class="form-control" value="<?php echo $_POST["hastaX"]; ?>">
                                    </div>

                                    <div class="form-group col-md-2" style="line-height: 100px;">

                                        <button type="submit" name="consultar" class="btn btn-md" style="background-color: black; color: white;"><i
                                                class="bi bi-search"></i> Iniciar consulta</button>
                                    </div>

                                   
                                </div>

                            </form>

                            <script>
                                    $(document).ready(function() {
                                        $('#id_rol').select2({
                                            theme: 'bootstrap4',
                                        });
                                        $('#id_estado').select2({
                                            theme: 'bootstrap4',
                                        });
                                    });
                                </script>

                        </div>

                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table id="example1" class="table table-md table-hover text-center">
                    <thead>
                        <tr style="background-color: darkblue; color: white">
                            <th>
                                <center>Nro</center>
                            </th>
                            <th>
                                <center>Nombres</center>
                            </th>
                            <th>
                                <center>Apellido Paterno</center>
                            </th>
                            <th>
                                <center>Apellido Materno</center>
                            </th>
                            <th>
                                <center>Correo</center>
                            </th>
                            <th>
                                <center>Rol del Usuario</center>
                            </th>

                            <th>
                                <center>Usuario</center>
                            </th>
                            <th>
                                <center>Fecha de Registro</center>
                            </th>
                            <th>
                                <center>Estado</center>
                            </th>
                            <th>
                                <center>Acciones</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(empty($usuarios_datos)){
                            $usuarios_datos="";
                        }else{

                        $contador = 0;
                        foreach ($usuarios_datos as $usuarios_dato) {
                            $id_usuario = $usuarios_dato['id_usuario']; ?>
                            <tr>
                                <td>
                                    <center>
                                        <?php echo $contador = $contador + 1; ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?php echo $usuarios_dato['nombres']; ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?php echo $usuarios_dato['apaterno']; ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?php echo $usuarios_dato['amaterno']; ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?php echo $usuarios_dato['email']; ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?php echo $usuarios_dato['rol']; ?>
                                    </center>
                                </td>


                                <td>
                                    <center>
                                        <?php echo $usuarios_dato['usuario']; ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        
                                        <?php
                                        $theDate = new DateTime($usuarios_dato['fyh_creacion_usuario']);
                                        echo $stringDate = $theDate->format('d/m/Y');
                                        ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?php if($usuarios_dato['nombre_estado']=="HABILITADO"){?>
                                            <span class="badge bg-success">
                                                <?php echo $usuarios_dato['nombre_estado']; ?>
                                            </span>
                                        <?php }else{?>
                                            <span class="badge bg-danger">
                                                <?php echo $usuarios_dato['nombre_estado']; ?>
                                            </span>
                                        <?php } ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <div class="btn-group">
                                            <a href="show?id=<?php echo $id_usuario; ?>" type="button"
                                                class="btn btn-sm btn-success"><i class="bi bi-search"></i></a>
                                            <a href="update?id=<?php echo $id_usuario; ?>" type="button"
                                                class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="delete?id=<?php echo $id_usuario; ?>" type="button"
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

            <br>

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
                "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Usuarios",
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
    if(window.history.replaceState){
        window.history.replaceState(null,null, window.location.href);
    }
</script>