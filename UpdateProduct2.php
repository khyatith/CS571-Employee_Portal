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
ini_set('display_errors', 0);
$productid=$_POST['Updatecake'];
//echo "productid : $productid";
$array1='';
$array2='';
$array3='';
$con=mysql_connect("cs-server.usc.edu:50422","root","MOMDAD@05");
if(!$con)
{
die ("cannot connect");
}
mysql_select_db('bakery_database');

$sql="select * from products where p_id= '$productid' ";
$res=mysql_query($sql);
if($row1=mysql_fetch_array($res))
{
$row1['p_name'];
//echo "$row1[0]";

$pcategory=$row1['pc_id'];

$row1['p_price'];
$row1['p_expirydate'];
$row1['p_frosting'];
//$row1['p_filling'];
$array3=explode( ',', $row1['p_cakesize'] );
$row1['p_description'];
$row1['p_image'];
//$array1=new array();
$array1=explode( ',', $row1['p_flavours'] ) ;
//$array2=$row1['p_flavours'];
$array2=explode( ',', $row1['p_filling'] );

}
//echo $array1[0];
/*foreach($array1 as $key => $value)
{
echo $value;
echo $array1[0];
}*/

$query1="select pc_name from productcategories where pc_id= '$pcategory'";

$result=mysql_query($query1);
if($retval3=mysql_fetch_array($result))
{
 $retval3['pc_name'];
 
 
 }


$con=mysql_connect("cs-server.usc.edu:50422","root","MOMDAD@05");
if(!$con)
{
die ("cannot connect");
}
mysql_select_db('bakery_database');
if(isset($_POST['c_name']))
{
$cakename=$_POST['c_name'];
}
if(isset($_POST['p_category']))
{
$categoryname=$_POST['p_category'];
}
if(isset($_POST['c_price']))
{
$cakeprice=$_POST['c_price'];
}
if(isset($_POST['c_expirydate']))
{
$cakeexpirydate=$_POST['c_expirydate'];
}
if(isset($_POST['c_description']))
{
$cakedescription=$_POST['c_description'];
}
if(isset($_POST['c_image']))
{
$cakeimage=$_POST['c_image'];
}
$sql1='';
$sql2='';

if(isset($_POST['p_flavour']))
{
$cakeflavour= $_POST['p_flavour'];
if(is_array($cakeflavour)){
while (list ($key, $val) = each ($cakeflavour)) {
$cakeflavour[$key]=$val;
$sql1 .="$val,";
}
}
}
if(isset($_POST['c_filling']))
{
$cakefilling= $_POST['c_filling'];
if(is_array($cakefilling)){
while (list ($key, $val) = each ($cakefilling)) {
$cakefilling[$key]=$val;
$sql2 .="$val,";
}
}
}
$sql3='';
$sql4='';
$sql5='';
$sql6='';
if(isset($_POST['Round']))
{

$cakesizing1=$_POST['Round'];
if(is_array($cakesizing1))
{
while (list ($key, $val) = each ($cakesizing1)) {
$cakesizing1[$key]=$val;
$sql3 .="$val,";
}
}
}
if(isset($_POST['Sheet']))
{
$cakesizing2=$_POST['Sheet'];
if(is_array($cakesizing2))
{
while (list ($key, $val) = each ($cakesizing2)) {
$cakesizing2[$key]=$val;
$sql4 .="$val,";
}
}
}
if(isset($_POST['Square_Layered']))
{
$cakesizing3=$_POST['Square_Layered'];
if(is_array($cakesizing3))
{
while (list ($key, $val) = each ($cakesizing3)) {
$cakesizing3[$key]=$val;
$sql5 .="$val,";
}
}
}
if(isset($_POST['Round_Layered']))
{
$cakesizing4=$_POST['Round_Layered'];
if(is_array($cakesizing4))
{
while (list ($key, $val) = each ($cakesizing4)) {
$cakesizing4[$key]=$val;
$sql6 .="$val,";
}
}
}
$sql7= "$sql3".','."$sql4".','."$sql5".','."$sql6";

if(isset($_POST['c_frosting']))
{
$cakefrosting=$_POST['c_frosting'];
}


