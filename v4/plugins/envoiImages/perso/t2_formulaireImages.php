<?php
	require('../SSI.php');
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
		<title>Formulaire d'envoi d'images - _nom_forum_</title>
		<noscript><meta http-equiv='refresh' content='0; URL=js.html'></noscript>
		<script type="text/javascript">
			function initialisation() {
				// pré-chargement de l'image
				var imageChargement = new Image();
				imageChargement.src = "../Themes/default/images/t2_chargement.gif";
			}

			function envoiEnCours() {
				document.getElementById("envoiChargement").style.visibility = "visible";
				document.getElementById("envoi").disabled = true;
				return true;
			}

			function envoiFin(erreur, chemin, vignette, type, largeur, hauteur) {
				if(erreur == 'OK') {
					if (type == "application/x-shockwave-flash") { // cas d'une animation Flash
						if (largeur > '601')
							var ligne = '[url=' + chemin + ']Voir l\'animation Flash[/url]';
						else
							var ligne = '[flash=' + largeur + ',' + hauteur +']' + chemin + '[/flash]';
					}
					else {
						var ligne = '[url=' + chemin + '][img]' + vignette + '[/img][/url]'; // vignette cliquable ouvrant l'image à taille réelle
					}
					document.getElementById("envoiStatut").innerHTML = "<p style='color:green !important;'>Code à insérer :</p> <p style='border:1px inset grey; background-color:#e4e4ff; text-align:left; padding:2px; color:black;'>" + ligne + "</p>";
				}
				else {
					document.getElementById("envoiStatut").innerHTML = erreur;
				}
				document.getElementById("envoiChargement").style.visibility = "hidden";
				document.getElementById("envoi").disabled = false;
			}
		</script>
	</head>
	<body>
		<div id="envoiDiv" onload="initialisation();" style="width:630px; text-align:center; border:1px black solid; font-size:12px;" >
			<div id="envoiLegende" style="background:#b5d000; line-height:20px; color:white; border-bottom:1px black solid; padding-left:1em; text-align:center; font-weight:bold;" > Ajouter une image </div>
				<div id="envoiCorps" style="padding:5px 5px 5px 5px; background-color:white;" >
					<form id="envoiFormulaire" enctype="multipart/form-data" action="t2_ajout.php" target="envoiFrame" onsubmit="envoiEnCours();" method="post">
						<div style="text-align:center; color:red;">
							<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
							<input type="file" id="image" name="image" size="30" />
							<script type="text/javascript">
								// récupération de l'URL de la fenêtre princpale :
									var urlParent = window.parent.location; // ou bien top.location.href si ça ne fonctionne pas avec tous les navigateurs
									document.write("<input type='hidden' name='url' value='" + urlParent + "' />");
							</script>
							<input type="hidden" name="pseudo" value="<?php echo $context['user']['username']; ?>" />
							<input type="submit" id="envoi" value="Envoyer" />
							&nbsp;
							<img src="../Themes/default/images/t2_chargement.gif" id="envoiChargement" style="visibility:hidden; vertical-align:bottom;" />
						</div>
					</form>
					<div id="envoiStatut" style="text-align:center; color:red;"></div>
					<iframe id="envoiFrame" name="envoiFrame" src="#" style="border:none; height:1px;"></iframe>
				</div>
			</div>
		</div>
	</body>
</html>
