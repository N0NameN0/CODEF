<?php 
/***************************************************************************

snif 1.5.2
"snif is not an index file"
"simple and nice index file"
(c) Kai Blankenhorn
www.bitfolge.de
kaib@bitfolge.de


THIS IS THE REAL SNIF INDEX.PHP FILE.


This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details: <http://www.gnu.org/licenses/gpl.txt>

****************************************************************************

	+------------------------------------------------------------------------+
	| TRANSLATIONS:                                                          |
	+------------------------------------------------------------------------+
	| If you'd like to translate snif into your language, have a look at     |
	| the $languageStrings variable at the end of the advanced settings, add |
	| your language and send me the PHP snippet containing your translation. |
	+------------------------------------------------------------------------+
	
To do:
Make download icon bigger?
pdf and ppt and xls should have own icons as well not just listed as binary


Changelog:

v1.5.2	10-11-04
	added a Czech translation (thanks to Jan Pinkas)
	added an Italian translation (thanks to Luca Soltoggio)
	fixed an XHTML glitch in thumbnail tags

v1.5.1	 07-18-04
	fixed XHTML validity
	fixed back link not displayed

v1.5	 07-18-04
	added color configuration using an external stylesheet file
	added central configuration file for multiple installations of snif on one server
	added a Brazilian-Portuguese translation (thanks to Caio Begotti)
	added a Greek translation (thanks to George Yiftoyiannis)
	added a Spanish translation (thanks to Martinp and Genaro Paez)
	tweaked the file extensions
	fixed some problems with access rights for thumbnail files and directory
	fixed line-break issues in long descriptions
	fixed a strange unicode bug that could cause broken images in Mozilla
	fixed a bug with pictures and directories with special characters
	fixed a download bug (download link was broken sometimes)
	improved display for files with both thumbnail and description

v1.4.8	06-24-04
	added a Japanese translation (thanks to hjbdnpmo)
	added a Danish translation (thanks to Svend Rugaard)
	improved fail-safe behaviour when creating the .snifthumbs directory has failed
	improved backwards compatibility with default date format

v1.4.7	06-21-04
	fixed multiple problems with special characters in file and path names
	fixed a bug with downloading files with spaces or quotes in their names (thanks to Derick Ng)
	added a maximum thumbnail width (thanks to Nasim)

v1.4.6	06-18-04
	thumbnails now link to the original image file
	added a Russian translation (thanks to Neptune)
	added a Hungarian translation (thanks to Gabor Funk)
	added a French translation (thanks to Marc Nadeau)

v1.4.5	06-14-04
	added server-side thumbnail caching (needs some testing, but it seems to work well)
	all columns (including filetype icon) can now be hidden and reordered
	added an optional CVS version column (thanks to Holger "Holgi" Szillat)
	added a Dutch translation (thanks to Rogier van Epen)
	added a Norwegian translation (thanks to Kyrre Liaaen)
	added a Polish translation (thanks to Slawomir Jucht)
	added a Swedish translation (thanks to Elias Hedberg)
	improved translation instructions
	fixed some strings that were not translatable
	added an option to always use a specific translation
	fixed preview of animated GIFs
	added an option to hide all directories containing a .htaccess file, no matter its contents
	fixed default settings, forgot to reset my debug settings :-/

v1.4	05-04-04
	easy translation system (language is selected automatically depending on the
		user's browser's language setting)
	added a German translation
	option to reorder and hide columns
	option to display "[ back ]" instead of ".."
	option to always use the full width of the screen
	special icon for the .. link
	improved directory sorting: .. now always on first position
	truncation of long file names (and an option for it)
	added number of files contained in subdirectories
	improved error messages
	fixed possible bug with hidden files
	fixed a bug with descriptions containing non-ASCII characters
	thanks to Rogier van Epen for the comments

v1.3.2	01-19-04
	improved HTTP cacheability of icons, thumbnails and downloads, major speedup!
	added directory navigation in the header
	added a thumbnail size setting
	different index files in subdirectories are now possible

v1.3.1  01-14-04
	added splitting directories on multiple pages
	fixed some bugs with file links
	better support for international file names
	restored compatibility with older PHP versions (< 4.2.0, thank to Glen Solsberry)

v1.3    01-05-04
	added automatic thumbnails for images (optional, requires GDlib 2)
	added an option for case insensitive description assignment
	added XHTML 1.1 and CSS 2.0 conformance
	fixed a sorting bug
	once more fixed special characters in file names
	reduced resulting HTML size (15-20% smaller for large directories)

v1.2.9  12-20-03
	stupid date format bug fixed
	fixed download of files with special characters in their name
	code cleanup

v1.2.8  12-13-03
	settings have been split in basic and advanced settings
	added configurable server name instead of what PHP detects (thanks to Paul Munn)
	added configurable date and time format (thanks to Paul Munn)
	improved default hidden file wildcards, now also hides emacs temp files (thanks to Paul Munn)
	notices are now always suppressed
	fixed various HTML and CSS glitches (thanks to Paul Munn)
	fixed a bug which caused the sorting arrow not to be displayed (thanks to Paul Munn)
	renamed and reorganized stylesheets (thanks to Paul Munn)

v1.2.7  12-09-03
	cross site scripting bug fixed (thanks to Justin Hagstrom for reporting)
	fixed a bug with the new hidden file wildcards

v1.2.6  12-06-03
	improved external icons: you may now mix external and internal icons 
	improved directory sorting (thanks to mpember at mpember dot net dot au)
	improved default hidden files wildcards, now also hides .* (thanks to Charles Hill)
	fixed a minor bug in file type detection (thanks to Charles Hill)
	added more file extensions (thanks to Charles Hill)

v1.2.5  11-26-03
	security fix: download would allow paths above snif directory

v1.2.4  11-16-03
	added configurable separation string for description files
	added option to use external icons

v1.2.3  11-15-03
	fixed minor typos and HTML glitches

v1.2.2  11-11-03
	fixed a bug where the current path wasn't properly shown in the heading

v1.2.1  11-10-03
	fixed files without extension
	suppressed warning when io functions fail
	experimental handling of symbolic links (completely untested! Please give feedback.)

v1.2    11-04-03
	put a simple file into subdirectories to have snif handle direct requests to them
	minor bugfix

v1.1a   11-03-03
	file download for Opera fixed

v1.1    11-03-03
	download files instead of opening
	better documentation
	code cleanup

v1.0    10-19-03
	initial release



****************************************************************************
**  DESCRIPTION FILE FORMAT                                               **
****************************************************************************

Hardcore definition:

<descriptionfile>  ::= <line>*
<line>             ::= <filename><separationString><description><EOL>
<filename>         ::= <anythingExceptSeparationString>+
<separationString> ::= defined by the $separationString variable, default "\t"
<description>      ::= <anyting>+
<EOL>              ::= "\r\n" | "\n"			// OS dependent


Simple example:

.	This directory contains downloadable files for MyProgram 12.0.
myprogram_12.0.exe	Installer version of MyProgram 12.0 (recommended)
myprogram_12.0.zip	Zip file distribution of MyProgram 12.0
releasenotes.txt	Release notes for MyProgram 12.0


Please note that the room between the filename and the description is not
filled with multiple spaces, but with one single tab. It doesn't matter if
the descriptions in a file align or not, just use one tab.
If you use a description for the current directory (.) as in the first line
in the above example, it will be used as a heading in the directory listing.

Put your descriptions in a text file within the same directory as the files 
to describe. Then put the text file's name in the $useDescriptionsFrom 
variable below. It is suggested that you use the same description file name
in all subdirectories you want to list. Reason: Read the next paragraph.

To make it even easier: For my download folder at 
http://www.bitfolge.de/download, I have put the description file at
http://www.bitfolge.de/download/descript.ion
You can download it and use it as another example.

Filenames in the description file are case insensitive as of 1.2.10. This
means that myprogram.zip and MyProgram.ZIP both are regarded as the same
file. If case sensitivity matters for you, you can disable this with the
$descriptionFilenamesCaseSensitive variable in the advanced settings.


****************************************************************************
**  HANDLING SUBDIRECTORY LISTINGS                                        **
****************************************************************************

Say you've put the snif index.php into www.yourhost.com/download.
Now somebody makes a request to www.yourhost.com/download/releases. In
order to deal with this properly, you would have to copy the snif index.php
to that directory, too. But this will prevent the user to go to 
www.yourhost.com/download from www.yourhost.com/download/releases
directly by selecting the .. link.

If you have this situation, use the index.php file from the subdirectory
called "subdir" in the snif archive file. All it does is automatically 
forward the user to the parent directory and set URL parameters so that
the real snif will handle the request.

OK, that may be confusing. Again, a simple example:


/download/descript.ion                       << descriptions for /download/*.*
/download/index.php                          << this file you're reading now, >25 KB
/download/license.txt
/download/notes.txt
/download/releases/bigprogram_2.0.zip
/download/releases/descript.ion              << descriptions for /download/releases/*.*
/download/releases/index.php                 << subdir/index.php, <2 KB
/download/releases/nightly/2.1_20031103.zip
/download/releases/nightly/2.1_20031104.zip
/download/releases/nightly/index.php         << subdir/index.php, <2 KB


If a users points his browser to
  www.yourhost.com/download/releases/nightly/
  
The small index.php will forward him to
  www.yourhost.com/download/releases/?path=nightly/

And then the index file in that directory will forward him again, this time to
  www.yourhost.com/download/?path=releases/nightly/

Now we've reached the directory with the real snif (should get a copyright on
that phrase ;-)), which will take over and miraculously lists the directory
the user typed as an URL.



/***************************************************************************/
/**  SET YOUR CONFIGURATION HERE                                          **/
/***************************************************************************/



/**************  BASIC SETTINGS  *******************************************/
/* These settings configure the most basic functions of snif. You should   */
/* be able to understand them quickly.                                     */
/***************************************************************************/

/**
 * Specify which files should be hidden in the file listing using
 * unix/DOS wildcards (? and *).
 * This is case insensitive. This script, the current directory (.), the
 * description file and the external stylesheet will be automatically hidden.
 **/
$hiddenFilesWildcards = Array("*.php", "*~","*.md","old*");

/**
 * Show sub directories and let the user change to them.
 * It will be impossible to go above the directory this script is in.
 **/
$allowSubDirs = true;

/**
 * Allow the users to download .php files. This will expose the full contents
 * of the downloaded files (including any password used in it). Be careful
 * with this!
 * This only makes sense if you don't hide all .php files.
 **/
