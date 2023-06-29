<?php
    $servidor = mysqli_connect($host_mysql,$user_mysql,$pass_mysql,$db_mysql) or die("Error no se puede conectar a la base de datos");
     

     function clear($var)
     {
          htmlspecialchars($var);
          return $var;
     }

     function check_admin()
     {
          if(!isset($_SESSION['id']))
          {
               redir("?p=principal");
          }
     }

     function check_Add()
     {
          
     }
     function redir($var)
     {
          ?>
          <script>
               window.location = "<?=$var?>";
          </script>
          <?php
          die();
     }

     function alert($var)
     {
          ?>
          <script type="text/javascript">
               alert("<?=$var?>");
          </script>
          <?php
     }


?>