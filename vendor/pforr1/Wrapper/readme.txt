Wrappers
----------

 
---------------------------------------------------------
I OO wrapper for scalar types (data types)

---------------------------------------------------------
-------------------------------------------------------
Wrapper architecture
1. level: function grouping with objects :: an Ini Setting (Directive)
2. level: wrapper around function, same name, same parameters :: String IniSet (String, String)
3.a) level: unified naming and signature
       - no unlimited parameters (e.g. array_merge) , array instead 
3.b) level: input/output with object wrappers and constants: Stringy, Arrayzy, instead of simple types, Bool:TRUE, Bool:FALSE instead of yes no on off (ini_set)

4. level: group object (helper etc.) :: e.g. IniHelper (prints ini information)
----------------------------------------------------------
II OO wrapper classes for php built-in / extension functions

  * ini core directives
  * ini extension directives

  * implement boiletplate code/ best practise 
  * named parameters
  * setters?
  * values original data types and wrapper types
  * exception handling (if return false-> throw exception)
  * php compatibility? shims
  

  * dev support
    * support ini core directives
    * check for allowed values, range
    * give constants for special values (0 = unlimited, -1 = use other option etc.)
  * security?

  * system of naming functions PascalCase Classes, singular, object, verb etc.
  * eleminate alias functions 
  * @todo get master function name
  
  * system of parameter order (needle, haystack)
  ---------------------------------------------------------
II A) Das Book Info
http://de2.php.net/manual/de/book.info.php


Objekte:
assert - was ist das
Constant (get constants)
(Function (ExtensionFunction) -> Reflector
Extension .. dl, get loaded extensions
GarbageCollector gc_
(get_include_path -> iniget
IncludedFiles
(get_magic_quotes_gpc -> iniget
(get_magic_quotes_runtime -> iniget
Resource (get resources)
ScriptFile (getlastmod = script file, inode; get script user, get owner) owner GID/UID
OS Process (CLI) process title, id
OS ? ZendThread
OS Command Line (getopt)
OS Env (getenv, putenv)
OS Resource Usage? = resource? nein, oder
OS (uname)
(dummy main
Ini incl. php_ini_* (setter, )
(PhpInfo = Ini formatted)
MemoryUsage
Logo und Credits / ZendLogo
PhpSapi
PhpVersion (incl. version_compare)
(restore_include_path -> ini
(set_include_path -> ini
(set_magic_quotes_runtime -> ini
(set_time_limit -> ini
(sys_get_temp_dir -> ini
