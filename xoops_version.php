<?php
/**
 * XOOPS ThAdmin module
 *
 * LICENSE
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * @copyright   The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license     http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author      Andricq Nicolas (AKA MusS)
 * @since       2.3.0
 * @package     ThAdmin
 * @version     $Id$
 */
if (!defined('XOOPS_ROOT_PATH')) { exit(); }

// Main
$modversion['name']        = _THADMIN_MODULE_NAME;
$modversion['version']     = 1.2;
$modversion['description'] = _THADMIN_MODULE_DESC;
$modversion['credits']     = 'Andricq Nicolas (AKA MusS)';
$modversion['author']      = 'Andricq Nicolas (AKA MusS)';
$modversion['help']        = '';
$modversion['license']     = 'http://www.gnu.org/licenses/gpl.txt';
$modversion['official']    = 0;
$modversion['image']       = 'thadmin.png';
$modversion['dirname']     = 'thadmin';
// Admin things
$modversion['hasAdmin']    = 1;
$modversion['adminindex']  = 'admin/index.php';
$modversion['adminmenu']   = 'admin/menu.php';
// Menu
$modversion['hasMain']     = 0;
// Scrips
$modversion['onInstall']   = 'include/action.module.php';

// Settings
xoops_load( 'xoopslists' );
$theme_list = XoopsLists::getDirListAsArray(XOOPS_ROOT_PATH.'/modules/thadmin/themes/');
$i=1;
$modversion['config'][$i] = array(
    'name'        => 'theme_admin_set',
    'title'       => '_THADMIN_ADMINTHEME',
    'description' => '_THADMIN_ADMINTHEME_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'options'     => $theme_list,
    'default'     => 'default');
$i++;
$modversion['config'][$i] = array(
    'name'        => 'cpanel_only',
    'title'       => '_THADMIN_CPANELEONLY',
    'description' => '_THADMIN_CPANELEONLY_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1);
?>