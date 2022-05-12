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
set_magic_quotes_runtime(0);

$connect =& new connect();

if (isset($_POST['START_BANN']) && $_POST['START_BANN'] == "yes") {
	if ($_SERVER["SERVER_NAME"] == $connect->Check("Self")) {
		$connect->query("DELETE FROM ".$db['prefix']."_bann WHERE ip='".$_POST['bannlist']."'");
		header('Location: index.php');
	}
}

if (isset($_POST['START_BANN']) && $_POST['START_BANN'] == "Add") {
	if ($_SERVER["SERVER_NAME"] == $connect->Check("Self")) {
		if (is_numeric($_POST['ip1']) && $_POST['ip1'] >= 0 && $_POST['ip1'] <= 255 &&
		   is_numeric($_POST['ip2']) && $_POST['ip2'] >= 0 && $_POST['ip2'] <= 255 &&
		   is_numeric($_POST['ip3']) && $_POST['ip3'] >= 0 && $_POST['ip3'] <= 255 &&
		   is_numeric($_POST['ip4']) && $_POST['ip4'] >= 0 && $_POST['ip4'] <= 255 &&
		   $connect->linesw("bann", "ip='".$_POST['ip1'].".".$_POST['ip2'].".".$_POST['ip3'].".".$_POST['ip4']."'") == 0) {
		   $value = $_POST['ip1'].'.'.$_POST['ip2'].'.'.$_POST['ip3'].'.'.$_POST['ip4'];
		   $connect->Query("INSERT INTO ".$db['prefix']."_bann VALUES('".$value."')");
		   header('Location: index.php');
		}
	}
}

if (isset($_GET['id']) && $_SESSION['admin'] == "OK_IS_TRUE" && is_numeric($_GET['id'])) {
	$connect->query("SELECT ip FROM ".$db['prefix']."_msg WHERE id='".$_GET['id']."'");
	list($id) = mysql_fetch_array($connect->query);
	$connect->query("INSERT INTO ".$db['prefix']."_bann VALUES('".$id."')");
	header('Location: ../index.php');
}

$connect->close();
?>