<?php


    class Consulta{

        protected $db;
        private $obras_array;
        private $capitulos_array;
        private $datosCap_array;

        function __construct(){
            require_once("/xampp/htdocs/blogterplus/model/connect.php");     
            $this->db=Conectar::conexion();
            $this->obras_array=array();
            $this->capitulos_array=array();
            $this->datosCap_array=array();
        }

        public function listarObras($usuario_id){
            $consulta=$this->db->prepare("SELECT * FROM obras WHERE usuario_id=:id ORDER BY fecha_actualizacion DESC");
            $consulta->bindParam(":id", $usuario_id, PDO::PARAM_STR);
            $consulta->execute();
            

            while($registros=$consulta->fetch(PDO::FETCH_ASSOC)){
                $this->obras_array[]=$registros;
            }
            return $this->obras_array;       

        }

        //----------------------CONSULTA DE OBRAS: 

        //DE USUARIO ESPECÍFICO
        public function consultarObra($usuario_id, $obra_id){
            $consulta=$this->db->prepare("SELECT * FROM obras WHERE usuario_id=:usuario_id  AND obra_id=:obra_id");
            // $consulta->bindParam(":id", $usuario_id, PDO::PARAM_STR);
            $consulta->execute(array(":usuario_id"=>$usuario_id, ":obra_id"=>$obra_id)); 
            

            while($obra=$consulta->fetch(PDO::FETCH_ASSOC)){
                $this->obras_array[]=$obra;
            }            
            return $this->obras_array;     

        }

        // Consultar obras del autor logeado
        public function consultarObras($usuario_id){
            $consulta=$this->db->prepare("SELECT * FROM obras WHERE usuario_id=:usuario_id ORDER BY fecha_actualizacion DESC");
            //$consulta->bindParam(":id", $usuario_id, PDO::PARAM_STR);
            $consulta->execute(array(":usuario_id"=>$usuario_id)); 
            

            while($obra=$consulta->fetch(PDO::FETCH_ASSOC)){
                $this->obras_array[]=$obra;
            }            
            return $this->obras_array;     

        }

        //Consultar obra por id obra

        public function consultarObraPub($obra_id){
            $consulta=$this->db->prepare("SELECT * FROM obras WHERE obra_id=:obra_id ORDER BY fecha_actualizacion DESC");
            //$consulta->bindParam(":id", $usuario_id, PDO::PARAM_STR);
            $consulta->execute(array(":obra_id"=>$obra_id)); 
            

            while($obra=$consulta->fetch(PDO::FETCH_ASSOC)){
                $this->obras_array[]=$obra;
            }            
            return $this->obras_array;     

        }


        //CONSULTAR OBRAS EN GENERAL

        public function consultarAllObras(){
            $consulta=$this->db->prepare("SELECT * FROM obras ORDER BY fecha_actualizacion DESC");
            //$consulta->bindParam(":id", $usuario_id, PDO::PARAM_STR);
            $consulta->execute(); 

            while($obras=$consulta->fetch(PDO::FETCH_ASSOC)){
                $this->allObras_array[]=$obras;
            }               
         
            return $this->allObras_array;    

        }

        //Consultar por género
        public function consultarGenero($genero){
            $consulta=$this->db->prepare("SELECT * FROM obras WHERE genero=:genero ORDER BY fecha_actualizacion DESC");
            //$consulta->bindParam(":id", $usuario_id, PDO::PARAM_STR);
            $consulta->execute(array(":genero"=>$genero)); 

            while($obra=$consulta->fetch(PDO::FETCH_ASSOC)){
                $this->obras_array[]=$obra;
            }              
          
            return $this->obras_array;     

        }




        ///-----------------------------------------CAPÍTULOS

        public function listarCapitulos($usuario_id, $obra_id){

            $consulta=$this->db->prepare("SELECT * FROM capitulos WHERE usuario_id=:usuario_id AND obra_id=:obra_id ORDER BY numero_cap DESC");
            $consulta->execute(array(":usuario_id"=>$usuario_id, ":obra_id"=>$obra_id)); 
            while($capitulos=$consulta->fetch(PDO::FETCH_ASSOC)){
                $this->capitulos_array[]=$capitulos;
            }                 
       
            return $this->capitulos_array;  
        }

        //Listar últimos capítulos del autor

        public function ultCapsUser($usuario_id){
            $consulta=$this->db->prepare("SELECT * FROM capitulos WHERE usuario_id=:usuario_id ORDER BY fecha_actualizacion DESC");
            $consulta->execute(array(":usuario_id"=>$usuario_id)); 
            while($capitulos=$consulta->fetch(PDO::FETCH_ASSOC)){
                $this->capitulos_array[]=$capitulos;
            }                 
       
            return $this->capitulos_array;  

        }

        //Listar últimos capítulos de la obra

        public function capsObra($obra_id){
            $consulta=$this->db->prepare("SELECT * FROM capitulos WHERE obra_id=:obra_id ORDER BY numero_cap");
            $consulta->execute(array(":obra_id"=>$obra_id)); 
            while($capitulos=$consulta->fetch(PDO::FETCH_ASSOC)){
                $this->capitulos_array[]=$capitulos;
            }               
         
            return $this->capitulos_array;  

        }

        //Listar últimos capítulos del público PUBLICADOS

        public function ultCapsPublico(){
            $consulta=$this->db->prepare("SELECT * FROM capitulos  ORDER BY fecha_actualizacion DESC LIMIT 20");
            $consulta->execute(); 
            while($capitulos=$consulta->fetch(PDO::FETCH_ASSOC)){
                $this->capitulos_array[]=$capitulos;
            }               
         
            return $this->capitulos_array;  

        }

        public function insertarCapitulos($usuario_id, $obra_id, $tituloCap, $numCap, $contenido, $tituloObra){   
            
            // Default 2014-04-04 12:00:00            
            $fechaActual= date("Y-m-d H:i:s");//Fecha actual 
                      
                $consultaInsertar="INSERT INTO capitulos(usuario_id, obra_id, titulo_cap, numero_cap, contenido, 
                fecha_creacion, fecha_actualizacion, titulo_obra) VALUES ('" . $usuario_id ."', '" . $obra_id . "', '" . $tituloCap . "', '"
                . $numCap . "', '" . $contenido . "', '" . $fechaActual . "', '" . $fechaActual  ."','" . $tituloObra ."')";
        
                $insertarCap=$this->db->prepare($consultaInsertar);
                $insertarCap->execute();                
                $insertarCap->closeCursor();
                 
                header("Location: ../view/listaObrasView.php");           
        }

        public function mostrarCapitulo($obra_id, $capitulo_id){

            $consulta=$this->db->prepare("SELECT * FROM capitulos WHERE capitulo_id=:capitulo_id AND obra_id=:obra_id");
            $consulta->execute(array(":obra_id"=>$obra_id,":capitulo_id"=>$capitulo_id)); 
            while($datosCap=$consulta->fetch(PDO::FETCH_ASSOC)){
                $this->datosCap_array[]=$datosCap;
            }             

            return $this->datosCap_array;           
        }

        public function actualizarCapitulo($capitulo_id, $tituloCap, $numeroCap, $contenidoCap, $fechaActualizacion){

            
            $actualizarCap="UPDATE capitulos SET titulo_cap=:tituloCap, numero_cap=:numCap, contenido=:contenido,
            fecha_actualizacion=:lafecha WHERE capitulo_id=:capId";
            // $actualizarCap="UPDATE capitulos SET titulo_Cap=$tituloCap, numero_cap=$numeroCap, contenido=$contenidoCap,
            // fecha_actualizacion=$fechaActualizacion WHERE capitulo_id=$capitulo_id";

            $actualizar=$this->db->prepare($actualizarCap);
            $actualizar->execute(array(":capId"=>$capitulo_id, ":tituloCap"=> $tituloCap, ":numCap"=>$numeroCap,":contenido"=>$contenidoCap, ":lafecha"=>$fechaActualizacion));            
            echo "<br> Se ha actualizado el capitulo con éxito. <br>";
            $actualizar->closeCursor();

            header("Location: ../view/listaObrasView.php");


        }
        public function eliminarCapitulo($obra_id, $capitulo_id){

            $consultaDel=$this->db->prepare("DELETE FROM capitulos WHERE capitulo_id=:capitulo_id AND obra_id=:obra_id");
            $consultaDel->execute(array(":obra_id"=>$obra_id,":capitulo_id"=>$capitulo_id));
            $consultaDel->closeCursor();
            
            header("Location: ../view/listaObrasView.php");   
                   
        }



    }


?>