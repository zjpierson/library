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
    SELECT title, copyNo
    FROM COPYBOOK NATURAL JOIN BOOK 
    NATURAL LEFT JOIN LOAN
    WHERE loanNo IS NULL");

$numPatrons = mysql_numrows($pnames);
$numTitles = mysql_numrows($btitles);

if (isset($_POST['submit']))
{
   $name = $_POST['patron'];
   $title = $_POST['title'];
   if($title != null)
   {
       $query = mysql_query("
           SELECT COUNT(loanNo) 
           FROM LOAN NATURAL JOIN PATRON
           WHERE patronName = '$name'");
       $row=mysql_fetch_row($query);
       $message = "*****$name already has 3 books checked out*****";
       if($row[0] < 3)
       {
           $copyNo = mysql_query("
               SELECT copyNo
               FROM COPYBOOK NATURAL JOIN BOOK
               NATURAL LEFT JOIN LOAN
               WHERE title = '$title' AND loanNo IS NULL");
           $copyNo = mysql_fetch_row($copyNo);
           $patronNo = mysql_query("
             SELECT patronNo
             FROM PATRON
             WHERE patronName = '$name'");
           $patronNo = mysql_fetch_row($patronNo);
           $count = mysql_query("
               SELECT COUNT(*)
               FROM LOAN");
           $count = mysql_fetch_row($count);
           $count[0]++;
           $query = mysql_query("
               INSERT INTO LOAN
               VALUES($count[0], $copyNo[0], $patronNo[0], '2014-12-10', '2014-12-15')");
       $message = "*****Book successfully check out to $name*****";
       }
       $res = mysql_query($query);
   }

}


$btitles = mysql_query("
    SELECT title, copyNo
    FROM COPYBOOK NATURAL JOIN BOOK 
    NATURAL LEFT JOIN LOAN
    WHERE loanNo IS NULL");
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

<?php
if(isset($_POST['submit']))
{
    if($title != NULL)
    echo "<BR><BR> $message";
}
?>


<P>
<INPUT TYPE="SUBMIT" VALUE="Check Out" id="submit" name="submit">
<P>
<BR>
<BR>
<a href = library.html>Return to Main Web Page</a>
</CENTER>
</FORM>
</BODY>
<HTML>

