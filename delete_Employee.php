<?php

session_start();

if(isset($_SESSION['username']) && isset($_SESSION['position']) && isset($_SESSION['timeout']))
{
$inactive=30;
$t=time();
if(($t-$_SESSION['timeout']) > $inactive) {
header("Location:logout.php"); 
}
}

if(isset($_POST['SubmitCheck']))
{
//if form has been submitted. check the values
error_reporting(E_ALL ^ E_DEPRECATED);
$firstname=$_POST['search_fname'];
$lastname=$_POST['search_lname'];
$username=$_POST['search_username'];



if(isset($_POST['search_designation']))
{
if($_POST['search_designation']=='Manager')
{
$designation="Manager";
}
else if($_POST['search_designation']=='Sales Manager')
{
$designation="Sales Manager";
}
else if($_POST['search_designation']=='Administrator') 
{
$designation="administrator";
}
}
else
{
$designation="";
}

if(strlen($firstname)==0 && strlen($lastname)==0 && strlen($username)==0 && $designation=="")
{
require 'predelete_Employee.html';
$errormessage="Please Fill atleast 1 field";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";

require 'postdelete_Employee.html';
}
else if(preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$firstname) || preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$lastname) ||preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$username))
{
require 'predelete_Employee.html';
$errormessage="Invalid Details";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";

require 'postdelete_Employee.html';
}
else
{
$query="Select * from users where 1";
if (!empty($firstname)) {
    $query .= " AND e_fname = '$firstname'";
}

if (!empty($lastname)) {
    $query .= " AND e_lname = '$lastname'";
}
if (!empty($designation)) {
    $query .= " AND e_position = '$designation'";
}
if (!empty($username)) {
    $query .= " AND e_username = '$username'";
}
$con=mysql_connect("cs-server.usc.edu:50422","root","MOMDAD@05");
if(!$con)
{
die ("cannot connect");
}
mysql_select_db('bakery_database',$con);
$res=mysql_query($query);
$result=mysql_num_rows($res);


//require 'changeEmployee.php';
//echo "<html><body><table style='border: solid 2px #ffffff;margin-left:-10px;font-size:12px'><tr><td></td><td>First Name</td><td>Last Name</td><td>UserName</td><td>Street Address</td><td>City</td><td>Zip</td><td>Contact</td><td>E-mail</td><td>Date of Birth</td><td>Age</td><td>Gender</td><td>StartDate</td><td>Position</td><td>Annual Salary</td></tr>";
//echo $_SESSION['update'];
if(($_SESSION['delete']) != '')
  {
  
echo "<html><body><form method='post' action='changeEmployee.php'>'<table style='border: solid 2px #ffffff;margin-left:-10px;font-size:12px'><tr><td></td><td>Employee ID</td><td>First Name</td><td>Last Name</td><td>UserName</td><td>Street Address</td><td>City</td><td>Zip</td><td>Contact</td><td>E-mail</td><td>Date of Birth</td><td>Age</td><td>Gender</td><td>StartDate</td><td>Position</td><td>Annual Salary</td></tr>";
require 'changeEmployee.php';
while($row=mysql_fetch_assoc($res))
{
 
 echo "<tr><td><input type='checkbox' name='del[]' value=".$row['e_id']." style='width:15px;height:15px'/></td><td>" .$row['e_id']."</td><td>" .$row['e_fname']."</td><td>" .$row['e_lname']."</td><td>" .$row['e_username']."</td><td>" .$row['e_address']."</td><td>".$row['e_city']."</td><td>".$row['e_zip']."</td><td>".$row['e_contact']."</td><td>".$row['e_email']."</td><td>".$row['e_dob']."</td><td>" .$row['e_age']."</td><td>" .$row['e_gender']."</td><td>" .$row['e_startdate']."</td><td>" .$row['e_position'] ."</td><td>" .$row['e_salary']."</td></tr>";  
	
	}
	
	
	echo "</table><input type='submit' name='dele' value='Delete Employee Details' style='width:200px' id='signin'/></form></body></html>";
	echo "<form action='administrator.php' method='post'><input type='submit' name='Back' value='Back' style='width:200px' id='signin'/></body></html>";

	}
	
	
	else
	{
	
	require 'updateEmployee.php';
	echo "<html><body><form action='add_Employee.php' method='post'><table style='border: solid 2px #ffffff;margin-left:-10px;font-size:12px'><tr><td></td><td>First Name</td><td>Last Name</td><td>UserName</td><td>Street Address</td><td>City</td><td>Zip</td><td>Contact</td><td>E-mail</td><td>Date of Birth</td><td>Age</td><td>Gender</td><td>StartDate</td><td>Position</td><td>Annual Salary</td></tr>";
	while($row=mysql_fetch_assoc($res))
	{
	echo "<tr><td><input type='radio' name='Change' value=" .$row['e_id']." style='width:15px;height:15px'/></td><td>" .$row['e_fname']."</td><td>" .$row['e_lname']."</td><td>" .$row['e_username']."</td><td>" .$row['e_address']."</td><td>".$row['e_city']."</td><td>".$row['e_zip']."</td><td>".$row['e_contact']."</td><td>".$row['e_email']."</td><td>".$row['e_dob']."</td><td>" .$row['e_age']."</td><td>" .$row['e_gender']."</td><td>" .$row['e_startdate']."</td><td>" .$row['e_position'] ."</td><td>" .$row['e_salary']."</td></tr>";  
	
	
	}

echo "</form></table><input type='submit' name='update' value='Update Employee Details' style='width:200px' id='signin'/>";
echo "<form method='post' action='administrator.php'><input type='submit' name='Sign' id='Signin' style='width:200px;margin-left:625px' value='Back To Home'/></form></body></html>";

}





/*$row['e_fname'];
$row['e_username'];
$row['e_address'];
$row['e_city'];
$row['e_zip'];
$row['e_contact'];
$row['e_email'];
$row['e_dob'];
$row['e_age'];
$row['e_gender'];
$row['e_startdate'];
$row['e_salary'];*/




}