if(isset($_POST['SubmitCheck']))
{
//VALIDATIONS

$d=strtotime($cakeexpirydate);
$today=getdate();
if(strlen($cakename)==0 || strlen($sql7)==0 || strlen($cakefrosting)==0 || strlen($sql1)==0 || strlen($cakeprice)==0 || strlen($sql2)==0 || strlen($cakeexpirydate)==0 || strlen($cakedescription)==0 || strlen($cakeimage)==0)
{
$errormessage="Please Fill all the fields";

echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if(preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$categoryname) || !preg_match("/^[a-zA-Z ]*$/",$categoryname))
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
else if(preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$cakename) || !preg_match("/^[a-zA-Z ]*$/",$cakename))
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
else if(preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$cakedescription) || !preg_match("/^[a-zA-Z ]*$/",$cakedescription))
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
else if(preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$cakeprice) || is_nan($cakeprice) || $cakeprice<'30')
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

else if(preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$cakeimage))
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
else if(preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$cakeexpirydate))
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
else if($d['mon']>12 || $d['day']>31)
{
$errormessage="Invalid Date";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
/*else if($today['year']>$d['year'] )
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
else
{

$sql1="update products SET p_name='$cakename',p_cakesize='$sql7',p_frosting='$cakefrosting',p_flavours='$sql1',p_price='$cakeprice',p_filling='$sql2',p_expirydate='$cakeexpirydate',p_description='$cakedescription',p_image='$cakeimage' where p_id='".$_POST['SubmitCheck']."'";
/*$sql1="update users SET e_fname='$name',e_lname='$lastname',e_username='$uname',e_address='$ad',e_city='$cc',e_zip='$zi',e_contact='$number',e_email='$em',e_gender='$genmnew',e_dob='$borndate',e_age='$old',e_startdate='$sd',e_position='$posmnew',e_salary='$sal' where e_id= '".$_SESSION['Change']."'";*/
$retval = mysql_query( $sql1 );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
else 
{
$errormessage="Data Updated Successfully";

echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:550px;font-size:18pt;color:#CC0000'>";
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
</head>
<body>
<a href="logout.php" style="margin-left:1000px;font-size:12pt">LogOut</a>
<div id="Header">
<h3 style="font-family:'Times New Roman';font-size:26pt;color:#FF9900">UPDATE PRODUCT</h3>
</div><br/><br/><br/><br/>

<form action="UpdateProduct2.php" method="post" name="updateproduct">
<table>
<tr>
<td>Cake Category</td>
<td><input type="text"  value='<?php echo isset($retval3['pc_name'])? $retval3['pc_name']:$categoryname;?>'   name="c_name"/>
</td>
<td>Cake Name</td>
<td><input type="text"  value='<?php echo isset($row1['p_name'])? $row1['p_name']:$cakename;?>'  name="c_name"/></td>
<td>Cake Description</td>
<td><input type="textarea" value='<?php echo isset($row1['p_description'])? $row1['p_description']:$cakedescription;?>' name="c_description"></td>
<tr>
<tr>
<td>Cake Flavour</td>
<td><select name="p_flavour[]" multiple>
<option value="Chocolate"
<?php for($i=0;$i<sizeof($array1);$i++)
{ if($array1[$i]=="Chocolate") 
{ echo "SELECTED";
}}?>>Chocolate</option>
<option value="Strawberry"<?php for($i=0;$i<sizeof($array1);$i++)
{ if($array1[$i]=="Strawberry") 
{ echo "SELECTED";
}}?>>Strawberry</option>
<option value="Vanilla"<?php for($i=0;$i<sizeof($array1);$i++)
{ if($array1[$i]=="Vanilla") 
{ echo "SELECTED";
}}?>>Vanilla</option>
</td>

</td>
<td>Cake Price</td>
<td><input type="text" value='<?php echo isset($row1['p_price'])? $row1['p_price']:$cakeprice;?>' name="c_price"/></td>
<td>Cake Image</td>
<td><input type="text" value='<?php echo isset($row1['p_image'])? $row1['p_image']:$cakeimage;?>' name="c_image"/></td>
</tr>
<tr>
<td>Cake Frosting</td>
<td><select name="c_frosting">
<option value="Chocolate Elite"<?php if($row1['p_frosting']=="Chocolate Elite") { echo "selected=SELECTED";}?>>Chocolate Elite</option>
<option value="Chocolate Buttercream"<?php if($row1['p_frosting']=="Chocolate Buttercream") { echo "selected=SELECTED";}?>>Chocolate Buttercream</option>
<option value="White Elite"<?php if($row1['p_frosting']=="White Elite") { echo "selected=SELECTED";}?>>White Elite</option>
<option value="White Buttercream"<?php if($row1['p_frosting']=="White Buttercream") { echo "selected=SELECTED";}?>>White Buttercream</option>
</select>
</td>
<td>Expiry Date</td>
<td><input type="text" value='<?php echo isset($row1['p_expirydate'])? $row1['p_expirydate']:$cakeexpirydate;?>' placeholder="YYYY/MM/DD" name="c_expirydate"/></td>
</tr>
<tr>
<td>Cake Filling</td>
<td><select name="c_filling[]" multiple>
<option value="Raspberry"
<?php for($i=0;$i<sizeof($array2);$i++)
{ if($array2[$i]=="Raspberry") 
{ echo "SELECTED";
}}?>>Raspberry</option>
<option value="Lemon"<?php for($i=0;$i<sizeof($array2);$i++)
{ if($array2[$i]=="Lemon") 
{ echo "SELECTED";
}}?>>Lemon</option>
<option value="Bavarian custard"<?php for($i=0;$i<sizeof($array2);$i++)
{ if($array2[$i]=="Bavarian Custard") 
{ echo "SELECTED";
}}?>>Bavarian Custard</option>
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
<option value="12in"
<?php 
for($i=0;$i<= sizeof($array3);$i++)
{ if($array3[$i]=="12in") 
{ echo "SELECTED";
}}?>>12in</option>
<option value="14in"<?php for($i=0;$i<= sizeof($array3);$i++)
{ if($array3[$i]=="14in") 
{ echo "SELECTED";
}}?>>14in</option>
</select>
</td>
<td><select name="Sheet[]" id="select2" multiple>
<option value="half sheet"<?php for($i=0;$i<=sizeof($array3);$i++)
{ if($array3[$i]=="half sheet") 
{ echo "SELECTED";}}?>>half sheet</option>
<option value="Full Sheet"<?php for($i=0;$i<=sizeof($array3);$i++)
{ if($array3[$i]=="Full Sheet") 
{ echo "SELECTED";}}?>>Full Sheet</option>
</select>
</td>
</select>
<td><select name="Square_Layered[]" id="select3" multiple>
<option value="81 servings"<?php for($i=0;$i<=sizeof($array3);$i++)
{ if($array3[$i]=="81 servings") 
{ echo "SELECTED";}}?>>81 servings</option>
<option value="95 servings"<?php for($i=0;$i<=sizeof($array3);$i++)
{ if($array3[$i]=="95 servings") 
{ echo "SELECTED";}}?>>95 servings</option>
</select>
</td>
<td><select name="Round_Layered[]" id="select4" multiple>
<option value="200 servings"<?php for($i=0;$i<=sizeof($array3);$i++)
{ if($array3[$i]=="200 servings") 
{ echo "SELECTED";}}?>>200 servings</option>
<option value="250 servings"<?php for($i=0;$i<=sizeof($array3);$i++)
{ if($array3[$i]=="250 servings") 
{ echo "SELECTED";}}?>>250 servings</option>
</select>
</td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<br/><br/>

</tr>
</table>
<input type="submit" id="Signin" name="UpdateProduct" style="margin-left:550px;width:200px" value="Update Product"/>
<input type="hidden" name="SubmitCheck" value=<?php if (isset($_POST['Updatecake'])) { echo  $_POST['Updatecake'];} ?>>
</form>
<form method="post" action="salesManager.php">
<input type="submit" id="Signin" name="BackUpdateProduct" style="margin-left:550px;width:200px" value="Back To Home"/>
</form>
</body>
</html>
