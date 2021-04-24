<?php
session_start();

if(empty($_SESSION["Usuario_logueado"])){       //Si la sesión de usuario no se ha iniciado no se puede acceder al dashboard

    header("Location: ../index.html");      //redirije en caso de intentar entrar sin sesión
  
  }else
  
  //Establece la ruta por defecto concatenado el nombre del usuario, es decir, su carpeta.
  $rutaUsuario = "../ficheros/".$_SESSION["Usuario_logueado"];
  $listar = null;

function carpetaInicial ($rutaUsuario, $listar){

    $directorio = opendir($rutaUsuario);
    
    while($elemento = readdir($directorio)){
        if($elemento != '.' && $elemento != '..'){
              if(is_dir($rutaUsuario."/".$elemento)){
                $listar .= '
                  <div class="card m-3" style="border: none;">
                  
                      <div class="card-body text-center p-1">
                      <a href="?carpeta='.$elemento.'"><span class="far fa-folder-open folder " ></span><br>'.$elemento.'</a>
                      </div>
                  </div>';
                  
                /* Para corregir el abrir ficheros, podemos hacer un enlace a un fichero php donde abra dicho archivo */
              }else{
                  $listar .= '<div class="card m-3" style="border: none;">
                  
                      <div  class="card-body text-center p-1"> 
                      <a  href="'.$rutaUsuario."/".$elemento.'" target="_blank"><span class="far fa-file-alt file" ></span><br>'.$elemento.'" </a>
                      </div>
                  </div>';
                  /* Para corregir el abrir ficheros, podemos hacer un enlace a un fichero php donde abra dicho archivo */
              }
            
        }
        
    }
    echo $listar;
}

