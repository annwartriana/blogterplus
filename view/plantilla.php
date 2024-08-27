<?php

function navbarOpen()
{
?>
    <!-- HEADER -->
    <header>

        <div class="container-xxl">

            <!-- Barra Navegación  -->
            <nav class="row navbar navbar-expand-md navbar-light">

                <!-- LOGO -->
                <a href="/view/loginView.php" class="navbar-brand col-2 ms-5">
                    <img class="ms-5" src="/view/assets/img/BlogterlogoPNG_peq.png" alt="Logo_Blogter+">
                </a>

                <!-- Botón reemplaza nabvar dispositivos móviles -->
                <button class="navbar-toggler mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>



                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Input Búscar -->
                    <!-- <form class="d-flex col-8 col-md-4 me-sm-4 me-md-3 me-lg-5 ">
                        <input class="form-control me-2 " type="search" placeholder="Buscar" aria-label="Search">
                        <button class="btn btn-outline-success" id="boton_buscar" type="submit">Buscar</button>
                    </form> -->

                    <!-- Menú Desplegable Géneros -->
                    <ul class="navbar-nav col-2 ms-5 me-md-3 me-lg-3 row">
                        <li class="nav-item dropdown">
                            <div class="btn-group">
                                <a class="nav-link active fw-bold" href="/view/generosView.php">GÉNERO</a>
                                <a class="nav-link dropdown-toggle dropdown-toggle-split fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> </a>



                                <ul class="dropdown-menu colk" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="/view/generosBusqView.php?gen=Acción">Acción</a></li>
                                    <li><a class="dropdown-item" href="/view/generosBusqView.php?gen=Aventura">Aventura</a></li>
                                    <li><a class="dropdown-item" href="/view/generosBusqView.php?gen=Drama">Drama</a></li>
                                    <li><a class="dropdown-item" href="/view/generosBusqView.php?gen=Erótico">Erótico</a></li>
                                    <li><a class="dropdown-item" href="/view/generosBusqView.php?gen=Espiritual">Espiritual</a></li>
                                    <li><a class="dropdown-item" href="/view/generosBusqView.php?gen=Fantasía">Fantasía</a></li>
                                    <li><a class="dropdown-item" href="/view/generosBusqView.php?gen=Misterio">Misterio</a></li>
                                    <li><a class="dropdown-item" href="/view/generosBusqView.php?gen=Romance">Romance</a></li>
                                    <li><a class="dropdown-item" href="/view/generosBusqView.php?gen=Thriller">Thriller</a></li>
                                    <li><a class="dropdown-item" href="/view/generosBusqView.php?gen=Sci-Fi">Sci-Fi</a></li>
                                    <li><a class="dropdown-item" href="/view/generosBusqView.php?gen=Terror">Terror</a></li>
                                    <li><a class="dropdown-item" href="/view/generosBusqView.php?gen=Otro">Otro</a></li>
                                </ul>
                            </div>
                        </li>


                    </ul>



                    <!-- SIGN IN y SIGN UP -->
                    <div class="row mb-2 mb-lg-0 col-6">
                        <ul class="navbar-nav text-center">
                            <!-- SignIN INICIO DE SESIÓN-->
                            <li class="col-12 col-md-6 nav-item">
                                <!-- Enlace Trigger Modal -->
                                <a class="nav-link active fw-bold btn-set-write" style="color:white;" aria-current="page" href="#sign_in" role="button" data-bs-toggle="modal" data-bs-target="#sign_in">INICIO DE SESIÓN</a>
                            </li>

                            <!-- Modal -->
                            <div class="modal fade" id="sign_in" tabindex="-1" aria-labelledby="sign_in" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <img src="/view/assets/img/BlogterlogoPNG_peq.png" alt="">

                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body row">
                                            <form class="" action="/model/sign_in.php" method="POST">
                                                <div style="color:red;">
                                                    <?php
                                                    if (!empty($_GET["error2"])) {
                                                        echo ($_GET["error2"]);
                                                    }
                                                    ?>
                                                </div>
                                                <input class="form-control" type="email" placeholder="Correo Electrónico" aria-label="Correo Electrónico" name="email">
                                                <br>
                                                <input class="form-control" type="password" placeholder="Contraseña" aria-label="Contraseña" name="password">
                                                <br>
                                                <input type="submit" class="btn-signIn" value="Ingresar" name="ingresar">
                                            </form>

                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                            <button type="button" class="btn btn-signUp" data-bs-toggle="modal" data-bs-target="#sign_up">
                                                Crear cuenta nueva
                                            </button>
                                            <!-- <a  class="btn-signUp" href="../view/registroView.php">Crear cuenta nueva</a> -->
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- SignUP REGISTRO DE NUEVA CUENTA -->
                            <li class="col-12 col-md-6 nav-item ms-sm-5 text-center">
                                <a class="nav-link active btn-set-write fw-bold" style="color:white;" aria-current="page" href="#sign_up" role="button" data-bs-toggle="modal" data-bs-target="#sign_up">REGISTRARTE</a>
                            </li>

                            <!-- Modal -->
                            <div class="modal fade " id="sign_up" tabindex="-1" aria-labelledby="sign_up" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="">Registrarte</h4>

                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body row">
                                            <div style="color:red;">
                                                <?php
                                                if (!empty($_GET["error"])) {
                                                    echo ($_GET["error"]);
                                                }
                                                ?>
                                            </div>
                                            <form class="" action="/model/registro.php" method="POST">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="Nombre" name="nombre_form" required>
                                                    <input type="text" class="form-control" placeholder="Apellido" name="apellido_form" required>
                                                    <br>
                                                </div>


                                                <input class="form-control" type="email" placeholder="Correo Electrónico" aria-label="Correo Electrónico" name="email_form" required>
                                                <br>
                                                <input class="form-control" type="password" placeholder="Contraseña" aria-label="Contraseña" name="password_form" required>
                                                <br>
                                                <input class="form-control" type="password" placeholder="Repetir contraseña" aria-label="Contraseña" name="password_form_repeat" required>
                                                <br>
                                                <input type="text" class="form-control" placeholder="Nickname" name="nickname_form" required>
                                                <br>

                                                <div class="input-group divFechaNacimiento mb-3 ">
                                                    <span class="input-group-text" id="">Fecha de Nacimiento</span>
                                                    <input class="form-control" type="date" name="fecha_nacimiento" id="fecha_nacimiento" required>
                                                </div>

                                                <div class="input-group mb-3">
                                                    <label class="input-group-text" for="sexo_form" required>Sexo Biológico</label>
                                                    <select class="form-select" id="sexo_form" name="sexo_form">
                                                        <option selected>Elige...</option>
                                                        <option value="hombre">Hombre</option>
                                                        <option value="mujer">Mujer</option>
                                                    </select>
                                                </div>

                                                <div class="col-12 form_terminos mb-4">
                                                    <p style="font-size: 0.8rem; text-align: center;" class="">Al hacer clic en
                                                        Registrarte, aceptas las Condiciones, la Política de datos y la política de cookies: <a style="font-size: 0.7rem;" href="#">Términos y Condiciones</a></p>
                                                </div>
                                                <input type="submit" class="btn-signUp2" value="Registrarse" id="registrar" name="registrar">
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </ul>
                    </div>

                </div>

            </nav>

        </div>

    </header>
<?php } ?>

