<?php
   
   $fd = fopen("addMovie.html", r);
   $content = fread($fd, filesize("addMovie.html"));
   fclose($fd);

   echo $content;

	if($_GET["title"])
	{
      $db_connection = mysql_connect("localhost", "cs143", "");
      mysql_select_db("CS143", $db_connection);
      
      $maxId = mysql_query("select max(id) from Movie", $db_connection);
      $row = mysql_fetch_row($maxId);
      $maxId = $row[0] + 1;
      
      $title = $_GET["title"];
      $year = $_GET["year"];
      $rating = $_GET["rating"];
      $company = $_GET["company"];
      
      $query = "insert into Movie values(" . $maxId . ", '" . $title . "', " . $year . ", '" . $rating . "', '" . $company . "')";
      
      $rs = mysql_query($query, $db_connection);
      
      echo "Insert successfully!";
      
      mysql_close($db_connection);
	}
?>
