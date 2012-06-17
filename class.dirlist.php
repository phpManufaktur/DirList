<?php

/**
 * DirList
 *
 * @author Ralf Hertsch <ralf.hertsch@phpmanufaktur.de>
 * @link http://phpmanufaktur.de
 * @copyright 2007 - 2012
 * @license MIT License (MIT) http://www.opensource.org/licenses/MIT
 */

// include class.secure.php to protect this file and the whole CMS!
if (defined('WB_PATH')) {
  if (defined('LEPTON_VERSION'))
    include(WB_PATH.'/framework/class.secure.php');
}
else {
  $oneback = "../";
  $root = $oneback;
  $level = 1;
  while (($level < 10) && (!file_exists($root.'/framework/class.secure.php'))) {
    $root .= $oneback;
    $level += 1;
  }
  if (file_exists($root.'/framework/class.secure.php')) {
    include($root.'/framework/class.secure.php');
  }
  else {
    trigger_error(sprintf("[ <b>%s</b> ] Can't include class.secure.php!", $_SERVER['SCRIPT_NAME']), E_USER_ERROR);
  }
}
// end include class.secure.php

class sql_dirlist {
  var $data;
  var $record;
  var $error;
  var $errorPlace;
  var $dirListArray = array('section_id','page_id','directory','sort','header','prefix','suffix','exclude','extensions','blank','last_modified');

  /**
   * Constructor
   *
   * @return sql_dirlist
   */
  function sql_dirlist() {
    global $mod_dirlist;
    $this->data = array();
    $this->error = $mod_dirlist['error']['no_error'];
    $this->errorPlace = $mod_dirlist['error']['not_specified'];
  }

  /**
   * Erzeugt die Tabelle fuer die Konfiguration von DirList
   *
   * @return BOOL
   */
  function sql_createTable() {
    global $database;
    $thisQuery = 'CREATE TABLE `' .TABLE_PREFIX .'mod_dirlist` ( '
	    . "`section_id` INT(11) NOT NULL DEFAULT '0',"
	    . "`page_id` INT(11) NOT NULl DEFAULT '0',"
	    . "`directory` VARCHAR(255) NOT NULL DEFAULT '',"
	    . "`sort` INT(11) NOT NULL DEFAULT '1',"
	    . "`header` VARCHAR(255) NOT NULL DEFAULT '',"
	    . "`prefix` TEXT NOT NULL DEFAULT '',"
	    . "`suffix` TEXT NOT NULL DEFAULT '',"
	    . "`exclude` INT(11) NOT NULL DEFAULT '1',"
	    . "`extensions` VARCHAR(255) NOT NULL DEFAULT '',"
	    . "`blank` INT(11) NOT NULL DEFAULT '0',"
	    . "`last_modified` INT(11) NOT NULL DEFAULT '0',"
	    . 'PRIMARY KEY (section_id)'
	    . ' )';
	  $oldErrorReporting = error_reporting(0);
    $database->query($thisQuery);
    error_reporting($oldErrorReporting);
    if ($database->is_error()) {
      $this->errorPlace = 'sql_createTable()';
      $this->error = $database->get_error();
      return false;  }
    else {
      return true;  }
  }

  /**
   * Loescht die Konfigurationstabelle von DirList
   *
   * @return BOOL
   */
  function sql_deleteTable() {
    global $database;
    $thisQuery = "DROP TABLE ".TABLE_PREFIX."mod_dirlist";
    $oldErrorReporting = error_reporting(0);
    $database->query($thisQuery);
    error_reporting($oldErrorReporting);
    if ($database->is_error()) {
      $this->errorPlace = 'sql_deleteTable()';
      $this->error = $database->get_error();
      return false;  }
    else {
      return true;  }
  }

  /**
   * Fuegt einen (leeren) Eintrag fuer eine neue Seite oder einen neuen Abschnitt ein
   *
   * @param INT $sectionID
   * @param INT $pageID
   * @return BOOL
   */
  function sql_addEntry($sectionID,$pageID) {
    global $database;
    $thisQuery = "INSERT INTO ".TABLE_PREFIX."mod_dirlist SET "
      ."section_id='$sectionID',"
      ."page_id='$pageID'";
    $oldErrorReporting = error_reporting(0);
    $database->query($thisQuery);
    error_reporting($oldErrorReporting);
    if ($database->is_error()) {
      $this->errorPlace = 'sql_addEntry()';
      $this->error = $database->get_error();
      return false; }
    else {
      return true; }
  }

