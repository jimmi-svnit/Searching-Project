<html>
<head>
<title>Group Homepage!!</title>
<<link rel="stylesheet" type="text/css" href="hit_1.css" /></style>>

<style type="text/css">
html, body { height: 100%; margin: 0; padding: 0; color: #fff;}
a { color: #fff; }
#bg {position:fixed; top:0; left:0; width:100%; height:100%;}
#content {position:relative; z-index:1;}


</style>

<style type="text/css">
html {overflow-y:hidden;}
body {overflow-y:auto;}
#bg {position:absolute; z-index:-1;}
#content {position:static;}

</style>
<style type="text/css">

p1 {font-family:"Courier New";
    font-style:normal; 
    font-size:15; 
    font-weight:bold; 
    color: #996600; 
    margin: 0 0 700 700;
    text-align: right;
    text-indent: 50%
    
   }
p2 {font-family:"Courier New";
    font-style:normal; 
    font-size:15; 
    font-weight:bold; 
    color: #996600; 
    text-align: left;
    text-indent: 1%   }

a:link {color:#996600;}    /* unvisited link */
a:visited {color:#996600;} /* visited link */
a:hover {color:#996600;}   /* mouse over link */
a:active {color:#996600;}  /* selected link */

div.ex
{
font-family:"Courier New";
font-style:normal; 
font-size:15; 
font-weight:bold; 
color: #996600; 
text-align: left;
width:250px;
padding:10px;
border:5px solid orange;
margin:  10 10 10 100;
float:left;
border-bottom-left-radius:1em;
border-bottom-right-radius:1em;
border-top-left-radius:1em;
border-top-right-radius:1em;

}

div.ex2
{
font-family:"Courier New";
font-style:normal; 
font-size:15; 
font-weight:bold; 
color: #996600; 
text-align: left;
width:700px;
padding:10px;
border:5px solid orange;
margin:  10 10 10 100;
float:left;
border-bottom-left-radius:1em;
border-bottom-right-radius:1em;
border-top-left-radius:1em;
border-top-right-radius:1em;

}

#navlist{position:relative;}
#navlist li{margin:0;padding:0;list-style:none;position:relative;top:0%;}
#navlist li, #navlist a{height:50px;display:block;}

#home{left:2%; width:50px}
#home{background:url('home.png') 0 0;}
#home a:hover{background: url('home_hover.png') 0 0;}
	

.inputbox1{
width: 20%;
height: 5%;
margin: 0 1em 0 0;

text-indent:4%;
text-align:centre;
text-transform:uppercase;
color: #996600;
font-style:normal;
font-size:15;
font-weight: bold;
font-family:"Courier New";
border: 0;
background: url('small_bar.png') no-repeat center center;
}
</style>
</head>
<body>

<?php
session_start();
if(!isset($_SESSION['username']))
{
//header('Location: main_2.php');
echo "Not in session :( username = ".$_SESSION['username'];
}
$user=$_SESSION['username'];
$uid=$_SESSION['id'];

?>
<?php
$gid=$_GET['id'];
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

$query="select max(sr) from log_vis_grp";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
$query="insert into log_vis_grp values($row[0]+1,$gid,$uid,current_date())";
$result=mysql_query($query);
$date=getdate();

$query="update bel_user_grp set last_visit='$date[year]-$date[mon]-$date[mday]' where userid=$uid and groupid=$gid ";
$result=mysql_query($query);
$query="select userid from owner_user_grp where groupid=$gid";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
echo "<img src='background.jpg' alt='crayons' id='bg' />";
if($row[0] == $uid)
{
echo "<p1>";
echo "<a href='accept.php?gid=$gid' method='get'>";
echo "<img src='accept.png' alt='Accept New PPL' width='10%' height='4%' align='top' />";
echo "</a>";
}

$query="select count(*) from bel_user_grp where groupid=$gid and userid=$uid";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
if($row[0] == 0)
{
	header('Location: whogrp.php?id='.$gid);
}

?>
<?php
echo "<a href='unjoin.php?gid=$gid' method='get'>";
?>
<img src="unjoin.png" alt="Unjoin us Button" width="10%" height="4%" align="top" />
</a>
<a href="logout.php" method="get">
<img src="log_out.png" alt="Log Out Button" width="10%" height="4%" align="top" />
</a>
</p1>
<ul id="navlist">
<p2>
<li id="home"><a href="userhome.php"></a></li>
<?php
echo "Hey ".$_SESSION['username'];
?>
</p2>
</ul>

<form action="search.php" method="get">
<center>
<img src="cray_wanna2.png" alt="Head Search logo" width="15%" height="5%" align="top"/>
<input class="inputbox1" type="text" text-align="center" name="search_it"/>
<input type="image" src="search_button.png" alt="Submit" width="2%" height="5%" align="top" />
<img src="in_or.png" alt="OR logo" width="3%" height="3%" align="middle" />
<a href="catlist.php" method="post">
<img src="see_all.png" alt="Submit" width="15%" height="5%" align="top" />
</a>
</center>
</form>

<br/>
<p2><b><center>
<?php
$query="select name from groups where id=$gid";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
echo "$row[0]";
?>
</center></b></p2>
<br/>
<br/>
<?php
$query="select users.id, users.name from users,groups,bel_user_grp where groups.id=bel_user_grp.groupid and bel_user_grp.userid=users.id and groups.id=$gid";
$result=mysql_query($query);
$cnt = mysql_num_rows($result);
if($cnt==0)
{	echo "<br/>error in database...";	}
else
{	echo "<div class='ex'><b><big>Member Listing....</big></b><br/>";
	while($row = mysql_fetch_array($result))
	{	echo "$row[1]<br/>";	}
	echo "</div>";
}
$query="select grp_post.id, grp_post.name from grp_post,groups,bel_post_grp where groups.id=bel_post_grp.grp_id and bel_post_grp.post_id=grp_post.id and groups.id=$gid";
$result=mysql_query($query);
$cnt = mysql_num_rows($result);
if($cnt==0)
{	}
else
{	echo "<div class='ex2'><b><big>Dicussions:</big></b><br />";
	while($row = mysql_fetch_array($result))
	{	echo "<a href='disc.php?disid=$row[0]&gid=$gid'>$row[1]</a><br/>";	}
	echo "</div>";
}
echo "<br/><br/>";
echo "<a href='crtdisc.php?gid=$gid' method='get'>";
echo "Create a new discussion";
echo "</a>";

mysql_close($con);

?>
</body>
</html>
