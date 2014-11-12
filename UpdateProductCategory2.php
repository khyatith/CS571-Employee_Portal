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

error_reporting(E_ALL ^ E_DEPRECATED ^ E_WARNING ^ E_NOTICE );
$PCID=$_POST['UpPC'];
//echo "$PCID";
$con=mysql_connect("cs-server.usc.edu:50422","root","MOMDAD@05");
if(!$con)
{
die ("cannot connect");
}
mysql_select_db('bakery_database');

$sql="SELECT * from productcategories where pc_id= '$PCID' ";
$res=mysql_query($sql);
if($row=mysql_fetch_assoc($res))
{
$fetchpcname=$row['pc_name'];
$fetchpcdescription=$row['pc_description'];
$fetchpcimage=$row['pc_image'];

}
$con=mysql_connect("cs-server.usc.edu:50422","root","MOMDAD@05");
if(!$con)
{
die ("cannot connect");
}
mysql_select_db('bakery_database');
$productcategory_ID=$row['pc_id'];
$pcname=$_POST['updatepcname'];
$pcdescription=$_POST['updatepcdescription'];
$pcimage=$_POST['updatepcimage'];

if(isset($_POST['UpdateProductCategory']))
{
if(strlen($pcname)==0 || strlen($pcdescription)==0 || strlen($pcimage)==0)
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
else if(preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$fetchpcname) || !preg_match("/^[a-zA-Z ]*$/",$fetchpcname))
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
else if(preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$fetchpcdescription)|| !preg_match("/^[a-zA-Z ]*$/",$fetchpcdescription))
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
else if(preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$fetchpcimage) || !preg_match("/^[a-zA-Z ]*$/",$fetchpcimage))
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

/*update specialsales SET ss_startdate='$ss_startdate',ss_enddate='$ss_enddate',ss_price='$ss_newprice' where ss_id='".$_POST['SubmitSaleUpdate']."'";*/
$sql1="UPDATE productcategories set pc_name='$pcname',pc_description='$pcdescription',pc_image='$pcimage' where pc_id= ' " .$_POST['UpdateProductCategory'] . "'";

$retval = mysql_query( $sql1, $con );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
else
{
$errormessage="product Category Updated Successfully";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
mysql_close($con);
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
width:600px;
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
 width:150px;
 height:35px;
color:#ffffff;
font-weight:bold;
margin-left:35px;
margin-top:50px;
}
table
{
align:center;
margin-left:600px;
margin-top:20px;
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
<form name="addpcform" method="post" action="UpdateProductCategory2.php">
<div id="Header">
<h3 style="font-family:'Times New Roman';font-size:26pt;color:#FF9900">UPDATE PRODUCT CATEGORY</h3>
</div>
<table>
<tr>
<td><input type="text" name="updatepcname" value="<?php echo isset($fetchpcname) ? $fetchpcname: $pcname; ?>"  /></td>
</tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr>
<td><input type="textarea" name="updatepcdescription" value="<?php echo isset($fetchpcdescription) ? $fetchpcdescription: $pcdescription; ?>"  /></td>
</tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr>
<td><input type="text" name="updatepcimage" value="<?php echo isset($fetchpcimage) ? $fetchpcimage: $pcimage; ?>"  /></td>
</tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr>
<td><input type="submit" id="Signin" name="updateproductcategory1" value="Update"/></td>
<td><input type="hidden" name="UpdateProductCategory" value='<?php echo  $_POST['UpPC'] ;?>'/></td>
</tr>
</table>
</form>
<form name="goback" action="salesManager.php" method="post">

<input type="submit" name="back" value="Back To Home Page" id="Signin" style="margin-left:640px" />



</form>
</body>
</html>
