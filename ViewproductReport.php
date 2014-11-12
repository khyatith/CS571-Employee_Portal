<?php
session_start();
error_reporting(E_ALL ^ E_DEPRECATED);



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

table
{
align:center;
margin-left:-250px;
cellspacing:50px;


}
td
{
font-family:'Times New Roman','serif';
font-size:16pt;
font-weight:bold;
color:#FF9900;
padding:10;
}

</style>
<script>

function showProduct2()
{
str1=document.getElementById("h1").value;
str2=document.getElementById("h2").value;
str3=document.getElementById("h3").value;
//str4=document.getElementById("h5").value;
str=document.getElementById('h5').value;
var data="?name1="+str;
data+="&value1="+str1+"&value2="+str2+"&value3="+str3;

if (str=="--select a category--") {
    document.getElementById("sometext").innerHTML="";
    return;
  } 


  var xmlhttp;
if(window.XMLHttpRequest)
{
xmlhttp= new XMLHttpRequest();

}
else
{
xmlhttp= new ActiveXObject("Microsoft.XMLHttp");
}
if(str1!="" || str2!="" || str3!="" )

{
xmlhttp.open("GET","viewproductReport1.php?"+data,true);

}
else
{
xmlhttp.open("GET","viewproductReport1.php?name1="+str,true);
}
xmlhttp.send();
xmlhttp.onreadystatechange=handleReply;
function handleReply()

{

if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("sometext").innerHTML=xmlhttp.responseText;
    }
}

}




</script>
</head>
<body>
<a href="logout.php" style="margin-left:1000px;font-size:12pt">LogOut</a>
<a href="managernew.php" style="margin-left:1000px;font-size:12pt">Go Back</a>
<div id="LoginPage">
<!--<img src='lutz-cafe.gif' style="display:inline;margin-right:20px"/>-->
<div id="Header">
<h3 style="font-family:'Times New Roman';font-size:26pt;color:#FF9900">Search Products</h3>
<form name="form1">
<table>
<tr>


<td>

<?php
$conn = mysql_connect('cs-server.usc.edu:50422','root','MOMDAD@05');
mysql_select_db("bakery_database",$conn); 
$sql="SELECT * FROM productcategories";
$result = mysql_query($sql);
?>
<select name="dynamic_productcategory" id="h5" style="width:200px" onchange="showProduct2()">
<option value="">--select a category--</option>
<?php
$i=0;
while($row = mysql_fetch_array($result)) {

?>

<option value="<?=$row['pc_id'];?>"><?=$row['pc_name'];?></option>
<?php
$i++;
}
?>
</select>
<?php
mysql_close($conn);
?>
</td>

<td><input id="h1" value="" type="text" name="searchpname" placeholder="Product Name" /></td>
<td><input id="h2" value="" type="text" name="searchfromprice" placeholder="From Price"/></td>
<td><input id="h3" value="" type="text" name="searchtoprice" placeholder="To Price"/></td>
<td><input type="button" name="SearchProductReport" id="Signin" value="Search" onclick="showProduct2()"/></td>
</tr>
</table>

<div id="sometext" style="margin-left:-100px"><b>Product info will be listed here</b></div>

</form>
</body>
</html>