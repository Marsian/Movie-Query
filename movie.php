<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="author" content="Yanxi">
      <link rel="icon" href="/~cs143/favicon.ico">
      <title>Homepage for cs143/project C</title>

      <!-- Bootstrap -->
      <link href="bootstrap-3.3.0-dist/dist/css/bootstrap.min.css" rel="stylesheet">

      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
         <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
         <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body>

      <div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default" role="navigation">
         <div class="container-fluid">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="/~cs143/index.php">Home</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
               <ul class="nav navbar-nav">
                  <li><a href="/~cs143/movie.php">Movies</a></li>
                  <li><a href="/~cs143/actor.php">Actors</a></li>
                  <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">Add Information <span class="caret"></span></a>
                     <ul class="dropdown-menu" role="menu">
                        <li><a href="addActor.php">Actor</a></li>
                        <li><a href="addDirector.php">Director</a></li>
                        <li><a href="addMovie.php">Movie</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="/~cs143/addMovieActor.php">Actor to Movie</a></li>
                        <li><a href="/~cs143/addMovieDirector.php">Director to Movie</a></li>
                     </ul>
                  </li>
               </ul>
               <form class="navbar-form navbar-right" role="form" action="/~cs143/search.php">
                  <div class="form-group">
                     <input type="text" placeholder="Movie, Actor keywords" class="form-control" name="keywords">
                  </div>
                  <button type="submit" class="btn btn-success">Search</button>
               </form>
            </div><!--/.nav-collapse -->
         </div><!--/.container-fluid -->
      </nav>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
			<h2 class="sub-header">Movies</h2>
            <table class='table table-striped'>
               <?php
                  $db_connection = mysql_connect("localhost", "cs143", "");
                  mysql_select_db("CS143", $db_connection);
                  
                  $rs = mysql_query("SELECT * FROM Movie", $db_connection);
                  
                  $numOfField = mysql_num_fields($rs);
                  
                  /* Print the attributes */
                  echo "<tr><thead>";
                  for($i = 0; $i < $numOfField; $i++)
                  {
                     $field = mysql_fetch_field($rs);
                     echo "<th>$field->name</th>";
                  }
                  echo "</tr></thead>\n<tbody>";
                  
                  /* Print the contents */
                  while($row = mysql_fetch_row($rs))
                  {
                     echo "<tr>";
                     $i=0;
                     foreach($row as $cell)
                     {	
                        $i++;
                        if ($i==1) {
                           echo "<td><a href='/~cs143/moviedetail.php?movieID=" .$cell. "'>$cell</a></td>";
                        } else {
                           echo "<td>$cell</td>";
                        }
                     }
                     echo "</tr>\n";
                  }
                  mysql_close($db_connection);
               ?>
               </tbody>
           </table>
		</div>

   </div> <!-- /container -->


   <!-- Bootstrap core JavaScript
   ================================================== -->
   <!-- Placed at the end of the document so the pages load faster -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="bootstrap-3.3.0-dist/dist/js/bootstrap.min.js"></script>
   </body>
</html>
  
