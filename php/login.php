<head><link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"></head>
<?php
session_start();
$usuario = $_POST["usuarioL"];
$contrasena = $_POST["passwordL"];

    define('DB_SERVER','localhost'); 
    define('DB_NAME','usuarios'); 
    define('DB_USER','proyecto'); 
    define('DB_PASS','proyecto'); 

    $conexion = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME); 
        
        $consulta = mysqli_query($conexion, "SELECT * FROM t_usuarios WHERE nombre = '$usuario' OR email = '$usuario' ");
        
        if ($consulta && mysqli_num_rows($consulta) == 1){

            $datosUser = mysqli_fetch_assoc($consulta);
            
                if(password_verify($contrasena, $datosUser['contrasena'])){

                    $_SESSION["Usuario_logueado"] = $datosUser['nombre'];

                    header("Location: ./php/dashboard.php");

                }else{
                    printf('
                    <div class="alert alert-danger text-center" role="alert">
                    <h2>Usuario o contraseña erróneos.</h2>
                    </div>
                    <script>
                        window.setTimeout(function() {
                        window.location = "../index.html";
                        }, 2000);
                    </script>');   
                    
                }

        }else{
            printf('
            <div class="alert alert-danger text-center" role="alert">
                <h2>Usuario o contraseña erróneos.</h2>
            </div>
            <script>
                        window.setTimeout(function() {
                        window.location = "../index.html";
                        }, 2000);
                    </script>'); 
            
        }

?>
</body>