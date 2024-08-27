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
    <title>Blogter+</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="/view/css/bootstrap.css">
    <!-- Iconos de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- CSS Propios -->
    <link rel="stylesheet" href="/view/css/main.css">
</head>

<body>

    <?php
    echo navbarLogin();
    ?>



    <main class="container">

        <div class="row">
            <div class="col">

                <!-- Botones Empezar obra y seguir escribiendo -->
                <!-- <div class="container my-5 ">
                    <div class="col  d-flex justify-content-center">
                        <div class="col-6  d-flex justify-content-evenly">
                            <a class="rounded btn-set-write" style="padding:20px 30px;" href="/view/creacionObraView.php">Empezar nueva obra </a>
                        </div>
                        <div class="col-6  d-flex justify-content-evenly">
                            <a class="rounded btn-set-write" style="padding:20px 30px;" href="/view/listaObrasView.php">Seguir escribiendo</a>
                        </div>
                    </div>
                </div> -->



                <!-- Carousel Géneros -->
                <section id="carouselGeneros" class="mt-4 carousel slide carousel_generos" data-bs-ride="carousel">

                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselGeneros" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselGeneros" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselGeneros" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>

                    <div class="carousel-inner">
                        <div class="carousel-item  active">
                            <img src="/view/assets/img/post3.jpeg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h1 class="text-light">EXPLOSIONES GALÁCTICAS</h1>
                                <h5> Perecer nunca había sido tan fácil </h5>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="/view/assets/portadas/portalog2.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h1 class="text-light">SINISTIERRA</h1>
                                <h5> Luchar o morir. La guerra por la supervivencia ha comenzado </h5>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="/view/assets/portadas/portalog3.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h1 class="text-light">DOS CASOS POR PESETA</h1>
                                <h5> La conspiración que te dejará con los pelos de punta. </h5>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselGeneros" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselGeneros" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>

                </section>


                

            </div>

    </main>

    <!-- Ultimas obras y capítulos -->

    <div class="container">
        <div class="row">
            <div class="">

            <hr><h2 class="text-center my-4"> ÚLTIMAS OBRAS </h2><hr>
                <div class="d-flex flex-wrap justify-content-center justify-content-lg-around">


                    <?php

                    require_once("/xampp/htdocs/blogterplus/model/classes/consultaObras_model.php");
                    $consultaObra = new Consulta();

                    // $datosObras = $consultaObra->consultarObras($_SESSION["usuario_id"]);
                    $datosObras = $consultaObra->consultarAllObras();


                    foreach ($datosObras as $elemento) {
                        $portada = $elemento["portada"];
                        $sinopsis = substr($elemento["sinopsis"], 0, 150);
                        $titulo = $elemento["titulo"];
                        $ultFecha = $elemento["fecha_actualizacion"];
                        $autor = $elemento["usuario_id"];
                        $obraid = $elemento["obra_id"];
                        $f_creacion = $elemento["fecha_creacion"];

                        echo '
                            <div class="card card-genero mx-2 mb-3 col-12 col-lg-6" style="max-width:540px;">
                            <a href="/view/lecturaObraView.php?o=' . $obraid . '"><div class="row g-0">
                                        <div class="col-md-4 d-flex align-items-center">
                                            <img style="max-height: 200px; max-width=200px;" src="/view/assets/portadas/' . $portada . '" class="img-fluid rounded-start" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">'  . $titulo . '</h5>
                                                <p class="card-text fst-italic">'  . $sinopsis . '(...) </p>
                                                <p class="card-text"><small class="text-muted">Última actualización: <br>' . $f_creacion . '</small>
                                                </p>
                                            </div>
                                        </div>
                                    </div></a>
                                </div>';
                    }

                    ?>



                </div>

                <hr>
                <h2 class="text-center mt-4"> ÚLTIMOS CAPÍTULOS </h2> 
                <hr>

                <?php

                // <!-- Caps -->

                //  LISTADO DE CAPÍTULOS

                $consultUltCaps = $consultaObra->ultCapsPublico();

                if (count($consultUltCaps) > 0) {

                    echo ' <div class="my-3">';

                    foreach ($consultUltCaps as $elementos) {

                        $titobra = $elementos["titulo_obra"];
                        $titCaps = $elementos["titulo_cap"];
                        $ultFechaCaps = $elementos["fecha_actualizacion"];
                        $numCap = $elementos["numero_cap"];
                        $id_cap = $elementos["capitulo_id"];
                        $oid = $elementos["obra_id"];
                        $contenido = substr($elementos["contenido"], 0, 200);

                        echo '<div class="my-4">

                            <a href="/view/lecturaCapView.php/?cid=' . $id_cap . '&o=' . $oid . '">
                            
                                    <div class="card">
                                    <h4 class="card-header">' . ucfirst($titobra) . '</h4>
                                    <div class="card-body">
                                    <h5 class="card-title">' . $titCaps . '</h5><br>
                                    <p class="card-text fst-italic"> "' . $contenido . '(...)"</p>                                  
                                    </div>
                                    <div class="card-footer">
                                    <p class="card-text"><small class="text-muted">Publicado: ' . $ultFechaCaps . '</small></p>
                                    </div>

                                </div>
                                
                                </a>

                                

                                    </div>';
                    }
                    echo '</div>';
                }

                ?>

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