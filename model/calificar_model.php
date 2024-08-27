<?php
    session_start(); 
    if(!isset($_SESSION["usuario"])){
     header("location: ../index.php");
    }

   
    require_once("/xampp/htdocs/blogterplus/model/classes/calificacionClass_model.php");
 
    $calObra= new Calificacion();
    $calObra2=new Calificacion();
   
    if(isset($_POST["calificar"])){
        //Recuperar valores 
        $usuario=($_POST["usuario_id"]);
        $obra=($_POST["obra_id"]);
        $nota=($_POST["nota"]);   
        
        //Verifico si el usuario ya votó
        $yaVoto=$calObra->verificarCal($usuario,$obra);

        if(count($yaVoto)>0){
            //Si voto antes
            $calObra2->actualizarCal($usuario,$obra,$nota);

        }else{
            //inserto cal
            $calObra2->calificar($usuario,$obra,$nota);
        }

        header("Location: ../view/LecturaObraView.php?o=$obra");        

    }else{
        echo "NO";
    }
   
?>