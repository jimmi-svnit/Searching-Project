<html>
<head>
<title>Discussion page!!</title>
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
$disid=$_GET['disid'];
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
$query="select grp_post.name from grp_post where id=$disid";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
echo "<br/>";
echo "<p3><b><big>".$row['name']."</big></b><br/></p3>";
echo "<br/>";
$query="select content,replier from replies,bel_rpl_post,grp_post where grp_post.id=bel_rpl_post.post_id and bel_rpl_post.rpl_id=replies.id and grp_post.id=$disid order by replies.id";
$result=mysql_query($query);
$cnt = mysql_num_rows($result);
if($cnt==0)
{	echo "<br/><ul><p2><b><big>No replies here...</b></big></p2></ul>";	}
else
{	
	echo "<br/><br/>";
	while($row = mysql_fetch_array($result))
	{	
		echo "<div class='ex'><b><big>$row[1] says </big></b><br/>$row[0]<br/><br/></div>";
	}
}

echo "<br/><br/><center>";
echo "<form action='reply.php' method='post'>";
echo "<ul><p2><b><big>Reply :</b></big></p2></ul><textarea name='rpl' id='rpl' cols=50 rows=4></textarea>";
echo "<input type='hidden' name='gid' value=$gid >";
echo "<input type='hidden' name='disid' value=$disid >";
echo "<br/><br/><br/><input type='submit' value='Submit' name='submit'>";
echo "</form></center>";
?>


</body>
</html>