$allowPHPDownloads = false;


/**
 * Automatically generate and display thumbnails for image files. This
 * feature requires GDlib 2.0+.
 **/
$useAutoThumbnails = true;


/**
 * Cache any thumbnails created for later use in a subdirectory called
 * .snifthumbs. This subdirectory is created in every directory and contains
 * the cached thumbnails of its parent directory. This directory is hidden
 * by the default settings of snif. If an image file is updated, so is the 
 * thumbnail. If an image is removed though, the thumbnail has to be removed
 * manually.
 **/
$cacheThumbnails = true;


/**************  ADVANCED SETTINGS  ****************************************/
/* Usually you won't need to change these, but you may have a look if you  */
/* want snif to do something you think it can't. Maybe there's a setting   */
/* which lets you do it.                                                   */
/***************************************************************************/

/**
 * Set the server name to be reported on generated pages. Use this only if
 * your server reports the wrong name if $_SERVER['HTTP_HOST'] (which is 
 * the default) is used.
 **/
$snifServer = $_SERVER['HTTP_HOST'];
//$snifServer = 'www.yourdomain.com';

/**
 * Set the date and time format used for file modified dates. For the syntax
 * of this string, please refer to http://www.php.net/manual/en/function.date.php
 * DEPRECATED, please use languageStrings instead.
 * @deprecated
 **/
$snifDateFormat = 'd-m-y';

/**
 * Specify which files should be hidden in the file listing using
 * regular expressions. Do not use expression limiters or modifiers.
 * These patterns will be merged with $hiddenFilesWildcards.
 **/
$hiddenFilesRegex = Array();
 
/**
 * Description file, leave blank for no descriptions.
 **/
$useDescriptionsFrom = "descript.ion";

/**
 * Define the string that should be used to separate file names and
 * descriptions in the description files. Defaults to "\t" (tab).
 **/
$separationString = "\t";

/**
 * Use external images instead of built-in ones. If you set this to
 * true, you should specify every value in the $externalIcons array below.
 * If you don't, internal images will be used instead.
 **/
$useExternalImages = true;

/**
 * State the filenames for external file icons. Only used if
 * $useExternalImages == true. Paths are relative to the directory of snif.
 * Icon size should be 16x16 pixels, except where noted otherwise.
 * Use an empty string to use the internally stored image for that icon.
 **/
$externalIcons = Array (
	"archive"	=> "",
	"binary"	=> "",
	"dirup"   => "",
	"folder"	=> "",
	"HTML"		=> "",
	"image"		=> "",
	"text"		=> "",
	"unknown"	=> "",
	"download"	=> "",   // 7x16 pixels
	"asc"		=> "",       // 5x3 pixels
	"music"		=> "http://antoine.santo.fr/play.png",       // 5x3 pixels
	"desc"		=> ""      // 5x3 pixels
);

/**
 * Use an external stylesheet file for setting the colors of the snif output.
 * Have a look at the colors section in the default snif stylesheet for the
 * names of the styles that are used by snif.
 * Set to an empty string to use the built-in stylesheet.
 **/
$externalStylesheet = "";

/**
 * Use an external configuration file. This can be used to configure multiple 
 * installations of snif on the same machine the same way without changing
 * the individual scripts. Should be an absolute path, like "/etc/snif.conf".
 * Set to an empy string to use the settings that are set in this file.
 *
 * Settings are read in the following order: First, the built-in settings
 * of the snif file are read. If $externalConfig is set to a file, this file
 * is include()ed afterwards, overwriting the previous settings. Then, snif
 * begins its work.
 * This means that you can just copy this config section into your config
 * file, set $externalConfig in the snif index file to the config file location,
 * and change the config file according to your needs. If you want to use
 * the default of a particular setting, just delete it from the config file,
 * as the default will be used then.
 * Still unclear? Email me!
 **/
$externalConfig = "";

/**
 * Filenames in description files are case insensitive. If a file in a
 * directory is called MyProgram.ZIP, adding a description line for 
 * myprogram.zip will be used for this file.
 * If you set this to true, filenames in description files and directories
 * must be exactly the same.
 **/
$descriptionFilenamesCaseSensitive = false;

/**
 * If a directory contains more than this number of files, display it on
 * multiple pages. Useful for very large directories. $usePaging sets the
 * number of files displayed per page. Set to 0 to disable multiple pages.
 **/
$usePaging = 0;

/**
 * Make links to directories in a file listing point directly to that
 * directory. Defaults to false. Set this to true if you want to display
 * individual index files for each directory. If you want to display a
 * subdirectory with snif, copy the subdir/index.php from the snif archive
 * to that directory.
 **/
$directDirectoryLinks = false;

/**
 * Sets the maximum size of thumbnails. Images with one dimension bigger than 
 * the respective value will be downsized. Smaller images will stay unchanged.
 * Defaults to 50 height and 150 width.
 **/
$thumbnailHeight = 50;
$thumbnailWidth = 150;

/**
 * Use "back" instead of ".." to go up in directories.
 **/
$useBackForDirUp = true;

/**
 * Determines which columns to display and in which order.
 * To hide a column, delete it from this array. To rearrange columns,
 * change their order in this array.
 * Default value is
 * $displayColumns = Array("download, "icon", "name", "type", "size", "date", "description");
 * Possible values are:
 *   download     a link to download instead of open files
 *   icon         a file icon according to its extension
 *   name         the filename
 *   type         the file extension
 *   size         the file size
 *   date         the file's modified date
 *   description  the file's description, if any
 *   cvsversion   the file's CVS version tag
 **/
$displayColumns = Array(
	"download",
	"icon",
	"name",
	"type",
	"size",
	"date",
	"description"
);

/**
 * Sets the listing to always occupy the whole width of the screen instead of
 * only the necessary space.
 **/
$tableWidth100Percent = false;

/**
 * Turns on and sets fixed width description column. Set to 0 to not restrict
 * description column width.
 * Can lead to strange results when not zero and $tableWidth100Percent==true and
 * does not fully work with IE.
 **/
$descriptionColumnWidth = 0;

/**
 * Specifies how long file and directory names are to be truncated. Defaults
 * to 30, set to 0 to turn off truncation.
 **/
$truncateLength = 30;

/**
 * Specifies whether to hide and forbid access to all directories that contain
 * a .htaccess file. This is to prevent access to directories that are forbidden
 * for normal HTTP access. There is no way for snif to no which directories
 * are forbidden, therefore as .htaccess files are mostly used to restrict
 * access, you may use this directive to forbid access to them through snif.
 **/
$protectDirsWithHtaccess = true;

/**
 * Specifies whether to use automatic translation selection (default) or always
 * use the same language. Set to an empty string to enable automatic selection,
 * or set to a two-character language code.
 * Valid language codes are: de, en, nl, no, pl, sv (for a complete and 
 * up-to-date list, see the $languageStrings array below.
 **/
$alwaysUseLanguage = "";


/***************************************************************************/
/**  TRANSLATIONS                                                         **/
/***************************************************************************/

