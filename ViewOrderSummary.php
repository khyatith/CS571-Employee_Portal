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


table
{
align:center;
margin-left:-100px;
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
</head>
<body>
<a href="logout.php" style="margin-left:1000px;font-size:12pt">LogOut</a>
<a href="managernew.php" style="margin-left:1000px;font-size:12pt">Go Back</a>
<div id="LoginPage">
<div id="Header">
<h3 style="font-family:'Times New Roman';font-size:26pt;color:#FF9900">Order Summary</h3>
</div>
<table style="margin-left:200px;margin-top:20px">
<form method="post" action="ViewOrderSummary.php">
<td><input type="submit" id="Signin1" style="width:220px" name="PCsummary" value="Summary by product category"/></td>
</form>
<form method="post">
<td><input type="submit" id="Signin1" style="width:200px" name="Psummary" value="Summary by products"/></td>
</form>
<form method="post">
<td><input type="submit" id="Signin1" style="width:200px" name="Salesummary" value="Summary by SpecialSales"/></td>
</form>

</table>
<br/><br/>
</div>
<?php
$con= mysql_connect('cs-server.usc.edu:50422','root','MOMDAD@05');
		if(!$con)
		{		
			die ("Could not connect to database").mysql_error();
		}
		
		mysql_select_db('bakery_database',$con);
if(isset($_POST['PCsummary']))
{
$revenue=0;
$tq=0;

?>
		<table border='1' style="margin-left:400px;margin-top:30px">
		<tr>
		<td>Product Category</td>
		<td>Total Quantity Sold</td>
		<td>Revenue Generated</td>
		</tr>
		
		<?php
		$sql="select * from productcategories where pc_id in(select pc_id from products where p_id in(select p_id from orderdetails))";
		$result=mysql_query($sql);
		if(!$result)
		{
		die (mysql_error());
		}
		while($row=mysql_fetch_array($result))
		{
		$pc_id=$row['pc_id'];
		$pc_name=$row['pc_name'];
		$res=mysql_query("select SUM(productquantity) as Totalqty,SUM(productprice*productquantity) as Totalprice from orderdetails od,products p where od.p_id=p.p_id AND p.pc_id='$pc_id' GROUP BY p.pc_id ");
		if(!$res)
		{
		die (mysql_error());
		}
		while($row1=mysql_fetch_array($res))
		{
		$totalquantity=$row1[0];
		$totalprice=$row1[1];
		$revenue+=$totalprice;
        $tq+=$totalquantity;
		?>

<tr>
<td><?php echo $pc_name;?></td>
<td><?php echo $totalquantity;?></td>
<td>$<?php echo $totalprice;?></td>

<?php
}
}
?>

<span style='background-color:#cc0000;color:#ffffff;margin-left:600px;margin-top:40px;height:200px;border-radius:5px'>TOTAL REVENUE GENERATED:&nbsp;&nbsp;<b>$<?php echo $revenue;?></b></span>
<br/><br/>
<span style='background-color:#cc0000;color:#ffffff;margin-left:600px;margin-top:40px;height:200px;border-radius:5px'>TOTAL QUANTITY SOLD:&nbsp;&nbsp;<b><?php echo $tq; ?></b></span>
</table>
<?php
}
else if(isset($_POST['Psummary']))
{
$revenue=0;
$tq=0;
?>

<table border='1' style="margin-left:350px;margin-top:40px">
		<tr>
		<td>Product Name</td>
		<td>Total Quantity Sold</td>
		<td>Revenue Generated</td>
		</tr>
<?php
		
$sql="select Cake_name, SUM(productquantity) as Totalqty,SUM(productprice*productquantity) as Totalprice from orderdetails od,products p where od.p_id=p.p_id GROUP BY p.p_id";
		$result=mysql_query($sql);
		if(!$result)
		{
		die (mysql_error());
		}
		while($row1=mysql_fetch_array($result))
		{	
        $totalquantity=$row1[1];
		$totalprice=$row1[2];
        $revenue+=$totalprice;
        $tq+=$totalquantity;		
		?>
		
<tr>
<td><?php echo $row1['Cake_name'];?></td>
<td><?php echo $totalquantity;?></td>
<td>$<?php echo $totalprice;?></td>
<?php
}
?>
<span style='background-color:#cc0000;color:#ffffff;margin-left:600px;margin-top:40px;height:200px;border-radius:5px'>TOTAL REVENUE GENERATED:&nbsp;&nbsp;<b>$<?php echo $revenue;?></b></span>
<br/><br/>
<span style='background-color:#cc0000;color:#ffffff;margin-left:600px;margin-top:40px;height:200px;border-radius:5px'>TOTAL QUANTITY SOLD:&nbsp;&nbsp;<b><?php echo $tq; ?></b></span>
</table>
<?php
}
else if(isset($_POST['Salesummary']))
{
$revenue=0;
$tq=0;
?>
<table border='1' style="margin-left:200px;margin-top:30px">
		<tr>
		<td>Product Name</td>
		<td>Total Quantity Sold</td>
		<td>Revenue Generated</td>
		<td>Sale Start Date</td>
		<td>Sale End Date</td>
		</tr>
<?php
$sql="select * from specialsales where p_id in(select p_id from orderdetails)";
		$result=mysql_query($sql);
		if(!$result)
		{
		die (mysql_error());
		}
		while($row=mysql_fetch_array($result))
		{
		$p_id=$row['p_id'];
		$salestartdate=$row['ss_startdate'];
		$saleenddate=$row['ss_enddate'];
		}
		$res=mysql_query("select Cake_name,SUM(productquantity) as Totalqty,SUM(productprice*productquantity) as Totalprice from orderdetails od,specialsales p where od.p_id=p.p_id GROUP BY p.p_id ");
		if(!$res)
		{
		die (mysql_error());
		}
		while($row1=mysql_fetch_array($res))
		{
		$totalquantity=$row1[1];
		$totalprice=$row1[2];
		$revenue+=$totalprice;
        $tq+=$totalquantity;
?>

<tr>
<td><?php echo $row1['Cake_name'];?></td>
<td><?php echo $totalquantity;?></td>
<td>$<?php echo $totalprice;?></td>
<td><?php echo $salestartdate;?></td>
<td><?php echo $saleenddate;?></td>
<?php
}
?>
<span style='background-color:#cc0000;color:#ffffff;margin-left:600px;margin-top:40px;height:200px;border-radius:5px'>TOTAL REVENUE GENERATED:&nbsp;&nbsp;<b>$<?php echo $revenue;?></b></span>
<br/><br/>
<span style='background-color:#cc0000;color:#ffffff;margin-left:600px;margin-top:40px;height:200px;border-radius:5px'>TOTAL QUANTITY SOLD:&nbsp;&nbsp;<b><?php echo $tq; ?></b></span>
</table>
<?php
}
?>
</body>
</html>