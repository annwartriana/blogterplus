<?php
    session_start(); 
    if(!isset($_SESSION["usuario"])){
     header("location: ../index.php");
    }

    require_once("/xampp/htdocs/blogterplus/model/classes/consultaObras_model.php");
    $updCap= new Consulta();
    // echo $_GET["oid"] ."<br>";
    // echo  $_GET["cid"];

    //Recuperar valores 
    $titCap=($_POST["titulo_capitulo"]);
    $numCap=($_POST["numCap"]);
    $contenido=($_POST["texto_capitulo"]);   
    $lafecha=date("Y-m-d H:i:s");//Fecha actual    
    $capId=($_POST["cap_id_hidden"]); 

    //Llamar a método
    $updCap->actualizarCapitulo($capId,$titCap,$numCap,$contenido,$lafecha);
    
?>