<?php
	$dateUnix = isset($_POST['unix']) ? $_POST['unix'] : 0;
	if ($dateUnix == '' || !is_numeric($dateUnix))
		$dateUnix = 0;

	class dateUTC {

		/*
		 * Tiger-222 - le 24 Juillet 2008 - révision le 03 Août 2008
		 *
		 * Classe qui convertit la date au format Unix vers AAAA-MM-JJ hh:mm:ss
		 *
		 * Exemple : 1217236577 deviendra 2008-07-26 09:16:17
		 */

		public function __construct($dateUnix) {
			$this->afficher($dateUnix);
		}

		/*
		 * Fonction qui retourne la partie entière du nombre passé en paramètre.
		 *
		 * Prend 1 argument.
		 */
		private function entier($nombre) {
			if ($nombre < 1) {
				return 0;
			}
			else {
				$nombreAvant = explode('.', $nombre);
				return $nombreAvant['0'];
			}
		}

		/*
		 * Fonction de conversion.
		 *
		 * Prend 1 argument.
		 */
		private function convertir($dateUnix) {
			/*
			 * La fonction entier() indiquera le nombre entier d'unités de temps.
			 *
			 * Principe :
			 *  La plus grande unité de temps invariable est le jour ; les mois
			 *  (28, 29, 30 ou 31 jours) et les années (365 ou 366) sont variables.
			 *  La première étape consiste à décompter le nombre de périodes
			 *  quadriennales bisextiles.
			 *
			 * 	La date au format Unix étant le nombre de secondes depuis
			 * 	le 1er Janvier 1970, et la première année bisextile étant
			 * 	1972, nous calculons le nombre de secondes entre
			 * 	le 01/01/1970 et le 29/02/1972.
			 */

			/*
			 * Définitions des variables :
			 */
			$vingtSixMois = 60 * 60 * 24 * 790;
			$quatreAns = 126230400;
			$unAn = 31536000;
			$unJour = 86400;

			if ($dateUnix > $vingtSixMois) {
				/* ########################################################
				 * 1er calcul : le nombre de périodes quadriennales bisextiles.
				 */
				$tranche = $this->entier(($dateUnix - $vingtSixMois) / $quatreAns);

				/*
				 * Calcul des secondes restantes :
				 */
				$reste = $dateUnix - $vingtSixMois - ($quatreAns * $tranche);
			}
			else {
				$reste = $dateUnix;
			}

			/* ########################################################
			 * 2ème calcul : le nombre d'années.
			 */
			$nbAnnee = $this->entier($reste / $unAn);

			/*
			 * Calcul des secondes restantes :
			 */
			$reste = $reste - ($nbAnnee * $unAn);

			/* ########################################################
			 * 3ème calcul : nombre de jours.
			 */
			$nbJours = $this->entier($reste / $unJour);
			$jours = $nbJours + 1;

			/*
			 * Nombre de jours par mois.
			 */
			if ($dateUnix <= $vingtSixMois) {
				$Mois[0] = 31;				// Janvier
				if ($nbAnnee == 2)
					$Mois[1] = 29;			// Février
				else
					$Mois[1] = 28;			// Février
				$Mois[2] = 31;				// Mars
				$Mois[3] = 30;				// Avril
				$Mois[4] = 31;				// Mai
				$Mois[5] = 30;				// Juin
				$Mois[6] = 31;				// Juillet
				$Mois[7] = 31;				// Août
				$Mois[8] = 30;				// Septembre
				$Mois[9] = 31;				// Octobre
				$Mois[10] = 30;				// Novembre
				$Mois[11] = 31;				// Décembre

				/*
				 * Numéro du mois.
				 */
				$MoisN[0] = '01';			// Janvier
				$MoisN[1] = '02';			// Février
				$MoisN[2] = '03';			// Mars
				$MoisN[3] = '04';			// Avril
				$MoisN[4] = '05';			// Mai
				$MoisN[5] = '06';			// Juin
				$MoisN[6] = '07';			// Juillet
				$MoisN[7] = '08';			// Août
				$MoisN[8] = '09';			// Septembre
				$MoisN[9] = '10';			// Octobre
				$MoisN[10] = '11';			// Novembre
				$MoisN[11] = '12';			// Décembre
			}
			else {
				$Mois[0] = 31;				// Mars
				$Mois[1] = 30;				// Avril
				$Mois[2] = 31;				// Mai
				$Mois[3] = 30;				// Juin
				$Mois[4] = 31;				// Juillet
				$Mois[5] = 31;				// Août
				$Mois[6] = 30;				// Septembre
				$Mois[7] = 31;				// Octobre
				$Mois[8] = 30;				// Novembre
				$Mois[9] = 31;				// Décembre
				$Mois[10] = 31;				// Janvier
				$Mois[11] = 28;				// Février

				/*
				 * Numéro du mois.
				 */
				$MoisN[0] = '03';			// Mars
				$MoisN[1] = '04';			// Avril
				$MoisN[2] = '05';			// Mai
				$MoisN[3] = '06';			// Juin
				$MoisN[4] = '07';			// Juillet
				$MoisN[5] = '08';			// Août
				$MoisN[6] = '09';			// Septembre
				$MoisN[7] = '10';			// Octobre
				$MoisN[8] = '11';			// Novembre
				$MoisN[9] = '12';			// Décembre
				$MoisN[10] = '01';			// Janvier
				$MoisN[11] = '02';			// Février
			}

			/*
			 * Détermination du numéro du mois en cours.
			 */
			$max = count($Mois);

			for ($i = 0; $i < $max; ++$i) {
				if ($jours > $Mois[$i]) {
					$jours = $jours - $Mois[$i];
				}
				elseif ($jours == $Mois[$i]) {
					$mois = $MoisN[$i];
					$i = $max;
				}
				else {
					$mois = $MoisN[$i];
					$i = $max;
				}
			}

			if ($jours < 10) {
				$jours = '0'.$jours;
			}

			/*
			 * Détermination de l'année.
			 */
			if ($dateUnix > $vingtSixMois) {
				if ($nbJours <= 306) {
					if ($tranche < 1) {
						$annee = 1972 + $nbAnnee;
					}
					else {
						$annee = ($tranche * 4) + $nbAnnee + 1972;
					}
				}
				else {
					if ($tranche < 1) {
						$annee = 1972 + 1 + $nbAnnee;
					}
					else {
						$annee = ($tranche * 4) + $nbAnnee + 1972 + 1;
					}
				}
			}
			else {
				$annee = 1970 + $nbAnnee;
			}

			/*
			 * Calcul des secondes restantes :
			 */
			$reste = $reste - ($nbJours * $unJour);


			/* ########################################################
			 * 4ème calcul : nombre d'heures.
			 */
			$heures = $this->entier($reste / 3600);
			if ($heures < 10)
				$heures = '0'.$heures;

			/*
			 * Calcul des secondes restantes :
			 */
			$reste = $reste - ($heures * 3600);


			/* ########################################################
			 * 5ème calcul : nombre de minutes.
			 */
			$minutes = $this->entier($reste / 60);
			if ($minutes < 10)
				$minutes = '0'.$minutes;

			/*
			 * Calcul des secondes restantes :
			 */
			$secondes = $reste - ($minutes * 60);
			if ($secondes < 10)
				$secondes = '0'.$secondes;


			/* ########################################################
			 * Formatage de la date.
			 */
			$finale = $annee.'-'.$mois.'-'.$jours.' '.$heures.':'.$minutes.':'.$secondes;
			echo $finale;
		}

		public function afficher($dateUnix) {
			$this->convertir($dateUnix);
		}
	}

	// appeler la classe tel que :
	//$test = new dateWP(1217236577);
?>

<div class="ressources">	
	<p class="p_titre">Unix Time Converter</p>
		
	<form action="index.php?menu=utc" method="post">
		<table style="margin-left:auto; margin-right:auto; width:500px;">
			<tr>
				<td style="text-align:right;"> Format Unix : </td>
				<td> <input type="text" name="unix" size="30" value="<?php echo $dateUnix; ?>" style="text-align:center;" /> </td>
			</tr>
			<tr>
				<td style="text-align:right;"> Format ISO : </td>
				<td> <input type="text" size="30" value="<?php new dateUTC($dateUnix); ?>" style="text-align:center;" /> </td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:center;">
					<br />
					<input type="submit" value="Convertir" />
				</td>
			</tr>
		</table>
	</form>
</div>
