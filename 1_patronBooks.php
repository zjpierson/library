<HTML>
<HEAD>
<TITLE>
Loan Status
</TITLE>
</HEAD>
<BODY bgcolor = aquamarine>
<P>

<?php
$status = $_POST['status'];
echo "<H2>Books Loaned by: $status</H2>";

/* Connect to MySQL */ 
$link = mysql_connect ("Services1.mcs.sdsmt.edu", "s7103025f14", "7103025") or
  die("Unable to connect");

/* Select the database */
  mysql_select_db("db_7103025f14") or die("Unable to select the database");

/* Access the VIDEOFORRENT table */
  $result = mysql_query("
      SELECT patronName, title, bookNo, checkOutDate, dueDate 
      FROM PATRON NATURAL JOIN LOAN
      NATURAL JOIN COPYBOOK
      NATURAL JOIN BOOK
      WHERE patronName = '$status'");

?>

<TABLE Border="1">
<TR>

<?php
/* Fetch and display the attribute names */
while ($field=mysql_fetch_field($result))
{
   echo "<TH>";
   echo "$field->name";
   echo "</TH>";
}
echo "</TR>";

/* Fetch and displays each row of $result */ 
if($result)
   while($row=mysql_fetch_row($result))
   {
      echo "<TR>";
      for ($i=0; $i < mysql_num_fields($result); $i++)
      {
         echo "<TD> $row[$i] </TD>";
      }
      echo "</TR>\n";
   }

mysql_close($link);
?>

</TABLE>
<BR>
<BR>
<a href = library.html>Return to Main Web Page</a>
</BODY>
</HTML>
