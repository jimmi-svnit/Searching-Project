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
<title>Logout page</title>
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

<ul id="navlist">
<p2>
<li id="home"><a href="userhome.php"></a></li>
</p2>
</ul>
<?php
session_start();
echo "<br/><br/>Hey ".$_SESSION['username'].",";
$uid=$_SESSION['id'];
$_SESSION['username'];
$grp=$_POST['name'];
$about=$_POST['about'];
if(!$grp)
{
header('Location:crtgrp.php');
}
$host="localhost";
$username="root";
$password="megamind";
$database="site_data";
$user=$_SESSION['username'];
$uid = $_SESSION['id'];
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

$query="select max(id) from groups";
$result=mysql_query($query);
$row = mysql_fetch_array($result);
$id=$row[0]+1;
$date=getdate();

$query="insert into groups values($id,'$grp','$user','$date[year]-$date[mon]-$date[mday]','$date[year]-$date[mon]-$date[mday]','$about')";
$result=mysql_query($query);

$query="insert into bel_user_grp values($uid,$id,'$date[year]-$date[mon]-$date[mday]')";
$result=mysql_query($query);
$query="insert into owner_user_grp values($uid,$id)";
$result=mysql_query($query);
if($result==1)
{	
	echo "<br/>Congrats! Your group has been added successfully <br>";
}
else
{
	echo "<br/>Couldn't add the group";
}
$query="commit";
$result=mysql_query($query);
echo "<a href='grphome.php?id=$id'>";
echo "Have a look at your group page :)"; 
echo "</a>";
?>

</body>
</html>
