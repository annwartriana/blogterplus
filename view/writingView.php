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

        <form class="row mx-md-5" action="/model/insertarCapitulo_model.php" method="post" enctype="multipart/form-data" name="formCapitulo">
            <!-- Columna 1-->
            <div class="col-6 col-md-3 order-sm-1 order-md-0 prueba">
                <div>
                    <img class="" src="/view/assets/img/post1.jpeg" height="350" width="100%" alt="">
                    <p class="mt-3" style="text-align:center;" for="#subirImagen"> Cambiar portada</p>
                    <div>
                    <input type="hidden" name="MAX_TAM" value="5000000"> 
                    <input class="mb-4" style="font-size:10px" type="file" id="subirImagen" name="subirImagen" value="">
                    </div>
                </div>
                <div class="row">
                    <!-- <a class="btn-set-write col-7 my-1 mx-auto" href="">Settings</a> -->
                    <input class="btn-set-write col-7 mt-4 mx-auto " type="submit" value="Guardar" name="guardar">
                    <a class="btn-set-write col-10  my-3 mx-auto" href="">Publicar</a>
                    <!-- <input class="btn-set-write col-10  my-3 mx-auto" type="submit" value="Publicar" name="publicar"> -->
                   
                </div>
            </div>
            <!-- Columna 2 Zona de Escritura-->
            <div class="col-12 col-md-6 order-sm-2 order-md-0 prueba">

                <!-- <label class="col-12 form-control" name="titulo_obra" for="">Título de la obra</label>       -->
                <input class="col-12 form-control" type="text" class="form-control" 
                style="font-size:2em;" placeholder="Título de la Obra" name="titulo_obra" required value="Sín título"> <br>
                
                <input class="col-12 form-control" type="text" class="form-control" 
                placeholder="Título del capítulo" name="titulo_cap" required value="Capítulo sin título"><br>

                <textarea class="col-12 form-control" rows="20" name="contenidoCap" placeholder="Empiece a escribir..."></textarea>

            </div>

            <!-- Columna 3 -->
            <div class="col-6 col-md-3 order-sm-1 order-md-0 prueba">
                <div class="row prueba">
                    <h2 class="col-12 mt-2" style="text-align:center;" for="">CAPÍTULOS</h2>
                    

                    <div class="col-12 mt-4">
                        <h4 style="text-align:center;">Crear nuevo capítulo</h4>

                        <input type="text" class="form-control mt-4" style="font-size:12px;text-align:center;" 
                        placeholder="Ingrese nombre del capítulo" name="nombre_cap" required>

                        <input type="button" value="Añadir nuevo capítulo" class= "col-12 mt-4 btn-cap">

                    </div>

                    <div id="lista_capitulos" class="col-12 mt-4">
                        <label name="cap1" for=""> Capítulo 1</label>
                    </div>
                </div>
            </div>

        </form>





    </div>

    <!-- Importamos los scripts de JS -->
    <script src="/view/js/jquery.js"></script>
    <script src="/view/js/popper.js"></script>
    <script src="/view/js/bootstrap.js"></script>
</body>

</html>