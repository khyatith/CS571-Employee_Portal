<?php

session_start();
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['position']) && isset($_SESSION['timeout']))
{
$inactive=600;
$t=time();
if(($t-$_SESSION['timeout']) > $inactive) {
header("Location:logout.php"); 
}
}



error_reporting(E_ALL ^ E_DEPRECATED ^ E_WARNING ^ E_NOTICE);
if(isset($_POST['SubmitCheckPC']))
{
$pcname=$_POST['Categoryname'];

//VALIDATIONS
if(strlen($pcname)==0)
{
$errormessage="Please Enter a Product Category";
require 'errproductcategory.html';
echo "<h3 style='align:center;font-size:18pt;margin-left:500px;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
require 'errproductcategory2.html';

}
else if(preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$pcname) || preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$pcname))
{
$errormessage="Invalid Product Category Name";
require 'predeletePC.html';
echo "<h3 style='align:center;margin-left:500px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
//echo 'errproductcategory2.html' ;
}
else
{
$con=mysql_connect("cs-server.usc.edu:50422","root","MOMDAD@05");
if(!$con)
{
die ("cannot connect");
}
mysql_select_db('bakery_database',$con);

$query="Select * from productcategories where pc_name=trim('$pcname') ";
$result=mysql_query($query);
$numrow=mysql_num_rows($result);
/*if($numrow==0)
{
$errormessage="Invalid Product Category Name";
require 'errproductcategory.html';
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:500px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
//require 'errproductcategory2.html';
}*/


if(($_SESSION['deletePC']) != '')
  {
  
echo "<html><body><form method='post' action='delete_productcategory.php'>'<table style='border: solid 2px #ffffff;margin-left:200px;font-size:12px'><tr><td></td><td>Product Category</td><td>Category Description</td><td>Image</td></tr>";
require 'delete_productcategory.php';
while($row1=mysql_fetch_array($result))
{
 
 echo "<tr><td><input type='checkbox' name='delPC[]' value=".$row1['pc_id']." style='width:15px;height:15px'/></td><td>" .$row1['pc_name']."</td><td>" .$row1['pc_description']."</td><td>" .$row1['pc_image']."</td></tr>";  
	echo "</form></table><input type='submit' name='delePC' value='Delete Product' style='width:200px' id='signin'/>";
	}
	
	echo "<form method='post' action='salesManager.php'><input type='submit' name='Back' value='Back To home Page' style='width:200px' id='signin'/></form></body></html>";
	}
	
	else 
	{
	
	require 'update_productcategory.php';
	echo "<html><body><form action='UpdateProductCategory2.php' method='post'><table style='border: solid 2px #ffffff;margin-left:200px;font-size:12px'><tr><td></td><td>Category Name</td><td>Category Description</td><td>Image</td></tr>";
	while($row1=mysql_fetch_assoc($result))
	{
	echo "<tr><td><input type='radio' name='UpPC' value=".$row1['pc_id']." style='width:15px;height:15px'/></td><td>" .$row1['pc_name']."</td><td>" .$row1['pc_description']."</td><td>" .$row1['pc_image']."</td></tr>";  
	
	}

echo "</form></table><input type='submit' name='update' value='Update Product Details' style='width:200px' id='signin'/>";
echo "<form method='post' action='salesManager.php'><input type='submit' name='Back' value='Back To home Page' style='width:200px' id='signin'/></form></body></html>";
}
	

	
	
	
}


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
margin-left:600px;
margin-top:100px;

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
if(isset($_POST['deletePC']))
{

$_SESSION['deletePC'] = $_POST['deletePC'];
$_SESSION['ModifyPC'] = '';
?>
<div id="Header">
<h3 style="font-family:'Times New Roman';font-size:26pt;color:#FF9900">SEARCH PRODUCT CATEGORY</h3>
</div>

<br/><br/><br/><br/>
<?php
}
else if(isset($_POST['ModifyPC']))
{

$_SESSION['ModifyPC']=$_POST['ModifyPC'];
$_SESSION['deletePC'] = '';

?>
<div id="Header">
<h3 style="font-family:'Times New Roman';font-size:26pt;color:#FF9900">SEARCH PRODUCT CATEGORY</h3>
</div>
<br/><br/><br/><br/>
<?php
}
?>
<form action="deleteproductcategory.php" method="post">
<table>
<tr>
<td><input type="text" name="Categoryname"  value="<?php echo isset($pcname) ? $pcname: ''; ?>" placeholder="Product Category Name"/></td>
</tr>
</table>

<input type="submit" name="Sign" id="Signin" value="Search"/>
<input type="hidden" name="SubmitCheckPC" value="sent"/>
</form>
<form method="post" action="salesManager.php">
<input type="submit" name="Sign" id="Signin" value="Back To Home" style="width:200px;margin-left:600px"/>
</form>
</body>
</html>
<?php
}
?>