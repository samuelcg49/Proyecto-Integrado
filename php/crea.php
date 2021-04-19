<head><link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"></head>
<?php
/* Creación de carpetas */
session_start();
if(isset($_POST["CrearCarpeta"])){
    //Comprueba a que nivel se encuentra el usuario (input oculto enviado) para poder elegir la ruta de creación
    if(isset($_POST["ruta"])){
        $ruta = "../ficheros/".$_SESSION["Usuario_logueado"];
    }
    if(isset($_POST["ruta1"])){
        $ruta = "../ficheros/".$_SESSION["Usuario_logueado"]."/".$_POST["ruta1"];
    }
    if(isset($_POST["ruta2"])){
        $ruta = "../ficheros/".$_SESSION["Usuario_logueado"]."/".$_POST["ruta2"];
    }

    $carpeta = htmlspecialchars($_POST["carpeta44"]);
    $directorio = $ruta."/".$carpeta;

    if(!is_dir($directorio)){ // Comprueba si el directorio existe

        $crear = mkdir($directorio, 0777, true); //El valor true permite crear carpetas anidadas

        if($crear){
                                                            //Los POST vacíos no concatenan nada, por lo tanto lo ponemos todo en una línea.
                                                            //Esto hace que redirija a la carpeta donde se creó la carpeta
            header("Location: dashboard.php?carpeta=".$_POST["ruta1"].$_POST["ruta2"].$_POST["ruta"]);
        }else{
            printf('
                    <div class="alert alert-danger text-center" role="alert">
                    <h2>Ha ocurrido un error al crear el directorio</h2>
                    </div>');       //Evita el warning de undefined variable
                    if(!isset($_POST["ruta"])){ $_POST["ruta"]="";}
                    if(!isset($_POST["ruta1"])){ $_POST["ruta1"]="";}
                    if(!isset($_POST["ruta2"])){ $_POST["ruta2"]="";}
                    header("Refresh: 1; URL=dashboard.php?carpeta=".$_POST["ruta1"].$_POST["ruta2"].$_POST["ruta"]);
        }
        
    }else{
        printf('
            <div class="alert alert-warning text-center" role="alert">
            <h2>La carpeta especificada ya existe</h2>
            </div>');           //Evita el warning de undefined variable
            if(!isset($_POST["ruta"])){ $_POST["ruta"]="";}
            if(!isset($_POST["ruta1"])){ $_POST["ruta1"]="";}
            if(!isset($_POST["ruta2"])){ $_POST["ruta2"]="";}
            header("Refresh: 1; URL=dashboard.php?carpeta=".$_POST["ruta1"].$_POST["ruta2"].$_POST["ruta"]);
    }

}



// Creación de ficheros
if(isset($_POST["SubirArchivo"])){
    //Comprueba a que nivel se encuentra el usuario (input oculto enviado) para poder elegir la ruta de creación
    if(isset($_POST["ruta"])){
        $ruta = "../ficheros/".$_SESSION["Usuario_logueado"];
    }
    if(isset($_POST["ruta1"])){
        $ruta = "../ficheros/".$_SESSION["Usuario_logueado"]."/".$_POST["ruta1"];
    }
    if(isset($_POST["ruta2"])){
        $ruta = "../ficheros/".$_SESSION["Usuario_logueado"]."/".$_POST["ruta2"];
    }


    $archivo = $_FILES["archivo"];
    $nombre = $archivo["name"];
    $tipo = $archivo["type"];
    $directorio = $ruta."/".$nombre;

    if(!is_file($directorio)){ // Comprueba si el archivo existe

        $crear = move_uploaded_file($archivo["tmp_name"], $directorio);
            
        if($crear){
                                                            //Los POST vacíos no concatenan nada, por lo tanto lo ponemos todo en una línea.
                                                            //Esto hace que redirija a la carpeta donde se subió el archivo
            header("Location: dashboard.php?carpeta=".$_POST["ruta1"].$_POST["ruta2"].$_POST["ruta"]);
        }else{
            
            printf('
            <div class="alert alert-danger text-center" role="alert">
            <h2>Este archivo ya existe</h2>
            </div>');           //Evita el warning de undefined variable
            if(!isset($_POST["ruta"])){ $_POST["ruta"]="";}
            if(!isset($_POST["ruta1"])){ $_POST["ruta1"]="";}
            if(!isset($_POST["ruta2"])){ $_POST["ruta2"]="";}
            header("Refresh: 1; URL=dashboard.php?carpeta=".$_POST["ruta1"].$_POST["ruta2"].$_POST["ruta"]);
        }
        
        
    }else{
        printf('
            <div class="alert alert-warning text-center" role="alert">
            <h2>Este archivo ya existe</h2>
            </div>');               //Evita el warning de undefined variable
            if(!isset($_POST["ruta"])){ $_POST["ruta"]="";}
            if(!isset($_POST["ruta1"])){ $_POST["ruta1"]="";}
            if(!isset($_POST["ruta2"])){ $_POST["ruta2"]="";}
            header("Refresh: 1; URL=dashboard.php?carpeta=".$_POST["ruta1"].$_POST["ruta2"].$_POST["ruta"]);
    }

}