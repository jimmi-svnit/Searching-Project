<html>
<a href="userhome.php">
<img src="hometab.jpg" alt="//the home tab//"></a>
<?php
session_start();
echo "<br/><br/>Hey ".$_SESSION['username'].",";
$uid=$_SESSION['id'];
$user=$_SESSION['username'];
$grppost=$_POST['name'];
$cntt=$_POST['cntt'];
$gid=$_POST['gid'];
if(!$grppost)
{
header('Location:crtdisc.php');
}
$host="localhost";
$username="root";
$password="megamind";
$database="site_data";
echo "uid = $uid";
$con = mysql_connect($host,$username,$password);
if(!$con)
{
	die("Coudn't connect :".mysql_error());
}
mysql_select_db($database,$con)or die("Sorry, couldn't connect to the database");

$query="select max(id) from grp_post";
$result=mysql_query($query);
$row = mysql_fetch_array($result);
$id=$row[0]+1;
$date=getdate();

$query="insert into grp_post values($id,'$grppost')";
$result=mysql_query($query);

$query="insert into bel_post_grp values($gid,$id)";
$result=mysql_query($query);
if($result==1)
{	
	echo "<br/>Congrats! Your group post has been added successfully <br>id = $id";
}
else
{
	echo "<br/>Couldn't add the group post";
}
$query="commit";
$result=mysql_query($query);
header('Location:disc.php?disid='.$id.'&gid='.$gid);
?>
</html>
