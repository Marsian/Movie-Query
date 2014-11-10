<html>
   <?php
      $fd = fopen("head.html", r);
      $content = fread($fd, filesize("head.html"));
      fclose($fd);

      echo $content;
   ?>

   <body>
   <?php
      $fd = fopen("bar.html", r);
      $content = fread($fd, filesize("bar.html"));
      fclose($fd);

      echo $content;
   ?>

   <?php
      if ( $_GET['page'] ) {
         echo "<div class=\"container\"><div class=\"jumbotron\">";
         include( $_GET['page'] );
         echo "</div></div>";
      }

      if ( $_GET['keywords'] ) {
         echo "<div class=\"container\"><div class=\"jumbotron\">";
         include( "search.php" );
         echo "</div></div>";
      }
   ?>
   <!-- Bootstrap core JavaScript
   ================================================== -->
   <!-- Placed at the end of the document so the pages load faster -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="bootstrap-3.3.0-dist/dist/js/bootstrap.min.js"></script>
   </body>
</html>
