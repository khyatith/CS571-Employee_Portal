<?php
//session_start();

error_reporting(E_ALL ^ E_DEPRECATED);

if (isset($_POST['delesale'])) {

    
    
    $row = $_POST['delsale'];
	if(isset($_POST['delsale']))
	{
	$check=count($_POST['delsale']);
	}
	//echo ("$check");
	$con=mysql_connect("cs-server.usc.edu:50422","root","MOMDAD@05");
if(!$con)
{
die ("cannot connect");
}

mysql_select_db('bakery_database',$con);
//$row=mysql_fetch_assoc($res);
for($i=0;$i<$check;$i++)
{
//echo "$row[$i]";
$query="DELETE FROM specialsales where ss_id= '$row[$i]'";
$res=mysql_query($query) or die(mysql_error());
//echo "$res";
}
if($res)
{
echo "<html><body style='background-color:#CCFFFF'>";
echo "<form method='post' action='salesManager.php'>";
require 'predeletePC.html';
echo "<div id='Header'><h3 style='font-family:'Times New Roman';font-size:26pt;color:#FF9900'> Number of Records Deleted :" .$check."</div>";
echo "<input type='submit' name='Back' value='Back to HomePage' style='width:200px' id='signin'/>";
echo "</form></html></body>";
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
<form method="post" action="sale_delete.php">
<div id="Header">
<h3 style="font-family:'Times New Roman';font-size:26pt;color:#FF9900">DELETE FROM SALE</h3>
</div>

<br/><br/><br/><br/><br/>
</form>



</body>
</html>
<?php
}
?>