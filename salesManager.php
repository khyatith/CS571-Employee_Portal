<?php
if(isset($_SESSION['username']) && isset($_SESSION['position']) && isset($_SESSION['timeout']))
{
$inactive=600;
$t=time();
if(($t-$_SESSION['timeout']) > $inactive) {
header("Location:logout.php"); 
}
}
?>
<!DOCTYPE html>
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
#Signin1
{
appearance:button;
 -webkit-border-radius: 5px;
 background-color:#CC0000;
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
</style>
</head>
<body>
<a href="logout.php" style="margin-left:1000px;font-size:12pt">LogOut</a>
<div id="LoginPage">
<div id="Header">
<h3 style="font-family:'Times New Roman';font-size:26pt;color:#FF9900">Add/Delete/Modify Products</h3>
</div><br/><br/><br/><br/><br/><br/>
<table style="margin-left:-100px">
<form name="SalesManager" method="post" action="addproductcategory.php">
<td><input type="Submit" name="addPC" id="Signin1" value="Add Product Category" style="margin-left:120px;margin-top:-400px;width:200px"/></td>
</form>
<form name="SalesManager" method="post" action="deleteproductcategory.php">
<td><input type="Submit" name="deletePC" id="Signin1" value="Delete Product Category" style="margin-left:120px;margin-top:-400px;width:200px"/></td>
</form>
<form name="SalesManager" method="post" action="deleteproductcategory.php">
<td><input type="Submit" name="ModifyPC" id="Signin1" value="Modify Product Category" style="margin-left:120px;margin-top:-400px;width:200px"/></td>
</form>
</table>
<br/><br/><br/>
<form name="salesManager" method="post" action="add_Product.php">
<div id="addemployee" style="display:inline-block;margin-bottom:-75px;margin-top:50px">
<img src="add_product.jpg" style="display:block"/>
<!--<h3 style="align:center;position:absolute;margin-left:35px;margin-top:35px;color:#FF6600"><a href="add_Product.php">ADD PRODUCT</a></h3>-->
<input type="Submit" name="Add_Product" id="Signin" value="Add Product" style="margin-left:75px;margin-top:20px;width:120px"/>
<input type="hidden" name="add" value="add1"/>
</form>
<form name="Sales" method="post" action="addtosale.php">
<input type="Submit" name="Add_Product" id="Signin" value="Add Sale" style="margin-left:75px;margin-top:20px;width:120px"/>
</form>
</div>


<form name="salesManager" method="post" action="deleteChange_Product.php">
<div id="addemployee" style="display:inline-block;margin-left:450px;margin-top:-400px">
<img src="deleteProduct.png" style="display:block"/>
<input type="Submit" name="Delete_Product" id="Signin" value="Delete Product" style="margin-left:75px;margin-top:20px;width:120px"/>
<input type="hidden" name="delete" value="delete1"/>
</form>
<form name="Sales" method="post" action="deletesale.php">
<input type="Submit" name="deletefromsale" id="Signin" value="Delete Sale" style="margin-left:75px;margin-top:20px;width:120px"/>
</form>
</div>
<br/><br/><br/><br/>
<form name="salesManager" method="post" action="deleteChange_Product.php">
<div id="addemployee" style="display:inline-block;margin-top:-50px">
<img src="modify_product.png" style="display:block"/>
<!--<h3 style="align:center;position:absolute;margin-left:35px;margin-top:35px;color:#FF6600"><a href="modify_Product.php">MODIFY PRODUCT</h3>-->
<input type="Submit" name="Delete_Product" id="Signin" value="Modify Product" style="margin-left:75px;margin-top:20px;width:120px"/>
<input type="hidden" name="change" value="change1"/>
</form>
<form name="Sales" method="post" action="deletesale.php">
<input type="Submit" name="modifyfromsale" id="Signin" value="Modify sale" style="margin-left:75px;margin-top:20px;width:120px"/>
</form>
</div>






<br/><br/>

<br/><br/>

</div>

</body>
</html>
