<html>
<?php
session_start();
$host="localhost";
$username="root";
$password="megamind";
$database="site_data";
$table="users";
$con = mysql_connect($host,$username,$password);
if(!$con)
{
	die("Coudn't connect :".mysql_error());
}

mysql_select_db($database,$con)or die("Sorry, couldn't connect to the database");

$user=$_POST["username"];
$pswd=$_POST["password"];

$user=trim($user);
$pswd=trim($pswd);
$user=stripslashes($user);
$pswd=stripslashes($pswd);
$user=mysql_real_escape_string($user);
$pswd=mysql_real_escape_string($pswd);

$query="select * from $table where emailid='$user' and password='$pswd'";
$result=mysql_query($query);
$cnt = mysql_num_rows($result);
$row = mysql_fetch_array($result);
if($cnt==1)
{
$_SESSION['username']=$row['name'];
$_SESSION['id']=$row['id'];
header('Location: userhome.php');
}
else
{
echo "login unsuccessful";
header('Location: main_2.html');
}
mysql_close();
?>
</html>
