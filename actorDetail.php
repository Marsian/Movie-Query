<?php
	if ($_GET['actorID']) {
		$db_connection = mysql_connect("localhost", "cs143", "");
		mysql_select_db("CS143", $db_connection);
		$actorID = $_GET['actorID'];
		$rs = mysql_query("SELECT * FROM Actor where id=".$actorID, $db_connection);
		
		$row = mysql_fetch_row($rs);
		$last = $row[1];
		$first = $row[2];
		echo '<h2>' . $first . " " . $last . '</h2>';
		
		echo "<div class='panel panel-default'> <div class='panel-heading'><h4>Basic Info</h4></div> <div class='panel-body'>";
		echo "<h4>Sex : " . $row[3] ."</h4>";
		
		echo "<h4>Date of Birth : ". $row[4] ."</h4>";
		
		echo "<h4>Date of Death : ". $row[5] ."</h4></div></div>";
		
		$numOfField = mysql_num_fields($rs);
		
		$rs = mysql_query("select * from MovieActor where aid=".$actorID, $db_connection);
		
		echo "<div class='panel panel-default'> <div class='panel-heading'><h4>Movies</h4></div> <div class='panel-body'>";
		
		/* Print the contents */
		while($row = mysql_fetch_row($rs))
		{
			echo "<p>";
			$mid = $row[0];
			
			$movieQuery = mysql_query("select title from Movie where id=".$mid, $db_connection);
			$title = mysql_fetch_row($movieQuery);
			echo "<a href=/~cs143/moviedetail.php?movieID=".$mid.">".$title[0]."</a></p>\n";
		}
		echo "</div></div>";
		mysql_close($db_connection);
	}
?>