function explorer ($ruta, $listar){
        
    $rutaR = $_GET["carpeta"]        ;

        $directorio = opendir($ruta);
        while($elemento = readdir($directorio)){
            if($elemento != '.' && $elemento != '..'){
                  if(is_dir($ruta."/".$elemento)){
                    $listar .= '
                      <div class="card m-3" style="border: none;">
                      
                          <div class="card-body text-center p-1">
                          <a href="?carpeta2='.$rutaR."/".$elemento.'"><span class="far fa-folder-open folder" ></span><br>'.$elemento.'</a>
                          </div>
                      </div>';
                      //transfiere la ruta relativa por la URL al ser método GET
                        // Toma de entrada la carpeta de los ficheros con el nombre de usuario
                  }else{
                      $listar .= '<div class="card m-3" style="border: none;">
                      
                          <div  class="card-body text-center p-1"> 
                          <a  href="'.$ruta."/".$elemento.'" target="_blank"><span class="far fa-file-alt file" ></span><br>'.$elemento.'" </a>
                          </div>
                      </div>';
                      
                  }
                
            }
        }
        echo $listar;
}
function explorer2 ($ruta, $listar){
    
    $rutaR = $_GET["carpeta2"];
    $directorio = opendir($ruta);
    while($elemento = readdir($directorio)){
        if($elemento != '.' && $elemento != '..'){
              if(is_dir($ruta."/".$elemento)){
                $listar .= '
                  <div class="card m-3" style="border: none;">
                  
                      <div class="card-body text-center p-1">
                      <a href="?carpeta2='.$rutaR."/".$elemento.'"><span class="far fa-folder-open folder" ></span><br>'.$elemento.'</a>
                      </div>
                  </div>';
                  //transfiere la ruta relativa por la URL al ser método GET
                        // Toma de entrada la carpeta de los ficheros con el nombre de usuario
                
              }else{
                  $listar .= '<div class="card m-3" style="border: none;">
                  
                      <div  class="card-body text-center p-1"> 
                      <a  href="'.$ruta."/".$elemento.'" target="_blank"><span class="far fa-file-alt file" ></span><br>'.$elemento.'" </a>
                      </div>
                  </div>';
                  
              }
            
        }
    }
    echo $listar;
    
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
            <a class="navbar-brand ml-5 " href="dashboard.php">
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
            <div id="migasPan">
                <?php 
                if(empty($_GET["carpeta"]) && empty($_GET["carpeta2"])){
                    printf("<span class='migas'>Home/</span>"); //Si nos encontramos en la ruta PADRE muestra Home/

                }elseif(isset($_GET["carpeta"])){
                    printf("<span class='migas'>Home/".$_GET["carpeta"]."</span>"); //Si hemos avanzado un nivel de carpeta muestra esto

                }elseif(isset($_GET["carpeta2"])){
                    printf("<span class='migas'>Home/".$_GET["carpeta2"]."</span>"); //A partir del nivel 2 en adelante
                }
                ?>
            </div>
            <div id="botones">
                <a data-toggle="modal" data-target="#CrearCarpeta" href="#" class="fas fa-folder-plus createElement mr-4"></a>
                <a data-toggle="modal" data-target="#CrearArchivo" href="#" class="fas fa-file-medical createElement mr-5"></a>
            </div>
        </div>
        <br>
        <!-- Parte donde se muestran los ficheros y carpetas del usuario -->
        <div id="archivos">
            <?php 
                
                if(empty($_GET["carpeta"]) && empty($_GET["carpeta2"])){ //Si estamos en la carpeta PADRE los GET están vacios (Nivel raíz)
                    carpetaInicial($rutaUsuario, $listar);
                    
                }else{
                    if(empty($_GET["carpeta2"])){   //Si el método GET de la carpeta a nivel 2 está vacia ejecuta la función (1er nivel)
                        $ruta = $rutaUsuario."/".$_GET["carpeta"];  
                        explorer($ruta, $listar);
                        
                }else{              
                              //Si hemos avanzado al 2º nivel esto iterará hasta que salgamos, por lo tanto tenemos niveles infinitos.
                        $ruta = $rutaUsuario."/".$_GET["carpeta2"];
                        explorer2($ruta, $listar);
                        
                    }
                }
            ?>
        </div>
    <!--------------------------------------------------------------------------------------->
    <!--------------------------------------------------------------------------------------->
    
    
        <!-- Modal de crear carpeta -->
        <div class="modal fade" id="CrearCarpeta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="crea.php" id="login-form">
                            <input type="text" name="carpeta44" id="carpeta44" placeholder="Nombre de la carpeta">
                            <?php               //Según en el nivel de carpeta que nos encontremos envía un imput oculto con dicha información.
                                if(isset($_GET["carpeta"])){ 
                                    echo "<input type='hidden' name='ruta1' id='ruta1' value='".$_GET["carpeta"]."'>";
                                
                                }elseif(isset($_GET["carpeta2"])){
                                    echo "<input type='hidden' name='ruta2' id='ruta2' value='".$_GET["carpeta2"]."'>";
                                }else{
                                    echo "<input type='hidden' name='ruta' id='ruta' value=''>";
                                }
                                                        
                            ?>
                    </div>
                    <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" value="Crear Carpeta" name="CrearCarpeta">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
              <!-- Modal de crear archivos -->
        <div class="modal fade" id="CrearArchivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="crea.php" id="login-form" enctype="multipart/form-data">
                            <input type="file" name="archivo">
                                <?php               //Según en el nivel de carpeta que nos encontremos envía un imput oculto con dicha información.
                                    if(isset($_GET["carpeta"])){
                                        echo "<input type='hidden' name='ruta1' id='ruta1' value='".$_GET["carpeta"]."'>";
                                    
                                    }elseif(isset($_GET["carpeta2"])){
                                        echo "<input type='hidden' name='ruta2' id='ruta2' value='".$_GET["carpeta2"]."'>";
                                    }else{
                                        echo "<input type='hidden' name='ruta' id='ruta' value=''>";
                                    }
                                                        
                                ?>
                    </div>
                    <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" value="Subir Archivo" name="SubirArchivo">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Scripts -->
            <script src="../jquery/jquery-3.6.0.min.js"></script>
            <script src="../bootstrap/js/bootstrap.bundle.js"></script>
    </body>
    </html>
    