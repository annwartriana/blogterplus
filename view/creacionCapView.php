<?php
include("/xampp/htdocs/blogterplus/view/plantilla.php");
session_start();
if (!isset($_SESSION["usuario"])) {
    header("location: /../index.php");
}
//Verificamos si es autor de las obras
$id_autor = $_GET["autor"]; 
$id_obra= $_GET["obra"]; 
if ($id_autor != $_SESSION["usuario_id"]) {
    header("location: /../index.php");
}

require_once("/xampp/htdocs/blogterplus/model/classes/consultaObras_model.php");
$consultaObra= new Consulta();
$datosObra=$consultaObra->consultarObra($_SESSION["usuario_id"], $_GET["obra"] );

if(count($datosObra)>0){

    foreach($datosObra as $elemento){  
        $portada= $elemento["portada"];           
        // $sinopsis=$elemento["sinopsis"];            
        $titulo= $elemento["titulo"];
        // $ultFecha= $elemento["fecha_actualizacion"];
        $autor= $elemento["usuario_id"];
        $obraid=$elemento["obra_id"];
        $f_creacion=$elemento["fecha_creacion"];
    }
}   


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogter+ Edición Capítulos</title>
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

    <div class="container-xxl mt-5">
        <form class="row mx-md-5" action="/model/insertarCapitulo_model.php?" method="post" enctype="multipart/form-data" name="formCapitulo">

        <div class="col-10">
            
        </div>
            <!-- Columna 1-->
            <div class="col-12 col-md-3 order-sm-3 order-2 order-md-0  ">
                <div>
                    <br>
                    <img class=" mt-4 mb-1 mb-md-4" src="/view/assets/portadas/<?php echo $portada ?>" height="350" width="100%" alt="">
                    <div class="d-flex justify-content-center">
                        <a class="btn-editObra" href="updateObraView.php?obra=<?php echo ''.$id_obra . '&autor=' . $id_autor?>"> Editar Obra</a>
                    </div>
                </div>

            </div>
            <!-- Columna 2 -->
            <div class="col-12 col-md-6 order-sm-2 order-1 order-md-0 ">

                <!-- TÍTULO OBRA -->
                <h3 class="mb-4" style="text-align:center; text-transform:uppercase;"><?php echo ($titulo) ?></h3>
                <!-- TÍTULO CAPÍTULO -->
                <input class="col-12 form-control" type="text" class="form-control" style="font-size:1.5em;" placeholder="Título del capítulo" name="titulo_capitulo" required> <br>
                <input type="text" name="autor_id_hidden" value="<?php echo $autor?>" hidden>
                <input type="text" name="obra_id_hidden" value="<?php echo $obraid?>" hidden>
                <input type="text" name="f_creacion" value="<?php echo $f_creacion?>" hidden>
                <input type="text" name="tit_obra" value="<?php echo $titulo?>" hidden>


                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Número del capítulo: </span>
                    <input type="number" name="numCap" class="form-control" placeholder="Ingrese el número del capítulo"  required aria-label="NumCapitulo" aria-describedby="basic-addon1">
                </div>

                <!-- CONTENIDO CAPÍTULO -->
                <textarea class="col-12 form-control" rows="10" name="texto_capitulo" placeholder="Empiece a escribir..."></textarea>
                <br>

                <!-- BOTÓN GUARDAR -->
                <div class="row order-3 mb-3 ">
                    <div class="col d-flex justify-content-center">

                        <div class=" ">
                        <input class="btn-set-write mx-3 mt-4 px-5 " type="submit" value="Guardar" name="guardar">
                           
                        </div>

                        <!-- <div class="  ">                            
                            <input class="btn-editObra  mt-4  " type="submit" value="Guardar y Publicar" name="publicar">                            
                        </div> -->

                    </div>

                </div>
            </div>

            <!-- Columna 3-->
            <div class="col-12 col-md-3 order-sm-3 order-2 order-md-0 bg-light rounded">
                <div>
                    <h4 class="text-center mt-3 ">CAPÍTULOS</h4>
                    <hr>                   
                   
                    <!-- Lista Capítulos -->
                    <div class="mt-2  divlistcap">
                        <!-- <div class="mt-1 px-1 border ">
                            <h6>Título del capítulo</h6>
                            <p><small class="text-muted">Capítulo N°:</small></p>
                            <hr>
                        </div> -->

                        <div class="card" >
                            <div class="card-header">
                                Lista
                            </div>
                            <ul class="list-group list-group-flush" style="overflow-y:scroll; height:410px">
                            <?php

                                require_once("/xampp/htdocs/blogterplus/model/classes/consultaObras_model.php");
                                $consultaCaps= new Consulta();
                                $listaCaps=$consultaCaps->listarCapitulos($_SESSION["usuario_id"], $obraid);

                                if(count($listaCaps)>0){

                                    foreach($listaCaps as $cap){
                                        echo '
                                            <a href="updateCapView.php?cid=' . $cap["capitulo_id"] . '&usid=' .$cap["usuario_id"] . '&oid='
                                            .$cap["obra_id"] . '"> <li class="list-group-item">
                                                <h6>' . $cap["titulo_cap"] .'</h6>
                                                <small class="text-muted">Capítulo N°:'. $cap["numero_cap"] . '</small>
                                            </li> </a>';
                                    }
                                }else{
                                    echo '<li class="list-group-item text-center">
                                        <h6 class="">No hay capítulos disponibles</h6>
                                        <small class="text-muted">N° Capítulos: 0</small>
                                    </li> <hr>';
                                }
                            ?>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <!-- Crear nuevo -->
                    <!-- <div class="mt-4 border divnewcap">
                        <div class="mt-4 px-1">
                            <h5 class="text-center">Crear nuevo capítulo</h5>
                            <input class="form-control" placeholder="Nombre del capítulo" type="text">
                            <div class="d-flex justify-content-center">
                                <a class="btn-set-write my-3" style="padding:0 50px;" href="#"> Añadir</a>
                            </div>
                        </div>
                    </div> -->
                </div>

            </div>





        </form>
    </div>


    <!-- Footer -->
    <?php echo footer(); ?>

    <!-- Importamos los scripts de JS -->
    <script src="/view/js/jquery.js"></script>
    <script src="/view/js/popper.js"></script>
    <script src="/view/js/bootstrap.js"></script>
</body>

</html>