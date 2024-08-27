<?php
include("/xampp/htdocs/blogterplus/view/plantilla.php");
session_start();
if (!isset($_SESSION["usuario"])) {
    header("location: /../index.php");
}

$autor = $_GET["autid"];

require_once("/xampp/htdocs/blogterplus/model/classes/users_model.php");


$perfil = new User();
$datosUser = $perfil->datosUser($autor);   
$consultaSeguidores = new User();
$consultaSeguidos = new User();

$consultaSeguidores2 = new User();
$consultaSeguidos2 = new User();

$consultaSeguidores3 = new User();
$consultaSeguidos3 = new User();



    foreach ($datosUser as $elemento) {
        $nombre = $elemento["nombre"];
        $apellido = $elemento["apellido"];
        $nickname = $elemento["nickname"];
        $foto = $elemento["foto"];
        $id = $elemento["usuario_id"];
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
    <?php echo navbarLogin();

    require_once("/xampp/htdocs/blogterplus/model/classes/consultaObras_model.php");

    $consultaObra = new Consulta();


    //     $datosCap = $consultaObra->mostrarCapitulo($id_obra, $id_cap);

    //     foreach ($datosCap as $elemento) {
    //         $tituloCap = $elemento["titulo_cap"];
    //         $numCap = $elemento["numero_cap"];
    //         $conteCap = $elemento["contenido"];
    //         $publicado = $elemento["publicado"];
    //         $cap_id=$elemento["capitulo_id"];
    // }

    ?>



    <div class="container-xxl">

        <div class="">

            <div class="row">

                <!-- Aside -->
                <section class="col-12 col-md-3 mx-1">

                    <!-- FOTO -->
                    <div class="order-0 bg-light rounded">
                        <div class="d-flex justify-content-center">
                            <img class="rounded-circle my-4" height="200px" src="/view/assets/fotos_perfil/<?php echo $foto ?>" alt="Foto Perfil">
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="text-center">
                                <h5><?php echo $nombre . " " . $apellido ?></h5>
                                <h6>@<?php echo $nickname ?></h6>
                            </div>
                        </div>
                    </div>
                    <!-- Datos 1 -->
                    <div class="order-0 mt-3 mt-md-0 col-12">
                        <div class="mt-4" style="width: 18rem;">

                            <a href="seguidores" class=" " role="button" data-bs-toggle="modal" data-bs-target="#seguidores">
                                <div class="input-group mb-3 d-flex justify-content-center">
                                    <span class="input-group-text fw-bold" id="basic-addon1 " style="color:white; background-color:#1aa3ac;">Seguidores:</span>
                                    <span class="input-group-text" id="basic-addon1"><?php echo ($consultaSeguidores->numSeguidores($id)); ?></span>
                                </div>
                            </a>
                            <!-- Modal Seguidores -->
                            <div class="modal fade" id="seguidores" tabindex="-1" aria-labelledby="seguidoresLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="">Seguidores</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="list-group" style="overflow-y:scroll;">

                                                <?php

                                                $arrayIdSeguidores = array();

                                                //Obtengo lista de seguidores por id
                                                $arrayIdSeguidores = $consultaSeguidores2->listSeguidoresId($id);

                                                //Almaceno todos los datos de los usuarios:
                                                if (count($arrayIdSeguidores) > 0) {

                                                    foreach ($arrayIdSeguidores as $seguidor) {
                                                        $datosUsuarios = $consultaSeguidores2->datosUser($seguidor);
                                                    }

                                                    foreach ($datosUsuarios as $persona) {
                                                        $fotoSeguidor = $persona["foto"];
                                                        $nickSeguidor = $persona["nickname"];
                                                        echo '
                                                            <div>                                                            
                                                            <li class="list-group-item">
                                                            <img src="/view/assets/fotos_perfil/' . $fotoSeguidor . '" alt="Foto_Seguidor" height="50px">
                                                            <span>' . $nickSeguidor . '</span>
                                                            </li>
                                                            </div>';
                                                    }
                                                } else {

                                                    echo '<div><li class="list-group-item">Aún no tiene seguidores.</li> </div>';
                                                }

                                                ?>

                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="#seguidos" class=" " role="button" data-bs-toggle="modal" data-bs-target="#seguidos">
                                <div class="input-group mb-3 d-flex justify-content-center">
                                    <span class="input-group-text fw-bold" id="basic-addon1" style="color:white;background-color:#1aa3ac;">Seguidos:</span>
                                    <span class="input-group-text" id="basic-addon1"><?php echo ($consultaSeguidos->numSeguidos($id)); ?></span>
                                </div>
                            </a>

                            <!-- Modal Seguidos -->
                            <div class="modal fade" id="seguidos" tabindex="-1" aria-labelledby="seguidosLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="">Seguidos</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="list-group" style="overflow-y:scroll;">

                                                <?php

                                                $arrayIdSeguidores = array();

                                                //Obtengo lista de seguidores por id
                                                $arrayIdSeguidores = $consultaSeguidos2->listSeguidosId($id);

                                                //Almaceno todos los datos de los usuarios:
                                                if (count($arrayIdSeguidores) > 0) {

                                                    foreach ($arrayIdSeguidores as $seguidor) {
                                                        $datosUsuarios = $consultaSeguidos2->datosUser($seguidor);
                                                    }

                                                    foreach ($datosUsuarios as $persona) {
                                                        $fotoSeguidor = $persona["foto"];
                                                        $nickSeguidor = $persona["nickname"];
                                                        echo '
                                                            <div>                                                            
                                                            <li class="list-group-item">
                                                            <img src="/view/assets/fotos_perfil/' . $fotoSeguidor . '" alt="Foto_Seguidor" height="50px">
                                                            <span>' . $nickSeguidor . '</span>
                                                            </li>
                                                            </div>';
                                                    }
                                                } else {

                                                    echo '<div><li class="list-group-item">Aún no sigue a nadie. </li> </div>';
                                                }

                                                ?>

                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <!-- Datos Personales -->
                    <!-- <div class="my-4">
                        <div class="card mx-auto  bg-dark" style="width: 18rem;">
                            <div class="card-header text-white">
                                Acerca de mí:
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">An item <br>
                                    <small class="text-muted"> Prueba</small>
                                </li>
                                <li class="list-group-item">An item <br>
                                    <small class="text-muted"> Prueba</small>
                                </li>
                                <li class="list-group-item">An item <br>
                                    <small class="text-muted"> Prueba</small>
                                </li>
                            </ul>
                        </div>

                    </div> -->

                </section>

                <!-- Desk -->
                <section class="col-12 col-md-7">
                    <!-- Portada -->
                    <div>
                        <div class="col-12">
                            <img width="100%" src="/view/assets/port_perfil/set.jpg" alt="">
                        </div>
                    </div>
                    <!-- OBRAS Y CAPS -->
                    <div class="col-12">
                        <!-- Obras -->
                        <div class="my-3">

                            <?php

                            $datosObras = $consultaObra->consultarObras($autor);
                            $contadorElementos = 0;
                            if (count($datosObras) > 0) {


                                echo '<h2>Últimas obras...</h2> 
                                
                                <div class="card-group">';

                                foreach ($datosObras as $elemento) {

                                    if ($contadorElementos < 4) {
                                        $portada = $elemento["portada"];
                                        $sinopsis = $elemento["sinopsis"];
                                        $titulo = $elemento["titulo"];
                                        $ultFecha = $elemento["fecha_actualizacion"];
                                        $autor = $elemento["usuario_id"];
                                        $obraid = $elemento["obra_id"];
                                        $f_creacion = $elemento["fecha_creacion"];

                                        echo ' 
                                        <div class="card">      
                                            <img  src="/view/assets/portadas/' . $portada . '" class="card-img-top img-fluid " style="max-height: 300px; max-width=400px;" alt="..." >
                                            <div class="card-body">
                                                <h5 class="card-title">'  . $titulo . '</h5>                                               
                                            </div>
                                            <div class="card-footer">
                                                <small class="text-muted">Ultima actualización: <br>' . $ultFecha . '</small>
                                            </div>
                                        </div> ';

                                        $contadorElementos += 1;
                                    } else {
                                        break;
                                    }
                                }
                            }

                            '</div>'; //Fin card-group Obras

                            //En caso de que no tenga obras


                            if ($contadorElementos == 0) {

                                echo '
                                    <div class="card my-3">
                                    <div class="card-header">
                                    ¡Empieza a escribir la historia que cambiará al mundo!
                                     </div>
                                    <div class="card-body">
                                    <blockquote class="blockquote mb-0 text-center">
                                    <p class="fst-italic"> "Escribimos para inventarnos un mundo mejor del que conocemos".</p>
                                    <footer class="blockquote-footer">Anaís Nin<cite title="Source Title"></cite></footer>
                                    </blockquote>
                                    </div>
                                    </div> 

                                </div>
                                
                                <h2 class="text-center mt-5" >¡Mira las últimas obras!</h2>
                                
                                <div class=" row d-flex justify-content-center">';




                                $contador = 0;

                                $datosAllObras = $consultaObra->consultarAllObras();

                                foreach ($datosAllObras as $elementos) {

                                    if ($contador < 3) {

                                        $titObras = $elementos["titulo"];
                                        $sinopObras = $elementos["sinopsis"];
                                        $ultFechaObras = $elementos["fecha_actualizacion"];
                                        $portObras = $elementos["portada"];



                                        echo '<div class="card mb-3" style="max-width: 540px;">
                                             
                                            <div class="row g-0">
                                                 
                                                <div class="col-md-4">
                                                <a href="#"><img src="/view/assets/portadas/' . $portObras . '" class="img-fluid rounded-start" alt="..."> </a>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <a href="#"><h5 class="card-title">' . $titObras . '</h5></a>
                                                        <p class="card-text">' . $sinopObras . '</p>
                                                        <p class="card-text"><small class="text-muted">Publicado: ' . $ultFechaObras . '</small></p>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>';

                                        $contador += 1;
                                    } else {
                                        break;
                                    }
                                }
                            }
                            ?>
                        </div>



                        <?php

                        // <!-- Caps -->

                        //  LISTADO DE CAPÍTULOS

                        $consultUltCaps = $consultaObra->ultCapsUser($_SESSION["usuario_id"]);

                        if (count($consultUltCaps) > 0) {

                            echo '<h2 class="mt-5 text-center">Últimos Capítulos</h2> 
                               <div class="my-3">';

                            foreach ($consultUltCaps as $elementos) {

                                $titobra = $elementos["titulo_obra"];
                                $titCaps = $elementos["titulo_cap"];
                                $ultFechaCaps = $elementos["fecha_actualizacion"];
                                $numCap = $elementos["numero_cap"];
                                $contenido = substr($elementos["contenido"], 0, 200);

                                echo '<div class="my-4">

                            <a href="#">
                            
                                    <div class="card">
                                    <h4 class="card-header">' . strtoupper($titobra) . '</h4>
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