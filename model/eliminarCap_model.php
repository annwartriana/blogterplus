<?php
    session_start(); 
    if(!isset($_SESSION["usuario"])){
     header("location: ../index.php");
    }

    require_once("/xampp/htdocs/blogterplus/model/classes/consultaObras_model.php");
    $delCap= new Consulta();
    // echo $_GET["oid"] ."<br>";
    // echo  $_GET["cid"];
    $delCap->eliminarCapitulo($_GET["oid"], $_GET["cid"] );    
?>