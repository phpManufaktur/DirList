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

define('dl_error_add_record',						'<p>une erreur est survenue lors de l\'ajout d\'un enregistrement</p><p>[%s] <strong>%s</strong></p>');
define('dl_error_create_table',					'<p>une erreur est survenue lors de la cr&eacute;ation d\'une table</p><p>[%s] <strong>%s</strong></p>');
define('dl_error_delete_record',				'<p>une erreur est survenie lors de la suppression d\'un enregistrement</p><p>[%s] <strong>%s</strong></p>');
define('dl_error_delete_table',					'<p>une erreur est survenue lors de la suppression d\'une table</p><p>[%s] <strong>%s</strong></p>');
define('dl_error_describe_table',				'<p>Ne parvient pas &agrave; lire la description de la table.</p><p><strong>Prompt:</strong> %s</p>');
define('dl_error_empty_directory', 			'Veuillez s&eacute;lectionner un dossier MEDIA!');
define('dl_error_header',								'class.dirlist.php');
define('dl_error_insert_field',					'<p>Une erreur est survenue lors de l\'ajout d\'un champs "<strong>%s</strong>" into the table.</p><p><strong>Prompt:</strong> %s</p>');
define('dl_error_link_by_page_id',			'Le nom de la table ne peut &egravetre lu depuis la BDD.');
define('dl_error_no_error',							'pas d\'erreur');
define('dl_error_not_specified',    		'non sp&eacute;cifi&eacute;');
define('dl_error_row_empty',						'pas d\entr&eacute;e dans la table');
define('dl_error_update_record',				'<p>une erreur est survenue lors de la mise &agrave; jour de la table</p><p>[%s] <strong>%s</strong></p>');

define('dl_upgrade_field_exists',				'<p>Le champs "<strong>%s</strong>" existe d&eacute;j&agrave;.</p>');
define('dl_upgrade_insert_field',				'<p>Le champs "<strong>%s</strong>" a correctement &eacute;t&eacute; ajout&eacute; � la table.</p>');

define('dl_backend_blank',							'Ouvrir le fichier dans une nouvelle fen&ecirc;tre.');
define('dl_backend_btn_abort',					'Annuler');
define('dl_backend_btn_submit',					'Envoyer');
define('dl_backend_description',    		'Via ce formulaire vous configurer DirList pour la page s&eacute;lectionn&eacute;e rsp. section');
define('dl_backend_exclude',						'Exlure');
define('dl_backend_header',         		'Configurer DirList');
define('dl_backend_include',						'Inclure');
define('dl_backend_select_directory',		'--> Veuillez selectionner un r&eacute;pertoire!');
define('dl_backend_sortDateAscending',	'par date, croissant');
define('dl_backend_sortDateDescending',	'par date, d&eacute;croissant');
define('dl_backend_sortFilesAscending',	'par nom, croissant');
define('dl_backend_sortFilesDescending','par nom, d&eacute;croissant');
define('dl_backend_sortSizeAscending',	'par taille, croissant');
define('dl_backend_sortSizeDescending',	'par taille, d&eacute;croissant');
define('dl_backend_success_update',			'L\'enregistrement a bien &eacute;t&eacute; mis &agrave; jour');
define('dl_backend_text_header',    		'Titre pour DirList');
define('dl_backend_text_preselect',			'Vous pouvez exlure des types de fichiers. Veuillez ins&eacute;rer les extentions &agrave; exlure s&eacute;par&eacute; d\une virgule, i.e.: <strong>tif, jpg, gif</strong>');
define('dl_backend_text_prefix',    		'Ce texte aparaitra en dessous du titre et au dessus de votre liste (Prefix)');
define('dl_backend_text_select',				'R&eacute;pertoire utilis&eacute; pour DirList');
define('dl_backend_text_sort',					'Tri de DirList:');
define('dl_backend_text_suffix',				'Ce texte apparaitra en dessous de votre liste (Suffix)');

define('dl_frontend_empty_directory',		'..');
define('dl_frontend_th_date',						'Modifi&eacute;');
define('dl_frontend_th_datetime',				'm-d-Y g:i a');
define('dl_frontend_th_file',						'Nom');
define('dl_frontend_th_size',						'Taille');

?>