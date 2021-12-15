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
  
$symptom = $_POST['symptom'];

$symptom = mysqli_real_escape_string($conn, $symptom);
// this is a small attempt to avoid SQL injection
// better to use prepared statements

$query = "SELECT Distinct p.fname, p.lname, r.period from Record r join Patient p using (PID) left join Doctor d on (p.doctor_id = d.EID) left join Department dept using (dept_id) where dept.name = ";
$query = $query."'".$symptom."';";

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
    print "$row[fname]  $row[lname]   $row[period]";
  }
print "</pre>";

mysqli_free_result($result);

mysqli_close($conn);

?>

<p>
<hr>

<p>
<a href="symptom_php.txt" >Contents</a>
of the PHP program that created this page. 	 
 
</body>
</html>
	  