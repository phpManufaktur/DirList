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

class mimeTypes {

  var $types = array(
         "ez"       => "application/andrew-inset",
         "hqx"      => "application/mac-binhex40",
         "cpt"      => "application/mac-compactpro",
         "doc"      => "application/msword",
         "bin"      => "application/octet-stream",
         "dms"      => "application/octet-stream",
         "lha"      => "application/octet-stream",
         "lzh"      => "application/octet-stream",
         "exe"      => "application/octet-stream",
         "class"    => "application/octet-stream",
         "so"       => "application/octet-stream",
         "dll"      => "application/octet-stream",
         "oda"      => "application/oda",
         "pdf"      => "application/pdf",
         "ai"       => "application/postscript",
         "eps"      => "application/postscript",
         "ps"       => "application/postscript",
         "smi"      => "application/smil",
         "smil"     => "application/smil",
         "wbxml"    => "application/vnd.wap.wbxml",
         "wmlc"     => "application/vnd.wap.wmlc",
         "wmlsc"    => "application/vnd.wap.wmlscriptc",
         "bcpio"    => "application/x-bcpio",
         "vcd"      => "application/x-cdlink",
         "pgn"      => "application/x-chess-pgn",
         "cpio"     => "application/x-cpio",
         "csh"      => "application/x-csh",
         "dcr"      => "application/x-director",
         "dir"      => "application/x-director",
         "dxr"      => "application/x-director",
         "dvi"      => "application/x-dvi",
         "spl"      => "application/x-futuresplash",
         "gtar"     => "application/x-gtar",
         "hdf"      => "application/x-hdf",
         "js"       => "application/x-javascript",
         "skp"      => "application/x-koan",
         "skd"      => "application/x-koan",
         "skt"      => "application/x-koan",
         "skm"      => "application/x-koan",
         "latex"    => "application/x-latex",
         "nc"       => "application/x-netcdf",
         "cdf"      => "application/x-netcdf",
         "sh"       => "application/x-sh",
         "shar"     => "application/x-shar",
         "swf"      => "application/x-shockwave-flash",
         "sit"      => "application/x-stuffit",
         "sv4cpio"  => "application/x-sv4cpio",
         "sv4crc"   => "application/x-sv4crc",
         "tar"      => "application/x-tar",
         "tcl"      => "application/x-tcl",
         "tex"      => "application/x-tex",
         "texinfo"  => "application/x-texinfo",
         "texi"     => "application/x-texinfo",
         "t"        => "application/x-troff",
         "tr"       => "application/x-troff",
         "roff"     => "application/x-troff",
         "man"      => "application/x-troff-man",
         "me"       => "application/x-troff-me",
         "ms"       => "application/x-troff-ms",
         "ustar"    => "application/x-ustar",
         "src"      => "application/x-wais-source",
         "xhtml"    => "application/xhtml+xml",
         "xht"      => "application/xhtml+xml",
         "zip"      => "application/zip",
         "au"       => "audio/basic",
         "snd"      => "audio/basic",
         "mid"      => "audio/midi",
         "midi"     => "audio/midi",
         "kar"      => "audio/midi",
         "mpga"     => "audio/mpeg",
         "mp2"      => "audio/mpeg",
         "mp3"      => "audio/mpeg",
         "aif"      => "audio/x-aiff",
         "aiff"     => "audio/x-aiff",
         "aifc"     => "audio/x-aiff",
         "m3u"      => "audio/x-mpegurl",
         "ram"      => "audio/x-pn-realaudio",
         "rm"       => "audio/x-pn-realaudio",
         "rpm"      => "audio/x-pn-realaudio-plugin",
         "ra"       => "audio/x-realaudio",
         "wav"      => "audio/x-wav",
         "pdb"      => "chemical/x-pdb",
         "xyz"      => "chemical/x-xyz",
         "bmp"      => "image/bmp",
         "gif"      => "image/gif",
         "ief"      => "image/ief",
         "jpeg"     => "image/jpeg",
         "jpg"      => "image/jpeg",
         "jpe"      => "image/jpeg",
         "png"      => "image/png",
         "tiff"     => "image/tiff",
         "tif"      => "image/tif",
         "djvu"     => "image/vnd.djvu",
         "djv"      => "image/vnd.djvu",
         "wbmp"     => "image/vnd.wap.wbmp",
         "ras"      => "image/x-cmu-raster",
         "pnm"      => "image/x-portable-anymap",
         "pbm"      => "image/x-portable-bitmap",
         "pgm"      => "image/x-portable-graymap",
         "ppm"      => "image/x-portable-pixmap",
         "rgb"      => "image/x-rgb",
         "xbm"      => "image/x-xbitmap",
         "xpm"      => "image/x-xpixmap",
         "xwd"      => "image/x-windowdump",
         "igs"      => "model/iges",
         "iges"     => "model/iges",
         "msh"      => "model/mesh",
         "mesh"     => "model/mesh",
         "silo"     => "model/mesh",
         "wrl"      => "model/vrml",
         "vrml"     => "model/vrml",
         "css"      => "text/css",
         "html"     => "text/html",
         "htm"      => "text/html",
         "asc"      => "text/plain",
         "txt"      => "text/plain",
         "rtx"      => "text/richtext",
         "rtf"      => "text/rtf",
         "sgml"     => "text/sgml",
         "sgm"      => "text/sgml",
         "tsv"      => "text/tab-seperated-values",
         "wml"      => "text/vnd.wap.wml",
         "wmls"     => "text/vnd.wap.wmlscript",
         "etx"      => "text/x-setext",
         "xml"      => "text/xml",
         "xsl"      => "text/xml",
         "mpeg"     => "video/mpeg",
         "mpg"      => "video/mpeg",
         "mpe"      => "video/mpeg",
         "qt"       => "video/quicktime",
         "mov"      => "video/quicktime",
         "mxu"      => "video/vnd.mpegurl",
         "avi"      => "video/x-msvideo",
         "movie"    => "video/x-sgi-movie",
         "ice"      => "x-conference-xcooltalk"  );

