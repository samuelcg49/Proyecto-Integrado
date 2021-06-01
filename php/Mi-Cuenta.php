<!-- HEADER -->
<?php
  session_start();

  if(empty($_SESSION["Usuario_logueado"])){
    
    header("Location: index.php");
    
  }else

?>
<?php include_once("../includes/header.php");    

define('DB_SERVER','localhost'); 
define('DB_NAME','usuarios'); 
define('DB_USER','proyecto'); 
define('DB_PASS','proyecto'); 

    $conexion = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME); 
    $user = $_SESSION["Usuario_logueado"];
    $consulta = mysqli_query($conexion, "SELECT * FROM t_usuarios WHERE nombre = '$user' ");

  mysqli_query($conexion, "SET NAMES utf8");

printf('<div class="contenedor">
          <h2>Mis datos</h2>
          <br>');
    printf("<table>");

    while($datos = mysqli_fetch_assoc($consulta)){
        printf("<tr>");
            printf("<td class='bg-primary' style='color: white;'> ID </td>");
            printf("<td>%s</td>",$datos["id"]);
        printf("</tr>");
        printf("<tr>");
            printf("<td class='bg-primary' style='color: white;'> Nombre de Usuario </td>");
            printf("<td>%s</td>",$datos["nombre"]);
        printf("</tr>");
        printf("<tr>");
            printf("<td class='bg-primary' style='color: white;'> 1er Apellido </td>");
            printf("<td>%s</td>",$datos["ape1"]);
        printf("</tr>");
        printf("<tr>");
            printf("<td class='bg-primary' style='color: white;'> 2º Apellido </td>");
            printf("<td>%s</td>",$datos["ape2"]);
        printf("</tr>");
        printf("<tr>");
            printf("<td class='bg-primary' style='color: white;'> Correo electrónico </td>");
            printf("<td>%s</td>",$datos["email"]);
        printf("</tr>");
        printf("<tr>");
            printf("<td class='bg-primary' style='color: white;'> Fecha de alta </td>");
            printf("<td>%s</td>",$datos["FchIngreso"]);
        printf("</tr>");
    }       
    
printf("</table>
  </div> <br><br><br><br>");
   
?>

            <script src="../jquery/jquery-3.6.0.min.js"></script>
            <script src="../bootstrap/js/bootstrap.bundle.js"></script>
    </body>
    </html>