  /**
   * Loescht einen Eintrag an Hand der uebergebenen section_id
   *
   * @param INT $sectionID
   * @return BOOL
   */
  function sql_deleteEntry($sectionID) {
    global $database;
    $thisQuery = "DELETE FROM ".TABLE_PREFIX."mod_dirlist WHERE section_id='$sectionID'";
    $oldErrorReporting = error_reporting(0);
    $database->query($thisQuery);
    error_reporting($oldErrorReporting);
    if ($database->is_error()) {
      // SQL Fehler
      $this->errorPlace = 'sql_deleteEntry()';
      $this->error = $database->get_error();
      return false;  }
    else {
      return true; }
  }

  /**
   * Liest einen Eintrag an Hand der section_id und page_id aus
   *
   * @param INT $sectionID
   * @param INT $pageID
   * @return BOOL
   */
  function sql_getEntry($sectionID,$pageID) {
    global $database;
    global $sql_result;
    $thisQuery = "SELECT * FROM ".TABLE_PREFIX."mod_dirlist WHERE section_id='$sectionID' AND page_id='$pageID'";
    $oldErrorReporting = error_reporting(0);
    $sql_result = $database->query($thisQuery);
    error_reporting($oldErrorReporting);
    if ($database->is_error()) {
      // SQL Fehler
      $this->errorPlace = 'sql_getEntry()';
      $this->error = $database->get_error();
      return false; }
    elseif ($sql_result->numRows() > 0) {
      // alles OK, Daten uebernehmen
      $this->record = $sql_result->fetchRow();
      return true; }
    else {
      // keine Daten
      $this->errorPlace = 'sql_getEntry()';
      $this->error = dl_error_row_empty;
      return false;  }
  }

  /**
   * Aktualisiert einen Eintrag an Hand $this->record
   *
   * @return BOOL
   */
  function sql_updateEntryByRecord() {
    global $database;
    global $sql_result;
    $thisQuery = "UPDATE ".TABLE_PREFIX."mod_dirlist SET "
      ."directory='".$this->record['directory']."',"
      ."sort='".$this->record['sort']."',"
      ."header='".$this->record['header']."',"
      ."prefix='".$this->record['prefix']."',"
      ."suffix='".$this->record['suffix']."',"
      ."exclude='".$this->record['exclude']."',"
      ."extensions='".$this->record['extensions']."',"
      ."blank='".$this->record['blank']."',"
      ."last_modified='".time()."'"
      ." WHERE section_id='".$this->record['section_id']."' AND page_id='".$this->record['page_id']."'";
    $oldErrorReporting = error_reporting(0);
    $sql_result = $database->query($thisQuery);
    error_reporting($oldErrorReporting);
    if ($database->is_error()) {
      // SQL Fehler
      $this->errorPlace = 'sql_updateEntryByRecord()';
      $this->error = $database->get_error();
      return false;  }
    else {
      return true;  }
  }

} // class sql_dirlist


define('sortFilesAscending', 1);
define('sortFilesDescending', 2);
define('sortSizeAscending', 4);
define('sortSizeDescending', 8);
define('sortDateAscending', 16);
define('sortDateDescending', 32);

/**
 * Sortiert ein Array mit Dateinamen AUFSTEIGEND
 *
 * @param STRING $a
 * @param STRING $b
 * @return INT
 */
function cmpFA($a,$b) {
	return strcasecmp($a['file'],$b['file']); 	}

function cmpFD($a,$b) {
	$result = strcasecmp($a['file'],$b['file']);
	return ($result * -1);	}

function cmpSA($a,$b) {
	return ($a['size'] > $b['size']); 	}

function cmpSD($a,$b) {
	return ($a['size'] < $b['size']); 	}

function cmpDA($a,$b) {
	return ($a['date'] > $b['date']); 	}

function cmpDD($a,$b) {
	return ($a['date'] < $b['date']); 	}



