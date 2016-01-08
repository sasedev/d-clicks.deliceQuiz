<?php
/*
 * Created on 30 oct. 2008 
 * by Salah Abdelkader Seif Eddine 
 * using PHPeclipse
 */

session_start();
if(isset($_SESSION["gagnant"]) && $_SESSION["gagnant"] == "1") {
	$_SESSION["gagnant"] = null;
	$_SESSION["logged"] = null;
} else {
	header("Location: index.php");
	exit(0);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript">AC_FL_RunContent = 0;</script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<title>Bravo</title>
<style type="text/css">
#page
   {
     position: absolute;

     width: 564px;        /* selon la largeur voulue */
     margin-left: -282px;  /* moitie de width */
     left: 50%;          /* constant, toujours 50% */

     height: 409px;       /* selon la quantite de texte */
     margin-top: -205px;   /* moitie de height */
     top: 50%;           /* constant, toujours 50% */
}
body{
	font: Verdana, Arial, Helvetica, sans-serif;
	font-size: 13px;
	background-color: #e47907;
	margin: 0px;
	}
td{
	color: #000000;
	font-weight: bolder;
	}
input{
	font: Verdana, Arial, Helvetica, sans-serif;
	font-size: 13px;
	color: #000066;
	background-color: #FFFF00;
	}
select{
	font: Verdana, Arial, Helvetica, sans-serif;
	font-size: 13px;
	color: #000066;
	background-color: #FFFF00;
	}
option{
	font: Verdana, Arial, Helvetica, sans-serif;
	font-size: 13px;
	color: #000066;
	background-color: #FFFF00;
	}
textarea{
	font: Verdana, Arial, Helvetica, sans-serif;
	font-size: 13px;
	color: #000066;
	background-color: #FFFF00;
	}		
</style>
</head>

<body>
<div id="page">
<!--url's used in the movie-->
<!--text used in the movie-->

<!-- saved from url=(0013)about:internet -->
<table align="center">
<tr>
<td>
<script language="javascript">
	if (AC_FL_RunContent == 0) {
		alert("This page requires AC_RunActiveContent.js.");
	} else {
		AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
			'width', '564',
			'height', '409',
			'src', 'bravo',
			'quality', 'high',
			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', 'window',
			'devicefont', 'false',
			'id', 'Bravo',
			'bgcolor', '#e47907',
			'name', 'Bravo',
			'menu', 'true',
			'allowFullScreen', 'false',
			'allowScriptAccess','sameDomain',
			'movie', 'bravo',
			'salign', ''
			); //end AC code
	}
</script>
<noscript>
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553555700" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="564" height="409" id="selartistic_agency" align="middle">
	<param name="allowScriptAccess" value="sameDomain" />
	<param name="allowFullScreen" value="false" />
	<param name="movie" value="bravo.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#e47907" />	<embed src="bravo.swf" quality="high" bgcolor="#e47907" width="564" height="409" name="Bravo" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object>
</noscript>

</td>
</tr>
</table>
</div>
</body>
</html>
