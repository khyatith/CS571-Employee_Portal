<?php
session_start();
//error_reporting(E_ALL ^ E_DEPRECATED);

/*if(isset($_SESSION['username']) && isset($_SESSION['position']) && isset($_SESSION['timeout']))
{
$inactive=10;
$t=time();
if(($t-$_SESSION['timeout']) > $inactive) {
header("Location:logout.php"); 
}
} */



?>


<html>
<head>
<script>

function showEmployee()
{
var emp1=document.getElementById("search1").value;
var emp2=document.getElementById("fromsal").value;
var emp3=document.getElementById("tosal").value;
//str4=document.getElementById("h5").value;
//str=document.getElementById('h5').value;

var data1="?name2="+emp1;
data1+="&fromsalary="+emp2+"&tosalary="+emp3;

if (emp1=="---select an Employee type--") {
    document.getElementById("sometext").innerHTML="";
    return;
	
  } 


  var xmlhttp;
if(window.XMLHttpRequest)
{
xmlhttp= new XMLHttpRequest();

}
else
{
xmlhttp= new ActiveXObject("Microsoft.XMLHttp");
}
if(emp2!="" || emp3!="")

{
xmlhttp.open("GET","viewEmployeeReport1.php?"+data1,true);

}
else
{ 
xmlhttp.open("GET","viewEmployeeReport1.php?name2="+emp1,true);
}
xmlhttp.send();
xmlhttp.onreadystatechange=handleReply;
function handleReply()

{

if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("sometext1").innerHTML=xmlhttp.responseText;
    }
}

}




</script>
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
width:200px;
height:30px;
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
}

table
{
align:center;
margin-left:150px;
cellspacing:50px;
margin-top:80px;

}
td
{
font-family:'Times New Roman','serif';
font-size:16pt;
font-weight:bold;
color:#FF9900;
padding:10;
}

</style>

</head>
<body>
<a href="logout.php" style="margin-left:1000px;font-size:12pt">LogOut</a>
<a href="managernew.php" style="margin-left:1000px;font-size:12pt">Go Back</a>
<div id="LoginPage">
<!--<img src='lutz-cafe.gif' style="display:inline;margin-right:20px"/>-->
<div id="Header">
<h3 style="font-family:'Times New Roman';font-size:26pt;color:#FF9900">Search Employees</h3>
</div>
<form name="form2">
<table>
<tr>
<td>
<select id="search1" onchange="showEmployee()">
<option value="">---select an Employee type--</option>
<option value="Sales Manager">Sales Manager</option>
<option value="Administrator">Administrator</option>
<option value="Manager">Manager</option>
</select>
</td>
<td>
<input type="text" value="" id="fromsal" placeholder="Salary starting from" />
</td>
<td>
<input type="text" value="" id="tosal" placeholder="To Salary" />
</td>
<td><input type="button" name="SearchEmployeeReport" id="Signin" value="Search" onclick="showEmployee()"/></td>
</tr>

</table>
<div id="sometext1" style="margin-left:400px"><b>Employee info will be listed here.</b></div>
</form>

</body>
</html>