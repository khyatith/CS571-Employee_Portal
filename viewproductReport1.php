arra<?php
session_start();
error_reporting(E_ALL ^ E_DEPRECATED);


if(isset($_GET['value1']) && isset($_GET['value2']) && isset($_GET['value3']))
{
       $proname = trim($_GET['value1']);
		$q1= trim($_GET['value2']);
		$q2 = trim($_GET['value3']);
	
$con= mysql_connect('cs-server.usc.edu:50422','root','MOMDAD@05');
		if(!$con)
		{		
			die ("Could not connect to database").mysql_error();
		}
		
		mysql_select_db('bakery_database',$con);

$sql = "select * from products where 1 ";
        
		if(strlen($proname)>0)
		{
		$sql .= "AND p_name = '".$proname."'";
		}
	
		if(strlen($q1) > 0) {
				$sql .= "AND p_price >= '".$q1."'" ;
		}
		if(strlen($q2) >0 )
		{
		
		$sql .= "AND p_price <= '".$q2."'" ;
		}
		
		
		$res=mysql_query($sql) or  die($sql."<br/>".mysql_error());


        echo "<table border='1' style='margin-left:-200px'>
<tr>
<th>Product Name</th>
<th>Expiry Date</th>
<th>Flavours</th>
<th>Frosting</th>
<th>Filling</th>
<th>Cakesize</th>
<th>Description</th>
<th>Price</th>
<th>Image</th>
</tr>";

while($row1 = mysql_fetch_array($res)) {

  echo "<tr>";
  //echo $row1['p_name'];
  echo "<td>" . $row1['p_name'] . "</td>";
  echo "<td>" . $row1['p_expirydate'] . "</td>";
  echo "<td>" . $row1['p_flavours'] . "</td>";
  echo "<td>" . $row1['p_frosting'] . "</td>";
  echo "<td>" . $row1['p_filling'] . "</td>";
  echo "<td>" . $row1['p_cakesize'] . "</td>";
  echo "<td>" . $row1['p_description'] . "</td>";
  echo "<td>" . $row1['p_price'] . "</td>";
  echo "<td>" . $row1['p_image'] . "</td>";
  echo "</tr>";
}
echo "</table>";




}
else
{
$q = $_GET['name1'];
//echo "$q";
$con=mysql_connect('cs-server.usc.edu:50422','root','MOMDAD@05');
if(!$con)
{
die ("cannot connect");
}
mysql_select_db('bakery_database');

$query="select * from products where pc_id= '".$q."'";
$result = mysql_query($query);

echo "<table border='1' style='margin-left:-200px'>
<tr>
<th>Product Name</th>
<th>Expiry Date</th>
<th>Flavours</th>
<th>Frosting</th>
<th>Filling</th>
<th>Cakesize</th>
<th>Description</th>
<th>Price</th>
<th>Image</th>
</tr>";

while($row1 = mysql_fetch_array($result)) {

  echo "<tr>";
  //echo $row1['p_name'];
  echo "<td>" . $row1['p_name'] . "</td>";
  echo "<td>" . $row1['p_expirydate'] . "</td>";
  echo "<td>" . $row1['p_flavours'] . "</td>";
  echo "<td>" . $row1['p_frosting'] . "</td>";
  echo "<td>" . $row1['p_filling'] . "</td>";
  echo "<td>" . $row1['p_cakesize'] . "</td>";
  echo "<td>" . $row1['p_description'] . "</td>";
  echo "<td>" . $row1['p_price'] . "</td>";
  echo "<td>" . $row1['p_image'] . "</td>";
  echo "</tr>";
}
echo "</table>";

mysql_close($con);
}
echo "<a href='managernew.php'>Go Back</a>";
echo "<br/>";
echo "<a href='viewproductReport.php'>Cancel</a>";
?>
