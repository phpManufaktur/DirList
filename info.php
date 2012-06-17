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

$module_directory 	 = 'dirlist';
$module_name 			   = 'DirList';
$module_function 		 = 'page';
$module_version 		 = '0.23';
$module_platform 		 = '2.7.x';
$module_status       = 'Stable';
$module_author 		   = 'Ralf Hertsch - ralf.hertsch@phpManufaktur.de';
$module_license 		 = 'MIT License (MIT)';
$module_description  = 'Show files of a selected MEDIA directory with mime-type icon, name, size and date of last change for download.';
$module_home         = 'http://phpManufaktur.de';
$module_guid         = 'DC9E87CA-0D9E-47E0-9CF1-9CBFF6EFD31C';

?>