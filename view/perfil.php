<?php
  include ("/xampp/htdocs/blogterplus/view/plantilla.php");  
  session_start();
  if(isset($_SESSION["usuario"])){
    header("location:/xampp/htdocs/blogterplus/view/loginView.php");
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php echo navbarLogin(); ?>
    


<?php echo footer(); ?>
</body>
</html>