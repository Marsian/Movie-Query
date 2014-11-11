<h2 class="sub-header">Add Actor -> Movie</h2>
			
<form class="form-horizontal" action="index.php" role="form" method="get">
			  
<?php
	
	$db_connection = mysql_connect("localhost", "cs143", "");
	mysql_select_db("CS143", $db_connection);
		
	$rs = mysql_query("select * from Actor", $db_connection);
	echo "<div class='form-group'>
			<label for='aid' class='col-sm-2 control-label'>Actor</label>
		<div class='col-sm-4'>";
	echo "<select class='form-control' name='aid'>";
	while($row = mysql_fetch_row($rs)) {
		echo "<option value='" .$row[0] ."'>".$row[2]." ".$row[1]."</option>";
	}
	echo "</select>";
	echo "</div></div>";
	$rs = mysql_query("select * from Movie", $db_connection);
	
	echo "<div class='form-group'>
			<label for='mid' class='col-sm-2 control-label'>Movie</label>
		<div class='col-sm-4'>";
	
	echo "<select class='form-control' name='mid'>";
	while($row = mysql_fetch_row($rs)) {
		echo "<option value='" .$row[0] ."'>".$row[1]."</option>";
	}
	echo "</select>";
	echo "</div></div>";
	
	if($_GET["mid"] && $_GET['aid'])
	{
		$rs = mysql_query("insert into MovieActor value(".$_GET['mid'].", ".$_GET['aid'].", '".$_GET['role']."')", $db_connection);
	}
	mysql_close($db_connection);
?>
	
	<div class="form-group">
		<label for="role" class="col-sm-2 control-label">Role</label>
		<div class="col-sm-4">
			<input class="form-control" placeholder="Enter Role" name="role" id="role">
		</div>
	</div>
   <div style="visibility: hidden">
      <input type="text" id="page" name="page" value="addMovieActor.php" />
   </div>
	<div class="col-sm-offset-2 col-sm-10">
		<input type="submit" class="btn btn-primary">
   </div>
</form>
          