class dirlist extends sql_dirlist {

  var $is_Frontend;
  var $pageLink;
  var $page_id;
  var $section_id;

  /**
   * Constructor
   *
   * @param INT $sectionID
   * @param INT $pageID
   * @param ARRAY $language
   * @param BOOL $isFrontend
   * @return dirlist
   */
  function dirlist($pageID, $sectionID, $isFrontend=true) {
    $this->sql_dirlist();
    $this->record = array();
    $this->is_Frontend = $isFrontend;
    $this->pageLink = '';
    $this->page_id = $pageID;
    $this->section_id = $sectionID;
    if (!$this->sql_getPageLinkByID($this->page_id,$this->pageLink)) {
    	$this->print_error(); }
    else {
      $settings = $this->sql_getWBSettings();
    	$this->pageLink = WB_URL.$settings['pages_directory'].$this->pageLink.$settings['page_extension'];  }
  }

  function sql_getWBSettings() {
    global $database;
    global $sql_result;
    $thisQuery = "SELECT * FROM ".TABLE_PREFIX."settings";
    $oldErrorReporting = error_reporting(0);
    $sql_result = $database->query($thisQuery);
    error_reporting($oldErrorReporting);
    if ($database->is_error()) {
      // SQL Fehler
      $this->errorPlace = 'sql_getWBSettings()';
      $this->error = $database->get_error();
      return false; }
    else {
      $thisArr = array();
      for ($i=0; $i < $sql_result->numRows(); $i++) {
        $dummy = $sql_result->fetchRow();
        $thisArr[$dummy['name']] = $dummy['value']; }
      return $thisArr;
    }
  }

  /**
   * Ermittelt den realname Link einer Seite an Hand der $page_id
   *
   * @param INT $pageID
   * @param REFERENCE &$link
   * @return BOOL
   */
  function sql_getPageLinkByID($pageID, &$link) {
    $settings = $this->sql_getWBSettings();
    global $database;
    global $sql_result;
    $thisQuery = "SELECT * FROM ".TABLE_PREFIX."pages WHERE page_id='$pageID'";
    $oldErrorReporting = error_reporting(0);
    $sql_result = $database->query($thisQuery);
    error_reporting($oldErrorReporting);
    if ($database->is_error()) {
      // SQL Fehler
      $this->errorPlace = 'sql_getPageLinkByID()';
      $this->error = $database->get_error();
      return false; }
    elseif ($sql_result->numRows() > 0) {
      // alles OK, Daten uebernehmen
      $thisArr = $sql_result->fetchRow();
      //if (is_file(WB_PATH.'/pages'.$thisArr['link'].'.php')) {
      if (is_file(WB_PATH.$settings['pages_directory'].$thisArr['link'].$settings['page_extension'])) {
        $link = $thisArr['link'];
        return true; }
      else {
        $this->errorPlace = 'sql_getPageLinkByID()';
        $this->error = dl_error_link_by_page_id;
        $link = 'ERROR';
        return false; }
    }
    else {
      // keine Daten
      $this->errorPlace = 'sql_getPageLinkByID()';
      $this->error = dl_error_row_empty;
      return false;  }
  }

  /**
   * Gibt eine Fehlermeldung aus
   *
   */
  function print_error() {
    echo '<div class="dirlist_error">';
    echo '<h1>'.dl_error_header.'</h1>';
    echo '<div>['.$this->errorPlace.'] '.$this->error.'</div>';
    echo '</div>';
  }

  /**
   * Uebernimmt Daten aus $_REQUEST nach $this->record
   *
   */
  function requestToRecord() {
    global $admin;
    global $wb;
    if ($this->is_Frontend) {
      $worker = $wb; }
    else {
      $worker = $admin;  }
    $this->record = array();
    for ($i=0;$i < count($this->dirListArray);$i++) {
      switch ($this->dirListArray[$i]):
      case 'last_modified':
        $this->record[$this->dirListArray[$i]] = time();
        break;
      case 'blank':
        if (isset($_REQUEST['blank'])) {
          $this->record[$this->dirListArray[$i]] = 1;  }
        else {
          $this->record[$this->dirListArray[$i]] = 0;  }
        break;
      default:
        $this->record[$this->dirListArray[$i]] = $worker->add_slashes(strip_tags($_REQUEST[$this->dirListArray[$i]]));
      endswitch;
    }
  }

