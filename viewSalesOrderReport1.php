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
if(isset($_GET['pname']) && isset($_GET['fprice']) && isset($_GET['toprice'])  && isset($_GET['stdate']) && isset($_GET['endate']) && isset($_GET['orderstartdate']) && isset($_GET['orderenddate']))
{
       $proname = trim($_GET['pname']);
		$fromprice= $_GET['fprice'];
		$toprice = trim($_GET['toprice']);
		$stdate = trim($_GET['stdate']);
		$endate = trim($_GET['endate']);
		$orderstartdate=trim($_GET['orderstartdate']);
		$orderenddate=trim($_GET['orderenddate']);

$con= mysql_connect('cs-server.usc.edu:50422','root','MOMDAD@05');
		if(!$con)
		{		
			die ("Could not connect to database").mysql_error();
		}
		
		mysql_select_db('bakery_database',$con);
		$count=0;
		$flag=0;
		$sql="select * from specialsales where 1";
		if(strlen($proname)>0)
		{
		$presql="select * from products where p_name='$proname' && p_id IN(select p_id from specialsales)";
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
		$errormessage="Product not in special sales";
		echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:100px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
		
		}
		}
		
	
		if( $count==0)
		{
		
		//echo "wrong";
		//$sql="select * from specialsales where 1";
		//echo "hey";
		if(!empty($fromprice))
		{
		$sql .= " AND ss_price >=   '$fromprice' " ;
		}
		//$res=mysql_query($sql) or  die($sql."<br/>".mysql_error());
		if(!empty($toprice))
		{
		$sql .= " AND ss_price <= '$toprice' " ;
		
		}
		if(strlen($stdate)>0)
		{
		$sql .= " AND ss_startdate >= '$stdate' " ;
		}
		if(strlen($endate)>0)
		{
		$sql .= " AND ss_enddate <= '$endate' " ;
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
        echo "<table border='1' style='margin-left:100px;margin-top:20px'>
<tr>
<th>Product Name</th>
<th>Ordered By</th>
<th>Quantity</th>
<th>Price</th>
<th>OrderDate</th>
</tr>";

while($row1 = mysql_fetch_array($res)) {
$pid=$row1['p_id'];
  $newsql="select * from orderdetails where p_id = $pid AND 1";
  if(strlen($orderstartdate)>0)
		{
		$newsql .= " AND OrderDate >= '$orderstartdate' " ;
		}
		if(strlen($orderenddate)>0)
		{
		$newsql .= " AND OrderDate <= '$orderenddate' " ;
		}
  $res1=mysql_query($newsql);
  $numrows=mysql_num_rows($res1);

  while($row2=mysql_fetch_array($res1))
  {
  
  $orderid=$row2['OrderId'];
  $pq=$row2['productquantity'] ;
$pp=$row2['productprice'];
$revenue+=$pq*$pp;
$tq+=$row2['productquantity'];
  
  $ordersql=mysql_query("select * from orders where OrderId='$orderid'");
  if($row3=mysql_fetch_array($ordersql))
  {
  $customerfirstname=$row3['CustomerFirstName'];
  $customerlastname=$row3['CustomerLastName'];
  }
  
  echo "<tr>";
  //echo $row1['p_name'];
  echo "<td>" . $row2['Cake_name'] . "</td>";
  echo "<td>" . $customerfirstname ."&nbsp;&nbsp;". $customerlastname. "</td>";
  echo "<td>" . $row2['productquantity'] . "</td>";
  echo "<td>" . $row2['productprice'] . "</td>";
  echo "<td>" . $row2['OrderDate'] . "</td>";
  echo "</tr>";
}
}
}

echo "<span style='background-color:#cc0000;color:#ffffff;margin-left:100px;margin-top:20px;height:200px;border-radius:5px'>REVENUE GENERATED:<b>$".$revenue."</b></span>";
echo "<br/><br/>";
echo "<span style='background-color:#cc0000;color:#ffffff;margin-left:100px;margin-top:20px;height:200px;border-radius:5px'>QUANTITY SOLD:<b>".$tq."</b></span>";
echo "</table>";
	}	
		
		if($count>0)
		{ 
		//echo "hi";
		$sql .= " AND p_id =  '$rowid' ";
		if(!empty($fromprice))
		{
		//echo "hello";
		$sql .= " AND ss_price >=  '$fromprice' " ;
		}
		if(!empty($toprice))
		{
		$sql .= " AND ss_price <= '$toprice' " ;
		
		}
		if(strlen($stdate)>0)
		{
		$sql .= " AND ss_startdate >= '$stdate' " ;
		}
		if(strlen($endate)>0)
		{
		$sql .= "AND ss_enddate <= '$endate' " ;
		}
		$res=mysql_query($sql) or  die($sql."<br/>".mysql_error());

$revenue=0;
$tq=0;
        echo "<table border='1' style='margin-left:100px;margin-top:20px'>
<tr>
<th>Product Name</th>
<th>Ordered By</th>
<th>Quantity</th>
<th>Price</th>
<th>OrderDate</th>
</tr>";

 while($row1 = mysql_fetch_array($res)) {
$pid=$row1['p_id'];
  $newsql="select * from orderdetails where p_id = $pid AND 1";
  if(strlen($orderstartdate)>0)
		{
		$newsql .= " AND OrderDate >= '$orderstartdate' " ;
		}
		if(strlen($orderenddate)>0)
		{
		$newsql .= " AND OrderDate <= '$orderenddate' " ;
		}
  $res1=mysql_query($newsql);
  $numrows=mysql_num_rows($res1);

  while($row2=mysql_fetch_array($res1))
  {
  
  $orderid=$row2['OrderId'];
  $pq=$row2['productquantity'] ;
$pp=$row2['productprice'];
$revenue+=$pq*$pp;
$tq+=$row2['productquantity'];
  
  $ordersql=mysql_query("select * from orders where OrderId='$orderid'");
  if($row3=mysql_fetch_array($ordersql))
  {
  $customerfirstname=$row3['CustomerFirstName'];
  $customerlastname=$row3['CustomerLastName'];
  }
  
  echo "<tr>";
  //echo $row1['p_name'];
  echo "<td>" . $row2['Cake_name'] . "</td>";
  echo "<td>" . $customerfirstname ."&nbsp;&nbsp;". $customerlastname. "</td>";
  echo "<td>" . $row2['productquantity'] . "</td>";
  echo "<td>" . $row2['productprice'] . "</td>";
  echo "<td>" . $row2['OrderDate'] . "</td>";
  echo "</tr>";
}
}


echo "<span style='background-color:#cc0000;color:#ffffff;margin-left:100px;margin-top:20px;height:200px;border-radius:5px'>REVENUE GENERATED:<b>$".$revenue."</b></span>";
echo "<br/><br/>";
echo "<span style='background-color:#cc0000;color:#ffffff;margin-left:100px;margin-top:20px;height:200px;border-radius:5px'>QUANTITY SOLD:<b>".$tq."</b></span>";
echo "</table>";
	}	
}
else
{
$q = $_GET['select'];
//echo "$q";
$con=mysql_connect('cs-server.usc.edu:50422','root','MOMDAD@05');
if(!$con)
{
die ("cannot connect");
}
mysql_select_db('bakery_database');

$query="select * from specialsales where p_id in(select p_id from products where pc_id = '".$q."')";
$result = mysql_query($query);


$revenue=0;
$tq=0;
        echo "<table border='1' style='margin-left:100px;margin-top:20px'>
<tr>
<th>Product Name</th>
<th>Ordered By</th>
<th>Quantity</th>
<th>Price</th>
<th>OrderDate</th>
</tr>";

while($row1 = mysql_fetch_array($result)) {
$newid=$row1['p_id'];
$newsql="select * from orderdetails where p_id= $newid";
$resval=mysql_query($newsql);
$count=0;
while($row2=mysql_fetch_array($resval))
  {
  $orderid=$row2['OrderId'];
  $pq=$row2['productquantity'] ;
$pp=$row2['productprice'];
$revenue+=$pq*$pp;
$tq+=$row2['productquantity'];
  
  $ordersql=mysql_query("select * from orders where OrderId='$orderid'");
  if($row3=mysql_fetch_array($ordersql))
  {
  $customerfirstname=$row3['CustomerFirstName'];
  $customerlastname=$row3['CustomerLastName'];
  }
  echo "<tr>";
  //echo $row1['p_name'];
  echo "<td>" . $row2['Cake_name'] . "</td>";
  echo "<td>" . $customerfirstname ."&nbsp;&nbsp;". $customerlastname."</td>";
  echo "<td>" . $row2['productquantity'] . "</td>";
  echo "<td>" . $row2['productprice'] . "</td>";
  echo "<td>" . $row2['OrderDate'] . "</td>";

  echo "</tr>";
}
}
echo "<span style='background-color:#cc0000;color:#ffffff;margin-left:100px;margin-top:20px;height:200px;border-radius:5px'>REVENUE GENERATED:<b>$".$revenue."</b></span>";
echo "<br/><br/>";
echo "<span style='background-color:#cc0000;color:#ffffff;margin-left:100px;margin-top:20px;height:200px;border-radius:5px'>QUANTITY SOLD:<b>".$tq."</b></span>";
echo "</table>";

mysql_close($con);
}

echo "<a href='managernew.php'>Go Back</a>";
echo "<br/>";
echo "<a href='ViewSalesReport.php'>Cancel</a>";


?>