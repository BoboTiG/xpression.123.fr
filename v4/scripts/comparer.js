function comparer(resultat1, resultat2, form) 
{
var resultat1 = form.original.value;
var resultat2 = form.mine.value;

if ((resultat1 == '') || (resultat2 == '')) {
	alert ("Daigne au moins remplir les champs!");
	}
else {
	if (resultat1 == resultat2) {
		alert ("Les résultats sont Ok.");
		}
	else {
		alert ("Les résultats diffèrent, tente de télécharger à nouveau ton fichier.");
		}
	}
}