  function getMimeType($thisFile) {
    // in Kleinbuchstaben umwandeln
    $thisFile = strtolower($thisFile);
    // nur den Dateinamen verwenden
    $thisFile = basename($thisFile);
    // splitten, Seperator ist .
    $thisFile = explode('.',$thisFile);
    // nur das letzte Segment verwenden (Dateiendung)
    $thisFile = $thisFile[count($thisFile)-1];
    // Dateiendung im Typen Array suchen
    if (isset($this->types[$thisFile])) {
      return $this->types[$thisFile];  }
    else {
      return 'application/octet-stream';  }
  }

  function getIconByType($thisFile) {
    // MIME Type ermitteln
    $mimeType = $this->getMimeType($thisFile);
    // ... und zuordnen
    switch ($mimeType):

    case "application/pdf":
      // PDF
      return 'pdf.png';

    case "application/x-stuffit":
    case "application/x-gtar":
    case "application/mac-binhex40":
    case "application/x-tar":
    case "application/zip":
      // COMPRESSED
      return 'pk.png';

    case "application/msword":
      // WORD & Co.
      return "msword_doc.png";

    case "application/xhtml+xml":
      // HTML & Co.
      return 'source.png';

    case "application/x-javascript":
      // JAVA
      return 'source_java.png';

    case "application/postscript":
      // Postscript
      return 'postscript.png';

    case "audio/basic":
    case "audio/basic":
    case "audio/midi":
    case "audio/midi":
    case "audio/midi":
    case "audio/mpeg":
    case "audio/mpeg":
    case "audio/mpeg":
    case "audio/x-aiff":
    case "audio/x-aiff":
    case "audio/x-aiff":
    case "audio/x-mpegurl":
    case "audio/x-pn-realaudio":
    case "audio/x-pn-realaudio":
    case "audio/x-pn-realaudio-plugin":
    case "audio/x-realaudio":
    case "audio/x-wav":
      // Audio
      return 'sound.png'; // stammt aus Crystal_Clear

    case "image/bmp":
    case "image/gif":
    case "image/ief":
    case "image/jpeg":
    case "image/jpeg":
    case "image/jpeg":
    case "image/png":
    case "image/tiff":
    case "image/tif":
    case "image/vnd.djvu":
    case "image/vnd.djvu":
    case "image/vnd.wap.wbmp":
    case "image/x-cmu-raster":
    case "image/x-portable-anymap":
    case "image/x-portable-bitmap":
    case "image/x-portable-graymap":
    case "image/x-portable-pixmap":
    case "image/x-rgb":
    case "image/x-xbitmap":
    case "image/x-xpixmap":
    case "image/x-windowdump":
      // Bilddateien
      return 'image.png';

    case "text/css":
    case "text/html":
    case "text/html":
    case "text/plain":
    case "text/plain":
    case "text/richtext":
    case "text/rtf":
    case "text/sgml":
    case "text/sgml":
    case "text/tab-seperated-values":
    case "text/vnd.wap.wml":
    case "text/vnd.wap.wmlscript":
    case "text/x-setext":
    case "text/xml":
    case "text/xml":
      // Textdateien
      return 'txt.png';

    case "video/mpeg":
    case "video/mpeg":
    case "video/mpeg":
    case "video/quicktime":
    case "video/quicktime":
    case "video/vnd.mpegurl":
    case "video/x-msvideo":
    case "video/x-sgi-movie":
      // Video
      return 'video.png';

    // nicht zugeordnete MIME-Types und DEFAULT:
    case "x-conference-xcooltalk":
    case "model/iges":
    case "model/iges":
    case "model/mesh":
    case "model/mesh":
    case "model/mesh":
    case "model/vrml":
    case "model/vrml":
    case "chemical/x-pdb":
    case "chemical/x-xyz":
    case "application/andrew-inset":
    case "application/mac-compactpro":
    case "application/octet-stream":
    case "application/oda":
    case "application/smil":
    case "application/vnd.wap.wbxml":
    case "application/vnd.wap.wmlc":
    case "application/vnd.wap.wmlscriptc":
    case "application/x-bcpio":
    case "application/x-cdlink":
    case "application/x-chess-pgn":
    case "application/x-cpio":
    case "application/x-csh":
    case "application/x-director":
    case "application/x-dvi":
    case "application/x-futuresplash":
    case "application/x-hdf":
    case "application/x-koan":
    case "application/x-latex":
    case "application/x-netcdf":
    case "application/x-sh":
    case "application/x-shar":
    case "application/x-shockwave-flash":
    case "application/x-sv4cpio":
    case "application/x-sv4crc":
    case "application/x-tcl":
    case "application/x-tex":
    case "application/x-texinfo":
    case "application/x-troff":
    case "application/x-troff-man":
    case "application/x-troff-me":
    case "application/x-troff-ms":
    case "application/x-ustar":
    case "application/x-wais-source":
    default:
      return "vmlinuz.png";
    endswitch;
   	return "vmlinuz.png";
  }
}

?>