<?php
/*
 * Created on 30 oct. 2008
 * by Salah Abdelkader Seif Eddine
 * using PHPeclipse
 */
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
if(isset($_SESSION["logged"])) {
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Déjà inscrit(e)</title>
<script language="javascript">AC_FL_RunContent = 0;</script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<body style="margin:0px; padding:0px; background-color:#1e63d8;">
<center>
<script language="javascript">
	if (AC_FL_RunContent == 0) {
		alert("This page requires AC_RunActiveContent.js.");
	} else {
		AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
			'width', '500',
			'height', '468',
			'src', 'inscription',
			'quality', 'high',
			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', 'window',
			'devicefont', 'false',
			'id', 'Inscription',
			'bgcolor', '#1e63d8',
			'name', 'Inscription',
			'menu', 'true',
			'allowFullScreen', 'false',
			'allowScriptAccess','sameDomain',
			'movie', 'inscription',
			'salign', ''
			); //end AC code
	}
</script>
<noscript>
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553555700" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="500" height="468" id="selartistic_agency" align="middle">
	<param name="allowScriptAccess" value="sameDomain" />
	<param name="allowFullScreen" value="false" />
	<param name="movie" value="http://www.lequizdelice.com/inscription.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#1e63d8" />	<embed src="http://www.lequizdelice.com/inscription.swf" quality="high" bgcolor="#1e63d8" width="500" height="468" name="Inscription" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object>
</noscript>
</center>
</body>


