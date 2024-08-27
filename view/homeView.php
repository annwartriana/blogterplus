<?php
  include ("/xampp/htdocs/blogterplus/view/plantilla.php");  
  session_start();
  if(isset($_SESSION["usuario"])){
    header("location:/xampp/htdocs/blogterplus//view/loginView.php");
 }
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

 <?php echo navbarOpen(); ?>

  <main class="container">

    <!-- Sección Presentación -->
    <section class="hero mt-sm-5 ">

      <div class="row d-flex presImg p-5 ">
        <article class="col-12 col-lg-7  ">
          <div class="text-center text-md-start">
            <h1 style=" font-weight: 700;">Bienvenido a <span style="color:#1aa3ac;">Blogter+</span></h1>
            <br>
            <h3 style=" font-weight: 500;">Un espacio para lectores y escritores</h3>
            <br>
          </div>

          <p class="col-lg-11 ms-4 ms-md-0">En Blogter+ podrás definir, estructurar, producir y publicar tus obras
            completamente gratis.
            Como lector, podrás encontrar nuevos universos y ayudar a tus escritores favoritos con tus sugerencias y
            recomendaciones. </p>

        </article>
        <img class="col-12 col-lg-5 img-fluid" src="/view/assets/img/homeImg.webp" alt="Imagen Presentación">
      </div>

      <div class="row leeEscCon pt-sm-3 px-5 mb-md-4">

        <articles class="col-md-4 leeEsCon__articles mb-4 mb-sm-0">

          <h3><i class="bi bi-book"></i> Lee</h3>
          <h5>Descubre universos</h5>
          <p>Explora las historias que personas de todo el mundo tienen para contar. Disfruta de variados géneros y
            estilos.</p>
        </articles>

        <articles class="col-md-4 leeEsCon__articles mb-4 mb-sm-0">

          <h3><i class="bi bi-pencil-square"></i> Escribe</h3>
          <h5>Crea universos</h5>
          <p>Sé el autor del próximo Best Seller. Conoce personas, haz amigos y disfruta creando los universos que
            dejarán huella.</p>
        </articles>

        <articles class="col-md-4 leeEsCon__articles mb-4 mb-sm-0">

          <h3><i class="bi bi-globe"></i> Publica</h3>
          <h5>Muestra tu trabajo</h5>
          <p>Muchos quieren conocer tus ideas y tu visión del mundo. Es hora de darte a conocer. Vuelvete famoso
            haciendo lo que amas. </p>
        </articles>


      </div>

    </section>

    <!-- Sección Recomendaciones -->
    <!-- <section class="row recomendacion px-5 d-flex justify-content-around align-content-around mt-5 ">

      <div class="col-12 mb-3">
        <hr>
        <h2>Recomendaciones</h2>
      </div>

      <section class="row "> -->
        <!-- Columna izquierda -->
        <!-- <div class="col-lg mb-3 mb-lg-0">
          <div class="featured-post h-100"> -->
            <!-- Carousel2 -->
            <!-- <div id="featuredPostCarousel" class="carousel slide h-100" data-bs-interval="false">
              <div class="carousel-inner h-100">

                <div class="carousel-item active  h-100">
                  <div class="featured-post-inner h-100  d-flex align-items-end featured-post-1">
                    <div class="featured-post-info">
                      <h4>Lorem ipsum dolor sit.</h4>
                      <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quae, officia.</p>
                      <p class="post-meta d-flex justify-content-between">
                        <span>Paul Smith</span>
                        <span>23 de agosto de 2017</span>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="carousel-item h-100">
                  <div class="featured-post-inner h-100  d-flex align-items-end featured-post-2">
                    <div class="featured-post-info">
                      <h4>Lorem ipsum.</h4>
                      <p>Lorem ipsum dolor sit, adipisicing elit. Quae, officia.</p>
                      <p class="post-meta d-flex justify-content-between">
                        <span>Carl Smith</span>
                        <span>23 de agosto de 2018</span>
                      </p>
                    </div>
                  </div>
                </div>

              </div>

              <a href="#featuredPostCarousel" class="carousel-control-prev" data-bs-slide="prev" role="button">
                <span class="carousel-control-prev-icon"></span>
              </a>

              <a href="#featuredPostCarousel" class="carousel-control-next" data-bs-slide="next" role="button">
                <span class="carousel-control-next-icon"></span>
              </a>
            </div>
          </div>
        </div> -->

        <!-- Columna derecha -->
        <!-- <div class="col-lg">
          <div class="row post mb-3">
            <div class="col-sm-4">
              <img class="img-fluid" src="/view/assets/img/post3.jpeg" alt="">
            </div>

            <div class="col-sm-8">
              <h4>Lorem ipsum.</h4>
              <p>Lorem ipsum dolor sit, adipisicing elit. Quae, officia.</p>
              <p class="post-meta d-flex justify-content-between">
                <span>Carl Smith</span>
                <span>23 de agosto de 2018</span>
              </p>
            </div>
          </div>

          <div class="row post mb-3">
            <div class="col-sm-4">
              <img class="img-fluid" src="/view/assets/img/post4.jpeg" alt="">
            </div>

            <div class="col-sm-8">
              <h4>Lorem ipsum.</h4>
              <p>Lorem ipsum dolor sit, adipisicing elit. Quae, officia.</p>
              <p class="post-meta d-flex justify-content-between">
                <span>Carl Smith</span>
                <span>23 de agosto de 2018</span>
              </p>
            </div>
          </div>

          <div class="row post mb-3">
            <div class="col-sm-4">
              <img class="img-fluid" src="/view/assets/img/post5.jpg" alt="">
            </div>

            <div class="col-sm-8">
              <h4>Lorem ipsum.</h4>
              <p>Lorem ipsum dolor sit, adipisicing elit. Quae, officia.</p>
              <p class="post-meta d-flex justify-content-between">
                <span>Carl Smith</span>
                <span>23 de agosto de 2018</span>
              </p>
            </div>
          </div>

        </div>
      </section> -->




    </section>





  </main>

   <?php echo footer(); ?>

  <!-- Inicio de sesión incorrecto-->
  <?php
    if (!empty($_GET['modal'])){
      
      if($_GET['modal']==2){  
  ?>
  <script>
  window.onload = function() {
  console.log(jQuery('#sign_in').modal('show'));
  }
  </script>

  <!-- Verificación datos Registro -->
  <?php }
    elseif($_GET['modal']==1){
  }?>   
  <script>
  window.onload = function() {
  console.log(jQuery('#sign_in').modal('show'));
  }
  </script>
  <?php } ?>

  <!-- Importamos los scripts de JS -->
  <script src="/view/js/jquery.js"></script>
  <script src="/view/js/popper.js"></script>
  <script src="/view/js/bootstrap.js"></script>
</body>

</html>

