<html>
<?php
session_start();
if(!isset($_SESSION['username']))
{
header('Location: main_2.html');
}
$user=$_SESSION['username'];
$uid=$_SESSION['id'];
$gid=$_GET['gid'];
$host="localhost";
$username="root";
$password="megamind";
$database="site_data";
$con = mysql_connect($host,$username,$password);
if(!$con)
{
	die("Coudn't connect :".mysql_error());
}
mysql_select_db($database,$con)or die("Sorry, couldn't connect to the database");
$query="delete from bel_user_grp where groupid=$gid and userid=$uid";
$result=mysql_query($query) or mysql_error();
echo "uid = $uid gid = $gid user = $user";
// some issue in here, deletion through php script ain't working
header('Location: userhome.php?id='.$uid);
?>
</html>
