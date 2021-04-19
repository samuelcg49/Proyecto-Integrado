<head><link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"></head>
<?php
session_start();
$usuario = $_POST["usuario"];
$contrasena = $_POST["password"];
$email = $_POST["email"];
$ape1 = $_POST["ape1"];
$ape2 = $_POST["ape2"];


    define('DB_SERVER','localhost'); 
    define('DB_NAME','usuarios'); 
    define('DB_USER','proyecto'); 
    define('DB_PASS','proyecto'); 

    $conexion = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME); 
    
    $consulta = mysqli_query($conexion, "SELECT * FROM t_usuarios WHERE nombre = '$usuario'" );
    $consulta2 = mysqli_query($conexion, "SELECT * FROM t_usuarios WHERE email = '$email' ");
    
    $encriptada = password_hash($contrasena, PASSWORD_DEFAULT, ['cost' => 4]);
    
    if (mysqli_num_rows($consulta) > 0 || mysqli_num_rows($consulta2) > 0){
        
                printf('
                <div class="alert alert-warning text-center" role="alert">
                    <h2>Lo sentimos, pero este usuario ya ha sido registrado.</h2>
                </div>
                <script>
                    window.setTimeout(function() {
                    window.location = "../index.html";
                    }, 2500);
                </script>'); 
        

    }else{
        
            $sql = "INSERT INTO t_usuarios (nombre,contrasena,email,ape1,ape2) VALUES ('$usuario','$encriptada','$email','$ape1','$ape2')"; 
            mysqli_query($conexion, $sql); 

                                                // Crea el directorio con el nombre de usuario al momento de registrarse 
            mkdir("../ficheros/$usuario", 0777, true);  //a esta carpeta accederá en el momento de iniciar sesión

                    printf('
                    <div class="alert alert-success text-center" role="alert">
                        <h2>Usuario registrado con éxito.</h2>
                    </div>
                    <script>
                        window.setTimeout(function() {
                        window.location = "../index.html";
                        }, 2000);
                    </script>'); 
            
        
    }


?>