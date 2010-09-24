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

/**
 * Version history:
 *
 * v0.10 - 07.10.2007
 *    first release
 *
 * v0.11 - 13.10.2007
 *    added: 		frontend shows 2 dots instead of filename if directory is empty
 * 		fixed:		backend lost values in case of errors while saving settings.
 *    added:    click on table header will sort DirList by filename ascending or descending,
 *              size ascending or descending, date ascending or descending
 *    added:    show mimetype icons in DirList
 *    added:    upgrade.php for automated upgrades
 *
 * v0.12 - 13.10.2007
 *    fixed:    show multiple DirList's within a single page
 *
 * v0.13 - 14.10.2007
 *    changed:   replaced variable $module_directory with hardcoded 'dirlist'
 *    added:     Dutch language file NL.php - many thanks to Marco Loehnen
 *
 * v0.14 - 18.10.2007
 *    fixed:    HTML/XML - some markup language errors prevented DirList from passing
 *              W3C Markup Language Validation
 *    note:     Bug in WB 2.6.7 impede modules from passing W3C Validation, please check
 *              Ticket #521 --> http://projects.websitebaker.org/websitebaker2/ticket/521
 *              for further informations and fix-up
 *
 *  v0.15 - 31.10.2007
 *    fixed:    DirList shows hidden files
 *    changed:  structure of language files
 *    added:    filter for including and excluding files in DirList
 *
 *  v0.15a - 03.11.2007
 *    updated:  Dutch language file NL.php - many thanks to Marco Loehnen
 *
 *  v0.16 - 08.11.2007
 *    fixed:    some mispellings...
 *    added:    switch to open files in a new window (target="_blank")
 *
 *  v0.17 - 14.11.2007
 *    added:    Italian language file IT.php - many thanks to Antonello Alonzi
 *
 *  v0.18 - 18.02.2008
 *    fixed:    problem if class.parser.php is used in different modules
 *
 *  v0.19 - 04.04.2008
 *    fixed:    class.mimetypes.php returns wrong icon for application/msword
 *    fixed:    problem getting Media Directories with apache at windows pc
 *              (many thanks to Robert Schreiner for solution)
 *    fixed:    empty $_REQUEST's causes error messages in backend
 *
 *  v0.20 - 12.04.2008
 *    fixed:    use of specific PHP5 features prohibited proper execution under PHP4
 *
 *  v0.21 - 14.05.2008
 *    fixed:    problem reading WB settings from database
 * 
 *  v0.22 - 29.07.2010
 *    added:    french language file FR.php - many thanks to EmGel
 *
 **/

$module_directory 	 = 'dirlist';
$module_name 			   = 'DirList';
$module_function 		 = 'page';
$module_version 		 = '0.22';
$module_platform 		 = '2.7.x';
$module_status       = 'Stable';
$module_author 		   = 'Ralf Hertsch - ralf.hertsch@phpManufaktur.de';
$module_license 		 = 'GNU General Public License';
$module_description  = 'Show files of a selected MEDIA directory with mime-type icon, name, size and date of last change for download.';
$module_home         = 'http://phpManufaktur.de';
$module_guid         = 'DC9E87CA-0D9E-47E0-9CF1-9CBFF6EFD31C';

?>