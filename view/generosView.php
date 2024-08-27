<?php
include("plantilla.php");
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogter+</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="/view/css/bootstrap.css">
    <!-- Iconos de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- CSS Propios -->
    <link rel="stylesheet" href="/view/css/main.css">
</head>

<body>

    <!-- HEADER -->
    <?php 
    if (isset($_SESSION["usuario"])) {
        echo navbarLogin();
    }else{
        echo navbarOpen();
    } ?>

    <main class="container mt-4">

        <div class="row">
            <div class="col">

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


                <!-- Géneros -->
                <section class="mt-3">

                    <div class="grid_generos">
                        <ul class="d-flex flex-wrap">
                            <li><a href="generosBusqView.php?gen=Acción" class="btn btn-primary ms-1">Acción </a></li>
                            <li><a href="generosBusqView.php?gen=Aventura" class="btn btn-primary ms-1">Aventura</a></li>
                            <li><a href="generosBusqView.php?gen=Drama" class="btn btn-primary ms-1">Drama</a></li>
                            <li><a href="generosBusqView.php?gen=Erótico" class="btn btn-primary ms-1">Erótico</a></li>
                            <li><a href="generosBusqView.php?gen=Espiritual" class="btn btn-primary ms-1">Espiritual</a></li>
                            <li><a href="generosBusqView.php?gen=Fantasía" class="btn btn-primary ms-1">Fantasía</a></li>
                            <li><a href="generosBusqView.php?gen=Misterio" class="btn btn-primary ms-1">Misterio</a></li>
                            <li><a href="generosBusqView.php?gen=Romance" class="btn btn-primary ms-1">Romance</a></li>
                            <li><a href="generosBusqView.php?gen=Thriller" class="btn btn-primary ms-1">Thriller</a></li>
                            <li><a href="generosBusqView.php?gen=Sci-Fi" class="btn btn-primary ms-1">Sci-Fi </a></li>
                            <li><a href="generosBusqView.php?gen=Terror" class="btn btn-primary ms-1">Terror</a></li>
                            <li><a href="generosBusqView.php?gen=Otro" class="btn btn-primary ms-1">Otro</a></li>
                        </ul>
                    </div>

                    <div-container>
                        <div class="row">
                            <div class="">

                                <hr><h2 class="text-center my-4">ÚLTIMAS OBRAS</h2><hr>
                                <div class="d-flex flex-wrap justify-content-center justify-content-lg-around mt-4">


                                    <?php

                                    require_once("/xampp/htdocs/blogterplus/model/classes/consultaObras_model.php");
                                    $consultaObra = new Consulta();

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
                            </div>
                    </div-container>

                    <!-- <div class="mt-5 ">

                        <h2 class="mb-4">Género Seleccionado </h2>

                        <div class="d-flex flex-wrap justify-content-center justify-content-lg-around">

                            <div class="card card-genero mx-2 mb-3 col-12 col-lg-6" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="/view/assets/img/post1.jpeg" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">Título de la Obra</h5>
                                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing
                                                elit. Aliquid non voluptates reprehenderit, ipsa sed consequatur commodi
                                                cumque. Vero, hic non.
                                            </p>
                                            <p class="card-text"><small class="text-muted">Last updated 3 days
                                                    ago</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-genero mx-2 mb-3 col-12 col-lg-6" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="/view/assets/img/post2.png" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">Título de la Obra</h5>
                                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing
                                                elit. Aliquid non voluptates reprehenderit, ipsa sed consequatur commodi
                                                cumque. Vero, hic non.
                                            </p>
                                            <p class="card-text"><small class="text-muted">Last updated 3 days
                                                    ago</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-genero mx-2 mb-3 col-12 col-lg-6" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="/view/assets/img/post3.jpeg" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">Título de la Obra</h5>
                                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing
                                                elit. Aliquid non voluptates reprehenderit, ipsa sed consequatur commodi
                                                cumque. Vero, hic non.
                                            </p>
                                            <p class="card-text"><small class="text-muted">Last updated 3 days
                                                    ago</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-genero mx-2 mb-3 col-12 col-lg-6" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="/view/assets/img/post4.jpeg" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">Título de la Obra</h5>
                                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing
                                                elit. Aliquid non voluptates reprehenderit, ipsa sed consequatur commodi
                                                cumque. Vero, hic non.
                                            </p>
                                            <p class="card-text"><small class="text-muted">Last updated 3 days
                                                    ago</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-genero mx-2 mb-3 col-12 col-lg-6" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="/view/assets/img/post5.jpg" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">Título de la Obra</h5>
                                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing
                                                elit. Aliquid non voluptates reprehenderit, ipsa sed consequatur commodi
                                                cumque. Vero, hic non.
                                            </p>
                                            <p class="card-text"><small class="text-muted">Last updated 3 days
                                                    ago</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-genero mx-2 mb-3 col-12 col-lg-6" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="/view/assets/img/post6.jpg" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">Título de la Obra</h5>
                                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing
                                                elit. Aliquid non voluptates reprehenderit, ipsa sed consequatur commodi
                                                cumque. Vero, hic non.
                                            </p>
                                            <p class="card-text"><small class="text-muted">Last updated 3 days
                                                    ago</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>



                    </div> -->

                </section>





            </div>
        </div>
    </main>


    <?php echo footer(); ?>


    </div>


    <!-- Importamos los scripts de JS -->
    <script src="/view/js/jquery.js"></script>
    <script src="/view/js/popper.js"></script>
    <script src="/view/js/bootstrap.js"></script>
</body>

</html>