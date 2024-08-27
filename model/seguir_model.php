<?php
    session_start(); 
    if(!isset($_SESSION["usuario"])){
     header("location: ../index.php");
    }

    require_once("/xampp/htdocs/blogterplus/model/classes/users_model.php");
 
    $segU= new User();
    $segU2= new User();

      
    if(isset($_POST["seguir"])){
        //Recuperar valores 
        $seguido=($_POST["seguido"]);
        $seguidor=($_POST["seguidor"]);
        $obra_id=($_POST["obra"]);

        echo $seguido;

          //Verifico si el usuario ya está siguiendo al otro
          $yaSeg=$segU->verificarSeg($seguidor,$seguido);

          if(count($yaSeg)>0){
              //Si seguió -> eliminar
              $segU2->eliminarSeg($seguidor,$seguido);
  
          }else{
              //inserto seguidor
              $segU2->seguir($seguidor,$seguido);
          }
  
          header("Location: ../view/LecturaObraView.php?o=$obra_id");        
  
      }else{
          echo header("location: ../index.php");
        
      }
?>