
<?php
if(isset($_SESSION['username']) && isset($_SESSION['position']) && isset($_SESSION['timeout']))
{
$inactive=600;
$t=time();
if(($t-$_SESSION['timeout']) > $inactive) {
header("Location:logout.php"); 
}
}

error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE ^ E_WARNING);

$specialsaleid=$_POST['modsale'];
//echo "$specialsaleid";

$con=mysql_connect("cs-server.usc.edu:50422","root","MOMDAD@05");
if(!$con)
{
 die (mysql_error());
}
mysql_select_db('bakery_database');

$sql="select * from specialsales where ss_id= $specialsaleid";
$res=mysql_query($sql);
if($row1=mysql_fetch_array($res))
{
$pid=$row1['p_id'];
$row1['ss_startdate'];
$row1['p_id'];
$row1['ss_enddate'];
$row1['ss_price'];
//echo "$pid";
$sql2="select p_name from products where p_id= $pid";
$res2=mysql_query($sql2);
if($row2=mysql_fetch_array($res2))
{
$name=$row2['p_name'];

}

}
$con=mysql_connect("cs-server.usc.edu:50422","root","MOMDAD@05");
if(!$con)
{
die ("cannot connect");
}
mysql_select_db('bakery_database');
$product_ID=$row1['p_id'];
$productname=$_POST['pdn'];
$ss_startdate=$_POST['ssd'];

$ss_enddate=$_POST['sen'];
$ss_newprice=$_POST['np'];
$d=strtotime($ss_startdate);
$d1=strtotime($ss_enddate);
$today=getdate();

if (isset($_POST['SubmitSaleUpdate']))
{
//VALIDATIONS

if(strlen($ss_startdate)==0 || strlen($ss_enddate)==0 || strlen($ss_newprice)==0)
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

else if(preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$ss_startdate))
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
else if(preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$ss_enddate))
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
else if(preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$ss_newprice) || is_nan($ss_newprice))
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
$sql1="update specialsales SET ss_startdate='$ss_startdate',ss_enddate='$ss_enddate',ss_price='$ss_newprice' where ss_id='".$_POST['SubmitSaleUpdate']."'";
$retval=mysql_query($sql1,$con);

if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
else
{
$errormessage="Update Successful";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
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
<div id="Header">
<h3 style="font-family:'Times New Roman';font-size:26pt;color:#FF9900;width:700px;margin-left:-80px">UPDATE SALE DETAILS</h3>
</div><br/><br/><br/><br/><br/><br/><br/><br/>
<form action="modify_sale.php" method="post">
<table>
<tr>
<td>Product Name<input type="text" value='<?php echo "$name" ; ?>' name="pdn" disabled /></td>
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
<td>Sale Start Date<input type="text" value="<?php echo isset($row1['ss_startdate']) ? $row1['ss_enddate']: $ss_startdate ; ?>" name="ssd" placeholder="YYYY/MM/DD"/></td>
</tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr>
<td>Sale End Date<input type="text" value="<?php echo isset($row1['ss_enddate']) ? $row1['ss_enddate']: $ss_enddate ; ?>" name="sen" placeholder="YYYY/MM/DD"/></td>
</tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr>
<td>New Price<input type="text" value="<?php echo isset($row1['ss_price']) ? $row1['ss_price']: $ss_newprice ; ?>" name="np"/></td>
</tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
</table>
<input type="submit" id="Signin" name="addsaleproduct" value="Update"/>
<input type="hidden" name="SubmitSaleUpdate" value='<?php echo  $_POST['modsale'] ;?>'/>


</form>
<form method="post" action="salesManager.php">
<input type="submit" id="Signin" name="go back" value="Back To Home Page"/>
</form>
</body>
</html>
