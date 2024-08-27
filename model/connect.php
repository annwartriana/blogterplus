<?php
    
    class Conectar {

        public static function conexion(){

            try{
                $conexion= new PDO ("mysql:host=127.0.0.1; dbname=blogterplus", "root", "");                                    
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                        
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                echo "La línea de error es: " . $e->getLine();
            }
            return $conexion;
                 
        }   
    }
?>