  /**
   * Aktualisiert die Einstellungen von DirList an Hand der $_REQUEST Daten
   *
   * @return BOOL
   */
  function updateEntryByRequest() {
    $this->requestToRecord();
    if (empty($this->record['directory'])) {
      // directory darf nicht leer sein
      $this->error = dl_error_empty_directory;
      return false;  }
    return $this->sql_updateEntryByRecord();
  }


/**
 * Durchsucht das angegebebene Verzeichnis und gibt ein Array zurueck
 *
 * $path: Pfad der durchsucht werden soll
 * $maxdepth: Angabe, wie tief durchsucht werden soll (-1 = unbegrenzt)
 * $mode: "FULL"|"DIRS"|"FILES"
 * $d: Angabe nicht eforderlich
 *
 * @param STRING $path
 * @param INT $maxdepth
 * @param STRING $mode
 * @param INT $d
 * @return ARRAY()
 */
  function searchdir ($path, $maxdepth=-1, $mode="FULL", $d=0) {
    if (substr($path, strlen($path)-1) != '/') { $path .= '/' ; }
    $dirlist = array ();
    if ($mode != "FILES") { $dirlist[] = $path ; }
    if (($handle = opendir($path))) {
      while (false !== ($file = readdir($handle))) {
        if ($file != '.' && $file != '..' ) {
          $file = $path . $file ;
          if (!is_dir($file)) {
            if ($mode != "DIRS") {
              $dirlist[] = $file ; } }
          elseif ($d >=0 && ($d < $maxdepth || $maxdepth < 0)) {
            $result = $this->searchdir($file . '/', $maxdepth, $mode, $d+1);
            $dirlist = array_merge($dirlist, $result);  }
        }
      } // while
      closedir($handle);
    }
    if ( $d == 0 ) {
      natcasesort($dirlist); }
      return ($dirlist) ;
  }

  /**
   * Alle Verzeichnisse im /MEDIA Pfad auslesen und als ARRAY() zurueckgeben
   *
   * @return ARRAY()
   */
  /*
  function getMediaDirectories() {
    $dl = $this->searchdir(WB_PATH.MEDIA_DIRECTORY, -1, "DIRS");
    for ($i=0; $i < count($dl); $i++) {
      $dl[$i] = str_replace(WB_PATH.MEDIA_DIRECTORY.'/','',$dl[$i]);
      if ($dl[$i]{strlen($dl[$i])-1} == '/') {
        $dl[$i] = substr($dl[$i],0,strlen($dl[$i])-1); }
    }
    return $dl;
  }
  */
  function getMediaDirectories() {
	  $path=WB_PATH.MEDIA_DIRECTORY;
	  $dl = $this->searchdir($path, -1, "DIRS");
	  // perhaps windows...
	  $dl = str_replace("\\", "/", $dl);
    for ($i=0; $i < count($dl); $i++) {
      $dl[$i] = str_replace($path.'/','',$dl[$i]);
      if ($dl[$i]{strlen($dl[$i])-1} == '/') {
        $dl[$i] = substr($dl[$i],0,strlen($dl[$i])-1); }
    }
    // Nochmals slashes bereinigen
	  $path=str_replace('\\','/',$path);
    // Absoluten Pfadanteil l�schen
	  for($i=0;$i<count($dl);$i++){
	    $dl[$i]=str_replace($path,'',$dl[$i]); }
    return $dl;
  }

