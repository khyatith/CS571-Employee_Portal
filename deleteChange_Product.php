<?php
session_start();


if(isset($_POST['SubmitCheck']))
{
//if form has been submitted. check the values
error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);

$cakename=$_POST['search_name'];

$cakefromprice=$_POST['search_fromprice'];

//$cakeshape=$_POST['search_cakeshape'];
$cakecategory=$_POST['search_category'];



if(strlen($cakename)==0 && strlen($cakefromprice)==0 && strlen($cakecategory)==0)
{
require 'predeleteChange_Product.html';
$errormessage="Please Fill atleast 1 field";
echo "<html>";
echo "<body>";
echo "<h3 style='font-size:18pt;color:#CC0000;margin-left:500px'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
require 'postdeleteChange_Product.php';
}
else if(preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$cakename) || preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$cakecategory) || preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$cakefromprice))
{
require 'predeleteChange_Product.html';
$errormessage="Invalid Details";
echo "<html>";
echo "<body>";
echo "<h3 style='font-size:18pt;color:#CC0000;margin-left:500px'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
require 'postdeleteChange_Product.php';
}
else
{

$con=mysql_connect("cs-server.usc.edu:50422","root","MOMDAD@05");
if(!$con)
{
die ("cannot connect");
}
mysql_select_db('bakery_database',$con);
if(!empty($cakecategory))
{
//echo "$cakecategory";
$query1="select pc_id from productcategories where pc_name='$cakecategory'";
$res1=mysql_query($query1);

if($row1=mysql_fetch_array($res1))
{ 
$cakecat="$row1[0]";
//echo "$cakecat";
}
}


$cakename1= trim($cakename);
$query="Select * from products where 1";

if (strlen($cakename1)>0) {
    $query .= " AND p_name='$cakename1'";
	
}

if ($cakefromprice!="") {
    $query .= " AND p_price >= '$cakefromprice'";
	//echo "$cakefromprice";
}
if($cakecategory!="")
{
$query .= " AND pc_id = '$row1[0]'";
//echo "$cakecat";
}



$res=mysql_query($query);
//echo "$res";
if (!$res) {
    die("Error: ".mysql_error()); 
}
$numberow=mysql_num_rows($res);


if(($_SESSION['delete']) != '')
  {
  
echo "<html><body><form method='post' action='delete_product.php'>'<table style='border: solid 2px #ffffff;margin-left:-10px;font-size:12px'><tr><td></td><td>Cake Name</td><td>Cake Price</td><td>Expiry Date</td><td>Flavour</td><td>Frosting</td><td>Filling</td><td>Cake Size</td><td>Description</td><td>Image</td></tr>";
require 'delete_product.php';
while($row=mysql_fetch_assoc($res))
{//echo ("hi");
 
 echo "<tr><td><input type='checkbox' name='del[]' value=".$row['p_id']." style='width:15px;height:15px'/></td><td>" .$row['p_name']."</td><td>" .$row['p_price']."</td><td>" .$row['p_expirydate']."</td><td>" .$row['p_flavours']."</td><td>".$row['p_frosting']."</td><td>".$row['p_filling']."</td><td>".$row['p_cakesize']."</td><td>".$row['p_description']."</td><td>".$row['p_image']."</td></tr>";  
	
	}
	
	
	echo "</table><input type='submit' name='dele' value='Delete Product' style='width:200px' id='signin'/></form>";
	echo "<form method='post' action='salesManager.php'></table><input type='submit' name='Back' value='Back' style='width:200px' id='signin'/></form></body></html>";

	}
	
	else
	{
	
	require 'UpdateProduct.php';
	echo "<html><body><form action='UpdateProduct2.php' method='post'><table style='border: solid 2px #ffffff;margin-left:-10px;font-size:12px'><tr><td>Cake Name</td><td></td><td>Cake Price</td><td>Expiry Date</td><td>Flavours</td><td>Frosting</td><td>Filling</td><td>Cakesize</td><td>Description</td><td>Image</td></tr>";
	while($row=mysql_fetch_assoc($res))
	{
	echo "<tr><td><input type='radio' name='Updatecake' value=".$row['p_id']." style='width:15px;height:15px'/></td><td>" .$row['p_name']."</td><td>" .$row['p_price']."</td><td>" .$row['p_expirydate']."</td><td>" .$row['p_flavours']."</td><td>".$row['p_frosting']."</td><td>".$row['p_filling']."</td><td>".$row['p_cakesize']."</td><td>".$row['p_description']."</td><td>".$row['p_image']."</td></tr>";  
	
	}

echo "</form></table><input type='submit' name='update' value='Update Product Details' style='width:200px' id='signin'/></form>";
echo "<form method='post' action='salesManager.php'></table><input type='submit' name='Back' value='Back' style='width:200px' id='signin'/></form></body></html>";
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
margin-left:500px;

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
$_SESSION['change'] = '';
?>
<div id="Header">
<h3 style="font-family:'Times New Roman';font-size:26pt;color:#FF9900">SEARCH PRODUCT</h3>
</div>

<br/><br/><br/><br/>
<?php
}
else if(isset($_POST['change']))
{

$_SESSION['change']=$_POST['change'];
$_SESSION['delete'] = '';

?>
<div id="Header">
<h3 style="font-family:'Times New Roman';font-size:26pt;color:#FF9900">SEARCH PRODUCT</h3>
</div>
<br/><br/><br/><br/>
<?php
}
?>
<form action="deleteChange_Product.php" method="post">
<table>
<tr>

<td><input type="text" name="search_name" placeholder="Cake Name"/></td>

<td><input type="text" name="search_fromprice" placeholder="Search By Cake Price"/></td>
<!--<td><input type="text" name="search_toprice" placeholder="To"/></td>-->
</tr>



<tr>
<td><input type="text" name="search_category" placeholder="Search By Cake Category"/></td>
</tr>
</table>
<input type="submit" name="Sign" id="Signin" value="Search"/>

<input type="hidden" name="SubmitCheck" value="sent"/>
</form>
<form method="post" action="salesManager.php"><input type="submit" name="Back"  id="Signin" value="Back To Home Page"/>
</form>
</body>
</html>
<?php
}
?>