<?php
/**
 * @copyright   The Xoops Project http://sourceforge.net/projects/xoops/
 * @license     http://www.gnu.org/licenses/gpl.txt GNU General Public License (GPL)
 * @package     thadmin
 */

/**
 * Returns a module's option
 * @author Instant Zero (http://xoops.instant-zero.com)
 * @copyright (c) Instant Zero
 * @param string $option	module option's name
 **/
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
