<?php

include('connectionData_final.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

?>

<html>
<head>
  <title>Hospital_Management_System</title>
  </head>
  
  <body bgcolor="white">
  
  
  <hr>
  
  
<?php
  
$time = $_POST['time'];

$time = mysqli_real_escape_string($conn, $time);
// this is a small attempt to avoid SQL injection
// better to use prepared statements

$query = "SELECT fname, lname FROM (SELECT EID FROM Employee WHERE fname = \"Anna\") AS e LEFT JOIN Record r ON e.EID = r.EID_maintain JOIN Patient p USING (PID) WHERE period < ";
$query = $query."'".$time."';";

?>

<p>
The query:
<p>
<?php
print $query;
?>

<hr>
<p>
Result of query:
<p>

<?php
$result = mysqli_query($conn, $query)
or die(mysqli_error($conn));

print "<pre>";
while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
  {
    print "\n";
    print "$row[fname]  $row[lname]";
  }
print "</pre>";

mysqli_free_result($result);

mysqli_close($conn);

?>

<p>
<hr>

<p>
<a href="record_php.txt" >Contents</a>
of the PHP program that created this page. 	 
 
</body>
</html>
	  