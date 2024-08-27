
<?php
class Calificacion
{

    protected $base;
    private $calificacion_obras;
    private $datos_cali;
    private $array_cal;


    function __construct()
    {
        require_once("/xampp/htdocs/blogterplus/model/connect.php");
        $this->base = Conectar::conexion();
        $this->calificacion_obras = 0;
        $this->datos_cali = array();
        $this->array_cal= array();
        
    }


    //Almacenar calificación
    public function calificar($user_id, $obra_id, $valor)
    {
        $consultCal = "INSERT INTO calificaciones(obra_id, usuario_id,calificacion) VALUES ('" . $obra_id . "', '" . $user_id . "', '" . $valor . "')";

        $insertarCal = $this->base->prepare($consultCal);
        $insertarCal->execute();
        $insertarCal->closeCursor();
        $this->base = null;
        // $this->db3=null; 

    }

    //Actualizar calificación

    public function actualizarCal($user_id, $obra_id, $valor)
    {
        $consultCal = "UPDATE calificaciones SET calificacion=:valor WHERE usuario_id=:user AND obra_id=:obra";

        $actualizarCal = $this->base->prepare($consultCal);
        $actualizarCal->execute(array(":valor" => $valor, ":user" => $user_id, ":obra" => $obra_id));
        $actualizarCal->closeCursor();
        $this->base = null;
        // $this->db3=null;
    }

    //Calcular-Mostrar calificación
    public function mostrarCal($obra_id)
    {
        $valor=array();
        //Retornamos el promedio
        // $consultCal = "SELECT calificacion FROM calificaciones  WHERE obra_id=:obra";
        $consultCal = "SELECT obra_id, AVG(calificacion) AS promedio FROM calificaciones  GROUP BY obra_id HAVING obra_id=:obra";

        $mostrar = $this->base->prepare($consultCal);
        $mostrar->execute(array(":obra" => $obra_id));

        while ($nota = $mostrar->fetch(PDO::FETCH_ASSOC)) {
            $valor[] = $nota;//Array con los valores
        }

        if(count($valor)>0){
            foreach ($valor as $numero) {
                $array_cal=$numero["promedio"];                     
                } 
                $mostrar->closeCursor();
                $this->base = null;
                $prom02= bcdiv($array_cal, '1', 1);
                return $prom02;

        }else{
            return 0;
        }

      

  
       
    }


    //Verificar si usuario ya votó
    public function verificarCal($user_id, $obra_id)
    {
        $consultNot = "SELECT * FROM calificaciones  WHERE usuario_id= $user_id AND obra_id=$obra_id";
        $verificarCal = $this->base->prepare($consultNot);
        $verificarCal->execute();

        while ($notusuario = $verificarCal->fetch(PDO::FETCH_ASSOC)) {
            $this->datos_cali[] = $notusuario;
        }

        $verificarCal->closeCursor();
        $this->base = null;
        return $this->datos_cali;
    }
}

?>