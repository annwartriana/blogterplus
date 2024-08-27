<?php

session_start();
if (!isset($_SESSION["usuario"])) {
    header("location: /../index.php");
}

require_once("/xampp/htdocs/blogterplus/model/classes/users_model.php");
$usuario= new User();

if (isset($_POST["actualizar"])){               
    $foto="";
    
        //------------------Manejo de errores al subir imagen
            if($_FILES["subirImagen"]["error"]){

                switch ($_FILES["subirImagen"]["error"]){
                    case 1: //Error exceso de tamaño
                        header("Location: ../view/editPerfil.php?error=El tamaño del archivo excede lo permitido por el servidor");
                        break;
                    case 2: //Error tamaño indicado en el formulario
                        header("Location: ../view/editPerfil.php?error=El tamaño del archivo excede el valor fijado");
                        break;
                    case 3: //Error en la transmisión - Corrupción de archivo
                        header("Location: ../view/editPerfil.php?error=El envío de la imagen se interrumpió");
                        break;                                        
                }
            }else{
                //echo "Entrada subida correctamente <br>";

                //El caso cero es cuando se sube correctamente el archivo
                if(isset($_FILES["subirImagen"]["name"]) && ($_FILES["subirImagen"]["error"]==0)){
                    $destino_de_ruta ="../view/assets/fotos_perfil/";
                    //Movemos archivo desde directorio temporal al deseado
                    move_uploaded_file($_FILES["subirImagen"]["tmp_name"], $destino_de_ruta .$_FILES["subirImagen"]["name"] ); //
                    //echo "El archivo " . ($_FILES["subirImagenPerfil"]["name"]) . " se ha copiado en el directorio.";
                    $foto= $_FILES['subirImagen']['name'];
                }else{
                    header("Location: ../view/editPerfil.php?error=La imagen no ha podido copiarse en el directorio");
                }
            }

            $nombre = $usuario->checkInput($_POST['nombre_form']);
            $apellido= $usuario->checkInput($_POST['apellido_form']);      
            $password = $usuario->checkInput($_POST['password_form']);       
            $passwordRepeat = $usuario->checkInput($_POST['password_form_repeat']);
            $birthday =$_POST['fecha_nacimiento']; 
          
            $id=$_SESSION["usuario_id"];
          
       

       //Comprobamos si las contraseñas son iguales
       if ($password != $passwordRepeat){
           header("Location: ../view/editPerfil.php?error=¡Las contraseñas no coinciden!");
       }else{
           $password=password_hash($passwordRepeat, PASSWORD_DEFAULT);    
        
                   //Creamos el registro
                    if ($foto==""){
                        $usuario->actualizar($nombre, $apellido, $password,  $birthday,$id);                        
                    }else{
                        $usuario->actualizarF($nombre, $apellido, $password,  $birthday,$foto,$id);  
                    }
                       
                    header("Location: ../view/perfilPersonalView.php");
                      
               }
       }
     

  
?>