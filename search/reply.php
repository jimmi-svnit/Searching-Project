<html>
<?php
session_start();
echo "<br/><br/>Hey ".$_SESSION['username'].",";
$host="localhost";
$username="root";
$password="megamind";
$database="site_data";
$user=$_SESSION['username'];
$uid = $_SESSION['id'];
$rpl=$_POST['rpl'];
$gid=$_POST['gid'];
$postid=$_POST['disid'];
echo "uid = $uid";
$con = mysql_connect($host,$username,$password);
if(!$con)
{
	die("Coudn't connect :".mysql_error());
}
mysql_select_db($database,$con)or die("Sorry, couldn't connect to the database");
$grp=trim($grp);
$about=trim($about);
$grp=stripslashes($grp);
$about=stripslashes($about);
$grp=mysql_real_escape_string($grp);
$about=mysql_real_escape_string($about);

$query="select max(id) from replies";
$result=mysql_query($query);
$row = mysql_fetch_array($result);
$id=$row[0]+1;
$date=getdate();

$query="insert into replies values($id,'$user','$rpl')";
$result=mysql_query($query);
echo "<br/>post id =  $postid";
$query="insert into bel_rpl_post values($id,$postid)";
$result=mysql_query($query);
if($result==1)
{	
	echo "<br/>Congrats! Your reply has been added successfully <br>id = $id";
}
else
{
	echo "<br/>Couldn't add the reply";
}
$date=getdate();

$query="update groups set date_mod='$date[year]-$date[mon]-$date[mday]' where id=$gid ";
$result=mysql_query($query);


$query="select max(sr) from log_disc_grp";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
echo "<br/><br/>sr=$row[0]+1, gid=$gid, uid=$uid, date=current_date(), discid=$postid, rplid=$id";
$query="insert into log_disc_grp values($row[0]+1,$gid,$uid,current_date(),$postid,$id)";
$result=mysql_query($query);

$query="commit";
$result=mysql_query($query);
header('Location:disc.php?disid='.$postid);
?>
</html>
