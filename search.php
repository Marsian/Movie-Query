<?php
	if ($_GET['keywords']) {
		$db_connection = mysql_connect("localhost", "cs143", "");
		mysql_select_db("CS143", $db_connection);
		
		/* Print Actors */
		echo "<h2 class='sub-header'>Actors</h2>";
		
		echo "<table class='table table-striped'>";
	   
      /* Find actors with exactly the same name */
		$rs = mysql_query("select * from Actor where last='".$_GET['keywords']."'" , $db_connection);
		$numOfField = mysql_num_fields($rs);
		echo "<tr><thead>";
		for($i = 0; $i < $numOfField; $i++)
		{
			$field = mysql_fetch_field($rs);
			echo "<th>$field->name</th>";
		}
		echo "</tr></thead>\n<tbody>";
		
		while($row = mysql_fetch_row($rs))
		{
			echo "<tr>";
			$i=0;
			foreach($row as $cell)
			{
				$i++;
				if ($i==1) {
					echo "<td><a href='/~cs143/index.php?page=actorDetail.php&actorID=" . $cell. "'>$cell</a></td>";
				} else
					echo "<td>$cell</td>";
			}
			echo "</tr>\n";
		}
		
		$rs = mysql_query("select * from Actor where first='".$_GET['keywords']."'" , $db_connection);
		
		while($row = mysql_fetch_row($rs))
		{
			echo "<tr>";
			$i=0;
			foreach($row as $cell)
			{
				$i++;
				if ($i==1) {
					echo "<td><a href='/~cs143/index.php?page=actorDetail.php&actorID=" . $cell. "'>$cell</a></td>";
				} else
					echo "<td>$cell</td>";
			}
			echo "</tr>\n";
		}
		
		$keywords = split(' ', $_GET['keywords']);
		
		$query = "select * from Actor where (";
		
		foreach ($keywords as $word) {
			if (strlen($word) == 0)
				continue;
			$query = $query . "first like '%" . $word . "%' or ";
			$query = $query . "last like '%" . $word . "%' or ";
		}
		$query = substr($query, 0, strlen($query)-4);
		
		$query = $query . ") and not last='".$_GET['keywords']."' and not first='" .$_GET['keywords']."' order by last";
		//echo $query;
		$rs = mysql_query($query, $db_connection);
		if ($rs)
		while($row = mysql_fetch_row($rs))
		{
			echo "<tr>";
			$i=0;
			foreach($row as $cell)
			{
				$i++;
				if ($i==1) {
					echo "<td><a href='/~cs143/index.php?page=actorDetail.php&actorID=" . $cell. "'>$cell</a></td>";
				} else
					echo "<td>$cell</td>";
			}
			echo "</tr>\n";
		}
		
		echo "</tbody></table>";
		
		/* Print Movies*/
		
		echo "<h2 class='sub-header'>Movies</h2>";
		
		echo "<table class='table table-striped'>";
		
		$rs = mysql_query("select * from Movie where title='".$_GET['keywords']."'" , $db_connection);
		$numOfField = mysql_num_fields($rs);
		echo "<tr><thead>";
		for($i = 0; $i < $numOfField; $i++)
		{
			$field = mysql_fetch_field($rs);
			echo "<th>$field->name</th>";
		}
		echo "</tr></thead>\n<tbody>";
		
		while($row = mysql_fetch_row($rs))
		{
			echo "<tr>";
			$i=0;
			foreach($row as $cell)
			{	
				$i++;
				if ($i==1) {
					echo "<td><a href='/~cs143/index.php?page=moviedetail.php&movieID=" .$cell. "'>$cell</a></td>";
				} else {
					echo "<td>$cell</td>";
				}
			}
			echo "</tr>\n";
		}
		
		$query = "select * from Movie where (";
		
		foreach ($keywords as $word) {
			if (strlen($word) == 0)
				continue;
			$query = $query . "title like '%" . $word . "%' or ";
		}
		$query = substr($query, 0, strlen($query)-4);
		
		$query = $query . ") and not title='".$_GET['keywords']."' order by title";
		//echo $query;
		$rs = mysql_query($query , $db_connection);
		
		if ($rs)
		while($row = mysql_fetch_row($rs))
		{
			echo "<tr>";
			$i=0;
			foreach($row as $cell)
			{	
				$i++;
				if ($i==1) {
					echo "<td><a href='/~cs143/index.php?page=moviedetail.php&movieID=" .$cell. "'>$cell</a></td>";
				} else {
					echo "<td>$cell</td>";
				}
			}
			echo "</tr>\n";
		}
		echo "</tbody></table>";
		mysql_close($db_connection);
	} else {
		echo "<h2> Search movie/actor by typing keywords at top right corner!";
	}
   echo "</table>";
?>
