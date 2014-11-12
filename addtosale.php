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


if(isset($_POST['SubmitCheckSale'])) {
//if form has been submitted. check the values
error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);
$productname=$_POST['productname'];
$salestartdate=$_POST['salestartdate'];
$saleenddate=$_POST['saleenddate'];
$newsaleprice=$_POST['newsaleprice'];

$d=strtotime($salestartdate);
$d1=strtotime($saleenddate);
$today=getdate();


//VALIDATIONS

if(strlen($productname)==0 || strlen($salestartdate)==0 || strlen($saleenddate)==0 || strlen($newsaleprice)==0)
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
else if((preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$productname)) || !preg_match("/^[a-zA-Z ]*$/",$productname))
{
$errormessage="Invalid Cake Name";

echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:500px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if(preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$salestartdate))
{
$errormessage="Invalid Sale Start Date";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:500px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if(preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$saleenddate))
{
$errormessage="Invalid Sale End Date";

echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:500px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if((preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$newsaleprice)) || preg_match("/^[a-zA-Z ]*$/",$newsaleprice))
{
$errormessage="Invalid Sale Price";

echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:500px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}

else if($d['mon']>12 || $d['day']>31 || $d1['mon']>12 || $d1['day']>31)
{
$errormessage="One of the dates is Invalid";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
/*else if($today['year']>$d['year'])
{
$errormessage="Invalid year in date";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}*/
else if($today['year']==$d['year'] && $today['mon']>$d['month'])
{
 $errormessage="Invalid month of year";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if($today['year']==$d['year'] && $today['mon']==$d['month'] && $today['mday']>$d['day'])
{
$errormessage="Invalid Day of Month";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
/*else if($today['year']>$d1['year'])
{
$errormessage="Invalid year in end date";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}*/
else if($today['year']==$d1['year'] && $today['mon']>$d1['month'])
{
 $errormessage="Invalid month of year in end date";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if($today['year']==$d1['year'] && $today['mon']==$d1['month'] && $today['mday']>$d1['day'])
{
$errormessage="Invalid Day of Month in end date";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if($d['year']>$d1['year'])
{
$errormessage="Invalid start and end date";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if($d['year']==$d1['year'] && $d['mon']>$d1['month'])
{
 $errormessage="Invalid start and end date";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if($d['year']==$d1['year'] && $d['mon']==$d1['month'] && $d['mday']>$d1['day'])
{
$errormessage="Invalid Day of Month in start and end date";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
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

$query="Select p_id,p_price from products where p_name= '$productname'";
$res=mysql_query($query);
if($row1=mysql_fetch_array($res))
{
$productid=$row1['p_id'];
//echo "$productid";
$productprice=$row1['p_price'];
}
else{
$errormessage="Product Not Available ";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
if($newsaleprice > $productprice * 0.8)
{
$errormessage="Sale product price should be atleast 20% discounted";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else
{
$sql="INSERT INTO specialsales(p_id,ss_startdate,ss_enddate,ss_price) VALUES ('$productid','$salestartdate','$saleenddate','$newsaleprice')";

$retval = mysql_query( $sql, $con );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
else
{
$errormessage="Data Entered Successfully";
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
table
{
margin-left:600px;
align:center;


}
td
{
font-family:'Times New Roman','serif';
font-size:16pt;
font-weight:bold;
color:#FF9900;
width:200px;
height:50px;
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
 width:200px;
 height:35px;
color:#ffffff;
font-weight:bold;
margin-left:50px;
margin-top:20px;
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
a:link
{
color:#FF6600;
text-decoration:none;
}
</style>
</head>
<body>
<a href="logout.php" style="margin-left:1000px;font-size:12pt">LogOut</a>
<div id="Header">
<h3 style="font-family:'Times New Roman';font-size:26pt;color:#FF9900;width:700px;margin-left:150px">ADD TO SALE</h3>
</div><br/><br/><br/><br/><br/><br/><br/><br/>
<form action="addtosale.php" method="post">
<table>
<tr>
<td>Product Name<input type="text" value="<?php echo isset($productname) ? $productname: ''; ?>" name="productname"/></td>
</tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr>
<td>Sale Start Date<input type="text" value="<?php echo isset($salestartdate) ? $salestartdate: ''; ?>" name="salestartdate" placeholder="YYYY/MM/DD"/></td>
</tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr>
<td>Sale End Date<input type="text" value="<?php echo isset($saleenddate) ? $saleenddate: ''; ?>" name="saleenddate" placeholder="YYYY/MM/DD"/></td>
</tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr>
<td>New Price<input type="text" value="<?php echo isset($newsaleprice) ? $newsaleprice: ''; ?>" name="newsaleprice"/></td>
</tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr>
<td><input type="submit" id="Signin" name="addsaleproduct" value="Add"/></td>
<td><input type="hidden" name="SubmitCheckSale" value="sent"/></td>
</tr>
</table>
</form>
<form method="post" action="salesManager.php">
<input type="submit" id="Signin" name="back" style="margin-left:655px" value="Back"/>
</form>
</body>
</html>