<?php

function navbarLogin()
{
?>
    <!-- HEADER -->
    <header>

        <div class="container">

            <!-- Barra Navegación  -->
            <nav class="row navbar navbar-expand-md navbar-light mb-3">

                <!-- LOGO -->
                <a href="../index.php" class="navbar-brand col-1">

                    <img src="/view/assets/img/BlogterlogoPNG_peq.png" alt="Logo_Blogter+">
                </a>

                <!-- Botón reemplaza nabvar dispositivos móviles -->
                <button class="navbar-toggler mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Input Búscar -->
                    <!-- <form class="d-flex col-8 col-md-4 me-sm-4 me-md-3 me-lg-5 ">
                        <input class="form-control me-2 " type="search" placeholder="Buscar" aria-label="Search">
                        <button class="btn btn-outline-success" id="boton_buscar" type="submit">Buscar</button>
                    </form> -->

                    <!-- Menú Desplegable Géneros -->
                    <ul class="navbar-nav col-2 ms-md-5 me-5 row">
                        <li class="nav-item dropdown">
                            <div class="btn-group ">
                                <a class="nav-link active fw-bold " href="/view/generosView.php">GÉNERO</a>
                                <a class="nav-link dropdown-toggle dropdown-toggle-split fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> </a>



                               <ul class="dropdown-menu colk" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="/view/generosBusqView.php?gen=Acción">Acción</a></li>
                                    <li><a class="dropdown-item" href="/view/generosBusqView.php?gen=Aventura">Aventura</a></li>
                                    <li><a class="dropdown-item" href="/view/generosBusqView.php?gen=Drama">Drama</a></li>
                                    <li><a class="dropdown-item" href="/view/generosBusqView.php?gen=Erótico">Erótico</a></li>
                                    <li><a class="dropdown-item" href="/view/generosBusqView.php?gen=Espiritual">Espiritual</a></li>
                                    <li><a class="dropdown-item" href="/view/generosBusqView.php?gen=Fantasía">Fantasía</a></li>
                                    <li><a class="dropdown-item" href="/view/generosBusqView.php?gen=Misterio">Misterio</a></li>
                                    <li><a class="dropdown-item" href="/view/generosBusqView.php?gen=Romance">Romance</a></li>
                                    <li><a class="dropdown-item" href="/view/generosBusqView.php?gen=Thriller">Thriller</a></li>
                                    <li><a class="dropdown-item" href="/view/generosBusqView.php?gen=Sci-Fi">Sci-Fi</a></li>
                                    <li><a class="dropdown-item" href="/view/generosBusqView.php?gen=Terror">Terror</a></li>
                                    <li><a class="dropdown-item" href="/view/generosBusqView.php?gen=Otro">Otro</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>

                    <!-- Empezar a Escribir -->
                    <div class="row mb-2 mb-lg-0">
                        <ul class="navbar-nav ">
                            <!-- Iniciar obra-->
                            <li class="mt-3 mt-md-0">

                                <a href="/view/creacionObraView.php" class="nav-link active fw-bold btn-set-write" style="color:white;" href="#sign_in" role="button">EMPEZAR NUEVA OBRA</a>
                            </li>
                            <li class="mt-3 mt-md-0 ms-md-4">

                                <a href="/view/listaObrasView.php" class="nav-link active fw-bold btn-set-write" style="color:white;" href="#sign_in" role="button">SEGUIR ESCRIBIENDO</a>
                            </li>

                            <!-- LOGOUT -->
                            <li class="nav-item  mx-md-4 mt-3 mt-md-0 text-center">
                                <a class="nav-link active fw-bold btn-set-write" style="color:white;" aria-current="page" href="/view/login_out.php" role="button">LOGOUT</a>
                            </li>
                        </ul>
                    </div>

                    <!-- USUARIO y LOGOUT -->
                    <div class="row mb-2 mb-lg-0 ms-md-4 btn-perfil rounded"  >
                        <div class=" text-center d-flex  ">
                            <div>
                                <a href="perfilPersonalView.php">  <img class="rounded-circle mt-1" src="assets/fotos_perfil/<?php echo $_SESSION['foto']?>" width=30 alt=""></a>
                            </div>
                            <div class=" ">
                                <a class="nav-link  fw-bold " style="color:white;" aria-current="page" href="perfilPersonalView.php" role="button"> <?php echo strtoupper($_SESSION["usuario"]); ?></a>
                            </div>

                        </div>
                        <!-- USUARIO-->






                        </ul>
                    </div>



                </div>

            </nav>

        </div>

        <div>




        </div>
    </header>
<?php } ?>

<?php


function footer()
{ ?>
    <!-- FOOTER -->
    <footer class="row bg-light d-flex mt-md-5 mb-3">

        <!-- Redes Sociales -->
        <div class="footer_icons text-center mt-3">
            <a href="#" class="text-white me-1">
                <i class="bi-facebook"></i>
            </a>
            <a href="#" class="text-white me-1">
                <i class="bi-twitter"></i>
            </a>
            <a href="#" class="text-white me-1">
                <i class="bi-instagram"></i>
            </a>
            <a href="#" class="text-white">
                <i class="bi-youtube"></i>
            </a>
        </div>

        <!-- Enlaces -->
        <div class="footer_enlaces">

            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a href="#" class="nav-link">Acerca de</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Opiniones</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">Contacto</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link ">Términos</a>
                </li>
            </ul>
        </div>
    </footer>


    </div>
<?php } ?>
