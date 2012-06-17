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

// manually include the config.php file (defines the required constants)
require('../../config.php');

// Modul Informationen
require_once('info.php');

if(!file_exists(WB_PATH .'/modules/dirlist/languages/' .LANGUAGE .'.php')) {
	require_once(WB_PATH .'/modules/dirlist/languages/DE.php');
} else {
		require_once(WB_PATH .'/modules/dirlist/languages/' .LANGUAGE .'.php');
}


/**
 * Upgrade from 0.10 to 0.11
 *
 * --> add row "sort" for options sorting DirList
 *
 */

$prompt = '';
$upgradeError = false;

$thisQuery = "DESCRIBE ".TABLE_PREFIX."mod_dirlist";
$oldErrorReporting = error_reporting(0);
$sql_result = $database->query($thisQuery);
error_reporting($oldErrorReporting);
if ($database->is_error()) {
	// Fehlermeldung anzeigen
	$upgradeError = true;
	$prompt .= sprintf(dl_error_describe_table,$database->get_error()); }
else {
	$fields = array();
	$searchField = 'sort';
	while (($data = $sql_result->fetchRow())) {
		$fields[] = $data["Field"];	}
	if (in_array($searchField, $fields)) {
		// Spalte bereits vorhanden
		$prompt .= sprintf(dl_upgrade_field_exists,'sort');	}
	else {
		// Tabelle muss ergaenzt werden
		$thisQuery = "ALTER TABLE ".TABLE_PREFIX."mod_dirlist ADD sort INT(11) DEFAULT 1";
		$oldErrorReporting = error_reporting(0);
		$sql_result = $database->query($thisQuery);
		error_reporting($oldErrorReporting);
		if ($database->is_error()) {
			// Fehler beim Einfuegen des Feldes
			$upgradeError = true;
			$prompt .= sprintf(dl_error_insert_field,'sort',$database->get_error()); }
	  else {
	  	// Feld erfolgreich eingefuegt
	  	$prompt .= sprintf(dl_upgrade_insert_field,'sort'); }
	}
}

/**
 * Upgrade from 0.14 to 0.15
 *
 * --> Option for include or exclude Files by Extension
 *
 */
$thisQuery = "DESCRIBE ".TABLE_PREFIX."mod_dirlist";
$oldErrorReporting = error_reporting(0);
$sql_result = $database->query($thisQuery);
error_reporting($oldErrorReporting);
if ($database->is_error()) {
  $upgradeError = true;
	$prompt .= sprintf(dl_error_describe_table, $database->get_error()); }
else {
	$fields = array();
	while (($data = $sql_result->fetchRow())) {
	  $fields[] = $data["Field"]; }
	if ((in_array('exclude', $fields)) && (in_array('extensions', $fields))) {
	  // Die Spalten sind bereits vorhanden
	  $prompt .= sprintf(dl_upgrade_field_exists,'exclude');
	  $prompt .= sprintf(dl_upgrade_field_exists,'extensions');	}
	else {
	  // Tabelle muss ergaenzt werden
		$oldErrorReporting = error_reporting(0);
		$thisQuery = "ALTER TABLE ".TABLE_PREFIX."mod_dirlist ADD exclude INT(11) DEFAULT 1";
		$database->query($thisQuery);
		if ($database->is_error()) {
		  $upgradeError = true;
		  $prompt .= sprintf(dl_error_insert_field,'exlude',$database->get_error()); }
    else {
			$prompt .= sprintf(dl_upgrade_insert_field,'exclude');
	    $thisQuery = "ALTER TABLE ".TABLE_PREFIX."mod_dirlist ADD extensions VARCHAR(255) DEFAULT ''";
		  $database->query($thisQuery);
		  if ($database->is_error()) {
		    $upgradeError = true;
		    $prompt .= sprintf(dl_error_insert_field,'extensions',$database->get_error()); }
		  else {
	  	  // Feld erfolgreich eingefuegt
	  	  $prompt .= sprintf(dl_upgrade_insert_field,'extensions'); }
    }
	  error_reporting($oldErrorReporting);
	}
}

/**
 * Upgrade from 0.15 to 0.16
 *
 * --> Option for show files in a new window
 *
 */
$thisQuery = "DESCRIBE ".TABLE_PREFIX."mod_dirlist";
$oldErrorReporting = error_reporting(0);
$sql_result = $database->query($thisQuery);
error_reporting($oldErrorReporting);
if ($database->is_error()) {
  $upgradeError = true;
	$prompt .= sprintf(dl_error_describe_table, $database->get_error()); }
else {
	$fields = array();
	while (($data = $sql_result->fetchRow())) {
	  $fields[] = $data["Field"]; }
	if (in_array('blank', $fields)) {
	  // Die Spalten sind bereits vorhanden
	  $prompt .= sprintf(dl_upgrade_field_exists,'blank');	}
	else {
	  // Tebelle muss ergaenzt werden
		$thisQuery = "ALTER TABLE ".TABLE_PREFIX."mod_dirlist ADD blank INT(11) DEFAULT 0";
		$oldErrorReporting = error_reporting(0);
		$sql_result = $database->query($thisQuery);
		error_reporting($oldErrorReporting);
		if ($database->is_error()) {
			// Fehler beim Einfuegen des Feldes
			$upgradeError = true;
			$prompt .= sprintf(dl_error_insert_field,'blank',$database->get_error()); }
	  else {
	  	// Feld erfolgreich eingefuegt
	  	$prompt .= sprintf(dl_upgrade_insert_field,'blank'); }
	}
}


// Ergebnis des Upgrade melden
if ($upgradeError) {
	$admin->print_error($prompt); }
else {
	$admin->print_success($prompt); }


?>