<?php
} else {
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

$v = "";

if (isset($_POST["v"])) {
	$v = $_POST["v"];
}
if($v == "1") {
	$nom = trim($_POST["nom"]);
	$prenom = trim($_POST["prenom"]);
	$ddnj = $_POST["ddnj"];
	$ddnm = $_POST["ddnm"];
	$ddny = $_POST["ddny"];
	$gsm = trim($_POST["gsm"]);
	$cin = trim($_POST["cin"]);
	$adresse = trim($_POST["adresse"]);
	$email = trim($_POST["email"]);
	$err_nom = false;
	$haserr = false;
	if($nom == "") {
		$haserr = true;
		$err_nom = true;
	}
	$err_prenom = false;
	if($prenom == "") {
		$haserr = true;
		$err_prenom = true;
	}
	$err_ddn = false;
	if(!checkdate($ddnm, $ddnj, $ddny)) {
		$err_ddn = true;
		$haserr = true;
		$ddnj = "";
		$ddnm = "";
		$ddny = "";
	}
	$err_gsm = false;
	if(strlen($gsm) != 8) {
		$err_gsm = true;
		$haserr = true;
		$gsm = "";
	} else if(!is_numeric($gsm)) {
		$err_gsm = true;
		$haserr = true;
		$gsm = "";
	} else if(substr($gsm,0,1) != "2" && substr($gsm,0,1) != "9") {
		$err_gsm = true;
		$haserr = true;
		$gsm = "";
	}
	$err_cin = false;
	if(strlen($cin) != 8) {
		$err_cin = true;
		// $haserr = true;
		$cin = "";
	} else if(!is_numeric($cin)) {
		$err_cin = true;
		// $haserr = true;
		$cin = "";
	}
	$err_adresse = false;
	if($adresse == "") {
		$err_adresse = true;
		// $haserr = true;
	}
	if($email != "") {
		$atom   = '[-a-z0-9!#$%&\'*+\\/=?^_`{|}~]';		// caractères autoris&eacute;s avant l'arobase
		$domain = '([a-z0-9]([-a-z0-9]*[a-z0-9]+)?)';	// caractères autoris&eacute;s après l'arobase (nom de domaine)
		$regex = '/^' . $atom . '+' .					// Une ou plusieurs fois les caractères autoris&eacute;s avant l'arobase
			'(\.' . $atom . '+)*' .						// Suivis par z&eacute;ro point ou plus
														// s&eacute;par&eacute;s par des caractères autoris&eacute;s avant l'arobase
			'@' .										// Suivis d'un arobase
			'(' . $domain . '{1,63}\.)+' .				// Suivis par 1 à 63 caractères autoris&eacute;s pour le nom de domaine
														// s&eacute;par&eacute;s par des points
			$domain . '{2,63}$/i';						// Suivi de 2 à 63 caractères autoris&eacute;s pour le nom de domaine

		// test de l'adresse e-mail
		if (!preg_match($regex, $email)) {
			$email = "";
		}
	}
	if($haserr == false) {
		$sql = "SELECT * FROM joueurs WHERE gsm = '$gsm'";
		$rs = mysqli_query($link, $sql) or die ('Erreur mysql : ' . mysqli_error());
		if(mysqli_num_rows($rs) == 0) {
			$sql = "INSERT INTO joueurs (nom, prenom, naisssance, gsm, cin, adresse, email) VALUES ('$nom', '$prenom', \"$ddny-$ddnm-$ddnj\", '$gsm', '$cin', '$adresse', '$email')";
			$rs = mysqli_query($link, $sql) or die ('Erreur mysql : ' . mysqli_error());
			$_SESSION["logged"] = mysqli_insert_id();
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bravo, vous pouvez jouer!</title>
<script language="javascript">AC_FL_RunContent = 0;</script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<body style="margin:0px; padding:0px; background-color:#1e63d8;">
<center>
<script language="javascript">
	if (AC_FL_RunContent == 0) {
		alert("This page requires AC_RunActiveContent.js.");
	} else {
		AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
			'width', '500',
			'height', '468',
			'src', 'inscription',
			'quality', 'high',
			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', 'window',
			'devicefont', 'false',
			'id', 'Inscription',
			'bgcolor', '#1e63d8',
			'name', 'Inscription',
			'menu', 'true',
			'allowFullScreen', 'false',
			'allowScriptAccess','sameDomain',
			'movie', 'inscription',
			'salign', ''
			); //end AC code
	}
</script>
<noscript>
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553555700" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="500" height="468" id="selartistic_agency" align="middle">
	<param name="allowScriptAccess" value="sameDomain" />
	<param name="allowFullScreen" value="false" />
	<param name="movie" value="http://www.lequizdelice.com/inscription.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#1e63d8" />	<embed src="http://www.lequizdelice.com/inscription.swf" quality="high" bgcolor="#1e63d8" width="500" height="468" name="Inscription" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object>
</noscript>
</center>
</body>
</html>
<?php
			exit(0);
		} else {
			$row = mysqli_fetch_object($rs);
			if(null == $row->date) {
				$_SESSION["logged"] = $row->id;
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inscription en Ligne au Quiz D&eacute;lice : Gratuit</title>
</head>

<body onload="javascript:window.close();">
</body>
</html>
<?php
				exit(0);
			} else {
				$gsmexist = true;
				$gsm ="ce num&eacute;ro de t&eacute;l&eacute;phone existe d&eacute;j&agrave;";
			}
		}
	}
} else {
	$nom = "Votre Nom";
	$prenom = "Votre Pr&eacute;nom";
	$gsm = "Votre GSM";
	$cin = "Votre CIN";
	$email = "Votre EMAIL";
}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inscription en Ligne au Quiz D&eacute;lice : Gratuit</title>
<style type="text/css">
body{
	font: Verdana, Arial, Helvetica, sans-serif;
	font-size: 13px;
	background-color: #1e63d7;
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
<div style="width:500px; height:468px; background-image:url(images/inscription.jpg); background-position:top left; background-repeat:no-repeat;" >
<form method="post">
<table cellpadding="0" cellspacing="2" border="0" style="margin-left:80px; margin-top:137px;">
<tr>
	<td>Nom <img src="images/obligatoire.gif" alt="Ce champs est obligatoire"></td>
    <td><input name="nom" type="text" value="<?php echo $nom; ?>" size="25" maxlength="25"  /> <?php if($err_nom == true) { echo "*"; } ?></td>
</tr>
<tr>
	<td>Pr&eacute;nom <img src="images/obligatoire.gif" alt="Ce champs est obligatoire"></td>
    <td><input name="prenom" type="text" value="<?php echo $prenom; ?>" size="25" maxlength="25" /> <?php if($err_prenom == true) { echo "*"; } ?></td>
</tr>
<tr>
	<td>Date de Naissance</td>
    <td>
    <select name="ddnj" size="1">
    <option value="01" <?php if($ddnj == "01") { echo "selected=\"selected\"";} ?>>01</option>
    <option value="02" <?php if($ddnj == "02") { echo "selected=\"selected\"";} ?>>02</option>
    <option value="03" <?php if($ddnj == "03") { echo "selected=\"selected\"";} ?>>03</option>
    <option value="04" <?php if($ddnj == "04") { echo "selected=\"selected\"";} ?>>04</option>
    <option value="05" <?php if($ddnj == "05") { echo "selected=\"selected\"";} ?>>05</option>
    <option value="06" <?php if($ddnj == "06") { echo "selected=\"selected\"";} ?>>06</option>
    <option value="07" <?php if($ddnj == "07") { echo "selected=\"selected\"";} ?>>07</option>
    <option value="08" <?php if($ddnj == "08") { echo "selected=\"selected\"";} ?>>08</option>
    <option value="09" <?php if($ddnj == "09") { echo "selected=\"selected\"";} ?>>09</option>
    <option value="10" <?php if($ddnj == "10") { echo "selected=\"selected\"";} ?>>10</option>
    <option value="11" <?php if($ddnj == "11") { echo "selected=\"selected\"";} ?>>11</option>
    <option value="12" <?php if($ddnj == "12") { echo "selected=\"selected\"";} ?>>12</option>
    <option value="13" <?php if($ddnj == "13") { echo "selected=\"selected\"";} ?>>13</option>
    <option value="14" <?php if($ddnj == "14") { echo "selected=\"selected\"";} ?>>14</option>
    <option value="15" <?php if($ddnj == "15") { echo "selected=\"selected\"";} ?>>15</option>
    <option value="16" <?php if($ddnj == "16") { echo "selected=\"selected\"";} ?>>16</option>
    <option value="17" <?php if($ddnj == "17") { echo "selected=\"selected\"";} ?>>17</option>
    <option value="18" <?php if($ddnj == "18") { echo "selected=\"selected\"";} ?>>18</option>
    <option value="19" <?php if($ddnj == "19") { echo "selected=\"selected\"";} ?>>19</option>
    <option value="20" <?php if($ddnj == "20") { echo "selected=\"selected\"";} ?>>20</option>
    <option value="21" <?php if($ddnj == "21") { echo "selected=\"selected\"";} ?>>21</option>
    <option value="22" <?php if($ddnj == "22") { echo "selected=\"selected\"";} ?>>22</option>
    <option value="23" <?php if($ddnj == "23") { echo "selected=\"selected\"";} ?>>23</option>
    <option value="24" <?php if($ddnj == "24") { echo "selected=\"selected\"";} ?>>24</option>
    <option value="25" <?php if($ddnj == "25") { echo "selected=\"selected\"";} ?>>25</option>
    <option value="26" <?php if($ddnj == "26") { echo "selected=\"selected\"";} ?>>26</option>
    <option value="27" <?php if($ddnj == "27") { echo "selected=\"selected\"";} ?>>27</option>
    <option value="28" <?php if($ddnj == "28") { echo "selected=\"selected\"";} ?>>28</option>
    <option value="29" <?php if($ddnj == "29") { echo "selected=\"selected\"";} ?>>29</option>
    <option value="30" <?php if($ddnj == "30") { echo "selected=\"selected\"";} ?>>30</option>
    <option value="31" <?php if($ddnj == "31") { echo "selected=\"selected\"";} ?>>31</option>
    </select>
     /
    <select name="ddnm" size="1">
    <option value="01" <?php if($ddnm == "01") { echo "selected=\"selected\"";} ?>>01</option>
    <option value="02" <?php if($ddnm == "02") { echo "selected=\"selected\"";} ?>>02</option>
    <option value="03" <?php if($ddnm == "03") { echo "selected=\"selected\"";} ?>>03</option>
    <option value="04" <?php if($ddnm == "04") { echo "selected=\"selected\"";} ?>>04</option>
    <option value="05" <?php if($ddnm == "05") { echo "selected=\"selected\"";} ?>>05</option>
    <option value="06" <?php if($ddnm == "06") { echo "selected=\"selected\"";} ?>>06</option>
    <option value="07" <?php if($ddnm == "07") { echo "selected=\"selected\"";} ?>>07</option>
    <option value="08" <?php if($ddnm == "08") { echo "selected=\"selected\"";} ?>>08</option>
    <option value="09" <?php if($ddnm == "09") { echo "selected=\"selected\"";} ?>>09</option>
    <option value="10" <?php if($ddnm == "10") { echo "selected=\"selected\"";} ?>>10</option>
    <option value="11" <?php if($ddnm == "11") { echo "selected=\"selected\"";} ?>>11</option>
    <option value="12" <?php if($ddnm == "12") { echo "selected=\"selected\"";} ?>>12</option>
    </select>
     /
    <select name="ddny" size="1">
    <option value="1950" <?php if($ddny == "1950") { echo "selected=\"selected\"";} ?>>1950</option>
    <option value="1951" <?php if($ddny == "1951") { echo "selected=\"selected\"";} ?>>1951</option>
    <option value="1952" <?php if($ddny == "1952") { echo "selected=\"selected\"";} ?>>1952</option>
    <option value="1953" <?php if($ddny == "1953") { echo "selected=\"selected\"";} ?>>1953</option>
    <option value="1954" <?php if($ddny == "1954") { echo "selected=\"selected\"";} ?>>1954</option>
    <option value="1955" <?php if($ddny == "1955") { echo "selected=\"selected\"";} ?>>1955</option>
    <option value="1956" <?php if($ddny == "1956") { echo "selected=\"selected\"";} ?>>1956</option>
    <option value="1957" <?php if($ddny == "1957") { echo "selected=\"selected\"";} ?>>1957</option>
    <option value="1958" <?php if($ddny == "1958") { echo "selected=\"selected\"";} ?>>1958</option>
    <option value="1959" <?php if($ddny == "1959") { echo "selected=\"selected\"";} ?>>1959</option>
    <option value="1960" <?php if($ddny == "1960") { echo "selected=\"selected\"";} ?>>1960</option>
    <option value="1961" <?php if($ddny == "1961") { echo "selected=\"selected\"";} ?>>1961</option>
    <option value="1962" <?php if($ddny == "1962") { echo "selected=\"selected\"";} ?>>1962</option>
    <option value="1963" <?php if($ddny == "1963") { echo "selected=\"selected\"";} ?>>1963</option>
    <option value="1964" <?php if($ddny == "1964") { echo "selected=\"selected\"";} ?>>1964</option>
    <option value="1965" <?php if($ddny == "1965") { echo "selected=\"selected\"";} ?>>1965</option>
    <option value="1966" <?php if($ddny == "1966") { echo "selected=\"selected\"";} ?>>1966</option>
    <option value="1967" <?php if($ddny == "1967") { echo "selected=\"selected\"";} ?>>1967</option>
    <option value="1968" <?php if($ddny == "1968") { echo "selected=\"selected\"";} ?>>1968</option>
    <option value="1969" <?php if($ddny == "1969") { echo "selected=\"selected\"";} ?>>1969</option>
    <option value="1970" <?php if($ddny == "1970") { echo "selected=\"selected\"";} ?>>1970</option>
    <option value="1971" <?php if($ddny == "1971") { echo "selected=\"selected\"";} ?>>1971</option>
    <option value="1972" <?php if($ddny == "1972") { echo "selected=\"selected\"";} ?>>1972</option>
    <option value="1973" <?php if($ddny == "1973") { echo "selected=\"selected\"";} ?>>1973</option>
    <option value="1974" <?php if($ddny == "1974") { echo "selected=\"selected\"";} ?>>1974</option>
    <option value="1975" <?php if($ddny == "1975") { echo "selected=\"selected\"";} ?>>1975</option>
    <option value="1976" <?php if($ddny == "1976") { echo "selected=\"selected\"";} ?>>1976</option>
    <option value="1977" <?php if($ddny == "1977") { echo "selected=\"selected\"";} ?>>1977</option>
    <option value="1978" <?php if($ddny == "1978") { echo "selected=\"selected\"";} ?>>1978</option>
    <option value="1979" <?php if($ddny == "1979") { echo "selected=\"selected\"";} ?>>1979</option>
    <option value="1980" <?php if($ddny == "1980") { echo "selected=\"selected\"";} ?>>1980</option>
    <option value="1981" <?php if($ddny == "1981") { echo "selected=\"selected\"";} ?>>1981</option>
    <option value="1982" <?php if($ddny == "1982") { echo "selected=\"selected\"";} ?>>1982</option>
    <option value="1983" <?php if($ddny == "1983") { echo "selected=\"selected\"";} ?>>1983</option>
    <option value="1984" <?php if($ddny == "1984") { echo "selected=\"selected\"";} ?>>1984</option>
    <option value="1985" <?php if($ddny == "1985") { echo "selected=\"selected\"";} ?>>1985</option>
    <option value="1986" <?php if($ddny == "1986") { echo "selected=\"selected\"";} ?>>1986</option>
    <option value="1987" <?php if($ddny == "1987") { echo "selected=\"selected\"";} ?>>1987</option>
    <option value="1988" <?php if($ddny == "1988") { echo "selected=\"selected\"";} ?>>1988</option>
    <option value="1989" <?php if($ddny == "1989") { echo "selected=\"selected\"";} ?>>1989</option>
    <option value="1990" <?php if($ddny == "1990") { echo "selected=\"selected\"";} ?>>1990</option>
    <option value="1991" <?php if($ddny == "1991") { echo "selected=\"selected\"";} ?>>1991</option>
    <option value="1992" <?php if($ddny == "1992") { echo "selected=\"selected\"";} ?>>1992</option>
    <option value="1993" <?php if($ddny == "1993") { echo "selected=\"selected\"";} ?>>1993</option>
    <option value="1994" <?php if($ddny == "1994") { echo "selected=\"selected\"";} ?>>1994</option>
    <option value="1995" <?php if($ddny == "1995") { echo "selected=\"selected\"";} ?>>1995</option>
    <option value="1996" <?php if($ddny == "1996") { echo "selected=\"selected\"";} ?>>1996</option>
    <option value="1997" <?php if($ddny == "1997") { echo "selected=\"selected\"";} ?>>1997</option>
    <option value="1998" <?php if($ddny == "1998") { echo "selected=\"selected\"";} ?>>1998</option>
    <option value="1999" <?php if($ddny == "1999") { echo "selected=\"selected\"";} ?>>1999</option>
    <option value="2000" <?php if($ddny == "2000") { echo "selected=\"selected\"";} ?>>2000</option>
    </select>
     <?php if($err_ddn == true) { echo "*"; } ?>
    </td>
</tr>
<tr>
	<td>Num&eacute;ro GSM <img src="images/obligatoire.gif" alt="Ce champs est obligatoire"></td>
    <td><input name="gsm" type="text" value="<?php echo $gsm; ?>" size="8" maxlength="8" /> <?php if($err_gsm == true) { echo "*"; } ?></td>
</tr>
<tr>
	<td>CIN</td>
    <td><input name="cin" type="text" value="<?php echo $cin; ?>" size="8" maxlength="8" /> <?php // if($err_cin == true) { echo "*"; } ?></td>
</tr>
<tr>
	<td>Adresse</td>
    <td><textarea name="adresse" cols="21" rows="4" wrap="virtual"><?php echo $adresse; ?></textarea> <?php // if($err_adresse == true) { echo "*"; } ?></td>
</tr>
<tr>
	<td>Email</td>
    <td><input name="email" type="text" value="<?php echo $email; ?>" size="25" maxlength="100" /></td>
</tr>
<tr>
	<td></td><td align="center"><input name="v" type="hidden" value="1" /><input name="submit" type="submit" value="Je m'inscris" /></td>
</tr>
</table>
</form>
</div>
</body>
<?php
}
?>
</html>
