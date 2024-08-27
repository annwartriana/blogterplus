<?php
include("plantilla.php");

session_start();
if (!isset($_SESSION["usuario"])) {
    header("location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogter+ Lista de Obras</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="/view/css/bootstrap.css">
    <!-- Iconos de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- CSS Propios -->
    <link rel="stylesheet" href="/view/css/main.css">
</head>

<body>

    <!--Barra de Navegación  -->
    <?php echo navbarLogin(); ?>

    <div class="container">
        <div class="row my-5">
            <!-- <div class="col d-flex justify-content-center ">  -->
            <h1 class="text-center"> Lista de Obras</h1>
                <?php

                require_once("/xampp/htdocs/blogterplus/model/classes/consultaObras_model.php");
                $consultaObras= new Consulta();
                $listaObras=$consultaObras->listarObras($_SESSION["usuario_id"]);

                if(count($listaObras)>0){

                    foreach($listaObras as $obra){

                        echo '<div class="row my-3">
                                 <div class="col d-flex justify-content-center " >
                                    <div class="card mb-1" style="max-width: 700px;"> 
                                            <div class="row no-gutters">
                                                <div class="col-md-4 d-flex align-items-center">
                                                    <a href="/view/creacionCapView.php?obra=' . $obra["obra_id"] . '&autor=' . $obra["usuario_id"] . '"> <img src="/view/assets/portadas/'. $obra["portada"] .'" class="card-img" alt="Portada No Disponible"></a>                                                    
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <a href="/view/creacionCapView.php?obra=' . $obra["obra_id"] . '&autor=' . $obra["usuario_id"] . '"><h3 class="card-title">' . $obra["titulo"] . '</h3></a> 
                                                        <p class="card-text"><small class="text-muted">Género: ' . $obra["genero"] .' </small></p>
                                                        <p class="card-text">' . $obra["sinopsis"] . '</p>
                                                        <p class="card-text"><small class="text-muted">Calificación: ' . $obra["calificacion"] .'/10 </small></p>
                                                        <p class="card-text"><small class="text-muted">Última actualización: ' . $obra["fecha_actualizacion"] .'</small></p>
                                                    </div>

                                                    <div class="d-flex justify-content-center " >
                                                    <a class="btn-perfil mb-3 rounded" style="padding: 20px;" href="/view/creacionCapView.php?obra=' . $obra["obra_id"] . '&autor=' . $obra["usuario_id"] . '"> Agregar Capítulo <a/></div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                             </div>';
                     }                     
                }?>


            <!-- </div> -->
        </div>
    </div>

    <!-- Footer -->
    <?php echo footer(); ?>

    <!-- Importamos los scripts de JS -->
    <script src="/view/js/jquery.js"></script>
    <script src="/view/js/popper.js"></script>
    <script src="/view/js/bootstrap.js"></script>
</body>

</html>