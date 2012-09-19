<html>
<head>
<link rel="stylesheet" type="text/css" href="main.css" />
<link rel="stylesheet" type="text/css" href="normalize.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="./main.js"></script>
</head>
<body>
<!-- TV Area Div -->
<div style="left: 0px; top: 0px; width: 1280px; height: 720px;  position:absolute; background-color: #F7E9E9; border:1px solid #c33;  z-index:-1;">
<table id="mycell" style="left: 128px; top: 36px; position:absolute;">
	<tbody>
<?php

include("db_settings.php");

if (!$select) {
	die('Not connected : ' . mysql_error());
}

$query = "select * from media_dash_mp4"; 
$result = mysql_query($query); 
if (!$result) { 
	echo "error query"; 
	exit; 
} 

$rows  = mysql_num_rows($result); 

$i = 1; 
echo "<tr>";
while ($i<$rows) { 
	$row = mysql_fetch_row($result);
	
	echo "<td name=\"".$row[2]."\">".substr($row[3],0,10)."</td>";
	if($i % 5 == 0){
		echo "</tr><tr>";
	}

	$i++;
} 
echo "</tr>";
mysql_close($link); 

?>
	</tbody>
</table>
<div id='showUrlDiv' style="left: 50px; top: 600px; width:1200px; height: 100px;  position:absolute;border:1px solid #c33;  background-color: #507AAA;color: white;font-size:150%;">http://www.daum.net</div>
</body>
</html>