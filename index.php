<?php
///*
session_start();
if (!empty($_SESSION['active'])) {
    header('location: src/');
} else {
    if (!empty($_POST)) {
        $alert = '';
        if (empty($_POST['usuario']) || empty($_POST['clave'])) {
            $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Ingrese usuario y contraseña
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        } else {
            require_once "conexion.php";
            $user = mysqli_real_escape_string($conexion, $_POST['usuario']);
            $clave = md5(mysqli_real_escape_string($conexion, $_POST['clave']));
            $query = mysqli_query($conexion, "SELECT * FROM usuario WHERE usuario = '$user' AND clave = '$clave'");
            mysqli_close($conexion);
            $resultado = mysqli_num_rows($query);
            if ($resultado > 0) {
                $dato = mysqli_fetch_array($query);
                $_SESSION['active'] = true;
                $_SESSION['idUser'] = $dato['idusuario'];
                $_SESSION['nombre'] = $dato['nombre'];
                $_SESSION['user'] = $dato['usuario'];

                // Activar notificaciones push una sola vez después del login
                $_SESSION['show_push'] = true;

                header('Location: src/');
            } else {
                $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Contraseña incorrecta
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                session_destroy();
            }
        }
    }
}
//*/
/*
session_start();
if (!empty($_SESSION['active'])) {
    header('location: src/');
} else {
    if (!empty($_POST)) {
        $alert = '';
        // Aquí puedes eliminar el código de validación temporalmente
        $_SESSION['active'] = true;
        $_SESSION['idUser'] = 1; // Ajusta este ID según tu base de datos
        $_SESSION['nombre'] = 'Admin';
        $_SESSION['user'] = 'admin';
        header('Location: src/');
    }
}
*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Iniciar Sesión</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" />
    <link rel="manifest" href="manifest.json">
    <meta name="theme-color" content="#343a40">


</head>

<body class="bg">

    <div class="login-card">

        <!-- LOGO -->
        <img src="assets/img/logo.png" class="login-logo">

        <h2 class="login-title">INICIO DE SESIÓN</h2>

        <?php echo isset($alert) ? $alert : ''; ?>

        <form action="" method="post">

            <!-- USUARIO -->
            <div class="input-group">
                <span class="input-icon">
                    <!-- ICONO USUARIO SVG -->
                    <svg width="18" height="18" fill="#000000">
                        <path d="M9 9a4 4 0 1 0-0.001-8.001A4 4 0 0 0 9 9zm0 2c-2.673 0-8 1.337-8 4v2h16v-2c0-2.663-5.327-4-8-4z"/>
                    </svg>
                </span>
                <input type="text" name="usuario" class="form-control" placeholder="Usuario">
            </div>

            <!-- CLAVE -->
            <div class="input-group">
                <span class="input-icon">
                    <!-- ICONO LLAVE SVG -->
                    <svg width="18" height="18" fill="#000000">
                        <path d="M7 14l-1 1v3h3l1-1-3-3zm11-10a5 5 0 1 1-9.584 2H7V3h1.416A5 5 0 0 1 18 3z"/>
                    </svg>
                </span>

                <input type="password" name="clave" id="passField" class="form-control" placeholder="Clave">

                <span class="password-toggle" onclick="togglePass()">
                    <!-- ICONO OJO -->
                    <svg width="20" height="20" fill="#000000">
                        <path d="M10 4C5 4 1.73 7.11 0 10c1.73 2.89 5 6 10 6s8.27-3.11 10-6c-1.73-2.89-5-6-10-6zm0 10a4 4 0 1 1 .001-8.001A4 4 0 0 1 10 14z"/>
                    </svg>
                </span>
            </div>

            <button type="submit" class="btn-login">Ingresar</button>
        </form>

    </div>

    <script>
        function togglePass() {
            const input = document.getElementById('passField');
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>

  
</body>





</html>