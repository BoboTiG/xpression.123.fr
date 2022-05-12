<?php
	require('../Settings.php');
	require('../SSI.php');
	include('t2_class_image.php'); // appel d'une classe pour opérer l'image

	global $db_prefix;

	// rédifinition de la fonction file_put_contents si elle est désactivée
	if(!function_exists('file_put_contents')) {
		function file_put_contents($filename, $data) {
			if ($fp = fopen($filename,'wb')) {
				$ok = fwrite($fp,$data);
				fclose($fp);
				return $ok;
			}
			else
				return false;
		}
	}

	// variables :
		// champ image :
			$image = $_FILES['image'];
			$image_name = $_FILES['image']['name'];
			$image_tmp = $_FILES['image']['tmp_name'];
			$image_size = $_FILES['image']['size'];
			$image_type = $_FILES['image']['type'];
		// autres champs :
			$pseudo = $_POST['pseudo']; // pseudo du posteur
			$url = $_POST['url']; // adresse URL complète
			$image_erreur = 0; // pour connaîtres les erreurs
			$repertoire = $boardurl.'/attachments/';
			//$dossier = dirname(__FILE__).'/../attachments/'; // nom du répertoire où seront stockées les images
			$dossier = getcwd().'../../attachments/';

	// fonctions pour la session MySQL :
		function connexion() {
			mysql_connect($db_server, $db_user, $db_passwd);
			mysql_select_db($db_name);
		}

		function quitter() {
			mysql_close();
		}

	// on décortique l'URL pour ne garder que le principal :
	/*
		* Plusieurs cas se présentent, soit l'utilisateur
		* ouvre un nouveau sujet, soit il répond à un sujet
		* déjà existant.
		* Si le sujet est existant, le numéro du topic est
		* renseigné dans l'URL.
		* Sinon, il faut voir dans la base de données quel
		* est le dernier numéro entré qu'il faudra incrémenter
		* de 1.
	*/
	// on range dans un tableau les parties de l'URL séparées par un ';'
		$url = explode (';', $url);
		if (strstr($url['1'], 'topic')) // sujet exsitant
			$url = $url['1'];
		elseif (strstr($url['2'], 'topic'))
			$url = $url['2'];
		elseif (strstr($url['3'], 'topic'))
			$url = $url['3'];
		elseif (strstr($url['4'], 'topic'))
			$url = $url['4'];
		elseif (strstr($url['5'], 'topic'))
			$url = $url['5'];
		elseif (strstr($url['6'], 'topic'))
			$url = $url['6'];
		else { // nouveau sujet, recherche de l'ID du dernier sujet dans la BDD

			connexion();
			$requete_sql = mysql_query("
				SELECT ID_TOPIC
				FROM `smf_topics`
				ORDER BY ID_TOPIC DESC
				BETWEEN 0 AND 1");
			quitter();

			$donnees = mysql_fetch_array($requete_sql);
				$id = $donnees['ID_TOPIC'];
				$id++;
				$url = 'topic='.$id.'.0';
		}
		/*
			* Ce qui donnera par exemple : topic=5.0
			* Il suffira de mettre une variable pour l'URL du site, suivie
			* de celle-ci pour pouvoir se rendre à l'URL complète du sujet.
		*/

	// définition de la date (format : JJ Mois Année) :
		$mois[0] = 'Janvier';
		$mois[1] = 'Février';
		$mois[2] = 'Mars';
		$mois[3] = 'Avril';
		$mois[4] = 'Mai';
		$mois[5] = 'Juin';
		$mois[6] = 'Juillet';
		$mois[7] = 'Août';
		$mois[8] = 'Septembre';
		$mois[9] = 'Octobre';
		$mois[10] = 'Novembre';
		$mois[11] = 'Décembre';

		$date = date('d').' ';
		$date .= $mois[date('m')].' ';
		$date .= date('Y');

	// le champ image est-il bien renseigné ?
		if (empty($image_name))
			$image_erreur = 1;

	// traitement du nom de l'image :
		if ($image_erreur === 0) {
			$image_name = strtolower($image_name);
			$interdits[0] = '/é/';
			$interdits[1] = '/ê/';
			$interdits[2] = '/è/';
			$interdits[3] = '/ë/';
			$interdits[4] = '/à/';
			$interdits[5] = '/â/';
			$interdits[6] = '/ù/';
			$interdits[7] = '/û/';
			$interdits[8] = '/î/';
			$interdits[9] = '/ï/';
			$interdits[10] = '/ç/';
			$interdits[11] = '/-/';
			$interdits[12] = '/ /';
			$interdits[13] = '/~/';
			$interdits[14] = '/ö/';
			$interdits[15] = '/ô/';
			$interdits[15] = '///';
			$interdits[15] = '/\//';

			$remplacements[0] = 'e';
			$remplacements[1] = 'e';
			$remplacements[2] = 'e';
			$remplacements[3] = 'e';
			$remplacements[4] = 'a';
			$remplacements[5] = 'a';
			$remplacements[6] = 'u';
			$remplacements[7] = 'u';
			$remplacements[8] = 'i';
			$remplacements[9] = 'i';
			$remplacements[10] = 'c';
			$remplacements[11] = '_';
			$remplacements[12] = '_';
			$remplacements[13] = '_';
			$remplacements[14] = 'o';
			$remplacements[15] = 'o';
			$remplacements[15] = ' ';
			$remplacements[15] = ' ';

			$image_name = preg_replace($interdits, $remplacements, $image_name);
			// le format est-il acceptable ?
			if ($image_type <> 'image/jpeg' && $image_type <> 'image/png' && $image_type <> 'image/gif' && $image_type <> 'application/x-shockwave-flash')
				$image_erreur = 3;
		}

	chdir('../attachments/'); // rendons-nous dans le dossier des images

	// l'image existe t-elle déjà ?
		if ($image_erreur === 0 && file_exists($image_name)) {
			// ajout d'un nombre aléatoire pour éviter les doublons :
				$prefixe = rand(0, 1000000000); // choix d'un nombre entre 0 et 1 milliard (il y a de quoi faire...)
				$image_name = $prefixe.'_'.$image_name;
		}

	// opérations :
		// déplacement de l'image :
			if ($image_erreur === 0) {
				if (!copy($image_tmp, $image_name))
					$image_erreur = 4;
			}

		// affectation des droits :
			if ($image_erreur === 0) {
				chmod($image_name, 0755); // affectation des droits nécessaires
			}

	// dimensions de l'image :
		if ($image_erreur === 0) {
			$info = getimagesize($image_name);
			$largeur = $info['0'];
			$hauteur = $info['1'];
		}

	// opérations AJAX :
	if ($image_erreur === 0) {
		// aucun problème renconté, tout s'est bien passé
		if ($image_type <> 'application/x-shockwave-flash') { // images de type jpg, png et gif :
			// création de la miniature :
			$miniature = 'm_'.$image_name;

			if (copy($image_name, $miniature)) {
				// création d'une miniature de 118px de largeur, la hauteur est automatique.
				$thumb = new Image($miniature);
				$thumb->width(118);
				$thumb->save();

				if ($thumb) {
					$erreur = 'OK';
					$vignette = $repertoire.$miniature;

					connexion();
					$sql = mysql_query("
						INSERT INTO {$db_prefix}t2_images (pseudo,nom,miniature,url,date,type,poids,largeur,hauteur)
						VALUES ('$pseudo','$image_name','$miniature','$url','$date.','$image_type','$image_size','$largeur','$hauteur')
					");
					$optimise = mysql_query("OPTIMIZE TABLE {$db_prefix}t2_images");
					quitter();
				}

				else {
					$erreur = '<p style=\'text-align:center; color:red;\'> Impossible de créer la miniature ! </p>';
				}
			}

			else {
				$erreur = '<p style=\'text-align:center; color:red;\'> Impossible de faire une copie de l\'image ! </p>';
			}
		}

		else { // animation Flash
			$erreur = 'OK';

			connexion();
			$sql = mysql_query("
				INSERT INTO {$db_prefix}t2_images (pseudo,nom,url,date,type,poids,largeur,hauteur)
				VALUES ('$pseudo','$image_name','$url','$date','$image_type','$image_size','$largeur','$hauteur')
			");
			$optimise = mysql_query("OPTIMIZE TABLE {$db_prefix}t2_images");
			quitter();
		}
	}

	elseif ($image_erreur === 1) {
		$erreur = '<p style=\'text-align:center; color:red;\'>Veuillez sélectionner un fichier.</p>';
	}

	elseif ($image_erreur === 2) {
		$erreur = '<p style=\'text-align:center; color:red;\'>Problème d\'attribution de <strong>droits</strong>.</p>';
	}

	elseif ($image_erreur === 3) {
		$erreur = '<p style=\'text-align:center; color:red;\'>Le fichier n\'est pas une <strong>image</strong> (formats acceptés : jpg, gif, png et swf).</p>';
	}

	elseif ($image_erreur === 4) {
		$erreur = '<p style=\'text-align:center; color:red;\'> Impossible de <strong>déplacer</strong> l\'image ! </p>';
	}

	// envoi des résultats :
	// 	format (erreur, chemin, miniature, type, largeur, hauteur)
	if ($erreur === 'OK') {
		if ($image_type == 'application/x-shockwave-flash') { // s'il s'agit d'une animation Flash :
			echo
				'<script type="text/javascript">
					parent.envoiFin("'.$erreur.'","'.$repertoire.$image_name.'","","'.$image_type.'","'.$largeur.'","'.$hauteur.'");
				</script>';
		}
		else {
			echo
				'<script type="text/javascript">
					parent.envoiFin("'.$erreur.'","'.$repertoire.$image_name.'","'.$vignette.'","","","");
				</script>';
		}
	}
	else {
		echo
			'<script type="text/javascript">
				parent.envoiFin("'.$erreur.'","","","","","");
			</script>';
	}
?>
