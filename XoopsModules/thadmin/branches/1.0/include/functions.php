<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * Modules internal functions
 *
 * @copyright   The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license     http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author      Andricq Nicolas (AKA MusS)
 * @package     ThAdmin
 * @since       2.3.0
 * @version     $Id:
 */

 
/**
 * Return the loaded php extension
 *
 * @return      Array
 */
function thadmin_phpExtension()
{
    return $extensions = get_loaded_extensions();
}


function thadmin_systemInfos()
{
    // Include langauge file
    xoops_loadLanguage("cpanel", "system");
    // Information Array
    $infos[1]['label'] = sprintf(_MD_CPANEL_VERSION, "XOOPS");
    $infos[1]['value'] = XOOPS_VERSION;
    $infos[2]['label'] = sprintf(_MD_CPANEL_VERSION, "PHP");
    $infos[2]['value'] = PHP_VERSION;
    $infos[3]['label'] = sprintf(_MD_CPANEL_VERSION, "MySQL");
    $infos[3]['value'] = mysql_get_server_info();
    $infos[4]['label'] = sprintf(_MD_CPANEL_VERSION, "Server API");
    $infos[4]['value'] = PHP_SAPI;
    $infos[5]['label'] = sprintf(_MD_CPANEL_VERSION, "OS");
    $infos[5]['value'] = PHP_OS;
    $infos[6]['label'] = 'safe_mode';
    $infos[6]['value'] = ini_get( 'safe_mode' );
    $infos[7]['label'] = 'register_globals';
    $infos[7]['value'] = ini_get( 'register_globals' );
    $infos[8]['label'] = 'magic_quotes_gpc';
    $infos[8]['value'] = ini_get( 'magic_quotes_gpc' );
    $infos[9]['label'] = 'allow_url_fopen';
    $infos[9]['value'] = ini_get( 'allow_url_fopen' );
    $infos[10]['label'] = 'fsockopen';
    $infos[10]['value'] = function_exists( 'fsockopen' );
    $infos[11]['label'] = 'allow_call_time_pass_reference';
    $infos[11]['value'] = ini_get( 'allow_call_time_pass_reference' );
    $infos[12]['label'] = 'post_max_size';
    $infos[12]['value'] = ini_get( 'post_max_size' );
    $infos[13]['label'] = 'max_input_time';
    $infos[13]['value'] = ini_get( 'max_input_time' );
    $infos[14]['label'] = 'output_buffering';
    $infos[14]['value'] = ini_get( 'output_buffering' );
    $infos[15]['label'] = 'max_execution_time';
    $infos[15]['value'] = ini_get( 'max_execution_time' );
    $infos[16]['label'] = 'memory_limit';
    $infos[16]['value'] = ini_get( 'memory_limit' );
    $infos[17]['label'] = 'file_uploads';
    $infos[17]['value'] = ini_get( 'file_uploads' );
    $infos[18]['label'] = 'upload_max_filesize';
    $infos[18]['value'] = ini_get( 'upload_max_filesize' );
    // return array
    return $infos;
}

/**
 * Returns a module's option
 *
 * @author      Instant Zero (http://xoops.instant-zero.com)
 * @copyright   (c) Instant Zero
 * @param       string $option	module option's name
 */
function thadmin_Setting($option, $repmodule='thadmin'){
  global $xoopsModuleConfig, $xoopsModule;
  static $tbloptions= Array();
  if(is_array($tbloptions) && array_key_exists($option,$tbloptions)) {
    return $tbloptions[$option];
  }

  $retval = false;
  if (isset($xoopsModuleConfig) && (is_object($xoopsModule) && $xoopsModule->getVar('dirname') == $repmodule && $xoopsModule->getVar('isactive'))) {
    if(isset($xoopsModuleConfig[$option])) {
      $retval= $xoopsModuleConfig[$option];
    }
  } else {
    $module_handler =& xoops_gethandler('module');
    $module =& $module_handler->getByDirname($repmodule);
    $config_handler =& xoops_gethandler('config');
    if ($module) {
      $moduleConfig =& $config_handler->getConfigsByCat(0, $module->getVar('mid'));
      if(isset($moduleConfig[$option])) {
        $retval= $moduleConfig[$option];
      }
    }
  }
  $tbloptions[$option]=$retval;
  return $retval;
}
?>
