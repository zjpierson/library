<HTML>
<HEAD>
<TITLE>Update Patrons</TITLE>
</HEAD>

<BODY bgcolor = aquamarine>
<H2><CENTER>Update Patrons
</CENTER></H2>
<FORM METHOD="post" action="5_createPatron.php">
<P>
<HR>
<CENTER>

<?php
/* Connect to MySQL */

$link = mysql_connect ("Services1.mcs.sdsmt.edu", "s7103025f14", "7103025")or
  die("Unable to connect");

/* Select MySQL database */
  mysql_select_db("db_7103025f14") or die("Unable to select the database");


if (isset($_POST['add']))
{
   $id = $_POST['id'];
   $name = $_POST['name'];
   $type = $_POST['type'];
   $query = "INSERT INTO PATRON VALUES('$id','$name','$type')";
   $res = mysql_query($query);
   $message = "*****Patron added*****";
}

$name = trim($name);
$type = trim($type);

mysql_close($link);
?>

<BR> Patron ID:
<BR><INPUT TYPE="NUMBER" NAME="id">
<BR>
<BR> Full Name:
<BR><INPUT TYPE="TEXT" NAME="name">
<BR>
<BR> Patron Type:
<BR><INPUT TYPE="TEXT" NAME="type">
<BR>
<BR>


<INPUT TYPE="SUBMIT" NAME="add" VALUE="Add">

<?php
if (isset($_POST['add']))
{
   echo "<BR><BR> $message";
}
?>


<BR>
<BR>
<a href = library.html>Return to Main Web Page</a>
</CENTER>
</FORM>
</BODY>
</HTML>
