<?php
error_reporting(E_ALL ^ E_DEPRECATED);
/*if(isset($_SESSION['username']) && isset($_SESSION['position']) && isset($_SESSION['timeout']))
{
$inactive=30;
$t=time();
if(($t-$_SESSION['timeout']) > $inactive) {
header("Location:http://localhost/homework2/logout.php"); 
}
}
error_reporting(E_ALL ^ E_DEPRECATED);*/


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

function showProductsonsale()
{
var str1=document.getElementById("searchproduct").value;
var str2=document.getElementById("searchpname").value;
var str3=document.getElementById("searchfromprice").value;
var str4=document.getElementById("searchtoprice").value;
var str5=document.getElementById("salestartdate").value;
var str6=document.getElementById("saleenddate").value;
var sale1="?select="+str1;
sale1+="&pname="+str2+"&fprice="+str3+"&toprice="+str4+"&stdate="+str5+"&endate="+str6;

if (str1=="--select a category--") {
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
if(str2!="" || str3!="" || str4!="" || str5!="" || str6!="")

{
xmlhttp.open("GET","viewSalesReport1.php?"+sale1,true);

}
else
{
xmlhttp.open("GET","viewSalesReport1.php?select="+str1,true);
}
xmlhttp.send();
xmlhttp.onreadystatechange=handleReply;
function handleReply()

{

if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("sometext2").innerHTML=xmlhttp.responseText;
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
<h3 style="font-family:'Times New Roman';font-size:26pt;color:#FF9900">Search Products On Sale</h3>
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
<select name="dynamic_productcategory" id="searchproduct" style="width:200px" onchange="showProductsonsale()">
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
<td><input id="searchpname" value="" type="text" name="searchp" placeholder="Product Name" /></td>
<td><input id="searchfromprice" value="" type="text" name="search1" placeholder="From Price"/></td>
<td><input id="searchtoprice" value="" type="text" name="search2" placeholder="To Price"/></td>
</tr>
<tr>
<td></td>

<td><input type="text" value="" id="salestartdate" placeholder="Sale Start Date" /></td>
<td><input type="text" value="" id="saleenddate" placeholder="Sale End Date" /></td>
</tr>
</table>
<br/><br/>
<input type="button" name="SearchProductReport" id="Signin" value="Search" onclick="showProductsonsale()"/>

<br/><br/>

<div id="sometext2" style="margin-left:-100px"></div>

</form>
</body>
</html>