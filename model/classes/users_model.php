<?php
    class User {
        protected $db;
        private $datos_array;
        private $datos_;

        function __construct(){
            require_once("/xampp/htdocs/blogterplus/model/connect.php");     
            $this->db=Conectar::conexion();
            $this->datos_array=array();
            $this->datos_seg=array();
        }
        
        public function checkInput($variable){
            $variable= htmlspecialchars($variable);
            $variable= trim($variable);
            $variable= stripslashes($variable);
            return $variable;
        }

        //Verificar Email
        public function checkEmail($email){
            $stmt=$this->db->prepare("SELECT email FROM users WHERE email=:email");
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            $count=$stmt->rowCount();
            if($count>0){
                return true;
            }else{
                return false;
            }
        }

        //Crear Usuario
        public function create($nombre, $apellido, $password, $email, $nickname, $birthday, $sexo){
            $sqlInsertar= "INSERT INTO USERS (nombre, apellido, password, email,nickname, birthday, sexo, fecha_registro) 
            VALUES (:nombre, :apellido, :password, :email,:nickname,:birthday,:sexo, now())";
           
            $registro = $this->db->prepare($sqlInsertar);
            $registro->execute(array(":nombre" => $nombre, ":apellido" => $apellido, ":password" => $password,
            ":email" => $email, ":nickname"=> $nickname,":birthday"=> $birthday,":sexo"=>$sexo));
            $registro->closeCursor();
            header("Location: /xampp/blogterplus/index.php");
        }

        //actualizar Usuario con foto:
        public function actualizarF($nombre, $apellido, $password, $birthday, $foto, $user){
            $sqlInsertar= "UPDATE USERS SET nombre=:nombre, apellido=:apellido, password=:password,  birthday=:birthday, foto=:foto WHERE usuario_id=:user" ;
          
           
            $registro = $this->db->prepare($sqlInsertar);
            $registro->execute(array(":user"=>$user,":nombre" => $nombre, ":apellido" => $apellido, ":password" => $password,":birthday"=> $birthday,
            ":foto" => $foto));
            $registro->closeCursor();
            //header("Location: ");
        }

        //actualizar Usuario sin foto:
        public function actualizar($nombre, $apellido, $password, $birthday, $user){
            $sqlInsertar= "UPDATE USERS SET nombre=:nombre, apellido=:apellido, password=:password,  birthday=:birthday WHERE usuario_id=:user";     
            $registro = $this->db->prepare($sqlInsertar);
            $registro->execute(array(":user"=>$user, ":nombre" => $nombre, ":apellido" => $apellido, ":password" => $password,":birthday"=> $birthday));
            $registro->closeCursor();
            //header("Location: ");
        }

        //Iniciar sesión

        public function ingresar($email,$password){

            //Verificación contraseña hash
            $sqlHash= "SELECT * FROM USERS WHERE email=:email";
            $contrahash=$this->db->prepare($sqlHash);
            $contrahash->execute(array(":email"=>$email));
            $result=$contrahash->fetchAll(PDO::FETCH_ASSOC);
            $contrahash->closeCursor();
           
            foreach($result as $elemento){
                $passHash=$elemento['password'];
                $usuarioLogin=$elemento['nickname'];
                $fotoLogin= $elemento['foto'];
                $usuario_id= $elemento["usuario_id"];
            
                if(password_verify( $password, $passHash)){  
                    session_start();
                    $_SESSION["usuario"]=$usuarioLogin;
                    $_SESSION["foto"]=$fotoLogin;
                    $_SESSION["usuario_id"]=$usuario_id;                   
                    return true;         
                
                }else{
                    header("Location: ../index.php?modal=2&error2=Email y/o contraseña incorrecta(s).");
                }
            }    
        }

        //Cerrar sesión

        public function salir(){
            session_start();
            unset($_SESSION["usuario"]);
            session_destroy();

            header("../../index.php");
        }

        //Consultar datos de usuario

        public function datosUser($usuario_id){
            $user=$this->db->prepare("SELECT * FROM users WHERE usuario_id=:usuario_id");          
            $user->execute(array(":usuario_id"=>$usuario_id));

            while($datos=$user->fetch(PDO::FETCH_ASSOC)){
                $this->datos_array[]=$datos;            } 

            $user->closeCursor();            

            return $this->datos_array;  

        }

        //SISTEMA DE SEGUIMIENTO

        //Seguimiento de usuario:
           public function seguir($seguidor, $seguido){
            $fllw = "INSERT INTO follow (seguidor_id, seguido_id, siguiendo) VALUES ('" . $seguidor . "', '" . $seguido . "', 1)";
            $insertarSeg = $this->db->prepare($fllw);
            $insertarSeg->execute();
            $insertarSeg->closeCursor();
            $this->db = null;
        }

        //Verificar si hay seguimiento entre 2 usuarios 

        public function verificarSeg($seguidor, $seguido)
        {
            $consultSeg = "SELECT * FROM follow  WHERE seguidor_id= $seguidor  AND seguido_id=$seguido";
            $varifSeg = $this->db->prepare($consultSeg);
            $varifSeg->execute();
    
            while ($notusuario = $varifSeg->fetch(PDO::FETCH_ASSOC)) {
                $this->datos_seg[] = $notusuario;
            }
    
            $varifSeg->closeCursor();
            $this->db = null;
            return $this->datos_seg;
        }

        //Dejar de Seguir

        public function eliminarSeg($seguidor, $seguido)
        {
            $consultSeg = "DELETE FROM follow  WHERE seguidor_id= $seguidor  AND seguido_id=$seguido";
            $delSeg = $this->db->prepare($consultSeg);
            $delSeg->execute();
            $delSeg->closeCursor();
            $this->db = null;        
        }

        //Mostrar número de seguidores

        public function numSeguidores($autor_id){            
        $seguidores=array();
        $consultaSeguidores = "SELECT seguidor_id, COUNT(siguiendo) AS seguidores FROM follow  GROUP BY seguido_id HAVING seguido_id=:autor";

        $mostrar= $this->db->prepare($consultaSeguidores);
        $mostrar->execute(array(":autor" => $autor_id));

        while ($resultado = $mostrar->fetch(PDO::FETCH_ASSOC)) {
            $seguidores[] = $resultado;//Array con los valores
        }

        if(count($seguidores)>0){
            foreach ($seguidores as $numero) {
                $array_cal=$numero["seguidores"];                     
                } 
                $mostrar->closeCursor();
                $this->db= null;
                $array_cal;
                return $array_cal;

        }else{
            return 0;
        }
        }

        //Mostrar número de seguidos

        public function numSeguidos($autor_id){            
            $seguidos=array();
            $consultaSeguidos = "SELECT seguido_id, COUNT(siguiendo) AS seguidos FROM follow  GROUP BY seguidor_id HAVING seguidor_id=:autor";
    
            $mostrar= $this->db->prepare($consultaSeguidos);
            $mostrar->execute(array(":autor" => $autor_id));
    
            while ($resultado = $mostrar->fetch(PDO::FETCH_ASSOC)) {
                $seguidos[] = $resultado;//Array con los valores
            }
    
            if(count($seguidos)>0){
                foreach ($seguidos as $numero) {
                    $array_cal=$numero["seguidos"];                     
                    } 
                    $mostrar->closeCursor();
                    $this->db= null;
                    $array_cal;
                    return $array_cal;
    
            }else{
                return 0;
            }
            }

            //Array de seguidores por id

            public function listSeguidoresId($autor_id){            
                $seguidores=array();
                $id_seguidores=array();
                $consultaSeguidores = "SELECT seguidor_id FROM follow WHERE seguido_id=:autor";
        
                $mostrar= $this->db->prepare($consultaSeguidores);
                $mostrar->execute(array(":autor" => $autor_id));
        
                while ($resultado = $mostrar->fetch(PDO::FETCH_ASSOC)) {
                    $seguidores[] = $resultado;//Array con los valores
                }

                if(count($seguidores)>0){
                    foreach($seguidores as $x){
                        $id_seguidores[]=$x["seguidor_id"];
                    }
                    return $id_seguidores; 
                }else{
                    return $id_seguidores;
                }
                
                }

            //Array de Seguidos pot id
            public function listSeguidosId($autor_id){            
                $seguidores=array();
                $ids_array=array();
                $consultaSeguidores = "SELECT seguido_id FROM follow WHERE seguidor_id=:autor";
        
                $mostrar= $this->db->prepare($consultaSeguidores);
                $mostrar->execute(array(":autor" => $autor_id));
        
                while ($resultado = $mostrar->fetch(PDO::FETCH_ASSOC)) {
                    $seguidores[] = $resultado;//Array con los valores
                }
                
                if (count($seguidores)>0){
                    foreach($seguidores as $persona){
                        $ids_array[]=$persona["seguido_id"];                       
                    }
                    return $ids_array;                     
                }else{
                    return $ids_array;                 
                }
            }





        
    }    
?>