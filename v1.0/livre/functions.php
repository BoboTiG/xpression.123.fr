<?
/***********************************************************************/
/*
/*		Créateur: Kra<K							 
/*		Date: 22/01/2005							 
/*		Version: 3.2					 
/*											 
/***********************************************************************/

function date_fr() { 
	$jour =  date('l'); 
	$le = date('j'); 
	$mois =  date('F'); 
	$annee = date('Y'); 
	$heure = date('G'); 
	$minute =  date('i'); 
switch($jour) { 
    case 'Monday': $jour = 'Lundi'; break; 
    case 'Tuesday': $jour = 'Mardi'; break; 
    case 'Wednesday': $jour = 'Mercredi'; break; 
    case 'Thursday': $jour = 'Jeudi'; break; 
    case 'Friday': $jour = 'Vendredi'; break; 
    case 'Saturday': $jour = 'Samedi'; break; 
    case 'Sunday': $jour = 'Dimanche'; break; 
    default: $jour =''; break; 
  } 
switch($mois) { 
    case 'January': $mois = 'Janvier'; break; 
    case 'February': $mois = 'Février'; break; 
    case 'March': $mois = 'Mars'; break; 
    case 'April': $mois = 'Avril'; break; 
    case 'May': $mois = 'Mai'; break; 
    case 'June': $mois = 'Juin'; break; 
    case 'July': $mois = 'Juillet'; break; 
    case 'August': $mois = 'Août'; break; 
    case 'September': $mois = 'Septembre'; break; 
    case 'October': $mois = 'Octobre'; break; 
    case 'November': $mois = 'Novembre'; break; 
    case 'December': $mois = 'Decembre'; break; 
    default: $mois =''; break; 
  } 
  return $jour." ".$le." ".$mois." à ".$heure.":".$minute; 
} 

function MyAddSlashes($chaine ) {
  return( get_magic_quotes_gpc() == 1 ? 
          $chaine : 
          addslashes($chaine) );
}

function MyStripSlashes($chaine) {
  return( get_magic_quotes_gpc() == 1 ? 
          stripslashes($chaine) : 
          $chaine );
}

function test_color($matches) {
   return (in_array($matches[1], array('blue', 'red', 'orange', 'purple', 'yellow', 'gray', 'green')) ? 
		   '<span style="color:'.$matches[1].';">'.$matches[2].'</span>' :
		   $matches[2]);
}

function bbcode($chaine, $img='img'){ 

    $chaine = htmlspecialchars($chaine);   

    $chaine = preg_replace('`\[url=([http://].+?)](.+?)\[/url]`si','<a href="$1" class="msg" target="_blank" title="$1">$2</a>', $chaine); 
    $chaine = preg_replace('`\[url=(.+?)](.+?)\[/url]`si','<a href="http://$1" class="msg" target="_blank" title="$1">$2</a>',$chaine); 
    $chaine = preg_replace('`\[url]([http://].+?)\[/url]`si','<a href="$1" class="msg" target="_blank" title="$1">$1</a>',$chaine); 
    $chaine = preg_replace('`\[url](.+?)\[/url]`si','<a href="http://$1" class="msg" target="_blank" title="$1">$1</a>',$chaine); 
    $chaine = preg_replace('#\[B](.+?)\[/B]#si','<strong>$1</strong>',$chaine); 
    $chaine = preg_replace('#\[U](.+?)\[/U]#si','<span style="text-decoration:underline;">$1</span>',$chaine); 
    $chaine = preg_replace('#\[I](.+?)\[/I]#si','<em>$1</em>',$chaine); 
    $chaine = preg_replace_callback('#\[color=(.+?)](.+?)\[/color]#si', 'test_color', $chaine); 
    $chaine = preg_replace('#\[size=([0-9]{1,2})](.+?)\[/size]#si','<span style="font-size:$1px;">$2</span>', $chaine);
    if ($img == 'img') {
       $chaine = str_replace(':D', '<img src="images/smilies/veryhappy.gif" style="vertical-align:middle">', $chaine);    
       $chaine = str_replace(':)', '<img src="images/smilies/happy.gif" style="vertical-align:middle">', $chaine);
       $chaine = str_replace(':(', '<img src="images/smilies/sad.gif" style="vertical-align:middle">', $chaine);
       $chaine = str_replace(':!!:', '<img src="images/smilies/nervos.gif" style="vertical-align:middle">', $chaine);
       $chaine = str_replace(':??', '<img src="images/smilies/hein.gif" style="vertical-align:middle">', $chaine);
       $chaine = str_replace(';)', '<img src="images/smilies/hey.gif" style="vertical-align:middle">', $chaine);
       $chaine = str_replace(':hi:', '<img src="images/smilies/hi.gif" style="vertical-align:middle">', $chaine);
       $chaine = str_replace(':p:', '<img src="images/smilies/lol.gif" style="vertical-align:middle">', $chaine);
       $chaine = str_replace(':o:', '<img src="images/smilies/haha.gif" style="vertical-align:middle">', $chaine);
    }

    $chaine = str_replace('><', '> <', $chaine);
    if ($img == 'img') $chaine = nl2br($chaine); 
    $chaine = wordwrap($chaine, 49, "\n", 1);
    
    return $chaine; 
}

