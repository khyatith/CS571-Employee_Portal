<?php
$con= mysql_connect('cs-server.usc.edu:50422','root','MOMDAD@05');
		if(!$con)
		{		
			die ("Could not connect to database").mysql_error();
		}
		
		mysql_select_db('bakery_database',$con);
		
		//$sql="select pc_id from productcategories where pc_id in(select pc_id from products where p_id in(select p_id from orderdetails))";
		$sql="select * from orderdetails where p_id='218'";
		echo "hi";
		/*$result=mysql_query($sql);
		if(!$result)
		{
		die (mysql_error());
		}
		while($row=mysql_fetch_array($result))
		{
		echo "$row['p_id']";
		}*/
		?>