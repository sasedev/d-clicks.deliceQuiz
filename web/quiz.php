<?php
/*
 * Created on 22 nov. 2008
 * by Salah Abdelkader Seif Eddine
 * using PHPeclipse
 */
session_start();
require_once("cnf/cfg.php");
$link = mysqli_connect($dbhost, $dbuser, $dbpass);
if (!$link) {
	echo "resultat=Notok0";
	die('Impossible de se connecter : ' . mysqli_error());
}

// Rendre la base de données $dbname, la base courante
$dbln = mysqli_select_db($link, $dbname);
if (!$dbln) {
	echo "resultat=Notok1";
	die ('Impossible de sélectionner la base de donn&eacute;es : ' . mysqli_error());
}
if(isset($_REQUEST["id"])) {
	$id = $_REQUEST["id"];
	$sql = "SELECT * FROM joueurs WHERE id = $id";
	$rs = mysqli_query($link, $sql) or die ('resultat=Notok2 ' . mysqli_error());
	if(mysqli_num_rows($rs) == 0) {
		echo "resultat=Notok2";
		exit(0);
	}
} else {
	if(!isset($_SESSION["logged"])) {
		echo "resultat=Notok3";
		exit(0);
	} else {
		$id = $_SESSION["logged"];
		if(!is_numeric($id)) {
			echo "resultat=Notok4";
			exit(0);
		}
		$sql = "SELECT * FROM joueurs WHERE id = $id";
		$rs = mysqli_query($link, $sql) or die ('Erreur mysql : ' . mysqli_error());
		if(mysqli_num_rows($rs) == 0) {
			echo "resultat=Notok5";
			exit(0);
		}
	}
}
$nbr_br = 0;
$nbr_ch = 0;
$v = $_REQUEST["v"];
if($v == "1") {

	$sql = "UPDATE joueurs SET nbrjeu = nbrjeu + 1 WHERE id = $id";
	mysqli_query($link, $sql) or die ('resultat=Notok6 ' . mysqli_error());

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
		//header("Location: gagnant.php");
		echo "resultat=ok";
		exit(0);
	} else {
		echo "resultat=ok1&err=".$nbr_br;
		exit(0);
	}
}
?>
