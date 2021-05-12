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
                      <a  href="'.$rutaUsuario."/".$elemento.'" target="_blank"><span class="far fa-file-alt file" ></span><br>'.$elemento.' </a>
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
                          <a  href="'.$ruta."/".$elemento.'" target="_blank"><span class="far fa-file-alt file" ></span><br>'.$elemento.' </a>
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
                      <a  href="'.$ruta."/".$elemento.'" target="_blank"><span class="far fa-file-alt file" ></span><br>'.$elemento.' </a>
                      </div>
                  </div>';
                  
              }
            
        }
    }
    echo $listar;
    
}  ?>
 <?php include_once("../includes/header.php");    ?>

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
                <a data-toggle="modal" data-target="#CrearArchivo" href="#" class="fas fa-file-medical createElement "></a>
                <div class="dropdownleft show float-right mr-5">
                    <a class="btn text-secondary" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i id="options" class="fas fa-ellipsis-v"></i>
                    </a>
                    
                    <div class="dropdown-menu " aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" data-toggle="modal" data-target="#Copiar" href="#" ><i class="far fa-copy"></i> Copiar</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#Mover" href="#" ><i class="fas fa-arrows-alt"></i> Mover</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#Renombrar" href="#" ><i class="fas fa-edit"></i> Renombrar</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" data-toggle="modal" data-target="#Eliminar" href="#"><i class="fas fa-trash-alt text-danger"></i> Eliminar</a>
                    </div>
                </div>
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
    
    <?php include_once("../includes/modales.php");    ?>
        
    
        <!-- Scripts -->
       <script src="../jquery/jquery-3.6.0.min.js"></script>
            <script src="../bootstrap/js/bootstrap.bundle.js"></script>
            <script src="../js/context-menu.js"></script>
    </body>
    </html>
    