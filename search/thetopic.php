<html>
<head>
<title>Topic Homepage!!</title>
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
    text-indent: 1%;
    margin: 50 50 100 100;
  }

p3 {font-family:"Courier New";
    font-style:normal; 
    font-size:20; 
    font-weight:bold; 
    color: #996600; 
    text-align: left;
    text-indent: 1%;
    margin: 50 50 100 100;
}

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
width:850px;
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

<img src="background.jpg" alt="crayons" id="bg" />
<p1>
<a href="logout.php" method="get">
<img src="log_out.png" alt="Log Out Button" width="10%" height="4%" align="top" />
</a>
</p1>
<ul id="navlist">
<p2>
<li id="home"><a href="userhome.php"></a></li>
<?php
session_start();
if(isset($_SESSION['username']))
{
echo "Hi ".$_SESSION['username']."<br/>";
$uid=$_SESSION['id'];
}
?>
</p2>
</ul>
<?php
$tid=$_GET['topic'];
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

$query="select max(sr) from log_vis_top";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
$query="insert into log_vis_top values($row[0]+1,$tid,$uid,current_date())";
$result=mysql_query($query);

$query="select * from topics where id=$tid";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
echo "<br/>";

echo "<p3><b>".$row['name']."</b></p3>";
if(isset($_SESSION['username']))
{
	$query="select users.name from users,topics,stk_user_top where topics.id=stk_user_top.topicid and stk_user_top.userid=users.id and topics.id=$tid and users.id=$uid";
	$result=mysql_query($query);
	$cnt = mysql_num_rows($result);
	echo "<p2><br/><br/>";
	if($cnt==0)
	{
	echo "<a href='stktop.php?tid=$tid' method='get'>";
	echo "<img src='stalk.png' alt='Submit' width='18%' height='5%' align='top' />";
	}
	else
	{
		echo "<a href='unstktop.php?tid=$tid' method='get'>";
		echo "<img src='unstalk.png' alt='Submit' width='18%' height='5%' align='top' />";	
	}
	echo "</p2>";
	$date=getdate();
	$query="update stk_user_top set last_visit='$date[year]-$date[mon]-$date[mday]' where userid=$uid and topicid=$tid ";
	$result=mysql_query($query);
}
$query="select explanations.id, explanations.name,explanations.format from explanations,topics,bel_expl_top where explanations.id=bel_expl_top.expl_id and bel_expl_top.top_id=topics.id and topics.id=$tid order by explanations.likes desc";
$result=mysql_query($query);
$cnt = mysql_num_rows($result);
if($cnt==0)
{	echo "<br/><p2>No explanations for this topic yet...</p2>";	}
else
{
	$numbering=1;	
	while($row = mysql_fetch_array($result))
	{	
		echo "<div class='ex'><b><big>Explanation $numbering....</big></b><br/><br/>";		
		$file = "/home/madhuri/uploads/".$row[1];
		$section = file_get_contents($file,NULL,NULL,0,50);	
		echo "<a href='explain.php?expid=$row[0]'>$row[1]</a>  [$row[2]]<br/>$section...<br/><br/>";	
		echo "</div>";	
		$numbering = $numbering + 1;
	}
}

?>

<br/>
<br/>
<?php
echo "<p2><a href='upload.php?tid=$tid' method='get'>";
echo "<img src='upload.png' alt='Submit' width='18%' height='5%' align='top' /></p2></a>";
?>

</body>
</html>
