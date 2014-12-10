<HTML>
  <HEAD>
    <TITLE>Books Loaned</TITLE>
  </HEAD>

  <BODY bgcolor = aquamarine>
    <H2><CENTER>Books Loaned by Selected Patron</H2></CENTER>
    <FORM METHOD="post" action="1_patronBooks.php">
      <P><CENTER>
<?php
/* Connect to MySQL */


$link = mysql_connect ("Services1.mcs.sdsmt.edu", "s7103025f14", "7103025") or
die("Unable to connect");

/* Select MySQL database */
mysql_select_db("db_7103025f14") or die("Unable to select the database");

$res = mysql_query("SELECT patronName from PATRON");

$num = mysql_numrows($res);


?>

<TABLE>
<TR><TH><strong> Select Patron </strong></TH></TR>
<TR><TD valign = top>
<SELECT id=status name=status>
<?php
/* Display each distinct STATUS value stored in the database */
for ($i = 0; $i < $num; $i++)
{
    $row=mysql_fetch_row($res);
    echo "<option> $row[0] </option>";
}
mysql_close($link);
?>

</SELECT></TD>
</TR>
</TABLE>


<P>
<INPUT TYPE="SUBMIT" VALUE="Execute SQL statement...">
<INPUT TYPE="RESET"  VALUE="Clear...">
<P>
</CENTER>
</FORM>
</BODY>
<HTML>

