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
            echo "Archivo subido correctamente <br>";
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
        $obraId=$_GET["obra"];
           
        
        if($portada==""){
            $actualizarObra="UPDATE obras SET titulo=:tituloObra, sinopsis=:sinopsis, genero=:genero,
            fecha_actualizacion=:lafecha WHERE obra_id=:obraId";

            $actualizar=$base->prepare($actualizarObra);
            $actualizar->execute(array(":obraId"=>$obraId, ":tituloObra"=> $tituloObra, ":sinopsis"=>$sinopsis,
            ":genero"=>$genero, "lafecha"=>$lafecha ));
            // $result=$obraRegistrada->fetchAll(PDO::FETCH_ASSOC);
            echo "<br> Se ha actualizado la obra con éxito. <br>";
            $actualizar->closeCursor();   
            
           
        }else{
        $actualizarObra="UPDATE obras SET titulo=:tituloObra, sinopsis=:sinopsis, portada=:portada, genero=:genero,
        fecha_actualizacion=:lafecha WHERE obra_id=:obraId";
        $actualizar=$base->prepare($actualizarObra);
        $actualizar->execute(array(":obraId"=>$obraId, ":tituloObra"=> $tituloObra, ":sinopsis"=>$sinopsis,":portada"=>$portada,
        ":genero"=>$genero, "lafecha"=>$lafecha ));
        // $result=$obraRegistrada->fetchAll(PDO::FETCH_ASSOC);
        echo "<br> Se ha actualizado la obra con éxito. <br>";
        $actualizar->closeCursor();   
        }

        
        
        header("Location: ../view/listaObrasView.php");
   
       }

      

   ?> 

