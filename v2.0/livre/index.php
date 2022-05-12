<html>

<head>
</head>

<body>
<p align="center">
<!-- DEBUT CODE MONCOMPTEUR.COM -->
<script type="text/javascript"><!--
member = 27787;
numCounter = 2;
border = 0;
//-->
</script>
<script type="text/javascript" src="http://www.moncompteur.com/javascripts/moncompteur.js">
</script>
<!-- FIN CODE MONCOMPTEUR.COM --></p>

</body>

</html>

<?
session_start();
/***********************************************************************/
/*
/*		Créateur: Kra<K							 
/*		Date: 22/01/2005							 
/*		Version: 3.2					 
/*											 
/***********************************************************************/

include("clsS.php");
include("functions.php");

set_magic_quotes_runtime(0);
$connect = New connect();
require "langages/".$connect->check("Langage");
$Theme = $connect->check("Theme");
$TitreSite = $connect->check("Titresite");

$CssJs = New Templates();
$CssJs->SetFile('templates/head.tpl');
$CssJs->Read();
$CssJs->SetEntry = array('js' => '', 'css' => 'templates', 'titresite' => $TitreSite, 'theme' => $Theme);
$CssJs->SetEntry();
$CssJs->Write();

if (is_file('install.php')) {
	$_TmInstall = New Templates();
	$_TmInstall->SetFile("templates/".$Theme."/nobdd.tpl");
	$_TmInstall->Read();
	$_TmInstall->SetVars = array('noinstall' => 'deleteinstall');
	$_TmInstall->SetVars();
	$_TmInstall->Write();
	exit;
}

