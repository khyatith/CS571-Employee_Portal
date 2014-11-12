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


error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);


if(isset($_POST['SubmitCheck'])) {
//if form has been submitted. check the values

$cakecategory=$_POST['p_category'];
$cakename=$_POST['c_name'];
$cakedescription=$_POST['c_description'];
$cakeflavour=array();
$cakeprice=$_POST['c_price'];
$cakeimage=$_POST['c_image'];
$cakefrosting=$_POST['c_frosting'];
$cakeexpirydate=$_POST['c_expirydate'];
$cakefilling=array();
$sizeround=array();
$sizesheet=array();
$sizesquare=array();
$sizeroundlayer=array();


if(isset($cakefilling))
{
if($_POST['c_frosting']=='White Elite')
{
$cakefrosting="White Elite";
}
if($_POST['c_frosting']=='White Buttercream')
{
$cakefrosting="White Buttercream";
}
if($_POST['c_frosting']=='Chocolate Elite')
{
$cakefrosting="Chocolate Elite";
}
if($_POST['c_frosting']=='Chocolate Buttercream')
{
$cakefrosting="Chocolate Buttercream";
}
}
else
{
$errormessage="Please Select a Cake Frosting";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:500px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}

//Validations
if(strlen($cakename)==0 || strlen($cakedescription)==0 || strlen($cakeprice)==0 || strlen($cakeimage)==0 || strlen($cakecategory)==0 || strlen($cakeexpirydate)==0 )
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
else if((preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$cakecategory)) || !preg_match("/^[a-zA-Z ]*$/",$cakecategory))
{
$errormessage="Invalid Cake Category";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:500px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if((preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$cakename))|| !preg_match("/^[a-zA-Z ]*$/",$cakename))
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
else if((preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$cakedescription)) || !preg_match("/^[a-zA-Z ]*$/",$cakedescription))
{
$errormessage="Invalid Cake Description";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:500px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if((preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$cakeprice))  || preg_match("/^[a-zA-Z ]*$/",$cakeprice) || $cakeprice<'30')
{
$errormessage="Invalid Cake Price.Check Again";

echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:500px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}

else if((preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$cakeimage)) )
{
$errormessage="Invalid Cake Image.Check Again";

echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:500px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if((preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$cakeexpirydate)) )
{
$errormessage="Invalid Cake Expiry Date";

echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:500px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}

