<?php
include("/xampp/htdocs/blogterplus/view/plantilla.php");
session_start();
if (!isset($_SESSION["usuario"])) {
    header("location: /../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogter+ Perfil</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="/view/css/bootstrap.css">
    <!-- Iconos de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- CSS Propios -->
    <link rel="stylesheet" href="/view/css/main.css">
</head>

<body>
    <!--Barra de Navegación  -->
    <?php echo navbarLogin();

    require_once("/xampp/htdocs/blogterplus/model/classes/users_model.php");

    $perfil = new User();

    $datosUser = $perfil->datosUser($_SESSION["usuario_id"]);


    foreach ($datosUser as $elemento) {
        $nombre = $elemento["nombre"];
        $apellido = $elemento["apellido"];
        $nickname = $elemento["nickname"];
        $foto = $elemento["foto"];
        $password=$elemento["password"];
        $email=$elemento["email"];
        $cumple=$elemento["birthday"];
        

    } ?>

    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-center">
                <!-- Aside -->
                <section class="col-md-9 ">
                    <form class="" action="../model/actualizarDatos_model.php" method="POST" enctype="multipart/form-data">

                        <!-- FOTO -->
                        <div class="order-0 bg-light rounded">
                            <div class="text-center pt-3">
                                <h3>@<?php echo $nickname ?></h3>
                            </div>

                            <div class="d-flex justify-content-center">
                                <img class="rounded-circle my-4" height="200px" src="/view/assets/fotos_perfil/<?php echo $foto ?>" alt="Foto Perfil">
                            </div>

                            <div class="d-flex justify-content-center ">
                                <label class="text-center">Elejir una nueva foto:</label>
                            </div>
                            <div class="col-6 col-md-12 mb-4 mx-auto d-flex justify-content-center ">
                                <input type="hidden" name="MAX_TAM" value="6000000">
                                <input class="" style="font-size:10px" type="file" id="subirImagen" name="subirImagen" value="">
                            </div>
                            <!-- d-flex justify-content-center pb-5 -->
                            <hr>

                            <div style="color:red;">
                                <?php
                                if (!empty($_GET["error"])) {
                                    echo ($_GET["error"]);
                                }
                            ?>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="<?php echo $nombre ?>" placeholder="Nombre" name="nombre_form">
                                <input type="text" class="form-control" value="<?php echo $apellido ?>" placeholder="Apellido" name="apellido_form">
                                <br>
                            </div>


                           
                        
                            <input class="form-control" type="password" placeholder="Nueva Contraseña" aria-label="Contraseña" name="password_form" required>
                            <br>
                            <input class="form-control" type="password" placeholder="Repetir contraseña" aria-label="Contraseña" name="password_form_repeat" required>

                            <br>

                            <div class="input-group divFechaNacimiento mb-5 ">
                                <span class="input-group-text" id="">Fecha de Nacimiento</span>
                                <input class="form-control" type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $cumple?>" required>
                            </div>

                            <div class=" d-flex justify-content-center">
                                <input type="submit" class="btn-signUp2" value="Actualizar Datos" name="actualizar">

                                <a class="btn-del ms-5 pt-2" href="javascript:history.back()"> Cancelar</a>
                            </div>


                    </form>
                </section>

            </div>


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