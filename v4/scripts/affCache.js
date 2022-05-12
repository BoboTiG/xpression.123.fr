function affCache(id) 
{
	// afficher-cacher une div
	
	var id = document.getElementById(id);
	if ( id.style.display === '' )
	{
		id.style.display = 'none';
	}
	else
	{
		id.style.display = '';
	}
	
	// utilisation:
	// le déclencheur peut être n'importe quelle balise:
	// <input type="button" value="Afficher-Masquer" onClick="affCache('div1');"/>
	// <a href="#" onClick="affCache('div1');">Afficher-Masquer</a>
	// <div id="div1">bla bla bla</div>
}
