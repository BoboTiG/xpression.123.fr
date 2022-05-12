<?php
	/*
	 * * * * * * * * * * * * * * * * *
	 * Tiger-222
	 * http://xpression.123.fr
	 * Janvier 2008
	 * révision : 07 février 2010
	 * * * * * * * * * * * * * * * * *
	*/

	error_reporting(E_ALL); // affichier toutes les erreurs | 0 pour annuler l'affichage | E_ALL pour tout afficher
	class Config {
		const BASE = '/mnt/stock/Sites/xpression';
		const DATEF = '15 Octobre 2008';							// date de MAJ des modules SMF en français
		const DATEE = 'July 28th 2008';							// date de MAJ des modules SMF en anglais
	}

	// rédifinition de la fonction file_get_contents si elle est désactivée
	if ( ! function_exists('file_get_contents') ) {
		function file_get_contents($filename) {
			if ( $fp = fopen($filename,'rb') ) {
				$buffer = fread($fp,filesize($filename));
				fclose($fp);
				return $buffer;
			} else {
				return false;
			}
		}
	}

	// rédifinition de la fonction file_put_contents si elle est désactivée
	if ( ! function_exists('file_put_contents') ) {
		function file_put_contents($filename, $data) {
			if ( $fp = fopen($filename,'wb') ) {
				$ok = fwrite($fp,$data);
				fclose($fp);
				return $ok;
			} else {
				return false;
			}
		}
	}

	/*
	 * Tiger-222 - 03 septembre 2008
	 * révisée le 07 février 2010
	 *
	 * Fonction qui recherche les fichiers dans un répertoire donné
	 * puis sort un tableau rangé à la de façon d'Apache.
	 *
	 * Prend 1 argument : le nom du dossier.
	 */
	function intellectApache($dossier) {
		// 0. Variables :
		$action = opendir($dossier);
		(int)$i = 0;
		$tableau = array();

		// 1. Listons les fichiers dans un tableau :
			// 1.1 Variable des icônes :
			$icones = array(
				'pdf' => '<img src="../images/depot/icone_pdf.gif" title="document PDF" />',
				'sh' => '<img src="../images/depot/icone_shell.gif" title="script shell" />',
				'txt' => '<img src="../images/depot/icone_txt.gif" title="script PHP ou document HTML" />',
				'properties' => '<img src="../images/depot/icone_txt.gif" title="document texte brut" />',
				'septz' => '<img src="../images/depot/icone_zip.gif" title="archive 7-zip" />',
				'rar' => '<img src="../images/depot/icone_zip.gif" title="archive RAR" />',
				'tar' => '<img src="../images/depot/icone_zip.gif" title="archive tar" />',
				'zip' => '<img src="../images/depot/icone_zip.gif" title="archive zip" />',
				'tgz' => '<img src="../images/depot/icone_zip.gif" title="archive tar (compressée gzip)" />',
				'bz2' => '<img src="../images/depot/icone_zip.gif" title="archive tar (compressée bzip)" />',
				'gz' => '<img src="../images/depot/icone_zip.gif" title="archive gzip" />',
			);

			// 1.2 Listons !
			while ( FALSE !== ($file = readdir($action)) ) {
				if ( is_file($file) && strpos($file, '~') === FALSE && ! preg_match('/.php$/', $file) && ! preg_match('/.html$/', $file) ) {
					$tableau[$i]['nom'] = $file;	// Nom du fichier
					$tableau[$i]['date'] = date('d/m/Y à H:i', filemtime($file)); // Date de dernière modification du fichier
					$tableau[$i]['poids'] = filesize($file); // Poids du fichier
					// Icône du fichier :
					(string)$ext = pathinfo($file, PATHINFO_EXTENSION);
					$tableau[$i]['icone'] = $icones[$ext];
				}
				++$i;
			}
			closedir($action);

		// 2. Trions par ordre alphabétique :
		sort($tableau);

		// 3. Affichons les résultats :
			// 3.1 Entête du tableau :
			echo
				'<table>
					<tr>
						<th style="width:3%;"></th>
						<th style="width:57%;">Nom</th>
						<th style="width:30%;">Dernière modification</th>
						<th style="width:10%;">Poids</th>
					</tr>';

			// 3.2 Remplissage du tableau :
			(int)$compte = count($tableau);
			$i = 0;
			while ( $i < $compte ) {
				$fichier = $dossier.'/'.$tableau[$i]['nom'];
				echo
					'<tr class="ligne">
						<td>'.$tableau[$i]['icone'].'</td>
						<td><a href="'.$fichier.'">'.$tableau[$i]['nom'].'</a></td>
						<td>'.$tableau[$i]['date'].'</td>
						<td>'.$tableau[$i]['poids'].'</td>
					</tr>';
				++$i;
			}

			// 3.3 Pied du tableau :
			echo '</table>';
	}
?>
