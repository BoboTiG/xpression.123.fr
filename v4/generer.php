<?php
	require 'fonctions.php';

	sleep(1); // faisons durer le suspense... !

	// variables associées au tableau "variables" :
		$recup[0] = $_POST['nom_forum'];		// nom du forum
		$recup[1] = $_POST['url_forum'];		// URL du site
		$recup[2] = $_POST['url_theme'];		// URL du thème

	// autres variables :
		(string)$module = $_POST['module'];		// module choisi
		(int)$gen_erreur = 0; 				// pour connaîtres les erreurs
		(string)$final = 'plugins/Gen/';		// dossier contenant les archives générées
		(string)$tmp = 'plugins/tmp/';			// dossier contenant les fichiers à générer
		(string)$retour = '../..';				// pour le chdir ../../ (en rapport avec le niveau de $tmp)
		(string)$erreur = '';
		(string)$modif = '';

	// variables concernant l'icône :
		$icone = $_FILES['icone'];
		$icone_name = $_FILES['icone']['name'];
		$icone_tmp = $_FILES['icone']['tmp_name'];
		$icone_size = $_FILES['icone']['size'];
		$icone_type = $_FILES['icone']['type'];

	// définition du répertoire et fichiers à générés suivant le module choisi :

		# Module modRecherche #
		if ( $module == 'modRecherche' ) {
			if ( $recup['2'] == 'Themes/' ) { // si le thème n'est pas entré
				$dossier = 'plugins/modRecherche/';
				$fichiers[0] = 'infos-install.txt';
				$fichiers[1] = 'infos-suppr.txt';
				$fichiers[2] = 'plugin.xml';
				$fichiers[3] = 't2_modRecherche.xml';
			} else  {
				$dossier = 'plugins/modRecherche/perso/';
				$fichiers[0] = 'infos-install.txt';
				$fichiers[1] = 'infos-suppr.txt';
				$fichiers[2] = 'plugin.xml';
				$fichiers[3] = 't2_modRecherche.xml';
			}
		}

		# Module envoiImages #
		elseif ( $module == 'envoiImages' ) {
			if ( $recup['2'] == 'Themes/' ) { // si le thème n'est pas entré
				$dossier = 'plugins/envoiImages/';
				$fichiers[0] = 'infos-install.txt';
				$fichiers[1] = 'infos-suppr.txt';
				$fichiers[2] = 'plugin.xml';
				$fichiers[3] = 't2_formulaireImages.php';
				$fichiers[4] = 'js.html';
			} else  {
				$dossier = 'plugins/envoiImages/perso/';
				$fichiers[0] = 'infos-install.txt';
				$fichiers[1] = 'infos-suppr.txt';
				$fichiers[2] = 'plugin.xml';
				$fichiers[3] = 't2_formulaireImages.php';
				$fichiers[4] = 'js.html';
			}
		}

		# Module passerelleWP #
		elseif ( $module == 'passerelleWP' ) {
			if ( $recup['2'] == 'Themes/' ) { // si le thème n'est pas entré
				$dossier = 'plugins/passerelleWP/';
				$fichiers[0] = 'infos-install.txt';
				$fichiers[1] = 'infos-suppr.txt';
				$fichiers[2] = 'plugin.xml';
			} else  {
				$dossier = 'plugins/passerelleWP/perso/';
				$fichiers[0] = 'infos-install.txt';
				$fichiers[1] = 'infos-suppr.txt';
				$fichiers[2] = 'plugin.xml';
			}
		}

	// définition des variables à remplacer dans les fichiers :
		$variable[0] = '_nom_forum_';
		$variable[1] = '_url_forum_';
		$variable[2] = '_url_theme_';

	// le nom du forum est-il bien entré ?
		if ( $recup['0'] == '' ) {
			$gen_erreur = 7;
		}

	// infos relatives à certains modules
	if ( $module == 'modRecherche' )  {
		// l'URL du forum est-elle bien entrée ?
			if ( strlen($recup['1']) < 8 ) {
				$gen_erreur = 1;
			}

		// chaque URL se finit-elle par "/" ?
			if ( $gen_erreur === 0 )  {
				if ( substr($recup['1'], -1) != '/' ) {
					$recup['1'] .= '/';
				}
				if ( substr($recup['2'], -1) != '/' ) {
					$recup['2'] .= '/';
				}
			}

		// le champ image est-il bien renseigné ?
			if ( $gen_erreur === 0 ) {
				if ( empty($icone_name) ) {
					$gen_erreur = 4;
				} else {
					$icone_name = 't2_favicon.ico';
				}
			}

		// le format est-il acceptable ?
			if ( $gen_erreur === 0 ) {
				if ( substr($icone_name, -3) != 'ico' ) {
					$gen_erreur = 5;
				}
			}

		// les dimmensions sont-elles correctes ?
			if ( $gen_erreur === 0 ) {
				$img = getimagesize($icone_tmp);
				if ( $img['0'] > 17 || $img['1'] > 17 ) {
					$gen_erreur = 6;
				}
			}
	} elseif ( $module == 'envoiImages' ) {
		// l'URL du thème finit-elle par "/" ?
			if ( $gen_erreur === 0 ) {
				if ( substr($recup['2'], -1) != '/' ) {
					$recup['2'] .= '/';
				}
			}
		}

	// opérations AJAX :
	if ( $gen_erreur === 0 ) {
		// 1. création des nouveaux fichiers :
			(int)$max = count($fichiers); // nombre total de fichiers dans le tableau "fichiers"
			for ( $i = 0; $i < $max; ++$i ) {
				$contenu = file($dossier.$fichiers[$i]); // créer un tableau contenant le fichier ligne par ligne

				foreach ( $contenu as $ligne ) { // regardons le contenu du tableau ligne par ligne
					str_replace($variable, $recup, $ligne); // s'il y a une variable, on la remplace, sinon on passe à la ligne suivante
					$modif .= $ligne;
				}

				$modification = file_put_contents($tmp.$fichiers[$i], $modif); // création du fichier avec le nouveau contenu généré
			}

			// déplacement des autres composants :
				if ( $module == 'modRecherche' ) {
					copy($icone_tmp, $tmp.$icone_name);
					copy($dossier.'package-info.xml', $tmp.'package-info.xml');
				} elseif ( $module == 'envoiImages' ) {
					copy($dossier.'t2_class_image.php', $tmp.'t2_class_image.php');
					copy($dossier.'t2_ajout.php', $tmp.'t2_ajout.php');
					copy($dossier.'suppr_mysql.php', $tmp.'suppr_mysql.php');
					copy($dossier.'ajout_mysql.php', $tmp.'ajout_mysql.php');
					copy($dossier.'package-info.xml', $tmp.'package-info.xml');
					copy($dossier.'t2_chargement.gif', $tmp.'t2_chargement.gif');
				}

		// 2. création de l'archive :
			$zip = new ZipArchive();
				$nom = $module.'_'.rand(0, 1000000000).'.zip'; // nom de l'archive
				$zip->open($tmp.$nom, ZIPARCHIVE::CREATE); // création de l'archive
				chdir($tmp);

				for ( $i = 0; $i < $max; ++$i ) { // ajout des fichiers créés précédemment
					$zip->addFile($thisdir.$fichiers[$i]);
				}

				$zip->addFile($thisdir.$icone_name); // ajout de l'icône

				// ajout des autres fichiers à l'archive :
				if ( $module == 'modRecherche' ) {
					$zip->addFile($thisdir.'package-info.xml');
				} elseif ( $module == 'envoiImages' )  {
					$zip->addFile($thisdir.'package-info.xml');
					$zip->addFile($thisdir.'t2_class_image.php');
					$zip->addFile($thisdir.'t2_ajout.php');
					$zip->addFile($thisdir.'suppr_mysql.php');
					$zip->addFile($thisdir.'ajout_mysql.php');
					$zip->addFile($thisdir.'t2_chargement.gif');
				}

				chdir($retour);
			$zip->close(); // fermeture de l'archive

		// 3. déplacement de l'archive :
			copy($tmp.$nom, $final.$nom);

		// 4. suppression des fichiers temporaires :
			chdir($tmp);
			foreach (glob('*') as $fichierx) {
				unlink($fichierx);
			}
			chdir($retour);

		// 5. lien de téléchargement + on incrémente le nombre de téléchargements :
			$chemin = $final.$nom;

		// 6. aucun problème renconté, tout s'est bien passé
			$erreur = 'OK';
	} else {
		$erreur = '<p style=\'color:orange;\'><strong>Erreur : </strong>';
	}

	### S'il s'agit de la version française ###
	switch ( $gen_erreur ) {
		case 1:
			$erreur .= 'Veuillez entrer l\'URL de votre forum.</p>';
		break;
		case 4:
			$erreur .= 'Vous devez spécifier une icône.</p>';
		break;
		case 5:
			$erreur .= 'Le format de l\'icône n\'est pas valable (format <em>ico</em> requis).</p>';
		break;
		case 6 :
			$erreur .= 'L\'icône est trop grande (16x16 pixels requis).</p>';
		break;
		case 7:
			$erreur = 'Veuillez entrer le nom de votre forum.</p>';
		break;
	}

	// envoi des résultats :
	// format (erreur, chemin)
	echo $erreur;
	if ( $erreur == 'OK' ) {
		echo
		'<script type="text/javascript">
			window.parent.envoiFin("'.$erreur.'","'.$chemin.'");
		</script>';
	} else {
		echo
		'<script type="text/javascript">
			window.parent.envoiFin("'.$erreur.'","'.$chemin.'");
		</script>';
	}
?>
