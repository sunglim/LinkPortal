<html>
<head>
<link rel="stylesheet" type="text/css" href="main.css" />
<link rel="stylesheet" type="text/css" href="normalize.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="./main.js"></script>
<script type="text/javascript">

var xmlhttp;

var getAjaxRequest = function(){
	if(xmlhttp != '' || xmlhttp != null){
		if (window.XMLHttpRequest)	{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		};
	};
};

function getParameterByName(name)
{
  name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
  var regexS = "[\\?&]" + name + "=([^&#]*)";
  var regex = new RegExp(regexS);
  var results = regex.exec(window.location.search);
  if(results == null)
    return "";
  else
    return decodeURIComponent(results[1].replace(/\+/g, " "));
};

function insertMedia()
{
	getAjaxRequest();
	var member_id = getParameterByName("member_id");
	var httpurl;
	var url = document.getElementById('url').value;
	if (url.indexOf('http://') == -1 && url.indexOf('https://') == -1)
		httpurl = 'http://' + url;
	else
		httpurl = url;
		
	var desc = document.getElementById('desc').value;
	desc = desc.replace(/\s+/g, ' ');	//remove space
	desc = desc.replace(/(['"])/g, "\\$1");
	
	if(httpurl == "" || desc == ""){
		alert("fill url and desc");
	}

	var params = "?member_id="+member_id+"&url="+httpurl+"&desc="+desc;
	alert(params);
	xmlhttp.open("GET","insert_ajax.php"+params,true);

	xmlhttp.send();

	alert("Inserted");
	setTimeout(window.location.reload(),1000);
}

function deleteUrl(idx){
	if(confirm('Delete index ' + idx +' ?')){
		getAjaxRequest();
		var params = "?idx="+ idx+"&table="+"<?= $_GET['table'] ?>";

		xmlhttp.open("GET","delete_ajax.php"+params,true);

		xmlhttp.send();

		alert("Removed");

		setTimeout(window.location.reload(),1000);
	};
};

function initialize(){
	var title_= getParameterByName("member_id") ;
	$("#titles").html("VISIT ON PC : http://10.177.41.56/users/linkportal/index.php?member_id=" + title_ );
	
	var password = getParameterByName("password");
	if(password != '1234')
		$('[name="btnRemove"]').hide();
	document.getElementById('imgBlackman').style.webkitTransform =
    'rotateZ(' + (timeStamp * 18.0) + 'deg)';
};

</script>
</head>
<body onload="initialize();">
 <canvas id="mycanvas"></canvas>
<!-- TV Area Div -->
<div style="left: 0px; top: 0px; width: 1280px; height: 720px;  position:absolute; background-color: #F7E9E9; border:1px solid #c33;">
<table style="left: 138px; top: 5px; position:absolute;">
	<tr>
		<th id='titles' colspan=2>
		
		</td>
	</tr>
	<tr>
	<td>
		URL : <input id="url" name="media_url" type="text" style="width:400px;"/>
	</td>
	<td>
		desc : <input id="desc"  type="text" style="width:400px;"/>
	</td>
	<td>
		<input type="button" value="INSERT!" onclick="insertMedia()" />
	</td>
	</tr>
</table>

<table id="mycell" style="left: 128px; top: 86px; position:absolute;">
	<tbody id='maintbody'>
<?php

include("db_settings.php");

$table = $_GET['member_id'];

$query = "select * from BROWSER_LINKBOARD_URL WHERE member_id=".$table." ORDER BY id desc"; 

$result = mysql_query($query); 

if (!$result) { 
	echo "error query"; 
	exit; 
} 

$rows  = mysql_num_rows($result); 

$i = 1;
$TD_COUNT = 4;
echo "<tr>";
while ($i<$rows) { 
	$row = mysql_fetch_row($result);
	
	echo "<td dbid=\"".$row[0]."\" name=\"".$row[2]."\">".substr($row[3],0,20)."<a name='btnRemove' href=\"javascript:deleteUrl('".$row[0]."');\">[x]</a></td>";
	if($i % $TD_COUNT == 0){
		echo "</tr><tr>";
	}

	$i++;
} 
echo "</tr>";
mysql_close($link); 

?>
	</tbody>
</table>
<a href="http://www.limsungguk.com"><img id='imgBlackman' src="blackman.png" style="left: 58px; top: 16px; width: 70px; height: 70px; position:absolute;"/></a>
</div>
<div id='showUrlDiv' style="left: 50px; top: 600px; width:1200px; height: 50px;  position:absolute;border:1px solid #c33;  background-color: #507AAA;color: white;font-size:150%;">http://www.limsungguk.com</div>

</body>
</html>

<!-- insert ajax -->
<?php

if(count($_GET)>0){
	include("db_settings.php");

	$member_id = $_GET['member_id'];
	$url = $_GET['url'];
	$desc = $_GET['desc'];

	if (!$select) {
		die('Not connected : ' . mysql_error());
	}

	$sql = "INSERT INTO BROWSER_LINKBOARD_URL(member_id,url,url_desc) VALUES(".$member_id.",'".$url."','".$desc."')";
	$result = mysql_query($sql);

	mysql_close($link); 
}else{

}

?>
<!-- end of insert ajax-->
<!-- delete ajax -->
<?php

if(count($_GET)>0){
	include("db_settings.php");

	$index = $_GET['idx'];

	if (!$select) {
		die('Not connected : ' . mysql_error());
	}

	$sql = "DELETE FROM BROWSER_LINKBOARD_URL WHERE id=".$index.";";

	$result = mysql_query($sql);

	mysql_close($link); 
}

?>
<!-- end of delete ajax -->