$mode = (isset($_GET['mode'])) ? $_GET['mode'] : "";
if ($mode == "add") {
	$_TmAdd = New Templates();
	$_TmAdd->SetFile(array("templates/".$Theme."/add.tpl", "templates/".$Theme."/copyright.tpl"));	
	$_TmAdd->Read();
	$_TmAdd->SetVars = array('msglist', 'addnote', 'headmsg', 'pseudo', 'note', 'site', 'with', 'email',
								     'body', 'colors', 'blue', 'red', 'purple', 'orange', 'yellow', 'gray',
									'green', 'size', 'vsmall', 'small', 'big', 'vbig', 'msg', 'addmynote', 'restart');
	$_TmAdd->SetVars();
	$_TmAdd->SetEntry = array('PSEUDO' => '',
									  'TITRE' => '',
									  'URL' => '',
									  'EMAIL' => '',
									  'TEXTE' => '',
									  'errorinfos' => '',
									  'errormsg' => '');
	$_TmAdd->SetEntry(0);
	$_TmAdd->Write();
	exit;
}
elseif ($mode == "post" && isset($_POST['POST']) && $_POST['POST'] == "yes") {
if ($_SERVER["SERVER_NAME"] == $connect->check("Self")) {
	if ($connect->linesw('bann', 'ip="'.$_SERVER['REMOTE_ADDR'].'"') != 0) {
	     $_TmBann = new Templates();
	     $_TmBann->SetFile("templates/".$Theme."/bann.tpl");
	     $_TmBann->Read();
	     $_TmBann->SetVars = array('bann' => 'yourebann');
	     $_TmBann->SetVars();
		$_TmBann->Write();
		exit;
	}
	$Error = '';
	$Errormsg = '';
	$pseudo = trim($_POST['Pseudo']);
	$texte = trim($_POST['Texte']);
	if (!empty($pseudo) && !empty($texte)) {
		if (!empty($_POST['Email'])) {
			if (ereg('^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+'.'@'.'[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.'.'[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$', $_POST['Email']))	{
			   $Email = quote_smart($_POST['Email']);
			}
			else {
				$_TmError =& new Templates();
				$_TmError->SetFile("templates/".$Theme."/error2.tpl");
				$_TmError->Read();
				$_TmError->SetVars = 'invalidemail';
				$_TmError->SetVars();
				$Error = $_TmError->read[0];
			}
		}
		else {
			$Email = quote_smart("");
		}
		if (empty($Error)) {
			if (!empty($_POST['Url'])) {
				if (substr($_POST['Url'], 0, 7) != "http://") {
				   $Url = quote_smart("http://".$_POST['Url']);
				}
				elseif ($_POST['Url'] == 'http://' or $_POST['Url'] == 'http://www') {
				   $Url = "''";
				} 
				else {
				   $Url = quote_smart($_POST['Url']);
				}
			}
			else {
				$Url = "''";
			}
			$Pseudo = quote_smart(trim($_POST['Pseudo']));
			$Note = $_POST['Note'];
			$Message = quote_smart(trim($_POST['Texte']));
			$connect->query("INSERT INTO ".$db['prefix']."_msg(Id, Note, Pseudo, Email, Ip, Url, Date, Text) VALUES('', '".$Note."', ".$Pseudo.", ".$Email.", '".$_SERVER['REMOTE_ADDR']."', ".$Url.", '".date_fr()."', ".$Message.")");
			echo "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=index.php'>";
			exit;
		}
	}
	else {
	   $_TmError =& new Templates();
	   $_TmError->SetFile(array("templates/".$Theme."/error4.tpl", "templates/".$Theme."/error5.tpl"));
	   $_TmError->Read();
	   $_TmError->SetVars = array(array('entermsg'), array('notcompleted'));
	   $_TmError->SetVars();
	   if (empty($texte) && !empty($pseudo)) {
	      $Errormsg = $_TmError->read[0];
	   }
	   elseif  (!empty($texte) && (empty($pseudo))) {
	      $Error = $_TmError->read[1];
	   }
	   elseif (empty($texte) && empty($pseudo)) {
	      $Error = $_TmError->read[1];
	      $Errormsg = $_TmError->read[0];
	   }
	}
}
     $_TmSet = & new Templates();
     $_TmSet->SetFile(array("templates/".$Theme."/add.tpl", 'templates/'.$Theme.'/copyright.tpl'));
	$_TmSet->Read();
	$_TmSet->SetVars = array('msglist', 'addnote', 'headmsg', 'pseudo', 'note', 'site', 'with', 'email',
								     'body', 'colors', 'blue', 'red', 'purple', 'orange', 'yellow', 'gray',
									'green', 'size', 'vsmall', 'small', 'big', 'vbig', 'msg', 'addmynote', 'restart');
	$_TmSet->SetVars();
	$_TmSet->SetEntry = array('PSEUDO' => htmlspecialchars(MyStripSlashes(trim($_POST['Pseudo'])), ENT_QUOTES),
									  'URL' => htmlspecialchars(MyStripSlashes(trim($_POST['Url'])), ENT_QUOTES),
									  'EMAIL' => htmlspecialchars(MyStripSlashes(trim($_POST['Email'])), ENT_QUOTES),
									  'TEXTE' => htmlspecialchars(MyStripSlashes(trim($_POST['Texte'])), ENT_QUOTES),
									  'errorinfos' => $Error,
									  'errormsg' => $Errormsg);
	$_TmSet->SetEntry(0);
	$_TmSet->Write();
	exit;
}

$_TmNew =& new Templates();
$_TmNew->SetFile("templates/".$Theme."/newadmin.tpl");
$_TmNew->Read();
$_TmNew->SetVars = array('new' => 'addonenote', 'newadmin' => 'admin');
$_TmNew->SetVars();
$_TmNew->Write();

