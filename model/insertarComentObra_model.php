<?php
session_start(); 
if(!isset($_SESSION["usuario"])){
    header("location: ../index.php");
}

//Recupero valores formulario
$usuario_id=$_POST["usuario"];
$obra_id=$_POST["obra"];
$comentario=$_POST["contenido"];
$foto=$_POST["foto"];
$nicky= $_POST["nick"];

if($comentario!=""){
    require_once("/xampp/htdocs/blogterplus/model/classes/comentarios_model.php");
    $consultaCom= new Coment();
    $coment_nuevo=$consultaCom->comentObra($usuario_id,$obra_id,$nicky,$foto,$comentario);
    header('Location: ../view/lecturaObraView.php?o='. $obra_id);
}else{
    header('Location: /view/lecturaObraView.php?o='. $obra_id);
}



?>