else if(!isset($_POST['p_flavour']))
{
$errormessage="Please select atleast one type of Flavour";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:500px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if(!isset($_POST['c_filling']))
{
$errormessage="Please select atleast one type of filling";
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
$sql3='';
if(isset($_POST['Round']))
	{

	//$cakeround=$_POST['Round'];
	$sizeround=$_POST['Round'];

while (list ($key, $val) = each ($sizeround)) {
$sql3 .="$val,";

}

}
else
{
$sizeround="";
}

$sql4='';
	if(isset($_POST['Sheet']))
	{
	//$cakeshape2="Sheet";
	//$cakesheet=$_POST['c_sheet'];
	$sizesheet=$_POST['Sheet'];
	//echo $sizesheet;
while (list ($key, $val) = each ($sizesheet)) {
$sql4 .="$val,";


}
	}
	else
	{
	$sizesheet="";
	}
	$sql5='';
	if(isset($_POST['Square_Layered']))
	{
	//$cakeshape3="Square Layered";
	$sizesquare=$_POST['Square_Layered'];
	//$cakesquare=$_POST['c_squarelayered'];
	while (list ($key, $val) = each ($sizesquare)) {
$sql5 .="$val,";

}
}
else
{
$sizesquare="";
}

$sql6='';
	
	if(isset($_POST['Round_Layered']))
	{//$cakeshape4="Round Layered";
	$sizeroundlayer=$_POST['Round_Layered'];
	//$cakeroundlayer=$_POST['c_roundlayered'];
	while (list ($key, $val) = each ($sizeroundlayer)) {
$sql6 .="$val,";
}

	}
	else{
	$sizeroundlayer="";
	}
	
	$sql7= "$sql3".','."$sql4".','."$sql5".','."$sql6";
	if($sql3=="" && $sql4=="" && $sql5=="" && $sql6=="" )
	{
	$errormessage="Please select atleast one cakesize";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:500px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
	}
	//$sql8= "$cakeshape1".','."$cakeshape2".','."$cakeshape3".','."$cakeshape4";
	$con=mysql_connect("cs-server.usc.edu:50422","root","MOMDAD@05");
if(!$con)
{
die ("cannot connect");
}
mysql_select_db('bakery_database');


$query="select pc_id from productcategories where pc_name='$cakecategory'";
$res1=mysql_query($query);

if($row1=mysql_fetch_array($res1))
{ 
$sql1='';
$sql2='';
$cakeflavour= $_POST['p_flavour'];
if( is_array($cakeflavour)){
while (list ($key, $val) = each ($cakeflavour)) {
$cakeflavour[$key]=$val;
$sql1 .="$val,";
}
}
$cakefilling= $_POST['c_filling'];
if( is_array($cakefilling)){
while (list ($key, $val) = each ($cakefilling)) {
$cakefilling[$key]=$val;
$sql2 .= "$val,";
}
}


//$sql="INSERT INTO products(pc_id, p_name, p_price,p_expirydate,p_flavours,p_description,p_image,p_frosting,p_filling,p_cakeshape,p_cakesize)VALUES ('$row1[0]' , '$cakename', '$cakeprice', '$cakeexpirydate','$cakeflavour','$cakedescription','$cakeimage','$sql1','$sql2','$sql7','$sql8')";

mysql_query("start transaction");
$sql="INSERT INTO products(pc_id, p_name, p_price,p_expirydate,p_flavours,p_description,p_image,p_frosting,p_filling,p_cakesize)VALUES ('$row1[0]' , '$cakename', '$cakeprice', '$cakeexpirydate','$sql1','$cakedescription','$cakeimage','$cakefrosting','$sql2','$sql7')";
$retval = mysql_query( $sql, $con );
$lastinsertedproductid=mysql_insert_id();
if($sql3!="")
{
$array3=explode( ',', $sql3 );
for($i=0;$i<sizeof($array3)-1;$i++)
{

$sql1 = "insert into cakesizes(p_id,cakeshapeid,cakesizename) values ('$lastinsertedproductid','1','$array3[$i]')";
$result=mysql_query($sql1);     
if(!$result)
{
die (mysql_error());
}
}
}
if($sql4!="")
{
$array4=explode( ',', $sql4 );

for($i=0;$i<sizeof($array4)-1;$i++)
{

$sql1 = "insert into cakesizes(p_id,cakeshapeid,cakesizename) values ('$lastinsertedproductid','2','$array4[$i]')";
$result=mysql_query($sql1);     
if(!$result)
{
die (mysql_error());
}
}
}
if($sql5!="")
{
$array5=explode( ',', $sql5 );

for($i=0;$i<sizeof($array5)-1;$i++)
{

$sql1 = "insert into cakesizes(p_id,cakeshapeid,cakesizename) values ('$lastinsertedproductid','3','$array5[$i]')";
$result=mysql_query($sql1);     
if(!$result)
{
die (mysql_error());
}
}
}
if($sql6!="")
{
$array6=explode( ',', $sql6 );

for($i=0;$i<sizeof($array6)-1;$i++)
{

$sql1 = "insert into cakesizes(p_id,cakeshapeid,cakesizename) values ('$lastinsertedproductid','4','$array6[$i]')";
$result=mysql_query($sql1);     
if(!$result)
{
die (mysql_error());
}
}
}


$errormessage="New Record Inserted";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:500px;font-size:18pt;color:#CC0000;margin-right:100px'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
mysql_query("commit");
mysql_close($con);

}
else
 {
 $errormessage="Product Category Does not exist in the records";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:500px;font-size:18pt;color:#CC0000;margin-right:100px'>";
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
margin-left:450px;

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
a:link
{
color:#FF6600;
text-decoration:none;
}
table
{
margin-left:60px;
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


</style>
<script>
function setenabled()
{
var sel1=document.addproduct.c_round;
var sel2=document.addproduct.c_sheet;
var sel3=document.addproduct.c_squarelayered;
var sel4=document.addproduct.c_roundlayered;
if(sel1.checked)
{
document.getElementById("select1").disabled=false;

}
if(!sel1.checked)
{
document.getElementById("select1").disabled=true;
}
if(sel2.checked)
{
document.getElementById("select2").disabled=false;
}
if(!sel2.checked)
{
document.getElementById("select2").disabled=true;
}
if(sel3.checked)
{
document.getElementById("select3").disabled=false;
}
if(!sel3.checked)
{
document.getElementById("select3").disabled=true;
}
if(sel4.checked)
{
document.getElementById("select4").disabled=false;
}
if(!sel4.checked)
{
document.getElementById("select4").disabled=true;
}
}
</script>
</head>
<body>
<a href="logout.php" style="margin-left:1000px;font-size:12pt">LogOut</a>
<div id="Header">
<h3 style="font-family:'Times New Roman';font-size:26pt;color:#FF9900">ADD A NEW PRODUCT</h3>
</div><br/><br/><br/><br/>

<form action="add_Product.php" method="post" name="addproduct">
<table>
<tr>
<td>Cake Category</td>
<td><input type="text" value="<?php echo isset($cakecategory) ? $cakecategory: ''; ?>" name="p_category"/></td> 
</td>
<td>Cake Name</td>
<td><input type="text" value="<?php echo isset($cakename) ? $cakename: ''; ?>"   name="c_name"/></td>
<td>Cake Description</td>
<td><input type="textarea" value="<?php echo isset($cakedescription) ? $cakedescription: ''; ?>" name="c_description"></td>
<tr>
<tr>
<td>Cake Flavour</td>
<td><select name="p_flavour[]" multiple />
<option value="Chocolate">Chocolate</option>
<option value="Strawberry">Strawberry</option>
<option value="Vanilla">Vanilla</option>
</select>
</td>
<td>Cake Price</td>
<td><input type="text" value="<?php echo isset($cakeprice) ? $cakeprice: ''; ?>"  name="c_price"/></td>
<td>Cake Image</td>
<td><input type="text" value="<?php echo isset($cakeimage) ? $cakeimage: ''; ?>"  name="c_image"/></td>
</tr>
<tr>
<td>Cake Frosting</td>
<td><select name="c_frosting">
<option value="Chocolate Elite">Chocolate Elite</option>
<option value="Chocolate Buttercream">Chocolate Buttercream</option>
<option value="White Elite">White Elite</option>
<option value="White Buttercream">White Buttercream</option>
</select>
</td>
<td>Expiry Date</td>
<td><input type="text" value="<?php echo isset($cakeexpirydate) ? $cakeexpirydate: ''; ?>"  placeholder="YYYY/MM/DD" name="c_expirydate"/></td>
</tr>
<tr>
<td>Cake Filling</td>
<td><select name="c_filling[]" multiple>
<option value="Raspberry">Raspberry</option>
<option value="lemon">Lemon</option>
<option value="Bavarian custard">Bavarian Custard</option>
</td>
<tr/>
</table>
<hr/>
<h3 style="font-family:'Times New Roman';font-size:18pt;color:#FF9900;margin-left:400px">SELECT AVAILABLE CAKE SHAPES AND SIZES</h3>
<table style="margin-left:200px">
<tr>
<td>Round</td>
<td>Sheet</td>
<td>Square Layered</td>
<td>Round Layered</td>
</tr>
<td><select name="Round[]" id="select1" multiple>
<option>12in</option>
<option>14in</option>
</select>
<td><select name="Sheet[]" id="select2" multiple>
<option>half sheet</option>
<option>Full sheet</option>
</select>
<td><select name="Square_Layered[]" id="select3" multiple>
<option>81 servings</option>
<option>95 servings</option>
</select>
<td><select name="Round_Layered[]" id="select4" multiple>
<option>200 servings</option>
<option>250 servings</option>
</select>
</td>
</tr>
<tr>
<td><td/>
<td>
<br/><br/>

<input type="submit" id="Signin"value="Add Product"/></td>
<td><input type="hidden" name="SubmitCheck" value="sent"/></td>
</tr>
</table>
</form>
<table>
<tr>

<td>
<form method="post" action="salesManager.php">
<input type="submit" name="Back" value="Back To home Page" style="width:200px;margin-left:500px" id='signin' />
</form>
</td>

</tr>
</table>

</body>
</html>
