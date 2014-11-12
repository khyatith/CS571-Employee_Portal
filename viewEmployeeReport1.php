<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['position']) && isset($_SESSION['timeout']))
{
$inactive=10;
$t=time();
if(($t-$_SESSION['timeout']) > $inactive) {
header("Location:logout.php"); 
}
}


error_reporting(E_ALL ^ E_DEPRECATED);





if(isset($_GET['fromsalary']) && isset($_GET['tosalary']))
{
       $sal1 = $_GET['fromsalary'];
		$sal2= $_GET['tosalary'];
		//$sal2 = trim($_GET['value3']);
	//$q = $_GET['name2'];
	
	
$con= mysql_connect('cs-server.usc.edu:50422','root','MOMDAD@05');
		if(!$con)
		{		
			die ("Could not connect to database").mysql_error();
		}
		
		mysql_select_db('bakery_database',$con);

$sql = "select * from users where 1 ";
        
		if(strlen($sal1)>0)
		{
		$sql .= "AND e_salary >= '".$sal1."'";
		}
	
		if(strlen($sal2) > 0) {
				$sql .= "AND e_salary <= '".$sal2."'" ;
		}
		
		
		$res=mysql_query($sql) or  die($sql."<br/>".mysql_error());

$numberrow=mysql_num_rows($res);
if($numberrow==0)
{
echo "no record found";
}
else
{
echo "<table border='1' style='margin-left:-600px'>
<tr>
<th>First Name</th>
<th>Last Name</th>
<th>UserName</th>
<th>Address</th>
<th>City</th>
<th>Zip</th>
<th>Contact</th>
<th>Email</th>
<th>Date of Birth</th>
<th>Age</th>
<th>Gender</th>
<th>Start Date</th>
<th>Position</th>
<th>Salary</th>
</tr>";

while($row1 = mysql_fetch_array($res)) {

  echo "<tr>";
  //echo $row1['p_name'];
  echo "<td>" . $row1['e_fname'] . "</td>";
  echo "<td>" . $row1['e_lname'] . "</td>";
  echo "<td>" . $row1['e_username'] . "</td>";
  echo "<td>" . $row1['e_address'] . "</td>";
  echo "<td>" . $row1['e_city'] . "</td>";
  echo "<td>" . $row1['e_zip'] . "</td>";
  echo "<td>" . $row1['e_contact'] . "</td>";
  echo "<td>" . $row1['e_email'] . "</td>";
  echo "<td>" . $row1['e_dob'] . "</td>";
  echo "<td>" . $row1['e_age'] . "</td>";
  echo "<td>" . $row1['e_gender'] . "</td>";
  echo "<td>" . $row1['e_startdate'] . "</td>";
  echo "<td>" . $row1['e_position'] . "</td>";
  echo "<td>" . $row1['e_salary'] . "</td>";
  echo "</tr>";
}
echo "</table>";


mysql_close();

}
}
else
{
$q = $_GET['name2'];
//echo "$q";
$con=mysql_connect('cs-server.usc.edu:50422','root','MOMDAD@05');
if(!$con)
{
die ("cannot connect");
}
mysql_select_db('bakery_database');

$query="select * from users where e_position= '".$q."'";
$result = mysql_query($query);

echo "<table border='1' style='margin-left:-600px'>
<tr>
<th>First Name</th>
<th>Last Name</th>
<th>UserName</th>
<th>Address</th>
<th>City</th>
<th>Zip</th>
<th>Contact</th>
<th>Email</th>
<th>Date of Birth</th>
<th>Age</th>
<th>Gender</th>
<th>Start Date</th>
<th>Position</th>
<th>Salary</th>
</tr>";

while($row1 = mysql_fetch_array($result)) {

  echo "<tr>";
  //echo $row1['p_name'];
  echo "<td>" . $row1['e_fname'] . "</td>";
  echo "<td>" . $row1['e_lname'] . "</td>";
  echo "<td>" . $row1['e_username'] . "</td>";
  echo "<td>" . $row1['e_address'] . "</td>";
  echo "<td>" . $row1['e_city'] . "</td>";
  echo "<td>" . $row1['e_zip'] . "</td>";
  echo "<td>" . $row1['e_contact'] . "</td>";
  echo "<td>" . $row1['e_email'] . "</td>";
  echo "<td>" . $row1['e_dob'] . "</td>";
  echo "<td>" . $row1['e_age'] . "</td>";
  echo "<td>" . $row1['e_gender'] . "</td>";
  echo "<td>" . $row1['e_startdate'] . "</td>";
  echo "<td>" . $row1['e_position'] . "</td>";
  echo "<td>" . $row1['e_salary'] . "</td>";
  echo "</tr>";
}
echo "</table><br/><br/>";


mysql_close($con);

}

echo "<a href='managernew.php'>Go Back</a>";
echo "<br/>";
echo "<a href='ViewEmployeeReport.php'>Cancel</a>";
?>
