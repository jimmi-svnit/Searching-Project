<html>
<?php
session_start();
if(!isset($_SESSION['username']))
{
header('Location: main_2.html');
echo "Not in session :( username = ".$_SESSION['username'];
}
?>
<head>
<title>User Homepage!!</title>
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
width:500px;
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
width:1140px;
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

<img src="background.jpg" alt="crayons" id="bg" />
<p1>

<a href="history.php" method="post">
<img src="history.png" alt="History Button" width="10%" height="4%" align="top" />
</a>

<a href="crtgrp.php" method="get">
<img src="create_group.png" alt="Create Group Button" width="10%" height="4%" align="top" />
</a>

<a href="crttop.php" method="get">
<img src="create_topic.png" alt="Create Topic Button" width="10%" height="4%" align="top" />
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
<?php
$host="localhost";
$username="root";
$password="megamind";
$database="site_data";
$table1="users";
$table2="topics";
$table3="groups";
$rel1="stk_user_top";
$rel2="bel_user_grp";
$rel3="stk_grp_top";
$theuser=$_SESSION['username'];
$uid=$_SESSION['id'];
$con = mysql_connect($host,$username,$password);
if(!$con)
{
	die("Coudn't connect :".mysql_error());
}
mysql_select_db($database,$con)or die("Sorry, couldn't connect to the database");
$query="select last_login from users where id=$uid";
$result=mysql_query($query);
$row = mysql_fetch_array($result);
$lastlogin=$row[0];

echo "<br/><br/>";
echo "<div class='ex'><b><big>Anything new....</big></b><br/>";
$query="select distinct(discid) from log_disc_grp where dt>'$lastlogin'";
$result=mysql_query($query);
$cnt = mysql_num_rows($result);
if($cnt==0)
{}
else
{	//echo "<br/>New replies on the discussion(s):";
	while($row = mysql_fetch_array($result))
	{	
		$query2="select gid from log_disc_grp where discid=$row[0]";		
		$result2=mysql_query($query2);
		$row2 = mysql_fetch_array($result2);
		$query4="select name from groups where id=$row2[0]";		
		$result4=mysql_query($query2);
		$row4 = mysql_fetch_array($result2);
		$query3="select name from grp_post where id=$row[0]";		
		$result3=mysql_query($query3);
		$row3 = mysql_fetch_array($result3);

		echo "<br/>Reply added to discussion $row3[0] in group $row4[0]";
	}
}
$query="select distinct(tid) from log_crt_top where dt>'$lastlogin'";
$result=mysql_query($query);
$cnt = mysql_num_rows($result);
if($cnt==0)
{}
else
{	while($row = mysql_fetch_array($result))
	{	
		$query2="select name from topics where id=$row[0]";		
		$result2=mysql_query($query2);
		$row2 = mysql_fetch_array($result2);
		echo "<br/>Topic $row2[0] created";
	}
}
$query5="select distinct(tid) from log_upl_top where dt>'$lastlogin'";
$result5=mysql_query($query5);
$cnt5 = mysql_num_rows($result5);
if($cnt5==0)
{}
else
{	while($row5 = mysql_fetch_array($result5))
	{	
		$query2="select name from topics where id=$row5[0]";		
		$result2=mysql_query($query2);
		$row2 = mysql_fetch_array($result2);
		echo "<br/>New explanation added for $row2[0]";
	}
}
echo "</div>";

echo "<div class='ex'><b><big>The Groups:</big></b><br />";
$query="select $table3.name,$table3.id from $table3, $table1, $rel2 where $table3.id=$rel2.groupid and $rel2.userid=$table1.id and $table1.name='$theuser'";
$result=mysql_query($query);
$cnt = mysql_num_rows($result);
if($cnt==0)
{	echo "You ain't part of any group yet...";	}
else
{	echo "<br/>Thy groups : <br/>";
	while($row = mysql_fetch_array($result))
	{	echo "<a href='grphome.php?id=$row[1]'>".$row[0]."</a><br/>";	}
}
echo "<a href='grplist.php' method='get'>See all groups</a>";
echo "</div>";

echo "<div class='ex2'><b><big>Stalker Listing:</big></b><br />";
$query="select $table2.name,$table2.id from $table2,$table1,$rel1 where $table1.id=$rel1.userid and $rel1.topicid=$table2.id and $table1.name='$theuser'";
$result=mysql_query($query);
$cnt = mysql_num_rows($result);
if($cnt==0)
{	echo "You ain't following any topics yet...";	}
else
{	echo "<br/>Your stalker listing : <br/>";
	while($row = mysql_fetch_array($result))
	{	echo "<a href='thetopic.php?topic=$row[1]'>$row[0]</a><br/>";	}
}
echo "</div>";
?>

</body>
</html>
