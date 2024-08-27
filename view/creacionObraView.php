<?php
include("/xampp/htdocs/blogterplus/view/plantilla.php");
session_start();
if (!isset($_SESSION["usuario"])) {
    header("location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogter+ Escribir</title>
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

    <div class="container mt-5">

        <form class="row mx-md-5" action="/model/insertarObra_model.php" method="post" enctype="multipart/form-data" name="formObra">
            <!-- Columna 1-->
            <div class="col-12 col-md-3 order-sm-3 order-2 order-md-0 ">
                <div>
                    <h5 class="my-3" style="text-align:center;">PORTADA</h5>
                    <img class="mb-1 mb-md-4" src="/view/assets/img/post1.jpeg" height="350" width="100%" alt="">
                    <p class="mt-3" style="text-align:center;" for="#subirImagen"> Cambiar portada</p>
                    <div class="col-6 col-md-12 mb-4 mx-auto ">
                        <input type="hidden" name="MAX_TAM" value="5000000">
                        <input class="" style="font-size:10px" type="file" id="subirImagen" name="subirImagen" value="">
                    </div>
                </div>

            </div>
            <!-- Columna 2 -->
            <div class="col-12 col-md-8 order-sm-2 order-1 order-md-0 ">

                <!-- TÍTULO OBRA -->
                <h3 class="mb-4" style="text-align:center;">DESCRIPCIÓN DE LA OBRA </h3>
                <input class="col-12 form-control" type="text" class="form-control" style="font-size:2em;" placeholder="Título de la obra" name="titulo_obra" required> <br>
                <!-- SINOPSIS -->
                <label for="">Sinopsis</label>
                <textarea class="col-12 form-control" rows="10" name="sinopsis" placeholder="Empiece a escribir..."></textarea>
                <br>
                <!-- GÉNERO -->
                <div class="row">
                    <h4 style="text-align:center;"class="mb-2">Género</h4>
                    <br>
                    
                    <div class="col-6 col-md-12" require>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Acción">
                            <label class="form-check-label" for="inlineRadio1">Acción</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="Aventura">
                            <label class="form-check-label" for="inlineRadio2">Aventura</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="Drama">
                            <label class="form-check-label" for="inlineRadio3">Drama </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="Erótico">
                            <label class="form-check-label" for="inlineRadio3">Erótico </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio5" value="Espiritual">
                            <label class="form-check-label" for="inlineRadio5">Espiritual </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio6" value="Fantasía">
                            <label class="form-check-label" for="inlineRadio5">Fantasía </label>
                        </div>
                    </div>

                    <!-- 6-12 OPCIONES -->
                    <div class="col-6 col-md-12">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio7" value="Misterio">
                            <label class="form-check-label" for="inlineRadio1">Misterio</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio8" value="Romance">
                            <label class="form-check-label" for="inlineRadio2">Romance</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio9" value="Thriller">
                            <label class="form-check-label" for="inlineRadio3">Thriller </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio10" value="Sci-Fi">
                            <label class="form-check-label" for="inlineRadio3">Sci-Fi </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio11" value="Terror">
                            <label class="form-check-label" for="inlineRadio5">Terror </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio12" value="Otro" checked>
                            <label class="form-check-label" for="inlineRadio5">Otro </label>
                        </div>
                    </div>
                </div>

                <br>

            </div>
            <div class="row order-3 mb-3">
            <div class="col-8 col-md-3 "></div>
                <div class="col-4  mx-auto ">
                    <!-- <a class="btn-set-write col-7 my-1 mx-auto" href="">Settings</a> -->
                    <input class="btn-set-write col-7 mt-4 mx-auto " type="submit" value="Guardar" name="guardar">
                    <!-- <a class="btn-set-write col-10  my-3 mx-auto" href="">Publicar</a> -->
                    <!-- <input class="btn-set-write col-10  my-3 mx-auto" type="submit" value="Publicar" name="publicar"> -->
                </div>

            </div>



        </form>

        

    </div>

    <?php echo footer(); ?>

    <!-- Importamos los scripts de JS -->
    <script src="/view/js/jquery.js"></script>
    <script src="/view/js/popper.js"></script>
    <script src="/view/js/bootstrap.js"></script>
</body>

</html>