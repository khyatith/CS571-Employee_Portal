<?php
//session_start();
if(isset($_SESSION['username']) && isset($_SESSION['position']) && isset($_SESSION['timeout']))
{
$inactive=30;
$t=time();
if(($t-$_SESSION['timeout']) > $inactive) {
header("Location:logout.php"); 
}
}

//$_SESSION['timeout'] = time();
?>


<!DOCTYPE html>
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
#Signin1
{
appearance:button;
 -webkit-border-radius: 5px;
 background-color:#CC0000;
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
}
</style>
</head>
<body>
<a href="logout.php" style="margin-left:1000px;font-size:12pt">LogOut</a>
<div id="LoginPage">
<div id="Header">
<h3 style="font-family:'Times New Roman';font-size:26pt;color:#FF9900">Select Some Action</h3>
</div><br/><br/>
<table style="margin-left:-100px">
<form name="manager" method="post" action="ViewOrderReport.php">
<td><input type="Submit" name="addPC" id="Signin1" value="View Detailed Order Report" style="margin-left:120px;margin-top:-400px;width:200px"/></td>
</form>
<form name="SalesManager" method="post" action="ViewOrderSalesReport.php">
<td><input type="Submit" name="deletePC" id="Signin1" value="View Orders from specialsales" style="margin-left:120px;margin-top:-400px;width:220px"/></td>
</form>
<form name="SalesManager" method="post" action="ViewOrderSummary.php">
<td><input type="Submit" name="ModifyPC" id="Signin1" value="View Orders Summary" style="margin-left:120px;margin-top:-400px;width:200px"/></td>
</form>
</table>
<br/><br/><br/>
<form name="manager" method="post" action="ViewEmployeeReport.php">
<div id="addemployee" style="display:inline-block">
<img src="employee_report1.jpg" style="display:block"/>
<!--<h3 style="align:center;position:absolute;margin-left:35px;margin-top:35px;color:#FF6600">
<a href="add_Employee.php">ADD EMPLOYEE</a></h3>-->
<input type="Submit" name="View_Employee" id="Signin" value="View Employee Report" style="margin-left:25px;margin-top:20px;width:200px"/>
</div>
</form>
<br/><br/><br/><br/>

<form name="manager" method="post" action="ViewproductReport.php">
<div id="addemployee" style="margin-top:-60px">
<img src="birthday-cake.png" style="display:block"/>
<!--<h3 style="align:center;position:absolute;margin-left:35px;margin-top:35px;color:#FF6600">
<a href="add_Employee.html">UPDATE EMPLOYEE</a></h3>-->
<input type="Submit" name="ViewReportProduct" id="Signin" value="View Product Report" style="margin-left:25px;margin-top:20px;width:200px"/>
<input type="hidden" name="PR" value="update1"/>
</div>

<br/><br/><br/><br/>
</form>

</form>
<form name="manager" method="post" action="ViewSalesReport.php">
<div id="addemployee" style="margin-left:500px;margin-top:-500px">
<img src="onsale.gif" style="display:block"/>
<!--<h3 style="align:center;position:absolute;margin-left:35px;margin-top:35px;color:#FF6600"><a href="delete_Employee.php">DELETE EMPLOYEE</a></h3>-->
<input type="Submit" name="ViewReportSales" id="Signin" value="View Sales Report" style="margin-left:25px;margin-top:20px;width:200px"/>
<input type="hidden" name="SR" value="delete1"/>

</div>
</form>
<!--<form name="manager" method="post" action="ViewOrderReport.php">
<div id="addemployee" style="margin-left:500px;margin-top:25px">
<img src="vieworder.jpg" style="display:block"/>
<!--<h3 style="align:center;position:absolute;margin-left:35px;margin-top:35px;color:#FF6600"><a href="delete_Employee.php">DELETE EMPLOYEE</a></h3>-->
<!--<input type="Submit" name="ViewReportOrders" id="Signin" value="View Detailed Order Report" style="margin-left:25px;margin-top:20px;width:200px"/>
<input type="hidden" name="OR" value="delete1"/>
</form>
<form method="post" action="ViewOrderSummary.php">
<input type="Submit" name="ViewOrderSummary" id="Signin" value="View Order Summary" style="margin-left:25px;margin-top:20px;width:200px"/>
<input type="hidden" name="Ordersummary" value="delete1"/>
</form>-->
</div>

</body>
</html>
