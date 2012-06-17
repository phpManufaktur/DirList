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

define('dl_error_add_record',						'<p>Fout tijdens toevoegen nieuw record</p><p>[%s] <strong>%s</strong></p>');
define('dl_error_create_table',					'<p>Fout tijdens aanmaken nieuwe tabel</p><p>[%s] <strong>%s</strong></p>');
define('dl_error_delete_record',				'<p>Fout tijdens verwijderen record</p><p>[%s] <strong>%s</strong></p>');
define('dl_error_delete_table',					'<p>Fout tijdens verwijderen tabel</p><p>[%s] <strong>%s</strong></p>');
define('dl_error_describe_table',				'<p>Kon de tabel beschrijving niet lezen.</p><p><strong>Prompt:</strong> %s</p>');
define('dl_error_empty_directory', 			'Selecteer vanuit de MEDIA map!');
define('dl_error_header',								'class.dirlist.php');
define('dl_error_insert_field',					'<p>Fout tijdens het invoegen van veld "<strong>%s</strong>" in tabel.</p><p><strong>Prompt:</strong> %s</p>');
define('dl_error_link_by_page_id',			'The filename of the page could not be read from the database.');
define('dl_error_no_error',							'geen fout');
define('dl_error_not_specified',    		'niet gespecificeerd');
define('dl_error_row_empty',						'geen regel in tabel');
define('dl_error_update_record',				'<p>Fout tijdens het updaten record</p><p>[%s] <strong>%s</strong></p>');

define('dl_upgrade_field_exists',				'<p>Het veld "<strong>%s</strong>" bestaat nog steeds.</p>');
define('dl_upgrade_insert_field',				'<p>Het veld "<strong>%s</strong>" is succesvol toegevoegd aan de tabel.</p>');

define('dl_backend_blank',							'Open files in a new window');
define('dl_backend_btn_abort',					'Annuleren');
define('dl_backend_btn_submit',					'Toevoegen');
define('dl_backend_description',    		'Via deze dialoog kun je DirList instellen voor deze pagina rsp. section');
define('dl_backend_exclude',						'Uitsluiten');
define('dl_backend_header',         		'DirList configureren');
define('dl_backend_include',						'Selecteren');
define('dl_backend_text_header',    		'Header voor DirList');
define('dl_backend_text_preselect',			'Je kunt bestanden selecteren of uitsluiten. Geef de bestandstypen (extensies) gescheiden door een komma, bijv.: <strong>tif, jpg, gif</strong>');
define('dl_backend_text_prefix',    		'Deze tekst wordt getoond na de header en voor de DirList (Prefix)');
define('dl_backend_text_select',				'Map die DirList gebruikt');
define('dl_backend_text_sort',					'Sorteren DirList:');
define('dl_backend_text_suffix',				'Deze tekst wordt getoond aan het einde van de pagina rsp. section (Suffix)');
define('dl_backend_select_directory',		'--> Kies een map!');
define('dl_backend_sortDateAscending',	'op datum, oplopend');
define('dl_backend_sortDateDescending',	'op datum, aflopend');
define('dl_backend_sortFilesAscending',	'op bestandsnaam, oplopend');
define('dl_backend_sortFilesDescending','op bestandsnaam, aflopend');
define('dl_backend_sortSizeAscending',	'op grootte, oplopend');
define('dl_backend_sortSizeDescending',	'op grootte, aflopend');
define('dl_backend_success_update',			'Wijziging succesvol opgeslagen');

define('dl_frontend_empty_directory',		'..');
define('dl_frontend_th_date',						'Gewijzigd');
define('dl_frontend_th_datetime',				'd.m.Y h:i');
define('dl_frontend_th_file',						'Bestandsnaam');
define('dl_frontend_th_size',						'Grootte');


?>