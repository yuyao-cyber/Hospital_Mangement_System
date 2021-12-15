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
  
$ward_type = $_POST['ward_type'];

$ward_type = mysqli_real_escape_string($conn, $ward_type);
// this is a small attempt to avoid SQL injection
// better to use prepared statements

$query = "SELECT p.fname, p.lname FROM Patient p JOIN Room r USING (room_id) WHERE r.type = ";
$query = $query."'".$ward_type."';";

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
<a href="ward_php.txt" >Contents</a>
of the PHP program that created this page. 	 
 
</body>
</html>
	  