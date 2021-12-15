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
  
$treat = $_POST['treat'];

$patient_name = mysqli_real_escape_string($conn, $patient_name);
// this is a small attempt to avoid SQL injection
// better to use prepared statements

$query = "SELECT p.lname, p.fname from (select lname, fname, doctor_id from Patient where date_discharged like \"%-11-%\") as p join Doctor d on doctor_id = EID left join Employee e using (EID)";
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
    print "$row[lname] $row[fname]";
  }
print "</pre>";

mysqli_free_result($result);

mysqli_close($conn);

?>

<p>
<hr>

<p>
<a href="treat_php.txt" >Contents</a>
of the PHP program that created this page. 	 
 
</body>
</html>
	  