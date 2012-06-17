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

define('dl_error_add_record',						'<p>a error occurs while adding a new record</p><p>[%s] <strong>%s</strong></p>');
define('dl_error_create_table',					'<p>a error occurs while trying to create a new table</p><p>[%s] <strong>%s</strong></p>');
define('dl_error_delete_record',				'<p>a error occurs while deleting a record</p><p>[%s] <strong>%s</strong></p>');
define('dl_error_delete_table',					'<p>a error occurs while deleting a table</p><p>[%s] <strong>%s</strong></p>');
define('dl_error_describe_table',				'<p>Could not read the table description.</p><p><strong>Prompt:</strong> %s</p>');
define('dl_error_empty_directory', 			'Please select a MEDIA directory!');
define('dl_error_header',								'class.dirlist.php');
define('dl_error_insert_field',					'<p>A error occurs while inserting the field "<strong>%s</strong>" into the table.</p><p><strong>Prompt:</strong> %s</p>');
define('dl_error_link_by_page_id',			'The filename of the page could not be read from the database.');
define('dl_error_no_error',							'no error');
define('dl_error_not_specified',    		'not specified');
define('dl_error_row_empty',						'no entry in table');
define('dl_error_update_record',				'<p>a error occurs while updating the record</p><p>[%s] <strong>%s</strong></p>');

define('dl_upgrade_field_exists',				'<p>The field "<strong>%s</strong>" is still existing.</p>');
define('dl_upgrade_insert_field',				'<p>The field "<strong>%s</strong>" was successfully inserted into the table.</p>');

define('dl_backend_blank',							'Open files in a new window');
define('dl_backend_btn_abort',					'Abort');
define('dl_backend_btn_submit',					'Submit');
define('dl_backend_description',    		'With this dialog you configure DirList for the selected page rsp. section');
define('dl_backend_exclude',						'Exclude');
define('dl_backend_header',         		'Configure DirList');
define('dl_backend_include',						'Include');
define('dl_backend_select_directory',		'--> Please select a directory!');
define('dl_backend_sortDateAscending',	'by date, ascending');
define('dl_backend_sortDateDescending',	'by date, descending');
define('dl_backend_sortFilesAscending',	'by filename, ascending');
define('dl_backend_sortFilesDescending','by filename, descending');
define('dl_backend_sortSizeAscending',	'by filesize, ascending');
define('dl_backend_sortSizeDescending',	'by filesize, descending');
define('dl_backend_success_update',			'The record was successfully updated');
define('dl_backend_text_header',    		'Header for the DirList');
define('dl_backend_text_preselect',			'You may include and exclude files. Please type in the file extensions separated by comma, i.e.: <strong>tif, jpg, gif</strong>');
define('dl_backend_text_prefix',    		'This text will be shown after the header and before the DirList (Prefix)');
define('dl_backend_text_select',				'Directory used by DirList');
define('dl_backend_text_sort',					'Sorting the DirList:');
define('dl_backend_text_suffix',				'This text will be shown at the end of page rsp. section (Suffix)');

define('dl_frontend_empty_directory',		'..');
define('dl_frontend_th_date',						'Modified');
define('dl_frontend_th_datetime',				'm-d-Y g:i a');
define('dl_frontend_th_file',						'Filename');
define('dl_frontend_th_size',						'Size');

?>