<?php
	if ($_GET['movieID']) {
		$db_connection = mysql_connect("localhost", "cs143", "");
		mysql_select_db("CS143", $db_connection);
		$movieID = $_GET['movieID'];
		$rs = mysql_query("SELECT * FROM Movie where id=".$movieID, $db_connection);
		
		$row = mysql_fetch_row($rs);
		$title = $row[1];
		echo '<h2>' . $title . "</h2>";
		echo "<h4><span class='label label-info'>" . $row[2] 
			. "</span><span class='label label-warning'>" . $row[3] 
			. "</span><span class='label label-success'>" . $row[4] . "</span></h4>";
		
		/* Print Director*/
		echo "<div class='panel panel-default'> <div class='panel-heading'><h4>Director</h4></div> <div class='panel-body'>";
		$rs = mysql_query("select * from MovieDirector where mid=".$movieID, $db_connection);
		if ($row = mysql_fetch_row($rs)) {
			$rs = mysql_query("select * from Director where id=".$row[1], $db_connection);
			if ($row = mysql_fetch_row($rs)) {
				echo $row[2]." ".$row[1];
			}
		}
		echo "</div></div>";
		
		/* Print Actors/Actress */
		echo "<div class='panel panel-default'> <div class='panel-heading'><h4>Actors/Actress</h4></div> <div class='panel-body'>";
		$rs = mysql_query("select * from MovieActor where mid=".$movieID, $db_connection);
		while($row = mysql_fetch_row($rs))
		{
			echo "<p>";
			$aid = $row[1];
			$actorQuery = mysql_query("select * from Actor where id=".$aid, $db_connection);
			$actor = mysql_fetch_row($actorQuery);
			$last = $actor[1];
			$first = $actor[2];
			echo "<a href=/~cs143/actordetail.php?actorID=".$aid.">".$first ." ". $last . "</a></p>\n";
		}
		echo "</div></div>";
		
		/* Add comment */
		if ($_GET['comment']) {
			$query = "insert into Review values('" . $_GET['name'] . "', null, " . $movieID . ", " . $_GET['rating'] . ", '" . $_GET['comment'] ."')";
			$rs = mysql_query($query, $db_connection);
			echo "Insert Successfully";
		}
		
		
		/* Print Average Score*/
		
		$rs = mysql_query("select avg(rating) from Review where mid=".$movieID, $db_connection);
		$score = mysql_fetch_row($rs);
		echo "<div class='panel panel-default'> <div class='panel-heading'><h4>Averge Score</h4></div> <div class='panel-body'>";
		echo $score[0] . "</div></div>";
		
		
	
		
		/* Print all user comments*/
		echo "<div class='panel panel-default'> <div class='panel-heading'><h4>Comments</h4></div> <div class='panel-body'>";
		$rs = mysql_query("select * from Review where mid=".$movieID, $db_connection);
		while($row = mysql_fetch_row($rs))
		{
			echo "<div class='alert'><p>Score : <span class='label label-warning'>" . $row[3] . "</span></p>";
			echo "<p>" . $row[4] . "</p>";
			echo "<p>" . $row[0] . " commented at " . $row[1] . "</p></div>";
		}
		echo "</div></div>";
		
		
		mysql_close($db_connection);
	}
?>

<div class='panel panel-default'> <div class='panel-heading'><h4>Add Comment</h4></div> <div class='panel-body'>
   <form class="form-horizontal" action="index.php" role="form" method="get">
      <div class="form-group col-sm-10">
         <label for="last" class="col-sm-2 control-label">Rating</label>
            <div class="col-sm-2">
               <input class="form-control" placeholder="rating: 0 - 10" name="rating" id="rating">
            </div>
      </div>
      <div class="form-group col-sm-10">
         <label for="last" class="col-sm-2 control-label">Comment</label>
            <div class="col-sm-8">
               <textarea class="form-control" row="3" placeholder="Type your comment here." name="comment" id="comment"></textarea>
            </div>
      </div>
      <div class="form-group col-sm-10">
         <label for="last" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-2">
               <input class="form-control" placeholder="Reviewer name" name="name" id="name">
            </div>
      </div>
      <div style="visibility: hidden">
         <input type="text" id="movieID" name="movieID" value="<?php echo $_GET['movieID'];?>"/>
      </div>
      <div style="visibility: hidden">
         <input type="text" id="page" name="page" value="movieDetail.php" />
      </div>
      <div class="col-sm-offset-2 col-sm-10">
         <input type="submit" class="btn btn-primary" value="">
      </div>
   </form>
</div></div>
