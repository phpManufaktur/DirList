<?php

######################################################################################################################
#
#	PURPOSE OF THIS FILE:
#	Depending on your server configuration, the browser shows all files and subfolder contained in a directory, if no
#	index.xxx file is located in the directory. This makes it easier for hackers to analyse the file structure and to
#	search for security vulnerabilities which could be used to hack your Website Baker installation.
#	This file redirects the user to the Website Baker main page when trying to access the module directory directly.
#
#	INVOKED BY:
#	This file is invoked if someone accesses the module directory directly via typing the URL into the browser.
#	Example: http://domain.com/modules/helloworld or http://domain.com/modules/helloworld/index.php
#
######################################################################################################################

/**
  Module developed for the Open Source Content Management System Website Baker (http://websitebaker.org)
  Copyright (C) year, Authors name
  Contact me: author(at)domain.xxx, http://authorwebsite.xxx

  This module is free software. You can redistribute it and/or modify it
  under the terms of the GNU General Public License  - version 2 or later,
  as published by the Free Software Foundation: http://www.gnu.org/licenses/gpl.html.

  This module is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.
**/

header("Location: ../../index.php");

?>