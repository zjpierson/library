<HTML>
  <HEAD>
    <TITLE>Book Check Out</TITLE>
  </HEAD>

  <BODY bgcolor = aquamarine>
    <H2><CENTER>Check Me Out!</H2></CENTER>
    <FORM METHOD="post" action="4_loan.php">
      <P><CENTER>
<?php
/* Connect to MySQL */

$link = mysql_connect ("Services1.mcs.sdsmt.edu", "s7103025f14", "7103025") or
die("Unable to connect");

/* Select MySQL database */
mysql_select_db("db_7103025f14") or die("Unable to select the database");

$pnames = mysql_query("
    SELECT patronName
    FROM PATRON");
$btitles = mysql_query("
    SELECT title
    FROM COPYBOOK NATURAL JOIN BOOK 
    NATURAL LEFT JOIN LOAN
    WHERE loanNo IS NULL");
/*$btitles = mysql_query("
    SELECT titles");*/
$numPatrons = mysql_numrows($pnames);
$numTitles = mysql_numrows($btitles);

if (isset($_POST['submit']))
{
   $name = $_POST['patron'];
   $title = $_POST['title'];
   $query = mysql_query("
       SELECT COUNT(loanNo) 
       FROM LOAN NATURAL JOIN PATRON
       WHERE patronName = $name");
    $row=mysql_fetch_row($query);
    echo "$row[0]";
   if($query < 3)
   {
       $copyNo = mysql(" 
         SELECT copyNo
         FROM COPYBOOK
         WHERE title = $title");
       $copyNo = mysql_fetch_row($copyNo);
       $patronNo = mysql_query("
         SELECT patronNo
         FROM PATRON
         WHERE patronName = $name");
       $count = mysql_query("
           SELECT COUNT(*)
           FROM LOAN");
       $count++;
       $query = mysql_query("
           INSERT INTO LOAN
           VALUES($count, $copyNo, $patronNo, '2014-12-10', '2014-12-15')");
   }
   $res = mysql_query($query);
   $message = "*****Patron added*****";
}


?>

<SELECT id=patron name=patron>
<?php
/* Display each distinct STATUS value stored in the database */
for ($i = 0; $i < $numPatrons; $i++)
{
    $row=mysql_fetch_row($pnames);
    echo "<option> $row[0] </option>";
}
mysql_close($link);
?>
</SELECT>

<SELECT id=title name=title>
<?php
/* Display each distinct STATUS value stored in the database */
for ($i = 0; $i < $numTitles; $i++)
{
    $row=mysql_fetch_row($btitles);
    echo "<option> $row[0] </option>";
}
mysql_close($link);
?>
</SELECT>



<P>
<INPUT TYPE="SUBMIT" VALUE="Check Out" id="submit" name="submit">
<P>
</CENTER>
</FORM>
</BODY>
<HTML>

