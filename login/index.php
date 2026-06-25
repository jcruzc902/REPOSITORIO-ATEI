<!DOCTYPE html>
<html lang="en">

<head>
	<title>Aplicativo de Tesoreria Interno</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="../public/images/cheque.png" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css"
		href="../app/controllers/login/Login_v18/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css"
		href="../app/controllers/login/Login_v18/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css"
		href="../app/controllers/login/Login_v18/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../app/controllers/login/Login_v18/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css"
		href="../app/controllers/login/Login_v18/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css"
		href="../app/controllers/login/Login_v18/vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../app/controllers/login/Login_v18/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css"
		href="../app/controllers/login/Login_v18/vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../app/controllers/login/Login_v18/css/util.css">
	<link rel="stylesheet" type="text/css" href="../app/controllers/login/Login_v18/css/main.css">
	<!--===============================================================================================-->

	<!-- Libreria Sweetallert2-->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body style="background-color: #666666;">

	<?php
	include ('../app/config.php');

	session_start();

	if (isset($_SESSION["sesion_user_sistemadedevoluciondedinero"])) {
		header('Location: ' . $URL . '/index.php');
	}

	if (isset($_SESSION['mensaje']) && isset($_SESSION['icono'])) {
		$respuesta = $_SESSION['mensaje'];
		$icono = $_SESSION['icono'];
		?>
		<script>
			Swal.fire({
				position: 'top-end',
				icon: '<?php echo $icono; ?>',
				title: '<?php echo $respuesta; ?>',
				showConfirmButton: false,
				timer: 3000
			})
		</script>
		<?php
		unset($_SESSION['mensaje']);
		unset($_SESSION['icono']);
	}
	?>



	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">

				<form class="login100-form validate-form" action="../app/controllers/login/ingreso.php" method="post">

					<center><img src="../app/controllers/login/Login_v18/images/logo_mejorado.png" alt="AdminLTE Logo"
							class="brand-image" style="max-width: 48%;"></center>

					<br>

					<span class="login100-form-title p-b-30">
						<h5><b>APLICATIVO DE TESORERIA INTERNO</b></h5>
					</span>


					<div class="wrap-input100 validate-input" data-validate="Se requiere un usuario">
						<input class="input100" type="text" name="user">
						<span class="focus-input100"></span>
						<span class="label-input100">Usuario</span>
					</div>


					<div class="wrap-input100 validate-input" data-validate="Se requiere una contraseña">
						<input class="input100" type="password" name="password_user">
						<span class="focus-input100"></span>
						<span class="label-input100">Contraseña</span>
					</div>



					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								<b>Recordar</b>
							</label>
						</div>

						<div>
							<a href="recuperar_cuenta.php" class="txt1">
								¿Olvidaste tu contraseña?
							</a>
						</div>
					</div>



					<div class="container-login100-form-btn">
						<button class="login100-form-btn bg-success">
							<h5><i class="fa fa-arrow-circle-right"></i> INGRESAR</h5>
						</button>
					</div>

					






				</form>

				<div class="login100-more"
					style="background-image: url('../app/controllers/login/Login_v18/images/logo_unfv.jpeg');">
				</div>
			</div>
		</div>
	</div>





	<!--===============================================================================================-->
	<script src="../app/controllers/login/Login_v18/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="../app/controllers/login/Login_v18/vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="../app/controllers/login/Login_v18/vendor/bootstrap/js/popper.js"></script>
	<script src="../app/controllers/login/Login_v18/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="../app/controllers/login/Login_v18/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="../app/controllers/login/Login_v18/vendor/daterangepicker/moment.min.js"></script>
	<script src="../app/controllers/login/Login_v18/vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="../app/controllers/login/Login_v18/vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script src="../app/controllers/login/Login_v18/js/main.js"></script>

</body>

</html>