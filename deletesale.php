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
if(isset($_POST['SubmitCheck']))
{

error_reporting(E_ALL ^ E_DEPRECATED);
$productname=$_POST['productname'];
$salestartdate=$_POST['salestartdate'];
$salestartdate1=$salestartdate;

$saleenddate=$_POST['saleenddate'];
$saleenddate1=$saleenddate;
$date1=strtotime($salestartdate);
$date2=strtotime($saleenddate);
//echo "$salestartdate1";
//echo "$saleenddate1";
if(strlen($productname)==0 && strlen($salestartdate)==0 && strlen($saleenddate)==0)
{
require 'errordeletesale.html';
$errormessage="Please Fill atleast 1 field";
echo "<h3 style='align:center;font-size:18pt;color:#CC0000;margin-left:600px;margin-top:-50px'>";
echo "$errormessage";
echo "</h3>";
require 'errordeletesale2.html';
}
else if(preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$productname) || preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$salestartdate) || preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$saleenddate))
{
require 'errordeletesale.html';
$errormessage="Invalid Details";
echo "<h3 style='align:center;font-size:18pt;color:#CC0000;margin-left:600px;margin-top:-50px'>";
echo "$errormessage";
echo "</h3>";
require 'errordeletesale2.html';
}
else
{
$con=mysql_connect("cs-server.usc.edu:50422","root","MOMDAD@05");
if(!$con)
{
die ("cannot connect");
}
mysql_select_db('bakery_database',$con);
if(!empty($productname))
{
$query2="select * from specialsales where p_id in (select p_id from products  where p_name='$productname')";
$res1=mysql_query($query2);
//$numberrow=mysql_num_rows($res1);
if(!$rowset=mysql_fetch_array($res1))
{
require 'errordeletesale.html';
$errormessage="Product Does Not Exist";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;font-size:18pt;color:#CC0000; margin-left:500px'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
require 'errordeletesale2.html';
}
else
{
//echo "hi";
$product_id=$rowset['p_id'];
$query1="select * from specialsales where 1";

$query1 .= " AND p_id = '$product_id'";
	
if (strlen($salestartdate1)>0)
{ 
    $query1 .= " AND ss_startdate >= '$salestartdate1' ";
	
}
if(strlen($saleenddate1)>0)
{
$query1 .= " AND ss_enddate <= '$saleenddate1' ";

}




if (($_SESSION['deletefromsale']) != '')
{

$resf=mysql_query($query1);


echo "<html><body><form method='post' action='sale_delete.php'>'<table style='border: solid 2px #ffffff;margin-left:-10px;font-size:12px'><tr><td></td><td>Product Name</td><td>Sale Start Date</td><td>Sale End Date</td><td>Sale price</td></tr>";
require 'sale_delete.php';

if($rowset1=mysql_fetch_assoc($resf))
{
 
 echo "<tr><td><input type='checkbox' name='delsale[]' value=".$rowset1['ss_id']." style='width:15px;height:15px'/></td><td>" .$productname. "</td><td>" .$rowset1['ss_startdate']."</td><td>" .$rowset1['ss_enddate']."</td><td>" .$rowset1['ss_price']."</td></tr>";  
	
	}
	
	
	echo "</table><input type='submit' name='delesale' value='Delete Product' style='width:200px' id='signin'/></form>";
	echo "<form method='post' action='salesmanager.php'><input type='submit' name='backdel' value='Back' style='width:200px' id='signin'/></form></body></html>";
	}


else if (($_SESSION['modifyfromsale']) != '')
{$resf=mysql_query($query1);
//echo "hi";
echo "<html><body><form method='post' action='modify_sale.php'>'<table style='border: solid 2px #ffffff;margin-left:200px;font-size:12px'><tr><td></td><td>Product Name</td><td>Sale Start Date</td><td>Sale End Date</td><td>Sale price</td></tr>";
require 'sale_modify.php';
if($rowset1=mysql_fetch_assoc($resf))
{
 
 echo "<tr><td><input type='radio' name='modsale' value=".$rowset1['ss_id']." style='width:15px;height:15px'/></td><td>" .$productname."</td><td>" .$rowset1['ss_startdate']."</td><td>" .$rowset1['ss_enddate']."</td><td>" .$rowset1['ss_price']."</td></tr>";  
 //echo "<form method='post' action='salesmanager.php'><input type='submit' name='backdel' value='Back' style='width:200px' id='signin'/></form></body></html>";
	}
	
	
	echo "</table><input type='submit' name='modisale' value='Modify Sale Details' style='width:200px' id='signin'/></form>";
	echo "<form method='post' action='salesmanager.php'><input type='submit' name='backdel' value='Back' style='width:200px' id='signin'/></form></body></html>";
	}

}



}
else 
{
$sql1="select * from specialsales where 1";

if (strlen($salestartdate1)>0)
{ 
    $sql1 .= " AND ss_startdate >= '$salestartdate1' ";
	
}
if(strlen($saleenddate1)>0)
{
$sql1 .= " AND ss_enddate <= '$saleenddate1' ";

}

$resf=mysql_query($sql1);
$numberrow1=mysql_num_rows($resf);
/*if(!$rowset1=mysql_fetch_array($resf))
{
require 'errordeletesale.html';
$errormessage="Product Does Not Exist on sale";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;font-size:18pt;color:#CC0000; margin-left:500px'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
require 'errordeletesale2.html';
}*/
if($numberrow1==0)
{

require 'errordeletesale.html';
$errormessage="Product Does Not Exist on sale";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;font-size:18pt;color:#CC0000; margin-left:500px'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
require 'errordeletesale2.html';
}

while($rowset1=mysql_fetch_array($resf))
{
$product_id=$rowset1['p_id'];
//echo "$product_id";
$newquery="select * from products where p_id= '$product_id' ";
$resnew=mysql_query($newquery);
while($row2=mysql_fetch_assoc($resnew))
{
$productname1=$row2['p_name'];



//$pid2=$rowset1['p_id'];
/*
while($row2=mysql_fetch_array($resnew))
{
$productname1=$row2['p_name'];

}*/

if (($_SESSION['deletefromsale']) != '')
{


echo "<html><body><form method='post' action='sale_delete.php'>'<table style='border: solid 2px #ffffff;margin-left:-10px;font-size:12px'><tr><td></td><td>Product Name</td><td>Sale Start Date</td><td>Sale End Date</td><td>Sale price</td></tr>";
require 'sale_delete.php';

while($rowset1=mysql_fetch_array($resf))
{
 
 echo "<tr><td><input type='checkbox' name='delsale[]' value=".$rowset1['ss_id']." style='width:15px;height:15px'/></td><td>" .$productname1. "</td><td>" .$rowset1['ss_startdate']."</td><td>" .$rowset1['ss_enddate']."</td><td>" .$rowset1['ss_price']."</td></tr>";  
	
	}
	
	
	echo "</table><input type='submit' name='delesale' value='Delete Product' style='width:200px' id='signin'/></form>";
	echo "<form method='post' action='salesmanager.php'><input type='submit' name='backdel' value='Back' style='width:200px' id='signin'/></form></body></html>";
	}


else if (($_SESSION['modifyfromsale']) != '')
{$resf=mysql_query($sql1);

while($row2=mysql_fetch_assoc($resnew))
{
$productname1=$row2['p_name'];
}
echo "<html><body><form method='post' action='modify_sale.php'>'<table style='border: solid 2px #ffffff;margin-left:200px;font-size:12px'><tr><td></td><td>Product Name</td><td>Sale Start Date</td><td>Sale End Date</td><td>Sale price</td></tr>";
require 'sale_modify.php';
while($rowset1=mysql_fetch_assoc($resf))
{
 
 echo "<tr><td><input type='radio' name='modsale' value=".$rowset1['ss_id']." style='width:15px;height:15px'/></td><td>" .$productname1."</td><td>" .$rowset1['ss_startdate']."</td><td>" .$rowset1['ss_enddate']."</td><td>" .$rowset1['ss_price']."</td></tr>";  
	
	}
	
	
	echo "</table><input type='submit' name='modisale' value='Modify Sale Details' style='width:200px' id='signin'/></form>";
	echo "<form method='post' action='salesmanager.php'><input type='submit' name='backmod' value='Back' style='width:200px' id='signin'/></form></body></html>";
	}

}
}
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

<?php



if(isset($_POST['deletefromsale']) || isset($_POST['SubmitCheck']))
{
$_SESSION['deletefromsale'] = $_POST['deletefromsale'];
$_SESSION['modifyfromsale'] = '';

?>

<h3 style="font-family:'Times New Roman';font-size:26pt;color:#FF9900;width:700px;margin-left:150px">SEARCH PRODUCT</h3>
</div><br/><br/><br/><br/><br/><br/><br/><br/>
<?php
}
else if(isset($_POST['modifyfromsale']) || isset($_POST['SubmitCheck']))
{$_SESSION['modifyfromsale']=$_POST['modifyfromsale'];
$_SESSION['deletefromsale'] = '';
?>
<h3 style="font-family:'Times New Roman';font-size:26pt;color:#FF9900;width:700px;margin-left:150px">SEARCH PRODUCT</h3>
</div><br/><br/><br/><br/><br/><br/><br/><br/>
<?php
}
?>

<form action="deletesale.php" method="post">
<table>
<tr>
<td>Product Name<input value="<?php echo isset($productname) ? $productname: '' ?>" type="text" name="productname"/></td>
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
<td><input type="submit" name="Sign" id="Signin" value="Search"/></td>

<td><input type="hidden" name="SubmitCheck" value="sent"/></td>
</tr>

</table>
</form>
<form method="post" action="salesManager.php">
<input type="submit" name="delchangeprodback" value="Back To Home" id="Signin" style="margin-left:650px"/>
</form>
</body>
</html>
<?php
}
?>

