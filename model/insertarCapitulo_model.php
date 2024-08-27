<?php
    session_start(); 
    if(!isset($_SESSION["usuario"])){
     header("location: ../index.php");
    }

    if($_SESSION["usuario_id"]== $_POST["autor_id_hidden"]){

        //Recuperamos valores
        $usuario_id=$_POST["autor_id_hidden"];
        $titulo_cap=$_POST["titulo_capitulo"];
        $num_cap=$_POST["numCap"];
        $contenido=$_POST["texto_capitulo"];
        $obra_id_h=$_POST["obra_id_hidden"];
        $obra_titulo=$_POST["tit_obra"];
        $f_creacion_h=$_POST["f_creacion"];   

        
        require_once("/xampp/htdocs/blogterplus/model/classes/consultaObras_model.php");
        $consultaCaps= new Consulta();
        $cap_nuevo=$consultaCaps->insertarCapitulos($usuario_id,$obra_id_h,$titulo_cap,$num_cap,$contenido,$obra_titulo);       
      

    }else{
        header("location: ../index.php");
    }


    

     

   
   ?> 


