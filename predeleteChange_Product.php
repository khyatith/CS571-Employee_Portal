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
margin-left:500px;

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
<?php
if(isset($_POST['delete']))
{

$_SESSION['delete'] = $_POST['delete'];
$_SESSION['change'] = '';
?>
<div id="Header">
<h3 style="font-family:'Times New Roman';font-size:26pt;color:#FF9900">DELETE PRODUCT</h3>
</div>

<br/><br/><br/><br/>
<?php
}
else if(isset($_POST['change']))
{

$_SESSION['change']=$_POST['change'];
$_SESSION['delete'] = '';

?>
<div id="Header">
<h3 style="font-family:'Times New Roman';font-size:26pt;color:#FF9900">UPDATE PRODUCT</h3>
</div>
<br/><br/><br/><br/>
<?php
}
?>