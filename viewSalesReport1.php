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

$con= mysql_connect('cs-server.usc.edu:50422','root','MOMDAD@05');
		if(!$con)
		{		
			die ("Could not connect to database").mysql_error();
		}
		
		mysql_select_db('bakery_database',$con);
		$count=0;
		$sql="select * from specialsales where 1";
		if(strlen($proname)>0)
		{
		$presql="select * from specialsales where p_id in (select p_id from products  where p_name='$proname')";
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
		$errormessage="product not on sale";
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

        echo "<table border='1' style='margin-left:100px'>
<tr>
<th>Product Name</th>
<th>Sale Start Date</th>
<th>Sale End Date</th>
<th>Sale Price</th>
</tr>";

while($row1 = mysql_fetch_array($res)) {
$pid=$row1['p_id'];
  $newsql="select * from products where p_id = $pid";
  $res1=mysql_query($newsql);
  if($row2=mysql_fetch_array($res1))
  {
  $pname=$row2['p_name'];
  }
  echo "<tr>";
  //echo $row1['p_name'];
  echo "<td>" . $row2['p_name'] . "</td>";
  echo "<td>" . $row1['ss_startdate'] . "</td>";
  echo "<td>" . $row1['ss_enddate'] . "</td>";
  echo "<td>" . $row1['ss_price'] . "</td>";
 
  echo "</tr>";
}
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



        echo "<table border='1' style='margin-left:100px'>
<tr>
<th>Product Name</th>
<th>Sale Start Date</th>
<th>Sale End Date</th>
<th>Sale Price</th>
</tr>";

while($row1 = mysql_fetch_array($res)) {

  echo "<tr>";
  //echo $row1['p_name'];
  echo "<td>"   . $proname. "</td>";
  echo "<td>" . $row1['ss_startdate'] . "</td>";
  echo "<td>" . $row1['ss_enddate'] . "</td>";
  echo "<td>" . $row1['ss_price'] . "</td>";
 
  echo "</tr>";
}
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


echo "<table border='1' style='margin-left:100px'>
<tr>
<th>Product Name</th>
<th>Sale Start Date</th>
<th>Sale End Date</th>
<th>Price On Sale</th>
</tr>";

while($row1 = mysql_fetch_array($result)) {
$newid=$row1['p_id'];
$newsql="select * from products where p_id= $newid";
$resval=mysql_query($newsql);
$count=0;
while($row2=mysql_fetch_array($resval))
{
$pname=$row2['p_name'];
//echo "$pname";
}
  echo "<tr>";
  //echo $row1['p_name'];
  echo "<td>" . $pname . "</td>";
  echo "<td>" . $row1['ss_startdate'] . "</td>";
  echo "<td>" . $row1['ss_enddate'] . "</td>";
  echo "<td>" . $row1['ss_price'] . "</td>";

  echo "</tr>";
}
echo "</table>";

mysql_close($con);
}

echo "<a href='managernew.php'>Go Back</a>";
echo "<br/>";
echo "<a href='ViewSalesReport.php'>Cancel</a>";


?>