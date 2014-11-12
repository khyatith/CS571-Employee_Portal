<?php
session_start();
error_reporting(E_ALL ^ E_DEPRECATED^ E_WARNING);
if(isset($_POST['SubmitCheck'])) {


//var_dump($_SESSION["timeout"]);
//form has been submitted. check the values
$username = $_POST['username'];
$password = $_POST['password'];

$errormessage="";
if(strlen($username)==0 && strlen($password)==0)
{
$errormessage="";
require 'prelogin.html';
require 'postlogin.html';
}
else if(strlen($username)==0)
{
$errormessage='Invalid Login';
require 'prelogin.html';
echo "<div style='font-family:Times New Roman;font-size:18pt;color:#cc0000'>";
echo "$errormessage";
echo "</div>";
require 'postlogin.html';
}
else if(strlen($password)==0)
{
$errormessage='Invalid Login';
require 'prelogin.html';
echo "<div style='font-family:Times New Roman;font-size:18pt;color:#cc0000'>";
echo "$errormessage";
echo "</div>";
require 'postlogin.html';

}

if(strlen($username)>0 && strlen($password)>0)
{
//echo "$password";
//echo "$username";
$sql="select e_position from users where e_username='$username' && e_password=password('$password')";
$con=mysql_connect('cs-server.usc.edu:50422','root','MOMDAD@05');
if(!$con)
{
die (mysql_error());
}
mysql_select_db('bakery_database',$con);
$res=mysql_query($sql);

if(!($row=mysql_fetch_array($res)))
{

$errormessage='Invalid Login';
require 'prelogin.html';
echo "<div style='font-family:Times New Roman;font-size:18pt;color:#cc0000'>";
echo "$errormessage";
echo "</div>";
require 'postlogin.html';

}
else if(!$res)
{
require 'prelogin.html';
require 'postlogin.html';
}
else
{
$_SESSION['username']=$_POST['username'];
//$_SESSION['password']=$_POST['password'];
$_SESSION['timeout'] = time();

if($row[0]=='Sales Manager')
{
//require 'salesManager.php';
$_SESSION['position']=$row[0];
 require  'salesManager.php';
 }
if($row[0]=='Administrator')
{
$_SESSION['position']=$row[0];
require 'administrator.php';
}
if($row[0]=='Manager')
{

$_SESSION['position']=$row[0];
require 'managernew.php';
}

}
}
}

if(!isset($_POST['SubmitCheck']))
{
?>
<html>
<head>
<style type="text/css">
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
 width:100px;
 height:35px;
color:#ffffff;
font-weight:bold;
}

</style>

</head>

<body>
<a href="logout.php" style="margin-left:1000px;font-size:12pt">LogOut</a>
<div id="LoginPage">
<!--<img src='lutz-cafe.gif' style="display:inline;margin-right:20px"/>-->
<div id="Header">
<h3 style="font-family:'Times New Roman';font-size:26pt;color:#FF9900">Welcome Employees!</h3>
</div><br/><br/>
<div id="Header" class="default">
<h3 style="font-family:'Times New Roman';font-size:18pt; color:#0099CC"><i>Please enter your credentials</i></h3>
<br/><br/><br/>
<form id="form1" action="login.php" method="POST">
<input type="text"  name="username" placeholder="User Name"/>
<br/><br/>
<input type="password" name="password"  placeholder="Password"/>
<br/><br/><br/>
<input type="submit" id="Signin" value="Sign in!"/>
<input type="hidden" name="SubmitCheck" value="sent">

</form>
</div>
<div>
</body>
</html>
<?php
}

?>

