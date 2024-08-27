<?php
//                     if (isset($_SESSION["usuario"])) {                        
//                     ?>
//                     <form action="/model/seguir_model.php" method="post" class="mt-4 d-flex justify-content-center">                      

//                         <!-- Id Autor -->
//                         <input type="text" name="seguido" value="<?php echo $usuario_id ?>" hidden>
//                         <!-- Id Obra -->
//                         <input type="text" name="obra" value="<?php echo $id_obra ?>" hidden>
//                         <!-- Id Usuario Actual -->
//                         <input type="text" name="seguidor" value="<?php echo $_SESSION["usuario_id"] ?>" hidden>

//                         <?php
//                         //Verifico si el usuario ya está siguiendo al otro
//                         $yaSeg1=[];
//                         $yaSeg1 = $consultaSeg->verificarSeg($_SESSION["usuario_id"], $usuario_id);

//                         if (count($yaSeg1) > 0) {
//                             echo '<input class="btn-editObra" type="submit" Value="Dejar de seguir" name="seguir">';
//                         } else {                            
//                             echo '<input class="btn-editObra" type="submit" Value="+ Seguir al Autor" name="seguir"> ';
//                         }
//                         ?>
//                     </form>
//                     <?php }?>