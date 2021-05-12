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

        <!-- Modal de copiar elementos -->
        <div class="modal fade" id="Copiar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="opciones.php" id="login-form">
                            <input type="text" name="elemento" id="elemento" placeholder="Nombre del elemento a copiar">
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
                            <input type="submit" class="btn btn-primary" value="Copiar" name="Copiar">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de cortar o mover elementos -->
        <div class="modal fade" id="Mover" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="opciones.php" id="login-form">
                            <input type="text" name="elemento1" id="elemento1" placeholder="Nombre del fichero o directorio">
                            <br>
                            <input type="text" name="RutaElemento" id="RutaElemento" placeholder="Nueva ruta del fichero o directorio">
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
                            <input type="submit" class="btn btn-primary" value="Mover" name="Mover">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de renombrar elementos -->
        <div class="modal fade" id="Renombrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="opciones.php" id="login-form">
                            <input type="text" name="oldName" id="oldName" placeholder="Nombre del fichero o directorio">
                            <br>
                            <input type="text" name="newName" id="newName" placeholder="Nuevo nombre del fichero o directorio">
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
                            <input type="submit" class="btn btn-primary" value="Renombrar" name="Renombrar">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de eliminar elementos -->
        <div class="modal fade" id="Eliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="opciones.php" id="login-form">
                            <input type="text" name="DeleteFile" id="DeleteFile" placeholder="Nombre archivo para eliminar" required>
                            
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
                            <input type="submit" class="btn btn-danger" value="Eliminar" name="Eliminar">
                        </form>
                    </div>
                </div>
            </div>
        </div>