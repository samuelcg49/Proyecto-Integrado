<head><link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"></head>
<?php
session_start();

// OPCIÓN DE COPIAR ARCHIVOS
if(isset($_POST["Copiar"])){
    
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
    
    $elemento = htmlspecialchars($_POST["elemento"]);
    $directorio = $ruta."/".$elemento;
    $directorio2 = $directorio."_copia";

    if(is_dir($directorio)){
        
        if(is_dir($directorio2)){
            printf('
                    <div class="alert alert-warning text-center" role="alert">
                    <h2>La carpeta %s-copia ya existe</h2>
                    </div>',$elemento);       //Evita el warning de undefined variable
                    if(!isset($_POST["ruta"])){ $_POST["ruta"]="";}
                    if(!isset($_POST["ruta1"])){ $_POST["ruta1"]="";}
                    if(!isset($_POST["ruta2"])){ $_POST["ruta2"]="";}
                    header("Refresh: 1.5; URL=dashboard.php?carpeta=".$_POST["ruta1"].$_POST["ruta2"].$_POST["ruta"]);
        }else{
            $copiar = full_copy($directorio, $directorio2);
        
            if($copiar){
                header("Location: dashboard.php?carpeta=".$_POST["ruta1"].$_POST["ruta2"].$_POST["ruta"]);
                
            }else{
                printf('
                        <div class="alert alert-danger text-center" role="alert">
                        <h2>Ha ocurrido un error al copiar el directorio</h2>
                        </div>');       //Evita el warning de undefined variable
                        if(!isset($_POST["ruta"])){ $_POST["ruta"]="";}
                        if(!isset($_POST["ruta1"])){ $_POST["ruta1"]="";}
                        if(!isset($_POST["ruta2"])){ $_POST["ruta2"]="";}
                        header("Refresh: 1; URL=dashboard.php?carpeta=".$_POST["ruta1"].$_POST["ruta2"].$_POST["ruta"]);
            }
        }

        
        
    }
    

    if(is_file($directorio)){ // Comprueba si el archivo existe

        if($directorio2){
            printf('
                    <div class="alert alert-warning text-center" role="alert">
                    <h2>El archivo %s-copia ya existe</h2>
                    </div>',$elemento);       //Evita el warning de undefined variable
                    if(!isset($_POST["ruta"])){ $_POST["ruta"]="";}
                    if(!isset($_POST["ruta1"])){ $_POST["ruta1"]="";}
                    if(!isset($_POST["ruta2"])){ $_POST["ruta2"]="";}
                    header("Refresh: 1.5; URL=dashboard.php?carpeta=".$_POST["ruta1"].$_POST["ruta2"].$_POST["ruta"]);
        }else{
            $copiar = copy($directorio, $directorio2);
            
            if($copiar){
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
        }

        
        
    }

    if(!is_file($directorio) && !is_dir($directorio)){
    
        printf('
        <div class="alert alert-warning text-center" role="alert">
        <h2>El elemento especificado no existe</h2>
        </div>');               //Evita el warning de undefined variable
        if(!isset($_POST["ruta"])){ $_POST["ruta"]="";}
        if(!isset($_POST["ruta1"])){ $_POST["ruta1"]="";}
        if(!isset($_POST["ruta2"])){ $_POST["ruta2"]="";}
        header("Refresh: 1; URL=dashboard.php?carpeta=".$_POST["ruta1"].$_POST["ruta2"].$_POST["ruta"]);

     
    }


}
 //FUNCIÓN PARA COPIAS RECURSIVAS
function full_copy( $source, $target ) {
    if ( is_dir( $source ) ) {
        @mkdir( $target );
        $d = dir( $source );
        while ( FALSE !== ( $entry = $d->read() ) ) {
            if ( $entry == '.' || $entry == '..' ) {
                continue;
            }
            $Entry = $source . '/' . $entry; 
            if ( is_dir( $Entry ) ) {
                full_copy( $Entry, $target . '/' . $entry );
                continue;
            }
            copy( $Entry, $target . '/' . $entry );
        }
 
        $d->close();
    }else {
        copy( $source, $target );
    }
    return true;
}

 // OPCIÓN DE MOVER ARCHIVOS
if(isset($_POST["Mover"])){
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
    
    $elemento1 = htmlspecialchars($_POST["elemento1"]);
    
    $ruta2 = htmlspecialchars($_POST["RutaElemento"]);
    
    $directorio2 = "../ficheros/".$_SESSION["Usuario_logueado"]."/".$ruta2;
    $directorio = $ruta."/".$elemento1;

    if(is_dir($directorio) || file_exists($directorio)){
        
        if(is_dir($directorio2)){
            //Ejecuta una función de terminal para poder mover directorios
            $cmd = 'mv '.$directorio.' '.$directorio2;
            exec($cmd, $output, $return_val);

            if ($return_val == 0) {
                
                header("Location: dashboard.php?carpeta=".$_POST["ruta1"].$_POST["ruta2"].$_POST["ruta"]);
             } else {
                printf('
                    <div class="alert alert-danger text-center" role="alert">
                    <h2>Ha ocurrido un error inesperado</h2>
                    </div>');               //Evita el warning de undefined variable
                    if(!isset($_POST["ruta"])){ $_POST["ruta"]="";}
                    if(!isset($_POST["ruta1"])){ $_POST["ruta1"]="";}
                    if(!isset($_POST["ruta2"])){ $_POST["ruta2"]="";}
                    header("Refresh: 1; URL=dashboard.php?carpeta=".$_POST["ruta1"].$_POST["ruta2"].$_POST["ruta"]);
             }

        }else{
            printf('
        <div class="alert alert-warning text-center" role="alert">
        <h2>La ruta de destino no existe</h2>
        </div>');               //Evita el warning de undefined variable
        if(!isset($_POST["ruta"])){ $_POST["ruta"]="";}
        if(!isset($_POST["ruta1"])){ $_POST["ruta1"]="";}
        if(!isset($_POST["ruta2"])){ $_POST["ruta2"]="";}
        header("Refresh: 1; URL=dashboard.php?carpeta=".$_POST["ruta1"].$_POST["ruta2"].$_POST["ruta"]);
        }

    }else{
        printf('
        <div class="alert alert-warning text-center" role="alert">
        <h2>El elemento especificado no existe</h2>
        </div>');               //Evita el warning de undefined variable
        if(!isset($_POST["ruta"])){ $_POST["ruta"]="";}
        if(!isset($_POST["ruta1"])){ $_POST["ruta1"]="";}
        if(!isset($_POST["ruta2"])){ $_POST["ruta2"]="";}
        header("Refresh: 1; URL=dashboard.php?carpeta=".$_POST["ruta1"].$_POST["ruta2"].$_POST["ruta"]);
    }
    
}
//OPCIÓN DE RENOMBRAR ARCHIVOS
if(isset($_POST["Renombrar"])){
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
    
    $oldName = htmlspecialchars($_POST["oldName"]);
    $newName = htmlspecialchars($_POST["newName"]);

    

    if(is_dir($ruta."/".$oldName)){
        
        $renombrar = rename($ruta."/".$oldName, $ruta."/".$newName);

        if($renombrar){
            header("Location: dashboard.php?carpeta=".$_POST["ruta1"].$_POST["ruta2"].$_POST["ruta"]);
        }else{
            printf('
                    <div class="alert alert-danger text-center" role="alert">
                    <h2>Ha ocurrido un error inesperado</h2>
                    </div>');               //Evita el warning de undefined variable
                    if(!isset($_POST["ruta"])){ $_POST["ruta"]="";}
                    if(!isset($_POST["ruta1"])){ $_POST["ruta1"]="";}
                    if(!isset($_POST["ruta2"])){ $_POST["ruta2"]="";}
                    header("Refresh: 1; URL=dashboard.php?carpeta=".$_POST["ruta1"].$_POST["ruta2"].$_POST["ruta"]);
        }
    }else{
        printf('
        <div class="alert alert-warning text-center" role="alert">
        <h2>La carpeta especificada no existe</h2>
        </div>');               //Evita el warning de undefined variable
        if(!isset($_POST["ruta"])){ $_POST["ruta"]="";}
        if(!isset($_POST["ruta1"])){ $_POST["ruta1"]="";}
        if(!isset($_POST["ruta2"])){ $_POST["ruta2"]="";}
        header("Refresh: 1; URL=dashboard.php?carpeta=".$_POST["ruta1"].$_POST["ruta2"].$_POST["ruta"]);
    }

    if(is_file($ruta."/".$oldName)){
        
        $renombrar = rename($ruta."/".$oldName, $ruta."/".$newName);

        if($renombrar){
            header("Location: dashboard.php?carpeta=".$_POST["ruta1"].$_POST["ruta2"].$_POST["ruta"]);
        }else{
            printf('
                    <div class="alert alert-danger text-center" role="alert">
                    <h2>Ha ocurrido un error inesperado</h2>
                    </div>');               //Evita el warning de undefined variable
                    if(!isset($_POST["ruta"])){ $_POST["ruta"]="";}
                    if(!isset($_POST["ruta1"])){ $_POST["ruta1"]="";}
                    if(!isset($_POST["ruta2"])){ $_POST["ruta2"]="";}
                    header("Refresh: 1; URL=dashboard.php?carpeta=".$_POST["ruta1"].$_POST["ruta2"].$_POST["ruta"]);
        }
    }else{
        printf('
        <div class="alert alert-warning text-center" role="alert">
        <h2>El archivo especificado no existe</h2>
        </div>');               //Evita el warning de undefined variable
        if(!isset($_POST["ruta"])){ $_POST["ruta"]="";}
        if(!isset($_POST["ruta1"])){ $_POST["ruta1"]="";}
        if(!isset($_POST["ruta2"])){ $_POST["ruta2"]="";}
        header("Refresh: 1; URL=dashboard.php?carpeta=".$_POST["ruta1"].$_POST["ruta2"].$_POST["ruta"]);
    }
    
}
//ÚLTIMA OPCIÓN: ELIMINAR ARCHIVOS
if(isset($_POST["Eliminar"])){
    if(isset($_POST["ruta"])){
        $ruta = "../ficheros/".$_SESSION["Usuario_logueado"];
    }
    if(isset($_POST["ruta1"])){
        $ruta = "../ficheros/".$_SESSION["Usuario_logueado"]."/".$_POST["ruta1"];
    }
    if(isset($_POST["ruta2"])){
        $ruta = "../ficheros/".$_SESSION["Usuario_logueado"]."/".$_POST["ruta2"];
    }

    $DeleteFile = htmlspecialchars($_POST["DeleteFile"]);
    $directorio = $ruta."/".$DeleteFile;

    if($DeleteFile == "/"){
        printf('
                        <div class="alert alert-danger text-center" role="alert">
                        <h2>ERES UN TRAVIESO!</h2>
                        </div>');               //Evita el warning de undefined variable
                        if(!isset($_POST["ruta"])){ $_POST["ruta"]="";}
                        if(!isset($_POST["ruta1"])){ $_POST["ruta1"]="";}
                        if(!isset($_POST["ruta2"])){ $_POST["ruta2"]="";}
                        header("Refresh: 1; URL=dashboard.php?carpeta=".$_POST["ruta1"].$_POST["ruta2"].$_POST["ruta"]);
    }else{

        if(is_dir($directorio)){
        
            $eliminar = Delete_dir($directorio);
            
            if($eliminar){
                header("Location: dashboard.php?carpeta=".$_POST["ruta1"].$_POST["ruta2"].$_POST["ruta"]);
            }else{
                printf('
                        <div class="alert alert-danger text-center" role="alert">
                        <h2>No se ha podido eliminar la carpeta especificada</h2>
                        </div>');               //Evita el warning de undefined variable
                        if(!isset($_POST["ruta"])){ $_POST["ruta"]="";}
                        if(!isset($_POST["ruta1"])){ $_POST["ruta1"]="";}
                        if(!isset($_POST["ruta2"])){ $_POST["ruta2"]="";}
                        header("Refresh: 1; URL=dashboard.php?carpeta=".$_POST["ruta1"].$_POST["ruta2"].$_POST["ruta"]);
            }
        }else{
            printf('
            <div class="alert alert-warning text-center" role="alert">
            <h2>La carpeta especificada no existe</h2>
            </div>');               //Evita el warning de undefined variable
            if(!isset($_POST["ruta"])){ $_POST["ruta"]="";}
            if(!isset($_POST["ruta1"])){ $_POST["ruta1"]="";}
            if(!isset($_POST["ruta2"])){ $_POST["ruta2"]="";}
            header("Refresh: 1; URL=dashboard.php?carpeta=".$_POST["ruta1"].$_POST["ruta2"].$_POST["ruta"]);
        }
    
        if(is_file($directorio)){
    
            $eliminar = unlink($directorio);
    
            if($eliminar){
                header("Location: dashboard.php?carpeta=".$_POST["ruta1"].$_POST["ruta2"].$_POST["ruta"]);
            }else{
                printf('
                        <div class="alert alert-danger text-center" role="alert">
                        <h2>No se ha podido eliminar el archivo especificado</h2>
                        </div>');               //Evita el warning de undefined variable
                        if(!isset($_POST["ruta"])){ $_POST["ruta"]="";}
                        if(!isset($_POST["ruta1"])){ $_POST["ruta1"]="";}
                        if(!isset($_POST["ruta2"])){ $_POST["ruta2"]="";}
                        header("Refresh: 1; URL=dashboard.php?carpeta=".$_POST["ruta1"].$_POST["ruta2"].$_POST["ruta"]);
            }

        }else{
            printf('
            <div class="alert alert-warning text-center" role="alert">
            <h2>El archivo especificado no existe</h2>
            </div>');               //Evita el warning de undefined variable
            if(!isset($_POST["ruta"])){ $_POST["ruta"]="";}
            if(!isset($_POST["ruta1"])){ $_POST["ruta1"]="";}
            if(!isset($_POST["ruta2"])){ $_POST["ruta2"]="";}
            header("Refresh: 1; URL=dashboard.php?carpeta=".$_POST["ruta1"].$_POST["ruta2"].$_POST["ruta"]);
        }
    }
    

}

//FUNCIÓN PARA ELIMINAR CARPETAS CON CONTENIDO
function Delete_dir($directorio){
    
    foreach(glob($directorio."/*") as $archivo){
        
        if(is_dir($archivo)){            
            
            Delete_dir($archivo);
        }else{
            unlink($archivo);
        }
    }
    $EliminarCarpeta = rmdir($directorio);
    
    return $EliminarCarpeta; //Devuelve true o false, es decir, el varlo de la variable.

}