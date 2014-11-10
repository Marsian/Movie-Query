<?php
   echo "<h2 class=\"sub-header\">Actors</h2><table class='table table-striped'>";
   $db_connection = mysql_connect("localhost", "cs143", "");
   mysql_select_db("CS143", $db_connection);
   
   $rs = mysql_query("SELECT * FROM Actor", $db_connection);
                  
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
            echo "<td><a href='/~cs143/actordetail.php?actorID=" . $cell. "'>$cell</a></td>";
         } else
            echo "<td>$cell</td>";
         }
         echo "</tr>\n";
      }
      mysql_close($db_connection);
      echo "</tbody></table>";
?>


  
