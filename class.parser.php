<?php
/**
* Simple TemplateParser Class
*
* @author  :  MA Razzaque Rupom <rupom_315@yahoo.com>, <rupom.bd@gmail.com>
*             Moderator, phpResource (http://groups.yahoo.com/group/phpresource/)
*             URL: http://www.rupom.info
*             Additional Features by
*             Ralf Hertsch, Berlin (Germany) - <hertsch@berlin.de>
* @version :  2.0
* Purpose  :  Parsing Simple Template File and Data that Contains Macros
* @abstract template Parsing
*/

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
  	$value = ereg_replace("ä","&auml;",$value);
  	$value = ereg_replace("Ä","&Auml;",$value);
  	$value = ereg_replace("ö","&ouml;",$value);
  	$value = ereg_replace("Ö","&Ouml;",$value);
  	$value = ereg_replace("ü","&uuml;",$value);
  	$value = ereg_replace("Ü","&Uuml;",$value);
  	$value = ereg_replace("ß","&szlig;",$value);
  	$value = ereg_replace("€","&euro;",$value);
    return $value;
  }

  function decodeSpecialChars(&$value) {
   	$value = ereg_replace("&auml;","ä",$value);
   	$value = ereg_replace("&Auml;","Ä",$value);
   	$value = ereg_replace("&ouml;","ö",$value);
   	$value = ereg_replace("&Ouml;","Ö",$value);
   	$value = ereg_replace("&uuml;","ü",$value);
   	$value = ereg_replace("&Uuml;","Ü",$value);
   	$value = ereg_replace("&szlig;","ß",$value);
   	$value = ereg_replace("&euro;","€",$value);
    return $value;
  }

  /**
  *	Fügt dem "macro=>value" Array Werte hinzu und maskiert Sonderzeichen für die HTML Ausgabe
  * @param string $key Schlüssel
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
   * Setzt das "macro=>value" Array zurück
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