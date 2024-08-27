<?php
    
require_once("/xampp/htdocs/blogterplus/model/classes/users_model.php");
require_once("/xampp/htdocs/blogterplus/model/connect.php");

$usuario= new User();
$base=Conectar::conexion();


    if (isset($_POST["registrar"])){
       
        $sexo=$_POST['sexo_form'];      
        if($sexo=="Hombre") {
            $sexo="H";
        }else{
            $sexo="M";
        }
    
          
        $nombre = $usuario->checkInput($_POST['nombre_form']);
        $apellido= $usuario->checkInput($_POST['apellido_form']);
        $email = $usuario->checkInput($_POST['email_form']);
        $password = $usuario->checkInput($_POST['password_form']);
        $nickName= $usuario->checkInput($_POST['nickname_form']);
        $passwordRepeat = $usuario->checkInput($_POST['password_form_repeat']);
        $birthday =$_POST['fecha_nacimiento'];
        

        //Comprobamos si las contraseñas son iguales
        if ($password != $passwordRepeat){
            header("Location: ../index.php?modal=1&error=¡Las contraseñas no coinciden!");
        }else{
            $password=password_hash($passwordRepeat, PASSWORD_DEFAULT);

            //Verificación de NickName
            $comprobarNickName=$base->prepare('SELECT nickname FROM users WHERE nickname = :nickName');
            $comprobarNickName->bindValue(':nickName', $nickName);
            $comprobarNickName->execute();

            if($comprobarNickName->rowCount()>0){
                header("Location:../index.php?modal=1&error=NickName en uso. Elija otro.");
                $comprobarNickName->closeCursor();
            }else{

                //Verificación de email
                $comprobarEmail=$base->prepare('SELECT email FROM users WHERE email = :email');
                $comprobarEmail->bindValue(':email', $email);
                $comprobarEmail->execute();

                if($comprobarEmail->rowCount()>0){
                    header("Location: ../index.php?modal=1&error=Email en uso. Elija otro.");
                    $comprobarEmail->closeCursor();
                }else{
                    //Creamos el registro
                        $usuario->create($nombre, $apellido, $password, $email, $nickName, $birthday, $sexo);
                        header("Location: ../index.php");
                        $base=null;
                }
        }
      

        }        
         
        
}


?>