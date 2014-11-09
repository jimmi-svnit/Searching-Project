
<html>
<head>
<title>Uploader</title>
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
if($_FILES["file"]["error"]>0)
{
	echo "Error : ".$_FILES["file"]["error"]."<br/>";
}
else
{
	echo "Upload    : ".$_FILES["file"]["name"]."<br/>";
	echo "Type      : ".$_FILES["file"]["type"]."<br/>";
	echo "Size      : ".($_FILES["file"]["size"]/1024)."Kb<br/>";
	echo "Stored in : ".$_FILES["file"]["tmp_name"]."<br/>";
	
	if(file_exists("/home/madhuri/uploads/".$_FILES["file"]["name"]))
	{
		echo $_FILES["file"]["name"]." already exists...";
	}
	else
	{
		if(move_uploaded_file($_FILES["file"]["tmp_name"],"/home/madhuri/uploads/".$_FILES["file"]["name"]))
		{
			echo "file uploaded happily!";
			$tid=$_POST['tid'];	
			$host="localhost";
			$username="root";
			$password="megamind";
			$database="site_data";
			$user=$_SESSION['username'];
			echo "uid = $uid";
			$con = mysql_connect($host,$username,$password);
			if(!$con)
			{
				die("Coudn't connect :".mysql_error());
			}
			mysql_select_db($database,$con)or die("Sorry, 	couldn't connect to the database");
			$query="select max(id) from explanations";
			$result=mysql_query($query);
			$row = mysql_fetch_array($result);
			$id=$row[0]+1;
			echo "id = $id";
			$fname = $_FILES['file']['name'];
			$fformat = $_FILES['file']['type'];
			$query = "insert into explanations values($id,'$fname','$fformat',0)";
			$result=mysql_query($query);
			$query="insert into bel_expl_top values($id,$tid)";
			$result=mysql_query($query);
			$date=getdate();
			$query="update topics set date_mod='$date[year]-$date[mon]-$date[mday]' where id=$tid ";
			$result=mysql_query($query);
		$query="select max(sr) from log_upl_top";
		$result=mysql_query($query);
		$row=mysql_fetch_array($result);
		$query="insert into log_upl_top values($row[0]+1,$tid,$uid,current_date())";
		$result=mysql_query($query);


			header('Location: thetopic.php?topic='.$tid);
		}
		else
		echo "Error uploading the file :( , error : ".$_FILES["file"]["error"];
	}
}
?>

</p2>
</ul>

</body>
</html>

