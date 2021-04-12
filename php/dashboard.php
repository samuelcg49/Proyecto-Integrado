<?php
session_start();
if(empty($_SESSION["Usuario_logueado"])){

    header("Location: index.html");
  
  }else

  $listar = null;
  $rutaUsuario = "../ficheros/".$_SESSION["Usuario_logueado"];
  $directorio = opendir($rutaUsuario);
  while($elemento = readdir($directorio)){
      if($elemento != '.' && $elemento != '..'){
            if(is_dir($rutaUsuario."/".$elemento)){
              $listar .= '
                <div class="card m-3" style="border: none;">
                <span class="far fa-folder-open folder" ></span>
                    <div class="card-body text-center p-1">
                    <a  href="../ficheros/'.$rutaUsuario."/".$elemento.'">'.$elemento.'</a>
                    </div>
                </div>';
              /* Para corregir el abrir ficheros, podemos hacer un enlace a un fichero php donde abra dicho archivo */
            }else{
                $listar .= '<div class="card m-3" style="border: none;">
                <span class="far fa-file-alt file" ></span>
                    <div  class="card-body text-center p-1"> 
                    <a  href="../ficheros/'.$rutaUsuario."/".$elemento.'">'.$elemento.'</a>
                    </div>
                </div>';
                /* Para corregir el abrir ficheros, podemos hacer un enlace a un fichero php donde abra dicho archivo */
            }
          
      }
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Samuel Cies Gracia">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome-free-5.15.3-web/css/all.css">
    <link rel="icon" type="image/png" href="../img/logo.png">
    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!--<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Mitr:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Mitr:wght@700&family=Monoton&display=swap" rel="stylesheet">-->
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Lilita+One&family=Mitr:wght@500;700&family=Monoton&display=swap" rel="stylesheet">
    <title>My Drive - Almacenamiento de archivos remoto</title>
   
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow">
    <a class="navbar-brand ml-5 " href="index.html">
        <img src="../img/logo.png" width="30" height="30" alt="">
        My Drive
    </a>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto mr-5">
      <li class="nav-item active text-black">
        <a class="nav-link" href="#">Mi Perfil </a>
      </li>
      <li class="nav-item active  ml-4">
        <a class="nav-link" href="logout.php">Salir</a>
      </li>
    </ul>
  </div>
</nav>
<br>
<!-- Botones para crear archivos y ficheros -->
 <div id="nuevoElemento">
     <div id="botones">
        <span class="fas fa-folder-plus createElement mr-4"></span>
        <span class="fas fa-file-medical createElement mr-5"></span>
     </div>
 </div>
<br>
<!-- Parte donde se muestran los ficheros y carpetas del usuario -->
<div id="archivos">
    <?php 

        echo $listar; 
    ?>
</div>



    <script src="./jquery/jquery-3.6.0.min.js"></script>
    <script src="./bootstrap/js/bootstrap.bundle.js"></script>
    <script type="text/javascript">
</body>
</html>