  /**
   * Dateien in dem angegebenen Verzeichnis auslesen und als ARRAY() zurueckgeben.
   * Die Datei index.php wird ignoriert.
   *
   * @param STRING $path
   * @return ARRAY()
   */
  function getMediaFiles($path) {
  	$result = array();
  	$extra = false;
  	$strExtensions = strtolower(trim($this->record['extensions']));
  	if (!empty($strExtensions)) {
  	  // Dateiendungen auslesen
  	  $worker = explode(',',$strExtensions);
  	  $extensions = array();
  	  foreach ($worker as $ext) {
  	  	$extensions[] = trim($ext); }
  	  if (!empty($extensions)) $extra = true;	}
  	$fl = $this->searchdir($path, 0, "FILES");
    for ($i = 0; $i < count($fl); $i++) {
      $fname = basename($fl[$i]);
      // exclude index.php und .hidden files
      if (($fname != 'index.php') && ($fname[0] != '.')) {
        // check extra include or exclude
        if ($extra) {
          $ext = strtolower($fname);
          $ext = explode('.',$ext);
          $ext = $ext[count($ext)-1];
          if ($this->record['exclude'] == 1) {
            // Exclude Files by Extension
            if (!in_array($ext,$extensions)) $result[] = $fname;  }
          else {
            // Include Files by Extension
            if (in_array($ext,$extensions)){ $result[] = $fname; } }}
        else {
          $result[] = $fname; } }
    }
    return $result;
  }

  /**
   * Zeigt den Dialog zur Konfiguration von DirList an
   *
   */
  function dlgModify() {
    global $database;

    if ((!$this->sql_getEntry($this->section_id,$this->page_id)) && ($database->is_error())) {
      // SQL Fehler
      $this->print_error(); }
    else {
      // sicherstellen, dass nur bei einem Reload die $_REQUEST Daten verwendet werden
      if ((isset($_REQUEST['action'])) && ($_REQUEST['action'] == 'request')) {	$this->requestToRecord(); }
      $parser = new templateParser();
      $parser->add('h1',dl_backend_header);
      $parser->add('description',dl_backend_description);
      $parser->add('text_header',dl_backend_text_header);
      $parser->add('value_header',$this->record['header']);
      $parser->add('text_prefix',dl_backend_text_prefix);
      $parser->add('value_prefix',$this->record['prefix']);
      $parser->add('text_select',dl_backend_text_select);
      $parser->add('text_suffix',dl_backend_text_suffix);
      $parser->add('value_suffix',$this->record['suffix']);

      $parser->add('form_action', WB_URL.'/modules/dirlist/save.php');
      $parser->add('btn_submit',dl_backend_btn_submit);
      $parser->add('btn_abort',dl_backend_btn_abort);
      $parser->add('abort_location',ADMIN_URL. '/pages/index.php');
      $parser->add('page_id',$this->page_id);
      $parser->add('section_id',$this->section_id);
			// Medienverzeichnis auslesen
      $media_dirs = $this->getMediaDirectories();
      if (!empty($this->record['directory']) && (in_array($this->record['directory'],$media_dirs))) {
        $dummy = ''; }
      else {
        $dummy = ' selected="selected"'; }
      $worker = sprintf('<select name="directory"><option value=""%s>%s</option>',$dummy,dl_backend_select_directory);
      while (list($key,$val) = each($media_dirs)) {
      	$dummy = $key;
        if (!empty($val)) {
          ($val == $this->record['directory']) ? $dummy = ' selected="selected"' : $dummy = '';
          $worker .= sprintf('<option value="%s"%s>%s</option>',$val,$dummy,$val); }}
      $worker .= '</select>';
      $parser->add('directory',$worker);

      // Sortierreihenfolge
      $parser->add('text_sort',dl_backend_text_sort);
      $sortArray[1] 	= dl_backend_sortFilesAscending;
      $sortArray[2] 	= dl_backend_sortFilesDescending;
      $sortArray[4] 	= dl_backend_sortSizeAscending;
	    $sortArray[8] 	= dl_backend_sortSizeDescending;
      $sortArray[16] 	= dl_backend_sortDateAscending;
      $sortArray[32] 	= dl_backend_sortDateDescending;

      $worker = '<select name="sort">';
      for ($i=1; $i < 33; $i = $i*2) {
      	($i == $this->record['sort']) ? $dummy = ' selected="selected"' : $dummy = '';
      	$worker .= sprintf('<option value="%d"%s>%s</option>',$i,$dummy,$sortArray[$i]); }
      $worker .= '</select>';
      $parser->add('sort',$worker);

      $parser->add('text_preselect',dl_backend_text_preselect);
      if ($this->record['exclude'] == 0) {
        $dummy  = ' selected="selected"';
        $dummy2 = '';  }
      else {
        $dummy  = '';
        $dummy2 = ' selected="selected"';  }
      $worker  = sprintf('<option value="0"%s>%s</option>',$dummy,dl_backend_include);
      $worker .= sprintf('<option value="1"%s>%s</option>',$dummy2,dl_backend_exclude);
      $parser->add('exclude_option',$worker);
      $parser->add('value_extensions',$this->record['extensions']);

      ($this->record['blank'] == 1) ? $checked = ' checked="checked"' : $checked = '';
      $parser->add('blank_checked',$checked);
      $parser->add('text_blank', dl_backend_blank);

      $parser->add('value_header',$this->record['header']);
      $parser->add('value_prefix',$this->record['prefix']);
      $parser->add('value_suffix',$this->record['suffix']);

      $parser->parseTemplateFile(WB_PATH.'/modules/dirlist/htt/backend.htt');
      $parser->echoHTML();
    } // else

  } // dlgModify()

