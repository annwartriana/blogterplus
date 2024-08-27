<?php
    
require_once("/xampp/htdocs/blogterplus/model/classes/users_model.php");
require_once("/xampp/htdocs/blogterplus/model/connect.php");

$usuarioLogin= new User();
// $baseLogin=Conectar::conexion();


    if (isset($_POST["ingresar"])){
        $email = $usuarioLogin->checkInput($_POST['email']);
        $pass= $usuarioLogin->checkInput($_POST['password']);
        //$pass=password_hash($password, PASSWORD_DEFAULT);
        $verificado=$usuarioLogin->ingresar($email, $pass);  
        
        if($verificado){
           session_start();
           header ("location: /view/loginView.php");
        }else{
            header("Location: ../index.php?modal=2&error2=Email y/o contraseña incorrecta(s).");
        }
    }  

?>


