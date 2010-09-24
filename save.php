<?php

/**
  Module developed for the Open Source Content Management System Website Baker (http://websitebaker.org)
  Copyright (c) 2007, Ralf Hertsch
  Contact me: hertsch(at)berlin.de, http://ralf-hertsch.de

  This module is free software. You can redistribute it and/or modify it
  under the terms of the GNU General Public License  - version 2 or later,
  as published by the Free Software Foundation: http://www.gnu.org/licenses/gpl.html.

  This module is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.
**/


// manually include the config.php file (defines the required constants)
require('../../config.php');

/**
*	INCLUDE THE WB-ADMIN WRAPPER SCRIPT
*	The admin wrapper script provides functions to add the look & feel of WB-Backend pages
*	to the save.php file (backend header, last modified, backend footer...).
*	The admin wrapper also takes care about the users permissions to view and change the files.
*/
// tell the admin wrapper to actualize the DB settings when this page was last updated
$update_when_modified = true;
// include the admin wrapper script (includes framework/class.admin.php)
require(WB_PATH.'/modules/admin.php');

// Modul Informationen
require_once('info.php');

if(!file_exists(WB_PATH .'/modules/dirlist/languages/' .LANGUAGE .'.php')) {
	require_once(WB_PATH .'/modules/dirlist/languages/DE.php');
} else {
		require_once(WB_PATH .'/modules/dirlist/languages/' .LANGUAGE .'.php');
}

if(!method_exists($admin, 'register_backend_modfiles') && file_exists(WB_PATH .'/modules/dirlist/backend.css')) {
	echo '<style type="text/css">';
	include(WB_PATH .'/modules/dirlist/backend.css');
	echo "\n</style>\n";
}

require_once('class.dirlist.php');

//error_reporting(E_ALL);

$dirlist = new dirlist($page_id,$section_id,false);

if ($dirlist->updateEntryByRequest()) {
  $admin->print_success(dl_backend_success_update,ADMIN_URL.'/pages/modify.php?page_id='.$page_id); }
elseif($database->is_error()) {
  // SQL Fehler
  $admin->print_error(sprintf(dl_error_update_record,$dirlist->errorPlace,$dirlist->error),ADMIN_URL.'/pages/modify.php?page_id='.$page_id); }
else {
  // sonstiger Fehler
  $admin->print_error($dirlist->error,ADMIN_URL.'/pages/modify.php?page_id='.$page_id.'&action=request&header='.$_REQUEST['header'].'&prefix='.$_REQUEST['prefix'].'&directory='.$_REQUEST['directory'].'&sort='.$_REQUEST['sort'].'&suffix='.$_REQUEST['suffix']); }


?>