$languageStrings = Array(
	"en" => Array(
		// only serves as the default language, no translations needed
		// if you don't translate a string, the english version will be used
		
		"Index of" => "", // displayed in the page title
		"name" => "", // column name in the file listing
		"type" => "", // column name in the file listing
		"size" => "", // column name in the file listing
		"date" => "", // column name in the file listing
		"description" => "", // column name in the file listing
		"DATEFORMAT" => $snifDateFormat, // special string, sets the format of the date (see http://www.php.net/manual/en/function.date.php)
		"folder" => "", // a folder in the file listing
		"archive" => "", // an archive file in the file listing
		"image" => "", // an image file in the file listing
		"text" => "", // a text file in the file listing
		"HTML" => "", // an archive file in the file listing
		"unknown" => "", // an unknown file in the file listing
		"valid" => "", // used for "valid XHTML, valid CSS"
		"binary" => "", // a binary file
		"dirup" => "", // tooltip of the .. folder icon
		"download" => "", // tooltip of the download icon to the left
		"asc" => "", // sort in ascending order
		"desc" => "", // sort in descending order
		"[ back ]" => "", // special name displayed for the .. folder
		"1 item" => "", // displayed when a subdirectory contains exactly one file or directory
		"%d items" => "", // 0 items, 42 items; displays the number of files and directories in a subdirectory. Leave %d as it is.
		"%s is not a subdirectory of the current directory." => "", // leave %s as it is, it is replaced by the directory name
		"File not found: %s" => "",  // leave %s as it is, it is replaced by the file name
		"Illegal characters detected in URL, ignoring." => "", // displayed when an URL parameter contains HTML special characters
		"Illegal path specified, ignoring." => "", // displayed when the path URL parameter contains a potentially dangerous path
		"Bytes" => "", // appended to the exact file size in the tooltip ("462 Bytes")
		"B" => "", // abbreviation of Bytes ("462 B")
		"KB" => "", // abbreviation of kilobyte ("12.4 KB")
		"MB" => "", // abbreviation of megabyte ("3.4 MB")
		"GB" => "", // abbreviation of gigabyte ("4.3 GB")
		"TB" => "",  // abbreviation of terabyte ("820 TB")
		"pages" => "", // as in "4 pages"
		"previous" => "", // as in "previous page"
		"next" => "" // as in "next page"
	),
	
	// Brazilian Portuguese translation by Caio Begotti
	"br" => Array(
		"Index of" => "Ãndice de",
		"name" => "nome",
		"type" => "tipo",
		"size" => "tam.",
		"date" => "data",
		"description" => "descriÃ§Ã£o",
		"DATEFORMAT" => "d/m/y",
		"folder" => "diretÃ³rio",
		"archive" => "arquivo",
		"image" => "imagem",
		"text" => "texto",
		"HTML" => "HTML",
		"unknown" => "desconhecido",
		"valid" => "validar",
		"binary" => "binÃ¡rio",
		"dirup" => "subir um nÃ­vel",
		"download" => "download",
		"asc" => "ascendente",
		"desc" => "descendente",
		"[ back ]" => "[ voltar ]",
		"1 item" => "1 item",
		"% items" => "%d itens",
		"%s is not a subdirectory of the current directory." => "%s nÃ£o Ã© um subdiretÃ³rio da localizaÃ§Ã£o atual.",
		"File not found: %s" => "Arquivo nÃ£o encontrado: %s",
		"Illegal characters detected in URL, ignoring." => "Ignorando caracteres ilegais da URL...",
		"Illegal path specified, ignoring." => "Ignorando o caminho ilegal especificado...",
		"Bytes" => "Bytes",
		"B" => "B",
		"KB" => "KB",
		"MB" => "MB",
		"GB" => "GB",
		"TB" => "TB",
		"pages" => "pÃ¡ginas",
		"previous" => "retornar",
		"next" => "avanÃ§ar"
	),
	
	// Czech translation by Jan Pinkas
	"cz" => Array(
		"Index of" => "V�pis", // displayed in the page title
		"name" => "jm�no", // column name in the file listing
		"type" => "typ", // column name in the file listing
		"size" => "velikost", // column name in the file listing
		"date" => "datum", // column name in the file listing
		"description" => "popis", // column name in the file listing
		"DATEFORMAT" => $snifDateFormat, // special string, sets the format of the date (see http://www.php.net/manual/en/function.date.php)
		"folder" => "adres�r", // a folder in the file listing
		"archive" => "archiv", // an archive file in the file listing
		"image" => "obr�zek", // an image file in the file listing
		"text" => "text", // a text file in the file listing
		"HTML" => "html", // an archive file in the file listing
		"unknown" => "nez�m�", // an unknown file in the file listing
		"valid" => "platn�", // used for "valid XHTML, valid CSS"
		"binary" => "bin�rn�", // a binary file
		"dirup" => "nahoru", // tooltip of the .. folder icon
		"download" => "st�hnout", // tooltip of the download icon to the left
		"asc" => "sestupne", // sort in ascending order
		"desc" => "vzestupne", // sort in descending order
		"[ back ]" => "[ zpet ]", // special name displayed for the .. folder
		"1 item" => "1 polo�ka", // displayed when a subdirectory contains exactly one file or directory
		"%d items" => "%d polo�ky", // 0 items, 42 items; displays the number of files and directories in a subdirectory. Leave %d as it is.
		"%s is not a subdirectory of the current directory." => "%s nen� podares�r toho adres�re", // leave %s as it is, it is replaced by the directory name
		"File not found: %s" => "Soubor nenalezen: %s",  // leave %s as it is, it is replaced by the file name
		"Illegal characters detected in URL, ignoring." => "Neplatn� znaky v URL, preskakuju", // displayed when an URL parameter contains HTML special characters
		"Illegal path specified, ignoring." => "Neplatn� cesta, ignoruju", // displayed when the path URL parameter contains a potentially dangerous path
		"Bytes" => "Bajtu", // appended to the exact file size in the tooltip ("462 Bytes")
		"B" => "B", // abbreviation of Bytes ("462 B")
		"KB" => "KB", // abbreviation of kilobyte ("12.4 KB")
		"MB" => "MB", // abbreviation of megabyte ("3.4 MB")
		"GB" => "GB", // abbreviation of gigabyte ("4.3 GB")
		"TB" => "TB",  // abbreviation of terabyte ("820 TB")
		"pages" => "str�nky", // as in "4 pages"
		"previous" => "predchoz�", // as in "previous page"
		"next" => "n�sleduj�c�" // as in "next page"
	),
 	
	"de" => Array(
		"Index of" => "Inhalt von",
		"name" => "Name",
		"type" => "Typ",
		"size" => "Größe",
		"date" => "Datum",
		"DATEFORMAT" => "d.m.y", // special string, sets the format of the date (see http://www.php.net/manual/en/function.date.php)
		"description" => "Beschreibung",
		"folder" => "Verzeichnis",
		"archive" => "Archiv",
		"image" => "Bild",
		"text" => "Text-Datei",
		"HTML" => "HTML-Datei",
		"unknown" => "unbekannt",
		"valid" => "gültiges",
		"binary" => "Binärdatei",
		"dirup" => "Aufwärts",
		"download" => "Download",
		"asc" => "aufsteigend",
		"desc" => "absteigend",
		"[ back ]" => "[ aufwärts ]",
		"1 item" => "1 Eintrag",
		"%d items" => "%d Einträge",
		"%s is not a subdirectory of the current directory." => "%s ist kein Unterverzeichnis des momentanen Verzeichnisses.",
		"File not found: %s" => "Die Datei '%s' wurde konnte nicht gefunden werden.",
		"Illegal characters detected in URL, ignoring." => "Ungültige Zeichen in der URL wurden ignoriert.",
		"Illegal path specified, ignoring." => "Ein ungültiger Pfad in einem Parameter wurde bereinigt.",
		"Bytes" => "Bytes",
		"B" => "",
		"KB" => "",
		"MB" => "",
		"GB" => "",
		"TB" => "",
		"pages" => "Seiten",
		"previous" => "vorherige",
		"next" => "nächste"
	),

	// Danish translation by Svend Rugaard
	"dk" => Array(
		"Index of" => "Indholdet i ",
		"name" => "Navn",
		"type" => "Type",
		"size" => "strrelse",
		"date" => "Dato",
		"description" => "Beskrivelse",
		"DATEFORMAT" => "d-m-y",
		"folder" => "mappe",
		"archive" => "arkiv",
		"image" => "billede",
		"text" => "tekst",
		"HTML" => "HTML Dato",
		"unknown" => "Ukendt",
		"valid" => "Korrekt",
		"binary" => "Bionr",
		"dirup" => "En mappe tilbage",
		"download" => "Download",
		"asc" => "Vilkrlig Rkkeflge",
		"desc" => "Uvilkrlig",
		"[ back ]" => "[ Tilbage ]",
		"1 item" => "1 fil",
		"%d items" => "%d filer",
		"%s is not a subdirectory of the current directory." => "%s er ikke en undermappe, af nuvrende mappe",
		"File not found: %s" => "Filen er ikke fundet",
		"Illegal characters detected in URL, ignoring." => "Forkerte karakter opdaget i URL, Ignoreret ", 
		"Illegal path specified, ignoring." => "Forkert mappe navn valgt, ignoreres",
		"Bytes" => "Bytes", 
		"B" => "Bytes",
		"KB" => "Kilobytes",
		"MB" => "Megabytes",
		"GB" => "Gigabytes",
		"TB" => "Terabytes",
		"pages" => "Sider",
		"previous" => "Forrige",
		"next" => "Nste"
	),
	
	// Spanish translation by Martinp and Genaro Paez
	"es" => Array(
		"Index of" => "Indice de",
		"name" => "nombre", 
		"type" => "tipo", 
		"size" => "tama&ntilde;o", 
		"date" => "fecha", 
		"description" => "Descripci&oacute;n", 
		"DATEFORMAT" => $snifDateFormat, 
		"folder" => "directorio", 
		"archive" => "archivo", 
		"image" => "imagen", 
		"text" => "texto", 
		"HTML" => "HTML", 
		"unknown" => "desconocido", 
		"valid" => "valido", 
		"binary" => "binario", 
		"dirup" => "subir directorio", 
		"download" => "descargar", 
		"asc" => "ascendente", 
		"desc" => "descendente", 
		"[ back ]" => "[ atras ]", 
		"1 item" => "1 objeto", 
		"%d items" => "%d objetos", 
		"%s is not a subdirectory of the current directory." => "%s no es un subdirectorio del directorio actual.", 
		"File not found: %s" => "Archivo no encontrado: %s", 
		"Illegal characters detected in URL, ignoring." => "Caract&eacute;res ilegales en la URL ha sido ignorados.",
		"Illegal path specified, ignoring." => "Ruta ilegal especificada ha sido ignorada", 
		"Bytes" => "", 
		"B" => "B",
		"KB" => "KB",
		"MB" => "MB",
		"GB" => "GB",
		"TB" => "TB",
		"pages" => "p&aacute;ginas",
		"previous" => "anterior",
		"next" => "siguiente"
	),
	
	// French translation by Marc Nadeau
	"fr" => Array(
		"Index of" => "Index de",
		"name" => "nom",
		"type" => "type",
		"size" => "taille",
		"date" => "date",
		"description" => "description",
		"DATEFORMAT" => "d-m-y",
		"folder" => "r&eacute;pertoire",
		"archive" => "archive",
		"image" => "image",
		"text" => "texte",
		"HTML" => "HTML",
		"unknown" => "inconnu",
		"valid" => "valide",
		"binary" => "binaire",
		"dirup" => "niveau sup&eacute;rieur",
		"download" => "t&eacute;l&eacute;charger",
		"asc" => "asc",
		"desc" => "desc",
		"[ back ]" => "[ niveau sup&eacute;rieur ]",
		"1 item" => "1 item",
		"%d items" => "%d items",
		"%s is not a subdirectory of the current directory." => "%s n 'est pas un sous-r&eacute;pertoire du r&eacute;pertoire courant",
		"File not found: %s" => "Fichier non trouv.: %s",
		"Illegal characters detected in URL, ignoring." => "Caractre ill&eacute;gal dans l'url, ignor&eacute;.",
		"Illegal path specified, ignoring." => "Chemin d'accs ill&eacute;gal, ignor&eacute;.",
		"Bytes" => "bytes",
		"B" => "b",
		"KB" => "Kb",
		"MB" => "Mb",
		"GB" => "Gb",
		"TB" => "Tb",
		"pages" => "pages",
		"previous" => "pr&eacute;c&eacute;dente",
		"next" => "suivante"
	),
	
	// Greek translation by George Yiftoyiannis
	"gr" => Array( 
		"Index of" => "Περιεχόμενα του", // 
		"name" => "όνομα", //  
		"type" => "τύπος", //  
		"size" => "μέγεθος", // 
		"date" => "ημερομηνία", //  
		"description" => "περιγραφή", // 
		"DATEFORMAT" => "d-m-y", //  
		"folder" => "φάκελος", // 
		"archive" => "αρχείο", // 
		"image" => "εικόνα", // 
		"text" => "κείμενο", // 
		"HTML" => "HTML", // 
		"unknown" => "άγνωστο", // *
		"valid" => "έγκυρη", //  *
		"binary" => "δυαδικό", // *
		"dirup" => "ένα επίπεδο επάνω", // 
		"download" => "κατέβασμα", //  
		"asc" => "αύξ", // *
		"desc" => "φθίν", // *
		"[ back ]" => "[ πίσω ]", //  
		"1 item" => "1 αντικείμενο", //  
		"%d items" => "%d αντικείμενα", //  
		"%s is not a subdirectory of the current directory." => "Το %s δεν είναι υποκατάλογος του τρέχοντος καταλόγου", // 
		"File not found: %s" => "Το αρχείο δεν βρέθηκε:%s",  // 
		"Illegal characters detected in URL, ignoring." => "Μη επιτρεπτοί χαρακτήρες βρέθηκαν στο URL και θ' αγνοηθούν.", // *
		"Illegal path specified, ignoring." => "Μη επιτρεπτή διαδρομή καταλόγου. Αγνοήθηκε.", // *
		"Bytes" => "Bytes", // 
		"B" => "B", // 
		"KB" => "KB", // 
		"MB" => "MB", // 
		"GB" => "GB", // 
		"TB" => "TB",  //  
		"pages" => "σελίδες", // *
		"previous" => "προηγούμενη", // *
		"next" => "επόμενη" // *
	), 
	
	// Hungarian language settings. v1.0, 2004.06.15, funk.gabor@hunetkft.hu
	"hu" => Array(
		"Index of" => "Könyvtár:",
		"name" => "név",
		"type" => "típus",
		"size" => "méret",
		"date" => "dátum",
		"description" => "leírás",
		"DATEFORMAT" => "y-m-d",
		"folder" => "alkönyvtár",
		"archive" => "archívum",
		"image" => "kép",
		"text" => "szöveg",
		"HTML" => "html",
		"unknown" => "ismeretlen",
		"valid" => "érvényes",
		"binary" => "bináris",
		"dirup" => "vissza a szülõkönyvtárba",
		"download" => "letöltés",
		"asc" => "növekvõ",
		"desc" => "csökkenõ",
		"[ back ]" => "[..]",
		"1 item" => "1 fájl",
		"%d items" => "%d fájl",
		"%s is not a subdirectory of the current directory." => "%d nem alkönyvtár",
		"File not found: %s" => "Fájl nem található",
		"Illegal characters detected in URL, ignoring." => "Érvénytelen karakterek az URL-ben, kihagyva.",
		"Illegal path specified, ignoring." => "Érvénytelen útvonalspecifikáció, kihagyva.",
		"Bytes" => "Bájt",
		"B" => "",
		"KB" => "",
		"MB" => "",
		"GB" => "",
		"TB" => "",
		"pages" => "oldal",
		"previous" => "elõzõ",
		"next" => "következõ"
	),
	
	// Italian translation by Luca Soltoggio
	"it" => Array(
		"Index of" => "Contenuto di",
		"name" => "nome",
		"type" => "tipo",
		"size" => "dimensione",
		"date" => "data",
		"description" => "descrizione",
		"DATEFORMAT" => "d-m-y",
		"folder" => "cartella",
		"archive" => "archivio",
		"image" => "immagine",
		"text" => "testo",
		"HTML" => "HTML",
		"unknown" => "sconosciuto",
		"valid" => "valido",
		"binary" => "binario",
		"dirup" => "directory superiore",
		"download" => "download",
		"asc" => "ascendente",
		"desc" => "discendente",
		"[ back ]" => "[ indietro ]",
		"1 item" => "1 oggetto",
		"%d items" => "%d oggetti",
		"%s is not a subdirectory of the current directory." => "%s non &egrave una sottocartella della cartella corrente.",
		"File not found: %s" => "File non trovato: %s",
		"Illegal characters detected in URL, ignoring." => "Caratteri non validi nell'URL ignorati.",
		"Illegal path specified, ignoring." => "Percorso specificato non valido ignorato.",
		"Bytes" => "Bytes", 
		"B" => "Bytes",
		"KB" => "KB",
		"MB" => "MB",
		"GB" => "GB",
		"TB" => "TB",
		"pages" => "pagine",
		"previous" => "precedente",
		"next" => "seguente"
  ),
	
	// Japanese translation by hjbdnpmo Version 20040624
	"jp" => Array(
		"Index of" => "Index of",
		"name" => "ネーム",
		"type" => "タイプ",
		"size" => "サイズ",
		"date" => "日付",
		"description" => "記述",
		"DATEFORMAT" => "y/m/d",
		"folder" => "ディレクトリ",
		"archive" => "アーカイブ",
		"image" => "イメージ",
		"text" => "テキスト",
		"HTML" => "HTML",
		"unknown" => "不明",
		"valid" => "valid",
		"binary" => "バイナリ",
		"dirup" => "上のディレクトリへ移動",
		"download" => "ダウンロード",
		"asc" => "昇順でソート",
		"desc" => "降順でソート",
		"[ back ]" => "[ 戻る ]",
		"1 item" => "1 アイテム",
		"%d items" => "%d アイテム",
		"%s is not a subdirectory of the current directory." => "%sはカレントディレクトリのサブディレクトリではありません。",
		"File not found: %s" => "ファイルが見つかりません: %s",
		"Illegal characters detected in URL, ignoring." => "URLに不正な文字が検出されました、無視します。",
		"Illegal path specified, ignoring." => "不正なパスが指定されました、無視します。",
		"Bytes" => "Bytes",
		"B" => "Bytes",
		"KB" => "KB",
		"MB" => "MB",
		"GB" => "GB",
		"TB" => "TB",
		"pages" => "ページ",
		"previous" => "前へ",
		"next" => "次へ"
	),
	
	// dutch translation by Rogier van Epen
	"nl" => Array(
		"Index of" => "Inhoud van",
		"name" => "Naam",
		"type" => "Type",
		"size" => "Grootte",
		"date" => "Datum",
		"DATEFORMAT" => "d.m.y",
		"description" => "Beschrijving",
		"folder" => "Map",
		"archive" => "Archief",
		"image" => "Beeld",
		"text" => "Text",
		"HTML" => "HTML",
		"unknown" => "Onbekend",
		"valid" => "Geldig",
		"binary" => "Binary",
		"dirup" => "Onderliggende map",
		"download" => "Download",
		"asc" => "Oplopend",
		"desc" => "Aflopend",
		"[ back ]" => "[ Terug ]",
		"1 item" => "1 Onderdeel",
		"%d items" => "%d Onderdelen",
		"%s is not a subdirectory of the current directory." => "%s is geen submap van de huidige map.",
		"File not found: %s" => "Het bestand '%s' kon niet gevonden worden.",
		"Illegal characters detected in URL, ignoring." => "Ongeldige karakters gevonden in de URL, deze worden genegeerd.",
		"Illegal path specified, ignoring." => "Ongeldige locatie, deze locatie zal worden genegeerd.",
		"Bytes" => "",
		"B" => "",
		"KB" => "",
		"MB" => "",
		"GB" => "",
		"TB" => "",
		"pages" => "",
		"previous" => "",
		"next" => ""
	),

	// Norwegian translation by Kyrre Liaaen
	"no" => Array(
 		"Index of" => "Innholdet i",
 		"name" => "navn",
 		"type" => "type",
 		"size" => "st&oslash;rrelse",
 		"date" => "dato",
 		"description" => "beskrivelse",
 		"DATEFORMAT" => "d-m-y",
 		"folder" => "mappe",
 		"archive" => "arkiv",
 		"image" => "bilde",
 		"text" => "tekst",
 		"HTML" => "HTML",
 		"unknown" => "ukjent",
 		"valid" => "gyldig",
 		"binary" => "bin&aelig;r",
 		"dirup" => "opp en mappe",
 		"download" => "last ned",
 		"asc" => "stigende",
 		"desc" => "synkende",
 		"[ back ]" => "[ tilbake ]",
 		"1 item" => "1 enhet",
 		"%d items" => "%d enheter",
 		"%s is not a subdirectory of the current directory." => "%s er ikke en mappe underlagt denne mappen",
 		"File not found: %s" => "Kan ikke finne filen: %s",
 		"Illegal characters detected in URL, ignoring." => "Ugyldige tegn er funnet i URL'en, utelater.",
 		"Illegal path specified, ignoring." => "Ugyldig sti opgitt, utelater.",
		"Bytes" => "octets",
		"B" => "",
		"KB" => "",
		"MB" => "",
		"GB" => "",
		"TB" => "", 
		"pages" => "sider", 
		"previous" => "forrige side",
		"next" => "neste side"
	),
	
	// Polish translation by Slawomir Jucht
	"pl" => Array(
		"Index of" => "Zawarto",
		"name" => "Nazwa",
		"type" => "Typ",
		"size" => "Rozmiar",
		"date" => "Data",
		"description" => "Miniatura",
		"DATEFORMAT" => "d-m-Y",
		"folder" => "Katalog",
		"archive" => "Archiwum",
		"image" => "Zobacz",
		"text" => "Tekst",
		"HTML" => "HTML",
		"unknown" => "Nieznany",
		"valid" => "Odpowiedni",
		"binary" => "Binarium",
		"dirup" => "Do gry",
		"download" => "Pobierz",
		"asc" => "ASCI",
		"desc" => "Opis",
		"[ back ]" => "[ Wstecz ]",
		"1 item" => "1 plik",
		"%d items" => "%d plikw",
		"%s is not a subdirectory of the current directory." => "%s nie jest podkatalogiem biecego katalogu.",
		"File not found: %s" => "Plik nie znaleziony: %s",
		"Illegal characters detected in URL, ignoring." => "Wystpi niepoprawny znak w kodzie HTML - zignorowany.",
		"Illegal path specified, ignoring." => "Niepoprawna cieka - zignorowana."
	),
	
// Russian translation by Neptune
	"ru" => Array(
		"Index of" => "Содержимое",
		"name" => "Имя",
		"type" => "Тип",
		"size" => "Размер",
		"date" => "Дата",
		"description" => "Описание",
		"DATEFORMAT" => "d.m.y",
		"folder" => "директория",
		"archive" => "архив",
		"image" => "изображение",
		"text" => "текст",
		"HTML" => "HTML",
		"unknown" => "неизвестно",
		"valid" => "valid",		// No good translation
		"binary" => "бинарный",
		"dirup" => "Вверх",
		"download" => "Скачать",
		"asc" => "возрастание",
		"desc" => "убывание",
		"[ back ]" => "[ назад ]",
		"1 item" => "1 элемент",
		"%d items" => "элементов: %d",   // Would be great to increase column width a bit.
						// This format is used due to "4 items and 5 items" is not the same word in russian.
		"%s is not a subdirectory of the current directory." => "%s не найдена в текущей директории.",
		"File not found: %s" => "Файл не найден: %s",
		"Illegal characters detected in URL, ignoring." => "Неверные символы в URL, игнорируется.",
		"Illegal path specified, ignoring." => "Указан неверный путь, игнорируется.",
		"Bytes" => "байт",
		"B" => "B",
		"KB" => "kB",
		"MB" => "MB",
		"GB" => "GB",
		"TB" => "TB",
		"pages" => "страница", 
		"previous" => "предыдущая",
		"next" => "следующая"
	),
	
	// Swedish translation by Elias Hedberg
	"sv" => Array( 
		"Index of" => "F&ouml;rteckning &ouml;ver",
		"name" => "namn",
		"type" => "typ",
		"size" => "storlek",
		"date" => "datum",
		"DATEFORMAT" => "y-m-d",
		"description" => "beskrivning",
		"folder" => "mapp",
		"archive" => "arkiv",
		"image" => "bild",
		"text" => "textfil",
		"HTML" => "HTML-fil",
		"unknown" => "ok&auml;nd",
		"valid" => "giltig",
		"binary" => "bin&auml;rfil",
		"dirup" => "upp&aring;t",
		"download" => "ladda ned",
		"asc" => "stigande",
		"desc" => "fallande",
		"[ back ]" => "[ bak&aring;t ]",
		"1 item" => 
		"1 objekt",
		"%d items" => "%d objekt",
		"%s is not a subdirectory of the current directory." => "%s &auml;r inte en undermapp till aktuell mapp.",
		"File not found: %s" => "Filen '%s' hittades inte.",
		"Illegal characters detected in URL, ignoring." => "Ogiltiga tecken i URL:en, de ignoreras.",
		"Illegal path specified, ignoring." => "Ogiltig s&ouml;kv&auml;g angiven, ignoreras.",
		"Bytes" => "byte",
		"B" => "B",
		"KB" => "kB",
		"MB" => "MB",
		"GB" => "GB",
		"TB" => "TB",
		"pages" => "sidor", // as in "4 pages"
		// (if you'd ever need the singular it's "page" => "sida",
		// which works in both "page 2 of 4" (where "of" => "av")
		// and in "1 page")
		"previous" => "f&ouml;reg&aring;ende",
		"next" => "n&auml;sta"
	)
);