/*if(!($row=mysql_fetch_array($res)))
{
$errormessage='No rows selected';
echo "$errormessage";
}
else if(!$res)
{
echo "nothing";
}
*/
/*if(!($row=mysql_fetch_array($res)))
{
die(mysql_error());
}
else if(!$res)
{
$errormessage='Cannot process request';
echo "$errormessage";
}*/

}
else
{


?>
<html>
<head>
<style>

body{
background-color:#CCFFFF;
}
#LoginPage
{
float:center;
width:900px;
display:block;
margin:0 auto;
}
#Header{
width:400px;
height:50px;
float:center;
colour:#0099CC;
text-align:center;
margin-left:500px;

}
#LoginCred{
display:Block;
}
input
{
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
width:200px;
height:45px;

}

.default ::-webkit-input-placeholder { 
font-size: 14pt; 
font-family:'Times New Roman',serif;
}
#Signin
{
appearance:button;
 -webkit-border-radius: 5px;
 background-color:#ff9900;
 width:100px;
 height:35px;
color:#ffffff;
font-weight:bold;
margin-left:630px;
margin-top:30px;
}
table
{
align:center;
margin-left:200px;

}
td
{
font-family:'Times New Roman','serif';
font-size:16pt;
font-weight:bold;
color:#FF9900;
width:200px;

}
</style>
</head>
<body>
<a href="logout.php" style="margin-left:1000px;font-size:12pt">LogOut</a>
<?php



if(isset($_POST['delete']))
{

$_SESSION['delete'] = $_POST['delete'];
$_SESSION['update'] = '';

?>
<div id="Header">
<h3 style="font-family:'Times New Roman';font-size:26pt;color:#FF9900">DELETE EMPLOYEE</h3>
</div>

<br/><br/><br/><br/>
<?php
}
else if(isset($_POST['update']))
{

$_SESSION['update']=$_POST['update'];
$_SESSION['delete'] = '';
?>
<div id="Header">
<h3 style="font-family:'Times New Roman';font-size:26pt;color:#FF9900">UPDATE EMPLOYEE</h3>
</div>

<br/><br/><br/><br/>
<?php
}
?>
<form action="delete_Employee.php" method="post">
<table>
<tr>
<td>Search By Name</td>
<td><input type="text" name="search_fname" placeholder="First Name"/></td>
<td><input type="text" name="search_lname" placeholder="Last Name"/></td>
<td><input type="text" name="search_username" placeholder="userName"/></td>
</tr>
</table>
<br/><br/>
<table>
<tr>
<td>Search By Designation</td>
<td><input type="radio" name="search_designation" value="Manager" style="width:20px;height:20px"/>Manager</td>
<td><input type="radio" name="search_designation" value="Sales Manager" style="width:20px;height:20px"/>Sales Manager</td>
<td><input type="radio" name="search_designation" value="Administrator" style="width:20px;height:20px"/>Administrator</td>
</tr>
</table>
<input type="submit" name="Sign" id="Signin" value="Search"/>

<input type="hidden" name="SubmitCheck" value="sent"/>
</form>
<form method="post" action="administrator.php">
<input type="submit" name="Sign" id="Signin" style="width:200px;margin-left:600px" value="Back To Home"/>
</form>
</body>
</html>
<?php
}
?>
