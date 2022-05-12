function envoiEnCours() {
	document.getElementById('envoiChargement').style.visibility = 'visible';
	document.getElementById('envoi').disabled = true;
	return true;
}

function envoiFin(erreur, chemin) 
{
	if ( erreur === 'OK' ) 
	{
		//var ligne = ' &laquo; <a href="' + chemin + '" style="border-bottom:1px dashed white; border-top:1px dashed white;">Télécharger l\'archive</a> &raquo; '; // lien lançant le téléchargement
		var ligne = ' <a href="' + chemin + '" class="telecharger"><img src="images/ressources/telecharger.png" title="Télécharger l\'archive" alt="Télécharger"/></a>'; // lien lançant le téléchargement
		document.getElementById('envoiStatut').innerHTML = '<br />' + ligne;
	}
	else 
	{
		document.getElementById('envoiStatut').innerHTML = erreur;
	}
	document.getElementById('envoiChargement').style.visibility = 'hidden';
	document.getElementById('envoi').disabled = false;
}