/***************************************************************************/
/**  REAL CODE STARTS HERE, NO NEED TO CHANGE ANYTHING                    **/
/***************************************************************************/


/***************************************************************************/
/**  TRANSLATION                                                          **/
/***************************************************************************/

function translate($string) {
	GLOBAL $languageStrings, $alwaysUseLanguage;
	static $requestLanguage;
	
	if ($requestLanguage=="") {
		$validLanguages = array_keys($languageStrings);
		if ($alwaysUseLanguage!="" && in_array($alwaysUseLanguage, $validLanguages)) {
			$requestLanguage = $alwaysUseLanguage;
		} else {
			if ($requestLanguage == "") {
				$acceptLanguages = explode(",", $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
				for ($i=0; $i<count($acceptLanguages) AND $requestLanguage==""; $i++) {
					$al = substr($acceptLanguages[$i],0,2);
					if (in_Array($al,$validLanguages)) {
						$requestLanguage = $al;
					}
				}
				if ($requestLanguage=="") {
					$requestLanguage = $validLanguages[0];
				}
			}
		}
	}
	
	$stringTranslated = $languageStrings[$requestLanguage][$string];
	if ($stringTranslated!="") {
		return $stringTranslated;
	} else {
		return $string;
	}
}


/***************************************************************************/
/**  INITIALIZATION                                                       **/
/***************************************************************************/

// make sure all the notices don't come up in some configurations
error_reporting (E_ALL ^ E_NOTICE);

$displayError = Array();

// safify all GET variables
foreach($_GET AS $key => $value) {
	$_GET[$key] = strip_tags($value);
	if ($_GET[$key] != $value) {
		$displayError[] = translate("Illegal characters detected in URL, ignoring.");
	}
	if (!get_magic_quotes_gpc()) {
		$_GET[$key] = stripslashes($value);
	}
}


// read external config file
if ($externalConfig!="") {
	include($externalConfig);
}


// first of all, security: prevent any unauthorized paths
// if sub directories are forbidden, ignore any path setting
if (!$allowSubDirs) {
	$path = "";
} else {
	$path = $_GET["path"];
	
	// ignore any potentially malicious paths
	$path = safeDirectory($path);
}

// default sorting is by name
if ($_GET["sort"]=="") 
	$_GET["sort"] = "name";

// default order is ascending
if ($_GET["order"]=="") {
	$_GET["order"] = "asc";
} else {
	$_GET["order"] = strtolower($_GET["order"]);
}

// hide descriptions column if no description file is specified
if ($useDescriptionsFrom=="") {
	$index = array_search("description", $displayColumns);
	if ($index!==false && $index!==null) {
		unset($displayColumns[$index]);
	}
}
	
// add files used by snif to hidden file list
if ($useDescriptionsFrom!="") {
	$hiddenFilesWildcards[] = $useDescriptionsFrom;
}
if ($externalStylesheet!="") {
	$hiddenFilesWildcards[] = $externalStylesheet;
}
$hiddenFilesWildcards[] = ".";
$hiddenFilesWildcards[] = basename($_SERVER["PHP_SELF"]);

// build hidden files regular expression
for ($i=0;$i<count($hiddenFilesWildcards);$i++) {
	$translate = Array(
		"." => "\\.",
		"*" => ".*",
		"?" => ".?",
		"+" => "\\+",
		"[" => "\\[",
		"]" => "\\]",
		"(" => "\\(",
		")" => "\\)",
		"{" => "\\{",
		"}" => "\\}",
		"^" => "\\^",
		"\$" => "\\\$",
		"\\" => "\\\\",
	);
	$hiddenFilesRegex[] = "^".strtr($hiddenFilesWildcards[$i],$translate)."$";
}
// hide .*
$hiddenFilesRegex[] = "^\\.[^.].*$";
$hiddenFilesWholeRegex = "/".join("|",$hiddenFilesRegex)."/i";



/***************************************************************************/
/**  REQUEST HANDLING                                                     **/
/***************************************************************************/

// handle image requests
if ($_GET["getimage"]!="") {
	$imagesEncoded = Array(
		"archive"  => "R0lGODlhEAAQAJECAAAAAP///////wAAACH5BAEAAAIALAAAAAAQABAAAAI3lA+pxxgfUhNKPRAbhimu2kXiRUGeFwIlN47qdlnuarokbG46nV937UO9gDMHsMLAcSYU0GJSAAA7",
		"asc"      => "R0lGODlhBQADAIABAN3d3f///yH5BAEAAAEALAAAAAAFAAMAAAIFTGAHuF0AOw==",
		"binary"   => "R0lGODlhEAAQAJECAAAAAP///////wAAACH5BAEAAAIALAAAAAAQABAAAAI0lICZxgYBY0DNyfhAfROrxoVQBo5mpzFih5bsFLoX5iLYWK6xyur5ubPAbhPZrKhSKCmCAgA7",
		"desc"     => "R0lGODlhBQADAIABAN3d3f///yH5BAEAAAEALAAAAAAFAAMAAAIFhB0XC1sAOw==",
		"dirup"    => "R0lGODlhEAAQAJECAAAAAP///////wAAACH5BAEAAAIALAAAAAAQABAAAAIulI+JwKAJggzuiThl2wbnT3WZN4oaA1bYRobXCLpkq5nnVr9xqe85C2xYhkRFAQA7",
		"folder"   => "R0lGODlhEAAQAJECAAAAAP///////wAAACH5BAEAAAIALAAAAAAQABAAAAIplI+JwKAJggzuiThl2wbnT3UgWHmjJp5Tqa5py7bhJc/mWW46Z/V+UgAAOw==",
		"HTML"     => "R0lGODlhEAAQAKIHABsb/2ho/4CA/0BA/zY2/wAAAP///////yH5BAEAAAcALAAAAAAQABAAAANEeFfcrVAVQ6thUdo6S57b9UBgSHmkyUWlMAzCmlKxAZ9s5Q5AjWqGwIAS8OVsNYJxJgDwXrHfQoVLEa7Y6+Wokjq+owQAOw==",
		"image"    => "R0lGODlhEAAQAKIEAK6urmRkZAAAAP///////wAAAAAAAAAAACH5BAEAAAQALAAAAAAQABAAAANCSCTcrVCJQetgUdo6RZ7b9UBgSHnkAKwscEZTy74pG9zuBavA7dOanu+H0gyGxN0RGdClKEjgwvKTlkzFhWOLISQAADs=",
		"text"     => "R0lGODlhEAAQAJECAAAAAP///////wAAACH5BAEAAAIALAAAAAAQABAAAAI0lICZxgYBY0DNyfhAfXcuxnWQBnoKMjXZ6qUlFroWLJHzGNtHnat87cOhRkGRbGc8npakAgA7",
		"download" => "R0lGODlhBwAQAIABAAAAAP///yH5BAEAAAEALAAAAAAHABAAAAISjI+pywb6UkQzgHsPls3h2gUFADs=",
		"blank"    => "R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==",
		"unknown"  => "R0lGODlhEAAQAJECAAAAAP///////wAAACH5BAEAAAIALAAAAAAQABAAAAI1lICZxgYBY0DNyfhAfXcuxnkI1nCjB2lgappld6qWdE4vFtprR+4sffv1ZjwdkSc7KJYUQQEAOw==",
		"music"  => "R0lGODlhEAAQAJECAAAAAP///////wAAACH5BAEAAAIALAAAAAAQABAAAAI1lICZxgYBY0DNyfhAfXcuxnkI1nCjB2lgappld6qWdE4vFtprR+4sffv1ZjwdkSc7KJYUQQEAOw=="
	);
	$imageDataEnc = $imagesEncoded[$_GET["getimage"]];
	if ($imageDataEnc) {
		$maxAge = 31536000; // one year
		doConditionalGet($_GET["getimage"], gmmktime(1,0,0,1,1,2004));
		$imageDataRaw = base64_decode($imageDataEnc);
		Header("Content-Type: image/gif");
		Header("Content-Length: ".strlen($imageDataRaw));
		Header("Cache-Control: public, max-age=$maxAge, must-revalidate");
		Header("Expires: ".createHTTPDate(time()+$maxAge));
		echo $imageDataRaw;
	}
	
	die();
}

// handle thumbnail creation
if ($_GET["thumbnail"]!="") {
	GLOBAL $thumbnailHeight, $cacheThumbnails;
	$thumbnailCacheSubdir = ".snifthumbs";
	
	$file = safeDirectory(urldecode($_GET["thumbnail"]));
	doConditionalGet($_GET["thumbnail"],filemtime($file));

	$thumbDir = dirname($file)."/".$thumbnailCacheSubdir;
	$thumbFile = $thumbDir."/".basename($file);
	if ($cacheThumbnails) {
		if (file_exists($thumbDir)) {
			if (!is_dir($thumbDir)) {
				$cacheThumbnails = false;
			}
		} else {
			if (@mkdir($thumbDir)) {
				chmod($thumbDir, "0777");
			} else {
				$cacheThumbnails = false;
			}
		}
		if (file_exists($thumbFile)) {
			if (filemtime($thumbFile)>=filemtime($file)) {
				Header("Location: ".dirname($_SERVER["PHP_SELF"])."/".$thumbFile);
				die();
			}
		}
	}
	$contentType = "";
	$extension = strtolower(substr(strrchr($file, "."), 1));
	switch ($extension) {
		case "gif":		$src = imagecreatefromgif($file); $contentType="image/gif"; break;
		case "jpg":		// fall through
		case "jpeg":	$src = imagecreatefromjpeg($file); $contentType="image/jpeg"; break;
		case "png":		$src = imagecreatefrompng($file); $contentType="image/png"; break;
		default:	die(); break;
	}
	$srcWidth = imagesx($src);
	$srcHeight = imagesy($src);
	$srcAspectRatio = $srcWidth / $srcHeight;
	
	$maxAge = 3600; // one hour
	Header("Cache-Control: public, max-age=$maxAge, must-revalidate");
	Header("Expires: ".createHTTPDate(time()+$maxAge));

	if ($srcHeight<=$thumbnailHeight AND $srcWidth<=$thumbnailWidth) {
		Header("Content-Type: $contentType");
		readfile($file);
	} else {
		if ($srcWidth > $srcHeight) {
			$thumbWidth = $thumbnailWidth;
			$thumbHeight = $thumbWidth / $srcAspectRatio;
		} else {
			$thumbHeight = $thumbnailHeight;
			$thumbWidth = $thumbHeight * $srcAspectRatio;
		}
		if (function_exists('imagecreatetruecolor')) {
			$thumb = imagecreatetruecolor($thumbWidth, $thumbHeight);
		} else {
			$thumb = imagecreate($thumbWidth, $thumbHeight);
		} 
		imagecopyresampled($thumb, $src, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $srcWidth, $srcHeight);
		Header("Content-Type: image/jpeg");
		if ($cacheThumbnails) {
			imagejpeg($thumb, $thumbFile);
			chmod($thumbFile, "0777");
			readfile($thumbFile);
		} else {
			imagejpeg($thumb);
		}
	}
	die();
}

// handle download requests
if ($_GET["download"]!="") {
	$download = stripslashes($_GET["download"]);
	$filename = safeDirectory($path.rawurldecode($download));
	if (
		!file_exists($filename)
		OR fileIsHidden($filename)
		OR (substr(strtolower($filename), -4)==".php" AND !$allowPHPDownloads)) {
		
		Header("HTTP/1.0 404 Not Found");
		$displayError[] = sprintf(translate("File not found: %s"), $filename);
	} else {
		//doConditionalGet($filename, filemtime($filename));
		Header("Content-Length: ".filesize($filename));
		Header("Content-Type: application/x-download");
		Header("Content-Disposition: attachment; filename=\"".rawurlencode($download)."\"");
		readfile($filename);
		die();
	}
}



/***************************************************************************/
/**  FUNCTIONS                                                            **/
/***************************************************************************/

// create a HTTP conform date
function createHTTPDate($time) {
	return gmdate("D, d M Y H:i:s", $time)." GMT";
}


// this function is from http://simon.incutio.com/archive/2003/04/23/conditionalGet
function doConditionalGet($file, $timestamp) {
	$last_modified = createHTTPDate($timestamp);
	$etag = '"'.md5($file.$last_modified).'"';
	// Send the headers
	Header("Last-Modified: $last_modified");
	Header("ETag: $etag");
	// See if the client has provided the required headers
	$if_modified_since = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ?
		stripslashes($_SERVER['HTTP_IF_MODIFIED_SINCE']) :
		false;
	$if_none_match = isset($_SERVER['HTTP_IF_NONE_MATCH']) ?
		stripslashes($_SERVER['HTTP_IF_NONE_MATCH']) : 
		false;
	if (!$if_modified_since && !$if_none_match) {
		return;
	}
	// At least one of the headers is there - check them
	if ($if_none_match && $if_none_match != $etag) {
		return; // etag is there but doesn't match
	}
	if ($if_modified_since && $if_modified_since != $last_modified) {
		return; // if-modified-since is there but doesn't match
	}
	// Nothing has changed since their last request - serve a 304 and exit
	Header('HTTP/1.0 304 Not Modified');
	die();
}


function safeDirectory($path) {
	GLOBAL $displayError;
	$result = $path;
	if (strpos($path,"..")!==false)
		$result = "";
	if (substr($path,0,1)=="/") {
		$result = "";
	}
	if ($result!=$path) {
		$displayError[] = translate("Illegal path specified, ignoring.");
	}
	return $result;
}


/**
 * Formats a file's size nicely (750 B, 3.4 KB etc.)
 **/
function niceSize($size) {
	define("SIZESTEP", 1024.0);
	static $sizeUnits = Array();
	if (count($sizeUnits)==0) {
		$sizeUnits[] = "&nbsp;".translate("B");
		$sizeUnits[] = translate("KB");
		$sizeUnits[] = translate("MB");
		$sizeUnits[] = translate("GB");
		$sizeUnits[] = translate("TB");
	}
	
	if ($size==="")
		return "";
	
	$unitIndex = 0;
	while ($size>SIZESTEP) {
		$size = $size / SIZESTEP;
		$unitIndex++;
	}
	
	if ($unitIndex==0) {
		return number_format($size, 0)."&nbsp;".$sizeUnits[$unitIndex];
	} else {
		return number_format($size, 1, ".", ",")."&nbsp;".$sizeUnits[$unitIndex];
	}
}

/**
 * Compare two strings or numbers. Return values as strcmp().
 **/
function myCompare($arrA, $arrB, $caseSensitive=false) {
	$a = $arrA[$_GET["sort"]];
	$b = $arrB[$_GET["sort"]];
	
	// sort .. first
	if ($arrA["isBack"]) return -1;
	if ($arrB["isBack"]) return 1;
	// sort directories above everything else
	if ($arrA["isDirectory"]!=$arrB["isDirectory"]) {
		$result = $arrB["isDirectory"]-$arrA["isDirectory"];
	} else if ($arrA["isDirectory"] && $arrB["isDirectory"] && ($_GET["sort"]=="type" || $_GET["sort"]=="size")) {
		$result = 0;
	} else {
		if (is_string($a) OR is_string($b)) {
			if (!$caseSensitive) {
				$a = strtoupper($a);
				$b = strtoupper($b);
			}
			$result = strcoll($a,$b);
		} else {
			$result = $a-$b;
		}
	}
	
	if (strtolower($_GET["order"])=="desc") {
		return -$result;
	} else {
		return $result;
	}
}


/**
 * URLEncodes some characters in a string. PHP's urlencode and rawurlencode
 * produce very unsatisfying results for special and reserved characters in
 * filenames.
 **/
function myEncode($path, $filename) {
	// % must be the first, as it is the escape character
	/*
	$from = Array("%"," ","#","&");
	$to = Array("%25","%20","%23","%26");
	return str_replace($from, $to, $string);
	*/
	return $path.rawurlencode($filename);
}


/**
 * Build a URL using new sorting settings.
 **/
function getNewSortURL($newSort) {
	GLOBAL $path;
	$base = $_SERVER["PHP_SELF"];
	$url = $base."?sort=$newSort";
	if ($newSort==$_GET["sort"]) {
		if ($_GET["order"]=="asc" OR $_GET["order"]=="") {
			$url.= "&amp;order=desc";
		}
	}
	if ($path!="") {
		$url.= "&amp;path=$path";
	}
	return $url;
}

/**
 * Determine a file's file type based on its extension.
 **/
function getFileType($fileInfo) {
	// put any additional extensions in here
	$extension = $fileInfo["type"];
	static $fileTypes = Array(
		"HTML"		=> Array("html","htm"),
		"image"		=> Array("gif","jpg","jpeg","png","tif","tiff","bmp","art"),
		"text"		=> Array("asp","c","cfg","cpp","css","csv","conf","cue","diz","h","inf","ini","java","js","log","nfo","php","phps","pl","py","rdf","rss","rtf","sql","txt","vbs","xml"),
		//"code"		=> Array("asp","c","cpp","h","java","js","php","phps","pl","py","sql","vbs"),
		//"xml"			=> Array("rdf","rss","xml"),
		"binary"	=> Array("asf","au","avi","bin","class","divx","doc","exe","mov","mpg","mpeg","ogg","ogm","pdf","ppt","ps","rm","swf","wmf","wmv","xls"),
		//"document"=> Array("doc","pdf","ppt","ps","rtf","xls"),
		"archive"	=> Array("ace","arc","bz2","cab","gz","lha","jar","rar","sit","tar","tbz2","tgz","z","zip","zoo"),
		"music"		=> Array("mp3")
	);
	static $extensions = null;

	if ($extensions==null) {
		$extensions = Array();
		foreach($fileTypes AS $keyType => $value) {
			foreach($value AS $ext) $extensions[$ext] = $keyType;
		}
	}

	if ($fileInfo["isDirectory"]) {
		if ($fileInfo["isBack"]) {
			return "dirup";
		} else {
			return "folder";
		}
	}
	
	$type = $extensions[strtolower($extension)];
	if ($type=="") {
		return "unknown";
	} else {
		return $type;
	}
}

function getIcon($fileType) {
	GLOBAL $useExternalImages, $externalIcons;
	if ($useExternalImages && $externalIcons[$fileType]!="") {
		return $externalIcons[$fileType];
	} else {
		return $_SERVER["PHP_SELF"]."?getimage=$fileType";
	}
}

function dirContainsHtAccess($dirname) {
	if(is_dir($dirname)) {
		if ($dirname=="." || $dirname=="..") return false;
		$d = dir($dirname);
		while($f = $d->read()) {
			if ($f==".htaccess")
				return true;
		}
	}
	return false;
}

// checks if a file is hidden from view
function fileIsHidden($filename) {
	GLOBAL $hiddenFilesWholeRegex,$protectDirsWithHtaccess;
	
	if (is_dir($filename) && $protectDirsWithHtaccess) {
		if (!($filename=="." || $filename=="..")) {
			$d = dir($filename);
			while($f = $d->read()) {
				if ($f==".htaccess")
					return true;
			}
		}
	}
	return preg_match($hiddenFilesWholeRegex,$filename);
}


function getVersion($filename) {
	$version = "&ndash;";
	$contents = file_get_contents($filename);
	$no_matches = preg_match("/Id: (\S+) (\d+.\d+)/i", $contents, $matches);
	if ($no_matches>0) $version = $matches[2];
	return $version;
}


/**
 * Gets a file's description from the description array.
 **/
function getDescription($filename) {
	GLOBAL $descriptions, $descriptionFilenamesCaseSensitive;
	
	if (!$descriptionFilenamesCaseSensitive) {
		$filename = strtolower($filename);
	}
	return $descriptions[$filename];
}

function getPageLink($startNumber, $linkText, $linkTitle="") {
	GLOBAL $snifServer, $path;
	$url = "http://".$snifServer.$_SERVER["PHP_SELF"]."?path=".$path."&sort=".$_GET["sort"]."&order=".$_GET["order"]."&start=".$startNumber;
	if ($linkTitle!="") {
		$titleAttribute = " title=\"$linkTitle\"";
	} else {
		$titleAttribute = "";
	}
	return "<a href=\"$url\"$titleAttribute>$linkText</a>&nbsp;";
}

function getPagingHeader() {
	GLOBAL $pageStart, $usePaging, $pagingNumberOfPages, $pagingActualPage, $pageNumber, $files;
	static $displayPages = Array();
	if (count($displayPages)==0) {
		$displayPages[] = 0;
		for ($i=$pagingActualPage-1; $i<$pagingActualPage+3; $i++) {
			if ($i>=0 && $i<$pagingNumberOfPages) {
				$displayPages[] = $i;
			}
		}
		$displayPages[] = $pagingNumberOfPages-1;
		$displayPages = array_unique($displayPages);
	}
	
	$header = translate("pages")."&nbsp;&nbsp;";
	if ($pageStart>0) {
		$header.= getPageLink($pageStart-$usePaging, "&laquo;", translate("previous"));
	}
	if ($pageStart+$usePaging<count($files)) {
		$header.= getPageLink($pageStart+$usePaging, "&raquo;", translate("next"));
	}
	foreach($displayPages as $i => $pageNumber) {
		if ($pageNumber-$displayPages[$i-1] > 1) {
			$header.= ".. ";
		}
		if ($pageNumber==$pagingActualPage) {
			$header.= "<span class=\"snWhite\">".($pageNumber+1)."&nbsp;</span>";
		} else {
			$header.= getPageLink($pageNumber*$usePaging, $pageNumber+1);
		}
	}
	
	return $header;
}

function getPathLink($directory) {
	GLOBAL $directDirectoryLinks;
	if ($directDirectoryLinks) {
		return $directory."/";
	} else {
		return $_SERVER["PHP_SELF"]."?path=".urlEncode($directory)."/";
	}
}

/**
 * Truncates a string to a certain length at the most sensible point.
 * First, if there's a '.' character near the end of the string, the string is truncated after this character.
 * If there is no '.', the string is truncated after the last ' ' character.
 * If the string is truncated, " ..." is appended.
 * If the string is already shorter than $length, it is returned unchanged.
 * 
 * @static
 * @param string    string A string to be truncated.
 * @param int        length the maximum length the string should be truncated to
 * @return string    the truncated string
 */
function iTrunc($string, $length) {
	if ($length==0) {
		return $string;
	}
	if (strlen($string)<=$length) {
		return $string;
	}
	
	$pos = strrpos($string,".");
	if ($pos>=$length-4) {
		$string = substr($string,0,$length-4);
		$pos = strrpos($string,".");
	}
	if ($pos>=$length*0.4) {
		return substr($string,0,$pos+1)."...";
	}
	
	$pos = strrpos($string," ");
	if ($pos>=$length-4) {
		$string = substr($string,0,$length-4);
		$pos = strrpos($string," ");
	}
	if ($pos>=$length*0.4) {
		return substr($string,0,$pos)."...";
	}
	
	return substr($string,0,$length-4)."...";
}


function getDirSize($dirname) {
	$dir = dir($dirname);
	$fileCount = 0;
	while ($filename = $dir->read()) {
		if (!fileIsHidden($dirname."/".$filename)) 
			$fileCount++;
	}
	return $fileCount-2; // . and .. do not count
}


/***************************************************************************/
/**  LIST BUILDING                                                        **/
/***************************************************************************/

// change directory
// must be done before description file is parsed
if ($path!="") {
	$hidden = fileIsHidden(substr($path,0,-1));
	if ($hidden || !@chdir($path)) {
		$displayError[] = sprintf(translate("%s is not a subdirectory of the current directory."), $path);
		$path = "";
	}
} 
$dir = dir(".");

// parsing description file
$descriptions = Array();
if ($useDescriptionsFrom!="") {
	$descriptionsFile = @file($useDescriptionsFrom);
	if ($descriptionsFile!==false) {
		for ($i=0;$i<count($descriptionsFile);$i++) {
			$d = explode($separationString,$descriptionsFile[$i]);
			if (!$descriptionFilenamesCaseSensitive) {
				$d[0] = strtolower($d[0]);
			}
			$descriptions[$d[0]] = htmlentities(join($separationString, array_slice($d, 1)));
		}
	}
}

// build a two dimensional array containing the files in the chosen directory and their meta data
$files = Array();
while($entry = $dir->read()) {
	// if the filename matches one of the hidden files wildcards, skip the file
	if (fileIsHidden($entry))
		continue;
		
	// if the file is a directory and if directories are forbidden, skip it
	if (!$allowSubDirs AND is_dir($entry))
		continue;
	
	$f = Array();

	$f["name"] = $entry;
	$f["isDownloadable"] = (substr(strtolower($entry), -4)!=".php") || $allowPHPDownloads;
	$f["isDirectory"] = is_dir($entry);
	$fDate = @filemtime($entry);
	$f["date"] = $fDate;
	$f["fullDate"] = date("r", $fDate);
	$f["shortDate"] = date(translate("DATEFORMAT"), $fDate);
	//setlocale(LC_ALL,"German");
	//$f["shortDate"] = strftime("%x");
	$f["description"] = getDescription($entry);
	if ($f["isDirectory"]) {
		$f["type"] = "&lt;DIR&gt;";
		$f["size"] = "";
		$f["niceSize"] = "";
		
		// building the link
		if ($entry=="..") {
			// strip the last directory from the path
			$pathArr = explode("/",$path);
			$link = implode("/",array_slice($pathArr,0,count($pathArr)-2));
			
			// if there is no path set, don't add it to the link
			if ($link=="") {
				// we're already in $baseDir, so skip the file
				if ($path=="")
					continue;
				$f["link"] = $_SERVER["PHP_SELF"];
			} else {
				$link.= "/";
				$f["link"] = $_SERVER["PHP_SELF"]."?path=".urlEncode($link);
			}
			$f["isBack"] = true;
			if ($useBackForDirUp) {
				$f["displayName"] = translate("[ back ]");
			}
		} else {
			$filesInDir = getDirSize($entry);
			if ($filesInDir==1) {
				$f["niceSize"] = translate("1 item");
			} else {
				$f["niceSize"] = sprintf(translate("%d items"),$filesInDir);
			}
			$f["link"] = getPathLink($path.$entry);
		}
	} else {
		if (is_link($entry)) {
			$linkTarget = readlink($entry);
			$pi = pathinfo($linkTarget);
			$scriptDir = dirname($_SERVER["SCRIPT_FILENAME"]);
			if (strpos($pi["dirname"], $scriptDir)===0) {
				$f["type"] = "&lt;LINK&gt;";
				// links have no date, so take the target's date
				$f["date"] = filemtime($linkTarget);
				$f["link"] = $path.urlencode(substr($linkTarget, strlen($scriptDir)+1));
			} else {
				// link target is outside of script directory, so skip it
				continue;
			}
		} else {
			$fSize = @filesize($entry);
			$f["size"] = $fSize;
			$f["fullSize"] = number_format($fSize,0,".",",");
			$f["niceSize"] = nicesize($fSize);
			$pi = pathinfo($entry);
			$f["type"] = $pi["extension"];
			$f["link"] = myEncode($path,$entry);
			if (in_array("cvsversion", $displayColumns)) {
				$f["cvsversion"] = getVersion($entry);
			}
		}
	}
	if (!$f["isBack"]) {
		$f["displayName"] = htmlentities(iTrunc($f["name"], $truncateLength));
	}
	$f["filetype"] = getFileType($f);
	$f["icon"] = getIcon($f["filetype"]);
	if ($useAutoThumbnails && $f["filetype"]=="image") {
		$f["thumbnail"] = "<a href=\"".urldecode($f["link"])."\"><img src=\"".$PHP_SELF."?thumbnail=".urlencode($path.$f["name"])."\" style=\"text-align: left;\" alt=\"\"/></a>";
	}

	$files[] = $f;
}

usort($files, "myCompare");


$pagingInEffect = $usePaging>0 && count($files)>$usePaging;
if ($usePaging>0) {
	$pageStart = $_GET["start"];
	if ($pageStart=="" || $pageStart<0 || $pageStart>count($files))
		$pageStart = 0;
	$pagingActualPage = floor($pageStart / $usePaging);
	$pagingNumberOfPages = ceil(count($files) / $usePaging);
} else {
	$pageStart = 0;
	$usePaging = count($files);
}
$pageEnd = min(count($files),$pageStart+$usePaging);



/***************************************************************************/
/**  HTML OUTPUT                                                          **/
/***************************************************************************/

$columns = count($displayColumns);

Header("Content-Type: text/html; charset=UTF-8");
echo "<?php xml version=\"1.0\" encoding=\"UTF-8\"?>";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<script>myAudio = new Audio();</script>
		<title><?php echo translate("Index of")." ".htmlentities(dirname($_SERVER["PHP_SELF"])."/".$path);?></title>
		<?php 
		if ($externalStylesheet!="") {
			?>
			<link rel="stylesheet" type="text/css" href="<?php echo $externalStylesheet?>" />
			<?php 
		}
		?>
		<style type="text/css">
		
			/*** COLORS ***/
			<?php 
			if ($externalStylesheet=="") {
			?>
			body.snif {
				background: #ffffff;             /* background behind table */
			}
			table.snif {
				border: 1px solid #444444;       /* main table border style */
			}
			td.snDir {
				color: #ffffff;                  /* table header text color */
				background-color: #000000;       /* table header background color */
			}
			td.snDir a {
				color:white;                     /* link text color within table header */
			}
			tr.snHeading, td.snHeading, td.snHeading a {
				color: #dddddd;                  /* column headings text color */
				background-color: #444444;       /* column headings background color */
			}
			tr.snF td a {
				color: #000000;                  /* file listing link text color (filename)*/
			}
			tr.snF td a:hover, a.snif:hover {
				background-color: #bbbbee;       /* file listing link hover background color */
			}
			tr.snEven {
				background-color: #eeeeee;       /* file listing background color for even numbered rows */
			}
			tr.snOdd {
				background-color: #dddddd;       /* file listing background color for odd numbered rows */
			}
			tr.snF td {
				color: #444444;                  /* file listing text color */
			}
			.snCopyright * {
				color: #bbbbbb;                  /* copyright notice text color */
			}
			.snWhite {
				color: white;                    /* active page in paging header */
			}
			<?php 
			}
			?>
			
			/*** FONTS ***/
			.snif * {
				font-family: Tahoma, Sans-Serif;
				font-size: 10pt;
			}
			.snif a, a.snif {
				text-decoration: none;
			}
			.snif a:hover, a.snif:hover {
				text-decoration: underline;
			}
			.snCopyright * {
				font-size: 8pt;
			}
			.snifSmaller {
				font-weight: normal;
				font-size: 8pt;
			}
			td.snDir {
				font-weight: bold;
			}
			tr.snHeading, td.snHeading, td.snHeading a {
				font-weight: bold;
			}
			
			
			/*** MARGINS AND POSITIONS ***/
			table.snif {
				<?php 
				if ($tableWidth100Percent) {
					echo "width:100%;";
				}
				?>
			}
			table.snif td {
				padding-left: 10px;
				padding-right: 10px;
			}
			table.snif td.littlepadding {
				padding-left: 4px;
				padding-right: 0px;
			}
			td.snDir {
				padding-top: 3px;
				padding-bottom: 3px;
			}
			tr.snHeading, td.snHeading, td.snHeading a {
				padding-top: 3px;
				padding-bottom: 3px;
			}
			tr.snF td {
				padding-top: 2px;
				padding-bottom: 2px;
				vertical-align: top;
				padding-left: 10px;
				padding-right: 10px;
				white-space: nowrap;
			}
			.snif img {
				border:none;
			}
			.snW {
				white-space: normal;
			}
		</style>
	</head>
<body class="snif">
<?php 
if (count($displayError)>0) {
	foreach($displayError AS $error) {
		echo "<b style=\"color:red\">$error</b><br/>";
	}
	echo "<br/>";
}
?>
<table cellpadding="0" cellspacing="0" class="snif">
	<tr>
		<td class="snDir" colspan="<?php echo count($displayColumns)?>">
			<?php 
			$baseDirname = $snifServer.htmlentities(dirname($_SERVER["PHP_SELF"]));
			$pathToSnif = explode("/",$baseDirname);
			echo "http://".join("/",array_slice($pathToSnif, 0, -1))."/";
			echo "<a href=\"".dirname($_SERVER["PHP_SELF"])."/\">".join("/",array_slice($pathToSnif, -1))."</a>";
			$pathArr = explode("/",$path);
			for ($i=0; $i<count($pathArr)-1; $i++) {
				$dirLink = getPathLink(join("/",array_slice($pathArr, 0, $i+1)));
				echo "/<a href=\"$dirLink\">".htmlentities($pathArr[$i])."</a>";
			}
			?><br/>
			<span class="snifSmaller"><?php echo $descriptions["."];?></span>
		</td>
	</tr>
	<?php 
	if ($pagingInEffect) {
	?>
	<tr class="snHeading">
		<td class="snHeading" colspan="<?php echo count($displayColumns)?>">
			<?php 
			echo getPagingHeader();
			?>
		</td>
	</tr>
<?php 
	}
?>
	<tr class="snHeading">
		<?php 
		foreach($displayColumns AS $column) {
			switch ($column) {
				case "download":
					?>
					<td class="snHeading littlepadding">&nbsp;</td>
					<?php 
					break;
				case "icon":
					?>
					<td class="snHeading littlepadding">&nbsp;</td>
					<?php 
					break;
				case "name":
					?>
					<td class="snHeading">
						<!--<img src="<?php echo $PHP_SELF?>?getimage=blank" alt="" width="30" height="16" style="vertical-align:middle;"/>--><a href="<?php echo getNewSortURL("name");?>"><?php echo translate("name");?></a>
						<?php 
						$sort = $_GET["sort"];
						if ($sort=="name")
							echo "<img src=\"".getIcon($_GET["order"])."\" width=\"5\" height=\"3\" style=\"vertical-align:middle;\" alt=\"".translate($_GET["order"])."\"/>";
						?>
					</td>
					<?php 
					break;
				case "type":
					?>
					<td class="snHeading">
						<a href="<?php echo getNewSortURL("type");?>"><?php echo translate("type");?></a>
						<?php 
						if ($sort=="type")
							echo "<img src=\"".getIcon($_GET["order"])."\" width=\"5\" height=\"3\" style=\"vertical-align:middle;\" alt=\"".translate($_GET["order"])."\"/>";
						?>
					</td>
					<?php 
					break;
				case "size":
					?>
					<td class="snHeading" align="right">
						<?php 
						if ($sort=="size")
							echo "<img src=\"".getIcon($_GET["order"])."\" width=\"5\" height=\"3\" style=\"vertical-align:middle;\" alt=\"".translate($_GET["order"])."\"/>";
						?>
						<a href="<?php echo getNewSortURL("size");?>"><?php echo translate("size");?></a>
					</td>
					<?php 
					break;
				case "date":
					?>
					<td class="snHeading">
						<a href="<?php echo getNewSortURL("date");?>"><?php echo translate("date");?></a>
						<?php 
						if ($sort=="date")
							echo "<img src=\"".getIcon($_GET["order"])."\" width=\"5\" height=\"3\" style=\"vertical-align:20%;\" alt=\"".translate($_GET["order"])."\"/>";
						?>
					</td>
					<?php 
					break;
				case "description":
					?>
					<td class="snHeading"<?php if ($descriptionColumnWidth>0) echo " style=\"width:".$descriptionColumnWidth."px;\"";?>><?php echo translate("description");?></td>
					<?php 
					break;
				case "cvsversion":
					?>
					<td class="snHeading"><?php echo translate("CVS");?></td>
					<?php 
					break;
			}
		}
		?>
	</tr>
	<?php 
	for ($i=$pageStart;$i<$pageEnd;$i++) {
	?>
	<tr class="snF <?php echo ($i%2==0) ? "snEven" : "snOdd"?>">
		<?php 
		foreach($displayColumns AS $column) {
			switch ($column) {
				case "download":
					echo "<td class=\"littlepadding\">";
					if ($files[$i]["isDirectory"] OR !$files[$i]["isDownloadable"]) {
					?>
						<img src="<?php echo $PHP_SELF?>?getimage=blank" alt="" width="7" height="16" style="vertical-align:middle;"/>
					<?php 
					} else {
					?>
						<a href="<?php echo $PHP_SELF?>?path=<?php echo rawurlencode($path)?>&amp;download=<?php echo rawurlencode($files[$i]["name"]);?>"><img src="<?php echo getIcon("download")?>" alt="<?php echo translate("download");?>" title="<?php echo translate("download");?>" width="7" height="16" style="vertical-align:middle;"/></a>
					<?php 
					}
					echo "</td>";
					break;
				case "icon":
					echo "<td class=\"littlepadding\">";
					?>
					<?php if($files[$i]["filetype"]!="music"){ ?>
					<a href="<?php echo $files[$i]["link"];?>" title="<?php echo htmlentities($files[$i]["name"]);?>"><img src="<?php echo $files[$i]["icon"]?>" alt="" title="<?php echo translate($files[$i]["filetype"])?>" width="16" height="16" style="vertical-align:middle;"/></a>
					<?php }
					else{
					?>
					<a href="#" title="<?php echo htmlentities($files[$i]["name"]);?>" onclick="javascript:myAudio.pause();myAudio.src='<?php echo $files[$i]["link"];?>';myAudio.play();"><img src="<?php echo $files[$i]["icon"]?>" alt="" title="<?php echo translate($files[$i]["filetype"])?>" width="16" height="16" style="vertical-align:middle;"/></a>
					<?php } ?>
					<?php 
					echo "</td>";
					break;
				case "name":
					echo "<td>";
					?><a href="<?php echo $files[$i]["link"];?>" title="<?php echo htmlentities($files[$i]["name"]);?>"><?php 
					echo $files[$i]["displayName"]."&nbsp;</a>";
					echo "</td>";
					break;
				
				case "type":
					echo "<td>";
					echo $files[$i]["type"];
					echo "</td>";
					break;
				
				case "size":
					echo "<td align=\"right\">";
					if ($files[$i]["fullSize"]!="") echo "	<span title=\"".$files[$i]["fullSize"]." ".translate("Bytes")."\">";
					echo $files[$i]["niceSize"];
					if ($files[$i]["fullSize"]!="") echo "  </span>";
					echo "</td>";
					break;
				
				case "date":
					echo "<td>";
					echo "<span title=\"".$files[$i]["fullDate"]."\">".$files[$i]["shortDate"]."</span>";
					echo "</td>";
					break;
				
				case "description":
					?><td class="snW" style="white-space: normal;">
					<?php 
					if ($files[$i]["filetype"]=="image") {
						echo $files[$i]["thumbnail"];
					}
					?>
					<?php echo $files[$i]["description"];?>
					</td><?php 
					break;
				
				case "cvsversion":
					echo "<td>";
					echo $files[$i]["cvsversion"];
					echo "</td>";
					break;
			}
		}
		?>
	</tr><?php 
	}
	if ($pagingInEffect) {
	?>
	<tr class="snHeading">
		<td class="snHeading" colspan="<?php echo $columns?>">
			<?php 
			echo getPagingHeader();
			?>
		</td>
	</tr>
<?php 
	}
?>
</table>
<div class="snCopyright">
<br/>
<a href="http://www.bitfolge.de/snif">
snif 1.5.2
&copy; 2003-04 Kai Blankenhorn</a><br/>
<a href="http://validator.w3.org/check/referer"><?php echo translate("valid");?> XHTML 1.1</a>
<a href="http://jigsaw.w3.org/css-validator/check/referer"><?php echo translate("valid");?> CSS 2</a>
</div>
</body>
</html>
