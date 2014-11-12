<?php
if(isset($_SESSION['username']) && isset($_SESSION['position']) && isset($_SESSION['timeout']))
{
$inactive=30;
$t=time();
if(($t-$_SESSION['timeout']) > $inactive) {
header("Location:logout.php"); 
}
}
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
margin-left:250px;

}
#LoginCred{
display:Block;
}
input
{
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
width:300px;
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
}
#addemployee
{
appearance:button;
width:250px;
height:200px;
background-color:#9DB2B1;
-webkit-border-radius:5px;
margin-left:125px;
z-index:999999;
display:inline-block;
}
a:link
{
color:#FF6600;
text-decoration:none;
}
</style>
</head>
<body>
<a href="logout.php" style="margin-left:1000px;font-size:12pt">LogOut</a>
<div id="LoginPage">
<div id="Header">
<h3 style="font-family:'Times New Roman';font-size:26pt;color:#FF6600">Select Some Action</h3>
</div><br/><br/>
<form name="administrator" method="post" action="add_Employee.php">
<div id="addemployee" style="display:inline-block">
<img src="add-person-icon.png" style="display:block"/>
<!--<h3 style="align:center;position:absolute;margin-left:35px;margin-top:35px;color:#FF6600">
<a href="add_Employee.php">ADD EMPLOYEE</a></h3>-->
<input type="Submit" name="Add_Employee" id="Signin" value="Add Employee" style="margin-left:75px;margin-top:20px;width:120px"/>
</div>
</form>
<form name="administrator" method="post" action="delete_Employee.php">
<div id="addemployee">
<img src="change-user.png" style="display:block"/>
<!--<h3 style="align:center;position:absolute;margin-left:35px;margin-top:35px;color:#FF6600">
<a href="add_Employee.html">UPDATE EMPLOYEE</a></h3>-->
<input type="Submit" name="Update_Employee" id="Signin" value="Update Employee" style="margin-left:75px;margin-top:20px;width:120px"/>
<input type="hidden" name="update" value="update1"/>
</div>

<br/><br/><br/><br/>
</form>
<form name="administrator" method="post" action="delete_Employee.php">
<div id="addemployee" style="margin-left:500px;margin-top:-490px">
<img src="delete_user.jpg" style="display:block"/>
<!--<h3 style="align:center;position:absolute;margin-left:35px;margin-top:35px;color:#FF6600"><a href="delete_Employee.php">DELETE EMPLOYEE</a></h3>-->
<input type="Submit" name="Delete_Employee" id="Signin" value="Delete Employee" style="margin-left:75px;margin-top:20px;width:120px"/>
<input type="hidden" name="delete" value="delete1"/>

</div>
</form>
<form name="administrator" action="viewEmployee.php">
<div id="addemployee" style="margin-left:500px;margin-top:-280px">
<img src="view_profile.jpg" style="display:block"/>
<!--<h3 style="align:center;position:absolute;margin-left:35px;margin-top:100px;color:#FF6600">VIEW YOUR PROFILE</h3>-->
<input type="Submit" name="View My Profile" id="Signin" value="View My Profile" style="margin-left:75px;margin-top:20px;width:120px"/>
</div>
</form>

</body>
</html>
