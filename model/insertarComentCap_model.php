<?php
session_start(); 
if(!isset($_SESSION["usuario"])){
    header("location: ../index.php");
}

//Recupero valores formulario
$usuario_id=$_POST["usuario"];
$cap_id=$_POST["cap"];
$comentario=$_POST["contenido"];
$foto=$_POST["foto"];
$nicky= $_POST["nick"];
$obra_id= $_POST["obra"];
echo $obra_id;
echo $cap_id;

if($comentario!=""){
    require_once("/xampp/htdocs/blogterplus/model/classes/comentarios_model.php");
    $consultaCom2= new Coment();
    $coment_nuevo2=$consultaCom2->comentCap($usuario_id,$cap_id,$nicky,$foto,$comentario);
    
    header('Location: ../view/lecturaCapView.php?cid='. $cap_id . '&o='.$obra_id);
}else{
    header('Location: /view/lecturaCapView.php?cid='. $cap_id . '&o='.$obra_id);
}



?>