<?
session_start();
/***********************************************************************/
/*
/*		Créateur: Kra<K							 
/*		Date: 22/01/2005							 
/*		Version: 3.0						 
/*											 
/***********************************************************************/

if (!isset($_SESSION['admin']) or !isset($_SESSION['racine'])) {
		header('Location: identify.php');
		exit;
}
elseif (isset($_SESSION['racine']) && $_SESSION['racine'] != realpath('../index.php')) {
		header('Location: identify.php');
		exit;	
}

include ('../clsS.php');
include ('../functions.php');
set_magic_quotes_runtime(0);

$connect =& new connect();
$Langage = $connect->check("Langage");
$Theme = $connect->check("Theme");
$TitreSite = $connect->check("Titresite");
$Msg = $connect->check("Msg");

$CssJs = New Templates();
$CssJs->SetFile('../templates/head.tpl');
$CssJs->Read();
$CssJs->SetEntry = array('js' => '../', 'css' => '../templates', 'titresite' => $TitreSite, 'theme' => $Theme);
$CssJs->SetEntry();
$CssJs->Write();
$source = 'index.php';

require "../langages/".$connect->check("Langage");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
   if (isset($_GET['do']) && $_GET['do'] == 'edit') {
      $connect->query("SELECT Pseudo, Text  FROM `".$db['prefix']."_msg` WHERE Id=".$_GET['id']);
         list($pseudo, $text) = mysql_fetch_array($connect->query);
         $_TmEdit =& new templates();
         $_TmEdit->SetFile("../templates/".$Theme."/edit.tpl");
         $_TmEdit->Read();
         $_TmEdit->SetEntry = array('pseudo' => htmlspecialchars($pseudo, ENT_QUOTES), 'text' => htmlspecialchars($text, ENT_QUOTES), 'id' => $_GET['id']);
         $_TmEdit->SetEntry();
         $content_edit = $_TmEdit->read[0];
         $content_edit .= "<input type='hidden' name='source' value='../index.php'>";
         $_TmEdit =& new templates();
         $_TmEdit->SetFile("../templates/".$Theme."/admin_edit.tpl");
         $_TmEdit->Read();
         $_TmEdit->SetVars = array('pannel', 'msgedit', 'edit');
         $_TmEdit->SetVars();
         $_TmEdit->SetEntry = array('listmsgtoedit' => $content_edit);
         $_TmEdit->SetEntry();
         $_TmEdit->Write();
      
         $_Tmcopyright = new Templates();
	    $_Tmcopyright->SetFile('../templates/'.$Theme.'/copyright.tpl');
	    $_Tmcopyright->Read();
	    $_Tmcopyright->Write();
         exit;
      }
   $connect->query("SELECT * FROM `".$db['prefix']."_msg` WHERE Id=".$_GET['id']);
   $result = mysql_fetch_assoc($connect->query);
   $_TmPrint =& new Templates();
   $_TmPrint->SetFile("../templates/".$Theme."/body.tpl");
   $_TmPrint->Read();
   # OriginalBlue theme
	$_TmPrint->read[0] = str_replace('<img src="templates/OriginalBlue/images/back.gif">', '', $_TmPrint->read[0]);
   #
   $note = findimg($result['Note']);
   $note = str_replace('<img src="images/smilies', '<img src="../images/smilies', $note);
   $text = bbcode($result['Text']);
   $text = str_replace('src="images/smilies', 'src="../images/smilies', $text);
   $replace_email = (!empty($result['Email'])) ? '<a href="mailto:'.$result['Email'].'" class="mail" title="'.$lang['scribe'].'">'.htmlspecialchars($result['Pseudo']).'</a>' : htmlspecialchars($result['Pseudo']);
   $replace_url = (!empty($result['Url'])) ? '<a href="'.$result['Url'].'" target="_blank" title="'.$lang['visit'].'"><img class="help" src="../templates/'.$Theme.'/images/url.gif"></a>' : '';
   $_TmPrint->SetEntry = array('DATE' => $result['Date'],
									 'PSEUDO' => $replace_email,
								      'TEXT' => $text,
									 'NOTE' => $note,
									 'EMAIL' => $replace_email,
									 'URL' => $replace_url,
								      'ADMIN' => '');
   $_TmPrint->SetEntry();
   $_TmPrint->Write();
   
   $_TmClose =& new Templates();
   $_TmClose->SetFile("../templates/".$Theme."/close.tpl");
   $_TmClose->Read();   
   $_TmClose->SetVars = 'closewindow';
   $_TmClose->SetVars();
   $_TmClose->Write();
   exit;
}

if (isset($_POST['START_MSG']) && $_POST['START_MSG'] == 'Add') {
   if (isset($_POST['deletemsg'])) {
      foreach($_POST['deletemsg'] As $value) {
         $connect->query("DELETE FROM `".$db['prefix']."_msg` WHERE Id=".$value);
      }
   }
   if (isset($_POST['editmsg'])) {
      $content_edit = '';
      foreach($_POST['editmsg'] As $value) {
         $connect->query("SELECT Pseudo, Text  FROM `".$db['prefix']."_msg` WHERE Id=".$value);
         list($pseudo, $text) = mysql_fetch_array($connect->query);
         $_TmEdit =& new templates();
         $_TmEdit->SetFile("../templates/".$Theme."/edit.tpl");
         $_TmEdit->Read();
         $_TmEdit->SetEntry = array('pseudo' => htmlspecialchars($pseudo, ENT_QUOTES), 'text' => htmlspecialchars($text, ENT_QUOTES), 'id' => $value);
         $_TmEdit->SetEntry();
         $content_edit .= $_TmEdit->read[0];
      }
      $_TmEdit =& new templates();
      $_TmEdit->SetFile("../templates/".$Theme."/admin_edit.tpl");
      $_TmEdit->Read();
      $_TmEdit->SetVars = array('pannel', 'msgedit', 'edit');
      $_TmEdit->SetVars();
      $_TmEdit->SetEntry = array('listmsgtoedit' => $content_edit);
      $_TmEdit->SetEntry();
      $_TmEdit->Write();
      
      $_Tmcopyright = new Templates();
	 $_Tmcopyright->SetFile('../templates/'.$Theme.'/copyright.tpl');
	 $_Tmcopyright->Read();
	 $_Tmcopyright->Write();
      exit;
   }
}

if (isset($_POST['EDIT_MSG']) && $_POST['EDIT_MSG'] == "Add") {
   $source = (isset($_POST['source'])) ? $_POST['source'] : 'index.php';
   foreach($_POST['hidden_pseudo'] as $id => $value) {
      $pseudo = trim($_POST['pseudo'][$id]);
      $text = trim($_POST['text'][$id]);
      $pseudo = empty($pseudo) ? quote_smart($value) : quote_smart($pseudo);
      $text = empty($text) ? quote_smart($_POST['hidden_text'][$id]) : quote_smart($text);
      $connect->query("UPDATE `".$db['prefix']."_msg` SET Pseudo = ".$pseudo.", Text = ".$text." WHERE Id = ".$id);
   }
}

echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL='.$source.'">';
exit;
?>