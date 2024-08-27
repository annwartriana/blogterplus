<?php
    session_start(); 
    if(!isset($_SESSION["usuario"])){
     header("location: ../index.php");
    }

    // require_once("/xampp/htdocs/blogterplus/model/classes/users_model.php");
    require_once("/xampp/htdocs/blogterplus/model/connect.php");

    // $usuario= new User();
    $base=Conectar::conexion(); 

    if(isset($_POST["guardar"])){      

         //------------------Manejo de errores al subir archivos
        if($_FILES["subirImagen"]["error"]){

            switch ($_FILES["subirImagen"]["error"]){
                case 1: //Error exceso de tamaño
                    echo "El tamaño del archivo excede lo permitido por el servidor";
                    break;
                case 2: //Error tamaño indicado en el formulario
                    echo "El tamaño del archivo excede el valor fijado";
                    break;
                case 3: //Error en la transmisión - Corrupción de archivo
                    echo "El envío del archivo se interrumpió";
                    break;
                case 4: //No hay fichero
                    echo "No se ha enviado ningún archivo";
                    break;            
            }
        }else{
            echo "Entrada subida correctamente <br>";
            //El caso cero es cuando se sube correctamente el archivo
            if(isset($_FILES["subirImagen"]["name"]) && ($_FILES["subirImagen"]["error"]==0)){
                $destino_de_ruta ="../view/assets/portadas/";
                //Movemos archivo desde directorio temporal al deseado
                move_uploaded_file($_FILES["subirImagen"]["tmp_name"], $destino_de_ruta .$_FILES["subirImagen"]["name"] ); //
                echo "El archivo " . ($_FILES["subirImagen"]["name"]) . " se ha copiado en el directorio.";
            }else{
                echo "El archivo no ha podido copiarse en el directorio";
            }
        }

        //Recuperar valores 
        $tituloObra= htmlentities($_POST["titulo_obra"]);        
        $sinopsis=htmlentities($_POST["sinopsis"]);
        $lafecha=date("Y-m-d H:i:s");//Fecha actual   
        $genero=$_POST["inlineRadioOptions"];
        $portada= $_FILES['subirImagen']['name'];
        $usuarioId= $_SESSION["usuario_id"];   
        
        if($portada==""){
            $portada="portadadef.jpg";
        }

        $consultaInsertar="INSERT INTO obras(titulo, usuario_id, sinopsis, portada, genero, fecha_creacion, fecha_actualizacion)
        VALUES ('" . $tituloObra ."', '" . $usuarioId . "', '" . $sinopsis . "', '" . $portada . "', '" . $genero . "', '" .
        $lafecha . "', '" . $lafecha  ."')";

        $obraRegistrada=$base->prepare($consultaInsertar);
        $obraRegistrada->execute();
        $result=$obraRegistrada->fetchAll(PDO::FETCH_ASSOC);
        echo "<br> Se ha agregado la obra con éxito. <br>";
        $obraRegistrada->closeCursor();   
        
        header("Location: ../view/listaObrasView.php");
   
       }

   ?> 

