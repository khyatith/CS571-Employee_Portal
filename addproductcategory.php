<?php

session_start();
if(isset($_SESSION['username']) && isset($_SESSION['position']) && isset($_SESSION['timeout']))
{
$inactive=600;
$t=time();
if(($t-$_SESSION['timeout']) > $inactive) {
header("Location:logout.php"); 
}
}



error_reporting(E_ALL ^ E_DEPRECATED);


if(isset($_POST['SubmitCheckProductCategory'])) 

{
$productcategoryname=$_POST['newpcname'];
$productcategorydescription=$_POST['newpcdescription'];
$productcategoryimage=$_POST['newpcimage'];

//VALIDATIONS
if(strlen($productcategoryname)==0 || strlen($productcategorydescription)==0 || strlen($productcategoryimage)==0)
{
$errormessage="Please Fill all the Details";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;font-size:18pt;margin-left:500px;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if((preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$productcategoryname))  || !preg_match("/^[a-zA-Z ]*$/",$productcategoryname))
{
$errormessage="Invalid Product Category Name";

echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:500px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if((preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$productcategorydescription))  || !preg_match("/^[a-zA-Z ]*$/",$productcategorydescription))
{
$errormessage="Invalid Product Category Description";

echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:500px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if((preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$productcategoryimage)))
{
$errormessage="Invalid Image Link";

echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:500px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else
{

$con=mysql_connect("cs-server.usc.edu:50422","root","MOMDAD@05");
if(!$con)
{
die ("cannot connect");
}
mysql_select_db('bakery_database');


$sql="SELECT * from productcategories";

$result=mysql_query($sql);
$count=0;
while($row1=mysql_fetch_array($result))
{

if($row1['pc_name']==trim($productcategoryname))
{

$count++;
}

}
if($count==0)
{
$sql="INSERT INTO productcategories(pc_name,pc_description,pc_image) VALUES ('$productcategoryname','$productcategorydescription','$productcategoryimage')";

$retval = mysql_query( $sql, $con );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
else
{
$errormessage="product Category Entered Successfully";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:500px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
mysql_close($con);
}
}
else if($count>0)
{
$errormessage="product Category Already Exists";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:500px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";

}
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
width:700px;
height:50px;
float:center;
colour:#0099CC;
text-align:center;
margin-left:300px;

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
margin-left:50px;
margin-top:30px;
}
table
{
align:center;
margin-left:550px;
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
tr
{
margin-top:20px;
}
</style>
</head>
<body>
<a href="logout.php" style="margin-left:1000px;font-size:12pt">LogOut</a>
<form name="addpcform" method="post" action="addproductcategory.php">
<div id="Header">
<h3 style="font-family:'Times New Roman';font-size:26pt;color:#FF9900">ADD PRODUCT CATEGORY</h3>
</div>
<table>
<tr>
<td><input type="text" name="newpcname" value="<?php echo isset($productcategoryname) ? $productcategoryname: ''; ?>" placeholder="Category Name" /></td>
</tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr>
<td><input type="textarea" name="newpcdescription" value="<?php echo isset($productcategorydescription) ? $productcategorydescription: ''; ?>" placeholder="Category Description" /></td>
</tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr>
<td><input type="text" name="newpcimage" value="<?php echo isset($productcategoryimage) ? $productcategoryimage: ''; ?>" placeholder="Image Path" /></td>
</tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr>
<td><input type="submit" id="Signin" name="addcategoryproduct" value="Add"/></td>
<td><input type="hidden" name="SubmitCheckProductCategory" value="sent"/></td>
</tr>
</table>

</form>
<form method="post" action="salesManager.php">
<input type="submit" id="Signin" style="width:200px;margin-left:555px" name="Go Bakc" value="Back To Home Page"/>
</form>
</body>
</html>