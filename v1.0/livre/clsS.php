<?
/***********************************************************************/
/*
/*		Créateur: Kra<K							 
/*		Date: 22/01/2005							 
/*		Version: 3.2						 
/*											 
/***********************************************************************/

@include ('config.inc.php');

class connect {
	var $connect;
	var $lines;
	var $query;
	
	function connect() {
		global $db;
		$this->connect = @mysql_connect($db['host'], $db['name'], $db['pass']) 
		or die ("<center><span style='font-size:12px;font-family:Verdana;color:gray'>Impossible de se connecter.<br>Si vous n'avez pas installé PHP-BOOK,
					<a href='install.php'><font color='black'>cliquez-ici</font></a></span></center>");
				   mysql_select_db($db['db'], $this->connect);
	}
	function query($query, $post='query') {
		$this->$post = mysql_query($query) or die (mysql_error());
	}
	function close() {
		mysql_close($this->connect);
	}
	function check($What) {
	     global $db;
		$this->query("SELECT ".$What." FROM ".$db['prefix']."_vars");
		$result = mysql_fetch_array($this->query) or die(mysql_error());
		return $result[$What];
	}
	function lines($table) {
		global $db;
		$this->query("SELECT COUNT(*) As LinesInTable FROM ".$db['prefix']."_".$table."");
		$result = mysql_fetch_object($this->query);
		return $result->LinesInTable;		
	}
	function linesw($table, $where, $post='query') {
		global $db;
		$this->query("SELECT COUNT(*) As LinesInTable FROM ".$db['prefix']."_".$table." WHERE ".$where."", $post);
		$result = mysql_fetch_object($this->$post);
		return $result->LinesInTable;		
	}
}

class Templates {
	var $SetEntry = array();
	var $SetVars = array();
	var $read = array();
	var	$file = array();
	
	function SetFile($File) {
	   if (is_array($File)) {
	      foreach($File as $add_file) {
	         $this->file[] = $add_file;
	      }
	   }
	   else {
	      $this->file[] = $File;
	   }
	}
	
	function Read() {
        foreach($this->file as $read_file) {
           $open = fopen($read_file, "r");
		 $this->read[] = fread($open, filesize($read_file));
		 fclose($open);
        }
	}
	
	function Write() {
	   foreach($this->read as $echo) {
	      echo $echo;
	   }
	}
			
	function SetEntry($pos=0) {
	   global $lang;
	   $this->SetEntry = (is_array($this->SetEntry)) ? $this->SetEntry : array($this->SetEntry);
	   foreach($this->SetEntry as $replace => $with) {
	      if (is_array($with)) {
	         $pos++;
	         foreach($this->SetEntry[$replace] As $new_replace => $new_with) {
	            $new_replace = (is_numeric($new_replace)) ? $new_with : $new_replace;
	            $this->read[$replace] = str_replace("[!".$new_replace."!]", $new_with, $this->read[$replace]);
	         }
	      }
	      else {
	         $replace = (is_numeric($replace)) ? $with : $replace;
		    $this->read[$pos] = str_replace("[!".$replace."!]", $with, $this->read[$pos]);
		 }
	   }
	   $this->SetEntry = array();
	}
	
	function SetVars($pos=0) {
	   global $lang;
	   $this->SetVars = (is_array($this->SetVars)) ? $this->SetVars : array($this->SetVars);
	   foreach($this->SetVars As $replace => $with) {
	      if (is_array($with)) {
	         $pos++;
	         foreach($this->SetVars[$replace] As $new_replace => $new_with) {
	            $new_replace = (is_numeric($new_replace)) ? $new_with : $new_replace;
	            $this->read[$replace] = str_replace("[!".$new_replace."!]", $lang[$new_with], $this->read[$replace]);
	         }
	      }
	      else {
	         $replace = (is_numeric($replace)) ? $with : $replace;
		    $this->read[$pos] = str_replace("[!".$replace."!]", $lang[$with], $this->read[$pos]);
		 }
	   }
	   $this->SetVars = array();
	}
}
?>
