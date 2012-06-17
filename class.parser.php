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

class templateParser
{
	 var $data = array();
   var $html = "";

	 /**
	 * Initializes "macro=>value" array
	 * @param Array "macro=>value" array
	 * @return none
	 */
   function initData($data,$resetHTML=true)
   {
      $this->data = array();
      $this->data = $data;
      if ($resetHTML) unset($this->html);
   }

   /**
	 * Parses template file
	 * @param template filename
	 * @return parsed template
	 */
   function parseTemplateFile($templateFile)
   {
      $searchPattern          = "/\{([a-zA-Z0-9_]+)\}/i"; // macro delimiter "{" and "}"
      $replacementFunction    = array(&$this, 'parseMatchedText');  //Method callbacks are performed this way
      $fileData               = file_get_contents($templateFile);
      $this->html            .= preg_replace_callback($searchPattern, $replacementFunction, $fileData);
      return $this->html;
   }

   /**
	 * Parses template data
	 * @param template data
	 * @return parsed data
	 */
   function parseTemplateData($templateData)
   {
      $searchPattern          = "/\{([a-zA-Z0-9_]+)\}/i"; //macro delimiter "{" and "}"
      $replacementFunction    = array(&$this, 'parseMatchedText');  //Method callbacks are performed this way
      $this->html         		= preg_replace_callback($searchPattern, $replacementFunction, $templateData);
      return $this->html;
   }

   /**
   * Callback function that returns value of a matching macro
   * @param Array $matches
   * @return String value of matching macro
   */
   function parseMatchedText($matches)
   {
      return $this->data[$matches[1]];
   }

  function encodeSpecialChars(&$value) {
  	$value = ereg_replace("�","&auml;",$value);
  	$value = ereg_replace("�","&Auml;",$value);
  	$value = ereg_replace("�","&ouml;",$value);
  	$value = ereg_replace("�","&Ouml;",$value);
  	$value = ereg_replace("�","&uuml;",$value);
  	$value = ereg_replace("�","&Uuml;",$value);
  	$value = ereg_replace("�","&szlig;",$value);
  	$value = ereg_replace("�","&euro;",$value);
    return $value;
  }

  function decodeSpecialChars(&$value) {
   	$value = ereg_replace("&auml;","�",$value);
   	$value = ereg_replace("&Auml;","�",$value);
   	$value = ereg_replace("&ouml;","�",$value);
   	$value = ereg_replace("&Ouml;","�",$value);
   	$value = ereg_replace("&uuml;","�",$value);
   	$value = ereg_replace("&Uuml;","�",$value);
   	$value = ereg_replace("&szlig;","�",$value);
   	$value = ereg_replace("&euro;","�",$value);
    return $value;
  }

  /**
  *	F�gt dem "macro=>value" Array Werte hinzu und maskiert Sonderzeichen f�r die HTML Ausgabe
  * @param string $key Schl�ssel
  * @param string $value Wert
  * @param boolean $encode=true Sonderzeichen maskieren
  */
	function add($key,$value,$encode=true) {
  	$encode ?	$this->data[$key]=$this->encodeSpecialChars($value) : $this->data[$key]=$value;
  }

  /**
   * Entfernt einen Wert aus dem "macro=>value" Array
   *
   * @param string $key
   */
  function delete($key) {
    unset($this->data[$key]);
  }

  /**
   * Setzt das "macro=>value" Array zur�ck
   *
   */
  function clear($resetHTML=false) {
  	$this->data = array();
    if ($resetHTML) unset($this->html);
  }

  function echoHTML($resetHTML=true) {
  	echo $this->html;
    if ($resetHTML) unset($this->html);
  }

  function getHTML($resetHTML=true) {
   	$result = $this->html;
    if ($resetHTML) unset($this->html);
    return $result;
  }

} //End Of Class

/**
 * Fuer BookShop angepasste Variante des Parsers
 *
 * @author Ralf Hertsch, Berlin (Germany)
 */

?>