<?php
/*
 * Created on 30 oct. 2008
 * by Salah Abdelkader Seif Eddine
 * using PHPeclipse
 */
session_start();

require_once("cnf/cfg.php");
$link = mysqli_connect($dbhost, $dbuser, $dbpass);
if (!$link) {
	die('Impossible de se connecter : ' . mysqli_error());
}

// Rendre la base de données $dbname, la base courante
$dbln = mysqli_select_db($link, $dbname);
if (!$dbln) {
	die ('Impossible de sélectionner la base de donn&eacute;es : ' . mysqli_error());
}

if(!isset($_SESSION["logged"])) {
	header("Location: inscription.php");
	exit(0);
} else {
	$id = $_SESSION["logged"];
	if(!is_numeric($id)) {
		$_SESSION["logged"] = null;
		header("Location: inscription.php");
		exit(0);
	}
	$sql = "SELECT * FROM joueurs WHERE id = $id";
	$rs = mysqli_query($link, $sql) or die ('Erreur mysql : ' . mysqli_error());
	if(mysqli_num_rows($rs) == 0) {
		$_SESSION["logged"] = null;
		header("Location: inscription.php");
		exit(0);
	}
}
if(isset($_SESSION["gagnant"]) && $_SESSION["gagnant"] == "1") {
	header("Location: gagnant.php");
	exit(0);
}
$nbr_br = 0;
$nbr_ch = 0;
$v = $_REQUEST["v"];
if($v == "1") {

	$sql = "UPDATE joueurs SET nbrjeu = nbrjeu + 1 WHERE id = $id";
		mysqli_query($link, $sql) or die ('Erreur mysql : ' . mysqli_error());

	$q1 = $_REQUEST["q1"];
	if($q1 != "") { $nbr_ch++; }
	$q2 = $_REQUEST["q2"];
	if($q2 != "") { $nbr_ch++; }
	$q3 = $_REQUEST["q3"];
	if($q3 != "") { $nbr_ch++; }
	$q4 = $_REQUEST["q4"];
	if($q4 != "") { $nbr_ch++; }
	$q5 = $_REQUEST["q5"];
	if($q5 != "") { $nbr_ch++; }
	$q6 = $_REQUEST["q6"];
	if($q6 != "") { $nbr_ch++; }
	$q7 = $_REQUEST["q7"];
	if($q7 != "") { $nbr_ch++; }
	$q8 = $_REQUEST["q8"];
	if($q8 != "") { $nbr_ch++; }
	$q9 = $_REQUEST["q9"];
	if($q9 != "") { $nbr_ch++; }
	$q10 = $_REQUEST["q10"];
	if($q10 != "") { $nbr_ch++; }
	$q11 = $_REQUEST["q11"];
	if($q11 != "") { $nbr_ch++; }
	$q12 = $_REQUEST["q12"];
	if($q12 != "") { $nbr_ch++; }
	$q13 = $_REQUEST["q13"];
	if($q13 != "") { $nbr_ch++; }
	$q14 = $_REQUEST["q14"];
	if($q14 != "") { $nbr_ch++; }
	$q15 = $_REQUEST["q15"];
	if($q15 != "") { $nbr_ch++; }
	$q16 = $_REQUEST["q16"];
	if($q16 != "") { $nbr_ch++; }
	$q17 = $_REQUEST["q17"];
	if($q17 != "") { $nbr_ch++; }
	$q18 = $_REQUEST["q18"];
	if($q18 != "") { $nbr_ch++; }
	$q19 = $_REQUEST["q19"];
	if($q19 != "") { $nbr_ch++; }
	$q20 = $_REQUEST["q20"];
	if($q20 != "") { $nbr_ch++; }

	if($q1 == "3") { $nbr_br++; }
	if($q2 == "2") { $nbr_br++; }
	if($q3 == "3") { $nbr_br++; }
	if($q4 == "2") { $nbr_br++; }
	if($q5 == "2") { $nbr_br++; }
	if($q6 == "2") { $nbr_br++; }
	if($q7 == "1") { $nbr_br++; }
	if($q8 == "2") { $nbr_br++; }
	if($q9 == "3") { $nbr_br++; }
	if($q10 == "3") { $nbr_br++; }
	if($q11 == "3") { $nbr_br++; }
	if($q12 == "3") { $nbr_br++; }
	if($q13 == "2") { $nbr_br++; }
	if($q14 == "3") { $nbr_br++; }
	if($q15 == "3") { $nbr_br++; }
	if($q16 == "2") { $nbr_br++; }
	if($q17 == "2") { $nbr_br++; }
	if($q18 == "3") { $nbr_br++; }
	if($q19 == "1") { $nbr_br++; }
	if($q20 == "2") { $nbr_br++; }
	if($nbr_br >= 5) {
		$sql = "UPDATE joueurs SET date = NOW() WHERE id = $id";
		mysqli_query($link, $sql) or die ('Erreur mysql : ' . mysqli_error());
		$_SESSION["gagnant"] = "1";
		header("Location: gagnant.php");
		exit(0);
	} else {
		$haserr = true;
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Le Quiz D&eacute;lice</title>
<style type="text/css">
body{
	background-image: url(images/fond_quiz.jpg);
	background-position: top center;
	background-repeat: no-repeat;
	background-attachment: fixed;
	font: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	background-color: #e47907;
	margin: 0px;
	}
td{
	color: #000000;
	}
input{
	font: Verdana, Arial, Helvetica, sans-serif;
	font-size: 13px;
	color: #000066;
	}
a{
	color: #FFFF00;
	font-size: 12px;
	font-weight: bolder;
}
</style>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>
<body>
<table width="800px" cellpadding="0" cellspacing="0" border="0" align="center">
<tr>
	<td>
    <script type="text/javascript">
	AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','800','height','250','title','Le Quiz Délice','src','images/lequizdelice','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','wmode','transparent','scale','exactfit','movie','images/lequizdelice' ); //end AC code
	</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="800" height="250" title="Le Quiz Délice">
		  <param name="movie" value="images/lequizdelice.swf" />
		  <param name="quality" value="high" />
          <param name="wmode" value="transparent" />
          <param name="SCALE" value="exactfit" />
		  <embed src="images/lequizdelice.swf" width="800" height="250" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" wmode="transparent" scale="exactfit"></embed>
		</object>
	</noscript>
    </td>
</tr>
</table>
<?php
if(!isset($_SESSION["logged"])) {
?>
<!-- Login -->
<table width="577px" height="42px" cellpadding="0" cellspacing="0" border="0" align="center" style="background-image:url(images/fond_login.gif); background-position:center; table-layout:fixed;">
<tr>
	<td width="70px" style="color:#FFFFFF; padding-left:7px; font-size:12px; text-align:right">Déjà inscrit(e)</td>
    <td style="padding-left:7px; padding-right:7px;"><input  name="" value="Ton adresse email"/></td>
    <td width="330px" style="color:#FFFFFF; font-size:12px;">Pas encore inscrit(e), clique <a href="inscription.php">ici</a> et inscris-toi. <strong>C'est Gratuit!</strong></td>
</tr>
</table>
<table width="577px" height="42px" cellpadding="0" cellspacing="0" border="0" align="center" style="background-image:url(images/fond_login.gif); background-position:center; table-layout:fixed;">
<tr>
	<td align="center" style="color:#FFFFFF; font-size:12px;">Bienvenu au jeu «le Quiz Délice». Pour participer, il vous suffit de répondre à 5 questions parmi les 20 proposées. Bonne chance !</td>
</tr>
</table>
<br />
<?php
}
if($haserr == true) {
?>
<br />
<table width="577px" height="42px" cellpadding="0" cellspacing="0" border="0" align="center" style="background-image:url(images/fond_login.gif); background-position:center; table-layout:fixed;">
<tr>
	<td align="center" style="color:#FFFFFF; font-size:12px;">Vous avez uniquement <?php echo $nbr_br; ?> bonnes réponses. Vérifiez vos réponses et participez encore. Bonne chance!</td>
</tr>
</table>
<br />
<?php
}
?>
<form method="post" name="quiz" id="quiz" action="lequizdelice.php">
<!-- Quiz Musique -->
 <table width="800px" cellpadding="0" cellspacing="0" border="0" align="center">
<tr>
	<td height="100px" valign="middle" colspan="3" align="center" style="background-image:url(images/musique.gif); background-position:center; background-repeat:no-repeat; color:#FFFFFF; font-size:13px; font-weight:bolder;"></td>
</tr>
<tr><td valign="middle" colspan="3"><br /></td></tr>
<tr>
	<td valign="middle" align="center">
    <table width="385px" height="230px" cellpadding="0" cellspacing="0" border="0" style="table-layout:fixed; background-image:url(images/music1.gif); background-position:top left; background-repeat:no-repeat;">
    <tr>
    	<td valign="middle" align="center" height="55px"></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q1" id="q1_0" type="radio" value="1" onchange="checkreponse();" <?php if($q1 == "1") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q1" id="q1_1" type="radio" value="2" onchange="checkreponse();" <?php if($q1 == "2") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q1" id="q1_2" type="radio" value="3" onchange="checkreponse();" <?php if($q1 == "3") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    </table>
    </td>
    <td valign="middle" width="7px"></td>
    <td valign="middle" align="center">
    <table width="385px" height="230px" cellpadding="0" cellspacing="0" border="0" style="table-layout:fixed; background-image:url(images/music2.gif); background-position:top left; background-repeat:no-repeat;">
    <tr>
    	<td valign="middle" align="center" height="55px"></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q2" id="q2_0" type="radio" value="1" onchange="checkreponse();" <?php if($q2 == "1") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q2" id="q2_1" type="radio" value="2" onchange="checkreponse();" <?php if($q2 == "2") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q2" id="q2_2" type="radio" value="3" onchange="checkreponse();" <?php if($q2 == "3") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    </table>
    </td>
</tr>
<tr><td valign="middle" colspan="3"><br /></td></tr>
<tr>
	<td valign="middle" align="center">
    <table width="385px" height="230px" cellpadding="0" cellspacing="0" border="0" style="table-layout:fixed; background-image:url(images/music3.gif); background-position:top left; background-repeat:no-repeat;">
    <tr>
    	<td valign="middle" align="center" height="55px"></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q3" id="q3_0" type="radio" value="1" onchange="checkreponse();" <?php if($q3 == "1") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q3" id="q3_1" type="radio" value="2" onchange="checkreponse();" <?php if($q3 == "2") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q3" id="q3_2" type="radio" value="3" onchange="checkreponse();" <?php if($q3 == "3") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    </table>
    </td>
    <td valign="middle" width="7px"></td>
    <td valign="middle" align="center">
    <table width="385px" height="230px" cellpadding="0" cellspacing="0" border="0" style="table-layout:fixed; background-image:url(images/music4.gif); background-position:top left; background-repeat:no-repeat;">
    <tr>
    	<td valign="middle" align="center" height="55px"></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q4" id="q4_0" type="radio" value="1" onchange="checkreponse();" <?php if($q4 == "1") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q4" id="q4_1" type="radio" value="2" onchange="checkreponse();" <?php if($q4 == "2") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q4" id="q4_2" type="radio" value="3" onchange="checkreponse();" <?php if($q4 == "3") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    </table>
    </td>
</tr>
<tr><td valign="middle" colspan="3"><br /></td></tr>
<tr>
	<td valign="middle" colspan="3" align="center">
    <table width="385px" height="230px" cellpadding="0" cellspacing="0" border="0" style="table-layout:fixed; background-image:url(images/music5.gif); background-position:top left; background-repeat:no-repeat;">
    <tr>
    	<td valign="middle" align="center" height="55px"></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q5" id="q5_0" type="radio" value="1" onchange="checkreponse();" <?php if($q5 == "1") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q5" id="q5_1" type="radio" value="2" onchange="checkreponse();" <?php if($q5 == "2") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q5" id="q5_2" type="radio" value="3" onchange="checkreponse();" <?php if($q5 == "3") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    </table>
    </td>
</tr>
</table>
<br />
<!-- Quiz Cin&eacute;ma-->
<table width="800px" cellpadding="0" cellspacing="0" border="0" align="center">
<tr>
	<td height="100px" valign="middle" colspan="3" align="center" style="background-image:url(images/cinema.gif); background-position:center; background-repeat:no-repeat; color:#FFFFFF; font-size:13px; font-weight:bolder;"></td>
</tr>
<tr><td valign="middle" colspan="3"><br /></td></tr>
<tr>
	<td valign="middle" align="center">
    <table width="385px" height="230px" cellpadding="0" cellspacing="0" border="0" style="table-layout:fixed; background-image:url(images/cinema1.gif); background-position:top left; background-repeat:no-repeat;">
    <tr>
    	<td valign="middle" align="center" height="55px"></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q6" id="q6_0" type="radio" value="1" onchange="checkreponse();" <?php if($q6 == "1") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q6" id="q6_1" type="radio" value="2" onchange="checkreponse();" <?php if($q6 == "2") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q6" id="q6_2" type="radio" value="3" onchange="checkreponse();" <?php if($q6 == "3") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    </table>
    </td>
    <td valign="middle" width="7px"></td>
    <td valign="middle" align="center">
    <table width="385px" height="230px" cellpadding="0" cellspacing="0" border="0" style="table-layout:fixed; background-image:url(images/cinema2.gif); background-position:top left; background-repeat:no-repeat;">
    <tr>
    	<td valign="middle" align="center" height="55px"></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q7" id="q7_0" type="radio" value="1" onchange="checkreponse();" <?php if($q7 == "1") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q7" id="q7_1" type="radio" value="2" onchange="checkreponse();" <?php if($q7 == "2") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q7" id="q7_2" type="radio" value="3" onchange="checkreponse();" <?php if($q7 == "3") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    </table>
    </td>
</tr>
<tr><td valign="middle" colspan="3"><br /></td></tr>
<tr>
	<td valign="middle" align="center">
    <table width="385px" height="230px" cellpadding="0" cellspacing="0" border="0" style="table-layout:fixed; background-image:url(images/cinema3.gif); background-position:top left; background-repeat:no-repeat;">
    <tr>
    	<td valign="middle" align="center" height="55px"></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q8" id="q8_0" type="radio" value="1" onchange="checkreponse();" <?php if($q8 == "1") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q8" id="q8_1" type="radio" value="2" onchange="checkreponse();" <?php if($q8 == "2") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q8" id="q8_2" type="radio" value="3" onchange="checkreponse();" <?php if($q8 == "3") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    </table>
    </td>
    <td valign="middle" width="7px"></td>
    <td valign="middle" align="center">
    <table width="385px" height="230px" cellpadding="0" cellspacing="0" border="0" style="table-layout:fixed; background-image:url(images/cinema4.gif); background-position:top left; background-repeat:no-repeat;">
    <tr>
    	<td valign="middle" align="center" height="55px"></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q9" id="q9_0" type="radio" value="1" onchange="checkreponse();" <?php if($q9 == "1") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q9" id="q9_1" type="radio" value="2" onchange="checkreponse();" <?php if($q9 == "2") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q9" id="q9_2" type="radio" value="3" onchange="checkreponse();" <?php if($q9 == "3") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    </table>
    </td>
</tr>
<tr><td valign="middle" colspan="3"><br /></td></tr>
<tr>
	<td valign="middle" colspan="3" align="center">
    <table width="385px" height="230px" cellpadding="0" cellspacing="0" border="0" style="table-layout:fixed; background-image:url(images/cinema5.gif); background-position:top left; background-repeat:no-repeat;">
    <tr>
    	<td valign="middle" align="center" height="55px"></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q10" id="q10_0" type="radio" value="1" onchange="checkreponse();" <?php if($q10 == "1") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q10" id="q10_1" type="radio" value="2" onchange="checkreponse();" <?php if($q10 == "2") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q10" id="q10_2" type="radio" value="3" onchange="checkreponse();" <?php if($q10 == "3") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    </table>
    </td>
</tr>
</table>
<br />
<!-- Quiz Cartoon -->
<table width="800px" cellpadding="0" cellspacing="0" border="0" align="center">
<tr>
	<td height="100px" valign="middle" colspan="3" align="center" style="background-image:url(images/cartoon.gif); background-position:center; background-repeat:no-repeat; color:#FFFFFF; font-size:13px; font-weight:bolder;"></td>
</tr>
<tr><td valign="middle" colspan="3"><br /></td></tr>
<tr>
	<td valign="middle" align="center">
    <table width="385px" height="230px" cellpadding="0" cellspacing="0" border="0" style="table-layout:fixed; background-image:url(images/cartoon1.gif); background-position:top left; background-repeat:no-repeat;">
    <tr>
    	<td valign="middle" align="center" height="55px"></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q11" id="q11_0" type="radio" value="1" onchange="checkreponse();" <?php if($q11 == "1") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q11" id="q11_1" type="radio" value="2" onchange="checkreponse();" <?php if($q11 == "2") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q11" id="q11_2" type="radio" value="3" onchange="checkreponse();" <?php if($q11 == "3") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    </table>
    </td>
    <td valign="middle" width="7px"></td>
    <td valign="middle" align="center">
    <table width="385px" height="230px" cellpadding="0" cellspacing="0" border="0" style="table-layout:fixed; background-image:url(images/cartoon2.gif); background-position:top left; background-repeat:no-repeat;">
    <tr>
    	<td valign="middle" align="center" height="55px"></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q12" id="q12_0" type="radio" value="1" onchange="checkreponse();" <?php if($q12 == "1") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q12" id="q12_1" type="radio" value="2" onchange="checkreponse();" <?php if($q12 == "2") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q12" id="q12_2" type="radio" value="3" onchange="checkreponse();" <?php if($q12 == "3") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    </table>
    </td>
</tr>
<tr><td valign="middle" colspan="3"><br /></td></tr>
<tr>
	<td valign="middle" align="center">
    <table width="385px" height="230px" cellpadding="0" cellspacing="0" border="0" style="table-layout:fixed; background-image:url(images/cartoon3.gif); background-position:top left; background-repeat:no-repeat;">
    <tr>
    	<td valign="middle" align="center" height="55px"></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q13" id="q13_0" type="radio" value="1" onchange="checkreponse();" <?php if($q13 == "1") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q13" id="q13_1" type="radio" value="2" onchange="checkreponse();" <?php if($q13 == "2") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q13" id="q13_2" type="radio" value="3" onchange="checkreponse();" <?php if($q13 == "3") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    </table>
    </td>
    <td valign="middle" width="7px"></td>
    <td valign="middle" align="center">
    <table width="385px" height="230px" cellpadding="0" cellspacing="0" border="0" style="table-layout:fixed; background-image:url(images/cartoon4.gif); background-position:top left; background-repeat:no-repeat;">
    <tr>
    	<td valign="middle" align="center" height="55px"></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q14" id="q14_0" type="radio" value="1" onchange="checkreponse();" <?php if($q14 == "1") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q14" id="q14_1" type="radio" value="2" onchange="checkreponse();" <?php if($q14 == "2") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q14" id="q14_2" type="radio" value="3" onchange="checkreponse();" <?php if($q14 == "3") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    </table>
    </td>
</tr>
<tr><td valign="middle" colspan="3"><br /></td></tr>
<tr>
	<td valign="middle" colspan="3" align="center">
    <table width="385px" height="230px" cellpadding="0" cellspacing="0" border="0" style="table-layout:fixed; background-image:url(images/cartoon5.gif); background-position:top left; background-repeat:no-repeat;">
    <tr>
    	<td valign="middle" align="center" height="55px"></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q15" id="q15_0" type="radio" value="1" onchange="checkreponse();" <?php if($q15 == "1") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q15" id="q15_1" type="radio" value="2" onchange="checkreponse();" <?php if($q15 == "2") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q15" id="q15_2" type="radio" value="3" onchange="checkreponse();" <?php if($q15 == "3") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    </table>
    </td>
</tr>
</table>
<br />
<!-- Quiz Sport -->
<table width="800px" cellpadding="0" cellspacing="0" border="0" align="center">
<tr>
	<td height="100px" valign="middle" colspan="3" align="center" style="background-image:url(images/sport.gif); background-position:center; background-repeat:no-repeat; color:#FFFFFF; font-size:13px; font-weight:bolder;"></td>
</tr>
<tr><td valign="middle" colspan="3"><br /></td></tr>
<tr>
	<td valign="middle" align="center">
    <table width="385px" height="230px" cellpadding="0" cellspacing="0" border="0" style="table-layout:fixed; background-image:url(images/sport1.gif); background-position:top left; background-repeat:no-repeat;">
    <tr>
    	<td valign="middle" align="center" height="55px"></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q16" id="q16_0" type="radio" value="1" onchange="checkreponse();" <?php if($q16 == "1") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q16" id="q16_1" type="radio" value="2" onchange="checkreponse();" <?php if($q16 == "2") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q16" id="q16_2" type="radio" value="3" onchange="checkreponse();" <?php if($q16 == "3") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    </table>
    </td>
    <td valign="middle" width="7px"></td>
    <td valign="middle" align="center">
    <table width="385px" height="230px" cellpadding="0" cellspacing="0" border="0" style="table-layout:fixed; background-image:url(images/sport2.gif); background-position:top left; background-repeat:no-repeat;">
    <tr>
    	<td valign="middle" align="center" height="55px"></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q17" id="q17_0" type="radio" value="1" onchange="checkreponse();" <?php if($q17 == "1") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q17" id="q17_1" type="radio" value="2" onchange="checkreponse();" <?php if($q17 == "2") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q17" id="q17_2" type="radio" value="3" onchange="checkreponse();" <?php if($q17 == "3") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    </table>
    </td>
</tr>
<tr><td valign="middle" colspan="3"><br /></td></tr>
<tr>
	<td valign="middle" align="center">
    <table width="385px" height="230px" cellpadding="0" cellspacing="0" border="0" style="table-layout:fixed; background-image:url(images/sport3.gif); background-position:top left; background-repeat:no-repeat;">
    <tr>
    	<td valign="middle" align="center" height="55px"></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q18" id="q18_0" type="radio" value="1" onchange="checkreponse();" <?php if($q18 == "1") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q18" id="q18_1" type="radio" value="2" onchange="checkreponse();" <?php if($q18 == "2") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q18" id="q18_2" type="radio" value="3" onchange="checkreponse();" <?php if($q18 == "3") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    </table>
    </td>
    <td valign="middle" width="7px"></td>
    <td valign="middle" align="center">
    <table width="385px" height="230px" cellpadding="0" cellspacing="0" border="0" style="table-layout:fixed; background-image:url(images/sport4.gif); background-position:top left; background-repeat:no-repeat;">
    <tr>
    	<td valign="middle" align="center" height="55px"></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q19" id="q19_0" type="radio" value="1" onchange="checkreponse();" <?php if($q19 == "1") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q19" id="q19_1" type="radio" value="2" onchange="checkreponse();" <?php if($q19 == "2") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q19" id="q19_2" type="radio" value="3" onchange="checkreponse();" <?php if($q19 == "3") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    </table>
    </td>
</tr>
<tr><td valign="middle" colspan="3"><br /></td></tr>
<tr>
	<td valign="middle" colspan="3" align="center">
    <table width="385px" height="230px" cellpadding="0" cellspacing="0" border="0" style="table-layout:fixed; background-image:url(images/sport5.gif); background-position:top left; background-repeat:no-repeat;">
    <tr>
    	<td valign="middle" align="center" height="55px"></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q20" id="q20_0" type="radio" value="1" onchange="checkreponse();" <?php if($q20 == "1") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q20" id="q20_1" type="radio" value="2" onchange="checkreponse();" <?php if($q20 == "2") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    <tr>
        <td height="39px" valign="middle" style="padding-left:3px; text-align:center; vertical-align:middle;"><input name="q20" id="q20_2" type="radio" value="3" onchange="checkreponse();" <?php if($q20 == "3") { echo "checked=\"checked\"";} ?> /></td>
    </tr>
    </table>
    </td>
</tr>
</table>
<br />
<center><input name="v" type="hidden" value="1" /><input name="btnval" type="button" value="Envoyer ma réponse" onclick="sendform();" /> &nbsp; <input type="button" name="reset" value="Effacer" onclick="resetall();" /></center>
</form>
<script type="text/javascript">
var nbr_ch = <?php echo $nbr_ch; ?>;
function checkreponse() {
	var ch =0;
	if(document.getElementById("q1_0").checked || document.getElementById("q1_1").checked || document.getElementById("q1_2").checked) {
		ch++;
	}
	if(document.getElementById("q2_0").checked || document.getElementById("q2_1").checked || document.getElementById("q2_2").checked) {
		ch++;
	}
	if(document.getElementById("q3_0").checked || document.getElementById("q3_1").checked || document.getElementById("q3_2").checked) {
		ch++;
	}
	if(document.getElementById("q4_0").checked || document.getElementById("q4_1").checked || document.getElementById("q4_2").checked) {
		ch++;
	}
	if(document.getElementById("q5_0").checked || document.getElementById("q5_1").checked || document.getElementById("q5_2").checked) {
		ch++;
	}
	if(document.getElementById("q6_0").checked || document.getElementById("q6_1").checked || document.getElementById("q6_2").checked) {
		ch++;
	}
	if(document.getElementById("q7_0").checked || document.getElementById("q7_1").checked || document.getElementById("q7_2").checked) {
		ch++;
	}
	if(document.getElementById("q8_0").checked || document.getElementById("q8_1").checked || document.getElementById("q8_2").checked) {
		ch++;
	}
	if(document.getElementById("q9_0").checked || document.getElementById("q9_1").checked || document.getElementById("q9_2").checked) {
		ch++;
	}
	if(document.getElementById("q10_0").checked || document.getElementById("q10_1").checked || document.getElementById("q10_2").checked) {
		ch++;
	}
	if(document.getElementById("q11_0").checked || document.getElementById("q11_1").checked || document.getElementById("q11_2").checked) {
		ch++;
	}
	if(document.getElementById("q12_0").checked || document.getElementById("q12_1").checked || document.getElementById("q12_2").checked) {
		ch++;
	}
	if(document.getElementById("q13_0").checked || document.getElementById("q13_1").checked || document.getElementById("q13_2").checked) {
		ch++;
	}
	if(document.getElementById("q14_0").checked || document.getElementById("q14_1").checked || document.getElementById("q14_2").checked) {
		ch++;
	}
	if(document.getElementById("q15_0").checked || document.getElementById("q15_1").checked || document.getElementById("q15_2").checked) {
		ch++;
	}
	if(document.getElementById("q16_0").checked || document.getElementById("q16_1").checked || document.getElementById("q16_2").checked) {
		ch++;
	}
	if(document.getElementById("q17_0").checked || document.getElementById("q17_1").checked || document.getElementById("q17_2").checked) {
		ch++;
	}
	if(document.getElementById("q18_0").checked || document.getElementById("q18_1").checked || document.getElementById("q18_2").checked) {
		ch++;
	}
	if(document.getElementById("q19_0").checked || document.getElementById("q19_1").checked || document.getElementById("q19_2").checked) {
		ch++;
	}
	if(document.getElementById("q20_0").checked || document.getElementById("q20_1").checked || document.getElementById("q20_2").checked) {
		ch++;
	}

	if(ch >=5) {
		for(var i = 1; i <=20; i++) {
			if(!document.getElementById('q'+i+'_0').checked && !document.getElementById('q'+i+'_1').checked && !document.getElementById('q'+i+'_2').checked) {
				document.getElementById('q'+i+'_0').disabled="disabled";
				document.getElementById('q'+i+'_1').disabled="disabled";
				document.getElementById('q'+i+'_2').disabled="disabled";
			}
		}
	} else {
		for(var i = 1; i <=20; i++) {
			document.getElementById('q'+i+'_0').disabled="";
			document.getElementById('q'+i+'_1').disabled="";
			document.getElementById('q'+i+'_2').disabled="";
		}
	}
	nbr_ch = ch;
}
function sendform() {
	if(nbr_ch >= 5 ) {
		document.getElementById('quiz').submit();
	} else {
		alert('vous devez choisir 5 réponses');
	}
}
function resetall() {
	for(var i = 1; i <=20; i++) {
		document.getElementById('q'+i+'_0').disabled="";
		document.getElementById('q'+i+'_1').disabled="";
		document.getElementById('q'+i+'_2').disabled="";
		document.getElementById('q'+i+'_0').checked=false;
		document.getElementById('q'+i+'_1').checked=false;
		document.getElementById('q'+i+'_2').checked=false;
	}
}
checkreponse();
</script>
<?php
if($haserr == true) {
?>
<br />
<table width="577px" height="42px" cellpadding="0" cellspacing="0" border="0" align="center" style="background-image:url(images/fond_login.gif); background-position:center; table-layout:fixed;">
<tr>
	<td align="center" style="color:#FFFFFF; font-size:12px;">Vous avez uniquement <?php echo $nbr_br; ?> bonnes réponses. Vérifiez vos réponses et participez encore. Bonne chance!</td>
</tr>
</table>
<?php
}
?>
<br />
</body>
</html>