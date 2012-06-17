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

define('dl_error_add_record',						'<p>Beim Hinzuf&uuml;gen des Datensatz ist ein Fehler aufgetreten</p><p>[%s] <strong>%s</strong></p>');
define('dl_error_create_table',					'<p>Beim Anlegen der Tabelle f&uuml;r DirList ist ein Fehler aufgetreten</p><p>[%s] <strong>%s</strong></p>');
define('dl_error_delete_record',				'<p>Beim L&ouml;schen des Datensatz ist ein Fehler aufgetreten</p><p>[%s] <strong>%s</strong></p>');
define('dl_error_delete_table',					'<p>Beim L&ouml;schen der Tabelle f&uuml;r DirList ist ein Fehler aufgetreten</p><p>[%s] <strong>%s</strong></p>');
define('dl_error_describe_table',				'<p>Die Tabellenbeschreibung konnte nicht ausgelesen werden.</p><p><strong>Fehlermeldung:</strong> %s</p>');
define('dl_error_empty_directory', 			'Bitte geben Sie ein MEDIA Verzeichnis an!');
define('dl_error_header',								'class.dirlist.php');
define('dl_error_insert_field',					'<p>Beim Einf&uuml;gen des Feldes "<strong>%s</strong>" ist ein Fehler aufgetreten.</p><p><strong>Fehlermeldung:</strong> %s</p>');
define('dl_error_link_by_page_id',			'Der Dateiname der Seite konnte nicht ausgelesen werden.');
define('dl_error_no_error',							'kein Fehler');
define('dl_error_not_specified',    		'nicht spezifiziert');
define('dl_error_row_empty',						'kein Eintrag in der Tabelle');
define('dl_error_update_record',				'<p>Beim Aktualisieren des Datensatz ist ein Fehler aufgetreten</p><p>[%s] <strong>%s</strong></p>');

define('dl_upgrade_field_exists',				'<p>Das Feld "<strong>%s</strong>" existiert bereits.</p>');
define('dl_upgrade_insert_field',				'<p>Das Feld "<strong>%s</strong>" wurde in die Tabelle eingef&uuml;gt.</p>');

define('dl_backend_blank',							'Dateien in einem neuen Fenster &ouml;ffnen');
define('dl_backend_btn_abort',					'Abbrechen');
define('dl_backend_btn_submit',					'&Uuml;bernehmen');
define('dl_backend_description',    		'Mit diesem Dialog richten Sie DirList f&uuml;r die jeweilige Seite bzw. f&uuml;r den jeweiligen Abschnitt ein.');
define('dl_backend_exclude',						'Ausschlie&szlig;en');
define('dl_backend_header',         		'DirList konfigurieren');
define('dl_backend_include',						'Einschlie&szlig;en');
define('dl_backend_select_directory',		'--> Bitte w&auml;hlen Sie ein Verzeichnis aus!');
define('dl_backend_sortDateAscending',	'nach Datum, aufsteigend');
define('dl_backend_sortDateDescending',	'nach Datum, absteigend');
define('dl_backend_sortFilesAscending',	'nach Dateinamen, aufsteigend');
define('dl_backend_sortFilesDescending','nach Dateinamen, absteigend');
define('dl_backend_sortSizeAscending',	'nach Dateigr&ouml;&szlig;e, aufsteigend');
define('dl_backend_sortSizeDescending',	'nach Dateigr&ouml;&szlig;e, absteigend');
define('dl_backend_success_update',			'Der Datensatz wurde aktualisiert');
define('dl_backend_text_header',    		'&Uuml;berschrift der DirList');
define('dl_backend_text_preselect',			'<p>Sie k&ouml;nnen festlegen, ob bestimmte Dateien <strong>ein</strong>- oder <strong>aus</strong>geschlossen werden sollen.<br />Geben Sie die gew&uuml;nschten Dateiendungen durch ein Komma getrennt ein, z.B: <strong>tif, gif, jpg</strong></p>');
define('dl_backend_text_prefix',    		'Erl&auml;uterungen zur Funktion der DirList (Prefix)');
define('dl_backend_text_select',				'MEDIA Verzeichnis der DirList');
define('dl_backend_text_sort',					'Sortierung der DirList:');
define('dl_backend_text_suffix',				'Dieser Text wird nach der DirList auf der Seite angezeigt (Suffix)');

define('dl_frontend_empty_directory',		'..');
define('dl_frontend_th_date',						'Ge&auml;ndert');
define('dl_frontend_th_datetime',				'd.m.Y h:i');
define('dl_frontend_th_file',						'Dateiname');
define('dl_frontend_th_size',						'Gr&ouml;&szlig;e');


?>