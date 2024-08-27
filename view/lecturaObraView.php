<?php
include("/xampp/htdocs/blogterplus/view/plantilla.php");
// session_start();
// if (!isset($_SESSION["usuario"])) {
//     header("location: /../index.php");
// }

$id_obra = $_GET["o"];

require_once("/xampp/htdocs/blogterplus/model/classes/consultaObras_model.php");
require_once("/xampp/htdocs/blogterplus/model/classes/users_model.php");
require_once("/xampp/htdocs/blogterplus/model/classes/comentarios_model.php");
require_once("/xampp/htdocs/blogterplus/model/classes/calificacionClass_model.php");
$consultaObras = new Consulta();
$consultaCaps = new Consulta();
$consultaAutor = new User();
$consultaSeg = new User();
$consultaComent = new Coment();
$consultaCal = new Calificacion();

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

    <?php
    session_start();
    if (isset($_SESSION["usuario"])) {
        echo navbarLogin();
    } else {
        echo navbarOpen();
    }
    ?>

    <div class="container mt-5">
        <div class="row">


            <?php

            $obraArr = $consultaObras->consultarObraPub($id_obra);

            foreach ($obraArr as $obra) {
                $titObra = $obra["titulo"];
                $genero = $obra["genero"];
                // $calificacion = $obra["calificacion"];
                $portada = $obra["portada"];
                $usuario_id = $obra["usuario_id"];
                $sinopsis = $obra["sinopsis"];
                $obra_id = $obra["obra_id"];
            }

            //Consultamos calificación Promedio


            $valorCal = $consultaCal->mostrarCal($id_obra);



            ?>

            <!-- Aside Izq -->
            <section class="col-3">
                <div class="col ">
                    <!-- Portada y Género -->
                    <div class="">
                        <a href="/view/lecturaObraView.php?o=<?php echo $id_obra ?>">
                            <div class="mt-5 d-flex justify-content-center  ">
                                <img class="border border-3 rounded w-75" src="/view/assets/portadas/<?php echo $portada ?>" alt="Foto_Portada">
                            </div>
                        </a>
                        <h6 class="text-center text-muted mt-1">Género: <?php echo $genero ?></h6>
                    </div>


                    <!-- DATOS AUTOR -->
                    <?php
                    $datosAut = $consultaAutor->datosUser($usuario_id);

                    foreach ($datosAut as $datos) {
                        $nombre = $datos["nombre"];
                        $apellido = $datos["apellido"];
                        $nickname = $datos["nickname"];
                        $foto = $datos["foto"];
                        $autor_id= $datos["usuario_id"];
                    }


                    ?>

                    <!-- Foto y Nombre de Autor -->
                    <div class="">
                        <a href="/view/perfilPublicView.php?autid=<?php echo $usuario_id ?>">
                            <div class="mt-5 d-flex justify-content-center  ">
                                <img class="rounded-circle  w-75" src="/view/assets/fotos_perfil/<?php echo $foto ?>" alt="Foto_Autor">
                            </div>
                        </a>
                        <h5 class="text-center"><?php echo $nombre . ' ' . $apellido ?></h5>
                        <h6 class="text-center"><?php echo $nickname ?></h6>
                    </div>

                    <!-- Botón Follow -->

                    <?php
                    if (isset($_SESSION["usuario"])) {                        
                    ?>
                    <form action="/model/seguir_model.php" method="post" class="mt-4 d-flex justify-content-center">                      

                        <!-- Id Autor -->
                        <input type="text" name="seguido" value="<?php echo $usuario_id ?>" hidden>
                        <!-- Id Obra -->
                        <input type="text" name="obra" value="<?php echo $id_obra ?>" hidden>
                        <!-- Id Usuario Actual -->
                        <input type="text" name="seguidor" value="<?php echo $_SESSION["usuario_id"] ?>" hidden>

                        <?php
                        //Verifico si el usuario ya está siguiendo al otro
                        $yaSeg1=[];
                        $yaSeg1 = $consultaSeg->verificarSeg($_SESSION["usuario_id"], $usuario_id);

                        if (count($yaSeg1) > 0) {
                            echo '<input class="btn-editObra" type="submit" Value="Dejar de seguir" name="seguir">';
                        } else {                            
                            echo '<input class="btn-set-write" type="submit" Value="+ Seguir al Autor" name="seguir"> ';
                        }
                        ?>
                    </form>
                    <?php }?>
            </section>

            <!-- Contenido -->
            <section class="col-6">

                <!-- Título Obra y Capítulo -->
                <div class="col d-flex justify-content-center">
                    <div class="mt-2">
                        <h1 class="d-flex justify-content-center"><?php echo $titObra ?></h1>
                        <h4 class="d-flex justify-content-center">Calificación: <?php echo $valorCal ?></h4>
                    </div>
                </div>

                <!-- Texto capítulo -->
                <hr>

                <h3 class="text-center mt-4">Sinopsis</h3> <br>
                <div class="d-flex justify-content-center text-center">
                    <p><?php echo $sinopsis ?> </p>
                </div>

                <hr>
                <!-- Comentarios -->
                <h3 class="text-muted">Comentarios</h3>
                <div class=" w-100 mt-2">

                    <div class="mt-2  divlistcap">
                        <div class="card">
                            <div class="card-header">
                                Lista
                            </div>
                            <ul class="list-group list-group-flush" style="overflow-y:scroll; max-height:200px">


                                <?php
                                $comentsArr = $consultaComent->mostrarComentObra($id_obra);

                                if (count($comentsArr) > 0) {

                                    foreach ($comentsArr as $coment) {


                                        echo '
                                    <li class="list-group-item d-flex">
                                        <div>
                                            <img class="me-3 rounded-circle" src="/view/assets/fotos_perfil/' . $coment["foto"] . '" height="50px" alt="">
                                        </div>
                                        <div>
                                        <a href="lecturaCapView.php?cid="><h6>' . $coment["nick"] . '</h6></a>
                                            <small class="text-muted">' . $coment["comentario"] . '</small>
                                        </div>

                                    </li>';
                                    }
                                } else {

                                    echo '
                                    <li class="list-group-item d-flex">                                        
                                        <div>
                                        <h6>No hay comentarios todavía</h6>                                           
                                        </div>

                                    </li>';
                                } ?>



                            </ul>
                        </div>
                    </div>






                    <!-- Formulario enviar comentario -->
                    <form action="/model/insertarComentObra_model.php" method="post">
                        <div class="">
                            <label for="exampleFormControlTextarea1">¡Da tu opinión!</label>

                            <?php

                            if (isset($_SESSION["usuario"])) {
                                $codUser = $_SESSION["usuario_id"];
                                $nicky = $_SESSION["usuario"];
                                $porty = $_SESSION["foto"];


                                echo
                                '<textarea name="contenido"class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <input type="text" name="usuario" value="' . $codUser . '" hidden>
                                    <input type="text" name="obra" value="' . $obra_id . '" hidden>
                                    <input type="text" name="nick" value="' . $nicky . '" hidden>
                                    <input type="text" name="foto" value="' . $porty . '" hidden>
                                    <div class="d-flex justify-content-end mt-2"> 
                                    <input  type="submit" name="comentar" value="Comentar">
                                    </div>';
                            } else {
                                echo '<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled> 
                                Debes iniciar sesión para comentar. </textarea>';
                            } ?>


                        </div>
                    </form>
                </div>
            </section>

            <!-- Aside Der -->
            <section class="col-3">
                <h4 class="text-center mt-3 ">CAPÍTULOS</h4>
                <hr>
                <!-- Lista Capítulos -->
                <div class="mt-2  divlistcap">
                    <div class="card">
                        <div class="card-header">
                            Lista
                        </div>
                        <ul class="list-group list-group-flush" style="overflow-y:scroll; height:410px">

                            <?php

                            $listaCaps = $consultaCaps->capsObra($id_obra);
                            foreach ($listaCaps as $cap) {
                                echo '
                                    <a href="lecturaCapView.php?cid=' . $cap["capitulo_id"] . '&o=' . $id_obra . '">
                                        <li class="list-group-item">
                                            <h6>' . $cap["titulo_cap"] . '</h6>
                                            <small class="text-muted">Capítulo N°:' . $cap["numero_cap"] . '</small>
                                        </li>
                                    </a>';
                            } ?>

                        </ul>
                    </div>
                </div>

                <!-- Calificación -->

                <div class="mt-4 bg-light">
                    <form class="" action="/model/calificar_model.php" method="post">
                        <div class="d-flex justify-content-center ">

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="nota" id="nota" value=1>
                                <label class="form-check-label" for="inlineRadio1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="nota" id="nota" value=2>
                                <label class="form-check-label" for="inlineRadioOptions">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="nota" id="nota" value=3>
                                <label class="form-check-label" for="inlineRadio3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="nota" id="nota" value=4>
                                <label class="form-check-label" for="inlineRadio3">4 </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="nota" id="nota" value=5 checked>
                                <label class="form-check-label" for="inlineRadio3">5</label>
                            </div>
                        </div>

                        <input type="text" name="obra_id" value="<?php echo $id_obra ?>" hidden>
                        <input type="text" name="usuario_id" value="<?php echo $codUser ?>" hidden>

                        <div class="d-flex justify-content-center mt-2">
                            <input type="submit" value="Calificar" name="calificar">
                        </div>
                    </form>


                </div>

            </section>

        </div>

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