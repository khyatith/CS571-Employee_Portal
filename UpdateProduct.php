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

if(isset ($_POST['Updatecake']))
{
$_SESSION['Updatecake']=$_POST['Updatecake'];
$d=$_SESSION['Updatecake'];
//echo "$d";
$_SESSION['Add']='';
$pid=$_POST['Updatecake'];
}
if(isset($d))
{
$row = $_POST['Updatecake'];
	/*if(isset($_POST['Change']))
	{
	$check=count($_POST['Change']);
	echo "$check";
	}
*/
$con=mysql_connect("cs-server.usc.edu:50422","root","MOMDAD@05");
if(!$con)
{
die ("cannot connect");
}
mysql_select_db('bakery_database');

$sql="select * from products where p_id= '$row'";
$res=mysql_query($sql);
if($row1=mysql_fetch_array($res))
{
//echo '$row1[p_name]';
$row1['p_name'];
}


if(isset($_POST['SubmitUpdate']))
{
//echo "hi";

$name=$_POST['c_name'];
$id=$_SESSION['Updatecake'];
//echo "$id";

$sql1="update products SET p_name='$name' where p_id='".$_SESSION['Updatecake']."'";
$retval = mysql_query( $sql1 );
if(! $retval )
{
  die(mysql_error());
}
else 
{
$errormessage= "Entered data successfully\n";

echo "$errormessage";

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
margin-left:200px;

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
<form method="post" action="UpdateProduct2.php">
<div id="Header">
<h3 style="font-family:'Times New Roman';font-size:26pt;color:#FF9900">UPDATE PRODUCT</h3>
</div>

<br/><br/><br/><br/><br/>
</form>



</body>
</html>