$msglines = $connect->lines('msg');
if ($msglines > 0) {
	$start = (isset($_GET['start'])) ? $_GET['start'] : $start = 0;
	$len = $connect->check("Msg");
	$connect->query("SELECT * FROM ".$db['prefix']."_msg ORDER BY Id DESC LIMIT ".$start.", ".$len."");
	while ($result = mysql_fetch_assoc($connect->query)) {
		global $lang;
		$replace_email = (!empty($result['Email'])) ? '<a href="mailto:'.$result['Email'].'" class="mail" title="'.$lang['scribe'].'">'.htmlspecialchars($result['Pseudo']).'</a>' : htmlspecialchars($result['Pseudo']);
		$replace_url = (!empty($result['Url'])) ? '<a href="'.$result['Url'].'" target="_blank" title="'.$lang['visit'].'"><img class="help" src="templates/'.$Theme.'/images/url.gif"></a>' : '';
		if (isset($_SESSION['admin']) && $_SESSION['admin'] == "OK_IS_TRUE" && isset($_SESSION['racine']) && $_SESSION['racine'] == realpath('index.php')) {
		   $replace_admin = "<a href='admin/delete.php?id=".$result['Id']."' title='".$lang['delete']."'><img class='help' src='templates/".$Theme."/images/delete.gif'></a>";
		   $replace_admin .= " <a href='admin/msg.php?id=".$result['Id']."&do=edit&source=index' title='".$lang['edit']."'><img class='help' src='templates/".$Theme."/images/edit.gif'></a>";		   
		   if ($connect->linesw('bann', 'ip="'.$result['Ip'].'"', 'query_second') == 0) {
		      $replace_admin .= " <a href='admin/bann.php?id=".$result['Id']."' title='".$lang['bann']."'><img class='help' src='templates/".$Theme."/images/bann.gif'></a>";
		   }
	     }
	     else {
	        $replace_admin = '&nbsp;';
          }
          $_TmPrint =& new Templates();
          $_TmPrint->SetFile("templates/".$Theme."/body.tpl");
		$_TmPrint->Read();
		$note = findimg($result['Note']);
		$text = bbcode($result['Text']);
		$_TmPrint->SetEntry = array('DATE' => $result['Date'],
										  'PSEUDO' => $replace_email,
										  'TEXT' => $text,
										  'NOTE' => $note,
										  'EMAIL' => $replace_email,
										  'URL' => $replace_url,
										  'ADMIN' => $replace_admin);
		$_TmPrint->SetEntry();
		$_TmPrint->Write();							  
	}

	if ($start > 0) {
	     $newstart = ($start - $len < 0) ? 0 : $start - $len;
	     $page = round($msglines / $len);
		$precedent = "<input type='button' value='".$lang['previouspage']."' OnClick=\"document.location = 'index.php?start=".($newstart)."';\">";
	}
	else $precedent = "&nbsp;";
	
	if (($start + $len) < $msglines) {
		$suivant = "<input type='button' value='".$lang['nextpage']."' OnClick=\"document.location = 'index.php?start=".($start + $len)."';\">";
	}
	else {
	   $suivant = "&nbsp;";
	}

	if ($msglines > $len) {
	   $pages = ceil($msglines / $len);
	   $current = ($start / $len) + 1;
	   $options = "<select id='pages' OnChange=\"document.location = 'index.php?start=' + document.getElementById('pages').value;\">";
	   for ($i = 0; $i < $pages; $i++) {
	      $selected = ($i + 1 == $current) ? 'selected="selected"' : '';
	      $options .= '<option value="'.($i * $len).'" '.$selected.'>Page '.($i + 1).'</option>';
	   }
	   $options .= "</select>";
	}
	else $options = '&nbsp;';

		$_TmPages =& new Templates;
		$_TmPages->SetFile("templates/".$Theme."/pages.tpl");
		$_TmPages->Read();
		$_TmPages->SetEntry = array('PRECEDENT' => $precedent, 'SUIVANT' => $suivant, 'PAGES' => $options);
		$_TmPages ->SetEntry();
		$_TmPages ->Write();
		
}
else {
     $_TmNoMsg = new Templates();
     $_TmNoMsg->SetFile("templates/".$Theme."/nomsg.tpl");
     $_TmNoMsg->Read();
	$_TmNoMsg->SetVars = 'nomsg';
	$_TmNoMsg->SetVars();
	$_TmNoMsg->Write();
}

$_Tmcopyright = new Templates();
$_Tmcopyright->SetFile('templates/'.$Theme.'/copyright.tpl');
$_Tmcopyright->Read();
$_Tmcopyright->Write();

$connect->close();
?>

