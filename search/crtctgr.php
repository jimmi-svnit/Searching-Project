<html>
<head>
<title>Create New Category!!</title>
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
    margin: 0 0 700 1100;
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

.inputbox2{
width: 40%;
height: 40%;
margin: 0 1em 0 0;

text-indent:7%;
text-align:centre;
text-transform:uppercase;
color: #996600;
font-style:normal;
font-size:15;
font-weight: bold;
font-family:"Courier New";
border: 0;
background: url('block.png') no-repeat center center;
}

</style>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['username']))
{
header('Location: main_2.html');
}
?>

<img src="background.jpg" alt="crayons" id="bg" />
<p1>
<a href="logout.php" method="get">
<img src="log_out.png" alt="Log Out Button" width="10%" height="4%" align="top" />
</a>
</p1>
<ul id="navlist">
<p2>
<li id="home"><a href="userhome.php"></a></li>
</p2>
</ul>
<html>
<?php
session_start();
$uid=$_SESSION['id'];
$cat=$_GET['cat'];
$topname=$_GET['name'];
$tags=$_GET['tags'];

$host="localhost";
$username="root";
$password="megamind";
$database="site_data";
$user=$_SESSION['username'];
$con = mysql_connect($host,$username,$password);
if(!$con)
{
	die("Coudn't connect :".mysql_error());
}
mysql_select_db($database,$con)or die("Sorry, couldn't connect to the database");

$query="select max(id) from categories";
$result=mysql_query($query);
$row = mysql_fetch_array($result);
$id=$row[0]+1;
$date=getdate();

$query="insert into categories values($id,'$cat','$date[year]-$date[mon]-$date[mday]','$date[year]-$date[mon]-$date[mday]')";
$result=mysql_query($query);
if($result==1)
{	
	echo "<p2><br/>Congrats! Your category has been added successfully <br></p2>";
}
else
{
	echo "<br/><p2>Couldn't add the category</p2>";
}
$query="commit";
$result=mysql_query($query);

echo "<form action='top_crter.php' method='post'>";
echo "<center>";
echo "<p2><b><big>CREATE NEW TOPIC</b></big></p2><br/><br/><br/>";
echo "<p2><b><big>Name of the Topic: </b></big></p2>";
echo "<dd><input class='inputbox1' type='text' text-align='center' name='name'  value='$topname'/></dd>";
echo "<br/>";
echo "<p2><b><big>Name of the Catagory: </b></big></p2>";
echo "<dd><input class='inputbox1' type='text' text-align='center' name='cat' value='$cat'/></dd>";
echo "<br/>";
echo "<p2><b><big>Tags Attach: </b></big></p2>";
echo "<dd><input class='inputbox1' type='text' text-align='center' name='tags' value='$tags'/></dd>";
echo "<br/>";
echo "<input type='image' src='submit.png' alt='Submit' width='18%' height='7%' align='top' />";
echo "</center>";
echo "<br/><br/></form>";

?>
</html>