function findimg($note) {
   switch($note) {
      case '':
         $note = '<img src="images/smilies/nosmile.gif" class="help" alt="Aucune opinion" >';
	    break;      
      case 0:
	 case 1:
         $note = '<img src="images/smilies/nervos.gif" class="help" alt="'.$note.'/10" >';
         break;
      case 2:
      case 3:
      case 4:
         $note = '<img src="images/smilies/hein.gif" class="help" alt="'.$note.'/10" >';
         break;
      case 5:
      case 6:
         $note = '<img src="images/smilies/hey.gif" class="help" alt="'.$note.'/10" >';
         break;    
      case 7:
      case 8:
         $note = '<img src="images/smilies/happy.gif" class="help" alt="'.$note.'/10">';
         break;
      case 9:
      case 10:
         $note = '<img src="images/smilies/veryhappy.gif" class="help" alt="'.$note.'/10" >';
         break;  
      default: break;
   }
   return $note;
}

function quote_smart($value)
{
   if (get_magic_quotes_gpc()) {
     $value = stripslashes($value);
   }
   if (!is_numeric($value)) {
     $value = "'" . mysql_real_escape_string($value) . "'";
   }
   return $value;
}

$base_lang = array(
					'msglist',
					'addnote',
					'headmsg',
					'pseudo',
					'site',
					'with',
					'nokey',
					'noadlang',
					'author',
					'justdelete',
					'note',
					'admin',
					'email',
					'body',
					'colors',
					'adminmsg',
					'nextpage',
					'previouspage',
					'blue',
					'red',
					'purple',
					'orange',
					'titlepage',
					'upgradesuccess',
					'closewindow',
					'see',
					'entermsg',
					'upgrade',
					'msgedit',
					'yellow',
					'gray',
					'green',
					'save',
					'size',
					'nospace',
					'vsmall',
					'small',
					'big',
					'deletethefiles',
					'edit',
					'vbig',
					'msg',
					'entiremsg',
					'addmynote',
					'nofile',
					'restart',
					'text',
					'addedthe',
					'delete',
					'bann',
					'scribe',
					'visit',
					'noadvertissment',
					'notcompleted',
					'invalidemail',
					'addonenote',
					'nomsg',
					'pannel',
					'newmsg',
					'newmsgprint',
					'config',
					'msgperpage',
					'lang',
					'theme',
					'list',
					'nobann',
					'addip',
					'add',
					'restore',
					'default',
					'yourebann',
					'deleteinstall',
					'mdp',
					'identification',
					'adminzone',
					'title',
					'configbdd',
					'host',
					'pseudo',
					'mdp',
					'confirm',
					'goupgrade',
					'titleupgrade',
					'dbname',
					'prefix',
					'configadmin',
					'next',
					'back',
					'noadminparam',
					'mdpnotequal',
					'nobd',
					'noconnect',
					'install',
					'installed');
?>