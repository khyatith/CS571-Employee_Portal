<?php
session_start();
/*if(isset($_SESSION['username']) && isset($_SESSION['position']) && isset($_SESSION['timeout']))
{
$inactive=30;
$t=time();
if(($t-$_SESSION['timeout']) > $inactive) {
header("Location:http://localhost/homework2/logout.php"); 
}
}*/
error_reporting(E_ALL ^ E_DEPRECATED);
if(isset($_GET['pname']) && isset($_GET['fprice']) && isset($_GET['toprice'])  && isset($_GET['stdate']) && isset($_GET['endate']))
{
       $proname = trim($_GET['pname']);
		$fromprice= $_GET['fprice'];
		$toprice = trim($_GET['toprice']);
		$stdate = trim($_GET['stdate']);
		$endate = trim($_GET['endate']);
		//$salestartdate=trim($_GET['salestartdate']);
		//$saleenddate=trim($_GET['saleenddate']);
        $revenue=0;
$con= mysql_connect('cs-server.usc.edu:50422','root','MOMDAD@05');
		if(!$con)
		{		
			die ("Could not connect to database").mysql_error();
		}
		
		mysql_select_db('bakery_database',$con);
		$count=0;
		$sql="select * from orderdetails where 1";
		if(strlen($proname)>0)
		{
		$presql="select * from orderdetails where p_id in (select p_id from products  where p_name='$proname')";
		$preresult=mysql_query($presql);
		if($row=mysql_fetch_array($preresult))
		{
		$count++;
		//echo $row['p_id'];
		$rowid=$row['p_id'];
		
		//echo "$count";
		//$saleprod=$row['p_id'];
		}
		else 
		{
		$count=-1;
		$errormessage="No Orders for this product yet";
		echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:500px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
		
		}
		}
		
	
		if( $count==0)
		{
		//echo "wrong";
		
		//echo "hey";
	
		
		if(!empty($fromprice))
		{
		$sql .= " AND productprice >=   '$fromprice' " ;
		}
		//$res=mysql_query($sql) or  die($sql."<br/>".mysql_error());
		if(!empty($toprice))
		{
		$sql .= " AND productprice <= '$toprice' " ;
		
		}
		if(strlen($stdate)>0)
		{
		
		$sql .= " AND OrderDate >= '$stdate' " ;
		
		}
		if(strlen($endate)>0)
		{
		$sql .= " AND OrderDate <= '$endate' " ;
		}
		
		$res=mysql_query($sql) or  die($sql."<br/>".mysql_error());
        $numberrows=mysql_num_rows($res);
if($numberrows==0)
{
$errormessage="No Product Found";
		echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:100px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
		
}
else
{
$revenue=0;
$tq=0;

        echo "<table border='1' style='margin-left:400px;margin-top:20px'>
<tr>
<th>Product Name</th>
<th>Ordered By</th>
<th>Quantity Ordered</th>
<th>Total Price</th>
<th>Order Date</th>
</tr>";
/*<th>Flavour</th>
<th>Frosting</th>
<th>Filling</th>
<th>Cake shape</th>
<th>Cake size</th>
<th>Cake message</th>*/


while($row1 = mysql_fetch_array($res)) {
$orderid=$row1['OrderId'];
$pq=$row1['productquantity'] ;
$pp=$row1['productprice'];
$revenue+=$pq*$pp;
$tq+=$row1['productquantity'];
  $newsql="select * from orders where OrderId = '$orderid'";
  $res1=mysql_query($newsql);
  if($row2=mysql_fetch_array($res1))
  {
  $custfname=$row2['CustomerFirstName'];
  $custlname=$row2['CustomerLastName'];
  }
  echo "<tr>";
  //echo $row1['p_name'];
  echo "<td>" . $row1['Cake_name'] . "</td>";
  echo "<td>" . $row2['CustomerFirstName']. "&nbsp;" . $row2['CustomerLastName']. "</td>";
  echo "<td>" . $row1['productquantity'] . "</td>";
  echo "<td>$" . $row1['productprice'] . "</td>";
  //echo "<td>" . $row1['Cake_flavour'] . "</td>";
  //echo "<td>" . $row1['Cake_frosting'] . "</td>";
  //echo "<td>" . $row1['Cake_filling'] . "</td>";
  //echo "<td>" . $row1['Cake_shape'] . "</td>";
  //echo "<td>" . $row1['Cake_size'] . "</td>";
  //echo "<td>" . $row1['Cake_message'] . "</td>";
  echo "<td>" . $row1['OrderDate'] . "</td>";
 
 
  echo "</tr>";
}
echo "<span style='background-color:#cc0000;color:#ffffff;margin-left:600px;margin-top:20px;height:200px;border-radius:5px'>TOTAL REVENUE GENERATED:&nbsp;&nbsp;<b>$".$revenue."</b></span>";
echo "<br/><br/>";
echo "<span style='background-color:#cc0000;color:#ffffff;margin-left:600px;margin-top:20px;height:200px;border-radius:5px'>TOTAL QUANTITY SOLD:&nbsp;&nbsp;<b>".$tq."</b></span>";
echo "</table>";


		
}
		
	}	
		if($count>0)
		{ 
		//echo "hi";
		$sql .= " AND p_id =  '$rowid' ";
		if(!empty($fromprice))
		{
		//echo "hello";
		$sql .= " AND productprice >=  '$fromprice' " ;
		}
		if(!empty($toprice))
		{
		$sql .= " AND productprice <= '$toprice' " ;
		
		}
		if(strlen($stdate)>0)
		{
		$sql .= " AND OrderDate >= '$stdate' " ;
		}
		if(strlen($endate)>0)
		{
		$sql .= "AND OrderDate <= '$endate' " ;
		}
		
		
		
		
		
      $res=mysql_query($sql) or  die($sql."<br/>".mysql_error());

$revenue=0;
$tq=0;

        echo "<table border='1' style='margin-left:400px;margin-top:20px'>
<tr>
<th>Product Name</th>
<th>Orderd By</th>
<th>Quantity Ordered</th>
<th>Total Price</th>
<th>Order Date</th>
</tr>";
/*<th>Flavour</th>
<th>Frosting</th>
<th>Filling</th>
<th>Cake shape</th>
<th>Cake size</th>
<th>Cake message</th>*/


while($row1 = mysql_fetch_array($res)) {
$orderid=$row1['OrderId'];
$pq=$row1['productquantity'] ;
$pp=$row1['productprice'];
$revenue+=$pq*$pp;
$tq+=$row1['productquantity'];
  $newsql="select * from orders where OrderId = '$orderid'";
  $res1=mysql_query($newsql);
  if($row2=mysql_fetch_array($res1))
  {
  $custfname=$row2['CustomerFirstName'];
  $custlname=$row2['CustomerLastName'];
  }
  echo "<tr>";
  //echo $row1['p_name'];
  echo "<td>"   . $proname. "</td>";
  echo "<td>" . $row2['CustomerFirstName'] ."&nbsp;".$row2['CustomerLastName']. "</td>";
  echo "<td>" . $row1['productquantity'] . "</td>";
  echo "<td>$" . $row1['productprice'] . "</td>";
  //echo "<td>" . $row1['Cake_flavour'] . "</td>";
  //echo "<td>" . $row1['Cake_frosting'] . "</td>";
  //echo "<td>" . $row1['Cake_filling'] . "</td>";
  //echo "<td>" . $row1['Cake_shape'] . "</td>";
  //echo "<td>" . $row1['Cake_size'] . "</td>";
  //echo "<td>" . $row1['Cake_message'] . "</td>";
  echo "<td>" . $row1['OrderDate'] . "</td>";
  echo "</tr>";
}
echo "<span style='background-color:#cc0000;color:#ffffff;margin-left:600px;margin-top:20px;height:200px;border-radius:5px'>TOTAL REVENUE GENERATED:&nbsp;&nbsp;<b>$".$revenue."</b></span>";
echo "<br/><br/>";
echo "<span style='background-color:#cc0000;color:#ffffff;margin-left:600px;margin-top:20px;height:200px;border-radius:5px'>TOTAL QUANTITY SOLD:&nbsp;&nbsp;<b>".$tq."</b></span>";

echo "</table>";




}

}
else
{
$revenue=0;
$tq=0;
$q = $_GET['select'];
//echo "$q";
$con=mysql_connect('cs-server.usc.edu:50422','root','MOMDAD@05');
if(!$con)
{
die ("cannot connect");
}
mysql_select_db('bakery_database');

$query="select * from orderdetails where p_id in(select p_id from products where pc_id = '".$q."')";
$result = mysql_query($query);

echo "<table border='1' style='margin-left:400px;margin-top:20px'>
<tr>
<th>Product Name</th>
<th>Ordered By</th>
<th>Quantity Ordered</th>
<th>Total Price</th>
<th>Order Date</th>
</tr>";
/*<th>Flavour</th>
<th>Frosting</th>
<th>Filling</th>
<th>Cake shape</th>
<th>Cake size</th>
<th>Cake message</th>*/


while($row1 = mysql_fetch_array($result)) {
$orderid=$row1['OrderId'];

$pq=$row1['productquantity'] ;
$pp=$row1['productprice'];
$revenue+=$pq*$pp;
$tq+=$row1['productquantity'];
$newsql="select * from orders where OrderId= '$orderid'";
$resval=mysql_query($newsql);
$count=0;
if($row2=mysql_fetch_array($resval))
{
$custfname=$row2['CustomerFirstName'];
$custlname=$row2['CustomerLastName'];
//echo "$pname";
}

  echo "<tr>";
  //echo $row1['p_name'];
 
  echo "<td>"   . $row1['Cake_name']. "</td>";
  echo "<td>" . $row2['CustomerFirstName'] ."&nbsp;".$row2['CustomerLastName']. "</td>";
  echo "<td>" . $row1['productquantity'] . "</td>";
  echo "<td>$" . $row1['productprice'] . "</td>";
  //echo "<td>" . $row1['Cake_flavour'] . "</td>";
  //echo "<td>" . $row1['Cake_frosting'] . "</td>";
  //echo "<td>" . $row1['Cake_filling'] . "</td>";
  //echo "<td>" . $row1['Cake_shape'] . "</td>";
  //echo "<td>" . $row1['Cake_size'] . "</td>";
  //echo "<td>" . $row1['Cake_message'] . "</td>";
  echo "<td>" . $row1['OrderDate'] . "</td>";
 

  echo "</tr>";
}
echo "<span style='background-color:#cc0000;color:#ffffff;margin-left:600px;margin-top:20px;height:200px;border-radius:5px'>TOTAL REVENUE GENERATED:&nbsp;&nbsp;<b>$".$revenue."</b></span>";
echo "<br/><br/>";
echo "<span style='background-color:#cc0000;color:#ffffff;margin-left:600px;margin-top:20px;height:200px;border-radius:5px'>TOTAL QUANTITY SOLD:&nbsp;&nbsp;<b>".$tq."</b></span>";
echo "</table>";
mysql_close($con);
}

echo "<a href='managernew.php' style='margin-left:500px'>Go Back</a>";
echo "<br/>";
echo "<a href='ViewOrderReport.php' style='margin-left:500px'>Cancel</a>";


?>