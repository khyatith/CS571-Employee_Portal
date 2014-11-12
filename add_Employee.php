<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['position']) && isset($_SESSION['timeout']))
{
$inactive=600;
$t=time();
if(($t-$_SESSION['timeout']) > $inactive) {
header("Location:/logout.php"); 
}
}
error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);
$eid="";
if(isset ($_POST['Change']))
{
$_SESSION['Change']=$_POST['Change'];
$d=$_SESSION['Change'];
//echo "$d";
$_SESSION['Add']='';
$eid=$_POST['Change'];
}
if($eid)
{
$row = $_POST['Change'];
	if(isset($_POST['Change']))
	{
	$check=count($_POST['Change']);
	//echo "$check";
	}

$con=mysql_connect("cs-server.usc.edu:50422","root","MOMDAD@05");
if(!$con)
{
die ("cannot connect");
}
mysql_select_db('bakery_database');

$sql="select * from users where e_id= '$row'";
$res=mysql_query($sql);
if($row1=mysql_fetch_array($res))
{
$row1['e_fname'];
$row1['e_lname'];
$row1['e_username'];
$row1['e_address'];
$row1['e_city'];
$row1['e_zip'];
$row1['e_contact'];
$row1['e_email'];
$row1['e_dob'];
$row1['e_age'];
$row1['e_gender'];
$row1['e_startdate'];
$row1['e_position'];
$row1['e_salary'];

}
if($row1['e_gender']=="Male")
{
$genm=$row1['e_gender'];
//echo "$genm";
}
else if($row1['e_gender']=="Female")
{
$genm=$row1['e_gender'];
//echo "$genm";
}

if($row1['e_position']=="Manager")
{
$posm=$row1['e_position'];

}
else if($row1['e_position']=="Sales Manager")
{
$posm=$row1['e_position'];

}
else if($row1['e_position']=="Administrator")
{
$posm=$row1['e_position'];
}
}
if(isset($_POST['SubmitUpdate']))
{

$con=mysql_connect("localhost","root","MOMDAD@05");
if(!$con)
{
die ("cannot connect");
}
mysql_select_db('bakery_database');
$name=$_POST['e_fname'];
$lastname=$_POST['e_lname'];
$uname=$_POST['e_uname'];
$ad=$_POST['e_addr'];
$cc=$_POST['e_city'];
$zi=$_POST['e_zip'];
$number=$_POST['e_number'];
$em=$_POST['e_email'];
$borndate=$_POST['e_dob'];
$genmnew=$_POST['sex'];
$old=$_POST['e_age'];
$sd=$_POST['e_startdate'];

$sal=$_POST['e_salary'];

$d=strtotime($sd);
$today=getdate();
$birthdate=strtotime($borndate);
$min = strtotime('+20 years', $birthdate);
//$approxage=$today['year']-$birthdate['year'];
//$int_options=array('options' => array('min_range'=> 20, 'max_range'=>65));

if(isset($_POST['e_designation']))
{
$posmnew=$_POST['e_designation'];
}
if(isset($_POST['genm']))
{
$genmnew=$_POST['genm'];
}

if(strlen($name)==0 || strlen($lastname)==0 || strlen($uname)==0 || strlen($ad)==0 || strlen($cc)==0 || strlen($zi)==0 || strlen($sd)==0 || strlen($number)==0 || strlen($borndate)==0 || strlen($sal)==0 || strlen($old)==0 || strlen($em)==0)
{
$errormessage="Please Fill all the fields";

echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if(preg_match("/\b:(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~|]/i",$name))

{
$errormessage="Invalid First Name";

echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";

}
else if(preg_match("/\b:(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~|]/i",$lastname))
{
$errormessage="Invalid Last Name";

echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if(preg_match("/\b:(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~|]/i",$uname))
{
$errormessage="Invalid userName.It should be more than 6 characters long";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}


else if(preg_match("/\b:(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~|]/i",$ad))
{
$errormessage="Invalid Address";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if((preg_match("/\b:(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~|]/i",$cc)) || !preg_match("/^[a-zA-Z ]*$/",$cc))
{
$errormessage="Invalid City";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if((preg_match("/\b:(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~|]/i",$zi)) || preg_match("/^[a-zA-Z ]*$/",$zi))
{
$errormessage="Invalid zip-code";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if((preg_match("/\b:(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~|]/i",$number)) || preg_match("/^[a-zA-Z ]*$/",$number))
{
$errormessage="Invalid Contact";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}

else if(preg_match("/\b:(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~|]/i",$sal) || preg_match("/^[a-zA-Z ]*$/",$sal))
{
$errormessage="Invalid salary";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}

else if(preg_match("/\b:(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~|]/i",$old) || preg_match("/^[a-zA-Z ]*$/",$old))
{
$errormessage="Invalid age";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if(time()<$min)
{
$errormessage= "Employee needs to be atleast 20 years old.Please Check";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if($birthdate['mon']>12 || $birthdate['day']>31)
{
$errormessage="Invalid Date of Birth";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if($d['mon']>12 || $d['day']>31)
{
$errormessage="Invalid Date";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if(preg_match("/\b:(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~|]/i",$sd))
{
$errormessage="Invalid Date";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}

 else if($today['year']<$d['year'] )
{
$errormessage="Invalid year in date";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if($today['year']==$d['year'] && $today['mon']>$d['month'])
{
 $errormessage="Invalid month of year";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if($today['year']==$d['year'] && $today['mon']==$d['month'] && $today['mday']>$d['day'])
{
$errormessage="Invalid Day of Month";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}

else if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$em))
{
$errormessage="Invalid E-mail";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}

else
{
$id=$_SESSION['Change'];
//echo "$id";
//$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$password=$row1['e_position'];
$sql1="update users SET e_fname='$name',e_lname='$lastname',e_username='$uname',e_address='$ad',e_city='$cc',e_zip='$zi',e_contact='$number',e_email='$em',e_gender='$genmnew',e_dob='$borndate',e_age='$old',e_startdate='$sd',e_position='$posmnew',e_salary='$sal' where e_id= '".$_SESSION['Change']."'";
$retval = mysql_query( $sql1 );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
else 
{
$errormessage= "Updated data successfully\n";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
}
}


else if (isset($_POST['SubmitAdd'])) {
//if form has been submitted. check the values
error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);
//error_reporting (E_ALL ^ E_NOTICE); 
//error_reporting (E_ALL & ~E_NOTICE);
$fname=$_POST['e_fname'];
$lname=$_POST['e_lname'];
$username=$_POST['e_uname'];
$password=$_POST['e_password'];
$addr=$_POST['e_addr'];
$city=$_POST['e_city'];
$zip=$_POST['e_zip'];
$startdate=$_POST['e_startdate'];
//$gender=$_POST['sex'];
$number=$_POST['e_number'];
$dateofbirth=$_POST['e_dob'];
$salary=$_POST['e_salary'];
//$designation=$_POST['e_designation'];
$email=$_POST['e_email'];
$age=$_POST['e_age'];
$errormessage="";
$d=strtotime($startdate);
$today=getdate();
//echo "input:$d[year],$d[month],$d[day]";

//echo "today:$today[year],$today[mon],$today[mday]";

//$birthdate=$strtotime($dateofbirth);

$min = strtotime('+20 years', $birthdate);

//$approxage=$today['year']-$birthdate['year'];



$int_options=array('options' => array('min_range'=> 20, 'max_range'=>65));

if(isset($_POST['sex']))
{
if($_POST['sex']=='Male')
{
$gender="Male";
}
else
{
$gender="Female";
}

}
if(isset($_POST['e_designation']))
{
if($_POST['e_designation']=='Manager')
{
$designation="Manager";
}
else if($_POST['e_designation']=='Sales Manager')
{
$designation="Sales Manager";
}
else 
{
$designation="administrator";
}

}

 
if(strlen($fname)==0 || strlen($lname)==0 || strlen($username)==0 || strlen($password)==0 || strlen($addr)==0 || strlen($city)==0 || strlen($zip)==0 || strlen($startdate)==0 || strlen($number)==0 || strlen($dateofbirth)==0 || strlen($gender)==0 || strlen($salary)==0 || strlen($designation)==0 || strlen($age)==0)
{
$errormessage="Please Fill all the fields";

echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if(preg_match("/\b:(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~|]/i",$fname))
{
$errormessage="Invalid First Name";

echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";

}
else if(preg_match("/\b:(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~|]/i",$lname))
{
$errormessage="Invalid Last Name";

echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if(preg_match("/\b:(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~|]/i",$username))
{
$errormessage="Invalid userName.It should be more than 6 characters long";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if(preg_match("/\b:(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~|]/i",$password))
{
$errormessage="Invalid Password";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if(strlen($password)<8 || strlen($password)>20)
{
$errormessage="Password must be between 8 and 20 characters";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if(preg_match("/\b:(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~|]/i",$addr))
{
$errormessage="Invalid Address";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if(preg_match("/\b:(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~|]/i",$city)|| (!preg_match("/^[a-zA-Z ]*$/",$city)))
{
$errormessage="Invalid City";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if(preg_match("/\b:(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~|]/i",$zip) || preg_match("/^[a-zA-Z ]*$/",$zip))
{
$errormessage="Invalid zip-code";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if(preg_match("/\b:(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~|]/i",$number) || preg_match("/^[a-zA-Z ]*$/",$number))
{
$errormessage="Invalid Number";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}

else if(preg_match("/\b:(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~|]/i",$salary) || preg_match("/^[a-zA-Z ]*$/",$salary))
{
$errormessage="Invalid salary";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}

else if(preg_match("/\b:(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~|]/i",$age) || preg_match("/^[a-zA-Z ]*$/",$age))
{
$errormessage="Invalid age";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if(time()<$min)
{
$errormessage= "invalid Age or Date of Birth.Please Check";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if($birthdate['mon']>12 || $birthdate['day']>31)
{
$errormessage="Invalid Date of Birth";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if($d['mon']>12 || $d['day']>31)
{
$errormessage="Invalid Date";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if(preg_match("/\b:(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~|]/i",$startdate))
{
$errormessage="Invalid Date";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}

 /*else if($today['year']>$d['year'] )
{ echo $today['year'];
echo $d['year'];
$errormessage="Invalid year in date";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}*/
else if($today['year']==$d['year'] && $today['mon']>$d['month'])
{
 $errormessage="Invalid month of year";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else if($today['year']==$d['year'] && $today['mon']==$d['month'] && $today['mday']>$d['day'])
{
$errormessage="Invalid Day of Month";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}

else if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
{
$errormessage="Invalid E-mail";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
}
else
{
$query1="select * from users";
//$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$sql="INSERT INTO users(e_username,e_password,e_fname,e_lname,e_address,e_city,e_zip,e_contact,e_email,e_dob,e_age,e_gender,e_startdate,e_position,e_salary) VALUES ('$username',password('$password'),'$fname','$lname','$addr','$city','$zip','$number','$email','$dateofbirth','$age','$gender','$startdate','$designation','$salary')";
$con=mysql_connect("cs-server.usc.edu:50422","root","MOMDAD@05");
if(!$con)
{
die ("cannot connect");
}
mysql_select_db('bakery_database');
$result=mysql_query($query1);
$count1=0;
while($rowset=mysql_fetch_assoc($result))
{
if($username==$rowset['e_username'])
{
$count++;
}
}

if($count==0)
{
$retval = mysql_query( $sql, $con );
$errormessage="Data Entered Successfully";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";
mysql_close($con);
}
else{
$errormessage="Username already exists";
echo "<html>";
echo "<body>";
echo "<h3 style='align:center;margin-left:600px;font-size:18pt;color:#CC0000'>";
echo "$errormessage";
echo "</h3>";
echo "</body>";
echo "</html>";

}



}
}

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
display:inline-block;
margin-right:200px;

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
margin-top:75px;
margin-left:-100px;
}
#addemployee
{
float:left;
margin-right:200px;
position:relative;
margin-left:-200px;
}
#addemployee2
{
float:left;
margin-right:400px;
position:relative;
margin-left:-50px;
}
#addemployee1
{
float:right;
margin-left:300px;
position:absolute;
width:100px;

}
#addemployee3
{
float:right;
margin-left:500px;
position:absolute;
width:100px;

}
h3{
font-size:14pt;
font-weight:bold;
font-family:'Times New Roman','serif';
display:inline-block;
}
#section {
    width: 80%;
    height: 200px;
    
    margin: auto;
    padding: 10px;
}
#one {
    width: 15%;
    height: 200px;
    
    float: left;
}
#two {
    margin-left: 15%;
    height: 200px;
    
}
#auto-style1 {
text-align: center;
display:inline-block;
color:#663300;
}

</style>
</head>
<body>
<div id="LoginPage">
<div id="Header">
<a href="logout.php" style="margin-left:700px;font-size:12pt">LogOut</a>

<?php

$eid="";
if(isset ($_POST['Change']))
{
$eid=$_POST['Change'];
}
if($eid || isset($_POST['SubmitUpdate']))
{
?>
<h3 style="font-family:'Times New Roman';font-size:26pt;color:#FF9900">UPDATE EMPLOYEE</h3>
</div>

<br/><br/><br/><br/>
<form action="add_Employee.php" method="post" name="updateempform">
<div id="addemployee2">
<div style="float: left;
    width: 100px;
    height: 20px;
    margin-right: 8px">
<b><h1 style="font-size:14pt;font-family:'Times New Roman,'serif';margin-top:30px;text-align:center" >First Name</h1></b></div>
<div style="float: left;
    margin-left: 100px"><input type="text" name="e_fname" value="<?php echo isset($row1['e_fname']) ? $row1['e_fname']: $name; ?>" id="e1"/>
</div>
<br/>
<div style="float: left;
    width: 100px;
    height: 20px;
    margin-right: 8px">
<b><h1 style="font-size:16pt;font-family:'Times New Roman,'serif';margin-top:30px;text-align:center">Last Name</h1></b> </div>
<div style="float: left;
    margin-left: 100px;margin-top:10px"><input type="text" value="<?php echo isset($row1['e_lname']) ? $row1['e_lname']: $lastname; ?>" name="e_lname" id="e2"/>
</div>

<div style="float: left;
    width: 100px;
    height: 20px;
    margin-right: 8px">
<b><h1 style="font-size:16pt;font-family:'Times New Roman,'serif';margin-top:30px;text-align:center">UserName</h1></b> </div>
<div style="float: left;
    margin-left: 100px;margin-top:10px"><input type="text" value="<?php echo isset($row1['e_username']) ? $row1['e_username']: $uname; ?>" name="e_uname" id="e2"/>
</div>

<!--<div style="float: left;
    width: 100px;
    height: 20px;
    margin-right: 8px">
<b><h1 style="font-size:16pt;font-family:'Times New Roman,'serif';margin-top:30px;text-align:center">Password</h1></b> </div>
<div style="float: left;
    margin-left: 100px;margin-top:10px"><input type="password" value="<?php echo isset($row1['e_password']) ? $row1['e_password']: $password; ?>" name="e_password" id="e2" disabled />
</div>-->



<div style="float: left;
    width: 100px;
    height: 20px;
    margin-right: 8px">
<b><h1 style="font-size:16pt;font-family:'Times New Roman,'serif';margin-top:30px;text-align:center">Street Address</h1></b> </div>
<div style="float: left;
    margin-left: 100px;margin-top:10px"><input type="textarea" value="<?php echo isset($row1['e_address']) ? $row1['e_address']: $ad; ?>" name="e_addr" id="e1"/>
</div><br/><br/>
<div style="float: left;
    width: 100px;
    height: 20px;
    margin-right: 20px"><br/>
<b><h1 style="font-size:16pt;font-family:'Times New Roman,'serif';margin-top:90px;text-align:center">City</h1></b> </div>
<div style="float: left;
    margin-left: 210px"><input type="text" value="<?php echo isset($row1['e_city']) ? $row1['e_city']: $cc; ?>" name="e_city" id="e1"/>
</div>
<div style="float: left;
    width: 100px;
    height: 20px;
    margin-right: 8px">
<b><h1 style="font-size:16pt;font-family:'Times New Roman,'serif';margin-top:30px;text-align:center">Zip-Code</h1></b> </div>
<div style="float: left;
    margin-left: 210px"><input type="text" value="<?php echo isset($row1['e_zip']) ? $row1['e_zip']: $zi; ?>" name="e_zip" id="e1"/>
</div>

<div style="float: left;
    width: 100px;
    height: 20px;
    margin-right: 8px">
<b><h1 style="font-size:16pt;font-family:'Times New Roman,'serif';margin-top:30px;text-align:center">Employee Start Date</h1></b> </div>
<div style="float: left;
    margin-left: 210px"><input type="text" name="e_startdate" value="<?php echo isset($row1['e_startdate']) ? $row1['e_startdate']: $sd; ?>" placeholder="YYYY/MM/DD" id="e1"/>
</div>

</div>

<div id="addemployee3">
<div style="float: left;
    width: 200px;
    height: 20px;
    margin-right: 8px">
<b><h1 style="font-size:16pt;font-family:'Times New Roman,'serif';margin-top:10px;text-align:center">Email ID</h1></b> </div>
<div style="float: left;
    margin-left: 210px"><input type="text" value="<?php echo isset($row1['e_email']) ? $row1['e_email']: $em; ?>" name="e_email" id="e1"/>
	</div>
<div style="float: left;
    width: 200px;
    height: 20px;
    margin-right: 8px">
<b><h1 style="font-size:16pt;font-family:'Times New Roman,'serif';margin-top:10px;text-align:center">Contact Number</h1></b> </div>
<div style="float: left;
    margin-left: 210px"><input type="text" value="<?php echo isset($row1['e_contact']) ? $row1['e_contact']: $number; ?>" name="e_number" id="e1"/>
	</div>
	<div style="float: left;
    width: 200px;
    height: 20px;
	margin-right:8px">
<b><h1 style="font-size:16pt;font-family:'Times New Roman,'serif';margin-top:20px;text-align:center;width:px">Date of Birth</h1></b> </div>
<div style="float: left; margin-left:100px;margin-top:10px"><input type="text" value="<?php echo isset($row1['e_dob']) ? $row1['e_dob']: $borndate; ?>" style="margin-left:108px" placeholder="YYYY/MM/DD" name="e_dob" id="e1"/>
</div>
<div style="float: left;
    width: 200px;
    height: 20px;
	margin-right:8px">
<b><h1 style="font-size:16pt;font-family:'Times New Roman,'serif';margin-top:20px;text-align:center;width:px">Age</h1></b> </div>
<div style="float: left; margin-left:100px;margin-top:10px"><input type="text" value="<?php echo isset($row1['e_age']) ? $row1['e_age']: $old; ?>" style="margin-left:108px" name="e_age" id="e1"/>
</div>


<table>
<tr><td style="font-size:16pt;font-family:'Times New Roman,'serif';" width="100px"><b>Gender</b></td>
<td style="font-size:16pt;font-family:'Times New Roman,'serif';" width="400px" ><input name="sex" type="radio" value="Male" <?php if($genm=="Male") { echo "CHECKED";} else if($genmnew=="Male") { echo "CHECKED";}?> style="width:20px;height:20px;position:absolute;margin-left:150px;margin-top:10px;margin-right=20px"><div style="margin-top:30px;margin-left:130px">Male</div>
</td><td style="font-size:16pt;font-family:'Times New Roman,'serif';" ><input name="sex" value="Female" <?php if ($genm=="Female"){echo "CHECKED";}  else if($genmnew=="Female") { echo "CHECKED";} ?> style="width:20px;height:20px;position:fixed;margin-top:2px;margin-right=20px;margin-left:130px" type="radio"><div style="margin-top:20px;margin-left:100px">Female</div> 


</div></td></tr></table>


<div style="float: left;
    width: 200px;
    height: 20px;
	margin-right:8px
	margin-top:100px">
<b><h1 style="font-size:16pt;font-family:'Times New Roman,'serif';margin-top:100px;text-align:center">Annual Salary</h1></b> </div>
<div style="float: left; margin-left:100px;margin-top:10px"><input type="text" value="<?php echo isset($row1['e_salary']) ? $row1['e_salary']: $sal; ?>"  style="margin-left:108px" name="e_salary" id="e1"/>
</div>

<table>
<tr><td style="font-size:16pt;font-family:'Times New Roman,'serif';" width="100px"><b>Designation</b></td>
<td style="font-size:16pt;font-family:'Times New Roman,'serif';" width="400px" ><input name="e_designation" value="Sales Manager"<?php if($posm=="Sales Manager"){echo "checked = CHECKED";} else if($posmnew=="Sales Manager") { echo "checked=CHECKED";}?> type="radio" style="width:20px;height:20px;position:absolute;margin-left:100px;margin-top:10px;margin-right=20px"><div style="margin-top:30px;margin-left:80px">Sales Manager</div>
</td><td style="font-size:16pt;font-family:'Times New Roman,'serif';" ><input name="e_designation" value="Manager" <?php if($posm=="Manager"){echo "checked = CHECKED";} else if($posmnew=="Manager") { echo "checked=CHECKED";}?> style="width:20px;height:20px;position:fixed;margin-top:2px;margin-right=20px;margin-left:130px" type="radio"><div style="margin-top:20px;margin-left:100px">Manager</div>
</td><td style="font-size:16pt;font-family:'Times New Roman,'serif';" ><input name="e_designation" type="radio" value="Administrator" <?php if($posm=="Administrator"){echo "checked = CHECKED";} else if($posmnew=="Administrator") { echo "checked=CHECKED";}?> style="width:20px;height:20px;position:fixed;margin-top:2px;margin-right=20px;margin-left:130px"><div style="margin-top:20px;margin-left:100px">Admin</div>  
</div></td></tr></table>


<input type="submit" id="Signin" value="Update"/>
<input type="hidden" name="SubmitUpdate" value="sent"/>
</form>
<form method="post" action="administrator.php">
<input type="submit" id="Signin" value="Back To Home" style="width:200px;margin-top:30px"/>
</form>
<?php
}

else if(!$eid)
{
?>
<h3 style="font-family:'Times New Roman';font-size:26pt;color:#FF9900">ADD AN EMPLOYEE</h3>
<form action="add_Employee.php" method="post" name="addempform">
<div id="addemployee">
<div style="float: left;
    width: 100px;
    height: 20px;
    margin-right: 8px">
<b><h1 style="font-size:14pt;font-family:'Times New Roman,'serif';margin-top:30px;text-align:center" >First Name</h1></b></div>
<div style="float: left;
    margin-left: 100px"><input type="text" value="<?php echo isset($fname) ? $fname: ''; ?>" name="e_fname" id="e1"/>
</div>
<br/>
<div style="float: left;
    width: 100px;
    height: 20px;
    margin-right: 8px">
<b><h1 style="font-size:16pt;font-family:'Times New Roman,'serif';margin-top:30px;text-align:center">Last Name</h1></b> </div>
<div style="float: left;
    margin-left: 100px;margin-top:10px"><input type="text" value="<?php echo isset($lname) ? $lname: ''; ?>"  name="e_lname" id="e2"/>
</div>

<div style="float: left;
    width: 100px;
    height: 20px;
    margin-right: 8px">
<b><h1 style="font-size:16pt;font-family:'Times New Roman,'serif';margin-top:30px;text-align:center">UserName</h1></b> </div>
<div style="float: left;
    margin-left: 100px;margin-top:10px"><input type="text" value="<?php echo isset($username) ? $username: ''; ?>" name="e_uname" id="e2"/>
</div>

<div style="float: left;
    width: 100px;
    height: 20px;
    margin-right: 8px">
<b><h1 style="font-size:16pt;font-family:'Times New Roman,'serif';margin-top:30px;text-align:center">Password</h1></b> </div>
<div style="float: left;
    margin-left: 100px;margin-top:10px"><input type="password" value="<?php echo isset($password) ? $password: ''; ?>" name="e_password" id="e2"/>
</div>



<div style="float: left;
    width: 100px;
    height: 20px;
    margin-right: 8px">
<b><h1 style="font-size:16pt;font-family:'Times New Roman,'serif';margin-top:30px;text-align:center">Street Address</h1></b> </div>
<div style="float: left;
    margin-left: 100px;margin-top:10px"><input type="text" value="<?php echo isset($addr) ? $addr: ''; ?>" name="e_addr" id="e1" >
</div><br/><br/>
<div style="float: left;
    width: 100px;
    height: 20px;
    margin-right: 20px"><br/>
<b><h1 style="font-size:16pt;font-family:'Times New Roman,'serif';margin-top:90px;text-align:center">City</h1></b> </div>
<div style="float: left;
    margin-left: 210px"><input type="text" value="<?php echo isset($city) ? $city: ''; ?>" name="e_city" id="e1"/>
</div>
<div style="float: left;
    width: 100px;
    height: 20px;
    margin-right: 8px">
<b><h1 style="font-size:16pt;font-family:'Times New Roman,'serif';margin-top:30px;text-align:center">Zip-Code</h1></b> </div>
<div style="float: left;
    margin-left: 210px"><input type="text" value="<?php echo isset($zip) ? $zip: ''; ?>" name="e_zip" id="e1"/>
</div>

<div style="float: left;
    width: 100px;
    height: 20px;
    margin-right: 8px">
<b><h1 style="font-size:16pt;font-family:'Times New Roman,'serif';margin-top:30px;text-align:center">Employee Start Date</h1></b> </div>
<div style="float: left;
    margin-left: 210px"><input type="text" name="e_startdate" value="<?php echo isset($startdate) ? $startdate: ''; ?>" placeholder="YYYY/MM/DD" id="e1"/>
</div>

</div>

<div id="addemployee1">
<div style="float: left;
    width: 200px;
    height: 20px;
    margin-right: 8px">
<b><h1 style="font-size:16pt;font-family:'Times New Roman,'serif';margin-top:10px;text-align:center">Email ID</h1></b> </div>
<div style="float: left;
    margin-left: 210px"><input type="text" value="<?php echo isset($email) ? $email: ''; ?>" name="e_email" id="e1"/>
	</div>
<div style="float: left;
    width: 200px;
    height: 20px;
    margin-right: 8px">
<b><h1 style="font-size:16pt;font-family:'Times New Roman,'serif';margin-top:10px;text-align:center">Contact Number</h1></b> </div>
<div style="float: left;
    margin-left: 210px"><input type="text" value="<?php echo isset($number) ? $number: ''; ?>" name="e_number" id="e1"/>
	</div>
	<div style="float: left;
    width: 200px;
    height: 20px;
	margin-right:8px">
<b><h1 style="font-size:16pt;font-family:'Times New Roman,'serif';margin-top:20px;text-align:center;width:px">Date of Birth</h1></b> </div>
<div style="float: left; margin-left:100px;margin-top:10px"><input type="text" value="<?php echo isset($dateofbirth) ? $dateofbirth: ''; ?>" style="margin-left:108px" placeholder="YYYY/MM/DD" name="e_dob" id="e1"/>
</div>
<div style="float: left;
    width: 200px;
    height: 20px;
	margin-right:8px">
<b><h1 style="font-size:16pt;font-family:'Times New Roman,'serif';margin-top:20px;text-align:center;width:px">Age</h1></b> </div>
<div style="float: left; margin-left:100px;margin-top:10px"><input type="text" value="<?php echo isset($age) ? $age: ''; ?>" style="margin-left:108px" name="e_age" id="e1"/>
</div>


<table>
<tr style="margin-right:-20px"><td style="font-size:16pt;font-family:'Times New Roman,'serif';width=100px;margin-right:-20px"><b>Gender</b></td>
<td style="font-size:16pt;font-family:'Times New Roman,'serif';" width="400px" ><input name="sex" type="radio" value="Male" style="width:20px;height:20px;position:fixed;margin-left:150px;margin-top:10px;margin-right=20px"><div style="margin-top:30px;margin-left:130px">Male</div>
</td><td style="font-size:16pt;font-family:'Times New Roman,'serif';" ><input name="sex" value="Female" style="width:20px;height:20px;position:fixed;margin-top:2px;margin-right=20px;margin-left:130px" type="radio"><div style="margin-top:20px;margin-left:100px">Female</div> 


</div></td></tr></table>


<div style="float: left;
    width: 200px;
    height: 20px;
	margin-right:8px
	margin-top:100px">
<b><h1 style="font-size:16pt;font-family:'Times New Roman,'serif';margin-top:100px;text-align:center">Annual Salary</h1></b> </div>
<div style="float: left; margin-left:100px;margin-top:10px"><input type="text" value="<?php echo isset($salary) ? $salary: ''; ?>" style="margin-left:108px" name="e_salary" id="e1"/>
</div>

<table>
<tr><td style="font-size:16pt;font-family:'Times New Roman,'serif'" width="100px"><b>Designation</b></td>
<td style="font-size:16pt;font-family:'Times New Roman,'serif'" width="400px" ><input name="e_designation" value="Sales Manager" type="radio" style="width:20px;height:20px;position:absolute;margin-left:100px;margin-top:10px;margin-right=20px"><div style="margin-top:30px;margin-left:80px">Sales Manager</div>
</td><td style="font-size:16pt;font-family:'Times New Roman,'serif'" ><input name="e_designation" value="Manager" style="width:20px;height:20px;position:fixed;margin-top:2px;margin-right=20px;margin-left:130px" type="radio"><div style="margin-top:20px;margin-left:100px">Manager</div>
</td><td style="font-size:16pt;font-family:'Times New Roman,'serif'" ><input name="e_designation" value="Administrator" style="width:20px;height:20px;position:fixed;margin-top:2px;margin-right=20px;margin-left:100px" type="radio"><div style="margin-top:20px;margin-left:100px">Admin</div>  
</div></td></tr></table>

<input type="submit" id="Signin" value="Add"/>
<input type="hidden" name="SubmitAdd" value="sent"/>

</div>

</form>
<form method="post" action="administrator.php">
<input type="submit" id="Signin" value="Back To Home" name="backtohome"  style="width:200px;margin-left:150px;margin-top:220px"/>
</form>
</body>
</html>
<?php
}

?>

