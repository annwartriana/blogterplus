<?php

    // require_once("/xampp/htdocs/blogterplus/model/classes/calificacionClass_model.php");
    require_once("/xampp/htdocs/blogterplus/model/classes/users_model.php");
 
    // $consultaCal= new Calificacion();
    $consultaSeg=new User();  
    $consultaSeg2=new User();    
    
    
    //Obtengo lista de seguidores por id
    $result= $consultaSeg->listSeguidoresId(1);

         
    //hago nueva consulta haciendo uso de los ids en cada ciclo

    //$contador=0;
    foreach ($result as $seguidor){
        $datosUsuario= $consultaSeg2->datosUser($seguidor);        
    }

        foreach ($datosUsuario as $persona){
            echo $persona["foto"];
            echo'<br>';
            echo $persona["nickname"];     
            echo'<br><br><br>AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA<hr>';
            unset($datosUsuario);
        }
    
          
    // }

           /* $consultaSeguidores3->datosUser($seguidor["seguidor_id"])
            echo '
                <div>

    print_r($result);
    echo $result [0]["nombre"];*/


   
   
?>