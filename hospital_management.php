<?php

include('connectionData_final.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

?>

<html>
<head>
  <title>Hospital Management System</title>
  </head>
  
  <body bgcolor="white">
  
  
  <hr>
  
  
<?php
  
$patient_name = $_POST['search'];

$patient_name = mysqli_real_escape_string($conn, $patient_name);
// this is a small attempt to avoid SQL injection
// better to use prepared statements

$query = "SELECT CONCAT(fname, \" \", lname) AS patient_name, date_admitted FROM Patient WHERE date_discharged is NULL";
// $query = $query."'".$patient_name."';";

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
    print "$row[patient_name] $row[data_admitted]";
  }
print "</pre>";

mysqli_free_result($result);

mysqli_close($conn);

?>

<p>
<hr>

<p>
<a href="hospital_management_php.txt" >Contents</a>
of the PHP program that created this page. 	 
 
</body>
</html>
	  