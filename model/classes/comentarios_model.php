<?php


    class Coment{

        protected $db2;
        private $coments_obras;
        private $coments_caps;


        function __construct(){
            require_once("/xampp/htdocs/blogterplus/model/connect.php");     
            $this->db2=Conectar::conexion();
            $this->coments_obras=array();
            $this->coments_caps=array();           
        }

        //-------------------------------OBRAS

        //Insertar comentario
         public function comentObra($usuario_id, $obra_id, $nick, $foto, $comentario){

            $fechaActual= date("Y-m-d H:i:s");//Fecha actual 
                      
            $consultComent="INSERT INTO comentsobras(usuario_id, obra_id, comentario, fecha_creacion, nick, foto)
            VALUES ('" . $usuario_id ."', '" . $obra_id . "', '" . $comentario . "', '" . $fechaActual ."', '" . $nick ."','". $foto . "')";
    
            $insertarComent=$this->db2->prepare($consultComent);
            $insertarComent->execute();                
            $insertarComent->closeCursor();
            $this->db2=null; 
            
        }

        public function mostrarComentObra($obra_id){
            $consulta=$this->db2->prepare("SELECT * FROM comentsobras WHERE obra_id=:obra_id");
            $consulta->execute(array(":obra_id"=>$obra_id)); 
            while($coms=$consulta->fetch(PDO::FETCH_ASSOC)){
                $this->coments_obras[]=$coms;
            } 
            return $this->coments_obras;   
        }

        //-------------------------------



        //------------------------------- Caps

        //Insertar comentario        
        public function comentCap($usuario_id, $cap_id, $nick, $foto, $comentario){

            $fechaActual= date("Y-m-d H:i:s");//Fecha actual 
                      
            $consultComent="INSERT INTO comentscaps(usuario_id, capitulo_id, comentario_cap, fecha_creacion,nick, foto)
            VALUES ('" . $usuario_id ."', '" . $cap_id . "', '" . $comentario . "', '" . $fechaActual ."', '" . $nick ."','". $foto . "')";
    
            $insertarComent=$this->db2->prepare($consultComent);
            $insertarComent->execute();                
            $insertarComent->closeCursor();
            $this->db2=null; 
            header('Location:' . getenv('HTTP_REFERER'));
        }

        public function mostrarComentCap($cap_id){
            $consulta=$this->db2->prepare("SELECT * FROM comentscaps WHERE capitulo_id=:cap_id");
            $consulta->execute(array(":cap_id"=>$cap_id)); 
            while($coms=$consulta->fetch(PDO::FETCH_ASSOC)){
                $this->coments_caps[]=$coms;
            } 
            return $this->coments_caps;   
        }

        //-------------------------------

    }
