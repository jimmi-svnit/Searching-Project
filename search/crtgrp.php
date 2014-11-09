<html>
<head>
<title>Create New Group!!</title>
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
text-align:left;
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

<img src="background.jpg" alt="crayons" id="bg" />
<p1>
<a href="logout.php" method="get">
<img src="log_out.png" alt="Log Out Button" width="10%" height="4%" align="top" />
</a>
</p1>
<?php
session_start();
if(!isset($_SESSION['username']))
{
header('Location: main_2.html');
}
?>
<ul id="navlist">
<p2>
<li id="home"><a href="userhome.php"></a></li>
<?php
echo "<br/><br/>Hey ".$_SESSION['username'].",";
?>
</p2>
</ul>

<form action="grp_crter.php" method="post">
<center>
<p2><b><big>CREATE NEW GROUP</b></big></p2><br/><br/><br/>
<p2><b><big>Name of the Group: </b></big></p2>
<input class="inputbox1" type="text" text-align="center" name="name"/><br/><br/>
<p2><b><big>About your Group: </b></big></p2>
<dd><textarea class="inputbox2" type="text" text-align="center" name="about" id="about"rows="30" cols="50"></textarea></dd>
<br/>
<input type="image" src="submit.png" alt="Submit" width="18%" height="7%" align="top"/>

</center>
<br/>
<br/>
</form>



<br/>
<br/>


</body>
</html>
