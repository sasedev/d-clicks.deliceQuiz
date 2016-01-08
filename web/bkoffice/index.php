<?php
/*
 * Created on 08 nov. 2008
 * by Salah Abdelkader Seif Eddine
 * using PHPeclipse
 */
session_start();
if(!isset($_SESSION["alogged"])) {
	header("Location: login.php");
	exit(0);
}
require_once("../cnf/cfg.php");
$link = mysqli_connect($dbhost, $dbuser, $dbpass);
if (!$link) {
	die('Impossible de se connecter : ' . mysqli_error());
}

// Rendre la base de données $dbname, la base courante
$dbln = mysqli_select_db($link, $dbname);
if (!$dbln) {
	die ('Impossible de sélectionner la base de donn&eacute;es : ' . mysqli_error());
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administration du Quiz D&eacute;lice</title>
<style type="text/css">
body.admin {
	margin:0px; padding:0px;
	font-family:Tahoma,Arial,sans-serif;
	font-size: 12px;
	color:black;
	background-color:#e1e1e1;
}

input.admin {
	color:black;
	background-color:white;
	font-family:Tahoma,Arial,sans-serif;
	font-size: 12px;
	width: 150px;
}

select.admin {
	color:black;
	background-color:white;
	font-family:Tahoma,Arial,sans-serif;
	font-size: 12px;
	width: 150px;
}

h1.admin {
	font-family:Tahoma,Arial,sans-serif;
	color:white;
	background-color:#525D76;
	font-size:22px;
}

h2.admin {
	font-family:Tahoma,Arial,sans-serif;
	color:white;
	background-color:#525D76;
	font-size:16px;
}

h3.admin {
	font-family:Tahoma,Arial,sans-serif;
	color:white;
	background-color:#525D76;
	font-size:14px;
}

h4.admin {
	font-family:Tahoma,Arial,sans-serif;
	color:white;
	background-color:#525D76;
	font-size:12px;
}

b.admin {
	font-family:Tahoma,Arial,sans-serif;
	color:white;
	background-color:#525D76;
}

a.admin {
	color : black;
	font-size: 12px;
}

hr.admin {
	color : #525D76;
}

tr.admin {
	background-color: #eeeeee;
}

th.admin {
	background-color: #eeeeee;
}

td.a1 {
	background-color: #cccccc;
}

td.a2 {
	background-color: #aaaaaa;
}
th.a1 {
	background-color: #cccccc;
}

th.a2 {
	background-color: #aaaaaa;
}
td.txtbg {
	background-color: white;
}
</style>
</head>

<body class="admin">
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
	<td colspan="3" height="69px" style="">
		<a href="http://www.d-clicks.com" target="_blank"><img src="images/bkoffice_01.jpg" alt="D-Clicks" border="0" /></a>
	</td>
</tr>
<tr>
	<td width="29px" height="21px" style="background-image:url(images/bkoffice_03.jpg); background-position:bottom right; background-repeat:no-repeat;"></td>
    <td height="21px" style="background-image:url(images/bkoffice_04.jpg); background-position:bottom center; background-repeat:repeat-x;"></td>
    <td width="27px" height="21px" style="background-image:url(images/bkoffice_05.jpg); background-position:bottom left; background-repeat:no-repeat;"></td>
</tr>
<tr>
	<td style="background-image:url(images/bkoffice_07.jpg); background-position:right; background-repeat:repeat-y;"></td>
    <td style="background-color:#FFFFFF;">
    	<table align="center" width="100%" >
		<tr class="admin"  valign="top">
			<td width="20%"><a href="index.php" class="admin"> Index </a></td>
			<td width="20%"><a class="admin" href="excel.php">Excel</a></td>
			<td width="60%" align="right"><a class="admin" href="logout.php">D&eacute;connexion</a></td>
		</tr>
		</table>
		<hr size="1" noshade="noshade">
		<table align="center" width="100%" >
		<tr class="admin"  valign="top">
			<td align="left"> &nbsp;
			</td><td align="right" class="a1">Nombre d'inscrits : &nbsp;</td>
			<td class="a2"> &nbsp;
		<?php
		$sql = "SELECT COUNT(*) AS j FROM joueurs";
		$rs = mysqli_query($link, $sql) or die("error mysql ".$sql." ".mysqli_error());
		$row = mysqli_fetch_object($rs) or die("error mysql ".$sql." ".mysqli_error());
		$j = $row->j;
		if($j > 0) {
			echo "<a href=\"?op=inscrits\" class=\"admin\">".$row->j."</a>";
		} else {
			echo $row->j;
		}
		?>
			</td>
			<td align="left" width="50%" colspan="7"> &nbsp;
			</td>
		</tr>

		<tr class="admin"  valign="top">
			<td align="left"> &nbsp;
			</td><td align="right" class="a1">Nombre de gagnants : &nbsp;</td>
			<td class="a2"> &nbsp;
		<?php
		$sql = "SELECT COUNT(*) AS g FROM joueurs WHERE date IS NOT NULL";
		$rs = mysqli_query($link, $sql);
		$row = mysqli_fetch_object($rs);
		$g = $row->g;
		if($g > 0) {
			echo "<a href=\"?op=gagnants\" class=\"admin\">".$row->g."</a>";
		} else {
			echo $row->g;
		}
		?>
			</td>
			<td align="left" colspan="7"> &nbsp;
			</td>
		</tr>

		<tr class="admin"  valign="top">
			<td align="left"> &nbsp;
			</td><td align="right" class="a1">Nombre de partie jouées : &nbsp;</td>
			<td class="a2"> &nbsp;
		<?php
		$sql = "SELECT SUM(nbrjeu) AS p FROM joueurs";
		$rs = mysqli_query($link, $sql);
		$row = mysqli_fetch_object($rs);
		echo $row->p;
		?>
			</td>
			<td align="left" colspan="7"> &nbsp;
			</td>
		</tr>
		</table>
		<hr size="1" noshade="noshade">
		<?php
		$op = $_REQUEST["op"];
		if($op == "gagnants") {
			if($g > 0) {
				$sql = "SELECT * FROM joueurs WHERE date IS NOT NULL";
				$order = $_REQUEST["order"];
				$dir = $_REQUEST["dir"];
				if($order == "id") {
					$sql .=" ORDER BY id";
					if($dir == "asc") {
						$sql .=" ASC";
					}
					if($dir == "desc") {
						$sql .=" DESC";
					}
				}
				if($order == "nom") {
					$sql .=" ORDER BY nom";
					if($dir == "asc") {
						$sql .=" ASC";
					}
					if($dir == "desc") {
						$sql .=" DESC";
					}
				}
				if($order == "prenom") {
					$sql .=" ORDER BY prenom";
					if($dir == "asc") {
						$sql .=" ASC";
					}
					if($dir == "desc") {
						$sql .=" DESC";
					}
				}
				if($order == "naissance") {
					$sql .=" ORDER BY naisssance";
					if($dir == "asc") {
						$sql .=" ASC";
					}
					if($dir == "desc") {
						$sql .=" DESC";
					}
				}
				if($order == "gsm") {
					$sql .=" ORDER BY gsm";
					if($dir == "asc") {
						$sql .=" ASC";
					}
					if($dir == "desc") {
						$sql .=" DESC";
					}
				}
				if($order == "cin") {
					$sql .=" ORDER BY cin";
					if($dir == "asc") {
						$sql .=" ASC";
					}
					if($dir == "desc") {
						$sql .=" DESC";
					}
				}
				if($order == "adresse") {
					$sql .=" ORDER BY adresse";
					if($dir == "asc") {
						$sql .=" ASC";
					}
					if($dir == "desc") {
						$sql .=" DESC";
					}
				}
				if($order == "email") {
					$sql .=" ORDER BY email";
					if($dir == "asc") {
						$sql .=" ASC";
					}
					if($dir == "desc") {
						$sql .=" DESC";
					}
				}
				if($order == "nbrjeu") {
					$sql .=" ORDER BY nbrjeu";
					if($dir == "asc") {
						$sql .=" ASC";
					}
					if($dir == "desc") {
						$sql .=" DESC";
					}
				}
				if($order == "date") {
					$sql .=" ORDER BY date";
					if($dir == "asc") {
						$sql .=" ASC";
					}
					if($dir == "desc") {
						$sql .=" DESC";
					}
				}
				//echo $sql;
				$rs = mysqli_query($link, $sql);
		?>
		<table align="center" width="100%" >
		<tr>
			<th class="a2" colspan="10" align="center">Liste des gagnants&nbsp;</th>
		</tr>
		<tr class="admin">
			<th align="center" class="a1">
			<a href="?op=gagnants&order=id&dir=asc" class="admin"><img src="images/bas.png" alt="ASC" border="0" width="12px" height="12px" /></a>
			 &nbsp; ID &nbsp;
			<a href="?op=gagnants&order=id&dir=desc" class="admin"><img src="images/haut.png" alt="DESC" border="0" width="12px" height="12px" /></a>
			</th>
			<th align="center" class="a1">
			<a href="?op=gagnants&order=nom&dir=asc" class="admin"><img src="images/bas.png" alt="ASC" border="0" width="12px" height="12px" /></a>
			 &nbsp; Nom &nbsp;
			<a href="?op=gagnants&order=nom&dir=desc" class="admin"><img src="images/haut.png" alt="DESC" border="0" width="12px" height="12px" /></a>
			</th>
			<th align="center" class="a1">
			<a href="?op=gagnants&order=prenom&dir=asc" class="admin"><img src="images/bas.png" alt="ASC" border="0" width="12px" height="12px" /></a>
			 &nbsp; Prenom &nbsp;
			<a href="?op=gagnants&order=prenom&dir=desc" class="admin"><img src="images/haut.png" alt="DESC" border="0" width="12px" height="12px" /></a>
			</th>
			<th align="center" class="a1">
			<a href="?op=gagnants&order=naissance&dir=asc" class="admin"><img src="images/bas.png" alt="ASC" border="0" width="12px" height="12px" /></a>
			 &nbsp; Naissance &nbsp;
			<a href="?op=gagnants&order=naissance&dir=desc" class="admin"><img src="images/haut.png" alt="DESC" border="0" width="12px" height="12px" /></a>
			</th>
			<th align="center" class="a1">
			<a href="?op=gagnants&order=gsm&dir=asc" class="admin"><img src="images/bas.png" alt="ASC" border="0" width="12px" height="12px" /></a>
			 &nbsp; GSM &nbsp;
			<a href="?op=gagnants&order=gsm&dir=desc" class="admin"><img src="images/haut.png" alt="DESC" border="0" width="12px" height="12px" /></a>
			</th>
			<th align="center" class="a1">
			<a href="?op=gagnants&order=cin&dir=asc" class="admin"><img src="images/bas.png" alt="ASC" border="0" width="12px" height="12px" /></a>
			 &nbsp; CIN &nbsp;
			<a href="?op=gagnants&order=cin&dir=desc" class="admin"><img src="images/haut.png" alt="DESC" border="0" width="12px" height="12px" /></a>
			</th>
			<th align="center" class="a1">
			<a href="?op=gagnants&order=adresse&dir=asc" class="admin"><img src="images/bas.png" alt="ASC" border="0" width="12px" height="12px" /></a>
			 &nbsp; Adresse &nbsp;
			<a href="?op=gagnants&order=adresse&dir=desc" class="admin"><img src="images/haut.png" alt="DESC" border="0" width="12px" height="12px" /></a>
			</th>
			<th align="center" class="a1">
			<a href="?op=gagnants&order=email&dir=asc" class="admin"><img src="images/bas.png" alt="ASC" border="0" width="12px" height="12px" /></a>
			 &nbsp; Email &nbsp;
			<a href="?op=gagnants&order=email&dir=desc" class="admin"><img src="images/haut.png" alt="DESC" border="0" width="12px" height="12px" /></a>
			</th>
			<th align="center" class="a1">
			<a href="?op=gagnants&order=nbrjeu&dir=asc" class="admin"><img src="images/bas.png" alt="ASC" border="0" width="12px" height="12px" /></a>
			 &nbsp; Jeux &nbsp;
			<a href="?op=gagnants&order=nbrjeu&dir=desc" class="admin"><img src="images/haut.png" alt="DESC" border="0" width="12px" height="12px" /></a>
			</th>
			<th align="center" class="a1">
			<a href="?op=gagnants&order=date&dir=asc" class="admin"><img src="images/bas.png" alt="ASC" border="0" width="12px" height="12px" /></a>
			 &nbsp; Date &nbsp;
			<a href="?op=gagnants&order=date&dir=desc" class="admin"><img src="images/haut.png" alt="DESC" border="0" width="12px" height="12px" /></a>
			</th>
		</tr>
		<?php

				while($row = mysqli_fetch_object($rs)) {
		?>
		<tr class="admin">
			<td align="center">
			<?php echo $row->id; ?>
			</td>
			<td align="center">
			<?php echo $row->nom; ?>
			</td>
			<td align="center">
			<?php echo $row->prenom; ?>
			</td>
			<td align="center">
			<?php echo $row->naisssance; ?>
			</td>
			<td align="center">
			<?php echo $row->gsm; ?>
			</td>
			<td align="center">
			<?php echo $row->cin; ?>
			</td>
			<td align="center">
			<?php echo $row->adresse; ?>
			</td>
			<td align="center">
			<?php echo $row->email; ?>
			</td>
			<td align="center">
			<?php echo $row->nbrjeu; ?>
			</td>
			<td align="center">
			<?php echo $row->date; ?>
			</td>
		</tr>
		<?php
				}
		?>
		</table>
		<?php
			} else {
		?>
				Aucun gagnant trouvé en base de donnée
		<?php
			}
		?>
		<hr size="1" noshade="noshade">
		<?php
		}
		?>


		<?php
		if($op=="inscrits") {
			if($j > 0) {
				$sql = "SELECT * FROM joueurs";
				$order = $_REQUEST["order"];
				$dir = $_REQUEST["dir"];
				if($order == "id") {
					$sql .=" ORDER BY id";
					if($dir == "asc") {
						$sql .=" ASC";
					}
					if($dir == "desc") {
						$sql .=" DESC";
					}
				}
				if($order == "nom") {
					$sql .=" ORDER BY nom";
					if($dir == "asc") {
						$sql .=" ASC";
					}
					if($dir == "desc") {
						$sql .=" DESC";
					}
				}
				if($order == "prenom") {
					$sql .=" ORDER BY prenom";
					if($dir == "asc") {
						$sql .=" ASC";
					}
					if($dir == "desc") {
						$sql .=" DESC";
					}
				}
				if($order == "naissance") {
					$sql .=" ORDER BY naisssance";
					if($dir == "asc") {
						$sql .=" ASC";
					}
					if($dir == "desc") {
						$sql .=" DESC";
					}
				}
				if($order == "gsm") {
					$sql .=" ORDER BY gsm";
					if($dir == "asc") {
						$sql .=" ASC";
					}
					if($dir == "desc") {
						$sql .=" DESC";
					}
				}
				if($order == "cin") {
					$sql .=" ORDER BY cin";
					if($dir == "asc") {
						$sql .=" ASC";
					}
					if($dir == "desc") {
						$sql .=" DESC";
					}
				}
				if($order == "adresse") {
					$sql .=" ORDER BY adresse";
					if($dir == "asc") {
						$sql .=" ASC";
					}
					if($dir == "desc") {
						$sql .=" DESC";
					}
				}
				if($order == "email") {
					$sql .=" ORDER BY email";
					if($dir == "asc") {
						$sql .=" ASC";
					}
					if($dir == "desc") {
						$sql .=" DESC";
					}
				}
				if($order == "nbrjeu") {
					$sql .=" ORDER BY nbrjeu";
					if($dir == "asc") {
						$sql .=" ASC";
					}
					if($dir == "desc") {
						$sql .=" DESC";
					}
				}
				$rs = mysqli_query($link, $sql);
		?>
		<table align="center" width="100%" >
		<tr>
			<th class="a2" colspan="9" align="center">Liste des inscrits&nbsp;</th>
		</tr>
		<tr class="admin">
			<th align="center" class="a1">
			<a href="?op=inscrits&order=id&dir=asc" class="admin"><img src="images/bas.png" alt="ASC" border="0" width="12px" height="12px" /></a>
			 &nbsp; ID &nbsp;
			<a href="?op=inscrits&order=id&dir=desc" class="admin"><img src="images/haut.png" alt="DESC" border="0" width="12px" height="12px" /></a>
			</th>
			<th align="center" class="a1">
			<a href="?op=inscrits&order=nom&dir=asc" class="admin"><img src="images/bas.png" alt="ASC" border="0" width="12px" height="12px" /></a>
			 &nbsp; Nom &nbsp;
			<a href="?op=inscrits&order=nom&dir=desc" class="admin"><img src="images/haut.png" alt="DESC" border="0" width="12px" height="12px" /></a>
			</th>
			<th align="center" class="a1">
			<a href="?op=inscrits&order=prenom&dir=asc" class="admin"><img src="images/bas.png" alt="ASC" border="0" width="12px" height="12px" /></a>
			 &nbsp; Prenom &nbsp;
			<a href="?op=inscrits&order=prenom&dir=desc" class="admin"><img src="images/haut.png" alt="DESC" border="0" width="12px" height="12px" /></a>
			</th>
			<th align="center" class="a1">
			<a href="?op=inscrits&order=naissance&dir=asc" class="admin"><img src="images/bas.png" alt="ASC" border="0" width="12px" height="12px" /></a>
			 &nbsp; Naissance &nbsp;
			<a href="?op=inscrits&order=naissance&dir=desc" class="admin"><img src="images/haut.png" alt="DESC" border="0" width="12px" height="12px" /></a>
			</th>
			<th align="center" class="a1">
			<a href="?op=inscrits&order=gsm&dir=asc" class="admin"><img src="images/bas.png" alt="ASC" border="0" width="12px" height="12px" /></a>
			 &nbsp; GSM &nbsp;
			<a href="?op=inscrits&order=gsm&dir=desc" class="admin"><img src="images/haut.png" alt="DESC" border="0" width="12px" height="12px" /></a>
			</th>
			<th align="center" class="a1">
			<a href="?op=inscrits&order=cin&dir=asc" class="admin"><img src="images/bas.png" alt="ASC" border="0" width="12px" height="12px" /></a>
			 &nbsp; CIN &nbsp;
			<a href="?op=inscrits&order=cin&dir=desc" class="admin"><img src="images/haut.png" alt="DESC" border="0" width="12px" height="12px" /></a>
			</th>
			<th align="center" class="a1">
			<a href="?op=inscrits&order=adresse&dir=asc" class="admin"><img src="images/bas.png" alt="ASC" border="0" width="12px" height="12px" /></a>
			 &nbsp; Adresse &nbsp;
			<a href="?op=inscrits&order=adresse&dir=desc" class="admin"><img src="images/haut.png" alt="DESC" border="0" width="12px" height="12px" /></a>
			</th>
			<th align="center" class="a1">
			<a href="?op=inscrits&order=email&dir=asc" class="admin"><img src="images/bas.png" alt="ASC" border="0" width="12px" height="12px" /></a>
			 &nbsp; Email &nbsp;
			<a href="?op=inscrits&order=email&dir=desc" class="admin"><img src="images/haut.png" alt="DESC" border="0" width="12px" height="12px" /></a>
			</th>
			<th align="center" class="a1">
			<a href="?op=inscrits&order=nbrjeu&dir=asc" class="admin"><img src="images/bas.png" alt="ASC" border="0" width="12px" height="12px" /></a>
			 &nbsp; Jeux &nbsp;
			<a href="?op=inscrits&order=nbrjeu&dir=desc" class="admin"><img src="images/haut.png" alt="DESC" border="0" width="12px" height="12px" /></a>
			</th>
		</tr>
		<?php

				while($row = mysqli_fetch_object($rs)) {
		?>
		<tr class="admin">
			<td align="center">
			<?php echo $row->id; ?>
			</td>
			<td align="center">
			<?php echo $row->nom; ?>
			</td>
			<td align="center">
			<?php echo $row->prenom; ?>
			</td>
			<td align="center">
			<?php echo $row->naisssance; ?>
			</td>
			<td align="center">
			<?php echo $row->gsm; ?>
			</td>
			<td align="center">
			<?php echo $row->cin; ?>
			</td>
			<td align="center">
			<?php echo $row->adresse; ?>
			</td>
			<td align="center">
			<?php echo $row->email; ?>
			</td>
			<td align="center">
			<?php echo $row->nbrjeu; ?>
			</td>
		</tr>
		<?php
				}
		?>
		</table>
		<?php
			} else {
		?>
		Aucun inscrit trouv&eacute; en base de donn&eacute;e
		<?php
			}
		?>
		<hr size="1" noshade="noshade">
		<?php
		}
		?>
	</td>
    <td style="background-image:url(images/bkoffice_09.jpg); background-position:left; background-repeat:repeat-y;"></td>
</tr>
<tr>
	<td width="29px" height="35px" style="background-image:url(images/bkoffice_11.jpg); background-position:top right; background-repeat:no-repeat;"></td>
    <td height="35px" style="background-image:url(images/bkoffice_12.jpg); background-position:top center; background-repeat:repeat-x;"></td>
    <td width="27px" height="35px" style="background-image:url(images/bkoffice_13.jpg); background-position:top left; background-repeat:no-repeat;"></td>
</tr>
</table>
</body>
</html>