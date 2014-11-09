<html>
<a href="userhome.php">
<img src="hometab.jpg" alt="//the home tab//"></a> 
<?php
session_start();
$eid=$_GET['expid'];
$uid=$_SESSION['id'];
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
$query="update explanations set likes=likes+1 where id=$eid";
echo "<br/><br/>";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
header('Location: explain.php?expid='.$eid);
?>
</html>
