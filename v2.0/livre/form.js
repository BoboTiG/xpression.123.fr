function Insert(repdeb, repfin) {
  var input = document.forms['ADD'].elements['Texte'];
  input.focus();
  /* pour l'Explorer Internet */
  if(typeof document.selection != 'undefined') {
    /* Insertion du code de formatage */
    var range = document.selection.createRange();
    var insText = range.text;
    range.text = repdeb + insText + repfin;
    /* Ajustement de la position du curseur */
    range = document.selection.createRange();
    if (insText.length == 0) {
      range.move('character', -repfin.length);
    } else {
      range.moveStart('character', repdeb.length + insText.length + repfin.length);
    }
    range.select();
  }
  /* pour navigateurs plus récents basés sur Gecko*/
  else if(typeof input.selectionStart != 'undefined')
  {
    /* Insertion du code de formatage */
    var start = input.selectionStart;
    var end = input.selectionEnd;
    var insText = input.value.substring(start, end);
    input.value = input.value.substr(0, start) + repdeb + insText + repfin + input.value.substr(end);
    /* Ajustement de la position du curseur */
    var pos;
    if (insText.length == 0) {
      pos = start + repdeb.length;
    } else {
      pos = start + repdeb.length + insText.length + repfin.length;
    }
    input.selectionStart = pos;
    input.selectionEnd = pos;
  }
  /* pour les autres navigateurs */
  else
  {
    /* requête de la position d'insertion */
    var pos;
    var re = new RegExp('^[0-9]{0,3}$');
    while(!re.test(pos)) {
      pos = prompt("Insertion à la position (0.." + input.value.length + "):", "0");
    }
    if(pos > input.value.length) {
      pos = input.value.length;
    }
    /* Insertion du code de formatage */
    var insText = prompt("Veuillez entrer le texte à formater:");
    input.value = input.value.substr(0, pos) + repdeb + insText + repfin + input.value.substr(pos);
  }
}

function changeimg(value, style) {
   if (value == "-") {
      img = "nosmile.gif";
   }
   if (value <= 1) {
      img = "nervos.gif";
   }
   if (value > 1 && value <= 4) {
      img = "hein.gif";
   }
   if (value > 4 && value <= 6) {
      img = "hey.gif";
   }
   if (value > 6 && value <= 8) {
      img = "happy.gif";
   }
   if (value > 8) {
      img = "veryhappy.gif";
   }
   document.getElementById("smile").innerHTML = "<img src='images/smilies/" + img + "' style='" + style + "'>";
}

function checkentry(champ) {
	if (window.event.keyCode < 48 || window.event.keyCode > 57) {
		return false;
	}
	nb = window.event.keyCode - 48;
	val = champ.value + nb;
	nb = parseInt(champ.name.substr(((champ.name.length)-1), 1)) + parseInt(1);
	next = 'ip' + nb;
	if (champ.value.length + 1 == 3 && champ.name != 'ip4') {
		if (val > 255) champ.value = 255; else champ.value = val;
		document.getElementById(next).focus();
		document.getElementById(next).select();
		return false;
	}
	if (val > 255) champ.value = 255;
	return true;
}

function openmsg(id) {
   window.open("msg.php?id=" + id, "viewmsg", "toolbar=no, location=no, directories=no, status=no, scrollbars=yes, resizable=no, copyhistory=no, width=550, height=200, left=0, top=0");

}

function verif(done, id) {
   if (done == 'edit') {
      document.getElementById("delete" + id).checked = false;
   }
   if (done == 'delete') {
      document.getElementById("edit" + id).checked = false;
   }
}
