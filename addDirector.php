<h2 class="sub-header">Add Director</h2>
			
<form class="form-horizontal" action="index.php" role="form" method="get">
	<div class="form-group">
		<label for="first" class="col-sm-2 control-label">First Name</label>
			<div class="col-sm-4">
				<input class="form-control" placeholder="Enter First Name" name="first" id="first">
		   </div>
	</div>
	<div class="form-group">
		<label for="last" class="col-sm-2 control-label">Last Name</label>
			<div class="col-sm-4">
				<input class="form-control" placeholder="Enter Last Name" name="last" id="last">
			</div>
	</div>
	<div class="form-group">
		<label for="dob" class="col-sm-2 control-label">Date of Birth</label>
			<div class="col-sm-4">
				<input class="form-control" placeholder="Enter Date of Birth (yyyy-mm-dd)" name="dob" id="dob">
			</div>
	</div>
	<div class="form-group">
		<label for="dod" class="col-sm-2 control-label">Date of Death</label>
			<div class="col-sm-4">
				<input class="form-control" placeholder="Enter Date of Death (yyyy-mm-dd)" name="dod" id="dod">
			</div>
	</div>
   <div style="visibility: hidden">
      <input type="text" id="page" name="page" value="addDirector.php" />
   </div>
	<div class="col-sm-offset-2 col-sm-10">
		<input type="submit" class="btn btn-primary">
	</div>
</form>
            
			  
<?php
	if($_GET["first"])
	{
		$db_connection = mysql_connect("localhost", "cs143", "");
		mysql_select_db("CS143", $db_connection);
		
		$maxId = mysql_query("select max(id) from Director", $db_connection);
		$row = mysql_fetch_row($maxId);
		$maxId = $row[0] + 1;
		
		$first = $_GET["first"];
		$last = $_GET["last"];
		
		$dob = $_GET["dob"];
		$dod = $_GET["dod"];
		
		if (strlen($dod) == 0) {
			$query = "insert into Director values(" . $maxId . ", '" . $first . "', '" . $last . "', '" . $dob . "', null)";
		} else {
			$query = "insert into Director values(" . $maxId . ", '" . $first . "', '" . $last . "', '" . $dob . "', '" . $dod ."')";
		}
		
		$rs = mysql_query($query, $db_connection);
		
		echo "Insert successfully!";
		
		mysql_close($db_connection);
	}
?>