  /**
   * Gibt die Dateigroesse als lesbar formatierten String zurueck
   *
   * @param INTEGER $size
   * @param STRING $retstring
   * @return STRING
   */
  function size_readable ($size, $retstring = null) {
     // adapted from code at http://aidanlister.com/repos/v/function.size_readable.php
     $sizes = array('B ', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
     if ($retstring === null) { $retstring = '%01.2f %s'; }
     $lastsizestring = end($sizes);
     foreach ($sizes as $sizestring) {
       if ($size < 1024) { break; }
       if ($sizestring != $lastsizestring) { $size /= 1024; }
     }
     if ($sizestring == $sizes[0]) { $retstring = '%01d %s'; } // Bytes aren't normally fractional
     return sprintf($retstring, $size, $sizestring);
   }

  /**
   * Sortiert das DirList Array nach Dateinamen, aufsteigend
   *
   * @param ARRAY $thisFiles
   * @return ARRAY
   */

  function sortFilesAscending($thisFiles) {
  	usort($thisFiles, "cmpFA");
  	return $thisFiles;
  }

  /**
   * Sortiert das DirList Array nach Dateinamen, absteigend
   *
   * @param ARRAY $thisFiles
   * @return ARRAY
   */
  function sortFilesDescending($thisFiles) {
  	usort($thisFiles, "cmpFD");
  	return $thisFiles;
  }

  /**
   * Sortiert das DirList Array nach Dateigroesse, aufsteigend
   *
   * @param ARRAY $thisFiles
   * @return ARRAY
   */
  function sortSizeAscending($thisFiles) {
  	usort($thisFiles, "cmpSA");
  	return $thisFiles;
  }

  /**
   * Sortiert das DirList Array nach Dateigroesse, absteigend
   *
   * @param ARRAY $thisFiles
   * @return ARRAY
   */
  function sortSizeDescending($thisFiles) {
  	usort($thisFiles, "cmpSD");
  	return $thisFiles;
  }

  /**
   * Sortiert das DirList Array nach Datum, aufsteigend
   *
   * @param ARRAY $thisFiles
   * @return ARRAY
   */
  function sortDateAscending($thisFiles) {
  	usort($thisFiles, "cmpDA");
  	return $thisFiles;
  }

  /**
   * Sortiert das DirList Array nach Datum, absteigend
   *
   * @param ARRAY $thisFiles
   * @return ARRAY
   */
  function sortDateDescending($thisFiles) {
  	usort($thisFiles, "cmpDD");
  	return $thisFiles;
  }

  /**
   * FRONTEND: Anzeige des Verzeichnisses
   *
   */
  function dlgView() {
    global $database;
    if ((!$this->sql_getEntry($this->section_id,$this->page_id)) && ($database->is_error())) {
      // SQL Fehler
      $this->print_error();
      return false; }
    else {
    	// Dateien auslesen
    	$mediaPath = WB_PATH.MEDIA_DIRECTORY.'/'.$this->record['directory'];
      $mediaURL = WB_URL.MEDIA_DIRECTORY.'/'.$this->record['directory'];
      $aFiles = $this->getMediaFiles($mediaPath);
			$dlArray = array();
      // DirList Array bilden
      for ($i=0; $i < count($aFiles); $i++) {
      	$dlArray[$i]['file'] = $aFiles[$i];
      	$dlArray[$i]['size'] = filesize($mediaPath.'/'.$aFiles[$i]);
      	$dlArray[$i]['date'] = filemtime($mediaPath.'/'.$aFiles[$i]);
      }
      // Default Werte
      $sortFiles = sortFilesAscending;
      $sortSize = sortSizeAscending;
      $sortDate = sortDateAscending;

      // Parameter pruefen, FlipFlop und Sortieren...

      if (isset($_REQUEST['sort'.$this->section_id])) {
      	$sort = $_REQUEST['sort'.$this->section_id];  }
      else {
      	 $sort = $this->record['sort']; }

      switch ($sort):
      case sortFilesAscending:
        $sortFiles = sortFilesDescending;
        $dlArray = $this->sortFilesAscending($dlArray);
        break;
      case sortFilesDescending:
        $sortFiles = sortFilesAscending;
        $dlArray = $this->sortFilesDescending($dlArray);
        break;
      case sortSizeAscending:
        $sortSize = sortSizeDescending;
        $dlArray = $this->sortSizeAscending($dlArray);
        break;
      case sortSizeDescending:
        $sortSize = sortSizeAscending;
        $dlArray = $this->sortSizeDescending($dlArray);
        break;
      case sortDateAscending:
        $sortDate = sortDateDescending;
        $dlArray = $this->sortDateAscending($dlArray);
        break;
      case sortDateDescending:
        $sortDate = sortDateAscending;
        $dlArray = $this->sortDateDescending($dlArray);
        break;
      default:
      	// Vorgabe aus SETTINGS verwenden
      	$dlArray = $this->sortFilesAscending($dlArray);
      endswitch;

      $parser = new templateParser();
      $parser->add('header',$this->record['header']);
      $parser->add('prefix',$this->record['prefix']);

      // Schalter in die Titelzeilen einfuegen
      $parser->add('section',$this->section_id);
      $parser->add('form_action',$this->pageLink);
      $parser->add('file_sort',$sortFiles);
      $parser->add('file_btn_text',dl_frontend_th_file);

      $parser->add('size_sort', $sortSize);
      $parser->add('size_btn_text',dl_frontend_th_size);

      $parser->add('date_sort', $sortDate);
      $parser->add('date_btn_text',dl_frontend_th_date);

      $parse_item = new templateParser();
      $items = '';
      if (count($dlArray) < 1) {
        // das Verzeichnis ist leer
        $parse_item->clear(true);
        $parse_item->add('file',dl_frontend_empty_directory);
        $parse_item->parseTemplateFile(WB_PATH.'/modules/dirlist/htt/frontend.item.htt');
        $items .= $parse_item->getHTML(true);
      }
      else {
        ($this->record['blank'] == 1) ? $blank = ' target="_blank"' : $blank='';
        $mimeType = new mimeTypes();
      	for ($i=0; $i < count($dlArray); $i++) {
      		$parse_item->clear(true);
      		$parse_item->add('icon',sprintf('<img src="%s" alt="%s" border="0" width="16" height="16" />',
      		                                WB_URL.'/modules/dirlist/img/16x16/'.$mimeType->getIconByType($dlArray[$i]['file']),
      		                                $mimeType->getMimeType($dlArray[$i]['file'])));
      		$parse_item->add('file',sprintf('<a href="%s"%s>%s</a>',
      		                                $mediaURL.'/'.$dlArray[$i]['file'],
      		                                $blank,
      		                                $dlArray[$i]['file']));
      		$parse_item->add('size',$this->size_readable($dlArray[$i]['size']));
      		$parse_item->add('date',date(dl_frontend_th_datetime,$dlArray[$i]['date']));
          $parse_item->parseTemplateFile(WB_PATH.'/modules/dirlist/htt/frontend.item.htt');
          $items .= $parse_item->getHTML(true);
      	}
      }
      $parser->add('directory',$items);
      $parser->add('suffix',$this->record['suffix']);
      $parser->parseTemplateFile(WB_PATH.'/modules/dirlist/htt/frontend.htt');
      $parser->echoHTML();
    }
    return true;
  }

} // class dirlist

?>