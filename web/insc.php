<?php
/*
 * Created on 21 nov. 2008
 * by Salah Abdelkader Seif Eddine
 * using PHPeclipse
 */
require_once("cnf/cfg.php");
$link = mysqli_connect($dbhost, $dbuser, $dbpass);
if (!$link) {
	echo "resultat=-1";
	die('Impossible de se connecter : ' . mysqli_error());
}

// Rendre la base de données $dbname, la base courante
$dbln = mysqli_select_db($link, $dbname);
if (!$dbln) {
	echo "resultat=-1";
	die ('Impossible de sélectionner la base de donn&eacute;es : ' . mysqli_error());
}

if (isset($_REQUEST["v"])) {
	$v = $_REQUEST["v"];
	if($v == "1") {
		$nom = trim($_REQUEST["nom"]);
		$prenom = trim($_REQUEST["prenom"]);
		$ddnj = $_REQUEST["ddnj"];
		$ddnm = $_REQUEST["ddnm"];
		$ddny = $_REQUEST["ddny"];
		$gsm = trim($_REQUEST["gsm"]);
		$cin = trim($_REQUEST["cin"]);
		$adresse = trim($_REQUEST["adresse"]);
		$email = trim($_REQUEST["email"]);
		$haserr = false;
		if($nom == "") {
			$haserr = true;
		}
		if($prenom == "") {
			$haserr = true;
		}
		$err_ddn = false;
		if(!checkdate($ddnm, $ddnj, $ddny)) {
			$err_ddn = true;
		}
		if(strlen($gsm) != 8) {
			$haserr = true;
		} else if(!is_numeric($gsm)) {
			$haserr = true;
		} else if(substr($gsm,0,1) != "2" && substr($gsm,0,1) != "9") {
			$haserr = true;
		}
		$err_cin = false;
		if(strlen($cin) != 8) {
			$err_cin = true;
		} else if(!is_numeric($cin)) {
			$err_cin = true;
		}
		$err_adresse = false;
		if($adresse == "") {
			$err_adresse = true;
		}
		$err_email = false;
		if($email != "") {
			$atom   = '[-a-z0-9!#$%&\'*+\\/=?^_`{|}~]';		// caractères autorisés avant l'arobase
			$domain = '([a-z0-9]([-a-z0-9]*[a-z0-9]+)?)';	// caractères autorisés après l'arobase (nom de domaine)
			$regex = '/^' . $atom . '+' .					// Une ou plusieurs fois les caractères autorisés avant l'arobase
				'(\.' . $atom . '+)*' .						// Suivis par zéro point ou plus
															// séparés par des caractères autorisés avant l'arobase
				'@' .										// Suivis d'un arobase
				'(' . $domain . '{1,63}\.)+' .				// Suivis par 1 à 63 caractères autorisés pour le nom de domaine
															// séparés par des points
				$domain . '{2,63}$/i';						// Suivi de 2 à 63 caractères autorisés pour le nom de domaine

			// test de l'adresse e-mail
			if (!preg_match($regex, $email)) {
				$err_email = true;
			}
		} else {
			$err_email = true;
		}
		if($haserr == false) {
			$sql = "SELECT * FROM joueurs WHERE gsm = '$gsm'";
			$rs1 = mysqli_query($link, $sql) or die ('Erreur mysql : ' . mysqli_error());
			if(mysqli_num_rows($rs1) == 0) {
				$sql = "INSERT INTO joueurs (nom, prenom, gsm";
				if($err_ddn == false) {
					$sql .= ", naisssance";
				}
				if($err_cin == false) {
					$sql .= ", cin";
				}
				if($err_adresse == false) {
					$sql .= ", adresse";
				}
				if($err_email == false) {
					$sql .= ", email";
				}
				$sql .= ") VALUES ('$nom', '$prenom', '$gsm' ";
				if($err_ddn == false) {
					$sql .= ", \"$ddny-$ddnm-$ddnj\"";
				}
				if($err_cin == false) {
					$sql .= ", '$cin'";
				}
				if($err_adresse == false) {
					$sql .= ", '$adresse'";
				}
				if($err_email == false) {
					$sql .= ", '$email'";
				}
				$sql .= ")";

				mysqli_query($link, $sql) or die ('resultat=' .$sql." ". mysqli_error() );
				$id = mysqli_insert_id();
				echo "resultat=".$id;
			} else {
				$row = mysqli_fetch_object($rs1);
				if(null == $row->date) {
					echo "resultat=".$row->id;
				} else {
					echo "resultat=01";
				}
			}
		} else {
			echo "resultat=0";
		}
	} else {
		echo "resultat=-1";
	}
} else {
	echo "resultat=-1";
}
?>
